@extends('admin.layouts.app')

@section('title', 'Tạo phòng học mới')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Tạo phòng học mới</h3>
                        <a href="{{ route('admin.room.index') }}" class="btn btn-secondary">Quay lại</a>
                    </div>
                    <div class="card-body">
                        {{-- Show error --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('admin.room.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="ten" class="form-label">Tên phòng học</label>
                                <input type="text" class="form-control" id="ten" name="ten" required>
                            </div>
                            <div class="mb-3">
                                <label for="so_luong" class="form-label">Số lượng</label>
                                <input type="number" class="form-control" id="so_luong" name="so_luong" required>
                            </div>
                            <div class="mb-3">
                                <label for="loai_phong" class="form-label ">Loại phòng</label>
                                <select class="form-control" id="loai_phong" name="loai_phong" required>
                                    <option value="0">Phòng lý thuyết</option>
                                    <option value="1">Phòng thực hành</option>
                                    <option value="2">Phòng học online</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Tạo phòng học</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 