@extends('admin.layouts.app')

@section('title', 'Công tác giảng dạy')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/lich.css') }}">
@endsection

@section('content')
    <div class="container-fluid teams-section">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm teams-section">
                    <div class="container-fluid">
                        <!-- Header Section -->
                        <div class="header-section">
                            <div class="container">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <h4 class="mb-0 text-primary">
                                            <i class="fas fa-calendar-alt me-2"></i>
                                            Sổ lên lớp tuần {{ $tuan->tuan }} ({{ $tuan->ngay_bat_dau->format('d/m/Y') }}
                                            -
                                            {{ $tuan->ngay_ket_thuc->format('d/m/Y') }})</h3>

                                        </h4>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex justify-content-end align-items-center">
                                            <div class="btn-group me-3">
                                                <form method="GET" action="{{ route('admin.phieulenlop.index') }}"
                                                    id="week-form">
                                                    <input type="hidden" name="id_tuan" value="{{ $tuan->id }}">
                                                    <input type="hidden" name="action" id="week-action">

                                                    <button type="submit" class="btn btn-outline-primary btn-sm"
                                                        onclick="event.preventDefault(); document.getElementById('week-action').value='prev'; document.getElementById('week-form').submit();">
                                                        <i class="fas fa-arrow-left"></i> Tuần trước
                                                    </button>

                                                    <button type="submit" class="btn btn-outline-primary btn-sm"
                                                        onclick="event.preventDefault(); document.getElementById('week-action').value='current'; document.getElementById('week-form').submit();">
                                                        <i class="fas fa-calendar"></i> Hiện tại
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="nav-buttons">
                                                <form method="GET" action="{{ route('admin.phieulenlop.index') }}">
                                                    {{-- Chọn Năm --}}
                                                    <select class="form-control" name="id_nam"
                                                        onchange="this.form.submit()">
                                                        @foreach ($dsNam as $n)
                                                            <option value="{{ $n->id }}"
                                                                {{ request('id_nam', $nam->id) == $n->id ? 'selected' : '' }}>
                                                                Năm {{ $n->nam_bat_dau }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    {{-- Chọn Tuần (theo năm đã chọn) --}}
                                                    <select class="form-control" name="id_tuan"
                                                        onchange="this.form.submit()">

                                                        @foreach ($dsTuan as $t)
                                                            <option value="{{ $t->id }}"
                                                                {{ request('id_tuan', $tuan->id) == $t->id ? 'selected' : '' }}>
                                                                Tuần {{ $t->tuan }}
                                                                ({{ $t->ngay_bat_dau->format('d/m/Y') }} -
                                                                {{ $t->ngay_ket_thuc->format('d/m/Y') }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </form>

                                                <div class="btn-group ms-2">
                                                    <button class="btn btn-info btn-sm d-flex align-items-center ">
                                                        <i class="fas fa-print"></i>
                                                    </button>
                                                    <button class="btn btn-success btn-sm d-flex align-items-center">
                                                        <i class="fas fa-download"></i>
                                                    </button>
                                                    <button class="btn btn-secondary btn-sm d-flex align-items-center">
                                                        <i class="fas fa-question"></i>
                                                    </button>
                                                    <a href="{{ route('admin.phieulenlop.create') }}"
                                                        class="btn btn-dark btn-sm d-flex align-items-center">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Schedule Table -->
                        <div class="container">
                            <div class="schedule-table">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th class="time-column">Ca học</th>
                                            @foreach ($ngayTrongTuan as $ngay)
                                                <th class="day-header">
                                                    {{ ucfirst($ngay->translatedFormat('l')) }}<br>
                                                    {{ $ngay->format('d/m/Y') }}
                                                </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Morning Session -->
                                        <tr>
                                            <td class="time-column">Sáng</td>
                                            @foreach ($ngayTrongTuan as $ngay)
                                                <td class="schedule-cell">
                                                    @php
                                                        $daDung = [];
                                                    @endphp

                                                    @for ($so = 1; $so <= 6; $so++)
                                                        @php $rendered = false; @endphp

                                                        @foreach ($phieu_len_lop as $pll)
                                                            @php
                                                                $bat_dau = $pll->tiet_bat_dau;
                                                                $so_tiet = $pll->so_tiet;
                                                                $ket_thuc = $bat_dau + $so_tiet - 1;
                                                            @endphp

                                                            @if ($pll->ngay == $ngay->format('Y-m-d'))
                                                                @if ($so == $bat_dau && !in_array($pll->id, $daDung))
                                                                    <div
                                                                        class="class-card web-dev mb-2 border-left-{{ $pll->lopHocPhan->loai_mon->getBadge() }}">
                                                                        <div class="class-title">
                                                                            {{ $pll->lopHocPhan->ten_hoc_phan }}
                                                                        </div>
                                                                        <div class="class-details">
                                                                            Lớp: {{ $pll->lopHocPhan->lop->ten_lop }}<br>
                                                                            Tiết:
                                                                            {{ $pll->tiet_bat_dau }}-{{ $pll->so_tiet + $pll->tiet_bat_dau - 1 }}<br>
                                                                            Phòng: {{ $pll->phong->ten }}<br>
                                                                            GV:
                                                                            {{ $pll->lopHocPhan->giangVien->hoSo->ho_ten }}<br>
                                                                            Ngày:
                                                                            {{ \Carbon\Carbon::parse($pll->ngay)->format('d/m/Y') }}
                                                                        </div>
                                                                    </div>
                                                                    @php
                                                                        $rendered = true;
                                                                        $daDung[] = $pll->id;
                                                                        break;
                                                                    @endphp
                                                                @elseif ($so > $bat_dau && $so <= $ket_thuc)
                                                                    @php
                                                                        $rendered = true;
                                                                        break;
                                                                    @endphp
                                                                @endif
                                                            @endif
                                                        @endforeach

                                                        @if (!$rendered)
                                                            <div class=""></div>
                                                        @endif
                                                    @endfor
                                                </td>
                                            @endforeach
                                        </tr>

                                        <!-- Afternoon Session -->
                                        <tr>
                                            <td class="time-column">Chiều</td>
                                            @foreach ($ngayTrongTuan as $ngay)
                                                <td class="schedule-cell">
                                                    @php
                                                        $daDung = [];
                                                    @endphp

                                                    @for ($so = 7; $so <= 12; $so++)
                                                        @php $rendered = false; @endphp

                                                        @foreach ($phieu_len_lop as $pll)
                                                            @php
                                                                $bat_dau = $pll->tiet_bat_dau;
                                                                $so_tiet = $pll->so_tiet;
                                                                $ket_thuc = $bat_dau + $so_tiet - 1;
                                                            @endphp

                                                            @if ($pll->ngay == $ngay->format('Y-m-d'))
                                                                @if ($so == $bat_dau && !in_array($pll->id, $daDung))
                                                                    <div
                                                                        class="class-card web-dev mb-2 border-left-{{ $pll->lopHocPhan->loai_mon->getBadge() }}">
                                                                        <div class="class-title">
                                                                            {{ $pll->lopHocPhan->ten_hoc_phan }}
                                                                        </div>
                                                                        <div class="class-details">
                                                                            {{ $pll->lopHocPhan->lop->ten_lop }}<br>
                                                                            {{ $pll->tiet_bat_dau }}-{{ $pll->so_tiet + $pll->tiet_bat_dau - 1 }}<br>
                                                                            Phòng: {{ $pll->phong->ten }}<br>
                                                                            GV:
                                                                            {{ $pll->lopHocPhan->giangVien->hoSo->ho_ten }}<br>
                                                                            Ngày:
                                                                            {{ \Carbon\Carbon::parse($pll->ngay)->format('d/m/Y') }}
                                                                        </div>
                                                                    </div>
                                                                    @php
                                                                        $rendered = true;
                                                                        $daDung[] = $pll->id;
                                                                        break;
                                                                    @endphp
                                                                @elseif ($so > $bat_dau && $so <= $ket_thuc)
                                                                    @php
                                                                        $rendered = true;
                                                                        break;
                                                                    @endphp
                                                                @endif
                                                            @endif
                                                        @endforeach

                                                        @if (!$rendered)
                                                            <div class=""></div>
                                                        @endif
                                                    @endfor
                                                </td>
                                            @endforeach
                                        </tr>

                                        <!-- Evening Session -->
                                        <tr>
                                            <td class="time-column">Tối</td>
                                            @foreach ($ngayTrongTuan as $ngay)
                                                <td class="schedule-cell">
                                                    @php
                                                        $daDung = [];
                                                    @endphp

                                                    @for ($so = 13; $so <= 15; $so++)
                                                        @php $rendered = false; @endphp

                                                        @foreach ($phieu_len_lop as $pll)
                                                            @php
                                                                $bat_dau = $pll->tiet_bat_dau;
                                                                $so_tiet = $pll->so_tiet;
                                                                $ket_thuc = $bat_dau + $so_tiet - 1;
                                                            @endphp

                                                            @if ($pll->ngay == $ngay->format('Y-m-d'))
                                                                @if ($so == $bat_dau && !in_array($pll->id, $daDung))
                                                                    <div
                                                                        class="class-card web-dev mb-2 border-left-{{ $pll->lopHocPhan->loai_mon->getBadge() }}">
                                                                        <div class="class-title">
                                                                            {{ $pll->lopHocPhan->ten_hoc_phan }}
                                                                        </div>
                                                                        <div class="class-details">
                                                                            {{ $pll->lopHocPhan->lop->ten_lop }}<br>
                                                                            {{ $pll->tiet_bat_dau }}-{{ $pll->so_tiet + $pll->tiet_bat_dau - 1 }}<br>
                                                                            Phòng: {{ $pll->phong->ten }}<br>
                                                                            GV:
                                                                            {{ $pll->lopHocPhan->giangVien->hoSo->ho_ten }}<br>
                                                                            Ngày:
                                                                            {{ \Carbon\Carbon::parse($pll->ngay)->format('d/m/Y') }}
                                                                        </div>
                                                                    </div>
                                                                    @php
                                                                        $rendered = true;
                                                                        $daDung[] = $pll->id;
                                                                        break;
                                                                    @endphp
                                                                @elseif ($so > $bat_dau && $so <= $ket_thuc)
                                                                    @php
                                                                        $rendered = true;
                                                                        break;
                                                                    @endphp
                                                                @endif
                                                            @endif
                                                        @endforeach

                                                        @if (!$rendered)
                                                            <div class=""></div>
                                                        @endif
                                                    @endfor
                                                </td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Legend -->
                            <div class="legend">
                                <div class="legend-item">
                                    <div class="legend-color bg-info"></div>
                                    <span>Lý thuyết</span>
                                </div>
                                <div class="legend-item ">
                                    <div class="legend-color bg-warning"></div>
                                    <span>Thực hành</span>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-color bg-danger"></div>
                                    <span>Đại cương</span>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-color bg-success"></div>
                                    <span>Módun</span>
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
    <script>
        // Add interactive functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Add click events to class cards
            const classCards = document.querySelectorAll('.class-card');
            classCards.forEach(card => {
                card.addEventListener('click', function() {
                    alert('Chi tiết lớp học:\n' + this.textContent.trim());
                });
            });

            // Add navigation functionality
            const buttons = document.querySelectorAll('.btn-group .btn');
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    this.parentNode.querySelectorAll('.btn').forEach(b => b.classList.remove(
                        'active'));
                    // Add active class to clicked button
                    this.classList.add('active');
                });
            });

            // Add hover effects to schedule cells
            const scheduleCells = document.querySelectorAll('.schedule-cell');
            scheduleCells.forEach(cell => {
                if (!cell.querySelector('.class-card')) {
                    cell.addEventListener('mouseenter', function() {
                        this.style.backgroundColor = '#f8f9fa';
                    });
                    cell.addEventListener('mouseleave', function() {
                        this.style.backgroundColor = '';
                    });
                }
            });
        });

        // Function to navigate weeks
        function navigateWeek(direction) {
            // This would typically connect to a backend to fetch different week data
            console.log('Navigate week:', direction);
        }

        // Function to export schedule
        function exportSchedule(format) {
            console.log('Export schedule as:', format);
            alert('Xuất lịch học thành công!');
        }

        // Function to print schedule
        function printSchedule() {
            window.print();
        }

        $(document).ready(function() {
            $('#select-tuan').select2({
                placeholder: "Chọn tuần...",
                allowClear: true
            });
        });
    </script>
@endsection
