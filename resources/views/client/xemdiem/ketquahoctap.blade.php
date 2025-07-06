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
                                    <span class="thongtin-value">{{ $sinhVien->hoSo->cccd }}</span>
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
                                    <span class="thongtin-value">{{ $sinhVien->danhSachSinhVien->first()->lop->ten_lop }}
                                        {{ $sinhVien->danhSachSinhVien->count() <= 1 ? ' ' : ', ' . $sinhVien->danhSachSinhVien->last()->lop->ten_lop }}
                                    </span>
                                </div>
                                <div class="thongtin-item col-6 py-1">
                                    <span class="thongtin-label">Ngành, chuyên ngành:</span>
                                    <span class="thongtin-value">
                                        {{ $sinhVien->danhSachSinhVien->first()->lop->chuyenNganh->ten_chuyen_nganh }}
                                        {{ $sinhVien->danhSachSinhVien->count() <= 1 ? ' ' : ', ' . $sinhVien->danhSachSinhVien->last()->lop->chuyenNganh->ten_chuyen_nganh }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach ($monTheoHocKy as $idHocKy => $dsMon)
                        <h5 class="m-4 fs-4">📘 Học kỳ {{ $loop->iteration }}</h5>
                    
                        <div class="grades-table mb-4">
                            <table>
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên môn học</th>
                                        <th>Tín chỉ</th>
                                        <th>Điểm tổng kết</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dsMon as $index => $mon)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td style="text-align: left">{{ $mon['ten_mon'] }}</td>
                                            <td>{{ $mon['so_tin_chi'] }}</td>
                                            <td><span class="grade-badge ">{{ $mon['diem_tong_ket'] }}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="summary-stats mt-3 mb-5">
                            <div class="stat-card">
                                <h4>Điểm trung bình học kỳ {{ $loop->iteration }}</h4>
                                <div class="value">1</div>
                            </div>
                            @if($loop->iteration % 2 == 0)
                                <div class="stat-card">
                                    <h4>Điểm trung bình cả năm {{ $loop->iteration / 2 }}</h4>
                                    <div class="value">1</div>
                                </div>
                            @endif
                        </div>
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
   
        document.addEventListener("DOMContentLoaded", function () {
            const summarySections = document.querySelectorAll('.summary-stats');
            let nam = 1;
            let tongNamDiem = 0;
            let tongNamTinChi = 0;

            summarySections.forEach((section, index) => {
                const table = section.previousElementSibling.querySelector('table');
                const rows = table.querySelectorAll('tbody tr');
                let tongDiem = 0;
                let tongTinChi = 0;

                rows.forEach(row => {
                    const diem = row.querySelectorAll('td')[3].innerText.trim();
                    const tinChi = parseFloat(row.querySelectorAll('td')[2].innerText.trim());

                    if (diem !== "-" && !isNaN(parseFloat(diem))) {
                        const diemSo = parseFloat(diem);
                        tongDiem += diemSo * tinChi;
                        tongTinChi += tinChi;
                    }
                });

                const diemTB = tongTinChi > 0 ? (tongDiem / tongTinChi).toFixed(2) : "-";
                section.querySelectorAll('.value')[0].innerText = diemTB;

                if ((index + 1) % 2 === 0) {
                    tongNamDiem += tongDiem;
                    tongNamTinChi += tongTinChi;
                    const diemNamTB = tongNamTinChi > 0 ? (tongNamDiem / tongNamTinChi).toFixed(2) : "-";
                    section.querySelectorAll('.value')[1].innerText = diemNamTB;

                    tongNamDiem = 0;
                    tongNamTinChi = 0;
                    nam++;
                } else {
                    tongNamDiem = tongDiem;
                    tongNamTinChi = tongTinChi;
                }
            });
        });
    </script>

@endsection
