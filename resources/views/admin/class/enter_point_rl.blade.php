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

        select {
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 8px 14px;
            margin-left: 8px;
            font-size: 14px;
            max-width: 100%;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            margin: 1rem;
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
                        <form method="GET" action="{{ route('admin.lop.nhap-diem_rl', $lop->id) }}"
                            class="d-flex justify-content-end">
                            <label>Chọn tháng:
                                <select class="select" name="thoi_gian" onchange="this.form.submit()">
                                    @for ($i = 1; $i <= now()->month; $i++)
                                        <option value="{{ $i }}" {{ $i == $thang ? 'selected' : '' }}>Tháng
                                            {{ $i }}</option>
                                    @endfor
                                </select>
                            </label>
                        </form>
                        <table class="team-table" id="room-table">
                            <thead class="table-center">
                                <tr class="text-center">
                                    <th><input type="checkbox" id="checkAll" style="left: 0"></th>
                                    <th>No.</th>
                                    <th>MSSV</th>
                                    <th>Họ tên sinh viên</th>
                                    <th>Rèn luyện</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sinhViens as $sv)
                                    <tr id="view-row-{{ $sv->id }}" class="text-center">
                                        <td>
                                            <input type="checkbox" class="student-checkbox" name="selected_students[]"
                                                value="{{ $sv->id }}">
                                        </td>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $sv->ma_sv }}</td>
                                        <td>{{ $sv->hoSo->ho_ten }}</td>
                                        <td>
                                            @foreach ($sv->diemRenLuyens as $diemRenLuyen)
                                                {{ $diemRenLuyen->xep_loai->getLabel() }}
                                            @endforeach
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm"
                                                onclick="showEditRow({{ $sv->id }})">
                                                <i class="bi bi-pencil-square"></i></button>
                                        </td>
                                        <td>
                                            @error('xep_loai')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr id="edit-row-{{ $sv->id }}" style="display: none;">
                                        <form action="{{ route('admin.lop.cap-nhat-diem_rl') }}" method="POST"
                                            data-confirm>
                                            @csrf
                                            <input type="hidden" name="id_sinh_vien" value="{{ $sv->id }}">
                                            <input type="hidden" name="thoi_gian" value="{{ $thang }}">
                                            <td>
                                                <input type="checkbox" class="student-checkbox" name="selected_students[]"
                                                    value="{{ $sv->id }}">
                                            </td>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $sv->ma_sv }}</td>
                                            <td>{{ $sv->hoSo->ho_ten }}</td>
                                            <td>
                                                <select name="xep_loai" class="form-control xep-loai-input">
                                                    <option value="">-- Chọn xếp loại --</option>
                                                    <option value="1">
                                                        A</option>
                                                    <option value="2">
                                                        B</option>
                                                    <option value="3">
                                                        C</option>
                                                    <option value="4">
                                                        D</option>
                                                </select>
                                            </td>
                                            <td colspan="2">Cập nhật điểm</td>
                                            <td>
                                                <button type="submit" class="btn btn-success btn-sm">Lưu</button>
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    onclick="hideEditRow({{ $sv->id }})">Hủy</button>
                                            </td>
                                        </form>
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
        function showEditRow(id) {
            document.getElementById('view-row-' + id).style.display = 'none';
            document.getElementById('edit-row-' + id).style.display = '';
        }

        function hideEditRow(id) {
            document.getElementById('edit-row-' + id).style.display = 'none';
            document.getElementById('view-row-' + id).style.display = '';
        }

        function confirmSubmit() {
            return confirm('Bạn có chắc chắn muốn nhập điểm không?');
        }
    </script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#room-table').DataTable({
                responsive: true,
                ordering: false,
                language: {
                    search: "Tìm kiếm sinh viên:",
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
