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
                <a href="#" class="text-muted text-decoration-none position-relative">
                    <i class="fas fa-bell me-2"></i>
                    <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">4</span>
                    <span>Tin tức</span>
                </a>
            </div>

            <div class="d-flex align-items-center text-dark dropdown">
                <div class="dropdown-toggle d-flex align-items-center" id="userMenu" data-bs-toggle="dropdown"
                    style="cursor: pointer;">
                    <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center"
                        style="width: 32px; height: 32px; font-weight: bold;">N</div>
                    <span class="ms-2">Nguyễn Đức Bảo</span>
                </div>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                    <li><a class="text-decoration-none text-dark px-4" href="{{ route('studentLogout') }}"><i class="fa-solid fa-right-from-bracket text-danger"></i> Đăng xuất</a></li>
                </ul>
            </div>
        </div>

        <!-- Dropdown khi màn hình nhỏ -->
        <div class="dropdown d-lg-none ms-auto">
            <button class="btn btn-light" type="button" id="mobileMenu" data-bs-toggle="dropdown" aria-expanded="false">
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
                    Nguyễn Đức Bảo
                </li>
                <li><a href="{{ route('studentLogout') }}"><i class="fa-solid fa-right-from-bracket text-danger"></i> Đăng xuất</a></li>
            </ul>
        </div>

    </nav>



    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <ul class="sidebar-menu">
            <li><a href="#" class="active"><i class="fas fa-home"></i> TRANG CHỦ</a></li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle"><i class="fas fa-info-circle"></i> THÔNG TIN CHUNG</a>
                <ul class="submenu">
                    <li><a href="#">Giới thiệu</a></li>
                    <li><a href="#">Liên hệ</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle"><i class="fas fa-graduation-cap"></i> HỌC TẬP</a>
                <ul class="submenu">
                    <li><a href="#">Lịch học</a></li>
                    <li><a href="#">Điểm số</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle"><i class="fas fa-calendar"></i> ĐĂNG KÝ HỌC PHẦN</a>
                <ul class="submenu">
                    <li><a href="#">Môn học mở</a></li>
                    <li><a href="#">Kết quả đăng ký</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle"><i class="fas fa-file-alt"></i> HỌC PHÍ</a>
                <ul class="submenu">
                    <li><a href="#">Tra cứu học phí</a></li>
                    <li><a href="#">Lịch sử thanh toán</a></li>
                </ul>
            </li>
        </ul>
    </aside>


    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        @yield('content')        
    </main>

    @yield('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
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
        window.addEventListener('resize', function () {
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

        document.querySelectorAll('.dropdown-toggle').forEach(function (toggle) {
            toggle.addEventListener('click', function (e) {
                e.preventDefault();
                let submenu = this.nextElementSibling;
                submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
            });
        });

    </script>
</body>

</html>