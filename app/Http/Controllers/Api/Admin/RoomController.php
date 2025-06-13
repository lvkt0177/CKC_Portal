<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Phong;
use App\Http\Requests\Phong\StorePhongRequest;
use App\Http\Requests\Phong\UpdatePhongRequest;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Phong::orderBy('id', 'desc')->get();

        return response()->json([
            'success' => true,
            'rooms' => $rooms
        ]);
    }

    public function store(StorePhongRequest $request)
    {
        $phong = Phong::create($request->validated());

        if (!$phong) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể tạo phòng. Vui lòng thử lại.'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Phòng đã được tạo thành công.',
            'room' => $phong
        ]);
    }

    public function show(Phong $phong)
    {
        return response()->json([
            'success' => true,
            'room' => $phong
        ]);
    }

    public function update(UpdatePhongRequest $request, Phong $phong)
    {
        if ($phong->update($request->validated())) {
            return response()->json([
                'success' => true,
                'message' => 'Phòng đã được cập nhật thành công.',
                'room' => $phong
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Không thể cập nhật phòng. Vui lòng thử lại.'
        ], 500);
    }
}
