<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ThongBao;
use App\Models\ChiTietThongBao;
use App\Models\SinhVien;
use App\Models\User;
use App\Models\HoSo;
use App\Models\Lop;
use Auth;
use App\Repositories\ThongBao\ThongBaoRepository;
use Illuminate\Support\Facades\Log;
use App\Enum\DocThongBao;
use App\Models\BinhLuan;
use App\Http\Requests\BinhLuan\BinhLuanStoreRequestAPI;

class ThongBaoController extends Controller
{
    public function __construct(
        protected ThongBaoRepository $thongBaoRepository
    ) {
        //
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $thongbaos = $this->thongBaoRepository->thongBaoSinhVien(Auth::user()->id);
        $thongbaos->load('binhLuans.nguoiBinhLuan.hoSo');
        return response()->json([
            'status' => 'success',
            'data' => $thongbaos
        ]);
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
    public function show(ThongBao $thongbao)
    {
        ChiTietThongBao::where('id_thong_bao', $thongbao->id)
            ->where('id_sinh_vien', Auth::guard('student')->user()->id)
            ->where('trang_thai', '!=', DocThongBao::DADOC)
            ->update(['trang_thai' => DocThongBao::DADOC]);

        $thongbao->load([
            'binhLuans' => function ($q) {
                $q->whereNull('id_binh_luan_cha') 
                    ->with(['nguoiBinhLuan.hoSo', 'binhLuanCon.nguoiBinhLuan.hoSo'])
                    ->orderBy('created_at', 'desc'); 
            }
        ]);
        return view('client.thongbao.show', compact('thongbao'));
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

    public function storeComment(BinhLuanStoreRequestAPI $request, ThongBao $thongbao)
    {
        $data = $request->validated();

        $comment = BinhLuan::create([
            'id_thong_bao' => $thongbao->id,
            'noi_dung' => $data['noi_dung'],
            'id_binh_luan_cha' => $data['id_binh_luan_cha'] ?? null,
            'nguoi_binh_luan_id' => Auth::id(),
            'nguoi_binh_luan_type' => Auth::user()::class,
        ]);

        if (!$comment) {
            return response()->json(['message' => 'Tạo bình luận thất bại'], 500);
        }

        return response()->json([
            'message' => 'Tạo bình luận thành công',
            'data' => $comment->load('nguoiBinhLuan.hoSo'),
        ]);
    }

    public function destroyComment(BinhLuan $binhLuan)
    {
        if (Auth::id() !== $binhLuan->nguoi_binh_luan_id) {
            return response()->json(['message' => 'Không có quyền xoá'], 403);
        }

        $binhLuan->delete();

        return response()->json(['message' => 'Xoá bình luận thành công']);
    }
}
