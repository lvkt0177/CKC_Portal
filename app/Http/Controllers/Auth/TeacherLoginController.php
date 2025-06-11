<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Acl\Acl;
use Auth;
use App\Http\Requests\TeacherLoginRequest;

class TeacherLoginController extends Controller
{
    //
    public function index()
    {
        Auth::logout();
        return view('auth.login');
    }


    public function login(TeacherLoginRequest $request)
    {
        $credentials = $request->only('tai_khoan', 'password');
        // dd($credentials);
        if (Auth::attempt($credentials)) {

            return redirect()->intended('admin/portal');

        }
        
        return redirect()->back()->withErrors([
            'tai_khoan' => 'Tài khoản hoặc mật khẩu không đúng.',
        ]);
        
    }

    public function logout(Request $request)
    {
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
   

}