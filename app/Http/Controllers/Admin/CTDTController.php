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
        $id_chuyen_nganh_cha = $request->input('id_chuyen_nganh_cha');
        $id_chuyen_nganh = $request->input('id_chuyen_nganh');
        $id_nien_khoa = $request->input('id_nien_khoa');

        $dsChuyenNganhCha = ChuyenNganh::whereNull('id_chuyen_nganh_cha')->get();
        
        $dsChuyenNganhCon = collect();
        if ($id_chuyen_nganh_cha) {
            $dsChuyenNganhCon = ChuyenNganh::where('id_chuyen_nganh_cha', $id_chuyen_nganh_cha)
            ->get();
        }

        $dsNienKhoa = NienKhoa::orderByDesc('nam_bat_dau')->get();

        $ctdt = collect();
        if ($dsChuyenNganhCha->isNotEmpty()) {
            $ctdtQuery = ChuongTrinhDaoTao::whereIn('id_chuyen_nganh', $dsChuyenNganhCha->pluck('id'));

            if ($id_nien_khoa) {
                $ctdtQuery->whereHas('chiTietChuongTrinhDaoTao.hocKy', function ($q) use ($id_nien_khoa) {
                    $q->where('id_nien_khoa', $id_nien_khoa);
                });
            }

            $ctdt = $ctdtQuery->orderByDesc('id')->get();
        }
        $chuong_trinh_dao_tao = CHuongTrinhDaoTao::where('id_chuyen_nganh', $id_chuyen_nganh)->first();
    
        $ct_ctdt = collect();
        if ($chuong_trinh_dao_tao && $id_nien_khoa) {
            $ct_ctdt = ChiTietChuongTrinhDaoTao::with(['monHoc', 'chuongTrinhDaoTao', 'hocKy'])
                ->where('id_chuong_trinh_dao_tao', $chuong_trinh_dao_tao->id)
                ->whereHas('hocKy', function ($q) use ($id_nien_khoa) {
                    $q->where('id_nien_khoa', $id_nien_khoa);
                })
                ->get()
                ->groupBy('id_hoc_ky');
        }

        return view('admin.ctdt.index', compact(
            'dsChuyenNganhCha',
            'dsChuyenNganhCon',
            'dsNienKhoa',
            'id_chuyen_nganh_cha',
            'id_chuyen_nganh',
            'id_nien_khoa',
            'ctdt',
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