@extends('admin.layouts.app')

@section('title', 'Danh sách Sinh viên đăng ký giấy')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm teams-section">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Danh sách Sinh viên đăng ký giấy</h3>
                    </div>

                    <div class="teams-section">
                        <table class="team-table align-middle" id="room-table">
                            <thead>
                                <tr>
                                    <th>No.1</th>
                                    <th>Mã sinh viên</th>
                                    <th>Họ tên sinh viên</th>
                                    <th>Loại giấy đăng ký</th>
                                    <th>Ngày đăng ký</th>
                                    <th>Ngày nhận</th>
                                    <th>Người duyệt</th>
                                    <th>Trạng thái</th>
                                    <th>Tùy chọn</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dangkygiays as $dkg)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $dkg->sinhVien->ma_sv }}</td>
                                        <td>{{ $dkg->sinhVien?->hoSo?->ho_ten ?? 'N/A' }}</td>
                                        <td>{{ $dkg->loaiGiay->ten_giay }}</td>
                                        <td>{{ $dkg->ngay_dang_ky }}</td>
                                        <td>{{ $dkg->ngay_nhan }}</td>
                                        <td>{{ $dkg->giangVien?->hoSo?->ho_ten ?? 'N/A' }}</td>
                                        <td>{{ $dkg->trang_thai == 0 ? 'Chưa duyệt' : 'Đã duyệt' }}</td>
                                        <td>
                                            <form action="{{ route('admin.testimonial.update', $dkg->id) }}" method="POST"
                                                data-confirm>
                                                @csrf
                                                {!! $dkg->trang_thai == 0 ? '<button class="btn btn-warning">Duyệt</button>' : '' !!}
                                            </form>
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
