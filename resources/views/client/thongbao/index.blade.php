@extends('client.layouts.app')

@section('title', 'Thông báo')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/client/css/thongbao.css') }}">
@endsection

@section('content')
    <div class="container-fluid">
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
                        @foreach ($thongbaos as $thongbao)
                            @php
                                $trangThai = $thongbao->chiTietThongBao->first()?->trang_thai ?? 0;
                            @endphp

                            <div
                                class="notification-item">
                                <div class="d-flex justify-content-between align-items-start">
                                    <a href="{{ route('sinhvien.thong-bao.show', $thongbao) }}"
                                        class="d-flex text-decoration-none flex-grow-1">
                                        <div class="notification-icon me-3">
                                            <i class="fas fa-file-alt"></i>
                                        </div>
                                        <div class="notification-content">
                                            <div class="notification-title fs-6">
                                                <strong>{{ $thongbao->giangVien->hoSo->ho_ten }} đã gửi một thông báo
                                                    mới:</strong>
                                                {{ $thongbao->tieu_de }}
                                            </div>
                                            <div class="notification-date fs-6 text-muted">
                                                {{ $thongbao->ngay_gui->format('d/m/Y') }}</div>
                                        </div>
                                    </a>

                                    <div class="ms-2">
                                        <span
                                            class="badge rounded-pill {{ $trangThai->getBadge() }}">
                                            {{ $trangThai->getLabel()}}
                                        </span>
                                    </div>
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
