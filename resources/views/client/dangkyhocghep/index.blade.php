@extends('client.layouts.app')

@section('title', 'Đăng Ký học ghép')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/client/css/danghoclop.css') }}">
@endsection

@section('content')
    <div class="container-fluid ">
        <div class="row">
            <div class="card shadow-sm ">
                <div>
                    <div>
                        <div class="form-title">
                            <h2>Thông tin các lớp học ghép</h2>
                            <p>Vui lòng kiểm tra kỹ thông tin cá nhân</p>
                        </div>
                        <div class="student-thongtin mt-3">
                            <div class="content-section">
                                <!-- Stats Section -->
                                <div class="stats-section">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="stats-item">
                                                <div class="stats-number pulse" id="total-subjects">{{ $monHoc->count() }}</div>
                                                <div class="stats-label">Tổng môn rớt</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="stats-item">
                                                <div class="stats-number" style="color: var(--primary-color);">{{ collect($monHoc)->sum('so_tin_chi') }}</div>
                                                <div class="stats-label">Tổng tín chỉ</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="row g-4" id="subjects-container">
                                    @if($monHoc->count() > 0)
                                        @foreach ($monHoc as $mh)
                                            <div class="col-md-6 col-lg-4 col-sm-12">
                                                <div class="subject-card h-100 fade-in" style="animation-delay: 0.1s;">
                                                    <div class="card-body">
                                                        <h5 class="subject-title">
                                                            Tên môn: {{ $mh->ten_mon }}
                                                        </h5>
                                                        <div class="score-section">
                                                            <div class="score-label">Điểm tổng kết</div>
                                                            <div class="score-value">{{ $mh->diem_tong_ket }}</div>
                                                            <small class="text-muted">Số tín chỉ: {{ $mh->so_tin_chi }}</small>
                                                            <div class="text-muted"><small class="text-muted">Loại môn học: {{ $mh->loai_mon }}</small></div>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <span class="status-badge">
                                                                <i class="fas fa-times-circle"></i>
                                                                Rớt
                                                            </span>
                                                            
                                                            <a class="text-muted" href="{{ route('sinhvien.dang-ky-hoc-ghep.list', $mh->id_mon_hoc) }}">Xem lớp học ghép</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-12" id="empty-state">
                                            <div class="empty-state">
                                                <i class="fas fa-graduation-cap"></i>
                                                <h3>Chúc mừng!</h3>
                                                <p>Bạn không có môn học nào bị rớt</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
