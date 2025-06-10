<?php

namespace App\Http\Controllers\Admin;

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

        return view('admin.bienbanshcn.index', compact('bienBanSHCN', 'lop'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create(Lop $lop)
    {
        $thuKy = SinhVien::where('id_lop', $lop->id)->where('chuc_vu', RoleStudent::SECRETARY)->get();
        $tuans = Tuan::all();
        $sinhViens = SinhVien::where('id_lop', $lop->id)->get();

        return view('admin.bienbanshcn.create', compact('lop', 'thuKy', 'tuans','sinhViens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BienBanRequest $request, Lop $lop, BienBanService $bienBanService)
    {
        $result = $bienBanService->storeBienBanVaChiTiet($request->all(), $lop);
        
        if($result) {
            return redirect()->route('admin.bienbanshcn.index', $lop->id)->with('success', 'Thêm biên bản thành công');
        }

        return redirect()->route('admin.bienbanshcn.index', $lop->id)->with('error', 'Thêm biên bản thất bại');
    }

    /**
     * Display the specified resource.
     */
    public function show(BienBanSHCN $bienBanSHCN)
    {
        $bienBanSHCN->load('lop', 'tuan', 'thuky.hoSo', 'gvcn.hoSo', 'chiTietBienBanSHCN.sinhVien.hoSo');

        return view('admin.bienbanshcn.show', ['thongTin' => $bienBanSHCN]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BienBanSHCN $bienbanshcn)
    {
        $bienbanshcn->load('lop.sinhViens.hoSo','thuky.hoSo', 'tuan', 'gvcn.hoSo', 'chiTietBienBanSHCN.sinhVien.hoSo');
        $thuKy = SinhVien::where('id_lop', $bienbanshcn->lop->id)->where('chuc_vu', RoleStudent::SECRETARY)->get();
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
            return redirect()->route('admin.bienbanshcn.index', $bienbanshcn->lop->id)
                ->with('success', 'Cập nhật biên bản thành công');
        }

        return redirect()->route('admin.bienbanshcn.index', $bienbanshcn->lop->id)
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
        $sinhVien = ChiTietBienBanSHCN::find($id);
        $sinhVien->delete();

        return redirect()->back()->with('success', 'Xóa sinh viên vắng thành công');
    }

    public function confirmBienBan(BienBanSHCN $bienBanSHCN)
    {
        $bienBanSHCN->trang_thai = BienBanStatus::ACTIVE;
        $bienBanSHCN->save();

        return redirect()->back()->with('success', 'Gửi biên bản Sinh hoạt chủ nhiệm thành công!');
    }
}
