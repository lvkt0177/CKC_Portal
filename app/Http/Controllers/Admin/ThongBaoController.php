<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ThongBao;
use APp\Models\File;
use App\Acl\Acl;
use App\Models\User;
use App\Models\HoSo;
use App\Models\SinhVien;
use App\Models\Lop;
use App\Repositories\ThongBao\ThongBaoRepository;
use App\Enum\ThongBaoStatus;
use App\Enum\CapTren;
use App\Http\Requests\ThongBao\ThongBaoRequest;

class ThongBaoController extends Controller
{
    public function __construct(
        protected ThongBaoRepository $thongBaoRepository
    ) {
        //
    }

    public function index()
    {
        $thongBaos = $this->thongBaoRepository->all();
        $thongBaos->load('giangVien.hoSo');
        // dd($thongBaos);
        return view('admin.thongbao.index', compact('thongBaos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $capTren = CapTren::cases();
        return view('admin.thongbao.create', compact('capTren'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ThongBaoRequest $request)
    {
        $thongBao = $this->thongBaoRepository->create($request->all());
        
        if($thongBao){
            return redirect()->route('admin.thongbao.index')->with('success', 'Tạo thông báo thành công');
        }
        return redirect()->route('admin.thongbao.index')->with('error', 'Tạo thông báo thất bại');
    }

    /**
     * Display the specified resource.
     */
    public function show(ThongBao $bienBanSHCN)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ThongBao $thongbao)
    {
        $capTren = CapTren::cases();
        $thongbao->load('giangVien.hoSo');
       return view('admin.thongbao.edit', compact('thongbao', 'capTren'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ThongBaoRequest $request, ThongBao $thongbao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Thongbao $thongbao)
    {
        //
    }
}
