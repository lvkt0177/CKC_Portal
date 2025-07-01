@extends('admin.layouts.app')

@section('title', 'Tạo lịch thi của sinh viên')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/taolichthi.css') }}">
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm teams-section">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <form action="{{ route('giangvien.lichthi.create', ['lop' => $lop]) }}" method="GET"
                            class="col-5 d-flex">
                            <select id="chonHocKy" name="hoc_ky" onchange="this.form.submit()">
                                @foreach ($dsHocKy as $hk)
                                    <option class="fs-5" value="{{ $hk->id }}"
                                        {{ $hk->id == $hocKy->id ? 'selected' : '' }}>
                                        <h3 class="card-title mb-0">📅 Tạo lịch thi {{ $lop->ten_lop }}
                                            {{ $hk->ten_hoc_ky }}
                                        </h3>
                                    </option>
                                @endforeach
                            </select>
                            <select name="tuan" id="" onchange="this.form.submit()" class="col-2">
                                @foreach ($dsTuan as $tuan)
                                    @if ($loop->index >= 16)
                                        <option class="fs-5" value="{{ $tuan->id }}"
                                            {{ $tuan->id == optional($tuanDangChon)->id ? 'selected' : '' }}>
                                            Tuần {{ $loop->index + 1 }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </form>
                        <a href="{{ route('giangvien.lichthi.index') }}" class="btn btn-primary">Quay lại</a>
                    </div>
                    <div class="card-body">
                        <form id="examForm" action="{{ route('giangvien.lichthi.store') }}" method="POST">
                            <div class="form-group mt-3">
                                <label for="examName">Tên môn thi</label>
                                <select name="mon_thi" id="selectMonThi">
                                    @foreach ($dsLopHP as $lophp)
                                        <option value="{{ $lophp->id }}">{{ $lophp->ten_hoc_phan }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row">
                                <div class="form-group col-4">
                                    <label for="examDate">Ngày thi</label>
                                    <select name="ngay_thi" id="">
                                        @foreach ($ngayTrongTuan as $ngay)
                                            <option value="{{ $ngay->toDateString() }}">
                                                {{ ucwords($ngay->locale('vi')->translatedFormat('l, d/m/Y')) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-4">
                                    <label for="examTime">Giờ bắt đầu</label>
                                    <input type="thoi_gian_thi" id="examTime" name="examTime" required>
                                </div>
                                <div class="form-group col-4">
                                    <label for="duration">Thời gian làm bài (phút)</label>
                                    <input type="number" id="duration" name="so_phut_thi" placeholder="45" min="30"
                                        step="5" max="300" required>
                                </div>
                            </div>

                            <div class="row">

                                <div class="form-group col-6">
                                    <label for="examType">Lần thi</label>
                                    <select name="lan_thi" required style="padding: 15px">
                                        <option value="1">Thi lần 1</option>
                                        <option value="2">Thi lần 2</option>
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="room">Phòng thi</label>
                                    <select name="phong" class="form-select" style="padding: 15px">
                                        @foreach ($phong as $ph)
                                            <option value="{{ $ph->id }}">{{ $ph->ten }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">

                                <div class="form-group col-6">
                                    <label for="supervisor">Giám thị 1</label>
                                    <select name="id_giam_thi_1" class="form-select" style="padding: 15px">
                                        @foreach ($giam_thi as $gth)
                                            <option value="{{ $gth->id }}">{{ $gth->hoSo->ho_ten }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="supervisor">Giám thị 2</label>
                                    <select name="id_giam_thi_2" class="form-select" style="padding: 15px">
                                        @foreach ($giam_thi as $gth)
                                            <option value="{{ $gth->id }}">{{ $gth->hoSo->ho_ten }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="btn-container d-flex justify-content-end">
                                <button type="submit" class="btn btn-success p-2">
                                    Tạo lịch thi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script></script>

@endsection
