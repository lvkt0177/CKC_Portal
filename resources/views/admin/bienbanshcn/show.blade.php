<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHCN - {{ $thongTin->tieu_de }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bb_shcn.css') }}">
    <link rel="icon" type="image/png"
    href="https://cdn.haitrieu.com/wp-content/uploads/2023/01/Logo-Truong-Cao-dang-Ky-thuat-Cao-Thang.png">
</head>
<body>
    <div class="container-fluid">
        <div class="document-container">
            <!-- Header -->
            <div class="header-section">
                <div class="header-content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="school-name">TRƯỜNG CĐ KỸ THUẬT CAO THẮNG</div>
                            <div class="school-name">PHÒNG CÔNG TÁC CHÍNH TRỊ HSSV</div>
                            <div style="color: #feca57; font-size: 1.2rem; margin-top: 10px;">★★★</div>
                        </div>
                        <div class="col-md-6">
                            <div class="country-name">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</div>
                            <div class="country-name" style="text-decoration: underline;">Độc lập - Tự do - Hạnh phúc</div>
                        </div>
                    </div>
                    <div class="location-date">
                        Tp. Hồ Chí Minh, ngày {{ now()->day }} tháng {{ now()->month }} năm {{ now()->year }}
                    </div>
                    <div class="main-title">{{ $thongTin->tieu_de }}</div>
                    <div class="date-range text-uppercase">Tuần thứ {{ $thongTin->tuan->tuan }} ({{ $thongTin->thoi_gian_bat_dau->format('d/m/Y') }} – {{ $thongTin->thoi_gian_ket_thuc->format('d/m/Y') }})</div>
                    <div class="mt-3">
                        <img src="https://cdn.haitrieu.com/wp-content/uploads/2023/01/Logo-Truong-Cao-dang-Ky-thuat-Cao-Thang.png" width="150" height="230" alt="">
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="content-section">
                <div class="subsection animate-on-scroll">
                    <div class="subsection-title">
                        <i class="fas fa-users"></i>
                        Thành phần dự họp gồm có:
                    </div>
                    <ul class="content-list">
                        <li>Thời gian bắt đầu sinh hoạt lúc: <span class="">{{ $thongTin->thoi_gian_bat_dau->format('H:i') }}, ngày {{ $thongTin->thoi_gian_bat_dau->format('d') }} tháng {{ $thongTin->thoi_gian_bat_dau->format('m') }} năm {{ $thongTin->thoi_gian_bat_dau->format('Y') }}</span></li>
                        <li>Giáo viên chủ nhiệm: <span class="text-uppercase">{{ $thongTin->gvcn->hoSo->ho_ten }}</span></li>
                        <li>Thư ký: <span class="text-uppercase">{{ $thongTin->sv->hoSo->ho_ten }}</span></li>
                        <li>Sỉ số: <span>{{ $thongTin->so_luong_sinh_vien }}</span></li>
                        <li>Hiện diện: <span>{{ $thongTin->so_luong_sinh_vien - $thongTin->vang_mat }}</span></li>
                        <li>Vắng mặt: <span>{{ $thongTin->vang_mat }}</span></li>
                    </ul>
                </div>

                @if($thongTin->chiTietBienBanSHCN->count() > 0)

                    <div class="subsection animate-on-scroll">
                        <div class="subsection-title">
                            <i class="fas fa-users"></i>
                            Họ và tên HSSV vắng mặt, lý do:
                        </div>
                        <ul class="content-list">
                            @foreach ($thongTin->chiTietBienBanSHCN as $chiTietBienBanSHCN)
                                <li>{{ $loop->index + 1 }}. 
                                    <span class="text-uppercase">{{ $chiTietBienBanSHCN->sinhVien->hoSo->ho_ten }}</span>
                                    <span class="mx-5"></span> <span>Lý do: {{ $chiTietBienBanSHCN->ly_do }}</span>
                                    <span class="mx-5"></span> <span>Loại vắng: {{ $chiTietBienBanSHCN->loai->getLabel() }}</span>
                                </li>
                                
                            @endforeach
                            
                        </ul>
                    </div>
                @else
                    <div class="subsection animate-on-scroll">
                        <div class="subsection-title">
                            <i class="fas fa-users"></i>
                            Họ và tên HSSV vắng mặt, lý do:
                        </div>
                        <ul class="content-list">
                            <li>Không có sinh viên nào vắng mặt</li>
                        </ul>
                    </div>
                @endif

                <!-- A. CÁC NỘI DUNG CHÍNH -->
                <div class="section-title">
                    <i class="fas fa-clipboard-list"></i>
                    NỘI DUNG BUỔI SINH HOẠT
                </div>

                <!-- A1. CÁC THÔNG TIN MỚI -->
                <div class="subsection animate-on-scroll">
                    <div class="subsection-title">
                        <i class="fas fa-newspaper"></i>
                        NỘI DUNG
                    </div>
                    <div class="content-list">
                        <p>{!! $thongTin->noi_dung !!}</p>
                    </div>
                </div>

                <div class="section-title">
                    <i class="fas fa-clipboard-list"></i>
                </div>

                <div class="subsection animate-on-scroll">
                    <ul class="content-list">
                        <li>Buổi sinh hoạt kết thúc lúc: <span class="">{{ $thongTin->thoi_gian_ket_thuc->format('H:i') }}, ngày {{ $thongTin->thoi_gian_ket_thuc->format('d') }} tháng {{ $thongTin->thoi_gian_ket_thuc->format('m') }} năm {{ $thongTin->thoi_gian_ket_thuc->format('Y') }}</span></li>
                        <li>Giáo viên chủ nhiệm: <span class="text-uppercase">{{ $thongTin->gvcn->hoSo->ho_ten }}</span></li>
                        <li>Thư ký: <span class="text-uppercase">{{ $thongTin->sv->hoSo->ho_ten }}</span></li>
                    </ul>
                </div>

            <!-- Footer -->
            <div class="footer-section">
                <div class="row">
                    <div class="col-md-12">
                        <p class="mb-0">
                            <i class="fas fa-university"></i>
                            TRƯỜNG CAO ĐẲNG KỸ THUẬT CAO THẮNG
                        </p>
                        <small>Phòng Công tác Chính trị - Học sinh Sinh viên</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animate on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        // Observe all elements with animate-on-scroll class
        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });

        // Add smooth scrolling
        document.documentElement.style.scrollBehavior = 'smooth';

        // Add hover effects to subsections
        document.querySelectorAll('.subsection').forEach(section => {
            section.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(8px) scale(1.02)';
            });
            
            section.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0) scale(1)';
            });
        });

        // Add click ripple effect
        document.querySelectorAll('.subsection').forEach(section => {
            section.addEventListener('click', function(e) {
                const ripple = document.createElement('div');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.cssText = `
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(102, 126, 234, 0.3);
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                    animation: ripple 0.6s ease-out;
                    pointer-events: none;
                `;
                
                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                
                setTimeout(() => ripple.remove(), 600);
            });
        });

        // Add ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                0% {
                    transform: scale(0);
                    opacity: 1;
                }
                100% {
                    transform: scale(1);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>