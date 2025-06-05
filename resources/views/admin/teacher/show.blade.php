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
                                                <div class="d-flex flex-wrap gap-2 mt-3">
                                                    <div class="d-flex flex-wrap gap-2 mt-3 my-3">
                                                        @foreach ($user->getRoleNames() as $role)
                                                            <div class="d-flex align-items-center px-4 py-2 shadow-sm m-1"
                                                                style="
                                                                background-color: #0d6efd;
                                                                border-radius: 2rem;
                                                                font-size: 1.1rem;
                                                                font-weight: 500;
                                                                color: white;
                                                            ">
                                                                <span class="me-3">{{ $role }}</span>

                                                                <form
                                                                    action="{{ route('admin.roles.removeRoleForUser', $user) }}"
                                                                    method="POST" class="m-0 p-0">
                                                                    @csrf
                                                                    <input type="hidden" name="name"
                                                                        value="{{ $role }}">
                                                                    <button type="submit"
                                                                        class="btn p-0 px-2 text-white fw-bold"
                                                                        style="
                                                                        font-size: 1.2rem; 
                                                                        line-height: 1;
                                                                        background: transparent; 
                                                                        border: none;
                                                                    "
                                                                        title="Xoá vai trò {{ $role }}"
                                                                        onclick="return confirm('Bạn có chắc muốn xoá vai trò {{ $role }}?')">
                                                                        &times;
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif


                                            @if ($user->getRoleNames()->first() != Acl()::ROLE_SUPER_ADMIN)

                                                <form action="{{ route('admin.roles.addRoleForUser', $user) }}"
                                                    method="post" class="text-capitalize">
                                                    @csrf
                                                    <label class="form-label text-secondary">Chọn vai trò</label>
                                                    <select name="name" class="form-control">
                                                        <option value="" class="text-capitalize" selected disabled>
                                                            Chọn vai trò
                                                        </option>

                                                        @foreach ($roles as $role)
                                                            @if ($role->name != Acl()::ROLE_SUPER_ADMIN && !$user->hasRole($role->name))
                                                                <option value="{{ $role->name }}" class="text-capitalize">
                                                                    {{ $role->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>

                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                    <button
                                                        onclick="return confirm(`Bạn có chắc muốn gắn vai trò cho người dùng này? `)"
                                                        class="btn btn-primary w-100 mt-3">Gắn Vai Trò</button>
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
                                                        value="{{ $user->hoSo->gioi_tinh->getLabel()}}" style="pointer-events: none">
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
                                {{-- Danh sách các quyền  --}}
                                @if($user->roles->first())
                                <div class="col-md-12">
                                    <div class="card shadow-sm border-0 rounded-3">
                                        <div class="card-body">
                                            <h4 class="card-title mb-4 text-primary">
                                                <i class="fas fa-user-shield me-2"></i>Danh sách các quyền của vai trò
                                            </h4>
                                
                                            <div class="row">
                                                @php
                                                    $permissions = $user->roles->first()->permissions->values();
                                                    $half = ceil($permissions->count() / 2);
                                                @endphp
                                
                                                <div class="col-md-6">
                                                    <ul class="list-group list-group-flush">
                                                        @foreach ($permissions->slice(0, $half) as $permission)
                                                            <li class="list-group-item d-flex align-items-center py-2">
                                                                <i class="fas fa-check-circle text-success me-2"></i>
                                                                <span>{{ $permission->name }}</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                
                                                <div class="col-md-6">
                                                    <ul class="list-group list-group-flush">
                                                        @foreach ($permissions->slice($half) as $permission)
                                                            <li class="list-group-item d-flex align-items-center py-2">
                                                                <i class="fas fa-check-circle text-success me-2"></i>
                                                                <span>{{ $permission->name }}</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                @endif

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
