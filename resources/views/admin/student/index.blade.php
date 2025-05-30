@extends('admin.layouts.app')

@section('title', 'Danh sách sinh viên')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{-- <h3 class="card-title mb-0"> Sinh Viên </h3> --}}

                        {{-- <a href="" class="btn btn-primary">Thêm ABC</a> --}}

                    </div>

                    <div class="card-body">

                        {{-- <div class="my-2">
                            <form method="GET" action="{{ route('admin.student.index') }}">
                                <label for="id_lop">Lọc theo lớp:</label>
                                <select class="btn" name="id_lop" id="id_lop">
                                    <option value="">-- Tất cả lớp --</option>
                                    @foreach ($lops as $lop)
                                        <option value="{{ $lop }}" {{ $id_lop == $lop->id ? 'selected' : '' }}>
                                            {{ $lop->ten_lop }}
                                        </option>
                                    @endforeach
                                </select>
                                <button class="btn btn-primary" type="submit">Lọc</button>
                            </form>
                        </div> --}}
                           <div class="d-flex justify-content-center align-items-center">
                            @foreach ($nganhHocs as $nh)
                                <form action="" class="mx-4">
                                    <button class="btn text-dark">{{$nh->ten_nganh}}</button>
                                </form>
                            @endforeach
                           </div>   
                    </div>
                    <div class="card-body mt-5">
                        <form class="d-flex align-items-center gap-2 mb-3" method="GET" action="{{ route('admin.student.index') }}">
                            <label for="id_nien_khoa" class="mb-0 fw-bold ">Niên Khóa:</label>
                            <select name="id_nien_khoa" id="id_nien_khoa" onchange="this.form.submit()" class=" text-center form-control w-25">
                                @foreach ($nienKhoas as $nk)
                                    <option value="{{ $nk->id }}" {{ $id_nien_khoa == $nk->id ? 'selected' : '' }}>
                                        {{ $nk->ten_nien_khoa }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    <div class="card-bod">
                        <div class="row p-3">
                            @foreach ($lops as $l)
                                <div class="col-md-6 col-lg-4">
                                    <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #6f42c1, #8b5cf6); color: white; border-radius: 15px;">
                                        <div class="card-header border-0 d-flex justify-content-between align-items-center p-4" style="background: transparent;">
                                            <h5 class="card-title mb-0 fw-bold text-light">{{$l->ten_lop}}</h5>
                                            <p class="card-text mb-0 small opacity-75">GVCN: {{$l->giangVien->hoSo->ho_ten}}</p>
                                            <p class="card-text mb-0 small opacity-75">Sỉ Số: {{$l->si_so}}</p>
                                            <div class="dropdown">
                                                <button class="btn btn-sm text-white p-2" type="button" data-bs-toggle="dropdown" style="background: rgba(255,255,255,0.2); border-radius: 50%;">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="#"><i class="fas fa-share me-2"></i>Chia sẻ</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="fas fa-bookmark me-2"></i>Lưu</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="fas fa-flag me-2"></i>Báo cáo</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="card-body flex-grow-1"></div>

                                        <div class="card-footer border-0 d-flex justify-content-between align-items-center p-4" style="background: rgba(0,0,0,0.1);">
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.student.list', ['id' => $l->id]) }}" class="btn btn-sm text-white p-2" style="background: rgba(255,255,255,0.2); border-radius: 8px;">
                                                    Xem danh sách sinh viên
                                                </a>
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
