@extends('admin.layouts.app')

@section('title', 'Quản lý Phiếu Lên Lớp')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/thongkepll.css') }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm teams-section">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">📊 Thống kê phiếu lên lớp</h3>
                    </div>

                    <div class="teams-section">
                        <form action="{{ route('giangvien.phieulenlop.manage') }}" method="GET" class="col-6">
                            <select name="id_khoa" id="" class="form-select m-3 " onchange="this.form.submit()">
                                @foreach ($dsKhoa as $khoa)
                                    <option value="{{ $khoa->id }}" {{ $idKhoa == $khoa->id ? 'selected' : '' }}>
                                        {{ $khoa->ten_khoa }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                        @if ($users->count() > 0)
                            <div class="content">
                                <div class="stats-grid" id="teacherStats">
                                    @foreach ($users as $gv)
                                        @if ($gv->getRoleNames()->first() != Acl()::ROLE_SUPER_ADMIN)
                                            <div class="teacher-card">
                                                <div class="teacher-info">
                                                    <img class="teacher-avatar" src="{{ asset('' . $gv->hoSo->anh) }}">
                                                    </img>
                                                    <div class="teacher-details">
                                                        <h3>{{ $gv->hoSo->ho_ten }}</h3>
                                                        <p>{{ $gv->hoSo->email }}{{ $gv->hoSo->so_dien_thoai }}</p>
                                                    </div>
                                                </div>
                                                <div class="stats-number">
                                                    0
                                                </div>
                                                <a href="{{ route('giangvien.phieulenlop.details', $gv->id) }}"><button
                                                        class="detail-btn">Xem chi tiết</button></a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="text-center">
                                <h5><em>Chưa có giáo viên tại khoa này!</em></h5>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
