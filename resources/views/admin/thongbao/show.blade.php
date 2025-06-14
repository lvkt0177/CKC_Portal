@extends('admin.layouts.app')

@section('title', 'Thông báo cho sinh viên')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/thongbao.css') }}">
@endsection

@section('content')
    <div class="container">
        <!-- Cards Grid -->
        <div class="cards-grid">
            <!-- Additional Cards -->
            <div class="tech-card">
                <div class="card-3d-scene" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                    <div class="laptop-3d">
                        <div class="laptop-screen"></div>
                        <div class="laptop-base"></div>
                    </div>
                    <div class="floating-elements">
                        <i class="fas fa-brain floating-icon"></i>
                        <i class="fas fa-microchip floating-icon"></i>
                        <i class="fas fa-network-wired floating-icon"></i>
                    </div>
                </div>
                <div class="card-content">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('giangvien.thongbao.index') }}" class="btn btn-back">Quay lại</a>
                    </div>

                    <h2 class="card-title">{{ $thongbao->tieu_de }}</h2>
                    <p class="card-description">
                        {!! $thongbao->noi_dung !!}
                    </p>
                    @if ($thongbao->file && count($thongbao->file) > 0)
                        <div class="files">
                            <b>Files đính kèm:</b>
                            @foreach ($thongbao->file as $file)
                                <div class="">
                                    <a href="{{ route('giangvien.file.download', $file->id) }}">{{ $file->ten_file }}</a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="card-footer">
                        <span class="card-date">{{ $thongbao->ngay_gui }}</span>
                        <span class=""><b>Người gửi:</b> {{ $thongbao->giangVien->hoSo->ho_ten }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @livewire('binh-luan.comment-section', ['thongbao' => $thongbao])

    
@endsection

@section('js')
    
@endsection
