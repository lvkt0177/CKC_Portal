<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Acl\Acl;
use Auth;
use App\Http\Requests\TeacherLoginRequest;
use App\Http\Requests\StudentLoginRequest;
use App\Http\Requests\CapMatKhau\SinhVienYeuCauRequest;
use App\Http\Requests\CapMatKhau\UserResetPasswordRequest;
use App\Enum\LoaiTaiKhoan;
use App\Models\YeuCauCapLaiMatKhau;
use App\Models\User;
use App\Models\HoSo;
use App\Models\SinhVien;
use Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\GuiMatKhauMoi;
use App\Jobs\SendMailJob;
use Str;
use Carbon\Carbon;

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
                'redirect' => route('giangvien.portal.index'), 
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
                'redirect' => 'sinhvien/trang-chu', 
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
        $sinhVien = SinhVien::where('ma_sv', $request->validated('ma_sv'))->firstOrFail();
        $loai = $request->validated('loai');
        $matKhauMoi = null;
        
        if ($loai == 1) {
            $matKhauMoi = Str::random(8);
            $thongTin = $sinhVien->update([
                'password' => Hash::make($matKhauMoi),
            ]);
            $sinhVien->refresh();

            $thongTin = (object)[
                'ho_ten' => $sinhVien->hoSo->ho_ten,
                'email' => $sinhVien->hoSo->email,
            ];
    
            dispatch(new SendMailJob($thongTin, $matKhauMoi));
        }
        else {
            $yeuCauCapMatKhau = YeuCauCapLaiMatKhau::create([
                'id_sinh_vien' => $sinhVien->id,
                'loai' => $loai,
            ]);
        }
    
        $message = $loai == 0
            ? 'Yêu cầu cấp mật khẩu thành công. Chúng tôi sẽ liên hệ bạn qua Zalo để gửi mật khẩu.'
            : 'Yêu cầu cấp mật khẩu thành công. Mật khẩu sẽ sớm được gửi qua Email của bạn.';
    
        return redirect()->back()->with([
            'success' => [
                'message' => $message,
                'ma_sv' => $sinhVien->ma_sv,
                'ho_ten' => $sinhVien->hoSo->ho_ten,
                'loai' => LoaiTaiKhoan::from($loai)->getLabel(),
            ]
        ]);
    }

    public function userResetPasswordPost(UserResetPasswordRequest $request)
    {
        $hoSo = HoSo::where('email', $request->validated('email'))->firstOrFail();
        $user = User::where('id_ho_so', $hoSo->id)->first();
        if(!$user)
            return redirect()->back()->with('error', 'Email không tồn tại. Vui lòng kiểm tra lại email.');

        $newPassword = Str::random(8);
        
        $user->password = Hash::make($newPassword);
        $user->save();

        $userThongTin = (object)[
            'ho_ten' => $hoSo->ho_ten ?? 'Người dùng',
            'email' => $hoSo->email,
        ];

        dispatch(new SendMailJob($userThongTin, $newPassword));

        return redirect()->back()->with('success', 'Mật khẩu mới đã được gửi qua email. Vui lòng kiểm tra.');
    }
    
   

}