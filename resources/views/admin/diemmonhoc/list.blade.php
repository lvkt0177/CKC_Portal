@extends('admin.layouts.app')

@section('title', 'Nhập điểm')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0"> Danh sách Sinh Viên Lớp {{ $lop_HP->ten_hoc_phan ?? '' }} </h3>
                        <a class="btn btn-back" href="{{ route('admin.diemmonhoc.index') }}">Quay lại</a>

                    </div>

                    <div class="card-body">

                        <div class="">
                            <table class="team-table align-middle" id="room-table">
                                <thead>
                                    <tr>
                                        <th>No.1</th>
                                        <th>Mã SV</th>
                                        <th>Họ tên</th>
                                        <th>Tên lớp</th>
                                        <th>Điểm chuyên cần</th>
                                        <th>Điểm quá trình</th>
                                        <th>Điểm thi</th>
                                        <th>Điểm trung bình</th>
                                        <th>Loại sinh viên</th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($sinhviens as $sv)
                                        @foreach ($sv->danhSachHocPhans as $dshp)
                                            <tr id="view-row-{{ $dshp->id_sinh_vien }}">
                                                <td>{{ $loop->parent->iteration }}</td>
                                                <td>{{ $sv->ma_sv }}</td>
                                                <td>{{ $sv->hoSo->ho_ten }}</td>
                                                <td>{{ $sv->lop->ten_lop }}</td>
                                                <td>{{ $dshp->diem_chuyen_can }}</td>
                                                <td>{{ $dshp->diem_qua_trinh }}</td>
                                                <td>{{ $dshp->diem_thi }}</td>
                                                <td>{{ is_null($dshp->diem_tong_ket) ? '' : $dshp->diem_tong_ket }}</td>
                                                <td>{{ $dshp->loai_sinh_vien == 0 ? 'Chính quy' : 'Học ghép' }}</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm"
                                                        onclick="showEditRow({{ $dshp->id_sinh_vien }})"><i
                                                            class="bi bi-pencil-square"></i></button>
                                                </td>
                                            </tr>
                                            <!-- Modal sửa điểm -->
                                            <tr id="edit-row-{{ $dshp->id_sinh_vien }}" style="display: none;">
                                                <form action="{{ route('admin.diemmonhoc.cap-nhat-diem') }}" method="POST"
                                                    data-confirm>
                                                    @csrf
                                                    <input type="hidden" name="id_sinh_vien"
                                                        value="{{ $dshp->id_sinh_vien }}">
                                                    <input type="hidden" name="id_lop_hoc_phan"
                                                        value="{{ $dshp->id_lop_hoc_phan }}">
                                                    <td>{{ $loop->parent->iteration }}</td>
                                                    <td>{{ $sv->ma_sv }}</td>
                                                    <td>{{ $sv->hoSo->ho_ten }}</td>
                                                    <td>{{ $sv->lop->ten_lop }}</td>
                                                    <td>
                                                        <input type="number" step="0.1" name="diem_chuyen_can"
                                                            value="{{ old('diem_chuyen_can', $dshp->diem_chuyen_can) }}"
                                                            class="form-control" min="0" max="10"
                                                            oninvalid="this.setCustomValidity('Vui lòng nhập điểm từ 0 đến 10')"
                                                            oninput="this.setCustomValidity('')">
                                                        @error('diem_chuyen_can')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="number" step="0.1" name="diem_qua_trinh"
                                                            value="{{ old('diem_qua_trinh', $dshp->diem_qua_trinh) }}"
                                                            class="form-control" min="0" max="10"
                                                            oninvalid="this.setCustomValidity('Vui lòng nhập điểm từ 0 đến 10')"
                                                            oninput="this.setCustomValidity('')">
                                                        @error('diem_qua_trinh')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="number" step="0.1" name="diem_thi"
                                                            value="{{ old('diem_thi', $dshp->diem_thi) }}"
                                                            class="form-control" step="0.1" min="0"
                                                            max="10"
                                                            oninvalid="this.setCustomValidity('Vui lòng nhập điểm từ 0 đến 10')"
                                                            oninput="this.setCustomValidity('')">
                                                        @error('diem_thi')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td colspan="2">Cập nhật điểm</td>
                                                    <td></td>
                                                    <td>
                                                        <button type="submit" class="btn btn-success btn-sm">Lưu</button>
                                                        <button type="button" class="btn btn-secondary btn-sm"
                                                            onclick="hideEditRow({{ $dshp->id_sinh_vien }})">Hủy</button>
                                                    </td>
                                                </form>
                                            </tr>
                                        @endforeach
                                    @empty
                                        <tr>
                                            <td colspan="6">Không có sinh viên nào.</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>

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

        function showEditRow(id) {
            document.getElementById('view-row-' + id).style.display = 'none';
            document.getElementById('edit-row-' + id).style.display = '';
        }

        function hideEditRow(id) {
            document.getElementById('edit-row-' + id).style.display = 'none';
            document.getElementById('view-row-' + id).style.display = '';
        }
    </script>
@endsection
