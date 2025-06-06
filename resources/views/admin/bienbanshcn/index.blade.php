@extends('admin.layouts.app')

@section('title', 'Biên bản sinh hoạt chủ nhiệm')

@section('content')

<div class="container-fluid">
	<div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0"> Danh sách biên bản sinh hoạt chủ nhiệm - Lớp {{ $lop->ten_lop }} </h3>
                        <a href="" class="btn btn-primary">Lập biên bản SHCN</a>
                    </div>
                    
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle mb-0">
                                <thead class="table-light">
                                    <tr class="text-center">
                                        <th>No.1</th>
                                        <th>Tiêu đề</th>
                                        <th>Giáo viên chủ nhiệm</th>
                                        <th>Thư ký</th>
                                        <th>Tuần</th>
                                        <th>Ngày tạo</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bienBanSHCN as $bb)

                                        <tr class="text-center">
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $bb->tieu_de }}</td>
                                            <td>{{ $bb->gvcn->hoSo->ho_ten }}</td>
                                            <td>{{ $bb->sv->hoSo->ho_ten }}</td>
                                            <td>Tuần {{ $bb->tuan->tuan }}</td>
                                            <td>{{ $bb->created_at }}</td>
                                            <td>{{ $bb->trang_thai->getLabel() }}</td>
                                            <td>
                                                <a href="" class="btn btn-warning"><i class="la la-eye"></i></a>
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
