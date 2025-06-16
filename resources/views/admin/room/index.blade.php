@extends('admin.layouts.app')

@section('title', 'Quản lý phòng học')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm teams-section">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0"> Quản lý phòng học </h3>
                        <a href="{{ route('giangvien.phong.create') }}" class="btn btn-add">Thêm phòng học</a>
                    </div>

                    <div class="teams-section">
                        <table class="team-table align-middle" id="room-table">
                            <thead>
                                <tr class="text-center">
                                    <th>No.1</th>
                                    <th>Tên</th>
                                    <th>Số lượng</th>
                                    <th>Loại phòng</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)
                                    <tr class="text-center">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $room->ten }}</td>
                                        <td>{{ $room->so_luong }}</td>
                                        <td class="w-25"><span
                                                class="badge bg-{{ $room->loai_phong->getBadge() }} text-dark">
                                                {{ $room->loai_phong->getLabel() }}
                                            </span></td>
                                        <td>
                                            <a href="{{ route('giangvien.phong.edit', $room) }}"
                                                class="btn btn-warning btn-sm">Sửa</a>
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($rooms->isEmpty())
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
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
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
            console.error('DataTables Lỗi:', message);
            alert('Đã có lỗi khi tải bảng: ' + message);
        });
    </script>
@endsection
