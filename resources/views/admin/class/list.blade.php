@extends('admin.layouts.app')

@section('title', 'Lớp chủ nhiệm')

@section('css')

    <style>
        input[type="checkbox"] {
            position: static !important;
            left: auto !important;
            opacity: 1 !important;
            visibility: visible !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid teams-section">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm teams-section">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Danh sách Sinh viên - Lớp {{ $lop->ten_lop }}</h3>
                        <a href="{{ route('admin.lop.index') }}" class="btn btn-primary">Quay lại</a>
                    </div>

                    <div class="teams-section">
                        <table class="team-table table-reponsive">
                            <thead class="table-center">
                                <tr class="text-center">
                                    <th><input type="checkbox" id="checkAll" style="left: 0"></th>
                                        <th>No.</th>
                                        <th>MSSV</th>
                                        <th>Họ tên sinh viên</th>
                                        <th>Giới tính</th>
                                        <th>Ngày sinh</th>
                                        <th>Email</th>
                                        <th>Số diện thoại</th>
                                        <th>Chức vụ</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sinhViens as $sv)
                                        <tr class="text-center">
                                            <td>
                                                <input type="checkbox" class="student-checkbox" name="selected_students[]"
                                                    value="{{ $sv->id }}">
                                            </td>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $sv->ma_sv }}</td>
                                            <td>{{ $sv->hoSo->ho_ten }}</td>
                                            <td>{{ $sv->hoSo->gioi_tinh->getLabel() }}</td>
                                            <td>{{ $sv->hoSo->ngay_sinh }}</td>
                                            <td>{{ $sv->hoSo->email }}</td>
                                            <td>{{ $sv->hoSo->so_dien_thoai }}</td>
                                            <td>
                                                <form method="POST" action="{{ route('admin.student.doi-chuc-vu', $sv) }}">
                                                    @csrf
                                                    <div class="dropdown">
                                                        <button
                                                            class="btn btn-sm btn-{{ $sv->chuc_vu->getBadge() }} dropdown-toggle"
                                                            style="color: black !important;" type="button"
                                                            id="dropdownMenuButton{{ $sv->id }}"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            {{ $sv->chuc_vu->getLabel() }}
                                                        </button>
                                                        <ul class="dropdown-menu" 
                                                            aria-labelledby="dropdownMenuButton{{ $sv->id }}">
                                                            @foreach (App\Enum\RoleStudent::cases() as $role)
                                                                @if ($sv->chuc_vu->value != $role->value)
                                                                    <li>
                                                                        <a href="#" class="dropdown-item change-role"
                                                                            data-student-id="{{ $sv->id }}"
                                                                            data-role-value="{{ $role->value }}"
                                                                            data-role-label="{{ $role->getLabel() }}"
                                                                            data-student-name="{{ addslashes($sv->hoSo->ho_ten) }}">
                                                                            {{ $role->getLabel() }}
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                        <input type="hidden" name="chuc_vu"
                                                            id="chucVuInput{{ $sv->id }}"
                                                            value="{{ $sv->chuc_vu->value }}">
                                                    </div>
                                                </form>

                                            </td>
                                            <td>{{ $sv->trang_thai->getLabel() }}</td>

                                            <td class="d-flex">
                                                <a href="" class="btn btn-warning"><i class="fa-solid fa-eye"></i></a>
                                                <span class="mx-1"></span>
                                                <button class="btn btn-danger btn-lock" data-id="{{ $sv->id }}">{!! $sv->trang_thai->value == 0 ? '<i class="fa-solid fa-lock"></i>' : '<i class="fa-solid fa-lock-open"></i>' !!}
                                                </button>
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