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
                        <h3 class="card-title mb-0"> Danh sách Giảng Viên </h3>

                        <a href="" class="btn btn-primary">Thêm Giảng Viên</a>

                    </div>

                    <div class="card-header">
                        <div x-data="{ view: 'grid' }">
                            <div class="mb-3  d-flex justify-content-end align-items-center">
                                <button class="btn" :class="view === 'grid' ? 'btn-primary' : 'btn-outline-primary'"
                                    @click="view = 'grid'">
                                    <i class="fa fa-th" style="font-size: 17px"></i>
                                </button>

                                <div class="mx-1"></div>

                                <!-- Nút LIST -->
                                <button class="btn" :class="view === 'list' ? 'btn-primary' : 'btn-outline-primary'"
                                    @click="view = 'list'">
                                    <i class="fa fa-list" style="font-size: 17px"></i>
                                </button>
                            </div>

                            {{-- list view --}}
                            <div x-show="view === 'list'" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-2" class="">

                                <div class="teams-section">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered align-middle mb-0">
                                                <thead class="table-light">
                                                    <tr class="text-center">
                                                        <th>No.1</th>
                                                        <th>Họ Tên</th>
                                                        <th>Giới tính</th>
                                                        <th>Email</th>
                                                        <th>Số điện thoại</th>
                                                        <th>Địa chỉ</th>
                                                        <th>Bộ Môn</th>
                                                        <th>Khoa</th>
                                                        <th>Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($users as $gv)
                                                        <tr class="text-center">
                                                            <td>{{ $loop->index + 1 }}</td>
                                                            <td>{{ $gv->hoSo->ho_ten }}</td>
                                                            <td>{{ $gv->hoSo->gioi_tinh }}</td>
                                                            <td>{{ $gv->hoSo->email }}</td>
                                                            <td>{{ $gv->hoSo->dia_chi }}</td>
                                                            <td>{{ $gv->hoSo->so_dien_thoai }}</td>
                                                            <td>{{ $gv->boMon->ten_bo_mon }}</td>
                                                            <td>{{ $gv->boMon->chuyenNganh->khoa->ten_khoa }}</td>
                                                            <td>
                                                                <a href="{{ route('giangvien.giangvien.show', $gv->id) }}"
                                                                    class="btn btn-warning"><i class="la la-eye"></i></a>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- grid view --}}
                            <div x-show="view === 'grid'" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-2" class="">
                                <!-- Nội dung  -->
                                <div class="teams-section">
                                    <div class="card-body">
                                        <div class="row g-4">
                                            @foreach ($users as $gv)
                                                @if ($gv->getRoleNames()->first() != Acl()::ROLE_SUPER_ADMIN)
                                                    <div class="col-lg-3 col-md-3 mb-4">
                                                        <a href="{{ route('giangvien.giangvien.show', $gv->id) }}"
                                                            class="text-decoration-none" style="text-decoration: none;">
                                                            <div class="card h-100 border-0 position-relative bg-white transition-all"
                                                                style="border-radius: 12px; box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.075) !important; transition: all 0.3s ease-in-out;"
                                                                onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 0 25px rgba(54, 107, 214, 0.6)'"
                                                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1rem 2rem rgba(0, 0, 0, 0.075)'">

                                                                <div class="position-absolute top-0 end-0 p-3">
                                                                    <i class="fas fa-ellipsis-vertical text-muted"></i>
                                                                </div>
                                                                <div class="card-body text-center pt-5">
                                                                    <img src="{{ asset('' . $gv->hoSo->anh) }}"
                                                                        class="rounded-circle mb-3"
                                                                        style="width: 80px; height: 80px; object-fit: cover;"
                                                                        alt="Ảnh GV">
                                                                    <h6 class="card-title fw-semibold mb-1 text-dark">
                                                                        {{ $gv->hoSo->ho_ten }}</h6>
                                                                    <p class="text-muted mb-1">{{ $gv->hoSo->email }}</p>
                                                                    <p class="text-muted text-primary mb-0">
                                                                        {{ $gv->hoSo->so_dien_thoai }}</p>
                                                                    <hr class="my-3">
                                                                    <p class="mb-0 text-dark" style="font-size: 18px">
                                                                        {{ $gv->boMon->chuyenNganh->khoa->ten_khoa }}</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                @endif
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                </div>
            </div>
        </div>
    </div>

@endsection
