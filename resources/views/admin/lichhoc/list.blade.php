@extends('admin.layouts.app')

@section('title', 'Quản lý lịch học của sinh viên')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/lich.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/lucide@0.273.0/dist/umd/lucide.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card shadow-sm " style="height: 700px;">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <form method="GET" action="{{ route('giangvien.lichhoc.list', ['lop' => $lop]) }}" id="week-form">
                        <div class="relative min-w-[20rem]" id="dropdown-container">
                            <button type="button" id="dropdown-toggle"
                                class="w-full px-4 py-3 text-left bg-transparent border-none focus:outline-none focus:ring-0 hover:bg-gray-100 rounded-lg transition flex items-center justify-between gap-2">
                                <span id="selected-option" class="whitespace-nowrap">
                                    Lịch học - Lớp {{ $lop->ten_lop }} - {{ $hocKy->ten_hoc_ky }}
                                </span>
                                <svg id="chevron" class="h-4 w-4 text-gray-500 transition-transform ml-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="6"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div id="dropdown-menu"
                                class="hidden absolute top-full left-0 w-full mt-1 bg-white rounded-lg shadow-lg border border-gray-200 z-10 ">
                                @foreach ($dsHocKy as $ky)
                                    <button type="button" data-value="{{ $ky->id }}"
                                        class="dropdown-item px-4 py-3 text-left hover:bg-blue-50 hover:text-blue-600 transition">
                                        Lịch học - Lớp {{ $lop->ten_lop }} - {{ $ky->ten_hoc_ky }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                        <input type="hidden" name="hoc_ky" id="selected-hoc-ky" value="{{ $hocKy->id }}">
                    </form>
                    <a href="{{ route('giangvien.lichhoc.index') }}" class="btn btn-primary">Quay lại</a>
                </div>




                @include('admin.lichhoc.partials.schedule-table', [
                    'thoikhoabieu' => $thoikhoabieu,
                    'ngayTrongTuan' => $ngayTrongTuan,
                    'lop' => $lop,
                    'dsTuan' => $dsTuan,
                    'tuanDangChon' => $tuanDangChon,
                    'hocKy' => $hocKy,
                ])

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




        const toggle = document.getElementById('dropdown-toggle');
        const menu = document.getElementById('dropdown-menu');
        const chevron = document.getElementById('chevron');
        const selectedOption = document.getElementById('selected-option');
        const container = document.getElementById('dropdown-container');
        const hiddenInput = document.getElementById('selected-hoc-ky');

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

        toggle.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            chevron.classList.toggle('rotate-180');
        });

        document.addEventListener('click', function(e) {
            if (!container.contains(e.target)) {
                menu.classList.add('hidden');
                chevron.classList.remove('rotate-180');
            }
        });
        Array.from(menu.children).forEach((item) => {
            item.addEventListener('click', () => {
                const label = item.textContent.trim();
                const value = item.getAttribute('data-value');

                selectedOption.textContent = label;
                hiddenInput.value = value;


                const form = document.getElementById('week-form');
                const tuanSelect = form.querySelector('[name="id_tuan"]');
                if (tuanSelect) tuanSelect.remove();

                form.submit();
            });
        });
    </script>
@endsection
