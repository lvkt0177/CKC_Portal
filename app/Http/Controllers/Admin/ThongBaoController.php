<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ThongBao;
use App\Models\File;
use App\Acl\Acl;
use App\Models\User;
use App\Models\HoSo;
use App\Models\SinhVien;
use App\Models\ChiTietThongBao;
use App\Models\BinhLuan;
use App\Models\Lop;
use App\Repositories\ThongBao\ThongBaoRepository;
use App\Enum\ThongBaoStatus;
use App\Enum\CapTren;
use App\Http\Requests\ThongBao\ThongBaoRequestAPI;
use App\Http\Requests\ThongBao\SendToStudentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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

        $thongBaos->load('chiTietThongBao.sinhVien');

        foreach ($thongBaos as $thongbao) {
            $lopIds = collect($thongbao->chiTietThongBao)
                        ->pluck('sinhVien.id_lop')
                        ->filter()
                        ->unique();

            $thongbao->ds_lops = Lop::whereIn('id', $lopIds)->get();
        }

        $lops = Lop::orderBy('id', 'desc')->get();
        return view('admin.thongbao.index', compact('thongBaos', 'lops'));
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
    public function store(ThongBaoRequestAPI $request)
    {
        $thongBao = $this->thongBaoRepository->create($request->all());
        
        if($thongBao){
            return redirect()->route('giangvien.thongbao.index')->with('success', 'Tạo thông báo thành công');
        }
        return redirect()->route('giangvien.thongbao.index')->with('error', 'Tạo thông báo thất bại');
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
        return view('admin.thongbao.show', compact('thongbao'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ThongBao $thongbao)
    {
        $capTren = CapTren::cases();
        $thongbao->load('giangVien.hoSo','file');
       return view('admin.thongbao.edit', compact('thongbao', 'capTren'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ThongBaoRequest $request, ThongBao $thongbao)
    {
        $thongbao = $this->thongBaoRepository->update($thongbao, $request->all());
        if($thongbao){
            return redirect()->route('giangvien.thongbao.index')->with('success', 'Cập nhật thông báo thành cong');
        }
        return redirect()->route('giangvien.thongbao.index')->with('error', 'Cập nhật thông báo thất bại');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Thongbao $thongbao)
    {
        $result = $this->thongBaoRepository->destroy($thongbao);

        if ($result) {
            return redirect()->route('giangvien.thongbao.index')->with('success', 'Xoá thông báo thành công');
        }
        return redirect()->route('giangvien.thongbao.index')->with('error', 'Xoá thông báo thất bại');
    }

    public function destroyFile(int $id)
    {
        $file = File::find($id);
        Storage::disk('public')->delete($file->url);
        $file->delete();
    
        return response()->json(['success' => true, 'message' => 'Xoá thành công']);
    }

    public function download($id)
    {
        $file = File::findOrFail($id);
        return response()->download(storage_path('app/public/' . $file->url), $file->ten_file);
    }

    public function sendToStudent(SendToStudentRequest $request, ThongBao $thongbao)
    {
        $data = $request->validated();

        foreach($data['lop_ids'] as $lop_id){
            $lop = Lop::find($lop_id);
                    
            foreach ($lop->sinhViens as $sinhvien) {
                ChiTietThongBao::firstOrCreate([
                    'id_thong_bao' => $thongbao->id,
                    'id_sinh_vien' => $sinhvien->id,
                ], [
                    'trang_thai' => 0,
                ]);
            }
        }
        $result = $this->thongBaoRepository->update($thongbao, ['trang_thai' => 1]);


        if (!$result) {
            return redirect()->route('giangvien.thongbao.index')->with('error', 'Gửi thông báo tới sinh viên thất bại');
        }

        return redirect()->route('giangvien.thongbao.index')->with('success', 'Gửi thông báo tới sinh viên thành công');
    }
}
