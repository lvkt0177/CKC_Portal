@extends('admin.layouts.app')

@section('title', 'Nhập điểm')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0"> Danh sách Sinh Viên Lớp {{ $lop_HP->ten_hoc_phan ?? '' }} </h3>
                        <a class="btn btn-primary" href="{{route('admin.enterpoint.index')}}">Quay lại</a>

                    </div>

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered align-middle mb-0">
                                <thead class="table-light">
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
                                        <th>Tùy chọn</th>
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
                                                        onclick="showEditRow({{ $dshp->id_sinh_vien }})">Sửa</button>
                                                </td>
                                            </tr>     
                                                <!-- Modal sửa điểm -->
                                                <tr id="edit-row-{{ $dshp->id_sinh_vien }}" style="display: none;">
                                                    <form action="{{ route('admin.enterpoint.cap-nhat-diem') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id_sinh_vien" value="{{ $dshp->id_sinh_vien }}">
                                                        <input type="hidden" name="id_lop_hoc_phan" value="{{ $dshp->id_lop_hoc_phan }}">
                                                        <td>{{ $loop->parent->iteration }}</td>
                                                        <td>{{ $sv->ma_sv }}</td>
                                                        <td>{{ $sv->hoSo->ho_ten }}</td>
                                                        <td>{{ $sv->lop->ten_lop }}</td>
                                                        <td>
                                                            <input type="number" step="0.1" name="diem_chuyen_can" value="{{ $dshp->diem_chuyen_can }}"
                                                                class="form-control" 
                                                                min="0"
                                                                max="10"
                                                                oninvalid="this.setCustomValidity('Vui lòng nhập điểm từ 0 đến 10')"
                                                                oninput="this.setCustomValidity('')">
                                                                @error('diem_chuyen_can')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                        </td>
                                                        <td>
                                                            <input type="number" step="0.1" name="diem_qua_trinh" value="{{ $dshp->diem_qua_trinh }}"
                                                                class="form-control"  
                                                                min="0"
                                                                max="10"
                                                                oninvalid="this.setCustomValidity('Vui lòng nhập điểm từ 0 đến 10')"
                                                                oninput="this.setCustomValidity('')">
                                                                @error('diem_qua_trinh')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                        </td>
                                                        <td>
                                                            <input type="number" step="0.1" name="diem_thi" value="{{ $dshp->diem_thi }}" class="form-control"  step="0.1"
                                                            min="0"
                                                            max="10"
                                                            oninvalid="this.setCustomValidity('Vui lòng nhập điểm từ 0 đến 10')"
                                                            oninput="this.setCustomValidity('')">
                                                            @error('diem_thi')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </td>
                                                        <td colspan="2">Cập nhật điểm</td>
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
    <script>
        function showEditRow(id) {
            document.getElementById('view-row-' + id).style.display = 'none';
            document.getElementById('edit-row-' + id).style.display = '';
        }

        function hideEditRow(id) {
            document.getElementById('edit-row-' + id).style.display = 'none';
            document.getElementById('view-row-' + id).style.display = '';
        }
        function lamTronDiem(input) {
            let value = parseFloat(input.value);
            if (!isNaN(value)) {
                value = Math.round(value * 10) / 10; // Làm tròn 1 chữ số thập phân
                if (value < 0) value = 0;
                if (value > 10) value = 10;
                input.value = value.toFixed(1);
            }
        }

    </script>
@endsection
