<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BienBanSHCN;
use App\Models\SinhVien;
use App\Models\User;
use App\Models\Tuan;
use App\Models\Lop;
use App\Models\HoSo;
use App\Models\ChiTietBienBanSHCN;
use App\Enum\RoleStudent;
use App\Enum\BienBanStatus;
use App\Http\Requests\BienBan\BienBanRequest;
use Carbon\Carbon;
use App\Services\BienBanService;
use App\Repositories\BienBan\BienBanRepository;
use Illuminate\Support\Facades\Log;

class BienBanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(
        protected BienBanRepository $bienBanRepository
    ) {
        //
    }

    public function index(Lop $lop)
    {   
        $bienBanSHCN = $this->bienBanRepository->getByLopWithRelations($lop);

        return response()->json([
            'status' => 'success',
            'data' => $bienBanSHCN,
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create(Lop $lop)
    {
        $thuKy = DanhSachSinhVien::with('sinhVien.hoSo')->where('id_lop', $lop->id)->where('chuc_vu', RoleStudent::SECRETARY)->get();
        $tuans = Tuan::all();
        $sinhViens = DanhSachSinhVien::with('sinhVien.hoSo')->where('id_lop', $lop->id)->get();
        $lop->load('sinhViens.hoSo');

        return response()->json([
            'status' => 'success',
            'data' => [
                'lop' => $lop,
                'thuKy' => $thuKy,
                'tuans' => $tuans,
                'sinhViens' => $sinhViens
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BienBanRequest $request, Lop $lop, BienBanService $bienBanService)
    {
        $result = $bienBanService->storeBienBanVaChiTiet($request->all(), $lop);
        
        if($result) {
            return response()->json([
                'status' => 'success',
                'message' => 'Thêm biên bản thành công',
                'data' => $result,
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Thêm biên bản thất bại',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(BienBanSHCN $bienBanSHCN)
    {
        $bienBanSHCN->load('lop', 'tuan', 'thuky.hoSo', 'gvcn.hoSo', 'chiTietBienBanSHCN.sinhVien.hoSo');

        return response()->json([
            'status' => 'success',
            'data' => $bienBanSHCN,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BienBanSHCN $bienbanshcn)
    {
        $bienbanshcn->load('thuky.hoSo', 'tuan', 'gvcn.hoSo', 'chiTietBienBanSHCN.sinhVien.hoSo','lop.danhSachSinhVien');
        $tuans = Tuan::all();
        $thuKy = DanhSachSinhVien::with('sinhVien.hoSo')->where('id_lop', $bienbanshcn->id_lop)->where('chuc_vu', RoleStudent::SECRETARY)->get();
        $sinhViens = DanhSachSinhVien::with('sinhVien.hoSo')->where('id_lop', $bienbanshcn->id_lop)->get();

        return response()->json([
            'status' => 'success',
            'data' => [
                'bienBan' => $bienbanshcn,
                'thuKy' => $thuKy,
                'tuans' => $tuans,
                'sinhViens' => $sinhViens
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BienBanRequest $request, BienBanSHCN $bienbanshcn, BienBanService $bienBanService)
    {
        $result = $bienBanService->updateBienBanVaChiTiet($request->validated(), $bienbanshcn);

        if ($result) {
            return response()->json([
                'status' => 'success',
                'message' => 'Cập nhật biên bản thành công',
                'data' => $result,
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Cập nhật biên bản thất bại',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BienBanSHCN $bienbanshcn)
    {
        $bienbanshcn->delete();
        return  response()->json([
            'status' => 'success',
            'message' => 'Xóa biên bản thành công',
        ]);
    }

    public function deleteSinhVienVang(int $id)
    {
        $chiTietBienBan = ChiTietBienBanSHCN::find($id);
        $chiTietBienBan->delete();
        $bienBan = BienBanSHCN::find($chiTietBienBan->id_bien_ban_shcn);
        $bienBan->vang_mat -= 1;
        $bienBan->save();

        return  response()->json([
            'status' => 'success',
            'message' => 'Xóa sinh viên vắng mặt thành công',
        ]);
    }

    public function confirmBienBan(BienBanSHCN $bienBanSHCN)
    {
        $bienBanSHCN->trang_thai = BienBanStatus::ACTIVE;
        $bienBanSHCN->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Xác nhận biên bản thành công',
            'data' => $bienBanSHCN,
        ]);
    }
}
