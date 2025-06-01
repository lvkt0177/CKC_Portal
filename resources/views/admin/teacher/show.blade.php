@extends('admin.layouts.app')

@section('title', 'Chỉnh sửa Giảng Viên')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Thông tin Giảng Viên - {{ $user->hoSo->ho_ten }}</h3>
                        <a href="{{ route('admin.giangvien.index') }}" class="btn btn-primary">Quay lại</a>
                    </div>

                    <div class="card-body">
                        <div class="row g-4">
                            <!-- Account Management Section -->
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="text-center mb-4">
                                            <div class="position-relative d-inline-block">
                                                <img src="{{ asset('' . $user->hoSo->anh) }}" alt="Profile"
                                                    class="img-fluid rounded"
                                                    style="width: 300px; height: 300px; object-fit: cover;">

                                            </div>
                                            <div class="mt-3">
                                                <button class="btn btn-outline-secondary text-dark btn-sm">Thay đổi
                                                    ảnh</button>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="mb-3">
                                            {{-- Danh sách tất cả vai trò --}}
                                            @if ($user->getRoleNames()->isEmpty())
                                                <p class="text-secondary text-center">Chưa có vai trò nào</p>
                                            @else
                                            <div class="">
                                                <h6 class="text-secondary text-center text-capitalize fs-1">{{ $user->getRoleNames()->first() }}</h6>
                                                
                                            </div>
                                            @endif

                                            @if ($user->getRoleNames()->first() != Acl()::ROLE_SUPER_ADMIN)

                                                <form action="" method="post" class="text-capitalize">
                                                    @csrf
                                                    <label class="form-label text-secondary">Chọn vai trò</label>
                                                    <select name="role" class="form-control">
                                                        <option value="" class="text-capitalize" selected disabled>Chọn vai trò</option>
                                                        @foreach ($roles as $role)
                                                            @if($role->name != Acl()::ROLE_SUPER_ADMIN)
                                                                <option value="{{ $role->name }}" class="text-capitalize"
                                                                    {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                                    {{ $role->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <button class="btn btn-primary w-100 mt-3">Gắn Vai Trò</button>
                                                </form>
                                            @endif

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Profile Information Section -->
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Left Column -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label text-secondary">Họ tên</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $user->hoSo->ho_ten }}" style="pointer-events: none">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label text-secondary">Tài khoản</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $user->tai_khoan }}" style="pointer-events: none">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label text-secondary">Giới tính</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $user->hoSo->gioi_tinh }}" style="pointer-events: none">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label text-secondary">Ngày sinh</label>
                                                    <input type="date" class="form-control"
                                                        value="{{ $user->hoSo->ngay_sinh }}" style="pointer-events: none">
                                                </div>
                                            </div>

                                            <!-- Right Column -->
                                            <div class="col-md-6">

                                                <div class="mb-3">
                                                    <label class="form-label text-secondary">Khoa</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $user->boMon->nganhHoc->khoa->ten_khoa }}"
                                                        style="pointer-events: none">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label text-secondary">Email</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $user->hoSo->email }}" style="pointer-events: none">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label text-secondary">CCCD</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $user->hoSo->cccd }}" style="pointer-events: none">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label text-secondary">Địa chỉ</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $user->hoSo->dia_chi }}" style="pointer-events: none">
                                                </div>




                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
