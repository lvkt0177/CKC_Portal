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
                        <h3 class="card-title mb-0">Tạo lịch thi lớp {{ $lop->ten_lop }} {{ $hocKy->ten_hoc_ky }}</h3>
                        <a href="{{ route('giangvien.lichthi.index') }}" class="btn btn-primary">Quay lại</a>
                    </div>
                    <div class="card-body">
                        <form id="examForm" action="{{ route('giangvien.lichthi.store') }}" method="POST" data-comfirm>
                            @csrf
                            <div class="form-group mt-3">
                                <label for="examName">Tên môn thi</label>
                                <select class="form-control" name="id_lop_hoc_phan" id="selectMonThi">
                                    @foreach ($dsLopHP as $lophp)
                                        <option value="{{ $lophp->id }}">{{ $lophp->ten_hoc_phan }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row">
                                <div class="form-group col-3">
                                    <label for="examDate">Tuần thi</label>
                                    <select class="form-control" name="id_tuan">
                                        @foreach ($dsTuan as $tuan)
                                            <option value="{{ $tuan->id }}"
                                                {{ $tuan->id == optional($tuanDangChon)->id ? 'selected' : '' }}>
                                                Tuần {{ $loop->index + 1 }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-3">

                                    <label for="thu" class="form-label">📆 Thứ trong tuần</label>
                                    <select class="form-control" id="ngay_thi" name="thu">
                                        <option value="">-- Chọn thứ --</option>
                                        <option value="2">Thứ 2</option>
                                        <option value="3">Thứ 3</option>
                                        <option value="4">Thứ 4</option>
                                        <option value="5">Thứ 5</option>
                                        <option value="6">Thứ 6</option>
                                        <option value="7">Thứ 7</option>
                                    </select>

                                </div>
                                <div class="form-group col-3">
                                    <label for="examTime">Giờ bắt đầu</label>
                                    <input type="time" class="form-control" type="gio_bat_dau" id="examTime"
                                        name="examTime" required>
                                </div>
                                <div class="form-group col-3">
                                    <label for="duration">Thời gian làm bài (phút)</label>
                                    <input class="form-control" type="number" id="duration" name="thoi_gian_thi"
                                        placeholder="45" min="30" step="5" max="300" required>
                                </div>
                            </div>

                            <div class="row">

                                <div class="form-group col-6">
                                    <label for="examType">Lần thi</label>
                                    <select class="form-control" name="lan_thi" required>
                                        <option value="1">Thi lần 1</option>
                                        <option value="2">Thi lần 2</option>
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="room">Phòng thi</label>
                                    <select class="form-control" name="id_phong_thi">

                                        @foreach ($phong as $ph)
                                            <option value="{{ $ph->id }}">{{ $ph->ten }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">

                                <div class="form-group col-6">
                                    <label for="supervisor">Giám thị 1</label>
                                    <select class="form-select" name="id_giam_thi_1">

                                        @foreach ($giam_thi as $gth)
                                            <option value="{{ $gth->id }}">{{ $gth->hoSo->ho_ten }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-6">

                                    <select class="form-control" name="id_giam_thi_2">
                                        <option>-- Chọn giám thị --</option>
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
