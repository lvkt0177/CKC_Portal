<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BienBanSHCN;
use App\Models\SinhVien;
use App\Models\User;
use App\Models\Tuan;
use App\Models\Lop;
use App\Models\LopChuyenNganh;
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

    public function resolveLop(string $type, int $id)
    {
        $allowed = [
            Lop::class,
            LopChuyenNganh::class,
        ];

        if (!in_array($type, $allowed)) {
            abort(404, 'Loại lớp không hợp lệ');
        }

        return app($type)::findOrFail($id);
    }

    public function index(string $type, int $id)
    {
        $lop = $this->resolveLop($type, $id);
        $bienBanSHCN = $this->bienBanRepository->getByLopWithRelations($lop);
    
        return view('admin.bienbanshcn.index', compact('bienBanSHCN', 'lop'));
    }
    
    public function create(string $type, int $id)
    {
        $lop = $this->resolveLop($type, $id);
        $thuKy = SinhVien::where('lop_type', $type)->where('lop_id', $lop->id)->where('chuc_vu', RoleStudent::SECRETARY)->get();
        $tuans = Tuan::all();
        $sinhViens = SinhVien::where('lop_type', $type)->where('lop_id', $lop->id)->get();
    
        return view('admin.bienbanshcn.create', compact('lop', 'thuKy', 'tuans', 'sinhViens'));
    }
    
    public function store(BienBanRequest $request, string $type, int $id, BienBanService $bienBanService)
    {
        $lop = $this->resolveLop($type, $id);
    
        $result = $bienBanService->storeBienBanVaChiTiet($request->all(), $lop);
    
        if ($result) {
            return redirect()->route('giangvien.bienbanshcn.index', ['type' => $type, 'id' => $lop->id])
                             ->with('success', 'Thêm biên bản thành công');
        }
    
        return redirect()->route('giangvien.bienbanshcn.index', ['type' => $type, 'id' => $lop->id])
                         ->with('error', 'Thêm biên bản thất bại');
    }

    /**
     * Display the specified resource.
     */
    public function show(BienBanSHCN $bienBanSHCN)
    {
        $bienBanSHCN->load('lop', 'tuan', 'thuky.hoSo', 'gvcn.hoSo', 'chiTietBienBanSHCN.sinhVien.hoSo');
        dd($bienBanSHCN);
        return view('admin.bienbanshcn.show', ['thongTin' => $bienBanSHCN]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BienBanSHCN $bienbanshcn)
    {
        $bienbanshcn->load('lop.sinhViens.hoSo','thuky.hoSo', 'tuan', 'gvcn.hoSo', 'chiTietBienBanSHCN.sinhVien.hoSo');
        $thuKy = SinhVien::where('lop_id', $bienbanshcn->lop->id)->where('chuc_vu', RoleStudent::SECRETARY)->get();
        $tuans = Tuan::all();

        return view('admin.bienbanshcn.edit', ['thongTin' => $bienbanshcn, 'tuans' => $tuans,'thuKy' => $thuKy]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BienBanRequest $request, BienBanSHCN $bienbanshcn, BienBanService $bienBanService)
    {
        $result = $bienBanService->updateBienBanVaChiTiet($request->validated(), $bienbanshcn);

        if ($result) {
            return redirect()->route('giangvien.bienbanshcn.index', $bienbanshcn->lop->id)
                ->with('success', 'Cập nhật biên bản thành công');
        }

        return redirect()->route('giangvien.bienbanshcn.index', $bienbanshcn->lop->id)
            ->with('error', 'Cập nhật biên bản thất bại');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BienBanSHCN $bienbanshcn)
    {
        $bienbanshcn->delete();
        return redirect()->back()->with('success', 'Xóa biên bản thành công');
    }

    public function deleteSinhVienVang(int $id)
    {
        $chiTietBienBan = ChiTietBienBanSHCN::find($id);
        $chiTietBienBan->delete();
        $bienBan = BienBanSHCN::find($chiTietBienBan->id_bien_ban_shcn);
        $bienBan->vang_mat -= 1;
        $bienBan->save();
        return response()->json(['success' => true, 'message' => 'Xoá sinh viên vắng mặt thành công']);
    }

    public function confirmBienBan(BienBanSHCN $bienBanSHCN)
    {
        $bienBanSHCN->trang_thai = BienBanStatus::ACTIVE;
        $bienBanSHCN->save();

        return redirect()->back()->with('success', 'Gửi biên bản Sinh hoạt chủ nhiệm thành công!');
    }
}
