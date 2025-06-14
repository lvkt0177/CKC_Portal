@extends('admin.layouts.app')

@section('title', 'Biên bản sinh hoạt chủ nhiệm')

@section('content')

    <div class="container-fluid teams-section">

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm teams-section">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0"> Danh sách biên bản sinh hoạt chủ nhiệm - Lớp {{ $lop->ten_lop }} </h3>
                        <div class="">
                            <a href="{{ route('giangvien.bienbanshcn.create', $lop) }}" target="_blank" class="btn btn-add"><i
                                    class="fa fa-plus" aria-hidden="true"></i> Lập biên bản SHCN</a>
                            <a href="{{ route('giangvien.lop.index') }}" class="btn btn-back">Quay lại</a>
                        </div>
                    </div>

                    <div class="teams-section">
                        <table class="team-table align-middle" id="room-table">
                            <thead>
                                <tr class="text-center">
                                    <th>No.1</th>
                                    <th>Tiêu đề</th>
                                    <th>Giáo viên chủ nhiệm</th>
                                    <th>Thư ký</th>
                                    <th>Tuần</th>
                                    <th>Ngày tạo</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bienBanSHCN as $bb)
                                    <tr class="text-center">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $bb->tieu_de }}</td>
                                        <td>{{ $bb->gvcn->hoSo->ho_ten }}</td>
                                        <td>{{ $bb->thuky->hoSo->ho_ten }}</td>
                                        <td>Tuần {{ $bb->tuan->tuan }}</td>
                                        <td>{{ $bb->created_at }}</td>
                                        <td>{{ $bb->trang_thai->getLabel() }}</td>
                                        <td class="d-flex justify-content-center">
                                            <a href="{{ route('giangvien.bienbanshcn.show', $bb) }}" target="_blank"
                                                class="btn btn-dark"><i class="fa-solid fa-eye"></i></a>
                                            @if ($bb->trang_thai->value == 0)
                                                <a href="{{ route('giangvien.bienbanshcn.edit', $bb) }}"
                                                    class="btn btn-warning mx-1"><i class="fa fa-pencil"
                                                        aria-hidden="true"></i></a>
                                                {{-- Duyệt --}}
                                                <form action="{{ route('giangvien.bienbanshcn.confirm', $bb) }}" data-confirm
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-check"
                                                            aria-hidden="true"></i></button>
                                                </form>

                                                {{-- Huy --}}
                                                <form action="{{ route('giangvien.bienbanshcn.destroy', $bb) }}" data-confirm
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger ms-1"><i
                                                            class="fa fa-trash" aria-hidden="true"></i></button>
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


            document.getElementById('checkAll').addEventListener('change', function() {
                const checkboxes = document.querySelectorAll('.student-checkbox');
                checkboxes.forEach(cb => cb.checked = this.checked);
            });

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('a.change-role').forEach(function(el) {
                    el.addEventListener('click', function(e) {
                        e.preventDefault();
                        const studentId = this.dataset.studentId;
                        const roleValue = this.dataset.roleValue;
                        const roleLabel = this.dataset.roleLabel;
                        const studentName = this.dataset.studentName;

                        if (confirm(
                                `Bạn có chắc muốn gán chức vụ "${roleLabel}" cho sinh viên "${studentName}"?`
                            )) {
                            const input = document.getElementById(`chucVuInput${studentId}`);
                            input.value = roleValue;

                            this.closest('form').submit();
                        }
                    });
                });
            });

            // btn-lock ajax
            document.querySelectorAll('.btn-lock').forEach(function(el) {
                el.addEventListener('click', function(e) {
                    e.preventDefault();

                    const studentId = this.dataset.id;

                    //ajax
                    $.ajax({
                        url: `/giangvien/student/khoa-sinh-vien/${studentId}`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            student_id: studentId
                        },
                        success: function(response) {
                            if (response.success) {
                                location.reload();
                                alert(response.message);
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                });
            });
        </script>
    @endsection
