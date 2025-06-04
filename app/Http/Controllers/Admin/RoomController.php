<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Acl\Acl;
use App\Models\Phong;
use App\Http\Requests\Phong\StorePhongRequest;

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

        if(!$phong) {
            return redirect()->back()->with('error', 'Không thể tạo phòng. Vui lòng thử lại.');
        }

        return redirect()->route('admin.room.index')->with('success', 'Phòng đã được tạo thành công.');
    }
    

    
}
