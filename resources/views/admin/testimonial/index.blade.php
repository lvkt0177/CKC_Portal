@extends('admin.layouts.app')

@section('title', 'Danh sách Sinh viên đăng ký giấy')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0"> Danh sách Sinh viên đăng ký giấy </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>No.1</th>
                                        <th>Mã sinh viên</th>
                                        <th>Họ tên sinh viên</th>
                                        <th>Loại giấy đăng ký</th>
                                        <th>Ngày đăng ký</th>
                                        <th>Ngày nhận</th>
                                        <th>Người duyệt</th>
                                        <th>Trạng thái</th>
                                        <th>Tùy chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dangkygiays as $dkg)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{$dkg->sinhVien->ma_sv}}</td>
                                            <td>{{ $dkg->sinhVien?->hoSo?->ho_ten ?? 'N/A' }}</td>
                                            <td>{{$dkg->loaiGiay->ten_giay}}</td>
                                            <td>{{$dkg->ngay_dang_ky}}</td>
                                            <td>{{$dkg->ngay_nhan}}</td>
                                            <td>{{$dkg->giangVien?->hoSo?->ho_ten ?? 'N/A'}}</td>
                                            <td>{{$dkg->trang_thai == 0 ? 'Chưa duyệt' : 'Đã duyệt'}}</td>
                                            <td>
                                                <form action="{{ route('admin.testimonial.update', $dkg->id) }}" method="POST"> 
                                                    @csrf
                                                    {!! $dkg->trang_thai == 0 ? '<button class="btn btn-warning">Duyệt</button>' : '' !!}
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection