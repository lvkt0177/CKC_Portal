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
                            <form method="GET" action="{{ route('giangvien.ctdt.index') }}">
                                <label for="id_chuong_trinh_dao_tao" class="form-label fw-bold mb-1">Chuyên Ngành:</label>
                                <select name="id_chuong_trinh_dao_tao" id="id_chuong_trinh_dao_tao"
                                    onchange="this.form.submit()" class="form-control">

                                    @foreach ($ctdt as $c)
                                        <option value="{{ $c->id }}"
                                            {{ $id_chuong_trinh_dao_tao == $c->id ? 'selected' : '' }}>
                                            {{ $c->ten_chuong_trinh_dao_tao }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                @foreach ($ct_ctdt as $hocKy => $danhSachMon)
                                    <div class="col-md-6 mb-3">
                                        <h3>Học kỳ {{ $hocKy }}</h3>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Tên môn học</th>
                                                    <th class="text-center">Số tiết</th>
                                                    <th class="text-center">Số tín chỉ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($danhSachMon as $ct)
                                                    <tr>
                                                        <td style="width: 70%">{{ $ct->monHoc->ten_mon ?? 'Chưa có' }}</td>
                                                        <td class="text-center">{{ $ct->so_tiet }}</td>
                                                        <td class="text-center">{{ $ct->so_tin_chi }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                @endforeach
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
