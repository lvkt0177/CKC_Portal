<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>CKC Portal - @yield('title')</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }} ">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/demo.css') }}"> 
	<link rel="stylesheet" href="{{ asset('assets/admin/css/ready.css') }}">
	{{-- logo --}}
    <link rel="icon" type="image/png" href="https://cdn.haitrieu.com/wp-content/uploads/2023/01/Logo-Truong-Cao-dang-Ky-thuat-Cao-Thang.png">
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<div class="logo-header d-flex justify-content-between align-items-center px-3 py-2 bg-primary text-white">
				<!-- Nút toggle trái (chỉ hiển thị ở mobile) -->
				<div class="d-flex align-items-center d-none" id="mobileButtonsLeft">
					<button class="navbar-toggler sidenav-toggler btn btn-sm text-white p-0 m-0" type="button"
							data-bs-toggle="collapse" data-bs-target="#sidebar" aria-controls="sidebar"
							aria-expanded="false" aria-label="Toggle navigation">
						<i class="bi bi-list" style="font-size: 25px;"></i>
					</button>
				</div>
			
				<!-- Logo và tên trường -->
				<div class="d-flex justify-content-between align-items-center">
					{{-- Logo --}}
					<img src="https://cdn.haitrieu.com/wp-content/uploads/2023/01/Logo-Truong-Cao-dang-Ky-thuat-Cao-Thang.png"
						 alt="Logo" style="height: 40px; width: auto;">

					<p class="ms-3 mx-1 mb-0 fw-bold">Cao đẳng Kỹ thuật Cao Thắng</p>
				</div>
			
				<!-- Nút more bên phải (chỉ hiển thị ở mobile) -->
				<div class="d-flex align-items-center d-none" id="mobileButtonsRight">
					<button class="topbar-toggler more btn btn-sm text-white p-0 m-0">
						<i class="la la-ellipsis-v" style="font-size: 25px;"></i>
					</button>
				</div>
			</div>
			

			<!-- Navbar -->
			<nav class="navbar navbar-header navbar-expand-lg" >
				<div class="container-fluid">
					
					<form class="navbar-left navbar-form nav-search mr-md-3" action="">
						<div class="input-group">
							<input type="text" placeholder="Search ..." class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">
									<i class="la la-search search-icon"></i>
								</span>
							</div>
						</div>
					</form>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="la la-envelope"></i>
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Something else here</a>
							</div>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="la la-bell"></i>
								<span class="notification">3</span>
							</a>
							<ul class="dropdown-menu notif-box" aria-labelledby="navbarDropdown">
								<li>
									<div class="dropdown-title">You have 4 new notification</div>
								</li>
								<li>
									<div class="notif-center">
										<a href="#">
											<div class="notif-icon notif-primary"> <i class="la la-user-plus"></i> </div>
											<div class="notif-content">
												<span class="block">
													New user registered
												</span>
												<span class="time">5 minutes ago</span> 
											</div>
										</a>
										<a href="#">
											<div class="notif-icon notif-success"> <i class="la la-comment"></i> </div>
											<div class="notif-content">
												<span class="block">
													Rahmad commented on Admin
												</span>
												<span class="time">12 minutes ago</span> 
											</div>
										</a>
										<a href="#">
											<div class="notif-img"> 
												<img src="{{ asset('assets/admin/images/profile2.jpg') }}" alt="Img Profile">
											</div>
											<div class="notif-content">
												<span class="block">
													Reza send messages to you
												</span>
												<span class="time">12 minutes ago</span> 
											</div>
										</a>
										<a href="#">
											<div class="notif-icon notif-danger"> <i class="la la-heart"></i> </div>
											<div class="notif-content">
												<span class="block">
													Farrah liked Admin
												</span>
												<span class="time">17 minutes ago</span> 
											</div>
										</a>
									</div>
								</li>
								<li>
									<a class="see-all" href="javascript:void(0);"> <strong>See all notifications</strong> <i class="la la-angle-right"></i> </a>
								</li>
							</ul>
						</li>
						<li class="nav-item dropdown">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="{{ asset(''. auth()->user()->hoSo->anh) }}" alt="user-img" width="36" height="36" class="img-circle"><span >{{ auth()->user()->hoSo->ho_ten }}</span></span> </a>
							<ul class="dropdown-menu dropdown-user">
								<li>
									<div class="user-box">
										<div class="u-img"><img src="{{ asset(''. auth()->user()->hoSo->anh) }} " alt="user"></div>
										<div class="u-text">
											<h4>{{ auth()->user()->hoSo->ho_ten }}</h4>
										</div>
									</li>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="{{ route('admin.profile.index') }}"><i class="ti-user"></i>Xem hồ sơ</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="{{ route('admin.logout') }}"><i class="fa fa-power-off"></i>Đăng xuất</a>
								</ul>
								<!-- /.dropdown-user -->
							</li>
						</ul>
					</div>
				</nav>
			</div>
			<!-- End Navbar -->

			<!-- Sidebar -->
			<div class="sidebar" style="box-shadow: 5px 0 10px rgba(0, 0, 0, 0.205);">
				<div class="scrollbar-inner sidebar-wrapper">

					<div class="user" style="">
						<div class="photo">
							{{-- Auth Image --}}
							<img src="{{ asset('' . auth()->user()->hoSo->anh) }}" alt="User Image">
						</div>
						<div class="info">
							<a class="" data-toggle="" href="{{ route('admin.dashboard') }}" aria-expanded="">
								<span>
                                    {{-- User Name --}}
									{{ auth()->user()->hoSo->ho_ten ?? 'Người dùng' }}
									<span class="user-level text-uppercase">
                                        {{-- User Role --}}
                                        {{ auth()->user()->getRoleNames()->first() ?? 'Người dùng' }}
									</span>
								</span>
							</a>
							<div class="clearfix"></div>

							
						</div>
					</div>
                    
					<ul class="nav">

						@haspermission(Acl()::PERMISSION_VIEW_MENU_DASHBOARD)
						{{-- Bảng điều khiển --}}
						<li class="nav-item {{ isActiveRoute('admin/dashboard') }}">
							<a href="{{ route('admin.dashboard') }}">
								<i class="la la-dashboard"></i>
								<p>Bảng điều khiển</p>
							</a>
						</li>
						@endhaspermission
						
                        {{-- Quản lý người dùng --}}
                        <li class="nav-item">
                            <h6 class="fw-bold mx-4 mb-1 mt-4 danhMuc">Quản lý người dùng</h6>
						</li>
						<li class="nav-item {{ isActiveRoute('admin/student*') }}">
							<a href="{{ route('admin.student.index') }}">
								<i class="bi bi-person"></i>
								<p>Sinh viên</p>
							</a>
						</li>
						<li class="nav-item {{ isActiveRoute('admin/giangvien*') }}">
							<a href="{{ route('admin.giangvien.index') }}">
								<i class="bi bi-people-fill"></i>
								<p>Giảng viên</p>
							</a>
						</li>
						@haspermission(Acl()::PERMISSION_ROLE_LIST)
						<li class="nav-item {{ isActiveRoute('admin/roles*') }}">
							<a href="{{ route('admin.roles.index') }}">
								<i class="la la-th"></i>
								<p>Phân quyền và vai trò</p>
							</a>
						</li>
						@endhaspermission

                        {{-- Đào tạo --}}
                        <li class="nav-item">
                            <p class="fw-bold mx-4 mb-1 mt-4 danhMuc">Đào tạo</p>
						</li>
						<li class="nav-item">
							<a href="">
								<i class="la la-bell"></i>
								<p>Notifications</p>
							</a>
						</li>

                        <li class="nav-item">
                            <p class="fw-bold mx-4 mb-1 mt-4 danhMuc">Tương tác - Góp ý</p>
						</li>

						<li class="nav-item">
							<a href="">
								<i class="la la-font"></i>
								<p>Typography</p>
							</a>
						</li>

                        {{-- Cấu hình hệ thống --}}
                        <li class="nav-item">
                            <p class="fw-bold mx-4 mb-1 mt-4 danhMuc">Quản lý người dùng</p>
						</li>
						<li class="nav-item">
							<a href="">
								<i class="la la-fonticons"></i>
								<p>Icons</p>
							</a>
						</li>
						
					</ul>
				</div>
			</div>
			<!-- End Sidebar -->

			<div class="main-panel">
				<div class="content">
                        {{-- Content --}}
                        @yield('content')
                        {{-- End Content --}}
						
				</div>
				
				<footer class="footer">
					<div class="container-fluid">
						<div class="copyright ml-auto">
							2025, made with <i class="la la-heart heart text-danger"></i> 
						</div>				
					</div>
				</footer>
			</div>
		</div>
	</div>
	<!-- Modal -->
	
</body>

<script>
	function toggleMobileButtons() {
        const isMobile = window.innerWidth < 768; 
        const left = document.getElementById('mobileButtonsLeft');
        const right = document.getElementById('mobileButtonsRight');

        if (isMobile) {
            left.classList.remove('d-none');
            right.classList.remove('d-none');
        } else {
            left.classList.add('d-none');
            right.classList.add('d-none');
        }
    }

    toggleMobileButtons();

    window.addEventListener('resize', toggleMobileButtons);
</script>

<script src="{{ asset('assets/admin/js/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/plugin/chartist/chartist.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/plugin/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/plugin/jquery-mapael/maps/world_countries.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/plugin/chart-circle/circles.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/ready.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/demo.js') }}"></script>

</html>