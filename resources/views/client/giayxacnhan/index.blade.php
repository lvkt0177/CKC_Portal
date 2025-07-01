@extends('client.layouts.app')

@section('title', 'Đăng Ký Xác Nhận Giấy Tờ')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/client/css/giayxacnhan.css') }}">
@endsection

@section('content')
    <div class="container-fluid ">
        <div class="row">
            <div class="card shadow-sm ">
                <div>
                    <div class="card-header d-flex justify-content-end align-items-center">
                        <a href="{{ route('sinhvien.giayxacnhan.list') }}" class="btn text-light"
                            style=" background: #2c3e50 ;">Danh
                            sách giấy đã đăng
                            ký</a>
                    </div>

                    <div>
                        <div class="form-title">
                            <h2>ĐĂNG KÝ XIN GIẤY XÁC NHẬN</h2>
                            <p>Vui lòng điền đầy đủ thông tin và chọn loại giấy tờ cần xác nhận</p>
                        </div>
                        <div class="container">
                            <div class="main-content" style=" margin: 0 !important;">
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
                                            <span class="thongtin-value">{{ $sinhVien->lop->ten_lop ?? 'Chưa có' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <form id="registrationForm" action="{{ route('sinhvien.giayxacnhan.dangky') }}"
                                    method="POST" data-confirm>
                                    @csrf
                                    <input type="hidden" name="id_sinh_vien" value="{{ $sinhVien->id }}">
                                    <div class="form-group">
                                        <label>Chọn loại giấy xác nhận cần đăng ký:</label>
                                        <div class="checkbox-group">
                                            @foreach ($giayXacNhans as $giayXacNhan)
                                                <div class="checkbox-item">
                                                    <input type="checkbox" id="cb{{ $giayXacNhan->id }}"
                                                        name="document_type[]" value="{{ $giayXacNhan->id }}">
                                                    <label
                                                        for="cb{{ $giayXacNhan->id }}">{{ $giayXacNhan->ten_giay }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <button type="submit" class="submit-btn mb-3">
                                        📝 Đăng ký ngay
                                    </button>
                                </form>
                            </div>
                            <div class="side">
                                <div class="calendar" id="calendar"></div>
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
        // Xử lý checkbox tương tác
        document.querySelectorAll('.checkbox-item').forEach(item => {
            const checkbox = item.querySelector('input[type="checkbox"]');

            item.addEventListener('click', function(e) {
                if (e.target.type !== 'checkbox') {
                    checkbox.checked = !checkbox.checked;
                }

                if (checkbox.checked) {
                    item.classList.add('checked');
                } else {
                    item.classList.remove('checked');
                }
            });

            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    item.classList.add('checked');
                } else {
                    item.classList.remove('checked');
                }
            });
        });

        // Smooth scroll cho navigation
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Responsive navigation
        function checkScreenSize() {
            const navItems = document.querySelector('.nav-items');
            if (window.innerWidth <= 768) {
                navItems.style.flexDirection = 'column';
            } else {
                navItems.style.flexDirection = 'row';
            }
        }

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
        window.addEventListener('resize', checkScreenSize);
        checkScreenSize();
    </script>
@endsection
