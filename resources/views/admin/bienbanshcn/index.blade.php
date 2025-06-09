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
                        <a href="{{ route('admin.bienbanshcn.create', $lop) }}" target="_blank" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Lập biên bản SHCN</a>
                        <a href="{{ route('admin.lop.index') }}" class="btn btn-primary">Quay lại</a>
                    </div>
                </div>

                <div class="teams-section">
                    <table class="team-table">
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
                                            <td>
                                                <a href="{{ route('admin.bienbanshcn.show', $bb) }}" target="_blank" class="btn btn-dark"><i class="fa-solid fa-eye"></i></a>
                                                {{-- Sửa --}}
                                                <a href="{{ route('admin.bienbanshcn.edit', $bb) }}" class="btn btn-warning" target="_blank"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                {{-- Duyệt --}}
                                                <a href="" class="btn btn-success"><i class="fa-solid fa-share"></i></a>
                                                
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
    <script>
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
                    url: `/admin/student/khoa-sinh-vien/${studentId}`,
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