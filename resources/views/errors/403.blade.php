@extends('admin.layouts.app')

@section('title', 'Không có quyền truy cập')

@section('content')
    <div style="text-align: center; padding: 100px;height: 80vh;">
        <h1>Không có quyền truy cập</h1>
        <p>Bạn không có quyền để truy cập vào trang này. Vui lòng liên hệ với người quản lý.</p>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Quay lại trang chính</a>
    </div>
@endsection
