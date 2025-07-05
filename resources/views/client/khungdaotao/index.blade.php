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
                <div class="loading" id="loading">
                    <div class="spinner"></div>
                    <p>Đang tải dữ liệu...</p>
                </div>
                @php
                    $tongMonHoc = 0;
                    $tongSoTinChi = 0;
                    $tongSoTiet = 0;
                    $tongHocKy = $ct_ctdt_all->count();

                    foreach ($ct_ctdt_all as $dsMon) {
                        $tongMonHoc += $dsMon->count();
                        $tongSoTinChi += $dsMon->sum('so_tin_chi');
                        $tongSoTiet += $dsMon->sum('so_tiet');
                    }
                @endphp
                <div id="semester-cards">
                    <div class="semester-card">

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

                        <!-- Curriculum Grid -->
                        <div class="curriculum-grid">
                            <!-- Semester 1 -->
                            @foreach ($ct_ctdt_all as $hocKy => $danhSachMon)
                                @php
                                    $tenhocKy = $danhSachMon->first()->hocKy->ten_hoc_ky ?? '';
                                @endphp
                                <div class="semester-card">
                                    <div class="semester-header">
                                        <h3 class="semester-title">{{ $tenhocKy }}</h3>
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
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loading = document.getElementById('loading');
            const grid = document.getElementById('semester-cards');
            const cards = document.querySelectorAll('.semester-card');

            // Giai đoạn đầu: ẩn grid, hiện loading
            loading.classList.add('show');
            grid.style.opacity = '0.5';

            // Sau 1 giây thì ẩn loading, hiện grid và bắt đầu animation các card
            setTimeout(() => {
                loading.classList.remove('show');
                grid.style.opacity = '1';

                // Animation xuất hiện các card
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
            }, 1000);
        });

        function handleFormSubmit() {
            const loading = document.getElementById('loading');
            const grid = document.getElementById('semester-cards');

            loading.classList.add('show');
            grid.style.opacity = '0.5';

            setTimeout(() => {
                loading.classList.remove('show');
                grid.style.opacity = '1';

                document.getElementById('curriculumForm').submit();
            }, 1000);
        }
    </script>
@endsection
