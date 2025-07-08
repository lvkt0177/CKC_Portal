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
                        <div class="">
                            <img src="{{ $sinhVien->hoSo->gioi_tinh == 'Nam' ? asset('assets/client/images/logo_nam.jpg') : asset('assets/client/images/logo_nu.jpg') }}" alt="Student Avatar"
                            class="" style="width: auto; height: 200px;">
                            <div class="mt-3"><a class="text-primary text-decoration-none" href="{{ route('sinhvien.ho-so.index') }}">Xem chi tiết</a></div>
                        </div>
                    </div>

                    <!-- Thông tin bên phải -->
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <h3 class="fw-bold">{{ $sinhVien->hoSo->ho_ten }}</h3>
                        <div class="row">
                            <div class="col-sm-6">
                                <p><strong>MSSV:</strong> {{ $sinhVien->ma_sv }}</p>
                                <p><strong>Lớp học:</strong> {{ $sinhVien->danhSachSinhVien->last()->lop->ten_lop }}</p>
                                <p><strong>Hệ đào tạo:</strong> Cao đẳng</p>
                                <p><strong>Giới tính:</strong> {{ $sinhVien->hoSo->gioi_tinh }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p><strong>Niên khoá:</strong>
                                    {{ $sinhVien->danhSachSinhVien->last()->lop->nienKhoa->ten_nien_khoa }}</p>
                                <p><strong>Ngày sinh:</strong> {{ $sinhVien->hoSo->ngay_sinh }} </p>
                                <p><strong>Ngành:</strong> Hệ thống thông tin</p>
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
            <div class="stat-number">{{ $tongSoLichHoc }}</div>
            <div class="stat-label"><a href="{{ route('sinhvien.thoikhoabieu.index') }}" class="text-dark fs-6">Xem chi tiết</a></div>
        </div>
        <div class="stat-card warning">
            <div>Lịch thi trong tuần</div>
            <div class="stat-number">{{ $tongSoLichThi }}</div>
            <div class="stat-label"><a href="{{ route('sinhvien.lichthi.index') }}" class="text-dark fs-6">Xem chi tiết</a></div>
        </div>
    </div>

    <!-- Dashboard Grid -->
    <div class="dashboard-grid">
        <a href="{{ route('sinhvien.xemdiem.ketquahoctap') }}" class="text-decoration-none">
            <div class="dashboard-item">
                <i class="fas fa-chart-bar"></i>
                <span>Kết quả học tập</span>
            </div>
        </a>
        <a href="{{ route('sinhvien.dang-ky-hoc-ghep.index') }}" class="text-decoration-none">
            <div class="dashboard-item">
                <i class="fas fa-layer-group"></i>
                <span>Đăng ký học ghép</span>
            </div>
        </a>
        <a href="{{ route('sinhvien.hocphi.index') }}" class="text-decoration-none">
            <div class="dashboard-item">
                <i class="fas fa-file-alt"></i>
                <span>Tra cứu học phí</span>
            </div>
        </a>
        <div class="dashboard-item">
            <a href="" class="text-decoration-none">
                <i class="fas fa-folder"></i>
                <span>Phiếu thu tổng hợp</span>
            </a>
        </div>
        <div class="dashboard-item">
            <a href="" class="text-decoration-none">
                <i class="fas fa-list"></i>
                <span>Lịch theo tiến độ</span>
            </a>
        </div>
        <div class="dashboard-item">
            <a href="" class="text-decoration-none">
                <i class="fas fa-briefcase"></i>
                <span>Nhắc nhở</span>
            </a>
        </div>
        <div class="dashboard-item">
            <a href="" class="text-decoration-none">
                <i class="fas fa-clipboard"></i>
                <span>Khảo sát</span>
            </a>
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
