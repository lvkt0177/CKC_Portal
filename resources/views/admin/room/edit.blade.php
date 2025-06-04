@extends('admin.layouts.app')

@section('title', 'Chi tiết phòng học')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0"> Chi tiết phòng học </h3>
                        <a href="{{ route('admin.phong.index') }}" class="btn btn-primary">Quay lại</a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.phong.update', $phong) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="ten">Tên phòng học</label>
                                        <input type="text" class="form-control" id="ten" name="ten"
                                            value="{{ $phong->ten }}" >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="so_luong">Số lượng</label>
                                        <input type="number" class="form-control" id="so_luong" name="so_luong"
                                            value="{{ $phong->so_luong }}" >
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="loai_phong">Loại phòng</label>
                                        <select class="form-control" id="loai_phong" name="loai_phong" required>
                                            <option value="0" {{ $phong->loai_phong == 0 ? 'selected' : '' }}>Phòng lý
                                                thuyết</option>
                                            <option value="1" {{ $phong->loai_phong == 1 ? 'selected' : '' }}>Phòng thực
                                                hành</option>
                                            <option value="2" {{ $phong->loai_phong == 2 ? 'selected' : '' }}>Phòng học
                                                online</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" onclick="return confirm('Bạn muốn xác nhận chỉnh sửa phòng học này?')">Chỉnh sửa</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
