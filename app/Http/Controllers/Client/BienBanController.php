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
use App\Models\DanhSachSinhVien;
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
        $sinhVien = Auth::guard('student')->user();
        $thongTin = $sinhVien->danhSachSinhVien->last();
        $thuKy = $thongTin->chuc_vu == RoleStudent::SECRETARY;

        $bienBanSHCN = $this->bienBanRepository
            ->getByLopWithRelationsByIdLop($thongTin->lop->id, 100);

        return view('client.bienbanshcn.index', compact('bienBanSHCN','thuKy'));
    }

    public function list()
    {
        $sinhVien = Auth::guard('student')->user();
        $thongTin = $sinhVien->danhSachSinhVien->last();
        $thuKy = $sinhVien->chuc_vu == RoleStudent::SECRETARY;
        $lop = Lop::find($thongTin->id_lop);
        $bienBanSHCN = $this->bienBanRepository
            ->getByLopWithRelationsByIdLop($lop->id, 100);
        
        return view('client.bienbanshcn.list', compact('bienBanSHCN', 'lop', 'thuKy'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create(Lop $lop)
    {
        $thuKy = Auth::guard('student')->user()->danhSachSinhVien->last();
        $thuKy->load('sinhVien.hoSo');
        $tuans = Tuan::all();
        $sinhViens = DanhSachSinhVien::with('sinhVien.hoSo')->where('id_lop', $lop->id)->get();

        return view('client.bienbanshcn.create', compact('lop', 'thuKy', 'tuans', 'sinhViens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BienBanRequest $request, Lop $lop, BienBanService $bienBanService)
    {
        $data = $request->validated();
        $data['trang_thai'] = BienBanStatus::THUKY;
        $result = $bienBanService->storeBienBanVaChiTiet($data, $lop);
        
        if($result) {
            return redirect()->route('sinhvien.bienbanshcn.list', $lop->id)->with('success', 'Thêm biên bản thành công');
        }

        return redirect()->route('sinhvien.bienbanshcn.list', $lop->id)->with('error', 'Thêm biên bản thất bại');
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
        $thuKy = Auth::guard('student')->user()->danhSachSinhVien->last();
        $thuKy->load('sinhVien.hoSo');
        $bienbanshcn->load('thuky.hoSo', 'tuan', 'gvcn.hoSo', 'chiTietBienBanSHCN.sinhVien.hoSo');
        $tuans = Tuan::all();
        $sinhViens = DanhSachSinhVien::with('sinhVien.hoSo')->where('id_lop', $bienbanshcn->id_lop)->get();

        return view('client.bienbanshcn.edit', ['thongTin' => $bienbanshcn, 'tuans' => $tuans,'thuKy' => $thuKy, 'sinhViens' => $sinhViens]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BienBanRequest $request, BienBanSHCN $bienbanshcn, BienBanService $bienBanService)
    {
        $result = $bienBanService->updateBienBanVaChiTiet($request->validated(), $bienbanshcn);

        if ($result) {
            return redirect()->route('sinhvien.bienbanshcn.list')
                ->with('success', 'Cập nhật biên bản thành công');
        }

        return redirect()->route('sinhvien.bienbanshcn.list')
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

    public function guiBienBanDenGVCN(BienBanSHCN $bienBanSHCN)
    {
        $bienBanSHCN->trang_thai = BienBanStatus::GIANGVIEN;
        $bienBanSHCN->save();        
        return redirect()->back()->with('success', 'Gửi biên bản SHCN đến Giảng Viên Chủ Nhiệm thành công!');
    }

    public function destroy(BienBanSHCN $bienbanshcn)
    {
        $bienbanshcn->delete();
        return redirect()->back()->with('success', 'Xóa biên bản thành công');
    }
}
