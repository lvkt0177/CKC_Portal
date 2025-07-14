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
                        href="{{ route('giangvien.portal.index') }}">
                        Portal
                    </a>
                    
                    @if(checkPermissions(Acl()::PERMISSION_CLASS))
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle {{ isActiveRoute('giangvien/lop') }} {{ isActiveRoute('giangvien/bienbanshcn') }} {{ isActiveRoute('giangvien/lop/sinhvien/?id=') }}"
                                href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                Công tác chủ nhiệm
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('giangvien.lop.index') }}">
                                    <i class="fas fa-users me-2"></i>Quản lý lớp</a>
                                </li>
                            </ul>
                        </div>
                    @endif
                        
                    @if(checkPermissions(Acl()::PERMISSION_VIEW_CLASS_RECORD))
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle {{ isActiveRoute('giangvien/diemmonhoc') }} {{ isActiveRoute('giangvien/lich-day') }} {{ isActiveRoute('giangvien/phieulenlop') }}"
                                href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                Công tác giảng dạy
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('giangvien.giangvien.lichday') }}">
                                    <i class="fas fa-calendar-alt me-2"></i>Lịch giảng dạy</a></li>
                                <li><a class="dropdown-item" href="{{ route('giangvien.diemmonhoc.index') }}">
                                    <i class="fas fa-pen-square me-2"></i>Nhập điểm môn học</a></li>
                                <li><a class="dropdown-item" href="{{ route('giangvien.phieulenlop.index') }}">
                                    <i class="fas fa-file-alt me-2"></i>Phiếu lên lớp</a></li>
                            </ul>
                        </div>
                    @endif
                    
                    @if(checkPermissions(Acl()::PERMISSION_STUDENT_LIST) || checkPermissions(Acl()::PERMISSION_TEACHER_LIST) || checkPermissions(Acl()::PERMISSION_PERMISSION_LIST))
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle {{ isActiveRoute('giangvien/student') }} {{ isActiveRoute('giangvien/giangvien') }} {{ isActiveRoute('giangvien/roles') }}"
                                href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                Quản lý người dùng
                            </a>
                            <ul class="dropdown-menu">
                                @if(checkPermissions(Acl()::PERMISSION_STUDENT_LIST))
                                    <li><a class="dropdown-item" href="{{ route('giangvien.student.index') }}">
                                        <i class="fas fa-user-graduate me-2"></i>Sinh viên</a></li>
                                @endif
                                
                                @if(checkPermissions(Acl()::PERMISSION_TEACHER_LIST))
                                    <li><a class="dropdown-item" href="{{ route('giangvien.giangvien.index') }}">
                                        <i class="fas fa-user-tie me-2"></i>Giảng viên</a></li>
                                @endif
                                
                                @if(checkPermissions(Acl()::PERMISSION_PERMISSION_LIST))
                                    <li><a class="dropdown-item" href="{{ route('giangvien.roles.index') }}">
                                        <i class="fas fa-user-shield me-2"></i>Phân quyền và vai trò</a></li>
                                @endif
                            </ul>
                        </div>
                    @endif
                    
                    @if(checkPermissions(Acl()::PERMISSION_VIEW_TIMETABLE) || checkPermissions(Acl()::PERMISSION_TIMETABLE_EXAM) || checkPermissions(Acl()::PERMISSION_TRAINING_PROGRAM_LIST))
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle {{ isActiveRoute('giangvien/quan-ly-lich-hoc') }} {{ isActiveRoute('giangvien/quan-ly-lich-thi') }} {{ isActiveRoute('giangvien/ctdt') }}"
                                href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                Quản lý đào tạo
                            </a>
                            <ul class="dropdown-menu">
                                @if(checkPermissions(Acl()::PERMISSION_VIEW_TIMETABLE))
                                    <li><a class="dropdown-item" href="{{ route('giangvien.lichhoc.index') }}">
                                        <i class="fas fa-calendar-day me-2"></i>Lịch đào tạo</a></li>
                                @endif

                                @if(checkPermissions(Acl()::PERMISSION_TIMETABLE_EXAM))
                                    <li><a class="dropdown-item" href="{{ route('giangvien.lichthi.index') }}">
                                        <i class="fas fa-calendar-check me-2"></i>Lịch thi</a></li>
                                @endif
                            
                                @if(checkPermissions(Acl()::PERMISSION_TRAINING_PROGRAM_LIST))
                                    <li><a class="dropdown-item" href="{{ route('giangvien.ctdt.index') }}">
                                        <i class="fas fa-sitemap me-2"></i>Khung đào tạo</a></li>
                                @endif
                            </ul>
                        </div>
                    @endif
                    
                    @if(checkPermissions(Acl()::PERMISSION_ROOM_LIST))
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle {{ isActiveRoute('giangvien/phong') }}"
                                href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                Cơ sở vật chất
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('giangvien.phong.index') }}">
                                    <i class="fas fa-building me-2"></i>Quản lý phòng học</a></li>
                            </ul>
                        </div>
                    @endif
                        
                    @if(checkPermissions(Acl()::PERMISSION_NOTICE_LIST))
                        <div class="dropdown">
                            <a class="nav-link {{ isActiveRoute('giangvien/thongbao') }}"
                                href="{{ route('giangvien.thongbao.index') }}">
                                Thông báo tới sinh viên
                            </a>
                        </div>
                    @endif
                        
                    @if(checkPermissions(Acl()::PERMISSION_STUDENT_PASSWORD_LIST) || checkPermissions(Acl()::PERMISSION_STUDENT_CONFIRMATION_LIST))
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle {{ isActiveRoute('giangvien/testimonial') }} {{ isActiveRoute('giangvien/capmatkhausinhvien') }} {{ isActiveRoute('giangvien/phieu-len-lop') }}"
                                href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                Công tác Chính trị HS - SV
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('giangvien.testimonial.index') }}">
                                    <i class="fas fa-file-signature me-2"></i>Quản lý đăng ký giấy</a></li>
                                <li><a class="dropdown-item" href="{{ route('giangvien.capmatkhausinhvien.index') }}">
                                    <i class="fas fa-key me-2"></i>Liên hệ cấp mật khẩu</a></li>
                                <li><a class="dropdown-item" href="{{ route('giangvien.bienbanshcn.manage') }}">
                                    <i class="fas fa-file-text me-2"></i>Biên bản SHCN của các lớp</a></li>
                                <li><a class="dropdown-item" href="{{ route('giangvien.phieulenlop.manage') }}">
                                    <i class="fas fa-tasks me-2"></i>Quản lý phiếu lên lớp</a></li>
                            </ul>
                        </div>
                    @endif
                </nav>
                

                <div class="d-flex align-items-center gap-3">
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
            <a href="{{ route('giangvien.portal.index') }}" class="mobile-nav-item">
                <i class="fas fa-home me-2"></i>Portal
            </a>
        
            @if(checkPermissions(Acl()::PERMISSION_CLASS))
                <a href="#" class="mobile-nav-item" onclick="toggleSubMenu(event, this)">
                    <i class="fas fa-users-cog me-2"></i>Công tác chủ nhiệm
                    <i class="fas fa-chevron-down float-end"></i>
                </a>
                <div class="mobile-submenu">
                    <a href="{{ route('giangvien.lop.index') }}" class="mobile-nav-item">Quản lý lớp</a>
                </div>
            @endif
        
            @if(checkPermissions(Acl()::PERMISSION_VIEW_CLASS_RECORD))
                <a href="#" class="mobile-nav-item" onclick="toggleSubMenu(event, this)">
                    <i class="fas fa-chalkboard-teacher me-2"></i>Công tác giảng dạy
                    <i class="fas fa-chevron-down float-end"></i>
                </a>
                <div class="mobile-submenu">
                    <a href="{{ route('giangvien.giangvien.lichday') }}" class="mobile-nav-item">Lịch giảng dạy</a>
                    <a href="{{ route('giangvien.diemmonhoc.index') }}" class="mobile-nav-item">Nhập điểm môn học</a>
                    <a href="{{ route('giangvien.phieulenlop.index') }}" class="mobile-nav-item">Phiếu lên lớp</a>
                    <a href="{{ route('giangvien.phieulenlop.manage') }}" class="mobile-nav-item">Quản lý phiếu lên lớp</a>
                </div>
            @endif
        
            @if(checkPermissions(Acl()::PERMISSION_STUDENT_LIST) || checkPermissions(Acl()::PERMISSION_TEACHER_LIST) || checkPermissions(Acl()::PERMISSION_PERMISSION_LIST))
                <a href="#" class="mobile-nav-item" onclick="toggleSubMenu(event, this)">
                    <i class="fas fa-user-shield me-2"></i>Quản lý người dùng
                    <i class="fas fa-chevron-down float-end"></i>
                </a>
                <div class="mobile-submenu">
                    @if(checkPermissions(Acl()::PERMISSION_STUDENT_LIST))
                        <a href="{{ route('giangvien.student.index') }}" class="mobile-nav-item">Sinh viên</a>
                    @endif
                    @if(checkPermissions(Acl()::PERMISSION_TEACHER_LIST))
                        <a href="{{ route('giangvien.giangvien.index') }}" class="mobile-nav-item">Giảng viên</a>
                    @endif
                    @if(checkPermissions(Acl()::PERMISSION_PERMISSION_LIST))
                        <a href="{{ route('giangvien.roles.index') }}" class="mobile-nav-item">Phân quyền và vai trò</a>
                    @endif
                </div>
            @endif
        
            @if(checkPermissions(Acl()::PERMISSION_VIEW_TIMETABLE) || checkPermissions(Acl()::PERMISSION_TIMETABLE_EXAM) || checkPermissions(Acl()::PERMISSION_TRAINING_PROGRAM_LIST))
                <a href="#" class="mobile-nav-item" onclick="toggleSubMenu(event, this)">
                    <i class="fas fa-graduation-cap me-2"></i>Quản lý đào tạo
                    <i class="fas fa-chevron-down float-end"></i>
                </a>
                <div class="mobile-submenu">
                    @if(checkPermissions(Acl()::PERMISSION_VIEW_TIMETABLE))
                        <a href="{{ route('giangvien.lichhoc.index') }}" class="mobile-nav-item">Lịch đào tạo</a>
                    @endif
                    @if(checkPermissions(Acl()::PERMISSION_TIMETABLE_EXAM))
                        <a href="{{ route('giangvien.lichthi.index') }}" class="mobile-nav-item">Lịch thi</a>
                    @endif
                    @if(checkPermissions(Acl()::PERMISSION_TRAINING_PROGRAM_LIST))
                        <a href="{{ route('giangvien.ctdt.index') }}" class="mobile-nav-item">Khung đào tạo</a>
                    @endif
                </div>
            @endif
        
            @if(checkPermissions(Acl()::PERMISSION_ROOM_LIST))
                <a href="#" class="mobile-nav-item" onclick="toggleSubMenu(event, this)">
                    <i class="fas fa-school me-2"></i>Cơ sở vật chất
                    <i class="fas fa-chevron-down float-end"></i>
                </a>
                <div class="mobile-submenu">
                    <a href="{{ route('giangvien.phong.index') }}" class="mobile-nav-item">Quản lý phòng học</a>
                </div>
            @endif
        
            @if(checkPermissions(Acl()::PERMISSION_NOTICE_LIST))
                <a href="{{ route('giangvien.thongbao.index') }}" class="mobile-nav-item">
                    <i class="fas fa-bullhorn me-2"></i>Thông báo tới sinh viên
                </a>
            @endif
        
            @if(checkPermissions(Acl()::PERMISSION_STUDENT_PASSWORD_LIST) || checkPermissions(Acl()::PERMISSION_STUDENT_CONFIRMATION_LIST))
                <a href="#" class="mobile-nav-item" onclick="toggleSubMenu(event, this)">
                    <i class="fas fa-id-card-alt me-2"></i>Công tác Chính trị HS - SV
                    <i class="fas fa-chevron-down float-end"></i>
                </a>
                <div class="mobile-submenu">
                    <a href="{{ route('giangvien.testimonial.index') }}" class="mobile-nav-item">Quản lý đăng ký giấy</a>
                    <a href="{{ route('giangvien.capmatkhausinhvien.index') }}" class="mobile-nav-item">Liên hệ cấp mật khẩu</a>
                </div>
            @endif
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
