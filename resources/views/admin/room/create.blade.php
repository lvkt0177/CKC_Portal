@extends('admin.layouts.app')

@section('title', 'Tạo phòng học mới')

@section('content')
    <div class="container-fluid teams-section">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Tạo phòng học mới</h3>
                        <a href="{{ route('admin.phong.index') }}" class="btn btn-back">Quay lại</a>
                    </div>
                    <div class="card-body">
                        {{-- Show error --}}
                        
                        <form action="{{ route('admin.phong.store') }}" method="POST" data-confirm>
                            @csrf
                            <div class="mb-3">
                                <label for="ten" class="form-label">Tên phòng học</label>
                                <input type="text" class="form-control @error('ten') is-invalid border-danger text-dark @enderror" value="{{ old('ten') }}" id="ten" name="ten" >
                                @error('ten')
                                    <div class="text-danger">Thông báo lỗi: {{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="so_luong" class="form-label">Số lượng</label>
                                <input type="number" class="form-control @error('ten') is-invalid border-danger text-dark @enderror" value="{{ old('so_luong') }}"  id="so_luong" name="so_luong" >
                                @error('so_luong')
                                    <div class="text-danger">Thông báo lỗi: {{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="loai_phong" class="form-label ">Loại phòng</label>
                                <select class="form-control @error('loai_phong') is-invalid border-danger text-dark @enderror" id="loai_phong" name="loai_phong" >
                                    <option class="bg-white text-dark" value="">-- Chọn loại phòng --</option>
                                    <option class="bg-white text-dark" value="0">Phòng lý thuyết</option>
                                    <option class="bg-white text-dark" value="1">Phòng thực hành</option>
                                    <option class="bg-white text-dark" value="2">Phòng học online</option>
                                </select>
                                @error('loai_phong')
                                    <div class="text-danger">Thông báo lỗi: {{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-add">Tạo phòng học</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 