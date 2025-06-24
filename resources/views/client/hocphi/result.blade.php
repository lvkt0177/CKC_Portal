@extends('client.layouts.app')

@section('title', 'Kết quả thanh toán')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/client/css/hocphi.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/payment.css') }}">
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
                        <div class="main-content" style=" margin: 0 !important;">
                            <div class="success-container">
                                <!-- Header Section -->
                                <div class="header-section {{ $data['status'] == 'success' ? 'success' : 'error' }}" >
                                    <div class="{{ $data['status'] == 'success' ? 'success-icon' : 'error-icon' }}">
                                        @if($data['status'] == 'success')
                                            <i class="fas fa-check"></i>
                                        @else
                                            <i class="fas fa-times"></i>
                                        @endif
                                    </div>
                                    
                                    <h1 class="{{ $data['status'] == 'success' ? 'success-title' : 'error-title' }}">
                                        {{ $data['status'] == 'success' ? 'Thanh toán thành công!' : 'Thanh toán thất bại!' }}
                                    </h1>
                                    <p class="{{ $data['status'] == 'success' ? 'success-subtitle' : 'error-subtitle' }}">
                                        {{ $data['status'] == 'success' ? 'Giao dịch của bạn đã được xử lý thành công' : 'Vui lòng thử lại hoặc liên hệ hỗ trợ' }}
                                    </p>
                                </div>
                        
                                <!-- Content Section -->
                                <div class="content-section">
                                    <div class="vnpay-logo">
                                        <i class="fas fa-credit-card" style="color: #ff6b6b; font-size: 1.5rem;"></i>
                                        <span class="vnpay-text">VN PAY</span>
                                    </div>
                                
                                    <div class="transaction-info">
                                        <div class="info-row">
                                            <span class="info-label">Mã giao dịch</span>
                                            <span class="info-value">#{{ $data['transactionId'] }}</span>
                                        </div>
                                        <div class="info-row">
                                            <span class="info-label">Số tiền</span>
                                            <span class="info-value">{{ $data['amount'] }}</span>
                                        </div>
                                        <div class="info-row">
                                            <span class="info-label">Thời gian</span>
                                            <span class="info-value">{{ $data['time'] }}</span>
                                        </div>
                                        <div class="info-row">
                                            <span class="info-label">Nội dung</span>
                                            <span class="info-value">{{ $data['orderInfo'] }}</span>
                                        </div>
                                        <div class="info-row">
                                            <span class="info-label">Phương thức</span>
                                            <span class="info-value">{{ $data['paymentMethod'] }}</span>
                                        </div>
                                        <div class="info-row">
                                            <span class="info-label">Trạng thái</span>
                                            <span class="status-badge {{ $data['status'] == 'success' ? 'success' : 'error' }}">
                                                {{ $data['status'] == 'success' ? 'Thành công' : 'Thất bại' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
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
        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Animate elements on load
            const elements = document.querySelectorAll('.info-row');
            elements.forEach((element, index) => {
                element.style.opacity = '0';
                element.style.transform = 'translateX(-20px)';
                
                setTimeout(() => {
                    element.style.transition = 'all 0.5s ease';
                    element.style.opacity = '1';
                    element.style.transform = 'translateX(0)';
                }, index * 100 + 500);
            });

            // Button hover effects
            const buttons = document.querySelectorAll('.btn-custom');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Print receipt functionality
            const downloadBtn = document.querySelector('.btn-outline-custom');
            if (downloadBtn) {
                downloadBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    // Simulate download
                    const link = document.createElement('a');
                    link.href = '#';
                    link.download = 'bien-lai-vnpay-240624001234.pdf';
                    
                    // Show loading state
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang tải...';
                    this.style.pointerEvents = 'none';
                    
                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.style.pointerEvents = 'auto';
                        alert('Biên lai đã được tải xuống thành công!');
                    }, 2000);
                });
            }
        });
    </script>
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