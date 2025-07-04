@extends('client.layouts.app')

@section('title', 'Đăng ký thi lại')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/client/css/dangkythilai.css') }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Danh sách các môn đăng ký thi lại lần 2</h3>
                </div>
                <div class="card-body">
                    @foreach ($lichThi as $lt)
                    <div id="subjects-container">
                        <div class="subject-card fade-in mb-4" data-subject-id="{{ $lt->id }}">
                            <div class="row">
                                <div class="col-12 col-md-8 mb-3 mb-md-0">
                                    <div class="subject-name fw-bold fs-5">{{ $lt->lopHocPhan->ten_hoc_phan }}</div>
                    
                                    <div class="subject-info d-flex flex-column flex-md-row gap-2">
                                        <span>
                                            <i class="fas fa-user-tie me-2"></i>
                                            Giám thị 1: {{ $lt->giamThi1->hoSo->ho_ten }}
                                        </span>
                                        <span class="mx-3"></span>
                                        <span>
                                            <i class="fas fa-user-tie me-2"></i>
                                            Giám thị 2: {{ $lt->giamThi2->hoSo->ho_ten }}
                                        </span>
                                    </div>
                    
                                    <div class="subject-info d-flex flex-column flex-md-row gap-2 mt-2">
                                        <span class="me-3">
                                            <i class="fas fa-calendar me-2"></i>
                                            Ngày: {{ \Carbon\Carbon::parse($lt->ngay_thi)->translatedFormat('l') }},
                                            {{ \Carbon\Carbon::parse($lt->ngay_thi)->format('d-m-Y') }}
                                        </span>
                                        <span class="me-3">
                                            <i class="fas fa-clock me-2"></i>
                                            Giờ bắt đầu: {{ $lt->gio_bat_dau }}
                                        </span>
                                        <span class="me-3">
                                            <i class="fas fa-hourglass me-2"></i>
                                            Thời gian thi: {{ $lt->thoi_gian_thi }} phút
                                        </span>
                                        <span class="me-3">
                                            <i class="fas fa-door-open me-2"></i>
                                            Phòng: {{ $lt->phong->ten }}
                                        </span>
                                    </div>
                                </div>
                    
                                <div class="col-12 col-md-4 text-md-end d-flex align-items-start justify-content-md-end">
                                    @if($lt->lopHocPhan->danhSachHocPhan[0]->diem_thi_lan_1)
                                        @if($lt->lopHocPhan->dangKyHocGhepThiLai)
                                            <button class="btn btn-registered text-success" disabled>
                                                <i class="fas fa-check me-2"></i>Đã đăng ký
                                            </button>
                                        @else
                                            <form action="{{ route('vnpay.payment.thi-lai', $lt->lopHocPhan) }}" method="POST" class="w-100 w-md-auto">
                                                @csrf
                                                <button type="submit" class="btn btn-register">
                                                    <i class="fas fa-plus me-2"></i>Đăng ký
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

@endsection
