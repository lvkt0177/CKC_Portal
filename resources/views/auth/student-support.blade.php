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
        <form action="{{ route('sinh-vien.yeu-cau-cap-mat-khau') }}" method="POST">
            @csrf
            <div class="form-group mb-2">
                <input type="text" name="ma_sv" class="form-control @error('ma_sv') border-danger text-dark @enderror" placeholder="Mã sinh viên" >
                <i class="fas fa-user input-icon"></i>
            </div>
            @error('ma_sv')
                <span class="text-danger m-0 mb-3">{{ $message }}</span>
            @enderror

            <div class="form-group mb-2">
                <select class="form-control" name="loai" id="loai">
                    <option>Chọn loại tài khoản</option>
                    <option value="0">Email</option>
                    <option value="1">Portal</option>
                </select>
                <i class="fa-solid fa-address-book input-icon"></i>
            </div>
            @error('loai')
                <span class="text-danger m-0 mb-3">{{ $message }}</span>
            @enderror

            {{-- success --}}
            @if (session('success'))
                <div class="alert alert-success">
                    <strong>{{ session('success')['message'] }}</strong><br>
                    <strong>- Mã sinh viên:</strong> {{ session('success')['ma_sv'] }}<br>
                    <strong>- Ho_ten:</strong> {{ session('success')['ho_ten'] }} <br>
                    <strong>- Loại tài khoản:</strong> {{ session('success')['loai'] }}
                </div>
            @endif

            {{-- error --}}
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <button type="submit" class="login-btn mt-2">
                <i class="fas fa-sign-in-alt me-2"></i>Gửi
            </button>
        </form>

        <div class="form-links">
            <a href="{{ route('login') }}">Quay lại</a>
        </div>
    </div>
@endsection