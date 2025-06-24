@extends('client.layouts.app')

@section('title', 'Biên bản Sinh hoạt chủ nhiệm')

@section('css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="{{ asset('assets/client/css/khungdaotao.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/report.css') }}">
@endsection

@section('content')
    
    <div class="report-container">
        <div class="report-header">
            <h4 class="mb-1">Biên bản Sinh hoạt chủ nhiệm</h4>
            <small class="opacity-75">Những thông tin mới nhất trong tuần</small>
        </div>
        @if ($thuKy)
            <div class="text-end report-header my-1">
                <a href="{{ route('sinhvien.bienbanshcn.list') }}" class="btn btn-primary">Quản lý Biên bản SHCN</a>
            </div>
        @endif
        
        @if($bienBanSHCN->count() > 0) 
            @foreach ($bienBanSHCN as $bienBan)
                <div class="report-item">
                    <div class="report-icon icon-message">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="report-content">
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <div class="report-title"><a class="report-title text-decoration-none" target="_blank" href="{{ route('sinhvien.bienbanshcn.show', $bienBan->id) }}">{{ $bienBan->tieu_de }}</a></div>
                        </div>
                        <div class="report-user"><b>Giáo viên chủ nhiệm:</b> {{ $bienBan->gvcn->hoSo->ho_ten }}</div>
                        <div class="report-user"><b>Thư ký:</b> {{ $bienBan->thuKy->hoSo->ho_ten }}</div>
                    </div>
                    <div class="report-time">
                        <i class="far fa-clock"></i>
                        {{ $bienBan->thoi_gian_bat_dau->format('H:i') }}, ngày {{ $bienBan->thoi_gian_bat_dau->format('d') }} tháng {{ $bienBan->thoi_gian_bat_dau->format('m') }} năm {{ $bienBan->thoi_gian_bat_dau->format('Y') }}
                    </div>
                    
                </div>
            @endforeach
        @else
            <div class="p-5">
                    <div class="d-flex justify-content-between align-items-start mb-1">
                        <div class="report-title">Không có biên bản sinh hoạt chủ nhiệm nào</div>
                    </div>
            </div>
        @endif
    </div>
    <div class="d-flex justify-content-center mt-3">
        {{ $bienBanSHCN->links('pagination::bootstrap-5') }}
    </div>
@endsection
