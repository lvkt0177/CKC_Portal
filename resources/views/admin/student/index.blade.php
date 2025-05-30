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


                    <div class="card-body mt-5">
                        <form class="d-flex align-items-center gap-2 mb-3" method="GET" action="{{ route('admin.student.index') }}">
                            <label for="id_nganh_hoc" class="mb-0 fw-bold ">Ngành: </label>
                            <select name="id_nganh_hoc" id="id_nganh_hoc" onchange="this.form.submit()" class=" text-center form-control w-25">
                                <option value="" {{ $id_nganh_hoc == '' ? 'selected' : '' }}>-- Tất cả ngành --</option>
                                @foreach ($nganhHocs as $nh)
                                    <option value="{{ $nh->id }}" {{ $id_nganh_hoc == $nh->id ? 'selected' : '' }}>
                                        {{ $nh->ten_nganh }}
                                    </option>
                                @endforeach
                            </select>
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
                    <div class="card-bod p-2">
                            @foreach ($nganhHocs as $nh)
                                @foreach ($lops as $l)
                                    @if($l->giangVien->boMon->nganhHoc->id == $nh->id)
                                        <div class=" p-3">
                                            <div class="col-md-6 col-lg-4">
                                                <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #1D62F0 , #8b5cf6); color: white; border-radius: 15px;">
                                                    <div class="card-header border-0 d-flex justify-content-between align-items-center p-4" style="background: transparent;">
                                                        <h5 class="card-title mb-0 fw-bold text-light">{{$l->ten_lop}}</h5>
                                                        <p class="card-text mb-0 small opacity-75">GVCN: {{$l->giangVien->hoSo->ho_ten}}</p>
                                                        <p class="card-text mb-0 small opacity-75">Sỉ Số: {{$l->si_so}}</p>
                                                    </div>

                                                    <div class="card-body flex-grow-1">Ngành: {{$l->giangVien->boMon->nganhHoc->ten_nganh}}</div>

                                                    <div class="card-footer border-0 d-flex justify-content-between align-items-center p-4" style="background: rgba(0,0,0,0.1);">
                                                        <div class="d-flex gap-2">
                                                            <a href="{{ route('admin.student.list', ['id' => $l->id]) }}" class="btn btn-sm text-white p-2" style="background: rgba(255,255,255,0.2); border-radius: 8px;">
                                                                Xem danh sách sinh viên
                                                            </a>
                                                        </div>
                                                    </div>
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

@endsection
