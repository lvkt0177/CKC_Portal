@extends('client.layouts.app')

@section('title', 'Thời Khóa Biểu')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/lich.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Thời khóa biểu tuần thứ
                        {{ $tuan->tuan }}
                        ({{ $tuan->ngay_bat_dau->format('d/m/Y') }}
                        -
                        {{ $tuan->ngay_ket_thuc->format('d/m/Y') }})
                    </h3>
                </div>

                <form method="GET" action="{{ route('sinhvien.thoikhoabieu.index') }}" id="week-form">
                    <input type="hidden" name="action" id="week-action" value="">

                    {{-- Chọn Năm --}}
                    @php
                        $namHienTai = now()->year;
                        $namDangChon = request('nam', $namHienTai);
                        $tuanHienTai = now()->weekOfYear;
                        $tuanDangChon = request('id_tuan', $tuanHienTai);
                        $soTuan = $namDangChon == $namHienTai ? $tuanHienTai : 52;
                    @endphp

                    <div class="d-flex justify-content-end align-items-center">
                        <div class="nav-buttons w-100">

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="p-1">Năm:</label>
                                <select class="form-control" name="nam"
                                    onchange="document.getElementById('week-form').submit()">
                                    @for ($i = 0; $i < 4; $i++)
                                        @php $nam = $namHienTai - $i; @endphp
                                        <option value="{{ $nam }}" {{ $namDangChon == $nam ? 'selected' : '' }}>
                                            Năm {{ $nam }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="p-1">Tuần:</label>
                                <select class="form-control" name="id_tuan"
                                    onchange="document.getElementById('week-form').submit()">
                                    @for ($i = 1; $i <= $soTuan; $i++)
                                        <option value="{{ $i }}" {{ $tuanDangChon == $i ? 'selected' : '' }}>
                                            Tuần {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                </form>


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

                                                @foreach ($thoikhoabieu as $tkb)
                                                    @php
                                                        $bat_dau = $tkb->tiet_bat_dau;
                                                        $ket_thuc = $tkb->tiet_ket_thuc;
                                                        $so_tiet = $ket_thuc - $bat_dau + 1;
                                                    @endphp

                                                    @if ($tkb->ngay == $ngay->format('Y-m-d'))
                                                        @if ($so == $bat_dau && !in_array($tkb->id, $daDung))
                                                            <div class="class-card web-dev mb-2 border-left-{{ $tkb->lopHocPhan->loai_mon->getBadge() }}"
                                                                data-subject="{{ $tkb->lopHocPhan->ten_hoc_phan }}"
                                                                data-class="{{ $tkb->lopHocPhan->lop->ten_lop }}"
                                                                data-period="{{ $tkb->tiet_bat_dau }}-{{ $tkb->tiet_ket_thuc }}"
                                                                data-room="{{ $tkb->phong->ten }}"
                                                                data-teacher="{{ $tkb->lopHocPhan->giangVien->hoSo->ho_ten }}"
                                                                data-date="{{ \Carbon\Carbon::parse($tkb->ngay)->format('d/m/Y') }}">
                                                                <div class="class-title">
                                                                    {{ $tkb->lopHocPhan->ten_hoc_phan }}
                                                                </div>
                                                                <div class="class-details">
                                                                    Lớp: {{ $tkb->lopHocPhan->lop->ten_lop }}<br>
                                                                    Tiết:
                                                                    {{ $tkb->tiet_bat_dau }}-{{ $tkb->tiet_ket_thuc }}<br>
                                                                    Phòng: {{ $tkb->phong->ten }}<br>
                                                                    GV:
                                                                    {{ $tkb->lopHocPhan->giangVien->hoSo->ho_ten }}<br>
                                                                    Ngày:
                                                                    {{ \Carbon\Carbon::parse($tkb->ngay)->format('d/m/Y') }}
                                                                </div>
                                                            </div>
                                                            @php
                                                                $rendered = true;
                                                                $daDung[] = $tkb->id;
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

                                {{--  Afternoon Session --}}
                                <tr>
                                    <td class="time-column">Chiều</td>
                                    @foreach ($ngayTrongTuan as $ngay)
                                        <td class="schedule-cell"
                                            style="background-image: url('https://giaydantuongsacmau.com/upload/product/2020/12/10/giay-dan-tuong-soc-caro-image-20201210161206-350433-thumb.png');">
                                            @php
                                                $daDung = [];
                                            @endphp

                                            @for ($so = 7; $so <= 12; $so++)
                                                @php $rendered = false; @endphp

                                                @foreach ($thoikhoabieu as $tkb)
                                                    @php
                                                        $bat_dau = $tkb->tiet_bat_dau;
                                                        $ket_thuc = $tkb->tiet_ket_thuc;
                                                        $so_tiet = $ket_thuc - $bat_dau + 1;
                                                    @endphp

                                                    @if ($tkb->ngay == $ngay->format('Y-m-d'))
                                                        @if ($so == $bat_dau && !in_array($tkb->id, $daDung))
                                                            <div class="class-card web-dev mb-2 border-left-{{ $tkb->lopHocPhan->loai_mon->getBadge() }}"
                                                                data-subject="{{ $tkb->lopHocPhan->ten_hoc_phan }}"
                                                                data-class="{{ $tkb->lopHocPhan->lop->ten_lop }}"
                                                                data-period="{{ $tkb->tiet_bat_dau }}-{{ $tkb->tiet_ket_thuc }}"
                                                                data-room="{{ $tkb->phong->ten }}"
                                                                data-teacher="{{ $tkb->lopHocPhan->giangVien->hoSo->ho_ten }}"
                                                                data-date="{{ \Carbon\Carbon::parse($tkb->ngay)->format('d/m/Y') }}">
                                                                <div class="class-title">
                                                                    {{ $tkb->lopHocPhan->ten_hoc_phan }}
                                                                </div>
                                                                <div class="class-details">
                                                                    Lớp: {{ $tkb->lopHocPhan->lop->ten_lop }}<br>
                                                                    Tiết:
                                                                    {{ $tkb->tiet_bat_dau }}-{{ $tkb->tiet_ket_thuc }}<br>
                                                                    Phòng: {{ $tkb->phong->ten }}<br>
                                                                    GV:
                                                                    {{ $tkb->lopHocPhan->giangVien->hoSo->ho_ten }}<br>
                                                                    Ngày:
                                                                    {{ \Carbon\Carbon::parse($tkb->ngay)->format('d/m/Y') }}
                                                                </div>
                                                            </div>
                                                            @php
                                                                $rendered = true;
                                                                $daDung[] = $tkb->id;
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

                                {{-- Evening Session --}}
                                <tr>
                                    <td class="time-column">Tối</td>
                                    @foreach ($ngayTrongTuan as $ngay)
                                        <td class="schedule-cell"
                                            style="background-image: url('https://giaydantuongsacmau.com/upload/product/2020/12/10/giay-dan-tuong-soc-caro-image-20201210161206-350433-thumb.png');">
                                            @php
                                                $daDung = [];
                                            @endphp

                                            @for ($so = 13; $so <= 15; $so++)
                                                @php $rendered = false; @endphp

                                                @foreach ($thoikhoabieu as $tkb)
                                                    @php
                                                        $bat_dau = $tkb->tiet_bat_dau;
                                                        $ket_thuc = $tkb->tiet_ket_thuc;
                                                        $so_tiet = $ket_thuc - $bat_dau + 1;
                                                    @endphp

                                                    @if ($tkb->ngay == $ngay->format('Y-m-d'))
                                                        @if ($so == $bat_dau && !in_array($tkb->id, $daDung))
                                                            <div class="class-card web-dev mb-2 border-left-{{ $tkb->lopHocPhan->loai_mon->getBadge() }}"
                                                                data-subject="{{ $tkb->lopHocPhan->ten_hoc_phan }}"
                                                                data-class="{{ $tkb->lopHocPhan->lop->ten_lop }}"
                                                                data-period="{{ $tkb->tiet_bat_dau }}-{{ $tkb->tiet_ket_thuc }}"
                                                                data-room="{{ $tkb->phong->ten }}"
                                                                data-teacher="{{ $tkb->lopHocPhan->giangVien->hoSo->ho_ten }}"
                                                                data-date="{{ \Carbon\Carbon::parse($tkb->ngay)->format('d/m/Y') }}">
                                                                <div class="class-title">
                                                                    {{ $tkb->lopHocPhan->ten_hoc_phan }}
                                                                </div>
                                                                <div class="class-details">
                                                                    Lớp: {{ $tkb->lopHocPhan->lop->ten_lop }}<br>
                                                                    Tiết:
                                                                    {{ $tkb->tiet_bat_dau }}-{{ $tkb->tiet_ket_thuc }}<br>
                                                                    Phòng: {{ $tkb->phong->ten }}<br>
                                                                    GV:
                                                                    {{ $tkb->lopHocPhan->giangVien->hoSo->ho_ten }}<br>
                                                                    Ngày:
                                                                    {{ \Carbon\Carbon::parse($tkb->ngay)->format('d/m/Y') }}
                                                                </div>
                                                            </div>
                                                            @php
                                                                $rendered = true;
                                                                $daDung[] = $tkb->id;
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
    {{-- Modal chi tiết lớp học --}}
    <div class="modal fade" id="classDetailModal" tabindex="-1" aria-labelledby="classDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content shadow-lg rounded-4">
                <div class="modal-header text-white rounded-top-4" style="background: #2c3e50">
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
                    </ul>
                </div>
                <div class="modal-footer bg-light rounded-bottom-4">
                    <button type="button" class="btn btn-back" data-bs-dismiss="modal">Đóng</button>
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

        // Add interactive functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Add click events to class cards
            classCards.forEach(card => {
                card.addEventListener('click', function() {
                    subjectName.textContent = this.dataset.subject || '---';
                    className.textContent = this.dataset.class || '---';
                    period.textContent = this.dataset.period || '---';
                    room.textContent = this.dataset.room || '---';
                    teacher.textContent = this.dataset.teacher || '---';
                    date.textContent = this.dataset.date || '---';

                    modal.show(); // <-- phải gọi đúng!
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
