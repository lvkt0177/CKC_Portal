@extends('admin.layouts.app')

@section('title', 'Danh sách sinh viên')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0"> Danh sách Sinh Viên Lớp {{ $lop->ten_lop ?? '' }} </h3>
                        <a class="btn btn-primary" href="{{ route('giangvien.student.index') }}">Quay lại</a>
                    </div>

                    <div class="card-body">

                        <div class="">
                            <table class="team-table align-middle" id="room-table">
                                <thead class="table-light">
                                    <tr>
                                        <th>No.1</th>
                                        <th>Họ tên</th>
                                        <th>Mã SV</th>
                                        <th>Tên lớp</th>
                                        <th>Email</th>
                                        <th>SĐT</th>
                                        <th>Niên khóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($sinhviens as $sv)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $sv->hoSo->ho_ten }}</td>
                                            <td>{{ $sv->ma_sv }}</td>
                                            <td>{{ $sv->lop->ten_lop }}</td>
                                            <td>{{ $sv->hoSo->email }}</td>
                                            <td>{{ $sv->hoSo->so_dien_thoai }}</td>
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

@section('js')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $.fn.dataTable.ext.errMode = 'none';
            $('#room-table').DataTable({
                responsive: true,
                ordering: false,
                language: {
                    search: "Tìm kiếm thông tin phòng:",
                    lengthMenu: "Hiển thị _MENU_ dòng",
                    info: "Hiển thị _START_ đến _END_ trong _TOTAL_ dòng",
                    paginate: {
                        previous: '<i class="fa-solid fa-arrow-left"></i>',
                        next: '<i class="fa-solid fa-arrow-right"></i>'
                    }
                },
                dom: '<"top"lf>rt<"bottom"ip><"clear">'
            });
        });

        $('#room-table').on('error.dt', function(e, settings, techNote, message) {
            alert('Đã có lỗi khi tải danh sách sinh viên của lớp này. ');
        });
    </script>
@endsection
