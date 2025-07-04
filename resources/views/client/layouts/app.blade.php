<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CKC PORTAL - @yield('title')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/client/css/style.css') }}">
    <link rel="icon" type="image/png"
        href="https://cdn.haitrieu.com/wp-content/uploads/2023/01/Logo-Truong-Cao-dang-Ky-thuat-Cao-Thang.png">
    @yield('css')
</head>

<body>
    <!-- Top Navbar -->
    <nav class="top-navbar navbar navbar-expand-lg bg-white shadow-sm px-3">
        <div class="d-flex align-items-center me-auto">
            <button class="btn btn-link text-primary me-3" onclick="toggleSidebar()">
                <i class="fas fa-bars fa-lg"></i>
            </button>
            <div class="navbar-brand d-flex align-items-center text-primary fw-bold">
                <i class="fas fa-graduation-cap me-2"></i> CKC PORTAL
            </div>
        </div>

        <!-- Hiển thị khi màn hình lớn -->
        <div class="d-none d-lg-flex align-items-center ms-auto gap-4">
            <div class="d-flex align-items-center text-muted">
                <a href="#" class="text-muted text-decoration-none">
                    <i class="fas fa-home me-2"></i>
                    <span>Trang chủ</span>
                </a>
            </div>

            <div class="d-flex align-items-center position-relative text-muted">
                <a href="{{ route('sinhvien.thong-bao.index') }}"
                    class="text-muted text-decoration-none position-relative">
                    <i class="fas fa-bell me-2"></i>
                    <span
                        class="badge bg-danger position-absolute top-0 start-100 translate-middle">{{ $unreadNotificationCount }}</span>
                    <span>Thông báo</span>
                </a>
            </div>

            <div class="d-flex align-items-center position-relative text-muted">
                <a href="#" class="text-muted text-decoration-none position-relative">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span>{{ Auth::guard('student')->user()->hoSo->ho_ten }}</span>
                </a>
            </div>

            <div class="d-flex align-items-center position-relative text-muted">
                <a class="text-decoration-none text-dark" href="{{ route('studentLogout') }}"><i
                        class="fa-solid fa-right-from-bracket text-danger"></i> Đăng xuất</a>
            </div>

        </div>

        <!-- Dropdown khi màn hình nhỏ -->
        <div class="dropdown d-lg-none ms-auto">
            <button class="btn btn-light" type="button" id="mobileMenu" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end animate__animated animate__fadeIn" aria-labelledby="mobileMenu">
                <li class="dropdown-item d-flex align-items-center text-muted">
                    <a href="" class="text-muted text-decoration-none">
                        <i class="fas fa-home me-2"></i> Trang chủ
                    </a>
                </li>
                <li class="dropdown-item d-flex align-items-center text-muted position-relative">
                    <a href="" class="text-muted text-decoration-none">
                        <i class="fas fa-bell me-2"></i> Tin tức <span class="badge bg-danger ms-auto">4</span>
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li class="dropdown-item d-flex align-items-center text-dark">
                    <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center me-2"
                        style="width: 28px; height: 28px; font-weight: bold;">N</div>
                    {{ Auth::guard('student')->user()->hoSo->ho_ten }}
                </li>
                <li><a href="{{ route('studentLogout') }}"><i class="fa-solid fa-right-from-bracket text-danger"></i>Đổi
                        mật khẩu</a></li>
                <li><a href="{{ route('studentLogout') }}"><i class="fa-solid fa-right-from-bracket text-danger"></i>
                        Đăng xuất</a></li>
            </ul>
        </div>

    </nav>



    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <ul class="sidebar-menu">
            <li><a href="{{ route('sinhvien.trang-chu.index') }}" class="{{ isActiveRoute('sinhvien/trang-chu') }}"><i
                        class="fas fa-home"></i> TRANG CHỦ</a></li>

            <li class="dropdown">
                <a href="#"
                    class="dropdown-toggle {{ isActiveRoute('sinhvien/giay-xac-nhan') }} {{ isActiveRoute('sinhvien/khung-dao-tao') }} {{ isActiveRoute('sinhvien/bienbanshcn') }} {{ isActiveRoute('sinhvien/ho-so') }}"><i
                        class="fas fa-info-circle"></i> THÔNG TIN CHUNG</a>
                <ul class="submenu"
                    style="display: {{ isActiveMenuRoute('sinhvien/giay-xac-nhan') }} {{ isActiveMenuRoute('sinhvien/khung-dao-tao') }} {{ isActiveMenuRoute('sinhvien/ho-so') }} {{ isActiveMenuRoute('sinhvien/bienbanshcn') }};">
                    <li><a class="{{ isActiveRoute('sinhvien/ho-so') }}"
                            href="{{ route('sinhvien.ho-so.index') }}">Thông tin sinh viên</a></li>
                    <li><a class="{{ isActiveRoute('sinhvien/giay-xac-nhan') }}"
                            href="{{ route('sinhvien.giayxacnhan.index') }}">Đăng ký giấy xác nhận</a></li>
                    <li><a class="{{ isActiveRoute('sinhvien/khung-dao-tao') }}"
                            href="{{ route('sinhvien.khungdaotao.index') }}">Khung chương trình đào tạo</a></li>
                    <li><a class="{{ isActiveRoute('sinhvien/bienbanshcn') }}"
                            href="{{ route('sinhvien.bienbanshcn.index') }}">Biên bản SHCN</a></li>
                </ul>
            </li>

            <li class="dropdown">
