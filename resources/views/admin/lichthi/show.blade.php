@extends('admin.layouts.app')

@section('title', 'Quản lý lịch thi của sinh viên')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/lichthi.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/lucide@0.273.0/dist/umd/lucide.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card shadow-sm ">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Lịch thi lớp {{ $lop->ten_lop }} </h3>
                    <a href="{{ route('giangvien.lichthi.index') }}" class="btn btn-primary">Quay lại</a>
                </div>
                @if ($lichThi->count() > 0)
                <form action="{{ route('giangvien.lichthi.show', $lop) }}" method="GET" class="form-inline mb-3">
                    <div class="form-group me-2">
                        <label for="id_tuan" class="me-2">🗓️ Chọn tuần:</label>
                        <select name="id_tuan" id="id_tuan" class="form-control" onchange="this.form.submit()">
                            @foreach ($tuanDaCoLich as $tuanItem)
                                @php
                                    $tuanModel = $tuanItem->tuan ?? null;
                                @endphp
                                @if ($tuanModel)
                                    <option value="{{ $tuanModel->id }}"
                                        {{ $tuanModel->id == $idTuan ? 'selected' : '' }}>
                                        Tuần {{ $loop->iteration }} 
                                        ({{ \Carbon\Carbon::parse($tuanModel->ngay_bat_dau)->format('d/m') }} -
                                        {{ \Carbon\Carbon::parse($tuanModel->ngay_ket_thuc)->format('d/m') }})
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </form>
                
                    @foreach ($dsNgay as $ngay => $dsLich)
                        <div class="schedule-day">
                            <h3 class="date-header">
                                📅 Ngày {{ \Carbon\Carbon::parse($ngay)->format('d/m/Y') }}
                            </h3>

                            <div class="exam-cards" style="display: grid;">
                                <div class="exam-table">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Môn học</th>
                                                <th>Giờ thi</th>
                                                <th>Phòng</th>
                                                <th>Lớp học phần</th>
                                                <th>Lần thi</th>
                                                <th>Giám thị 1</th>
                                                <th>Giám thị 2</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dsLich as $lt)
                                                <tr>
                                                    <td>{{ $lt->lopHocPhan->ten_hoc_phan ?? '---' }}</td>
                                                    <td>{{ $lt->gio_bat_dau }} ({{ $lt->thoi_gian_thi }} phút)</td>
                                                    <td>{{ $lt->phong->ten ?? $lt->phong_thi }}</td>
                                                    <td>{{ $lt->lopHocPhan->ten_hoc_phan ?? '-' }}</td>
                                                    <td>Thi lần {{ $lt->lan_thi }}</td>
                                                    <td>{{ $lt->giamThi1->hoSo->ho_ten ?? '-' }}</td>
                                                    <td>{{ $lt->giamThi2->hoSo->ho_ten ?? '-' }}</td>
                                                    <td>
                                                        <form action="{{ route('giangvien.lichthi.destroy', $lt) }}"
                                                            method="POST" class="form-xoa-lich-thi" data-id="{{ $lt->id }}" data-confirm>
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">Xoá</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    @endforeach
                @else
                    <div class="card-body">
                        <p class="text-center">{{ $lop->ten_lop }} chhưa có lịch thi nào!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script></script>
@endsection
