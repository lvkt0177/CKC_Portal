<?php

namespace App\Http\Controllers\Client;

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
use App\Enum\ThongBaoStatus;


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
        $thongbaos = $this->thongBaoRepository->thongBaoSinhVien(Auth::guard('student')->user()->id);
        return view('client.thongbao.index', compact('thongbaos'));
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
}
