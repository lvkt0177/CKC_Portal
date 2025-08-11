@extends('client.layouts.app')

@section('title', 'Lịch sử đăng ký học ghép')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/client/css/hocphi.css') }}">
@endsection

@section('content')
    <div class="container-fluid ">
        <div class="row">
            <div class="card shadow-sm ">
                <div>
                    <div>
                        <div class="form-title">
                            <h2>Thông tin kinh phí đào tạo</h2>
                            <p>Vui lòng kiểm tra kỹ thông tin cá nhân</p>
                        </div>
                        <div class="container">
                            <div class="main-content p-0" style=" margin: 0 !important;">
                                <div class="student-thongtin">
                                    <div class="thongtin-grid">
                                        <div class="thongtin-item">
                                            <span class="thongtin-label">Mã SSV:</span>
                                            <span class="thongtin-value">{{ $sinhVien->ma_sv }}</span>
                                        </div>
                                        <div class="thongtin-item">
                                            <span class="thongtin-label">CMND/CCCD:</span>
                                            <span
                                                class="thongtin-value">{{ $sinhVien->hoSo->so_cccd ?? '••••••••••' }}</span>
                                        </div>
                                        <div class="thongtin-item">
                                            <span class="thongtin-label">Họ tên:</span>
                                            <span class="thongtin-value">{{ $sinhVien->hoSo->ho_ten }}</span>
                                        </div>
                                        <div class="thongtin-item">
                                            <span class="thongtin-label">Ngày sinh:</span>
                                            <span
                                                class="thongtin-value">{{ \Carbon\Carbon::parse($sinhVien->hoSo->ngay_sinh)->format('d/m/Y') }}</span>
                                        </div>
                                        <div class="thongtin-item">
                                            <span class="thongtin-label">Giới tính:</span>
                                            <span class="thongtin-value">{{ $sinhVien->hoSo->gioi_tinh }}</span>
                                        </div>
                                        <div class="thongtin-item">
                                            <span class="thongtin-label">Nơi sinh:</span>
                                            <span class="thongtin-value">{{ $sinhVien->hoSo->dia_chi }}</span>
                                        </div>
                                        <div class="thongtin-item">
                                            <span class="thongtin-label">Lớp:</span>
                                            <span class="thongtin-value">{{ $sinhVien->danhSachSinhVien->last()->lop->ten_lop }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="student-thongtin">
                                    <h5 class="section-title">
                                        <i class="fas fa-money-bill-wave me-2"></i>
                                        Lịch sử thang toán đăng ký lớp học ghép
                                    </h5>

                                    @if($dangKyHocGhep->count() > 0)
                                        @foreach ($dangKyHocGhep as $dkhg)
                                            <!-- Học phi -->
                                            <div class="fee-status-card fee-card-{{ $dkhg->trang_thai->getBadge() }}">
                                                <div class="fee-status-header">
                                                    <h6 class="fee-title">
                                                        <i class="fas fa-graduation-cap me-2"></i>
                                                        Đăng ký học ghép lớp {{ $dkhg->lopHocPhan->ten_hoc_phan }}
                                                    </h6>
                                                    <span class="status-badge status-{{ $dkhg->trang_thai->getBadge() }}">
                                                        <i class="{{ $dkhg->trang_thai->getIcon() }}"></i>
                                                        {{ $dkhg->trang_thai->getLabel() }}
                                                    </span>
                                                </div>
                                                <div class="fee-details">
                                                    <div class="fee-detail-item">
                                                        <span class="fee-label fs-5">Số tiền</span>
                                                        <span class="fee-value text-success">{{ number_format($dkhg->so_tien, 0, ',', '.') }} VNĐ</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="no-results" id="noResults">
                                            <p class="text-muted">Không có thông tin lịch sử đăng ký lớp học ghép</p>
                                        </div>
                                    @endif

                                </div>
                            </div>
                            <div class="side">
                                <div class="calendar" id="calendar">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function renderCalendar() {
            const today = new Date();
            const currentMonth = today.getMonth(); // 0-11
            const currentYear = today.getFullYear();

            const firstDayOfMonth = new Date(currentYear, currentMonth, 1);
            const lastDayOfMonth = new Date(currentYear, currentMonth + 1, 0);

            const startDay = firstDayOfMonth.getDay(); // 0 (CN) - 6 (T7)
            const totalDays = lastDayOfMonth.getDate();

            const calendar = document.getElementById("calendar");
            const monthNames = ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8",
                "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"
            ];

            // Header
            let html = `<h3>📅 ${monthNames[currentMonth]} ${currentYear}</h3>`;
            html += `<div class="calendar-grid">
            <div class="calendar-header">CN</div>
            <div class="calendar-header">T2</div>
            <div class="calendar-header">T3</div>
            <div class="calendar-header">T4</div>
            <div class="calendar-header">T5</div>
            <div class="calendar-header">T6</div>
            <div class="calendar-header">T7</div>`;

            // Ngày của tháng trước nếu có
            const prevMonthDays = (startDay === 0 ? 6 : startDay - 1);
            const lastDayPrevMonth = new Date(currentYear, currentMonth, 0).getDate();

            for (let i = prevMonthDays; i >= 0; i--) {
                html += `<div class="calendar-day other-month">${lastDayPrevMonth - i}</div>`;
            }

            // Các ngày trong tháng
            for (let i = 1; i <= totalDays; i++) {
                const isToday = i === today.getDate() && currentMonth === today.getMonth() && currentYear === today
                    .getFullYear();
                html += `<div class="calendar-day${isToday ? ' today' : ''}">${i}</div>`;
            }

            // Ngày của tháng sau (đủ hàng)
            const remaining = (prevMonthDays + totalDays) % 7;
            if (remaining !== 0) {
                for (let i = 1; i <= 7 - remaining; i++) {
                    html += `<div class="calendar-day other-month">${i}</div>`;
                }
            }

            html += `</div>`;
            calendar.innerHTML = html;
        }

        document.addEventListener("DOMContentLoaded", renderCalendar);
    </script>
@endsection
