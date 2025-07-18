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

                                <div class="">
                                    <div class="">
                                        <div class="teams-section">
                                            <table class="team-table align-middle mb-4" id="room-table">
                                                <thead class="table-light">
                                                    <tr class="text-center">
                                                        <th>No.1</th>
                                                        <th>Họ Tên</th>
                                                        <th>Giới tính</th>
                                                        <th>Email</th>
                                                        <th>Địa chỉ</th>
                                                        <th>Số điện thoại</th>
                                                        <th>Bộ Môn</th>
                                                        <th>Khoa</th>
                                                        <th>Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($users as $gv)
                                                        @if ($gv->getRoleNames()->first() != Acl()::ROLE_SUPER_ADMIN)
                                                            <tr class="text-center" style="font-weight: 400">
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
                                                                        class="btn btn-warning"><i class="fa fa-eye" aria-hidden="true"></i></i></a>
                                                                </td>
                                                            </tr>
                                                        @endif
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
                                <div class="mb-3">
                                    <label for="" class="form-label">Tìm kiếm giảng viên</label>
                                    <input type="text" id="userSearchInput" class="form-control" placeholder="Tìm kiếm theo tên, email hoặc chuyên ngành...">
                                </div>
                                <div class="teams-section">
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach ($users as $gv)
                                                @if ($gv->getRoleNames()->first() != Acl()::ROLE_SUPER_ADMIN)
                                                <div class="col-lg-3 col-md-6 mb-4 user-card"
                                                        data-name="{{ Str::lower($gv->hoSo->ho_ten) }}"
                                                        data-email="{{ Str::lower($gv->hoSo->email) }}"
                                                        data-major="{{ Str::lower($gv->boMon->chuyenNganh->ten_chuyen_nganh ?? '') }}">
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

@section('js')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#room-table').DataTable({
                    responsive: true,
                    ordering: false,
                    language: {
                        search: "Tìm kiếm giảng viên:",
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
        
        document.addEventListener("DOMContentLoaded", function () {
            const input = document.getElementById("userSearchInput");
            const cards = document.querySelectorAll(".user-card");

            input.addEventListener("input", function () {
                const keyword = this.value.trim().toLowerCase();

                cards.forEach(card => {
                    const name = card.getAttribute("data-name");
                    const email = card.getAttribute("data-email");
                    const major = card.getAttribute("data-major");

                    if (name.includes(keyword) || email.includes(keyword) || major.includes(keyword)) {
                        card.style.display = "block";
                    } else {
                        card.style.display = "none";
                    }
                });
            });
        });
    </script>
@endsection