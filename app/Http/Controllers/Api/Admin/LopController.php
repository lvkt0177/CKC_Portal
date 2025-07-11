<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lop;
use App\Models\SinhVien;
use App\Models\Nam;
use App\Models\DanhSachSinhVien;
use App\Models\DiemRenLuyen;
use App\Http\Requests\GiangVien\NhapDiemRequest;
use App\Http\Requests\GiangVien\NhapDiemRenLuyenRequest;
use Illuminate\Support\Facades\Auth;

class LopController extends Controller
{
    public function index()
    {
        $lops = Lop::with('giangVien', 'nienKhoa', 'giangVien.boMon.chuyenNganh')
            ->where('id_gvcn', auth()->id())
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'data' => $lops
        ]);
    }

 public function list(Lop $lop)
{
    $sinhViens = DanhSachSinhVien::with('sinhVien.hoSo')
        ->where('id_lop', $lop->id)
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'id_lop' => $item->id_lop,
                'id_sinh_vien' => $item->id_sinh_vien,
                'chuc_vu' => $item->chuc_vu, 
                'sinh_vien' => $item->sinhVien,
            ];
        });

    return response()->json([
        'lop' => $lop,
        'sinh_viens' => $sinhViens,
    ]);
}


    public function nhapDiemRL(Request $request, Lop $lop)
    {
        $thang = $request->get('thoi_gian', now()->month);
        $nam =  $request->get('nam', now()->year);

        $sinhViens = SinhVien::with([
    'hoSo',
    'danhSachSinhVien.lop.nienKhoa',
    'danhSachSinhVien.lop.giangVien',
    'diemRenLuyens' => function ($query) use ($thang, $nam) {
        $query->where('thoi_gian', $thang)
            ->whereHas('nam', function ($q) use ($nam) {
                $q->where('nam_bat_dau', $nam);
            });
    }
    ])
    ->whereHas('danhSachSinhVien', function ($query) use ($lop) {
        $query->where('id_lop', $lop->id);
    })
    ->orderBy('ma_sv', 'asc')
    ->get();


        return response()->json([
            'lop' => $lop,
            'thoi_gian' => $thang,
            'sinh_viens' => $sinhViens
        ]);
    }

    // Cập nhật điểm rèn luyện
    public function capNhatDiemRL(NhapDiemRequest $request)
    {
        $data = $request->validated();
        $data['id_gvcn'] = auth()->id();

        DiemRenLuyen::updateOrCreate(
            [
                'id_sinh_vien' => $data['id_sinh_vien'],
                'thoi_gian' => $data['thoi_gian'],
            ],
            $data
        );

        return response()->json([
            'message' => 'Cập nhật điểm thành công!'
        ]);
    }

    public function capNhatDiemChecked(NhapDiemRenLuyenRequest $request)
    {   
        $data = $request->validated();
        $data['selected_students'] = json_decode($request->selected_students, true);
        $data['id_gvcn'] = auth()->id();

        $nam = Nam::where('nam_bat_dau', $data['nam'])->first();
        if (!$nam) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy năm học phù hợp!',
            ], 404);
        }

        $data['id_nam'] = $nam->id;

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

        return response()->json([
            'status' => true,
            'message' => 'Cập nhật điểm thành công!',
        ]);
    }



}
