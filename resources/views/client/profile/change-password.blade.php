@extends('client.layouts.app')

@section('title', 'Sinh viên đổi mật khẩu')

@section('css')
    <style>
        .form-change-password {
            margin: auto;
            background-color: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .form-change-password .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }
    </style>
@endsection

@section('content')
    <div class="form-change-password mt-5">
        <h5 class="mb-4 text-center">Đổi mật khẩu</h5>
        <form method="POST" action="{{ route('sinhvien.ho-so.doi-mat-khau.post') }}" data-confirm>
            @csrf

            <div class="mb-3">
                <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                <input type="password" class="form-control" id="current_password" name="current_password" >
                @error('current_password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="new_password" class="form-label">Mật khẩu mới</label>
                <input type="password" class="form-control" value="{{ old('new_password') }}" id="new_password" name="new_password" >
                <span class="form-text text-muted"><i class="fa fa-info-circle" aria-hidden="true"></i> Mật khẩu phải có ít nhất 8 ký tự, gồm chữ, số và ký tự đặc biệt.</span>
                <div class="m-0">
                    @error('new_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="new_password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                <input type="password" class="form-control" value="{{ old('new_password_confirmation') }}" id="new_password_confirmation" name="new_password_confirmation"
                    >
                @error('new_password_confirmation')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="d-grid">
                @if (session('success'))
                    <button type="submit" class="btn btn-success">Cập nhật mật khẩu</button>
                @elseif ($errors->has('current_password') || $errors->has('new_password') || $errors->has('new_password_confirmation'))
                    <button type="submit" class="btn btn-danger">Cập nhật mật khẩu</button>
                @else
                    <button type="submit" class="btn btn-primary">Cập nhật mật khẩu</button>
                @endif
            
            </div>
        </form>
    </div>
@endsection
