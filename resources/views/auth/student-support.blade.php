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
            Liên hệ Phòng CTCT 
        </button>
    </div>

    <!-- Form Sinh Viên -->
    <div class="form-section active" id="studentForm">
        <form>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Mã sinh viên" required>
                <i class="fas fa-user input-icon"></i>
            </div>

            <button type="submit" class="login-btn">
                <i class="fas fa-sign-in-alt me-2"></i>Gửi
            </button>
        </form>

        <div class="form-links">
            <a href="{{ route('login') }}">Quay lại</a>
        </div>
    </div>

    <!-- Form Giảng Viên -->
   
@endsection
