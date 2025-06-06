@extends('admin.layouts.app')

@section('title', 'Nhập điểm')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0"> Danh sách Sinh Viên Lớp {{ $lop_HP->ten_hoc_phan ?? '' }} </h3>
                        <a class="btn btn-primary" href="{{route('admin.student.index')}}">Quay lại</a>

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
                                                <tr>
                                                    <td>{{ $loop->parent->index + 1 }}</td> {{-- Chỉ số sinh viên --}}
                                                    <td>{{ $sv->ma_sv }}</td>
                                                    <td>{{ $sv->hoSo->ho_ten }}</td>
                                                    <td>{{ $sv->lop->ten_lop }}</td>
                                                    <td>{{ $dshp->diem_chuyen_can   }}</td>
                                                    <td>{{ $dshp->diem_qua_trinh   }}</td>
                                                    <td>{{ $dshp->diem_thi  }}</td>
                                                    <td>{{ $dshp->diem_tong_ket == 0 ? '' : $dshp->diem_tong_ket  }}</td>
                                                    <td>{{ $dshp->loai_sinh_vien == 0 ? ' ' : 'Học Ghép' }}</td>
                                                    <td><button class="btn btn-primary" 
                                                        data-bs-toggle="modal"
                                                         data-bs-target="#editModal-{{ $sv->id }}">
                                                        Sửa điểm</button></td>
                                            </tr>      
                                            <!-- Modal sửa điểm -->
                                            <div class="modal fade" id="editModal-{{ $sv->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $sv->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('admin.enterpoint.cap-nhat-diem') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="dshp_id" value="{{ $dshp->id_sinh_vien }}">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editModalLabel-{{ $dshp->id_sinh_vien }}">Sửa điểm - {{ $sv->hoSo->ho_ten }}</h5>
                                                                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Đóng">Đóng</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Điểm chuyên cần</label>
                                                                    <input type="number" step="0.1" name="diem_chuyen_can" value="{{ $dshp->diem_chuyen_can }}"
                                                                        class="form-control">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Điểm quá trình</label>
                                                                    <input type="number" step="0.1" name="diem_qua_trinh" value="{{ $dshp->diem_qua_trinh }}"
                                                                        class="form-control">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Điểm thi</label>
                                                                    <input type="number" step="0.1" name="diem_thi" value="{{ $dshp->diem_thi }}"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                                <button type="submit" class="btn btn-success">Lưu điểm</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

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