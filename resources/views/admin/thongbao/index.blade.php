@extends('admin.layouts.app')

@section('title', 'Thông báo cho sinh viên')

@section('content')
<div class="container-fluid">
	<div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm teams-section">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0"> Quản lý thông báo </h3>
                        <a href="{{ route('admin.thongbao.create') }}" class="btn btn-add">Thêm thông báo</a>
                    </div>

                    <div class="teams-section">
                        <table class="team-table align-middle" id="room-table">
                            <thead>
                                <tr class="text-center">
                                    <th>No.1</th>
                                    <th>Tiêu đề</th>
                                    <th>Người gửi</th>
                                    <th>Từ ai</th>
                                    <th>Ngày gửi</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($thongBaos as $thongbao)
                                    <tr class="text-center">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $thongbao->tieu_de }}</td>
                                        <td>{{ $thongbao->giangVien->hoSo->ho_ten }}</td>
                                        <td>{{ $thongbao->tu_ai }}</td>
                                        <td>{{ $thongbao->ngay_gui }}</td>
                                        <td><span class="badge bg-{{ $thongbao->trang_thai->getBadge()  }}">{{ $thongbao->trang_thai->getLabel() }}</span></td>
                                        <td>
                                            <a href="" class="btn btn-dark btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <a href="{{ route('admin.thongbao.edit', $thongbao) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a href="" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
