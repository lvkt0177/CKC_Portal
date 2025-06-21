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
                                    <select name="id_nganh_hoc" id="id_nganh_hoc" onchange="this.form.submit()"
                                        class="form-control">
                                        <option value="" {{ $id_nganh_hoc == '' ? 'selected' : '' }}>-- Tất cả ngành
                                            --
                                        </option>
                                        @foreach ($nganhHocs as $nh)
                                            <option value="{{ $nh->id }}"
                                                {{ $id_nganh_hoc == $nh->id ? 'selected' : '' }}>
                                                {{ $nh->ten_nganh }}
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
                            @foreach ($lops as $lop)
                                <div class="col-md-6 col-lg-4 col-sm-6 mb-4">
                                    <div class="card h-100 shadow-sm"
                                        style="border-radius: 15px; overflow: hidden; border: 1.5px solid #ced4da;">

                                        <!-- Header -->
                                        <div class="class-header" style="  height: 100px; position: relative;">

                                            <!-- Overlay đen nhẹ -->
                                            <div style="position: absolute; inset: 0; z-index: 1;">
                                            </div>

                                            <!-- Nội dung -->
                                            <div style="position: relative; z-index: 2;">
                                                <h4 class="text-white fw-bold px-3 pt-3 mb-1">{{ $lop->ten_hoc_phan }}
                                                </h4>
                                                <p class="text-white px-3 mb-2 fw-bold">
                                                    {{ $lop->giangVien->hoSo->ho_ten }}
                                                </p>
                                            </div>

                                            <!-- Avatar -->
                                            <img src="{{ asset('' . $lop->giangVien->hoSo->anh) }}" alt="Avatar"
                                                style="width: 70px; height: 70px; object-fit: cover; border-radius: 50%; position: absolute; bottom: 10px; right: 15px; border: 1px solid white; z-index: 3;">
                                        </div>

                                        <!-- Body -->
                                        <div class="card-body pt-4" style="background-color: #f8f9fa;">
                                            {{-- Nội dung khác nếu có --}}
                                        </div>

                                        <!-- Footer -->
                                        <div class="card-footer d-flex justify-content-between gap-2"
                                            style="background-color: #f8f9fa; border-top: 1.5px solid #ced4da !important; padding-top: 12px;">
                                            <p><b>Lớp:</b> {{ $lop->ten_lop }}</p>
                                            <a href="{{ route('giangvien.lichhoc.list', ['lop' => $lop]) }}"
                                                class="btn  btn-sm">
                                                Xem lịch học
                                            </a>
                                            <a href="{{ route('giangvien.lichhoc.create', ['lop' => $lop]) }}"
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
    </div>

@endsection
