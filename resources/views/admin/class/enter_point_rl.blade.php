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
                        <table class="team-table">
                            <thead class="table-center">
                                <tr class="text-center">
                                    <th><input type="checkbox" id="checkAll" style="left: 0"></th>
                                    <th>No.</th>
                                    <th>MSSV</th>
                                    <th>Họ tên sinh viên</th>
                                    <th>Rèn luyện</th>
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
                                            @if ($sv->diemRenLuyens->isNotEmpty())
                                                {{ $sv->diemRenLuyens->first()->xep_loai }}
                                            @else
                                                Chưa có điểm
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm"
                                                onclick="showEditRow({{ $sv->id }})"><i
                                                    class="bi bi-pencil-square"></i></button>
                                        </td>
                                    <tr id="edit-row-{{ $sv->id }}" style="display: none;">
                                        <form action="{{ route('admin.lop.cap-nhat-diem_rl', $sv) }}" method="POST"
                                            onsubmit="return confirmSubmit();">
                                            @csrf
                                            <input type="hidden" name="sv" value="{{ $sv }}">
                                            <td>
                                                <input type="checkbox" class="student-checkbox" name="selected_students[]"
                                                    value="{{ $sv->id }}">
                                            </td>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $sv->ma_sv }}</td>
                                            <td>{{ $sv->hoSo->ho_ten }}</td>
                                            <td>
                                                <input type="text" name="xep_loai"
                                                    value="{{ optional($sv->diemRenLuyens->first())->xep_loai }}"
                                                    class="form-control xep-loai-input"
                                                    oninput="this.value = this.value.toUpperCase().replace(/[^ABCD]/g, '')"
                                                    maxlength="1">

                                                {{-- @error('diem_thi')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror --}}
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
