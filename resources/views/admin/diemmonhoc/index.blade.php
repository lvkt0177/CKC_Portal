@extends('admin.layouts.app')

@section('title', 'Nhập điểm')
@section('css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0"> Danh sách các lớp học phần</h3>
                    </div>
                    <div class="card-body">
                        <div class="card-bod p-2">
                            <div class="row justify-content-start g-4">
                                @foreach ($lop_hoc_phan as $lhp)
                                    <div class="col-md-6 col-lg-4 col-sm-6 mb-4">
                                        <div class="card h-100 shadow-sm"
                                            style="border-radius: 15px; overflow: hidden; border: 1.5px solid #ced4da;">

                                            <!-- Header -->
                                            <div style="background: #007ACC url('https://img.tripi.vn/cdn-cgi/image/width=700,height=700/https://gcs.tripi.vn/public-tripi/tripi-feed/img/482601ikZ/anh-mo-ta.png') no-repeat right center; background-size: cover; height: 100px; position: relative;">

                                                <!-- Overlay đen nhẹ -->
                                                <div style="position: absolute; inset: 0; z-index: 1;">
                                                </div>

                                                <!-- Nội dung -->
                                                <div style="position: relative; z-index: 2;">
                                                    <h4 class="text-white fw-bold px-3 pt-3 mb-1">{{ $lhp->ten_hoc_phan }}
                                                    </h4>
                                                    <p class="text-white px-3 mb-2 fw-bold">
                                                        {{ $lhp->giangVien->hoSo->ho_ten }}
                                                    </p>
                                                </div>

                                                <!-- Avatar -->
                                                <img src="{{ asset('' . $lhp->giangVien->hoSo->anh) }}" alt="Avatar"
                                                    style="width: 70px; height: 70px; object-fit: cover; border-radius: 50%; position: absolute; bottom: 10px; right: 15px; border: 1px solid white; z-index: 3;">
                                            </div>

                                            <!-- Body -->
                                            <div class="card-body pt-4" style="background-color: #f8f9fa;">
                                                {{-- Nội dung khác nếu có --}}
                                            </div>

                                            <!-- Footer -->
                                            <div class="card-footer d-flex justify-content-between gap-2"
                                                style="background-color: #f8f9fa; border-top: 1.5px solid #ced4da !important; padding-top: 12px;">
                                                <p><b>Lớp:</b> {{ $lhp->lop->ten_lop }}</p>
                                                <a href="{{ route('giangvien.diemmonhoc.list', ['id' => $lhp->id]) }}"
                                                    class="btn  btn-sm">
                                                    Xem danh sách
                                                </a>
                                            </div>
                                        </div>
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
