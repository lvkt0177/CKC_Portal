@extends('client.layouts.app')

@section('title', 'Khung Chương Trình Đào Tạo')

@section('css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="{{ asset('assets/client/css/khungdaotao.css') }}">
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Khung Chương Trình Đào Tạo </h3>
                </div>
                <!-- Filter Section -->
                <div class="filter-section">
                    <div class="filter-header">
                        <div class="filter-icon">🎓</div>
                        <h2 class="filter-title">Chọn Chuyên Ngành</h2>
                    </div>

                    <form method="GET" action="{{ route('sinhvien.khungdaotao.index') }}" id="curriculumForm">
                        <div class="select-wrapper">
                            <select name="id_chuong_trinh_dao_tao" id="id_chuong_trinh_dao_tao" class="modern-select"
                                onchange="handleFormSubmit()">
                                @foreach ($chuong_trinh_dao_tao as $ctdt)
                                    <option value="{{ $ctdt->id }}"
                                        {{ $id_chuong_trinh_dao_tao == $ctdt->id ? 'selected' : '' }}>
                                        {{ $ctdt->ten_chuong_trinh_dao_tao }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <!-- Loading Animation -->
                <div class="loading" id="loading">
                    <div class="spinner"></div>
                    <p>Đang tải dữ liệu...</p>
                </div>
                <!-- Curriculum Grid -->
                <div class="curriculum-grid" id="curriculumGrid">
                    <!-- Semester 1 -->
                    @foreach ($ct_ctdt as $hocKy => $danhSachMon)
                        <div class="semester-card">
                            <div class="semester-header">
                                <h3 class="semester-title">Học kỳ {{ $hocKy }}</h3>
                                <div class="semester-stats">
                                    <div class="stat-item">
                                        <div class="stat-icon">📚</div>
                                        <span>{{ count($danhSachMon) }} môn học</span>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-icon">⏱️</div>
                                        <span>{{ $danhSachMon->sum('so_tiet') }} tiết</span>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-icon">🏆</div>
                                        <span>{{ $danhSachMon->sum('so_tin_chi') }}</span>
                                    </div>
                                </div>
                            </div>
                            <table class="subjects-table">
                                <thead class="table-header">
                                    <tr>
                                        <th>Tên môn học</th>
                                        <th class="text-center">Số tiết</th>
                                        <th class="text-center">Số tín chỉ</th>
                                    </tr>
                                </thead>
                                <tbody class="table-body">
                                    @foreach ($danhSachMon as $ct)
                                        <tr>
                                            <td class="subject-name">{{ $ct->monHoc->ten_mon ?? 'Chưa có' }}</td>
                                            <td class="subject-hours">{{ $ct->so_tiet }}</td>
                                            <td class="subject-credit">{{ $ct->so_tin_chi }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>
                @php
                    $tongMonHoc = 0;
                    $tongSoTinChi = 0;
                    $tongSoTiet = 0;
                    $tongHocKy = count($ct_ctdt);

                    foreach ($ct_ctdt as $dsMon) {
                        $tongMonHoc += count($dsMon);
                        $tongSoTinChi += $dsMon->sum('so_tin_chi');
                        $tongSoTiet += $dsMon->sum('so_tiet');
                    }
                @endphp
                <div class="summary-section">
                    <div class="summary-header">
                        <div class="summary-icon">📊</div>
                        <h2 class="summary-title">Tổng Kết Chương Trình</h2>
                    </div>

                    <div class="summary-grid">
                        <div class="summary-item">
                            <div class="summary-number">{{ $tongMonHoc }}</div>
                            <div class="summary-label">Tổng môn học</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-number">{{ $tongSoTiet }}</div>
                            <div class="summary-label">Tổng số tiết</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-number">{{ $tongSoTinChi }}</div>
                            <div class="summary-label">Tổng tín chỉ</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-number">{{ $tongHocKy }}</div>
                            <div class="summary-label">Số học kỳ</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
@section('js')
    <script>
        function handleFormSubmit() {
            const loading = document.getElementById('loading');
            const grid = document.getElementById('curriculumGrid');

            // Show loading animation
            loading.classList.add('show');
            grid.style.opacity = '0.5';

            // Simulate form submission delay
            setTimeout(() => {
                loading.classList.remove('show');
                grid.style.opacity = '1';
                // Here you would normally submit the form
                // document.getElementById('curriculumForm').submit();
            }, 1000);
        }

        // Add smooth scrolling and animations
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.semester-card');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            });

            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
        });
    </script>
@endsection
