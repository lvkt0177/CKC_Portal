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
                    <div
                        class="card-header bg-white border-bottom d-flex flex-column flex-md-row justify-content-between gap-3">
                        <!-- Form lọc -->
                        <form class="d-flex flex-wrap gap-2 align-items-end" method="GET"
                            action="{{ route('giangvien.student.index') }}">

                            <!-- Ngành học -->
                            <div>
                                <label for="id_nganh_hoc" class="form-label fw-bold mb-1">Ngành:</label>
                                <select name="ten_chuyen_nganh" id="id_nganh_hoc" onchange="this.form.submit()"
                                    class="form-control">
                                    <option value="" {{ $ten_chuyen_nganh == '' ? 'selected' : '' }}>-- Tất cả ngành
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

                    <div class="card-body p-2">
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


                                        <div class="card-footer d-flex justify-content-between gap-2 align-items-center"
                                            style="background-color: #f8f9fa; border-top: 1.5px solid #ced4da !important;">
                                            <p><b>Ngành:</b> {{ $l->giangVien->boMon->chuyenNganh->ten_nganh }}</p>
                                            <a href="{{ route('giangvien.student.list', ['id' => $l->id]) }}"
                                                class="btn btn-dark text-white btn-sm">
                                                <i class="fas fa-solid fa-eye"></i>
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