<<<<<<< HEAD
                <a href="#"
                    class="dropdown-toggle {{ isActiveRoute('sinhvien/xemdiem') }} {{ isActiveRoute('sinhvien/thoikhoabieu') }} {{ isActiveRoute('sinhvien/lichthi') }}"><i
                        class="fas fa-graduation-cap"></i> HỌC TẬP</a>
                <ul class="submenu"
                    style="display: {{ isActiveMenuRoute('sinhvien/xemdiem') }} {{ isActiveMenuRoute('sinhvien/thoikhoabieu') }} {{ isActiveMenuRoute('sinhvien/lichthi') }};">
                    <li><a class="{{ isActiveRoute('sinhvien/xemdiemhoctap') }}"
                            href="{{ route('sinhvien.xemdiem.ketquahoctap') }}">Kết quả học tập</a></li>
                    <li><a class="{{ isActiveRoute('sinhvien/xemdiemrenluyen') }}"
                            href="{{ route('sinhvien.xemdiem.ketquarenluyen') }}">kết quả rèn luyện</a></li>
                    <li><a class="{{ isActiveRoute('sinhvien/thoikhoabieu') }}"
                            href="{{ route('sinhvien.thoikhoabieu.index') }}">Lịch học theo tuần</a></li>
                    <li><a class="{{ isActiveRoute('sinhvien/lichthi') }}"
                            href="{{ route('sinhvien.lichthi.index') }}">Lịch thi</a></li>
=======
                <a href="#" class="dropdown-toggle {{ isActiveRoute('sinhvien/xemdiem') }} {{ isActiveRoute('sinhvien/thoikhoabieu') }} {{ isActiveRoute('sinhvien/lichthi') }}"><i class="fas fa-graduation-cap"></i> HỌC TẬP</a>
                <ul class="submenu" style="display: {{ isActiveMenuRoute('sinhvien/xemdiem') }} {{ isActiveMenuRoute('sinhvien/thoikhoabieu') }} {{ isActiveMenuRoute('sinhvien/lichthi') }};">
                    <li><a class="{{ isActiveRoute('sinhvien/xemdiemhoctap') }}" href="{{ route('sinhvien.xemdiem.ketquahoctap') }}">Kết quả học tập</a></li>
                    <li><a class="{{ isActiveRoute('sinhvien/xemdiemrenluyen') }}" href="{{ route('sinhvien.xemdiem.ketquarenluyen') }}">Kết quả rèn luyện</a></li>
                    <li><a class="{{ isActiveRoute('sinhvien/thoikhoabieu') }}" href="{{ route('sinhvien.thoikhoabieu.index') }}">Lịch học theo tuần</a></li>
                    <li><a class="{{ isActiveRoute('sinhvien/lichthi') }}" href="{{ route('sinhvien.lichthi.index') }}">Lịch thi</a></li>
>>>>>>> origin/master
                </ul>
            </li>

            <li class="dropdown">
                <a href="#"
                    class="dropdown-toggle {{ isActiveRoute('sinhvien/dang-ky-hoc-ghep') }} {{ isActiveRoute('sinhvien/lop-dang-ky-hoc-ghep') }}"><i
                        class="fas fa-calendar"></i> ĐĂNG KÝ HỌC GHÉP</a>
                <ul class="submenu"
                    style="display: {{ isActiveMenuRoute('sinhvien/dang-ky-hoc-ghep') }} {{ isActiveMenuRoute('sinhvien/lop-dang-ky-hoc-ghep') }};">
                    <li><a class="{{ isActiveRoute('sinhvien/dang-ky-hoc-ghep') }}"
                            href="{{ route('sinhvien.dang-ky-hoc-ghep.index') }}">Lớp học ghép</a></li>
                    <li><a class="{{ isActiveRoute('sinhvien/lop-dang-ky-hoc-ghep') }}"
                            href="{{ route('sinhvien.dang-ky-hoc-ghep.history') }}">Lịch sử đăng ký học ghép</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle {{ isActiveRoute('sinhvien/hocphi') }}"><i
                        class="fas fa-file-alt"></i> HỌC PHÍ</a>
                <ul class="submenu" style="display: {{ isActiveMenuRoute('sinhvien/hocphi') }};">
                    <li><a href="{{ route('sinhvien.hocphi.index') }}">Tra cứu học phí</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle {{ isActiveRoute('sinhvien/bao-mat') }}"><i
                        class="fa-solid fa-user-shield"></i> BẢO MẬT</a>
                <ul class="submenu " style="display: {{ isActiveMenuRoute('sinhvien/bao-mat') }};">
                    <li><a href="{{ route('sinhvien.bao-mat.doi-mat-khau') }}">Đổi mật khẩu</a></li>
                </ul>
            </li>
        </ul>
    </aside>


    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        @yield('content')
    </main>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/admin/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    @yield('js')
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const overlay = document.querySelector('.sidebar-overlay');

            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');

            if (window.innerWidth <= 768) {
                overlay.classList.toggle('show');
            }
        }

        // Handle responsive sidebar
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const overlay = document.querySelector('.sidebar-overlay');

            if (window.innerWidth > 768) {
                sidebar.classList.remove('collapsed');
                mainContent.classList.remove('expanded');
                overlay.classList.remove('show');
            } else {
                sidebar.classList.add('collapsed');
                mainContent.classList.add('expanded');
            }
        });

        // Initialize responsive behavior
        if (window.innerWidth <= 768) {
            document.getElementById('sidebar').classList.add('collapsed');
            document.getElementById('mainContent').classList.add('expanded');
        }

        document.querySelectorAll('.dropdown-toggle').forEach(function(toggle) {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                let submenu = this.nextElementSibling;
                submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
            });
        });

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
                    z_index: 9999,
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
                    z_index: 9999,
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
    </script>
</body>

</html>
