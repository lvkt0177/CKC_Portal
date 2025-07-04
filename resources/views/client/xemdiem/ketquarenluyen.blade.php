@extends('client.layouts.app')

@section('title', 'Kết quả rèn luyện')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/client/css/giayxacnhan.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/xemdiem.css') }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">
                        Kết quả rèn luyện
                    </h3>
                </div>
                <div class="card-body ">
                    <div class="student-thongtin">
                        <div class="thongtin-grid ">
                            <div class="row">
                                <div class="thongtin-item col-6 py-1">
                                    <span class="thongtin-label">Mã SSV:</span>
                                    <span class="thongtin-value">{{ $sinhVien->ma_sv }}</span>
                                </div>
                                <div class="thongtin-item col-6 py-1">
                                    <span class="thongtin-label">CMND/CCCD:</span>
                                    <span class="thongtin-value">{{ $sinhVien->hoSo->so_cccd ?? '••••••••••' }}</span>
                                </div>
                                <div class="thongtin-item col-6 py-1">
                                    <span class="thongtin-label">Họ tên:</span>
                                    <span class="thongtin-value">{{ $sinhVien->hoSo->ho_ten }}</span>
                                </div>
                                <div class="thongtin-item col-6 py-1">
                                    <span class="thongtin-label">Ngày sinh:</span>
                                    <span
                                        class="thongtin-value">{{ \Carbon\Carbon::parse($sinhVien->hoSo->ngay_sinh)->format('d/m/Y') }}</span>
                                </div>
                                <div class="thongtin-item col-6 py-1">
                                    <span class="thongtin-label">Giới tính:</span>
                                    <span class="thongtin-value">{{ $sinhVien->hoSo->gioi_tinh }}</span>
                                </div>
                                <div class="thongtin-item col-6 py-1">
                                    <span class="thongtin-label">Nơi sinh:</span>
                                    <span class="thongtin-value">{{ $sinhVien->hoSo->dia_chi }}</span>
                                </div>
                                <div class="thongtin-item col-6 py-1">
                                    <span class="thongtin-label">Lớp, Lớp chuyên ngành:</span>
                                    <span class="thongtin-value">{{ $sinhVien->lop->ten_lop ?? 'Chưa có' }}
                                      
                                    </span>
                                </div>
                                <div class="thongtin-item col-6 py-1">
                                    <span class="thongtin-label">Ngành, chuyên ngành:</span>
                                    <span class="thongtin-value">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form method="GET" class="m-4">
                        <select name="id_nam" onchange="this.form.submit()" class="form-control">
                            @foreach ($dsNam as $nam)
                                <option value="{{ $nam }}" {{ $nam == $namDangChon ? 'selected' : '' }}>
                                    {{ $nam }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                    <div class="grades-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tháng</th>
                                    <th>Năm</th>
                                    <th>Rèn luyện</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($thang = 1; $thang <= 12; $thang++)
                                    @php
                                        $diemThang = $dsDiemRenLuyen->firstWhere('thoi_gian', $thang);
                                    @endphp

                                    <tr>
                                        <td>{{ $thang }}</td>
                                        <td>Tháng {{ $thang }} </td>
                                        <td>{{ $namDangChon }}</td>
                                        <td>
                                            @if ($diemThang)
                                                {{ $diemThang->xep_loai->getLabel() }}
                                            @else
                                                <em class="text-muted">Đang cập nhật</em>
                                            @endif
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
