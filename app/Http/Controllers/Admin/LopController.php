<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lop;
use App\Models\User;
use App\Models\NienKhoa;
use App\Models\SinhVien;
use App\Models\HoSo;
use App\Models\Nam;
use App\Models\DiemRenLuyen;
use App\Http\Requests\GiangVien\NhapDiemRenLuyenRequest;
use Illuminate\Support\Facades\Auth;

class LopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lops = Lop::with('giangVien', 'nienKhoa', 'giangVien.boMon.nganhHoc')
            ->where('id_gvcn', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.class.index', compact('lops'));
    }
    public function list(Lop $lop)
    {
        $sinhViens = SinhVien::with(['hoSo', 'lop', 'lop.nienKhoa', 'lop.giangVien'])
            ->where('id_lop', $lop->id)
            ->orderBy('ma_sv', 'asc')->get();

        return view('admin.class.list', compact('sinhViens', 'lop'));
    }
    public function nhapDiemRL(Lop $lop)
    {
       
        $thang = request()->get('thoi_gian', now()->month); 
        $nam = request()->get('nam', now()->year);

        $sinhViens = SinhVien::with([
            'hoSo',
            'lop',
            'lop.nienKhoa',
            'lop.giangVien',
            'diemRenLuyens' => function ($query) use ($thang, $nam) {
            $query->where('thoi_gian', $thang)
                ->whereHas('nam', function ($q) use ($nam) {
                    $q->where('nam_bat_dau', $nam);
              });
    }
        ])
        ->where('id_lop', $lop->id)
        ->orderBy('ma_sv', 'asc')
        ->get();

            return view('admin.class.enter_point_rl', compact('sinhViens', 'thang','lop'));

    }

    public function capNhatDiemRL(NhapDiemRenLuyenRequest $request)
    {
        
        $data = $request->validated();
        $data['id_gvcn'] = auth()->id();
        $data['id_nam'] = Nam::where('nam_bat_dau', $data['nam'])->first()->id;
        DiemRenLuyen::updateOrCreate(
        [ 
            'id_sinh_vien' => $data['id_sinh_vien'],
            'thoi_gian' => $data['thoi_gian'],
            'id_nam'=> $data['id_nam'],
        ],
        $data
        );
        return back()->with('success', 'Cập nhật điểm thành công!');
    }
    public function capNhatDiemChecked(NhapDiemRenLuyenRequest $request)
    {   
        $data = $request->validated();
        $data['selected_students'] = json_decode($request->selected_students, true);
        // Lấy ID giáo viên chủ nhiệm
        $data['id_gvcn'] = auth()->id();

        // Lấy ID năm học từ năm bắt đầu
        $nam = Nam::where('nam_bat_dau', $data['nam'])->first();
        if (!$nam) {
            return back()->with('error', 'Không tìm thấy năm học phù hợp!');
        }
        $data['id_nam'] = $nam->id;

        // Lặp qua mảng sinh viên
        foreach ($data['selected_students'] as $id_sv) {
            DiemRenLuyen::updateOrCreate(
                [
                    'id_sinh_vien' => $id_sv,
                    'thoi_gian'    => $data['thoi_gian'],
                    'id_nam'       => $data['id_nam'],
                ],
                [
                    'id_gvcn'      => $data['id_gvcn'],
                    'xep_loai'     => $data['xep_loai'],
                ]
            );
        }

        return back()->with('success', 'Cập nhật điểm hàng loạt thành công!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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