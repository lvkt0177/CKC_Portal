@extends('auth.auth-layout')

@section('content')
    <div class="form-toggle">
        <div class="toggle-slider" id="toggleSlider"></div>
        <button class="toggle-btn active" onclick="switchForm('student')">
            <i class="fas fa-user-graduate me-2"></i>Sinh Viên
        </button>
        <button class="toggle-btn" onclick="switchForm('teacher')">
            <i class="fas fa-chalkboard-teacher me-2"></i>Giảng Viên
        </button>
    </div>

    <!-- Form Sinh Viên -->
    <div class="form-section active" id="studentForm">
        <form class="login-form" id="login-form-student">
            <div class="form-group">
                <input type="text" class="form-control" name="ma_sv" placeholder="Mã sinh viên" required>
                <i class="fas fa-user input-icon"></i>
            </div>

            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Mật khẩu" required>
                <i class="fas fa-lock input-icon"></i>
            </div>

            @error('mssv')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <button type="submit" class="login-btn" data-role="student">
                <i class="fas fa-sign-in-alt me-2"></i>Đăng nhập
            </button>
        </form>

        <div class="form-links">
            <a href="{{ route('login.student') }}">Quên mật khẩu? Liên hệ Phòng CTCT</a>
        </div>
    </div>

    <!-- Form Giảng Viên -->
    <div class="form-section" id="teacherForm">
        <form class="login-form" id="login-form">
            <div class="form-group">
                <input type="text" class="form-control" name="tai_khoan" placeholder="Tài khoản" required>
                <i class="fa-solid fa-user input-icon"></i>
            </div>

            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Mật khẩu" required>
                <i class="fas fa-lock input-icon"></i>
            </div>

            <button type="submit" class="login-btn" data-role="teacher">
                <i class="fas fa-sign-in-alt me-2"></i>Đăng nhập
            </button>
        </form>

        <div class="form-links">
            <a href="{{ route('login.user-reset-password') }}" class="me-3">Quên mật khẩu?</a>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function switchForm(type) {
            const studentForm = document.getElementById('studentForm');
            const teacherForm = document.getElementById('teacherForm');
            const toggleSlider = document.getElementById('toggleSlider');
            const toggleBtns = document.querySelectorAll('.toggle-btn');

            // Reset active states
            toggleBtns.forEach(btn => btn.classList.remove('active'));

            if (type === 'student') {
                studentForm.classList.add('active');
                teacherForm.classList.remove('active');
                toggleSlider.classList.remove('teacher');
                toggleBtns[0].classList.add('active');
            } else {
                teacherForm.classList.add('active');
                studentForm.classList.remove('active');
                toggleSlider.classList.add('teacher');
                toggleBtns[1].classList.add('active');
            }
        }

        // Form submission handling
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('.login-form');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const btn = e.submitter;
                    const role = btn.dataset.role;
                    const originalText = btn.innerHTML;
                    let url = '/login';

                    // Đổi URL tùy theo role
                    if (role === 'student') {
                        url = "{{ route('doLoginStudent') }}";
                    }
                    if (role === 'teacher') {
                        url = '/login-user';
                    }

                    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang xử lý...';
                    btn.disabled = true;

                    const formData = new FormData(form);

                    fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                            body: formData
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                btn.innerHTML =
                                    '<i class="fas fa-check me-2"></i>Đăng nhập thành công!';
                                btn.style.background =
                                    'linear-gradient(135deg, #10b981, #059669)';
                                setTimeout(() => {
                                    window.location.href = data.redirect;
                                }, 1000);
                            } else {
                                btn.innerHTML =
                                    '<i class="fas fa-times me-2"></i>Đăng nhập thất bại!';
                                btn.style.background =
                                    'linear-gradient(135deg, #ef4444, #dc2626)';
                                setTimeout(() => {
                                    btn.innerHTML = originalText;
                                    btn.style.background = '';
                                    btn.disabled = false;
                                }, 1000);
                            }
                        })
                        .catch(err => {
                            console.log(err.message);
                            btn.innerHTML = '<i class="fas fa-times me-2"></i>Lỗi server!';
                            btn.style.background = 'linear-gradient(135deg, #ef4444, #dc2626)';
                            setTimeout(() => {
                                btn.innerHTML = originalText;
                                btn.style.background = '';
                                btn.disabled = false;
                            }, 2000);
                        });
                });
            });
        });

        // Add floating animation to input focus
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });
    </script>
@endsection
