<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BienBanSHCN;
use App\Models\SinhVien;
use App\Models\User;
use App\Models\Tuan;
use App\Models\Lop;
use App\Models\HoSo;
use App\Models\DanhSachSinhVien;
use App\Models\ChiTietBienBanSHCN;
use App\Enum\RoleStudent;
use App\Enum\BienBanStatus;
use App\Http\Requests\BienBan\BienBanRequest;
use Carbon\Carbon;
use App\Services\BienBanService;
use App\Repositories\BienBan\BienBanRepository;
use Illuminate\Support\Facades\Log;
use Auth;
use \Spatie\Permission\Models\Role;
use \Spatie\Permission\Models\Permission;
use App\Acl\Acl;

class BienBanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(
        protected BienBanRepository $bienBanRepository
    ) {
        $this->middleware('auth.scretary', ['only' => ['list','create', 'store', 'edit', 'update','deleteSinhVienVang']]);
    }

    public function index()
    {   
        $sinhVien = Auth::user();
        
        $thongTin = $sinhVien->danhSachSinhVien->last();
        $thuKy = $thongTin->chuc_vu == RoleStudent::SECRETARY;

        $bienBanSHCN = $this->bienBanRepository
            ->getByLopWithRelationsByIdLop($thongTin->lop->id, 100);

        return response()->json([
            'status' => 'success',
            'bienBanSHCN' => $bienBanSHCN,
        ]);
    }

    /**
     * List bien ban SHCN of lop hoc phan of user logined
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function list()
    {
        $sinhVien = Auth::user();
        $thongTin = $sinhVien->danhSachSinhVien->last();
        $thuKy = $thongTin->chuc_vu == RoleStudent::SECRETARY;
        $lop = Lop::find($thongTin->id_lop);
        $bienBanSHCN = $this->bienBanRepository
            ->getByLopWithRelations($lop);
        $bienBanSHCN->load('chiTietBienBanSHCN.sinhVien.hoSo');
        return response()->json([
            'status' => 'success',
            'bienBanSHCN' => $bienBanSHCN,
            'lop' => $lop,
            'thuKy' => $thuKy,
        ]);
    }
    
    public function create()
    {
        $sinhVien = Auth::user();
        $thongTin = $sinhVien->danhSachSinhVien->last();
        $danhSachSinhVien = DanhSachSinhVien::with('sinhVien.hoSo')->where('id_lop', $thongTin->id_lop)->get();

        return response()->json([
            'status' => 'success',
            'thongTin' => $thongTin,
            'danhSachSinhVien' => $danhSachSinhVien
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function store(BienBanRequest $request, Lop $lop, BienBanService $bienBanService)
    {
        $data = $request->validated();
        $data['trang_thai'] = BienBanStatus::THUKY;
        $result = $bienBanService->storeBienBanVaChiTiet($data, $lop);
        
        if($result) {
            return response()->json([
                'status' => 'success',
                'message' => 'Thêm biên bản thành công',
                'bienBanSHCN' => $result,
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Thêm biên bản thất bại',
        ], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(BienBanSHCN $bienBanSHCN)
    {
        $bienBanSHCN->load('lop', 'tuan', 'thuky.hoSo', 'gvcn.hoSo', 'chiTietBienBanSHCN.sinhVien.hoSo');
        return  response()->json([
            'status' => 'success',
            'bienBanSHCN' => $bienBanSHCN,
        ]);
    }

    public function guiBienBanDenGVCN(BienBanSHCN $bienBanSHCN)
    {
        $bienBanSHCN->trang_thai = BienBanStatus::GIANGVIEN;
        $bienBanSHCN->save();        
        return response()->json([
            'status' => 'success',
            'message' => 'Gửi biên bản tới Giảng Viên Chủ nhiệm thành công!'
        ]);
    }

    public function destroy(BienBanSHCN $bienbanshcn)
    {
        $bienbanshcn->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Xoá biên bản thành công'
        ]);
    }
}
