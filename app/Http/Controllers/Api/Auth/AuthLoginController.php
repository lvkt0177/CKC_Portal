<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TeacherLoginRequest;
use App\Http\Requests\StudentLoginRequest;
use App\Models\User;
use App\Models\SinhVien;
use App\Models\HoSo;
use App\Models\YeuCauCapLaiMatKhau;
use App\Mail\GuiMatKhauMoi;
use App\Jobs\SendMailJob;
use App\Enum\LoaiTaiKhoan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthLoginController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('tai_khoan', $request->tai_khoan)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Tài khoản hoặc mật khẩu không đúng'], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        $user = User::with('hoSo','roles.permissions')->where('tai_khoan', $request->tai_khoan)->first();
        
        return response()->json([
            'token' => $token,
            'user' => $user,
            'message' => 'Đăng nhập thành công',
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Đăng xuất thành công',
        ]);
    }

    public function studentLogin(StudentLoginRequest $request)
    {
        $sinhVien = SinhVien::where('ma_sv', $request->ma_sv)->first();

        if (!$sinhVien || !Hash::check($request->password, $sinhVien->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Tài khoản hoặc mật khẩu không đúng.',
            ], 401);
        }
    
        $token = $sinhVien->createToken('student_token')->plainTextToken;
    
        $sinhVien->load('hoSo', 'lop');
    
        return response()->json([
            'success' => true,
            'message' => 'Đăng nhập thành công',
            'token' => $token,
            'sinh_vien' => $sinhVien,
        ]);
    }


    public function studentLogout(Request $request)
    {
        $user = $request->user(); 
        $user->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Đăng xuất thành công.',
        ]);
    }
    public function sinhVienYeuCauCapMatKhau(SinhVienYeuCauRequest $request)
    {
        $sinhVien = SinhVien::where('ma_sv', $request->validated('ma_sv'))->firstOrFail();
        $loai = $request->validated('loai');
        $matKhauMoi = null;

        if ($loai == 1) {
            $matKhauMoi = Str::random(8);
            $sinhVien->update([
                'password' => Hash::make($matKhauMoi),
            ]);
            $sinhVien->refresh();

            $thongTin = (object)[
                'ho_ten' => $sinhVien->hoSo->ho_ten,
                'email' => $sinhVien->hoSo->email,
            ];

            dispatch(new SendMailJob($thongTin, $matKhauMoi));
        } else {
            YeuCauCapLaiMatKhau::create([
                'id_sinh_vien' => $sinhVien->id,
                'loai' => $loai,
            ]);
        }

        $message = $loai == 0
            ? 'Yêu cầu cấp mật khẩu thành công. Chúng tôi sẽ liên hệ bạn qua Zalo để gửi mật khẩu.'
            : 'Yêu cầu cấp mật khẩu thành công. Mật khẩu sẽ sớm được gửi qua Email của bạn.';

        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => [
                'ma_sv' => $sinhVien->ma_sv,
                'ho_ten' => $sinhVien->hoSo->ho_ten,
                'email' => $sinhVien->hoSo->email,
                'loai' => LoaiTaiKhoan::from($loai)->getLabel(),
            ],
        ]);
    }

    public function userResetPasswordPost(UserResetPasswordRequest $request)
    {
        $hoSo = HoSo::where('email', $request->validated('email'))->first();

        if (!$hoSo) {
            return response()->json([
                'success' => false,
                'message' => 'Email không tồn tại. Vui lòng kiểm tra lại.',
            ], 404);
        }

        $user = User::where('id_ho_so', $hoSo->id)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy tài khoản tương ứng với email.',
            ], 404);
        }

        $newPassword = Str::random(8);
        $user->password = Hash::make($newPassword);
        $user->save();

        $userThongTin = (object)[
            'ho_ten' => $hoSo->ho_ten ?? 'Người dùng',
            'email' => $hoSo->email,
        ];

        dispatch(new SendMailJob($userThongTin, $newPassword));

        return response()->json([
            'success' => true,
            'message' => 'Mật khẩu mới đã được gửi qua email.',
            'data' => [
                'ho_ten' => $userThongTin->ho_ten,
                'email' => $userThongTin->email,
            ]
        ]);
    }


}
