<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Profile\ChangePasswordRequest;
use Auth;
use Hash;

class SecurityController extends Controller
{
    public function changePassword(ChangePasswordRequest $request)
    {
        $sinhVien = Auth::user();

        $sinhVien->password = Hash::make($request->new_password);
        $sinhVien->save();

        return response()->json([
            'success' => true,
            'message' => 'Đổi mật khẩu thành công'
        ]);
    }
}
