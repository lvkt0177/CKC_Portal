@extends('admin.layouts.app')

@section('title', 'Danh sách tuần năm ' . $nam->nam_bat_dau)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-3">📅 Danh sách tuần của năm {{ $nam->nam_bat_dau }}</h4>
                        <a href="{{ route('giangvien.ctdt.create') }}" class="btn btn-primary">Quay lại</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="room-table">
                            <thead>
                                <tr>
                                    <th>Tuần</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dsTuan as $tuan)
                                    <tr>
                                        <td>Tuần {{ $tuan->tuan }}</td>
                                        <td>{{ \Carbon\Carbon::parse($tuan->ngay_bat_dau)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($tuan->ngay_ket_thuc)->format('d/m/Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
            $('#room-table,#room-table-multi').DataTable({
                responsive: true,
                ordering: false,
                language: {
                    search: "Tìm kiếm:",
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
            console.error('DataTables Lỗi:', message);
            alert('Đã có lỗi khi tải bảng: ' + message);
        });
    </script>
@endsection
