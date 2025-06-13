<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Acl\Acl;
use Auth;
use App\Http\Requests\TeacherLoginRequest;
use App\Http\Requests\StudentLoginRequest;
use App\Http\Requests\CapMatKhau\SinhVienYeuCauRequest;
use App\Enum\LoaiTaiKhoan;
use App\Models\YeuCauCapLaiMatKhau;
use App\Models\User;
use App\Models\SinhVien;


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

    public function sinhVienYeuCauCapMatKhau(SinhVienYeuCauRequest $request)
    {
        $message = '';
        $sinhVien = SinhVien::where('ma_sv', $request->validated('ma_sv'))->first();
        $yeuCauCapMatKhau = YeuCauCapLaiMatKhau::create([
            'id_sinh_vien' => $sinhVien->id,
            'loai' => $request->validated('loai'),
        ]);

        if($request->validated('loai') == 0) 
            $message = 'Yêu cầu cấp mật khẩu thành công. Chúng tôi sẽ liên hệ bạn qua Zalo để gửi mật khẩu.';
        else
            $message = 'Yêu cầu cấp mật khẩu thành công. Mật khẩu sẽ sớm được gửi qua Email của bạn.';

        if($yeuCauCapMatKhau)
            return redirect()->back()->with([
                'success' => [
                    'message' => $message,
                    'ma_sv' => $sinhVien->ma_sv,
                    'ho_ten' => $sinhVien->hoSo->ho_ten,
                    'loai' => $yeuCauCapMatKhau->loai->getLabel(),
                ]
            ]
        );
        
        return redirect()->back()->with('error', 'Yêu cầu cấp mật khâu thất bại');
    }
   

}