@extends('admin.layouts.app')

@section('title', 'Danh sách Giảng viên')

@section('css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0"> Chương trình đào tạo </h3>
                    </div>
                    <div class="card-body">
                        <div>
                            <form method="GET" action="{{ route('admin.ctdt.index') }}">
                            <label for="id_chuong_trinh_dao_tao" class="form-label fw-bold mb-1">Chuyên Ngành:</label>
                            <select name="id_chuong_trinh_dao_tao" id="id_chuong_trinh_dao_tao" onchange="this.form.submit()" class="form-control">
                                <option value="" {{ $id_chuong_trinh_dao_tao == '' ? 'selected' : '' }}>-- Tất cả chuyên ngành --
                                </option>
                                @foreach ($ctdt as $c)
                                    <option value="{{ $c->id }}" {{ $id_chuong_trinh_dao_tao == $c->id ? 'selected' : '' }}>
                                        {{ $c->ten_chuong_trinh_dao_tao }}
                                    </option>
                                @endforeach
                            </select>
                            </form>
                        </div>
                    </div>
                    {{-- <div class="card-body">
                    @foreach ($ct_ctdt as $hocKy => $danhSachMon)
                        <h3>Học kỳ {{ $hocKy }}</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tên môn học</th>
                                    <th>Số tiết</th>
                                    <th>Số tín chỉ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($danhSachMon as $ct)
                                    <tr>
                                        <td>{{ $ct->monHoc->ten_mon ?? 'Chưa có' }}</td>
                                        <td>{{ $ct->so_tiet }}</td>
                                        <td>{{ $ct->so_tin_chi }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endforeach
                    </div> --}}
                    <div class="card-body">
                        <h3> Lớp học phần </h3>
                        @foreach ($lop_hoc_phan as $lhp)
                            <button class="btn btn-primary">{{ $lhp->ten_hoc_phan }}
                                <p>{{ $lhp->lop->ten_lop }}</p>
                                @foreach ($danh_sach_HP as $dshp)
                                    @if ($dshp->sinhVien->id_lop != $lhp->id_lop)
                                        <tr><td>{{ $dshp->sinhVien->hoSo->ho_ten }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </button>
                        @endforeach
                    </div>
                    <div class="card-body">
                        <h3> Lớp học phần </h3>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection