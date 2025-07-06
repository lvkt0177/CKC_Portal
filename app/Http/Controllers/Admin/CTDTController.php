<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\Tuan\TuanRequest;
use App\Models\DanhSachHocPhan;
use App\Models\ChiTietChuongTrinhDaoTao;
use App\Models\MonHoc;
use App\Models\ChuyenNganh;
use App\Models\NienKhoa;
use App\Models\ChuongTrinhDaoTao;
use App\Models\LopHocPhan;
use App\Models\Lop;
use App\Models\Nam;
use App\Models\Tuan;
use Illuminate\Support\Facades\Log;
use \Spatie\Permission\Models\Permission;
use \Spatie\Permission\Models\Role;
use App\Acl\Acl;

class CTDTController extends Controller
{
    public function __construct() {
        $this->middleware('permission:' . Acl::PERMISSION_CTDT_LIST, ['only' => ['index']]);
        $this->middleware('permission:' . Acl::PERMISSION_CTDT_WEEK_SHOW, ['only' => ['show']]);
        $this->middleware('permission:' . Acl::PERMISSION_CTDT_WEEK_CREATE, ['only' => ['create', 'store']]);
    }

    public function index(Request $request)
    {
        $id_nganh_hoc = $request->input('id_nganh_hoc');
        $id_nien_khoa = $request->input('id_nien_khoa');
        $id_chuong_trinh_dao_tao = $request->input('id_chuong_trinh_dao_tao');

        $dsNganh = ChuyenNganh::all();
        $dsNienKhoa = NienKhoa::orderByDesc('nam_bat_dau')->get();

        $chuyenNganhs = collect();
        if ($id_nganh_hoc) {
            $chuyenNganhs = ChuyenNganh::where('id_nganh_hoc', $id_nganh_hoc)->get();
        }

        $nienkhoa = null;
        if ($id_nien_khoa) {
            $nienkhoa = NienKhoa::find($id_nien_khoa);
        }

        $ctdt = collect();
        if ($chuyenNganhs->isNotEmpty()) {
            $ctdtQuery = ChuongTrinhDaoTao::whereIn('id_chuyen_nganh', $chuyenNganhs->pluck('id'));

            if ($nienkhoa) {
                $ctdtQuery->whereHas('chiTietChuongTrinhDaoTao.hocKy', function ($q) use ($nienkhoa) {
                    $q->where('id_nien_khoa', $nienkhoa->id);
                });
            }

            $ctdt = $ctdtQuery->orderByDesc('id')->get();
        }

        if (!$id_chuong_trinh_dao_tao && $ctdt->isNotEmpty()) {
            $id_chuong_trinh_dao_tao = $ctdt->first()->id;
        }

        $ct_ctdt = collect();
        if ($id_chuong_trinh_dao_tao && $nienkhoa) {
            $ct_ctdt = ChiTietChuongTrinhDaoTao::with(['monHoc', 'chuongTrinhDaoTao', 'hocKy'])
                ->where('id_chuong_trinh_dao_tao', $id_chuong_trinh_dao_tao)
                ->whereHas('hocKy', function ($q) use ($nienkhoa) {
                    $q->where('id_nien_khoa', $nienkhoa->id);
                })
                ->get()
                ->groupBy('id_hoc_ky');
        }

        return view('admin.ctdt.index', compact(
            'dsNganh',
            'dsNienKhoa',
            'chuyenNganhs',
            'ctdt',
            'id_nganh_hoc',
            'id_nien_khoa',
            'id_chuong_trinh_dao_tao',
            'ct_ctdt'
        ));
    }
    
    public function show(Request $request)
    {
        $nam_bat_dau = $request->input('nam_bat_dau');
        if (!$nam_bat_dau) {
            return redirect()->back()->with('error', 'Vui lòng chọn năm để xem danh sách tuần.');
        }
        $nam = Nam::where('nam_bat_dau', $nam_bat_dau)->firstOrFail();
        $dsTuan = Tuan::where('id_nam', $nam->id)->orderBy('tuan')->get();

        return view('admin.ctdt.dstuan', compact('nam', 'dsTuan'));
    }

    public function create()
    {
        return view('admin.ctdt.khoitaotuan');
    }

    public function store(TuanRequest $request)
    {
        $ngay = Carbon::parse($request->validated('date'));
        [$year, $month, $day] = explode('-', $ngay->format('Y-m-d')); 
        $namBatDau = Nam::where('nam_bat_dau', $year)->first();

        if ($year < now()->year) {
            return redirect()->back()->with('error', 'Không được khởi tạo tuần ở năm này!');
        }
        
        for ($namVongLap = $year; $namVongLap <= $year + 1; $namVongLap++) {
            $namModel = Nam::firstOrCreate(['nam_bat_dau' => $namVongLap]);
            $startDate = Carbon::create($namVongLap, $month, $day)->startOfWeek(Carbon::MONDAY);

            for ($tuan = 1; $tuan <= 52; $tuan++) {
                $ngay_bat_dau = $startDate->copy();
                $ngay_ket_thuc = $startDate->copy()->addDays(6);
                Tuan::updateOrCreate(
                    [
                        'id_nam' => $namModel->id,
                        'tuan' => $tuan
                    ],
                    [
                        'ngay_bat_dau' => $ngay_bat_dau,
                        'ngay_ket_thuc' => $ngay_ket_thuc
                    ]
                );
                $startDate->addWeek(); 
            }
        }

        return back()->with('success', 'Khởi tạo thành công!');
    }
}