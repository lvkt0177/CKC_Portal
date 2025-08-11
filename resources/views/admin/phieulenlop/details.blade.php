@extends('admin.layouts.app')

@section('title', 'Công tác giảng dạy')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/lich.css') }}">
    <style>
        .modal-content {
            border-radius: 12px;
        }

        .modal-header {
            border-bottom: 2px solid #007bff;
        }

        .modal-body ul li {
            margin-bottom: 6px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid teams-section">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm teams-section">
                    <div class="container-fluid">

                        <div class="header-section">
                            <div class="container">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <h4 class="mb-0 text-primary">
                                            <i class="fas fa-calendar-alt me-2"></i>
                                            Sổ lên lớp tuần {{ $tuanHienTai->tuan }}
                                            ({{ $tuanHienTai->ngay_bat_dau->format('d/m/Y') }}
                                            -
                                            {{ $tuanHienTai->ngay_ket_thuc->format('d/m/Y') }})</h3>

                                        </h4>
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
                                            <th class="time-column text-white" style="background: #2c3e50;">Ca
                                                học</th>
                                            @foreach ($ngayTrongTuan as $ngay)
                                                <th class="day-header text-white" style="background: #2c3e50;">
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
                                                <td class="schedule-cell"
                                                    style="background-image: url('https://giaydantuongsacmau.com/upload/product/2020/12/10/giay-dan-tuong-soc-caro-image-20201210161206-350433-thumb.png');">
                                                    @php
                                                        $daDung = [];
                                                    @endphp

                                                    @for ($so = 1; $so <= 6; $so++)
                                                        @php $rendered = false; @endphp

                                                        @foreach ($phieuLenLop as $pll)
                                                            @php
                                                                $bat_dau = $pll->tiet_bat_dau;
                                                                $so_tiet = $pll->so_tiet;
                                                                $ket_thuc = $bat_dau + $so_tiet - 1;
                                                            @endphp

                                                            @if ($pll->ngay == $ngay->format('Y-m-d'))
                                                                @if ($so == $bat_dau && !in_array($pll->id, $daDung))
                                                                    <div class="class-card web-dev mb-2 border-left-{{ $pll->lopHocPhan->loai_mon->getBadge() }}"
                                                                        data-subject="{{ $pll->lopHocPhan->ten_hoc_phan }}"
                                                                        data-class="{{ $pll->lopHocPhan->lop->ten_lop }}"
                                                                        data-period="{{ $pll->tiet_bat_dau }}-{{ $pll->so_tiet + $pll->tiet_bat_dau - 1 }}"
                                                                        data-room="{{ $pll->phong->ten }}"
                                                                        data-teacher="{{ $pll->lopHocPhan->giangVien->hoSo->ho_ten }}"
                                                                        data-date="{{ \Carbon\Carbon::parse($pll->ngay)->format('d/m/Y') }}"
                                                                        data-content="{{ $pll->noi_dung }}">
                                                                        <div class="class-title">
                                                                            {{ $pll->lopHocPhan->ten_hoc_phan }}
                                                                        </div>
                                                                        <div class="class-details">
                                                                            Lớp:
                                                                            {{ $pll->lopHocPhan->lop->ten_lop }}<br>
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
                                                <td class="schedule-cell"
                                                    style="background-image: url('https://giaydantuongsacmau.com/upload/product/2020/12/10/giay-dan-tuong-soc-caro-image-20201210161206-350433-thumb.png')">
                                                    @php
                                                        $daDung = [];
                                                    @endphp

                                                    @for ($so = 7; $so <= 12; $so++)
                                                        @php $rendered = false; @endphp

                                                        @foreach ($phieuLenLop as $pll)
                                                            @php
                                                                $bat_dau = $pll->tiet_bat_dau;
                                                                $so_tiet = $pll->so_tiet;
                                                                $ket_thuc = $bat_dau + $so_tiet - 1;
                                                            @endphp

                                                            @if ($pll->ngay == $ngay->format('Y-m-d'))
                                                                @if ($so == $bat_dau && !in_array($pll->id, $daDung))
                                                                    <div class="class-card web-dev mb-2 border-left-{{ $pll->lopHocPhan->loai_mon->getBadge() }}"
                                                                        data-subject="{{ $pll->lopHocPhan->ten_hoc_phan }}"
                                                                        data-class="{{ $pll->lopHocPhan->lop->ten_lop }}"
                                                                        data-period="{{ $pll->tiet_bat_dau }}-{{ $pll->so_tiet + $pll->tiet_bat_dau - 1 }}"
                                                                        data-room="{{ $pll->phong->ten }}"
                                                                        data-teacher="{{ $pll->lopHocPhan->giangVien->hoSo->ho_ten }}"
                                                                        data-date="{{ \Carbon\Carbon::parse($pll->ngay)->format('d/m/Y') }}">
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
                                                <td class="schedule-cell"
                                                    style="background-image: url('https://giaydantuongsacmau.com/upload/product/2020/12/10/giay-dan-tuong-soc-caro-image-20201210161206-350433-thumb.png')">
                                                    @php
                                                        $daDung = [];
                                                    @endphp

                                                    @for ($so = 13; $so <= 15; $so++)
                                                        @php $rendered = false; @endphp

                                                        @foreach ($phieuLenLop as $pll)
                                                            @php
                                                                $bat_dau = $pll->tiet_bat_dau;
                                                                $so_tiet = $pll->so_tiet;
                                                                $ket_thuc = $bat_dau + $so_tiet - 1;
                                                            @endphp

                                                            @if ($pll->ngay == $ngay->format('Y-m-d'))
                                                                @if ($so == $bat_dau && !in_array($pll->id, $daDung))
                                                                    <div class="class-card web-dev mb-2 border-left-{{ $pll->lopHocPhan->loai_mon->getBadge() }}"
                                                                        data-subject="{{ $pll->lopHocPhan->ten_hoc_phan }}"
                                                                        data-class="{{ $pll->lopHocPhan->lop->ten_lop }}"
                                                                        data-period="{{ $pll->tiet_bat_dau }}-{{ $pll->so_tiet + $pll->tiet_bat_dau - 1 }}"
                                                                        data-room="{{ $pll->phong->ten }}"
                                                                        data-teacher="{{ $pll->lopHocPhan->giangVien->hoSo->ho_ten }}"
                                                                        data-date="{{ \Carbon\Carbon::parse($pll->ngay)->format('d/m/Y') }}">
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
    </div>


    <div class="modal fade" id="classDetailModal" tabindex="-1" aria-labelledby="classDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content shadow-lg rounded-4">
                <div class="modal-header text-white rounded-top-4" style="background:#2c3e50">
                    <h5 class="modal-title" id="classDetailLabel">
                        <i class="bi bi-info-circle-fill me-2"></i> Chi tiết lớp học
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Đóng"></button>
                </div>
                <div class="modal-body p-4"
                    style="background-image: url('https://giaydantuongsacmau.com/upload/product/2020/12/10/giay-dan-tuong-soc-caro-image-20201210161206-350433-thumb.png')">
                    <ul class="list-unstyled">
                        <li><strong>Môn học:</strong> <span id="subjectName">---</span></li>
                        <li><strong>Lớp:</strong> <span id="className">---</span></li>
                        <li><strong>Tiết:</strong> <span id="period">---</span></li>
                        <li><strong>Phòng:</strong> <span id="room">---</span></li>
                        <li><strong>Giảng viên:</strong> <span id="teacher">---</span></li>
                        <li><strong>Ngày học:</strong> <span id="date">---</span></li>
                        <li><strong>Nội dung buổi học:</strong> <span id="content">---</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        const classCards = document.querySelectorAll('.class-card');
        const modalElement = document.getElementById('classDetailModal');
        const modal = new bootstrap.Modal(modalElement);



        const subjectName = document.getElementById('subjectName');
        const className = document.getElementById('className');
        const period = document.getElementById('period');
        const room = document.getElementById('room');
        const teacher = document.getElementById('teacher');
        const date = document.getElementById('date');
        const content = document.getElementById('content');


        document.addEventListener('DOMContentLoaded', function() {

            classCards.forEach(card => {
                card.addEventListener('click', function() {
                    subjectName.textContent = this.dataset.subject || '---';
                    className.textContent = this.dataset.class || '---';
                    period.textContent = this.dataset.period || '---';
                    room.textContent = this.dataset.room || '---';
                    teacher.textContent = this.dataset.teacher || '---';
                    date.textContent = this.dataset.date || '---';
                    content.textContent = this.dataset.content || '---';

                    modal.show();
                });
            });

            const buttons = document.querySelectorAll('.btn-group .btn');
            buttons.forEach(button => {
                button.addEventListener('click', function() {

                    this.parentNode.querySelectorAll('.btn').forEach(b => b.classList.remove(
                        'active'));

                    this.classList.add('active');
                });
            });


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

        function navigateWeek(direction) {
            console.log('Navigate week:', direction);
        }

        function exportSchedule(format) {
            console.log('Export schedule as:', format);
            alert('Xuất lịch học thành công!');
        }

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
