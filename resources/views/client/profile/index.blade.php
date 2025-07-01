@extends('client.layouts.app')

@section('title', 'Thông tin sinh viên')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/client/css/thongtinsinhvien.css') }}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="student-card">
        <!-- Phần thông tin học vấn -->
        <div class="profile-section">
            <div class="text-center">
                <div class="">
                    <img src="{{ asset('' . Auth::guard('student')->user()->hoSo->anh) }}" alt="Student Photo" class="profile-image">
                </div>
                
                <div class="student-id mt-3">MSSV: {{ $sinhVien->ma_sv }}</div>
            </div>
            
            <div class="profile-info">
                <div class="student-name">{{ $sinhVien->hoSo->ho_ten }}</div>
                <div class="student-gender">Giới tính: {{ $sinhVien->hoSo->gioi_tinh->getLabel() }}</div>
                
                <h2 class="section-title">Thông tin học vấn</h2>
                
                <div class="info-grid">
                    <div>
                        <div class="info-item">
                            <span class="info-label">Trạng thái:</span>
                            <span class="info-value">Đang học</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Lớp học:</span>
                            <span class="info-value">{{ $sinhVien->lop->ten_lop }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Bậc đào tạo:</span>
                            <span class="info-value">Cao đẳng</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Khoa:</span>
                            <span class="info-value">{{ $sinhVien->lop->nganhHoc->khoa->ten_khoa  }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Khóa học:</span>
                            <span class="info-value">{{ $sinhVien->lop->nienKhoa->ten_nien_khoa }}</span>
                        </div>
                    </div>
                    
                    <div>
                        <div class="info-item">
                            <span class="info-label">Ngày vào trường:</span>
                            <span class="info-value">16/9/2022</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Cơ sở:</span>
                            <span class="info-value">Cơ sở 1 (Thành phố Hồ Chí Minh)</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Loại hình đào tạo:</span>
                            <span class="info-value">Tiến tiến</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Ngành:</span>
                            <span class="info-value">{{ $sinhVien->lop->nganhHoc->ten_nganh }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Phần thông tin cá nhân -->
        <h2 class="section-title">Thông tin cá nhân</h2>
        
        <div class="personal-info-grid">
            <div class="personal-info-item">
                <span class="personal-label">Ngày sinh:</span>
                <span class="personal-value">{{ $sinhVien->hoSo->ngay_sinh }}</span>
            </div>
            <div class="personal-info-item">
                <span class="personal-label">Dân tộc:</span>
                <span class="personal-value">Kinh</span>
            </div>
            <div class="personal-info-item">
                <span class="personal-label">Tôn giáo:</span>
                <span class="personal-value"></span>
            </div>
            <div class="personal-info-item">
                <span class="personal-label">Quốc tịch:</span>
                <span class="personal-value"></span>
            </div>
            <div class="personal-info-item">
                <span class="personal-label">Khu vực:</span>
                <span class="personal-value">Khu vực 1</span>
            </div>
            <div class="personal-info-item">
                <span class="personal-label">Số CCCD:</span>
                <span class="personal-value">{{ $sinhVien->hoSo->cccd }}</span>
            </div>
            <div class="personal-info-item">
                <span class="personal-label">Ngày cấp:</span>
                <span class="personal-value"></span>
            </div>
            <div class="personal-info-item">
                <span class="personal-label">Nơi cấp:</span>
                <span class="personal-value"></span>
            </div>
            <div class="personal-info-item">
                <span class="personal-label">Đối tượng:</span>
                <span class="personal-value"></span>
            </div>
            <div class="personal-info-item">
                <span class="personal-label">Diện chính sách:</span>
                <span class="personal-value"></span>
            </div>
            <div class="personal-info-item">
                <span class="personal-label">Ngày vào Đoàn:</span>
                <span class="personal-value"></span>
            </div>
            <div class="personal-info-item">
                <span class="personal-label">Ngày vào Đảng:</span>
                <span class="personal-value"></span>
            </div>
            <div class="personal-info-item">
                <span class="personal-label">Điện thoại:</span>
                <span class="personal-value">{{ $sinhVien->hoSo->so_dien_thoai }}</span>
            </div>
            <div class="personal-info-item">
                <span class="personal-label">Email:</span>
                <span class="personal-value">{{ $sinhVien->hoSo->email }}</span>
            </div>
        </div>
        
        <!-- Phần địa chỉ -->
        <div class="address-section">
            <div class="row">
                <div class="col-md-6">
                    <div class="address-label">Địa chỉ liên hệ:</div>
                    <div class="address-value">{{ $sinhVien->hoSo->dia_chi }}</div>
                </div>
                <div class="col-md-6">
                    <div class="address-label">Nơi sinh:</div>
                    <div class="address-value">Tỉnh Bình Phước</div>
                    
                    <div class="address-label mt-3">Hộ khẩu thường trú:</div>
                    <div class="address-value">Số 49, Đường Nguyễn Huệ, Khu Phố Thạnh Bình, Tt Thạnh Bình, Huyện Bù Đốp, Tỉnh Bình Phước</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
