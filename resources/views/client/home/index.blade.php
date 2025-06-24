@extends('client.layouts.app')

@section('title', 'Trang chu')

@section('css')
    <style>
        .scrollable-area {
            max-height: 500px;
            overflow-y: auto;
        }
    </style>
@endsection

@section('content')
    <!-- Page Header -->
    <div class="container-fluid my-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="row align-items-center">
                    <!-- Avatar bên trái -->
                    <div class="col-lg-4 col-md-12 col-sm-12 text-center mb-3 mb-md-0">
                        <img src="{{ asset('' . Auth::guard('student')->user()->hoSo->anh) }}" alt="Student Avatar"
                            class="rounded-circle" style="width: 240px;">
                    </div>

                    <!-- Thông tin bên phải -->
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <h4 class="fw-bold">Sinh viên: {{ Auth::guard('student')->user()->hoSo->ho_ten }}</h4>
                        <div class="row">
                            <div class="col-sm-6">
                                <p><strong>MSSV:</strong> {{ Auth::guard('student')->user()->ma_sv }}</p>
                                <p><strong>Lớp học:</strong> {{ Auth::guard('student')->user()->lop->ten_lop }}</p>
                                <p><strong>Hệ đào tạo:</strong> Cao đẳng</p>
                                <p><strong>Khóa học:</strong>
                                    {{ Auth::guard('student')->user()->lop->nienKhoa->ten_nien_khoa }}</p>
                                <p><strong>Giới tính:</strong> {{ Auth::guard('student')->user()->hoSo->gioi_tinh }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p><strong>Ngày sinh:</strong> {{ Auth::guard('student')->user()->hoSo->ngay_sinh }} </p>
                                <p><strong>Ngành:</strong> Hệ thống thông tin</p>
                                <p><strong>Bậc đào tạo:</strong> Tiên tiến</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card info">
            <div>Lịch học trong tuần</div>
            <div class="stat-number">3</div>
            <div class="stat-label"><a href="" class="text-dark fs-6">Xem chi tiết</a></div>
        </div>
        <div class="stat-card warning">
            <div>Lịch thi trong tuần</div>
            <div class="stat-number">0</div>
            <div class="stat-label"><a href="" class="text-dark fs-6">Xem chi tiết</a></div>
        </div>
    </div>

    <!-- Dashboard Grid -->
    <div class="dashboard-grid">
        <div class="dashboard-item">
            <i class="fas fa-calendar"></i>
            <span>Lịch theo tuần</span>
        </div>
        <div class="dashboard-item">
            <i class="fas fa-chart-bar"></i>
            <span>Kết quả học tập</span>
        </div>
        <div class="dashboard-item">
            <i class="fas fa-layer-group"></i>
            <span>Đăng ký học phần</span>
        </div>
        <div class="dashboard-item">
            <i class="fas fa-dollar-sign"></i>
            <span>Tra cứu công nợ</span>
        </div>
        <div class="dashboard-item">
            <i class="fas fa-file-alt"></i>
            <span>Thành toán trực tuyến</span>
        </div>
        <div class="dashboard-item">
            <i class="fas fa-folder"></i>
            <span>Phiếu thu tổng hợp</span>
        </div>
        <div class="dashboard-item">
            <i class="fas fa-list"></i>
            <span>Lịch theo tiến độ</span>
        </div>
        <div class="dashboard-item">
            <i class="fas fa-briefcase"></i>
            <span>Nhắc nhở</span>
        </div>
        <div class="dashboard-item">
            <i class="fas fa-clipboard"></i>
            <span>Khảo sát</span>
        </div>
    </div>
@endsection


@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const select = document.getElementById('hocKySelect');
            const tables = document.querySelectorAll('.hoc-ky-bang');

            function showTable(hocKyId) {
                tables.forEach(table => {
                    table.style.display = (table.dataset.hocky == hocKyId) ? 'block' : 'none';
                });
            }

            // Ban đầu hiển thị theo kỳ được chọn
            showTable(select.value);

            // Khi chọn kỳ mới
            select.addEventListener('change', function() {
                showTable(this.value);
            });
        });
    </script>
@endsection
