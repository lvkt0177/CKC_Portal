@extends('admin.layouts.app')

@section('title', 'Danh sách sinh viên')

@section('content')

    <h1>Danh sách sinh viên</h1>

    <form method="GET" action="{{ route('admin.student') }}">
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
    </form>

    <table border="1" class="table table-striped">
        <thead>
            <tr>
                <th>Mã SV</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>SĐT</th>
                <th>Lớp</th>
                <th>Niên khóa</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sinhviens as $sv)
                <tr>
                    <td>{{ $sv->ma_sv }}</td>
                    <td>{{ $sv->ho_ten }}</td>
                    <td>{{ $sv->email }}</td>
                    <td>{{ $sv->so_dien_thoai }}</td>
                    <td>{{ $sv->ten_lop }}</td>
                    <td>{{ $sv->ten_nien_khoa }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Không có sinh viên nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection
