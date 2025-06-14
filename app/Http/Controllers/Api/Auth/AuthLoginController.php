<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StudentLoginRequest;

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
        $credentials = $request->validated();

        if (Auth::guard('student')->attempt($credentials)) {
            $student = Auth::guard('student')->user();
            $student->load('hoSo','lop');

            $token = $student->createToken('student_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Đăng nhập thành công',
                'token' => $token,
                'student' => $student,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Tài khoản hoặc mật khẩu không đúng.',
        ], 401);
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


}
