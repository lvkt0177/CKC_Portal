@extends('client.layouts.app')

@section('title', 'Thông báo')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/client/css/thongbao.css') }}">
@endsection

@section('content')
    <!-- Header Banner -->
    <div class="container-fluid my-4">
        <div class="card shadow-sm border-0 header-banner">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h1 class="course-title">Thông báo tới sinh viên - Lớp
                            {{ Auth::guard('student')->user()->lop->ten_lop }}</h1>
                        <!-- Pencil SVG Icon -->
                        <svg class="pencil-icon" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="20" y="75" width="50" height="8" fill="#ff6b6b" rx="4" />
                            <rect x="25" y="15" width="40" height="65" fill="#74c0fc" rx="4" />
                            <rect x="30" y="20" width="30" height="50" fill="#e9ecef" />
                            <circle cx="45" cy="10" r="5" fill="#ffd43b" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Main Content -->
            <div class="col-xl-12 col-lg-8 col-md-7 col-sm-12">
                <div class="">
                    <!-- Content Header -->
                    <div class="content-header">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-bullhorn text-primary me-2"></i>
                            <span class="text-muted">Danh sách thông báo</span>
                        </div>
                    </div>

                    <!-- Notifications List -->
                    <div class="notifications-list">
                        <!-- Notification 1 -->
                        @foreach ($thongbaos as $thongbao)
                            <div class="notification-item">
                                <div class="d-flex">
                                    <a href="{{ route('sinhvien.thong-bao.show', $thongbao) }}" class="d-flex text-decoration-none">
                                        <div class="notification-icon">
                                            <i class="fas fa-file-alt"></i>
                                        </div>
                                        <div class="notification-content">
                                            <div class="notification-title fs-6">
                                                <strong>{{ $thongbao->giangVien->hoSo->ho_ten }} đã gửi một thông báo mới:</strong> {{ $thongbao->tieu_de }}
                                            </div>
                                            <div class="notification-date fs-6">{{ $thongbao->ngay_gui->format('d/m/Y') }}</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')
    <script>
        document.querySelectorAll('.notification-item').forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(2px)';
            });

            item.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
            });
        });

        document.querySelector('.join-btn').addEventListener('click', function() {
            this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang tham gia...';
            setTimeout(() => {
                this.innerHTML = '<i class="fas fa-video me-2"></i>Tham gia';
            }, 2000);
        });

        function handleMobileLayout() {
            const isMobile = window.innerWidth < 768;
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');

            if (isMobile) {
                sidebar.style.position = 'static';
                document.querySelectorAll('.notification-item').forEach(item => {
                    item.addEventListener('touchstart', function() {
                        this.style.backgroundColor = '#f8f9fa';
                    });

                    item.addEventListener('touchend', function() {
                        setTimeout(() => {
                            this.style.backgroundColor = '';
                        }, 150);
                    });
                });
            }
        }

        handleMobileLayout();
        window.addEventListener('resize', handleMobileLayout);

        if ('ontouchstart' in window) {
            document.querySelectorAll('.join-btn, .options-btn').forEach(btn => {
                btn.style.minHeight = '44px';
            });
        }
    </script>
@endsection
