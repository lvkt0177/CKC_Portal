@extends('client.layouts.app')

@section('title', 'Lịch thi')

@section('css')
    <style>
        .card-title {
            font-weight: 700;
            font-size: 1.125rem;
            margin-bottom: 1rem;
            color: var(--text-primary);
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/admin/css/lichthi.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/lucide@0.273.0/dist/umd/lucide.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card shadow-sm ">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0 fs-4">
                        Lịch thi
                    </h3>
                    <a href="{{ route('sinhvien.lichthi.thilailanhai') }}" class="btn btn-primary">Đăng ký thi lại</a>

                </div>
                @if ($lichThi->count() > 0)
                    <form action="{{ route('sinhvien.lichthi.index') }}" method="GET" class="form-inline mb-3">
                        <div class="form-group me-2">
                            <label for="id_tuan" class="me-2">🗓️ Chọn tuần:</label>
                            <select name="id_tuan" id="id_tuan" class="form-control" onchange="this.form.submit()">

                                @foreach ($dsTuan as $tuan)
                                    <option value="{{ $tuan->tuan->id }}"
                                        {{ request('id_tuan') == $tuan->tuan->id ? 'selected' : '' }}>
                                        Tuần {{ $loop->index + 1 }}
                                        ({{ \Carbon\Carbon::parse($tuan->tuan->ngay_bat_dau)->format('d/m') }} -
                                        {{ \Carbon\Carbon::parse($tuan->tuan->ngay_ket_thuc)->format('d/m') }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                    @foreach ($dsNgay as $ngay => $dsLich)
                        <div class="schedule-day">
                            <h3 class="date-header">
                                📅 Ngày {{ \Carbon\Carbon::parse($ngay)->format('d/m/Y') }}
                            </h3>

                            <div class="exam-cards" style="display: grid;">
                                <div class="exam-table">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Môn học</th>
                                                <th>Giờ thi</th>
                                                <th>Phòng</th>
                                                <th>Lớp học phần</th>
                                                <th>Giám thị 1</th>
                                                <th>Giám thị 2</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dsLich as $lt)
                                                <tr>
                                                    <td>{{ $lt->lopHocPhan->ten_hoc_phan ?? '---' }}</td>
                                                    <td>{{ $lt->gio_bat_dau }} ({{ $lt->thoi_gian_thi }} phút)</td>
                                                    <td>{{ $lt->phong->ten ?? $lt->phong_thi }}</td>
                                                    <td>{{ $lt->lopHocPhan->ten_hoc_phan ?? '-' }}</td>
                                                    <td>{{ $lt->giamThi1->hoSo->ho_ten ?? '-' }}</td>
                                                    <td>{{ $lt->giamThi2->hoSo->ho_ten ?? '-' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    @endforeach
                @else
                    <div class="card-body">
                        <p class="text-center">Khoảng thời gian không có lịch thi nào!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script></script>
@endsection
