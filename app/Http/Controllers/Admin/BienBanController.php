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
use App\Models\DanhSachSinhVien;
use App\Models\ChiTietBienBanSHCN;
use App\Enum\RoleStudent;
use App\Enum\BienBanStatus;
use App\Http\Requests\BienBan\BienBanRequest;
use Carbon\Carbon;
use App\Services\BienBanService;
use App\Repositories\BienBan\BienBanRepository;
use Illuminate\Support\Facades\Log;
use \Spatie\Permission\Models\Permission;
use \Spatie\Permission\Models\Role;
use App\Acl\Acl;

class BienBanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(
        protected BienBanRepository $bienBanRepository
    ) {
        $this->middleware('permission:' . Acl::PERMISSION_SECRETARY_REPORT_LIST, ['only' => ['index']]);
        $this->middleware('permission:' . Acl::PERMISSION_SECRETARY_REPORT_SHOW, ['only' => ['show']]);
        $this->middleware('permission:' . Acl::PERMISSION_SECRETARY_REPORT_CREATE, ['only' => ['create', 'store']]);
        $this->middleware('permission:' . Acl::PERMISSION_SECRETARY_REPORT_EDIT, ['only' => ['edit', 'update']]);
        $this->middleware('permission:' . Acl::PERMISSION_SECRETARY_REPORT_DELETE, ['only' => ['destroy']]);
        $this->middleware('permission:' . Acl::PERMISSION_SECRETARY_REPORT_CONFIRM, ['only' => ['confirmBienBan']]);
        $this->middleware('permission:' . Acl::PERMISSION_SECRETARY_REPORT_DELETE_ABSENCE_STUDENT, ['only' => ['deleteSinhVienVang']]);
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
        $thuKy = DanhSachSinhVien::with('sinhVien.hoSo')->where('id_lop', $lop->id)->where('chuc_vu', RoleStudent::SECRETARY)->get();
        $tuans = Tuan::all();

        $sinhViens = DanhSachSinhVien::with('sinhVien.hoSo')->where('id_lop', $lop->id)->get();

        return view('admin.bienbanshcn.create', compact('lop', 'thuKy', 'tuans','sinhViens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BienBanRequest $request, Lop $lop, BienBanService $bienBanService)
    {
        $data = $request->validated();
        $data['trang_thai'] = BienBanStatus::GIANGVIEN;
        $result = $bienBanService->storeBienBanVaChiTiet($data, $lop);
        
        if($result) {
            return redirect()->route('giangvien.bienbanshcn.index', $lop->id)->with('success', 'Thêm biên bản thành công');
        }

        return redirect()->route('giangvien.bienbanshcn.index', $lop->id)->with('error', 'Thêm biên bản thất bại');
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
        $bienbanshcn->load('thuky.hoSo', 'tuan', 'gvcn.hoSo', 'chiTietBienBanSHCN.sinhVien.hoSo','lop.danhSachSinhVien');
        $tuans = Tuan::all();
        $thuKy = DanhSachSinhVien::with('sinhVien.hoSo')->where('id_lop', $bienbanshcn->id_lop)->where('chuc_vu', RoleStudent::SECRETARY)->get();
        $sinhViens = DanhSachSinhVien::with('sinhVien.hoSo')->where('id_lop', $bienbanshcn->id_lop)->get();

        return view('admin.bienbanshcn.edit', ['thongTin' => $bienbanshcn, 'tuans' => $tuans,'thuKy' => $thuKy, 'sinhViens' => $sinhViens]);
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
        if($bienBanSHCN->trang_thai == BienBanStatus::CTCT){
            return redirect()->back()->with('error', 'Biên bản đã được gửi lên Phòng Công Tác Chính Trị!');
        }
        
        $bienBanSHCN->trang_thai = BienBanStatus::CTCT;
        $bienBanSHCN->save();

        return redirect()->back()->with('success', 'Gửi biên bản SHCN đến Khoa thành công!');
    }
    
    public function CTCT_Manage(Request $request)
    {
        $lops = Lop::orderBy('id', 'desc')->get();

        $query = BienBanSHCN::where('trang_thai', BienBanStatus::CTCT)
            ->orderBy('id_tuan', 'desc');

        if ($request->filled('lop')) {
            $lopIds = is_array($request->lop) ? $request->lop : [$request->lop];
            $query->whereIn('id_lop', $lopIds);
        }

        $bienBanSHCN = $query->get();

        return view('admin.bienbanshcn.manage', compact('bienBanSHCN', 'lops'));
    }


}
