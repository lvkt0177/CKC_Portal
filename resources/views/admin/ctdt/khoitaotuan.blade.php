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
                        <a href="{{ route('giangvien.ctdt.show', ['nam_bat_dau' => now()->year]) }}"
                            class="btn btn-info mt-2">
                            📅 Xem danh sách tuần của năm {{ session('created_year') }}
                        </a>
                        <a href="{{ route('giangvien.ctdt.index') }}" class="btn btn-primary">Quay lại</a>
                    </div>
                </div>
                <div class="card-body">
                    <form id="schoolYearForm" action="{{ route('giangvien.ctdt.store') }}" method="POST" data-confirm>
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label for="startDate">🗓️ Ngày bắt đầu tuần đầu tiên:</label>
                                <input name="date" type="date" id="startDate" required>
                                @error('date')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Khởi tạo hoặc sửa tuần học</button>
                    </form>



                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
