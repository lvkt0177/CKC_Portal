@extends('admin.layouts.app')

@section('title', 'Danh sách Giảng viên')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0"> Danh sách Giảng Viên </h3>

                        <a href="" class="btn btn-primary">Thêm Giảng Viên</a>

                    </div>

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                       <th>No.1</th>
                                       <th>Họ Tên</th>
                                       <th>Giới tính</th>
                                       <th>Email</th>  
                                       <th>Số điện thoại</th>  
                                       <th>Địa chỉ</th> 
                                       <th>Bộ Môn</th>
                                       <th>Khoa</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($users as $gv)
                                                <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $gv->hoSo->ho_ten }}</td>
                                                <td>{{ $gv->hoSo->gioi_tinh }}</td>
                                                <td>{{ $gv->hoSo->email }}</td>
                                                <td>{{ $gv->hoSo->dia_chi }}</td>
                                                <td>{{ $gv->hoSo->so_dien_thoai }}</td>
                                                <td>{{ $gv->boMon->ten_bo_mon }}</td>
                                                <td>{{ $gv->boMon->nganhHoc->khoa->ten_khoa }}</td>
                                                
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
