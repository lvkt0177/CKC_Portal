@extends('admin.layouts.app')

@section('title', 'Trang hồ sơ')

@php
    $gioiTinh = (int) auth()->user()->hoSo->gioi_tinh;

    $cccd = auth()->user()->hoSo->cccd;
    $maskedCccd = substr($cccd, 0, 6) . str_repeat('*', strlen($cccd) - 6);
@endphp

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-12 col-xl-12">
            <div class="card shadow-lg border-0" style="border-radius: 20px; overflow: hidden;">
                <!-- Header với gradient -->
                <div style="background: linear-gradient(135deg, #366bd6 0%, #6ea8fe 50%, #d5e6ff 100%); height: 100px;">
                </div>


                <div class="card-body p-4 position-relative" style="margin-top: -10px;">
                    <!-- Profile Header -->
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div class="d-flex align-items-center">
                            <div class="position-relative">
                                <img src="{{ asset('' . auth()->user()->hoSo->anh) }}" alt="Profile"
                                    class="rounded-circle border border-3 border-white shadow-sm"
                                    style="width: 80px; height: 80px; object-fit: cover;">
                            </div>
                            <div class="mx-4">
                                <h4 class="mb-1 fw-bold text-dark">{{ auth()->user()->hoSo->ho_ten }}</h4>
                                <p class="text-muted mb-0 text-uppercase" style="font-size: 16px;">
                                    {{ auth()->user()->getRoleNames()->first() ?? 'Người dùng' }}
                                </p>
                            </div>
                        </div>
                        {{-- <button class="btn btn-primary px-4 py-2" style="border-radius: 25px; font-weight: 500;">
                                Edit
                            </button> --}}
                    </div>

                    <div class="row g-3">
                        <!-- Full Name -->
                        <div class="col-md-6 my-3">
                            <label class="form-label text-dark fw-medium mb-2">Họ tên</label>
                            <input type="text" class="form-control border-0 bg-light"
                                value="{{ auth()->user()->hoSo->ho_ten }}"
                                style="padding: 12px 16px; border-radius: 12px; color: black" disabled>
                        </div>

                        <!-- Nick Name -->
                        <div class="col-md-6 my-3">
                            <label class="form-label text-dark fw-medium mb-2">Email</label>
                            <input type="text" class="form-control border-0 bg-light"
                                value="{{ auth()->user()->hoSo->email }}"
                                style="padding: 12px 16px; border-radius: 12px; color: black" disabled>
                        </div>

                        <div class="col-md-6 my-3">
                            <label class="form-label text-dark fw-medium mb-2">Số điện thoại</label>
                            <input type="text" class="form-control border-0 bg-light"
                                value="{{ auth()->user()->hoSo->so_dien_thoai }}"
                                style="padding: 12px 16px; border-radius: 12px; color: black" disabled>
                        </div>

                        <div class="col-md-6 my-3">
                            <label class="form-label text-dark fw-medium mb-2">Ngày sinh</label>
                            <input type="date" class="form-control border-0 bg-light"
                                value="{{ auth()->user()->hoSo->ngay_sinh }}"
                                style="padding: 12px 16px; border-radius: 12px; color: black" disabled>
                        </div>

                        <div class="col-md-6 my-3">
                            <label class="form-label text-dark fw-medium mb-2">Giới tính</label>
                            <input type="text" class="form-control border-0 bg-light"
                                style="padding: 12px 16px; border-radius: 12px; color: black"
                                value="@switch($gioiTinh)
                                                @case(0) Nam @break
                                                @case(1) Nữ @break
                                                @case(2) Khác @break
                                                @default Chưa xác định
                                            @endswitch"
                                disabled>
                        </div>

                        <div class="col-md-6 my-3">
                            <label class="form-label text-dark fw-medium mb-2">CCCD</label>
                            <input type="text" class="form-control border-0 bg-light" value="{{ $maskedCccd }}"
                                style="padding: 12px 16px; border-radius: 12px; color: black" disabled>
                        </div>

                        <div class="col-md-6 my-3">
                            <label class="form-label text-dark fw-medium mb-2">Địa chỉ</label>
                            <input type="text" class="form-control border-0 bg-light"
                                value="{{ auth()->user()->hoSo->dia_chi }}"
                                style="padding: 12px 16px; border-radius: 12px; color: black" disabled>
                        </div>


                    </div>


                </div>
            </div>
        </div>

    @endsection
