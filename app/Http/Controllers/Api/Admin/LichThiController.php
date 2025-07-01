<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lop;
use App\Models\SinhVien;
use App\Models\User;
use App\Models\LichThi;
use App\Models\PhieuLenLop;
use App\Acl\Acl;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LichThi\LichThiStoreRequestAPI;
use App\Http\Requests\LichThi\LichThiUpdateRequestAPI;
use App\Services\LichThiService;

class LichThiController extends Controller
{
    public function index(){
        $lichThi = LichThi::with(['lopHocPhan', 'giamThi1', 'giamThi2', 'phong'])
            ->orderBy('ngay_thi', 'asc')
            ->get();

        return response()->json([
            'message' => 'Danh sách lịch thi',
            'data' => $lichThi
        ]);
    }

    public function store(LichThiStoreRequestAPI $request, LichThiService $service)
    {
        
        $data = $request->validated();

        if ($service->isTrungLich($data)) {
            return response()->json([
                'message' => 'Lịch thi bị trùng giờ với lịch thi khác. Vui lòng kiểm tra lại.',
            ], 422);
        }

        $lichThi = LichThi::create($data);

        if ($lichThi) {
            return response()->json([
                'message' => 'Lịch thi đã được tạo thành công.',
                'data' => $lichThi
            ], 201);
        }

        return response()->json([
            'message' => 'Không thể tạo lịch thi. Vui lòng thử lại sau.'
        ], 500);
    }

    public function update(LichThiUpdateRequestAPI $request, LichThiService $service, LichThi $lichThi)
    {
        $data = $request->validated();

        if (!$lichThi) {
            return response()->json([
                'message' => 'Lịch thi không tồn tại.'
            ], 404);
        }

        if ($service->isTrungLich($data, $lichThi->id)) {
            return response()->json([
                'message' => 'Lịch thi bị trùng giờ với lịch thi khác. Vui lòng kiểm tra lại.',
            ], 422);
        }

        $lichThi->update($data);

        return response()->json([
            'message' => 'Lịch thi đã được cập nhật thành công.',
            'data' => $lichThi
        ]);
    }
    
    public function destroy(LichThi $lichThi)
    {
        if (!$lichThi) {
            return response()->json([
                'message' => 'Lịch thi không tồn tại.',
            ], 404);
        }

        $lichThi->delete();

        return response()->json([
            'message' => 'Lịch thi đã được xóa thành công.'
        ]);
    }
  
}
