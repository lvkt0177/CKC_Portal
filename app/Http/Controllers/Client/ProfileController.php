<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Profile\ChangePasswordRequest;
use Auth;
use Hash;

class ProfileController extends Controller
{
    public function showChangePassword()
    {
        return view('client.profile.change-password');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $sinhVien = Auth::guard('student')->user();

        $sinhVien->password = Hash::make($request->new_password);
        $sinhVien->save();

        return redirect()->back()->with('success', 'Đổi mật khất thành công.');
    }
}
