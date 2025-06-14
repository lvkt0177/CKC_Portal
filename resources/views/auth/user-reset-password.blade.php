@extends('auth.auth-layout')

@section('title', 'Đăng nhập - Hỗ trợ Sinh Viên')

@section('css')
    <style>
        .toggle-slider{
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="form-toggle">
        <div class="toggle-slider" id="toggleSlider"></div>
        <button class="toggle-btn active" onclick="switchForm('student')">
            Lấy lại mật khẩu 
        </button>
    </div>

    <!-- Form Sinh Viên -->
    <div class="form-section active" id="studentForm">
        <form action="{{ route('login.user-reset-password.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Nhâp email người dùng..." required>
                <i class="fas fa-user input-icon"></i>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    <strong>{{ session('success') }}</strong><br>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    <strong>{{ session('error') }}</strong><br>
                </div>
            @endif

            <button type="submit" class="login-btn">
                <i class="fas fa-sign-in-alt me-2"></i>Gửi
            </button>
        </form>

        <div class="form-links">
            <a href="{{ route('login') }}">Quay lại</a>
        </div>
    </div>
   
@endsection
