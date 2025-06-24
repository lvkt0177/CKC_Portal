@extends('client.layouts.app')

@section('title', 'Kết quả học tập')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/client/css/giayxacnhan.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/xemdiem.css') }}">
@endsection

@section('content')
    <div class="container-fluid" id="print-area">
        <div class="row">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">
                        Kết quả học tập
                    </h3>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <button class="print-btn" onclick="printOnly()">🖨️ In bảng điểm</button>
                    </div>
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
                                    <span class="thongtin-label">Lớp:</span>
                                    <span class="thongtin-value">{{ $sinhVien->lop->ten_lop ?? 'Chưa có' }}</span>
                                </div>
                                <div class="thongtin-item col-6 py-1">
                                    <span class="thongtin-label">Ngành, chuyên ngành:</span>
                                    <span class="thongtin-value">
                                        {{ $sinhVien->lop->nganhHoc->ten_nganh ?? 'Chưa có' }}{{ optional(optional($sinhVien->lopChuyenNganh)->chuyenNganh)->ten_chuyen_nganh ? ', ' . optional($sinhVien->lopChuyenNganh->chuyenNganh)->ten_chuyen_nganh : '' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach ($gradesData as $hocKy => $danhSachMon)
                        @php
                            $tenHocKy = $gradesData[$hocKy]->first()['ten_hoc_ky'] ?? '';
                        @endphp
                        <h5 class="m-4 fs-4">📘{{ $tenHocKy }}
                        </h5>
                        <div class="grades-table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên môn học</th>
                                        <th>Tín chỉ</th>
                                        <th>Điểm chuyên cần</th>
                                        <th>Điểm quá trình</th>
                                        <th>Điểm thi</th>
                                        <th>Điểm tổng kết</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($danhSachMon as $index => $mon)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td style="text-align: left">{{ $mon['ten_mon'] }}</td>
                                            <td>{{ $mon['tin_chi'] }}</td>
                                            <td>{{ $mon['chuyencan'] }}</td>
                                            <td>{{ $mon['quatrinh'] }}</td>
                                            <td>{{ $mon['thi'] }}</td>
                                            <td><span class="grade-badge ">{{ $mon['tongket'] }}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if (isset($thongKeTungKy[$hocKy]))
                            <div class="summary-stats mt-3 mb-5">
                                <div class="stat-card">
                                    <h4>Số môn đã học</h4>
                                    <div class="value">{{ $thongKeTungKy[$hocKy]['so_mon'] }}</div>
                                </div>
                                <div class="stat-card">
                                    <h4>Số tín chỉ đã học</h4>
                                    <div class="value">{{ $thongKeTungKy[$hocKy]['tong_tin_chi'] }}</div>
                                </div>
                                <div class="stat-card">
                                    <h4>Điểm trung bình học kỳ {{ $hocKy }}</h4>
                                    <div class="value">{{ $thongKeTungKy[$hocKy]['diem_trung_binh'] }}</div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function printOnly() {
            const printContents = document.getElementById('print-area').innerHTML;
            const originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;

            // Sau khi in xong, reload lại trang để khôi phục các sự kiện JS
            location.reload();
        }
    </script>
@endsection
