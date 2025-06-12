@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/portal.css') }}">
@endsection

@section('content')
    <div class="main-container" >
        <!-- Thông tin sinh viên -->
        <div class="user-info-card" style="100vh">
            <h4 class="mb-4">Thông tin người dùng</h4>
            <div class="d-flex align-items-start">
                <img src="{{ asset('' . auth()->user()->hoSo->anh) }}" alt="Avatar" class="user-avatar">
                <div class="user-details flex-grow-1">
                    <div class="row">
                        <div class="col-md-6 stats-card my-1 col-sm-12">
                            <div class="info-row">
                                <span class="info-label">Họ tên:</span>
                                <span class="info-value">{{ auth()->user()->hoSo->ho_ten }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Giới tính:</span>
                                <span class="info-value">{{ auth()->user()->hoSo->gioi_tinh }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Ngày sinh:</span>
                                <span class="info-value">{{ auth()->user()->hoSo->ngay_sinh }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Email:</span>
                                <span class="info-value">{{ auth()->user()->hoSo->email }}</span>
                            </div>
                            
                        </div>
                        <div class="col-md-6 col-sm-12 my-1">
                            <div class="stats-card">
                                <div class="stats-label">Lịch dạy trong tuần</div>
                                <div class="stats-number text-primary">0</div>
                                <a href="#" class="stats-link">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>

        <!-- Thống kê nhanh -->
        <div class="row mb-4">
            <div class="col-md-4 my-1">
                <div class="stats-card">
                    <div class="stats-label">Nhắc nhở mới, chưa xem</div>
                    <div class="stats-number text-primary">0</div>
                    <a href="#" class="stats-link">Xem chi tiết</a>
                </div>
            </div>
            <div class="col-md-4 my-1">
                <div class="stats-card reminder-card">
                    <div class="stats-label">...</div>
                    <div class="stats-number">0</div>
                    <a href="#" class="stats-link">Xem chi tiết</a>
                </div>
            </div>
            <div class="col-md-4 my-1">
                <div class="stats-card study-card">
                    <div class="stats-label">...</div>
                    <div class="stats-number">0</div>
                    <a href="#" class="stats-link">Xem chi tiết</a>
                </div>
            </div>
        </div>

        <!-- Chức năng -->
        <div class="function-grid">
            <div class="function-card">
                <div class="function-icon">
                    <i class="fa-solid fa-table"></i>
                </div>
                <div class="function-label">Quản lý lớp</div>
            </div>
            <div class="function-card">
                <div class="function-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="function-label">...</div>
            </div>
            <div class="function-card">
                <div class="function-icon">
                    <i class="fas fa-layer-group"></i>
                </div>
                <div class="function-label">...</div>
            </div>
            <div class="function-card">
                <div class="function-icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="function-label">...</div>
            </div>
            <div class="function-card">
                <div class="function-icon">
                    <i class="fas fa-credit-card"></i>
                </div>
                <div class="function-label">...</div>
            </div>
            <div class="function-card">
                <div class="function-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="function-label">...</div>
            </div>
            <div class="function-card">
                <div class="function-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="function-label">...</div>
            </div>
            
        </div>
    </div>
@endsection
