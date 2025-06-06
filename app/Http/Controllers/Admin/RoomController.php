<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Acl\Acl;
use App\Models\Phong;
use App\Http\Requests\Phong\StorePhongRequest;
use App\Http\Requests\Phong\UpdatePhongRequest;

class RoomController extends Controller
{
    //
    public function index()
    {
        $rooms = Phong::all();
        return view('admin.room.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.room.create');
    }

    public function store(StorePhongRequest $request)
    {
        $phong = Phong::create($request->validated());
        if (!$phong) {
            return redirect()->back()->with('error', 'Không thể tạo phòng. Vui lòng thử lại.');
        }

        return redirect()->route('admin.phong.index')->with('success', 'Phòng đã được tạo thành công.');
    }



    public function show(Phong $phong)
    {
        return view('admin.room.edit', compact('phong'));
    }

    public function update(UpdatePhongRequest $request, Phong $phong)
    {
        if ($phong->update($request->validated())) {
            return redirect()->route('admin.phong.index')->with('success', 'Phòng ' . $phong->ten . ' đã được cập nhật thành công.');
        }

        return redirect()->back()->with('error', 'Không thể cập nhật phòng. Vui lòng thử lại.');

    }


}