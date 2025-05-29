@extends('admin.layouts.app')

@section('title', 'Danh sách sinh viên')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0"> Danh sách Sinh Viên </h3>

                        {{-- <a href="" class="btn btn-primary">Thêm ABC</a> --}}

                    </div>

                    <div class="card-body">
                        
                        <div class="my-2">
                            {{-- <form method="GET" action="{{ route('admin.student.index') }}">
                                <label for="id_lop">Lọc theo lớp:</label>
                                <select class="btn" name="id_lop" id="id_lop">
                                    <option value="">-- Tất cả lớp --</option>
                                    @foreach ($lops as $lop)
                                        <option value="{{ $lop->id }}" {{ $id_lop == $lop->id ? 'selected' : '' }}>
                                            {{ $lop->ten_lop }}
                                        </option>
                                    @endforeach
                                </select>
                                <button class="btn btn-primary" type="submit">Lọc</button>
                            </form> --}}
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Mã SV</th>
                                        <th>Tên lớp</th>
                                        <th>Họ tên</th>
                                        <th>Email</th>
                                        <th>SĐT</th>
                                        <th>Niên khóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($sinhviens as $sv)
                                        <tr>
                                            <td>{{ $sv->ma_sv }}</td>
                                            <td>{{ $sv->lop->ten_lop }}</td>
                                            <td>{{ $sv->hoSo->ho_ten }}</td>
                                            <td>{{ $sv->hoSo->email }}</td>
                                            <td>{{ $sv->hoSo->so_dien_thoai }}</td>
                                            {{-- <td>{{ $sv->hoSo-> }}</td> --}}
                                            <td>{{ $sv->lop->nienKhoa->ten_nien_khoa }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">Không có sinh viên nào.</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
