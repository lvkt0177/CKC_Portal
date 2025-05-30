@extends('admin.layouts.app')

@section('title', 'Danh sách sinh viên')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Danh sách lớp học</h3>
                    </div>
                    <div class="card-header bg-white border-bottom d-flex flex-column flex-md-row justify-content-between gap-3">

                        <!-- Form lọc -->
                        <form class="d-flex flex-wrap gap-2 align-items-end" method="GET"
                            action="{{ route('admin.student.index') }}">

                            <!-- Ngành học -->
                            <div>
                                <label for="id_nganh_hoc" class="form-label fw-bold mb-1">Ngành:</label>
                                <select name="id_nganh_hoc" id="id_nganh_hoc" onchange="this.form.submit()"
                                    class="form-control">
                                    <option value="" {{ $id_nganh_hoc == '' ? 'selected' : '' }}>-- Tất cả ngành --
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



                    <div class="card-bod p-2">
                        <div class="row justify-content-start g-4">

                            @foreach ($nganhHocs as $nh)
                                @foreach ($lops as $l)
                                    @if ($l->giangVien->boMon->nganhHoc->id == $nh->id)
                                        <div class="col-md-6 col-lg-4 col-sm-6 mb-4">
                                            <div class="card h-100 shadow-sm"
                                                style="border-radius: 15px; overflow: hidden; border: 1.5px solid #ced4da;">

                                                <!-- Header -->
                                                <div
                                                    style="background: #007ACC url('https://img.tripi.vn/cdn-cgi/image/width=700,height=700/https://gcs.tripi.vn/public-tripi/tripi-feed/img/482601ikZ/anh-mo-ta.png') no-repeat right center; background-size: cover; height: 100px; position: relative;">

                                                    <!-- Overlay đen nhẹ -->
                                                    <div
                                                        style="background-color: rgba(0, 0, 0, 0.4); position: absolute; inset: 0; z-index: 1;">
                                                    </div>

                                                    <!-- Nội dung -->
                                                    <div style="position: relative; z-index: 2;">
                                                        <h4 class="text-white fw-bold px-3 pt-3 mb-1">{{ $l->ten_lop }}
                                                        </h4>
                                                        <p class="text-white px-3 mb-2 fw-bold">
                                                            {{ $l->giangVien->hoSo->ho_ten }}</p>
                                                    </div>

                                                    <!-- Avatar -->
                                                    <img src="{{ asset('' . $l->giangVien->hoSo->anh) }}" alt="Avatar"
                                                        style="width: 70px; height: 70px; object-fit: cover; border-radius: 50%; position: absolute; bottom: -20px; right: 15px; border: 1px solid white; z-index: 3;">
                                                </div>

                                                <!-- Body -->
                                                <div class="card-body pt-4" style="background-color: #f8f9fa;">
                                                    {{-- Nội dung khác nếu có --}}
                                                </div>

                                                <!-- Footer -->
                                                <div class="card-footer d-flex justify-content-between gap-2"
                                                    style="background-color: #f8f9fa; border-top: 1.5px solid #ced4da !important; padding-top: 12px;">
                                                    <p><b>Ngành:</b> {{ $l->giangVien->boMon->nganhHoc->ten_nganh }}</p>
                                                    <a href="{{ route('admin.student.list', ['id' => $l->id]) }}"
                                                        class="btn btn-outline-primary btn-sm">
                                                        <i class="la la-eye"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
