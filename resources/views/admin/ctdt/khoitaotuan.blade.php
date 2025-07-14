@extends('admin.layouts.app')

@section('title', 'Khởi tạo tuần của năm học')

@section('css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="{{ asset('assets/admin/css/khoitaotuan.css') }}">
@endsection


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0"> Khởi tạo tuần </h3>

                        <a href="{{ route('giangvien.ctdt.index') }}" class="btn btn-primary">Quay lại</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('giangvien.ctdt.show', ['nam_bat_dau' => now()->year]) }}"
                                class="btn text-primary m-2">
                                Xem danh sách tuần
                            </a>
                        </div>
                        <div class="header">
                            <h1>Quản lý tuần học</h1>
                            <p>Khởi tạo hoặc chỉnh sửa thông tin tuần học</p>
                        </div>

                        <form id="schoolYearForm" action="{{ route('giangvien.ctdt.store') }}" method="POST" data-confirm>
                            @csrf
                            <input type="hidden" name="_token" value="csrf-token-here" class="csrf-token">

                            <div class="form-group">
                                <label for="start_date" class="form-label">Ngày bắt đầu tuần đầu tiên</label>
                                <input type="date" id="start_date" name="date" class="form-input" value=""
                                    required>
                                @error('date')
                                    <span>{{ $message }}</span>
                                @enderror
                                <div class="error-message" id="date-error">
                                    Vui lòng chọn ngày bắt đầu hợp lệ
                                </div>
                            </div>

                            <button type="submit" class="submit-btn">
                                Khởi tạo tuần học
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('start_date');
            const ngayKetThucNamHoc = "{{ $ngayKetThucNamHoc->ngay_ket_thuc->format('Y-m-d') }}";
            dateInput.min = ngayKetThucNamHoc;
        });
    </script>
@endsection
