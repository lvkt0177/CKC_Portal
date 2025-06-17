<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Profile\ChangePasswordRequest;

class ProfileController extends Controller
{
    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();

        $user->update([
            'password' => Hash::make($request->validated('new_password')),
        ]);

        return response()->json([
            'message' => 'Mật khẩu đã được cập nhật thành công.',
            'status' => true,
        ]);
    }
}