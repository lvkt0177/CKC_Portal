<?php

namespace App\Http\Controllers\Client;

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
        $this->middleware('auth.scretary', ['only' => ['create', 'store', 'edit', 'update','deleteSinhVienVang']]);
    }

    public function index()
    {   
        $sinhVien = Auth::guard('student')->user();
        $thuKy = $sinhVien->chuc_vu == RoleStudent::SECRETARY ? true : false;
        $bienBanSHCN = $this->bienBanRepository->getByLopWithRelationsByIdLop($sinhVien->id_lop);
        $lop = Lop::find($sinhVien->id_lop);
        return view('client.bienbanshcn.index', compact('bienBanSHCN', 'lop', 'thuKy'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create(Lop $lop)
    {
        $thuKy = SinhVien::where('id_lop', $lop->id)->where('chuc_vu', RoleStudent::SECRETARY)->get();
        $tuans = Tuan::all();
        $sinhViens = SinhVien::where('id_lop', $lop->id)->get();

        return view('client.bienbanshcn.create', compact('lop', 'thuKy', 'tuans','sinhViens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BienBanRequest $request, Lop $lop, BienBanService $bienBanService)
    {
        $result = $bienBanService->storeBienBanVaChiTiet($request->all(), $lop);
        
        if($result) {
            return redirect()->route('sinhvien.bienbanshcn.index', $lop->id)->with('success', 'Thêm biên bản thành công');
        }

        return redirect()->route('sinhvien.bienbanshcn.index', $lop->id)->with('error', 'Thêm biên bản thất bại');
    }

    /**
     * Display the specified resource.
     */
    public function show(BienBanSHCN $bienBanSHCN)
    {
        $bienBanSHCN->load('lop', 'tuan', 'thuky.hoSo', 'gvcn.hoSo', 'chiTietBienBanSHCN.sinhVien.hoSo');
        return view('client.bienbanshcn.show', ['thongTin' => $bienBanSHCN]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BienBanSHCN $bienbanshcn)
    {
        if($bienbanshcn->trang_thai == BienBanStatus::ACTIVE) {
            return redirect()->route('sinhvien.bienbanshcn.index');
        }
        $bienbanshcn->load('lop.sinhViens.hoSo','thuky.hoSo', 'tuan', 'gvcn.hoSo', 'chiTietBienBanSHCN.sinhVien.hoSo');
        $thuKy = SinhVien::where('id_lop', $bienbanshcn->lop->id)->where('chuc_vu', RoleStudent::SECRETARY)->get();
        $tuans = Tuan::all();

        return view('client.bienbanshcn.edit', ['thongTin' => $bienbanshcn, 'tuans' => $tuans,'thuKy' => $thuKy]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BienBanRequest $request, BienBanSHCN $bienbanshcn, BienBanService $bienBanService)
    {
        $result = $bienBanService->updateBienBanVaChiTiet($request->validated(), $bienbanshcn);

        if ($result) {
            return redirect()->route('sinhvien.bienbanshcn.index')
                ->with('success', 'Cập nhật biên bản thành công');
        }

        return redirect()->route('sinhvien.bienbanshcn.index')
            ->with('error', 'Cập nhật biên bản thất bại');
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
}
