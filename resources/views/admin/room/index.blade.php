@extends('admin.layouts.app')

@section('title', 'Quản lý phòng học')

@section('content')
<div class="container-fluid">
	<div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0"> Quản lý phòng học </h3>
                        <a href="{{ route('admin.phong.create') }}" class="btn btn-primary">Thêm phòng học</a>
                    </div>
                    
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>No.1</th>
                                        <th>Tên</th>
                                        <th>Số lượng</th>
                                        <th>Loại phòng</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rooms as $room)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $room->ten }}</td>
                                        <td>{{ $room->so_luong }}</td>
                                        <td>{{ $room->loai_phong == 0 ? 'Phòng lý thuyết' : 'Phòng thực hành' }}</td>
                                        <td class="d-flex justify-content-start">

                                            <a href="{{ route('admin.phong.show', $room) }}" class="btn btn-warning btn-sm">Sửa</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @if($rooms->isEmpty())
                                        <tr>
                                            <td colspan="5" class="text-center">Không có phòng học nào.</td>
                                        </tr>
                                    @endif
                                   
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div> 
            </div>
        </div>
</div>
@endsection