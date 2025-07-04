@extends('admin.layouts.app')

@section('title', 'Quản lý lịch học của sinh viên')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/lop.css') }}">

@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm teams-section">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Danh sách lớp</h3>
                    </div>
                    <div class="card-body">
                        <div class="card-bod p-2">
                            <form class="d-flex flex-wrap gap-2 align-items-end" method="GET"
                                action="{{ route('giangvien.lichhoc.index') }}">

                                <!-- Ngành học -->
                                <div>
                                    <label for="id_nganh_hoc" class="form-label fw-bold mb-1">Ngành:</label>
                                    <select name="ten_chuyen_nganh" id="id_nganh_hoc" onchange="this.form.submit()"
                                        class="form-control">
                                        <option value="" {{ $ten_chuyen_nganh == '' ? 'selected' : '' }}>-- Tất cả
                                            ngành
                                            --
                                        </option>
                                        @foreach ($nganhHocs as $nh)
                                            <option value="{{ $nh->ten_chuyen_nganh }}"
                                                {{ $ten_chuyen_nganh == $nh->ten_chuyen_nganh ? 'selected' : '' }}>
                                                {{ $nh->ten_chuyen_nganh }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mx-1"></div>
                                <!-- Niên khóa -->
                                <div>
                                    <label for="id_nien_khoa" class="form-label fw-bold mb-1">Niên Khóa:</label>
                                    <select name="id_nien_khoa" id="id_nien_khoa" onchange="this.form.submit()"
                                        class="form-control">
                                        @foreach ($nienKhoas as $nk)
                                            <option value="{{ $nk->id }}"
                                                {{ $id_nien_khoa == $nk->id ? 'selected' : '' }}>
                                                {{ $nk->ten_nien_khoa }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="row justify-content-start g-4">
                            @foreach ($lops as $l)
                                <div class=" col-md-6 col-lg-4 col-sm-6 mb-4">
                                    <div class="card h-100 shadow-sm"
                                        style="border-radius: 15px; overflow: hidden; border: 1.5px solid #ced4da;">

                                        <div
                                            style="background: #007ACC url('https://img.tripi.vn/cdn-cgi/image/width=700,height=700/https://gcs.tripi.vn/public-tripi/tripi-feed/img/482601ikZ/anh-mo-ta.png') no-repeat right center; background-size: cover; height: 100px; position: relative;">

                                            <div style="position: absolute; inset: 0; z-index: 1;">
                                            </div>


                                            <div style="position: relative; z-index: 2;">
                                                <h4 class="text-white fw-bold px-3 pt-3 mb-1">{{ $l->ten_lop }}
                                                </h4>
                                                <p class="text-white px-3 mb-2 fw-bold">
                                                    {{ $l->giangVien->hoSo->ho_ten }}</p>
                                            </div>


                                            <img src="{{ asset('' . $l->giangVien->hoSo->anh) }}" alt="Avatar"
                                                style="width: 70px; height: 70px; object-fit: cover; border-radius: 50%; position: absolute; bottom: 10px; right: 15px; border: 1px solid white; z-index: 3;">
                                        </div>


                                        <div class="card-body pt-4" style="background-color: #f8f9fa;">

                                        </div>


                                        <div class="card-footer d-flex justify-content-between gap-2"
                                            style="background-color: #f8f9fa; border-top: 1.5px solid #ced4da !important; padding-top: 12px;">
                                            <p><b>Lớp:</b> {{ $l->ten_lop }}</p>
                                            <a href="{{ route('giangvien.lichhoc.list', ['lop' => $l]) }}"
                                                class="btn  btn-sm">
                                                Xem lịch học
                                            </a>
                                            <a href="{{ route('giangvien.lichhoc.create', ['lop' => $l]) }}"
                                                class="btn  btn-sm">
                                                Tạo lịch học
                                            </a>
                                        </div>
                                    </div>
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
                    content.textContent = this.dataset.content || '---';

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
