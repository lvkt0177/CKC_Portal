@extends('admin.layouts.app')

@section('title', 'Quản lý khung đào tạo')

@section('css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="{{ asset('assets/client/css/khungdaotao.css') }}">
@endsection


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0"> Chương trình đào tạo </h3>
                        <a href="{{ route('giangvien.ctdt.create') }}" class="btn btn-primary">Khởi tạo tuần</a>
                    </div>
                    <div class="card-body">
                        <div>
                            <form method="GET" action="{{ route('giangvien.ctdt.index') }}">

                                {{-- Dropdown Ngành học - luôn hiển thị --}}
                                <label class="form-label fw-bold">Ngành học:</label>
                                <label class="form-label fw-bold">Ngành học (cha):</label>
                                <select name="id_chuyen_nganh_cha" class="form-control" onchange="this.form.submit()">
                                    <option value="">-- Chọn ngành cha --</option>
                                    @foreach ($dsChuyenNganhCha as $cha)
                                        <option value="{{ $cha->id }}"
                                            {{ $id_chuyen_nganh_cha == $cha->id ? 'selected' : '' }}>
                                            {{ $cha->ten_chuyen_nganh }}
                                        </option>
                                    @endforeach
                                </select>


                                @if ($dsChuyenNganhCon->isNotEmpty())
                                    <label class="form-label fw-bold mt-2">Ngành học (con):</label>
                                    <select name="id_chuyen_nganh" class="form-control" onchange="this.form.submit()">
                                        <option value="">-- Chọn ngành con --</option>
                                        @foreach ($dsChuyenNganhCon as $con)
                                            <option value="{{ $con->id }}"
                                                {{ $id_chuyen_nganh == $con->id ? 'selected' : '' }}>
                                                {{ $con->ten_chuyen_nganh }}
                                            </option>
                                        @endforeach
                                    </select>
                                @endif


                                <label class="form-label fw-bold mt-2">Niên khóa:</label>
                                <select name="id_nien_khoa" class="form-control" onchange="this.form.submit()">
                                    <option value="">-- Chọn niên khóa --</option>
                                    @foreach ($dsNienKhoa as $nk)
                                        <option value="{{ $nk->id }}"
                                            {{ $id_nien_khoa == $nk->id ? 'selected' : '' }}>
                                            {{ $nk->ten_nien_khoa }}
                                        </option>
                                    @endforeach
                                </select>

                            </form>

                        </div>
                    </div>

                    @php
                        $tongMonHoc = 0;
                        $tongSoTinChi = 0;
                        $tongSoTiet = 0;
                        $tongHocKy = count($ct_ctdt);

                        foreach ($ct_ctdt as $dsMon) {
                            $tongMonHoc += count($dsMon);
                            $tongSoTinChi += $dsMon->sum('so_tin_chi');
                            $tongSoTiet += $dsMon->sum('so_tiet');
                        }
                    @endphp
                    <div class="semester-card">

                        <div class="summary-section">
                            <div class="summary-header">
                                <div class="summary-icon">📊</div>
                                <h2 class="summary-title">Tổng Kết Chương Trình</h2>
                            </div>

                            <div class="summary-grid">
                                <div class="summary-item">
                                    <div class="summary-number">{{ $tongMonHoc }}</div>
                                    <div class="summary-label">Tổng môn học</div>
                                </div>
                                <div class="summary-item">
                                    <div class="summary-number">{{ $tongSoTiet }}</div>
                                    <div class="summary-label">Tổng số tiết</div>
                                </div>
                                <div class="summary-item">
                                    <div class="summary-number">{{ $tongSoTinChi }}</div>
                                    <div class="summary-label">Tổng tín chỉ</div>
                                </div>
                                <div class="summary-item">
                                    <div class="summary-number">{{ $tongHocKy }}</div>
                                    <div class="summary-label">Số học kỳ</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="curriculum-grid" id="curriculumGrid">

                        @foreach ($ct_ctdt as $hocKy => $danhSachMon)
                            <div class="semester-card">
                                <div class="semester-header">
                                    <h3 class="semester-title">
                                        {{ $ct_ctdt[$hocKy]->first()->hocKy->ten_hoc_ky ?? '---' }}
                                    </h3>
                                    <div class="semester-stats">
                                        <div class="stat-item">
                                            <div class="stat-icon">📚</div>
                                            <span>{{ count($danhSachMon) }} môn học</span>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-icon">⏱️</div>
                                            <span>{{ $danhSachMon->sum('so_tiet') }} tiết</span>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-icon">🏆</div>
                                            <span>{{ $danhSachMon->sum('so_tin_chi') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <table class="subjects-table">
                                    <thead class="table-header">
                                        <tr>
                                            <th>Tên môn học</th>
                                            <th class="text-center">Số tiết</th>
                                            <th class="text-center">Số tín chỉ</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body">
                                        @foreach ($danhSachMon as $ct)
                                            <tr>
                                                <td class="subject-name">{{ $ct->monHoc->ten_mon ?? 'Chưa có' }}</td>
                                                <td class="subject-hours">{{ $ct->so_tiet }}</td>
                                                <td class="subject-credit">{{ $ct->so_tin_chi }}</td>
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

@endsection

@section('js')

@endsection
