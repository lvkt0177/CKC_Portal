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
use App\Http\Requests\BienBan\BienBanRequest;
use Carbon\Carbon;

class BienBanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Lop $lop)
    {   
        $bienBanSHCN = BienBanSHCN::with('lop','thuky.hoSo','tuan','gvcn')
        ->where('id_lop', $lop->id)
        ->orderBy('id', 'asc')
        ->get();

        return view('admin.bienbanshcn.index', compact('bienBanSHCN', 'lop'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create(Lop $lop)
    {
        $thuKy = SinhVien::where('id_lop', $lop->id)->where('chuc_vu', RoleStudent::SECRETARY)->first();
        $tuans = Tuan::all();
        $sinhViens = SinhVien::where('id_lop', $lop->id)->get();


        return view('admin.bienbanshcn.create', compact('lop', 'thuKy', 'tuans','sinhViens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BienBanRequest $request, Lop $lop)
    {
        $bienBan = BienBanSHCN::create([
            'id_lop' => $lop->id,
            'id_sv' => SinhVien::where('id_lop', $lop->id)->where('chuc_vu', RoleStudent::SECRETARY)->first()->id ?? null,
            'id_gvcn' => User::find($lop->id_gvcn)->id,
            'id_tuan' => $request->validated('id_tuan'),
            'tieu_de' => $request->validated('tieu_de') . ' Tuần ' . Tuan::find($request->validated('id_tuan'))->tuan,
            'noi_dung' => $request->validated('noi_dung'),
            'thoi_gian_bat_dau' => Carbon::createFromFormat('Y-m-d\TH:i',$request->validated('thoi_gian_bat_dau')),
            'thoi_gian_ket_thuc' => Carbon::createFromFormat('Y-m-d\TH:i',$request->validated('thoi_gian_ket_thuc')),
            'so_luong_sinh_vien' => $request->validated('so_luong_sinh_vien'),
            'vang_mat' => $request->validated('vang_mat'),
        ]);
        
        if($bienBan) {
            $data = $request->validated('sinh_vien_vang');
            
            foreach($data as $id => $value) {

                $lyDo = $value['ly_do'] ?? 'Không';
                $loai = $value['loai'] ?? 0;

                ChiTietBienBanSHCN::create([
                    'id_bien_ban_shcn' => $bienBan->id,
                    'id_sinh_vien' => $id,
                    'ly_do' => $lyDo,
                    'loai' => $loai,
                ]);
            }

            return redirect()->route('admin.bienbanshcn.index', $bienBan->id_lop)->with('success', 'Biến bản tạo thành công.');
        }
        return redirect()->back()->with('error', 'Biến bản không tạo.');
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

        // dd($bienbanshcn);
        
        return view('admin.bienbanshcn.edit', ['thongTin' => $bienbanshcn]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
