@extends('admin.layouts.app')

@section('title', 'Nhập điểm')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0"> Danh sách Sinh Viên Lớp {{ $lop_HP->ten_hoc_phan ?? '' }}
                            {{ $lop_HP->lop->ten_lop ?? '' }} </h3>
                        <a class="btn btn-back" href="{{ route('giangvien.diemmonhoc.index') }}">Quay lại</a>
                    </div>

                    <div class="card-body">
                        
                        <div class="">
                            <div class="text-end my-3">
                                <form action="{{ route('giangvien.diemmonhoc.export', $lop_HP) }}" method="get">
                                    @csrf
                                    <button class="btn btn-success">Xuất excel</button>
                                </form>
                            </div>
                            @if (!is_null($nextOption) && $nextOption->value != 4)
                                <form action="{{ route('giangvien.diemmonhoc.updateTrangThai', $lop_HP) }}" method="POST"
                                    class="mb-2" data-confirm>
                                    @csrf
                                    <div class="">
                                        <select name="trang_thai" class="form-select d-none" disabled>
                                            <option value="{{ $nextOption->value }}">{{ $nextOption->getLabel() }}</option>
                                        </select>

                                        <button type="submit" class="btn btn-primary mt-2">{{ $nextOption->getLabel() }}</button>
                                    </div>
                                </form>
                                <div class="d-flex justify-content-end mb-3">
                                    <button class="btn btn-edit btn-sm" onclick="toggleEdit()">
                                        <i class="bi bi-pencil-square"></i> Nhập điểm
                                    </button>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <strong>Thông báo:</strong> Lớp học phần này đã hoàn thành.
                                </div>
                            @endif
                           

                            <form action="{{ route('giangvien.diemmonhoc.cap-nhat-diem') }}" method="POST" data-confirm>
                                @csrf
                                <table class="table table-bordered mb-3"
                                    id="{{ $sinhviens->count() > 0 ? 'room-table' : '' }}">
                                    <thead>
                                        <tr>
                                            <th>No.1</th>
                                            <th>Mã SV</th>
                                            <th>Họ tên</th>
                                            <th>Điểm chuyên cần</th>
                                            <th>Điểm quá trình</th>
                                            <th>Điểm thi lần 1</th>
                                            <th>Điểm thi lần 2</th>
                                            <th>Điểm trung bình</th>
                                            <th>Loại sinh viên</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($sinhviens as $sv)
                                            @foreach ($sv->danhSachHocPhans as $dshp)
                                                <tr>
                                                    <input type="hidden" name="students[{{ $sv->id }}]"
                                                        value="{{ $sv->id }}">
                                                    @if ($loop->first)
                                                        <input type="hidden" name="id_lop_hoc_phan"
                                                            value="{{ $dshp->id_lop_hoc_phan }}">
                                                    @endif
                                                    <td>{{ $loop->parent->iteration }}</td>
                                                    <td>{{ $sv->ma_sv }}</td>
                                                    <td>{{ $sv->hoSo->ho_ten }}</td>
                                                    <td>
                                                        <span class="score-view">{{ $dshp->diem_chuyen_can }}</span>
                                                        <input type="number" step="0.1" min="0" max="10"
                                                            name="diem_chuyen_can[{{ $dshp->id_sinh_vien }}]"
                                                            value="{{ $dshp->diem_chuyen_can }}"
                                                            class="form-control score-input" style="display:none;"
                                                            {{ $nextOption->value - 1 == 0 ? '' : 'readonly' }} />
                                                    </td>
                                                    <td>
                                                        <span class="score-view">{{ $dshp->diem_qua_trinh }}</span>
                                                        <input type="number" step="0.1" min="0" max="10"
                                                            name="diem_qua_trinh[{{ $dshp->id_sinh_vien }}]"
                                                            value="{{ $dshp->diem_qua_trinh }}"
                                                            class="form-control score-input" style="display:none;"
                                                            {{ $nextOption->value - 1 == 0 ? '' : 'readonly' }} />
                                                    </td>
                                                    <td>
                                                        <span class="score-view">{{ $dshp->diem_thi_lan_1 }}</span>
                                                        <input type="number" step="0.1" min="0" max="10"
                                                            name="diem_thi_lan_1[{{ $dshp->id_sinh_vien }}]"
                                                            value="{{ $dshp->diem_thi_lan_1 }}"
                                                            class="form-control score-input" style="display:none;"
                                                            {{ $nextOption->value - 1 == 1 ? '' : 'readonly' }} />
                                                    </td>
                                                    <td>
                                                        <span class="score-view">{{ $dshp->diem_thi_lan_2 }}</span>
                                                        <input type="number" step="0.1" min="0" max="10"
                                                            name="diem_thi_lan_2[{{ $dshp->id_sinh_vien }}]"
                                                            value="{{ $dshp->diem_thi_lan_2 }}"
                                                            class="form-control score-input" style="display:none;"
                                                            {{ $nextOption->value - 1 == 2 ? '' : 'readonly' }} />
                                                    </td>
                                                    <td>{{ $dshp->diem_tong_ket ?? '' }}</td>
                                                    <td>{{ $dshp->loai_hoc == 0 ? 'Chính quy' : 'Học ghép' }}</td>
                                                </tr>
                                            @endforeach
                                        @empty
                                            <tr>
                                                <td colspan="10">Không có sinh viên nào.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <div class="d-flex justify-content-end mb-3">
                                        <div>
                                            <button type="submit" class="btn btn-success btn-sm mx-1 d-none"
                                                id="btn-luu">
                                                <i class="bi bi-save"></i> Lưu
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm d-none" id="btn-huy"
                                                onclick="cancelEdit()">
                                                <i class="bi bi-x-circle"></i> Hủy
                                            </button>
                                        </div>
                                    </div>
                                </table>

                            </form>
                        </div>
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
            $('#room-table,#room-table-multi').DataTable({
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


        function toggleEditAll(enable) {
            const allRows = document.querySelectorAll('#room-table tbody tr');

            allRows.forEach(row => {
                const views = row.querySelectorAll('.score-view');
                const inputs = row.querySelectorAll('.score-input');

                views.forEach(v => v.style.display = enable ? 'none' : '');
                inputs.forEach(i => i.style.display = enable ? 'inline-block' : 'none');
            });
        }

        function toggleEdit() {

            document.querySelectorAll('.score-view').forEach(el => el.style.display = 'none');
            document.querySelectorAll('.score-input').forEach(el => el.style.display = 'inline-block');


            document.getElementById('btn-luu').classList.remove('d-none');
            document.getElementById('btn-huy').classList.remove('d-none');


            document.getElementById('btn-nhap-diem').classList.add('d-none');
        }


        function cancelEdit() {

            document.querySelectorAll('.score-view').forEach(el => el.style.display = '');
            document.querySelectorAll('.score-input').forEach(el => el.style.display = 'none');


            document.getElementById('btn-luu').classList.add('d-none');
            document.getElementById('btn-huy').classList.add('d-none');


            document.getElementById('btn-nhap-diem').classList.remove('d-none');
        }
    </script>
@endsection
