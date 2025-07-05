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
                        <form id="examForm" action="{{ route('giangvien.lichthi.store', $lop) }}" method="POST"
                            data-confirm>
                            @csrf

                            <div class="form-group mt-3">
                                <label for="examName">Tên môn thi</label>
                                <select
                                    class="form-control @error('id_lop_hoc_phan') is-invalid border-danger text-dark @enderror"
                                    name="id_lop_hoc_phan" id="selectMonThi">
                                    <option value="">-- Chọn môn thi --</option>
                                    @foreach ($dsLopHP as $lophp)
                                        <option value="{{ $lophp->id }}"
                                            {{ old('id_lop_hoc_phan') == $lophp->id ? 'selected' : '' }}>
                                            {{ $lophp->ten_hoc_phan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_lop_hoc_phan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="form-group col-3">
                                    <label for="examDate">Tuần thi</label>

                                    <select
                                        class="form-control @error('id_tuan') is-invalid border-danger text-dark @enderror"
                                        name="id_tuan">
                                        <option value="">-- Chọn tuần --</option>
                                        @foreach ($dsTuan as $tuan)
                                            <option value="{{ $tuan->id }}"
                                                {{ old('id_tuan', optional($tuanDangChon)->id) == $tuan->id ? 'selected' : '' }}>
                                                Tuần {{ $loop->index + 1 }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_tuan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-3">
                                    @php
                                        $thuLabel = [
                                            1 => 'Thứ hai',
                                            2 => 'Thứ ba',
                                            3 => 'Thứ tư',
                                            4 => 'Thứ năm',
                                            5 => 'Thứ sáu',
                                            6 => 'Thứ bảy',
                                            7 => 'Chủ nhật',
                                        ];
                                    @endphp
                                    <label for="thu" class="form-label">📆 Thứ trong tuần</label>
                                    <select name="thu" class="form-control">
                                        <option value="">-- Chọn thứ --</option>
                                        @foreach ($thuLabel as $key => $label)
                                            <option value="{{ $key }}"
                                                {{ old('thu') == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('ngay_thi')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-3">
                                    <label for="examTime">Giờ bắt đầu</label>
                                    <input type="time"
                                        class="form-control @error('gio_bat_dau') is-invalid border-danger text-dark @enderror"
                                        id="examTime" name="gio_bat_dau" value="{{ old('gio_bat_dau') }}">
                                    @error('gio_bat_dau')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-3">
                                    <label for="duration">Thời gian làm bài (phút)</label>
                                    <input
                                        class="form-control @error('thoi_gian_thi') is-invalid border-danger text-dark @enderror"
                                        type="number" id="duration" name="thoi_gian_thi"
                                        value="{{ old('thoi_gian_thi') }}" placeholder="45" min="30" step="5"
                                        max="300">
                                    @error('thoi_gian_thi')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">

                                <div class="form-group col-6">
                                    <label for="examType">Lần thi</label>
                                    <select
                                        class="form-control @error('lan_thi') is-invalid border-danger text-dark @enderror"
                                        name="lan_thi">
                                        <option value="1" {{ old('lan_thi') == 1 ? 'selected' : '' }}>Thi lần 1
                                        </option>
                                        <option value="2" {{ old('lan_thi') == 2 ? 'selected' : '' }}>Thi lần 2
                                        </option>
                                    </select>

                                    @error('lan_thi')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="room">Phòng thi</label>
                                    <select
                                        class="form-control @error('id_phong_thi') is-invalid border-danger text-dark @enderror"
                                        name="id_phong_thi">
                                        <option value="">-- Chọn phòng --</option>
                                        @foreach ($phong as $ph)
                                            <option value="{{ $ph->id }}"
                                                {{ old('id_phong_thi') == $ph->id ? 'selected' : '' }}>
                                                {{ $ph->ten }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('id_phong_thi')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">

                                <div class="form-group col-6">
                                    <label for="supervisor">Giám thị 1</label>
                                    <select
                                        class="form-control @error('id_giam_thi_1') is-invalid border-danger text-dark @enderror"
                                        name="id_giam_thi_1">
                                        <option value="">-- Chọn giám thị --</option>
                                        @foreach ($giam_thi as $gth)
                                            <option value="{{ $gth->id }}"
                                                {{ old('id_giam_thi_1') == $gth->id ? 'selected' : '' }}>
                                                {{ $gth->hoSo->ho_ten }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_giam_thi_1')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="supervisor">Giám thị 2</label>
                                    <select
                                        class="form-control @error('id_giam_thi_2') is-invalid border-danger text-dark @enderror"
                                        name="id_giam_thi_2">
                                        <option value="">-- Chọn giám thị --</option>
                                        @foreach ($giam_thi as $gth)
                                            <option value="{{ $gth->id }}"
                                                {{ old('id_giam_thi_2') == $gth->id ? 'selected' : '' }}>
                                                {{ $gth->hoSo->ho_ten }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_giam_thi_2')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="btn-container d-flex justify-content-end">
                                <button type="submit" class="btn btn-success p-2" onchange="this.form.submit()">
                                    Tạo lịch thi
                                </button>
                            </div>
                            @if (session('error'))
                                <div class="alert alert-danger m-3  ">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success m-3  ">
                                    {{ session('success') }}
                                </div>
                            @endif
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
