@extends('client.layouts.app')

@section('title', 'Đăng Ký Xác Nhận Giấy Tờ')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/client/css/danhsachgiay.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/giayxacnhan.css') }}">
@endsection

@section('content')
    <div class="container-fluid ">
        <div class="row">
            <div class="card shadow-sm ">
                <div class="card-header d-flex align-items-center">
                    <a class="fs-3 btn" href="{{ route('sinhvien.giayxacnhan.index') }}">
                        ◀️
                    </a>
                    <h3 class="card-title mb-0">Danh sách giấy đã đăng ký</h3>
                </div>
                @foreach ($dsgiay as $item)
                    <div class="document-item" data-id="${doc.id}">
                        <div class="document-header">
                            <div class="document-icon"> {{ explode(' ', $item->loaiGiay->ten_giay)[0] }}</div>
                            <div class="document-info">
                                <div class="document-title">{{ $item->loaiGiay->ten_giay }}</div>
                                <div class="document-meta">
                                    <span>📅 Ngày đăng ký:
                                        {{ \Carbon\Carbon::parse($item->ngay_dang_ky)->format('d/m/Y') }}</span>
                                    <span>📅 Ngày nhận:
                                        {{ \Carbon\Carbon::parse($item->ngay_nhan)->format('d/m/Y') }}</span>
                                    <span>👤Phòng: Công Tác Chính Trị Học Sinh Sinh Viên(F7.5)</span>
                                </div>
                            </div>
                            <div class="status-badge {{ $item->trang_thai == 0 ? 'status-pending' : 'status-approved' }}">
                                {{ $item->trang_thai == 0 ? 'Chưa xử lý' : 'Đã Duyệt' }}
                            </div>

                        </div>
                    </div>
                @endforeach
                <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                    <div class="text-muted mb-2">
                        Hiển thị {{ $dsgiay->firstItem() }} đến {{ $dsgiay->lastItem() }} trong tổng
                        {{ $dsgiay->total() }}
                        dòng
                    </div>
                    <div class="pagination">
                        {{ $dsgiay->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
