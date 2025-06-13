<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Acl\Acl;
use Auth;
use App\Http\Requests\TeacherLoginRequest;
use App\Http\Requests\StudentLoginRequest;

class AuthLoginController extends Controller
{
    //
    public function index(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return view('auth.login');
    }

    public function studentSupport()
    {
        return view('auth.student-support');
    }

    public function userResetPassword()
    {
        return view('auth.user-reset-password');
    }

    public function userLogin(TeacherLoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::guard('web')->attempt($credentials)) {
            return response()->json([
                'success' => true,
                'message' => 'Đăng nhập thành công',
                'redirect' => route('admin.portal.index'), 
            ]);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Tài khoản hoặc mật khẩu không đúng.',
        ], 401);
    }

    public function studentLogin(StudentLoginRequest $request)
    {
        $credentials = $request->validated();

        if(Auth::guard('student')->attempt($credentials)) {
            return response()->json([
                'success' => true,
                'message' => 'Đăng nhập thành công',
                'redirect' => 'sinhvien/home', 
            ]);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Tài khoản hoặc mật khẩu không đúng.',
        ], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function studentLogout(Request $request)
    {
        Auth::guard('student')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
   

}