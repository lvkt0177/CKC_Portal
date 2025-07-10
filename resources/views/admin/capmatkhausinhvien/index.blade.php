@extends('admin.layouts.app')

@section('title', 'Quản lý sinh viên liên hệ cấp lại mật khẩu')

@section('content')
<div class="container-fluid">
	<div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm teams-section">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0"> Danh sách sinh viên liên hệ cấp lại mật khẩu </h3>
                    </div>
                    
                    <div class="teams-section">
                        <table class="team-table align-middle" id="room-table">
                            <thead>
                                <tr>
                                    <th>No.1</th>
                                    <th>MSSV</th>
                                    <th>Họ tên sinh viên</th>
                                    <th>Số điện thoại</th>
                                    <th>Loại</th>
                                    <th>Người duyệt</th>
                                    <th>Thời gian gửi</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($yeuCauCapLaiMatKhau as $data)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $data->sinhvien->ma_sv }}</td>
                                        <td>{{ $data->sinhvien->hoSo->ho_ten }}</td>
                                        <td>{{ $data->sinhvien->hoSo->so_dien_thoai }}</td>
                                        <td>{{ $data->loai->getLabel() }}</td>
                                        <td>{{ $data->giangvien ? $data->giangvien->hoSo->ho_ten : 'N/A' }}</td>
                                        <td>{{ $data->created_at->format('d/m/Y') }}</td>
                                        <td><span class="badge bg-{{ $data->trang_thai->getBadge() }}">{{ $data->trang_thai->getLabel() }}</span></td>
                                        <td>
                                            @if($data->trang_thai->value == 0)
                                                <form action="{{ route('giangvien.capmatkhausinhvien.update', $data) }}" method="post" data-confirm>
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-warning">Duyệt</button>
                                                </form>
                                            @endif
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
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#room-table').DataTable({
                responsive: true,
                ordering: false,
                language: {
                    search: "Tìm kiếm thông tin:",
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
