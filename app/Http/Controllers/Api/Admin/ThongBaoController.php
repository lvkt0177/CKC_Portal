<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ThongBao;
use App\Models\File;
use App\Models\ChiTietThongBao;
use App\Models\Lop;
use App\Repositories\ThongBao\ThongBaoRepository;
use App\Http\Requests\ThongBao\ThongBaoRequestAPI;
use App\Http\Requests\ThongBao\ThongBaoRequest;

use App\Http\Requests\ThongBao\SendToStudentRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\BinhLuan;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BinhLuan\BinhLuanStoreRequestAPI;

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
    $thongBaos->load('file');

    $result = $thongBaos->map(function ($thongbao) {
        $data = $thongbao->toArray();

        $data['file'] = $thongbao->file->map(function ($f) {
            return [
                'id' => $f->id,
                'ten_file' => $f->ten_file,
                'url' => $f->url,
            ];
        });

        return $data;
    });

    return response()->json([
        'status' => 'success',
        'data' => $result
    ]);
}


    public function prepareCreateData()
    {
        $capTren = CapTren::cases();
    
        return response()->json([
            'cap_tren' => collect($capTren)->map(fn($c) => [
                'name' => $c->name,
                'value' => $c->value,
            ])
        ]);
    }

    public function store(ThongBaoRequestAPI $request)
    {
        $data = $request->validated();
        if(empty($data['ngay_gui']))
        {
            $data['ngay_gui'] = now();
        }

        $thongBao = $this->thongBaoRepository->create($data);

        if ($thongBao) {
            return response()->json([
                'message' => 'Tạo thông báo thành công',
                'data' => $thongBao
            ]);
        }

        return response()->json([
            'message' => 'Tạo thông báo thất bại'
        ], 500);
    }

   public function show(ThongBao $thongbao)
{
    $thongbao->load([
        'binhLuans' => function ($q) {
            $q->whereNull('id_binh_luan_cha')
                ->with(['nguoiBinhLuan.hoSo', 'binhLuanCon.nguoiBinhLuan.hoSo'])
                ->orderBy('created_at', 'desc');
        },
        'file'
    ]);

    $data = $thongbao->toArray();
    $data['file'] = $thongbao->file->map(function ($f) {
        return [
            'id' => $f->id,
            'ten_file' => $f->ten_file,
            'url' => $f->url,
        ];
    });

    return response()->json([
        'data' => $data
    ]);
}


    public function edit(ThongBao $thongbao)
    {
        return response()->json([
            'message' => 'Not supported via API.'
        ], 405);
    }
    public function update(Request $request, ThongBao $thongbao)
    {
        $validated = $request->validate([
            'tieu_de' => 'required|string|max:255',
            'noi_dung' => 'required|string',
            'tu_ai' => 'required|string',
            'ngay_gui' => 'required|date',
            'files.*' => 'mimes:doc,docx,xls,xlsx,pdf|max:10240',
            'old_files' => 'nullable|string',
        ]);

        $thongbao->update([
            'tieu_de' => $validated['tieu_de'],
            'noi_dung' => $validated['noi_dung'],
            'tu_ai' => $validated['tu_ai'],
            'ngay_gui' => $validated['ngay_gui'],
            'trang_thai' => $request->input('trang_thai'),
        ]);

        $oldFiles = json_decode($validated['old_files'] ?? '[]', true);
        $currentFileIds = $thongbao->file()->pluck('id')->toArray();
        $fileToDelete = array_diff($currentFileIds, $oldFiles);
        foreach ($fileToDelete as $id) {
            $file = File::find($id);
            if ($file) {
                Storage::disk('public')->delete($file->url);
                $file->delete();
            }
        }

    if ($request->file('files')) {

            foreach ($request->file('files') as $file) {
                $path = $file->store('thongbao', 'public');
                $thongbao->file()->create([
                    'ten_file' => $file->getClientOriginalName(),
                    'url' => $path,
                ]);
            }
        }

        return response()->json([
            'message' => 'Cập nhật thông báo thành công',
            'data' => $thongbao->load('file'),
        ]);
    }


    public function destroy(ThongBao $thongbao)
    {
        $result = $this->thongBaoRepository->destroy($thongbao);

        if ($result) {
            return response()->json(['message' => 'Xoá thông báo thành công']);
        }

        return response()->json(['message' => 'Xoá thông báo thất bại'], 500);
    }

    public function destroyFile(int $id)
    {
        $file = File::find($id);

        if ($file) {
            Storage::disk('public')->delete($file->url);
            $file->delete();

            return response()->json(['message' => 'Xoá file thành công']);
        }

        return response()->json(['message' => 'Không tìm thấy file'], 404);
    }

    public function download($id)
    {
        $file = File::findOrFail($id);

        $path = storage_path('app/public/' . $file->url);
        if (!file_exists($path)) {
            return response()->json(['message' => 'File không tồn tại'], 404);
        }

        return response()->download($path, $file->ten_file);
    }
    public function sendToStudent(SendToStudentRequest $request, ThongBao $thongbao)
    {
        $data = $request->validated();
        foreach($data['lop_ids'] as $lop_id){
            $lop = Lop::find($lop_id);
            $lop->load('danhSachSinhVien');
            foreach ($lop->danhSachSinhVien as $sinhvien) {

                ChiTietThongBao::firstOrCreate([
                    'id_thong_bao' => $thongbao->id,
                    'id_sinh_vien' => $sinhvien->id_sinh_vien,
                ], [
                    'trang_thai' => 0,
                ]);
            }
        }
        $result = $this->thongBaoRepository->update($thongbao, ['trang_thai' => 1]);

        if (!$result) {
            return response()->json([
                'message' => 'Gửi thông báo tới sinh viên thất bại'
            ], 500);
        }

        return response()->json([
            'message' => 'Gửi thông báo tới sinh viên thành công'
        ]);
    }

    // Comment
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
        $binhLuan->delete();
        return response()->json(['message' => 'Xoá bình luận thành công']);
    }
}