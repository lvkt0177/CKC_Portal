@extends('admin.layouts.app')

@section('title', 'Lớp chủ nhiệm')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/diemrl.css') }}">
@endsection

@section('content')
    <div class="container-fluid teams-section">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm teams-section">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Danh sách Sinh viên - Lớp {{ $lop->ten_lop }}</h3>
                        <a href="{{ route('giangvien.lop.index') }}" class="btn btn-primary">Quay lại</a>
                    </div>

                    <div class="teams-section "
                        style=" background: linear-gradient(180deg, #4891e9 10%, #9bc9ec 90%); border-radius: 25px;">
                        <form method="GET" id="week-form" action="{{ route('giangvien.lop.nhap-diem_rl', $lop->id) }}"
                            class="d-flex justify-content-center pt-4 px-3 ">
                            <div class="date-picker-grid">
                                @php
                                    $namHienTai = now()->year;
                                    $thangHienTai = now()->month;
                                    $namDangChon = request('nam', $namHienTai);
                                    $thang = request('thoi_gian', $thangHienTai);
                                @endphp
                                <div class="date-picker-field">
                                    <label>Chọn năm:</label>
                                    <select id="namSelect" name="nam" class="select form-control"
                                        onchange="document.getElementById('week-form').submit()">
                                        @for ($i = 0; $i < 4; $i++)
                                            @php $nam = $namHienTai - $i; @endphp
                                            <option value="{{ $nam }}"
                                                {{ $namDangChon == $nam ? 'selected' : '' }}>
                                                Năm {{ $nam }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="date-picker-field">
                                    <label>Chọn tháng:</label>
                                    <select class="select form-control" name="thoi_gian" id="thangSelect"
                                        onchange="document.getElementById('week-form').submit()">

                                    </select>
                                </div>
                            </div>
                        </form>
                        <div class="design-section" id="bulkFormContainer" style="display: none;">
                            <div class="modern-form-container" style="border-radius: 25px">
                                <h2 class="design-title">Xếp loại hàng loạt</h2>
                                <form action="{{ route('giangvien.lop.cap-nhat-diem-checked') }}" method="POST"
                                    data-confirm>
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="selected_students" id="selectedStudents">
                                        <input type="hidden" name="thoi_gian" value="{{ $thang }}">
                                        <input type="hidden" name="nam" value="{{ $namDangChon }}">

                                        <div class="select-wrapper">
                                            <select class="modern-select" name="xep_loai">
                                                <option value="">-- Chọn xếp loại --</option>
                                                <option value="1">A</option>
                                                <option value="2">B</option>
                                                <option value="3">C</option>
                                                <option value="4">D</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="button-group">
                                        <button type="submit" class="modern-btn modern-btn-primary"
                                            onclick="prepareSelectedStudents()">
                                            ✓ Lưu Lại
                                        </button>
                                        <button type="button" class="modern-btn modern-btn-secondary" id="cancelBtn">
                                            ✕ Hủy Bỏ
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                    <div class="my-3"></div>
                    <table class="team-table " id="room-table">
                        <thead class="table-center">
                            <tr class="text-center">
                                @if ($namDangChon == now()->year && $thang == now()->month)
                                    <th><input type="checkbox" id="checkAll" style="left: 0"></th>
                                @endif
                                <th>No.</th>
                                <th>MSSV</th>
                                <th>Họ tên sinh viên</th>
                                <th>Rèn luyện</th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($sinhViens as $sv)
                                <tr id="view-row-{{ $sv->id }}" class="text-center">
                                    @if ($namDangChon == now()->year && $thang == now()->month)
                                        <td>
                                            <input type="checkbox" class="student-checkbox" name="selected_students[]"
                                                value="{{ $sv->sinhVien->id }}">
                                        </td>
                                    @endif
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $sv->sinhVien->ma_sv }}</td>
                                    <td>{{ $sv->sinhvien->hoSo->ho_ten }}</td>
                                    <td>
                                        @php
                                            $diemRL = $sv->sinhVien->diemRenLuyens->first();
                                        @endphp
                                        @if ($diemRL)
                                            @if ($namDangChon == now()->year && $thang == now()->month)
                                                <form action="{{ route('giangvien.lop.cap-nhat-diem_rl') }}" method="POST"
                                                    data-confirm>
                                                    @csrf
                                                    <input type="hidden" name="id_sinh_vien"
                                                        value="{{ $sv->sinhVien->id }}">
                                                    <input type="hidden" name="thoi_gian" value="{{ $thang }}">
                                                    <input type="hidden" name="nam" value="{{ $namDangChon }}">
                                                    <select class="modern-select" name="xep_loai" onchange="form.submit()">
                                                        @foreach ([1, 2, 3, 4] as $loai)
                                                            <option value="{{ $loai }}"
                                                                {{ $loai != $diemRL->xep_loai->value ? '' : 'selected' }}>
                                                                {{ \App\Enum\XepLoaiDRL::from($loai)->getLabel() }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </form>
                                            @else
                                                <span> {{ $diemRL->xep_loai->getLabel() }}</span>
                                            @endif
                                        @else
                                            @if ($namDangChon == now()->year && $thang == now()->month)
                                                <form action="{{ route('giangvien.lop.cap-nhat-diem_rl') }}" method="POST"
                                                    data-confirm>
                                                    @csrf
                                                    <input type="hidden" name="id_sinh_vien"
                                                        value="{{ $sv->sinhVien->id }}">
                                                    <input type="hidden" name="thoi_gian" value="{{ $thang }}">
                                                    <input type="hidden" name="nam" value="{{ $namDangChon }}">
                                                    <select class="modern-select" name="xep_loai"
                                                        onchange="form.submit()">
                                                        @foreach ([0, 1, 2, 3, 4] as $loai)
                                                            <option value="{{ $loai }}">
                                                                {{ \App\Enum\XepLoaiDRL::from($loai)->getLabel() }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </form>
                                            @else
                                                <span></span>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @error('xep_loai')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
        const thangSelect = document.getElementById('thangSelect');
        const namSelect = document.getElementById('namSelect');

        function capNhatDanhSachThang() {
            const namHienTai = new Date().getFullYear();
            const thangHienTai = new Date().getMonth() + 1;
            const namDangChon = parseInt(namSelect.value);
            const thangToiDa = (namDangChon === namHienTai) ? thangHienTai : 12;

            const thangDangChon = parseInt({{ $thang }});


            thangSelect.innerHTML = '';


            for (let i = 1; i <= thangToiDa; i++) {
                const option = document.createElement('option');
                option.value = i;
                option.text = 'Tháng ' + i;
                if (i === thangDangChon) option.selected = true;
                thangSelect.appendChild(option);
            }
        }

        // Gọi khi tải trang lần đầu
        capNhatDanhSachThang();

        // Gọi lại mỗi khi chọn năm
        namSelect.addEventListener('change', function() {
            capNhatDanhSachThang();
        });




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
        const checkAll = document.getElementById('checkAll');
        const studentCheckboxes = document.querySelectorAll('.student-checkbox');
        const bulkFormContainer = document.getElementById('bulkFormContainer');

        // Khi nhấn "chọn tất cả"
        checkAll.addEventListener('change', function() {
            studentCheckboxes.forEach(cb => cb.checked = this.checked);
            toggleBulkForm();
        });


        studentCheckboxes.forEach(cb => {
            cb.addEventListener('change', toggleBulkForm);
        });

        cancelBtn.addEventListener('click', function() {
            checkAll.checked = false;
            studentCheckboxes.forEach(cb => cb.checked = false);
            toggleBulkForm();
        });

        function toggleBulkForm() {

            const hasChecked = [...studentCheckboxes].some(cb => cb.checked);
            bulkFormContainer.style.display = hasChecked ? 'block' : 'none';
        }

        function getSelectedStudentIds() {
            const checkboxes = document.querySelectorAll('.student-checkbox:checked');
            return Array.from(checkboxes).map(cb => cb.value);
        }

        function prepareSelectedStudents() {
            const ids = getSelectedStudentIds();
            document.getElementById('selectedStudents').value = JSON.stringify(ids);
        }
    </script>
@endsection
