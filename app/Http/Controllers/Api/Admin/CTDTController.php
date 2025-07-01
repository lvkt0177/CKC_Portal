<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\Tuan\TuanRequest;
use App\Models\DanhSachHocPhan;
use App\Models\ChiTietChuongTrinhDaoTao;
use App\Models\MonHoc;
use App\Models\ChuyenNganh;
use App\Models\NganhHoc;
use App\Models\NienKhoa;
use App\Models\ChuongTrinhDaoTao;
use App\Models\LopHocPhan;
use App\Models\Lop;
use App\Models\Nam;
use App\Models\Tuan;

class CTDTController extends Controller
{
    public function index()
    {
        $dsNganh = NganhHoc::all();
        $dsNienKhoa = NienKhoa::orderByDesc('nam_bat_dau')->get();
        $chuyenNganhs = ChuyenNganh::all();
        $ctdt = ChuongTrinhDaoTao::orderByDesc('id')->get();

        $ct_ctdt = ChiTietChuongTrinhDaoTao::with(['monHoc', 'chuongTrinhDaoTao', 'hocKy'])->get()->groupBy('id_hoc_ky');

        return response()->json([
            'status' => 'success',
            'dsNganh' => $dsNganh,
            'dsNienKhoa' => $dsNienKhoa,
            'chuyenNganhs' => $chuyenNganhs,
            'ctdt' => $ctdt,
            'ct_ctdt' => $ct_ctdt
        ]);
    }

    public function getMonHocAndChiTietCTDT()
    {
        $ctdt = ChuongTrinhDaoTao::get();
        $ct_ctdt = ChiTietChuongTrinhDaoTao::with(['monHoc'])->get()->groupBy('id_hoc_ky');

        return response()->json([
            'status' => 'success',
            'ctdt' => $ctdt,
            'ct_ctdt' => $ct_ctdt
        ]);
    }

    public function create()
    {
        return view('admin.ctdt.khoitaotuan');
    }
    public function show(Request $request)
    {
        $nam_bat_dau = $request->input('nam_bat_dau');

        if (!$nam_bat_dau) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng chọn năm để xem danh sách tuần.'
            ], 400);
        }
    
        $nam = Nam::where('nam_bat_dau', $nam_bat_dau)->first();
    
        if (!$nam) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy năm học.'
            ], 404);
        }
    
        $dsTuan = Tuan::where('id_nam', $nam->id)->orderBy('tuan')->get();
    
        return response()->json([
            'success' => true,
            'nam' => $nam,
            'dsTuan' => $dsTuan
        ]);
    }
    public function store(TuanRequest $request)
    {
        $ngay = Carbon::parse($request->validated('date'));
        [$year, $month, $day] = explode('-', $ngay->format('Y-m-d')); 
        
        $namBatDau = Nam::where('nam_bat_dau', $year)->first();

        
        if ($year < now()->year) {
            return response()->json([
                'success' => false,
                'message' => 'Không được khởi tạo tuần ở năm này!'
            ], 400);
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

        return response()->json([
            'success' => true,
            'message' => 'Khởi tạo thành công!'
        ]);
    }


}