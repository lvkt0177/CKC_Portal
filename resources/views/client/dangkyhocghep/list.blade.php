@extends('client.layouts.app')

@section('title', 'Đăng Ký học ghép')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/client/css/danghoclop.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/lophocghep.css') }}">
@endsection

@section('content')
    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="header-section fade-in">
            <h1 class="page-title">
                <i class="fas fa-graduation-cap me-3"></i>
                Thông tin các lớp học ghép
            </h1>
            <p class="page-subtitle">Vui lòng kiểm tra kỹ thông tin cá nhân</p>
        </div>

        <!-- Statistics -->
        <div class="stats-container fade-in">
            <div class="row">
                <div class="col-md-12 col-6">
                    <div class="stat-item">
                        <span class="stat-number">{{ count($lopHocPhanDangMo) }}</span>
                        <span class="stat-label">Tổng số lớp</span>
                    </div>
                </div>
               
            </div>
        </div>

        <!-- Class Cards -->
        <div class="row" id="classContainer">

            @foreach ($lopHocPhanDangMo as $lop)
                
                <div class="col-lg-6 class-item" data-status="active">
                    <div class="class-card fade-in">
                        <div class="class-header">
                            <div class="class-name">{{ $lop->ten_hoc_phan }} - {{ $lop->lop->ten_lop }}</div>
                        </div>
                        <div class="class-body">
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Giảng viên</div>
                                    <div class="info-value">{{ $lop->giangVien->hoSo->ho_ten ?? 'Chưa có giáo viên dạy' }}</div>
                                </div>
                            </div>
                            
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="info-content">
                                    @php
                                        \Carbon\Carbon::setLocale('vi');
                                    @endphp
                                    <div class="info-label">Ngày bắt đầu học</div>
                                    @foreach ($dsThoiKhoaBieuDauTien as $tkb)
                                        <div class="info-value text-capitalize">
                                            {{ \Carbon\Carbon::parse($tkb->ngay)->translatedFormat('l') }},
                                            {{ \Carbon\Carbon::parse($tkb->ngay)->format('d-m-Y') }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                @foreach ($dsThoiKhoaBieuDauTien as $tkb)
                                    <div class="info-value text-capitalize">
                                        <div class="info-label">Phòng học</div>
                                        <div class="info-value">{{ $tkb->phong->ten }}</div>
                                    </div>
                                 @endforeach
                                
                            </div>
                            
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Sĩ số</div>
                                    <div class="info-value">{{ $lop->so_luong_sinh_vien }}</div>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Số lượng sinh viên học ghép đăng ký</div>
                                    <div class="info-value">{{ $lop->gioi_han_dang_ky }}</div>
                                </div>
                            </div>
                            
                            @if(!$checkDKHG)
                                <div class="text-center mt-3">
                                    <form action="{{ route('vnpay.payment.hoc-ghep', $lop   ) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_mon_hoc" value="{{ $monHoc->id }}">
                                        <input type="hidden" name="id_lop_hoc_phan" value="{{ $lop->id }}">
                                        <button class="status-badge status-active border-0">
                                            <span class="fs-6">
                                                Đăng ký
                                            </span>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('js')

@endsection
