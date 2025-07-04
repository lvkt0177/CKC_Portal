<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CKC PORTAL - @yield('title')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    <link rel="icon" type="image/png"
        href="https://cdn.haitrieu.com/wp-content/uploads/2023/01/Logo-Truong-Cao-dang-Ky-thuat-Cao-Thang.png">
    @yield('css')

</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between align-items-center">

                <!-- Mobile Hamburger Menu -->
                <div class="hamburger" onclick="toggleMobileNav(this)">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>


                <a href="{{ route('giangvien.portal.index') }}" class="logo logo-menu">
                    <img src="https://cdn.haitrieu.com/wp-content/uploads/2023/01/Logo-Truong-Cao-dang-Ky-thuat-Cao-Thang.png"
                        width="50" height="70" alt="">
                </a>

                <nav class="nav nav-pills">
                    <a class="nav-link {{ isActiveRoute('giangvien/portal') }}"
                        href="{{ route('giangvien.portal.index') }}">Portal</a>

                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle {{ isActiveRoute('giangvien/lop') }} {{ isActiveRoute('giangvien/bienbanshcn') }} {{ isActiveRoute('giangvien/lop/sinhvien/?id=') }} }}"
                            href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            Công tác chủ nhiệm
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('giangvien.lop.index') }}"><i
                                        class="fas fa-cog me-2"></i>Quản lý lớp</a>
                            </li>
                        </ul>
                    </div>

                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle {{ isActiveRoute('giangvien/diemmonhoc') }} {{ isActiveRoute('giangvien/phieulenlop') }} {{ isActiveRoute('giangvien/thongbao') }}"
                            href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            Công tác giảng dạy
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('giangvien.giangvien.lichday') }}">
                                    <i class="bi bi-calendar-fill  me-2"></i>Lịch giảng dạy</a></li>
                            <li><a class="dropdown-item" href="{{ route('giangvien.diemmonhoc.index') }}"><i
                                        class="fas fa-file-invoice me-2"></i>Nhập điểm môn học</a></li>
                            <li><a class="dropdown-item" href="{{ route('giangvien.phieulenlop.index') }}"><i
                                        class="fas fa-credit-card me-2"></i>Phiếu lên lớp</a></li>
                            <li><a class="dropdown-item" href="{{ route('giangvien.thongbao.index') }}"><i
                                        class="fas fa-credit-card me-2"></i>Thông báo cho sinh viên</a></li>
                            <li><a class="dropdown-item" href="{{ route('giangvien.phieulenlop.manage') }}"><i
                                        class="fas fa-credit-card me-2"></i>Quản lý phiếu lên lớp</a></li>
                        </ul>
                    </div>

                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle {{ isActiveRoute('giangvien/student') }} {{ isActiveRoute('giangvien/giangvien') }} {{ isActiveRoute('giangvien/roles') }}"
                            href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            Quản lý người dùng
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('giangvien.student.index') }}"><i
                                        class="fas fa-file-invoice me-2"></i>Sinh viên</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('giangvien.giangvien.index') }}"><i
                                        class="fas fa-credit-card me-2"></i>Giảng viên</a></li>
                            <li><a class="dropdown-item" href="{{ route('giangvien.roles.index') }}"><i
                                        class="fas fa-user-tag me-2"></i>Phân quyền và vai trò</a></li>
                        </ul>
                    </div>

                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle {{ isActiveRoute('giangvien/quan-ly-lich-hoc') }} {{ isActiveRoute('giangvien/ctdt') }}"
                            href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            Quản lý đào tạo
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('giangvien.lichhoc.index') }}">
                                    <i class="fas fa-file-invoice me-2"></i>Lịch đào tạo</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('giangvien.lichthi.index') }}">
                                    <i class="fas fa-user-tag me-2"></i>Lịch thi</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('giangvien.ctdt.index') }}">
                                    <i class="fas fa-user-tag me-2"></i>Khung đào tạo</a>
                            </li>

                        </ul>
                    </div>

                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle {{ isActiveRoute('giangvien/phong') }}" href="#"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Cơ sở vật chất
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('giangvien.phong.index') }}"><i
                                        class="fas fa-shield-alt me-2"></i>Quản lý phòng học</a></li>
                        </ul>
                    </div>

                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle {{ isActiveRoute('giangvien/testimonial') }}"
                            href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            Công tác Chính trị HS - SV
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('giangvien.testimonial.index') }}"><i
                                        class="fas fa-users me-2"></i>Quản lý sinh
                                    viên đăng ký giấy</a></li>

                            <li><a class="dropdown-item" href="{{ route('giangvien.capmatkhausinhvien.index') }}"><i
                                        class="fas fa-users me-2"></i>Quản lý sinh viên liên hệ cấp mật khẩu</a></li>
                        </ul>
                    </div>
                </nav>

                <div class="d-flex align-items-center gap-3">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-bell"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i
                                        class="fas fa-book me-2"></i>Documentation</a></li>
                            <li><a class="dropdown-item" href="#"><i
                                        class="fas fa-life-ring me-2"></i>Support</a>
                            </li>
                            <li><a class="dropdown-item" href="#"><i
                                        class="fas fa-list-alt me-2"></i>Changelog</a></li>
                        </ul>
                    </div>

                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="https://upload.wikimedia.org/wikipedia/vi/3/3c/Captainamerica.jpeg"
                                width="50" height="50" alt="">
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('giangvien.profile.index') }}"><i
                                        class="fas fa-book me-2"></i>Thông tin cá
                                    nhân</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"><i
                                        class="fas fa-sign-out-alt me-2"></i>Đăng
                                    xuất</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @livewireStyles
    </header>

    <!-- Mobile Navigation -->
    <div class="mobile-nav" id="mobileNav">
        <div class="mobile-nav-header">
            <a href="#" class="logo">
                <img src="https://cdn.haitrieu.com/wp-content/uploads/2023/01/Logo-Truong-Cao-dang-Ky-thuat-Cao-Thang.png"
                    width="50" height="70" alt="">
            </a>
            <div class="hamburger active" onclick="toggleMobileNav(this)">
                <!-- icon X -->
                <i class="fas fa-times fs-3"></i>
            </div>
        </div>
        <div class="mobile-nav-content">
            <a href="#" class="mobile-nav-item" onclick="toggleSubMenu(event, this)">
                <i class="fas fa-shield-alt me-2"></i>Security
                <i class="fas fa-chevron-down float-end"></i>
            </a>
            <div class="mobile-submenu">
                <a href="#" class="mobile-nav-item">Two-factor Auth</a>
                <a href="#" class="mobile-nav-item">Login History</a>
                <a href="#" class="mobile-nav-item">API Keys</a>
            </div>

            <a href="#" class="mobile-nav-item">
                <i class="fas fa-users me-2"></i>Members & Roles
            </a>
            <!-- Các item khác -->
        </div>

    </div>



    <!-- Main Content -->
    <main class="main-content teams-section">
        @yield('content')

        @livewireScripts
    </main>

    <footer class="footer">
        <div class="container-fluid d-flex justify-content-end">
            <div class="copyright ml-auto">
                2025, made with <i class="fa fa-heart text-danger" aria-hidden="true"></i>
            </div>
        </div>
    </footer>

    <!-- Dialog xác nhận -->
    <div id="custom-confirm">
        <div class="confirm-box">
            <h2>Xác nhận</h2>
            <p>Dữ liệu hiện tại sẽ bị thay đổi. Bạn có chắc chắn muốn thực hiện thao tác này?</p>
            <div class="confirm-buttons">
                <button id="confirm-cancel">Hủy</button>
                <button id="confirm-ok">OK</button>
            </div>
        </div>
    </div>

    <script>
        let currentForm = null;
        let confirmCallback = null;
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('form[data-confirm]').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    currentForm = form;
                    showConfirm(() => form.submit());
                });
            });

            document.getElementById('confirm-ok').addEventListener('click', function() {
                document.getElementById('custom-confirm').style.display = 'none';
                if (currentForm) currentForm.submit();
            });

            document.getElementById('confirm-cancel').addEventListener('click', function() {
                document.getElementById('custom-confirm').style.display = 'none';
                currentForm = null;
            });
        });

        function showConfirm(callback = null) {
            document.getElementById('custom-confirm').style.display = 'flex';
            confirmCallback = callback;
        }
    </script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/admin/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    @yield('js')

    <script>
        $(function() {
            @if (session('success'))
                $.notify({
                    message: "{{ session('success') }}"
                }, {
                    type: 'success',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    delay: 3000,
                    z_index: 99999999,
                    animate: {
                        enter: 'animated fadeInUp',
                        exit: 'animated fadeOutDown'
                    },
                    template: `
                <div data-notify="container" class="col-11 col-md-4 alert alert-{0}" role="alert"
                     style="font-size: 15px; font-weight: 600; line-height: 1.5; padding: 16px 20px; border-radius: 10px;
                            background-color: #d1e7dd; color: #0f5132; font-family: system-ui, -apple-system, Arial, sans-serif;">
                    <span data-notify="message">{2}</span>
                </div>`
                });
            @endif

            @if (session('error'))
                $.notify({
                    message: "{{ session('error') }}"
                }, {
                    type: 'danger',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    delay: 3000,
                    z_index: 9999999,
                    animate: {
                        enter: 'animated fadeInUp',
                        exit: 'animated fadeOutDown'
                    },
                    template: `
                <div data-notify="container" class="col-11 col-md-4 alert alert-{0}" role="alert"
                     style="font-size: 15px; font-weight: 600; line-height: 1.5; padding: 16px 20px; border-radius: 10px;
                            background-color: #f8d7da; color: #842029; font-family: system-ui, -apple-system, Arial, sans-serif;">
                    <span data-notify="message">{2}</span>
                </div>`
                });
            @endif
        });

        function toggleMobileNav(btn) {
            const nav = document.getElementById('mobileNav');
            nav.classList.toggle('active');
            btn.classList.toggle('active');
        }

        function toggleSubMenu(event, element) {
            event.preventDefault();

            // Toggle icon
            element.classList.toggle("active");

            // Lấy phần submenu bên dưới
            const submenu = element.nextElementSibling;
            if (submenu && submenu.classList.contains("mobile-submenu")) {
                submenu.classList.toggle("show");
            }
        }
    </script>
</body>

</html>
