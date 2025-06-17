@extends('admin.layouts.app')

@section('title', 'Lớp chủ nhiệm')

@section('css')
    
    <style>
        input[type="checkbox"] {
            position: static !important;
            left: auto !important;
            opacity: 1 !important;
            visibility: visible !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Danh sách các lớp chủ nhiệm</h3>
                    </div>

                    <div class="card-body p-2">
                        <div class="row justify-content-start g-4">

                            @foreach ($lops as $lop)
                                <div class="col-md-6 col-lg-4 col-sm-6 mb-4">
                                    <div class="card h-100 shadow-sm"
                                        style="border-radius: 15px; overflow: hidden; border: 1.5px solid #ced4da;">

                                        <!-- Header -->
                                        <div style="background: #007ACC url('https://img.tripi.vn/cdn-cgi/image/width=700,height=700/https://gcs.tripi.vn/public-tripi/tripi-feed/img/482601ikZ/anh-mo-ta.png') no-repeat right center; background-size: cover; height: 100px; position: relative;">
                                            <!-- Overlay đen nhẹ -->
                                            <div style="position: absolute; inset: 0; z-index: 1;">
                                            </div>

                                            <!-- Nội dung -->
                                            <div style="position: relative; z-index: 2;">
                                                <h4 class="text-white fw-bold px-3 pt-3 mb-1">{{ $lop->ten_lop }} (
                                                    {{ $lop->nienKhoa->nam_bat_dau }} - {{ $lop->nienKhoa->nam_ket_thuc }})
                                                </h4>
                                                <p class="text-white px-3 mb-2 fw-bold">
                                                    {{ $lop->giangVien->hoSo->ho_ten }}</p>
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
                                        <div class="card-footer d-flex justify-content-between gap-2 align-items-center"
                                            style="background-color: #f8f9fa; border-top: 1.5px solid #ced4da !important;">
                                            <p><b>Ngành:</b> {{ $lop->giangVien->boMon->nganhHoc->ten_nganh }}</p>
                                            <div class="d-flex">
                                                <a href="{{ route('giangvien.lop.sinhvien', $lop) }}"
                                                    class="btn btn-dark text-white btn-sm">
                                                    <i class="fas fa-solid fa-eye"></i>
                                                </a>
                                                <a href="{{ route('giangvien.lop.nhap-diem_rl', $lop) }}"
                                                    class="btn btn-warning btn-sm mx-1"><i class="fa-solid fa-pencil "></i>
                                                    Điểm rèn luyện
                                                </a>
                                                <a href="{{ route('giangvien.bienbanshcn.index', $lop) }}"
                                                    class="btn btn-success btn-sm text-white"><i
                                                        class="fa-solid fa-file-lines"></i> SHCN</a>
                                            </div>

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
