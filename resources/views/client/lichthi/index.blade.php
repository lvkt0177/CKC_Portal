@extends('client.layouts.app')

@section('title', 'Lịch thi')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/lich.css') }}">
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Lịch Thi</h3>
                    <a href="{{ route('sinhvien.lichthi.thilailanhai') }}" class="btn btn-primary">Đăng ký thi lại</a>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

@endsection
