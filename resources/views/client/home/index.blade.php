@extends('client.layouts.app')

@section('title', 'Trang chu')

@section('css')

@endsection

@section('content')
    <!-- Page Header -->
    <div class="container-fluid my-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h2 class="mb-4">Thông tin sinh viên</h2>
                <div class="row align-items-center">
                    <!-- Avatar bên trái -->
                    <div class="col-md-4 text-center mb-3 mb-md-0">
                        <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEyMCIgdmlld0JveD0iMCAwIDEwMCAxMjAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxMDAiIGhlaWdodD0iMTIwIiBmaWxsPSIjNEY0NkU1Ii8+CjxjaXJjbGUgY3g9IjUwIiBjeT0iNDAiIHI9IjE1IiBmaWxsPSJ3aGl0ZSIvPgo8cGF0aCBkPSJNMjUgOTBDMjUgNzUgMzUgNjUgNTAgNjVDNjUgNjUgNzUgNzUgNzUgOTBIOTVWMTIwSDVWOTBIMjVaIiBmaWxsPSJ3aGl0ZSIvPgo8L3N2Zz4K"
                            alt="Student Avatar" class="" style="width: 150px;">
                    </div>

                    <!-- Thông tin bên phải -->
                    <div class="col-md-8">
                        <h4 class="fw-bold">Nguyễn Đức Bảo</h4>
                        <div class="row">
                            <div class="col-sm-6">
                                <p><strong>MSSV:</strong> 22638401</p>
                                <p><strong>Lớp học:</strong> DHITTT18ATT</p>
                                <p><strong>Hệ đào tạo:</strong> Đại học</p>
                                <p><strong>Khóa học:</strong> 2022 - 2023</p>
                                <p><strong>Giới tính:</strong> Nam</p>
                            </div>
                            <div class="col-sm-6">
                                <p><strong>Ngày sinh:</strong> 24/12/2004</p>
                                <p><strong>Nơi sinh:</strong> Tỉnh Bình Phước</p>
                                <p><strong>Ngành:</strong> Hệ thống thông tin</p>
                                <p><strong>Bậc đào tạo:</strong> Tiên tiến</p>
                                <p><strong>Loại hình đào tạo:</strong> Tiên tiến</p>
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

    <!-- Charts Section -->
    <div class="charts-section">
        <div class="chart-container">
            <h5 class="chart-title">Kết quả học tập</h5>
            <div class="dropdown mb-3">
                <select class="form-select">
                    <option>HK3 (2024 - 2025)</option>
                </select>
            </div>
            <div class="no-data">
                <p>Chưa có dữ liệu hiển thị</p>
            </div>
        </div>
    </div>
@endsection
