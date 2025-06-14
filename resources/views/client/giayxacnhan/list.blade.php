@extends('client.layouts.app')

@section('title', 'Đăng Ký Xác Nhận Giấy Tờ')

@section('css')
    <style>
        .pagination .small.text-muted {
            display: none !important;
        }
    </style>
    <style>
        .document-item {
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 15px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .document-item:hover {
            border-color: #3b82f6;
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.1);
            transform: translateY(-2px);
        }

        .document-header {
            display: grid;
            grid-template-columns: auto 1fr auto auto;
            gap: 20px;
            padding: 25px;
            align-items: center;
        }

        .document-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #3b82f6, #1e40af);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
        }

        .document-info {
            flex: 1;
        }

        .document-title {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .document-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            font-size: 14px;
            color: #64748b;
        }

        .document-meta span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-approved {
            background: #d1fae5;
            color: #065f46;
        }

        .status-rejected {
            background: #fee2e2;
            color: #dc2626;
        }

        .document-actions {
            display: flex;
            gap: 10px;
        }

        .action-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .btn-view {
            background: #e0e7ff;
            color: #3730a3;
        }

        .btn-download {
            background: #dcfce7;
            color: #166534;
        }

        .btn-cancel {
            background: #fee2e2;
            color: #dc2626;
        }

        .action-btn:hover {
            transform: translateY(-1px);
            opacity: 0.8;
        }

        .document-details {
            padding: 0 25px 25px;
            border-top: 1px solid #f1f5f9;
            background: #f8fafc;
            display: none;
        }

        .document-details.show {
            display: block;
            animation: slideDown 0.3s ease;
        }
    </style>
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
                                    <span>👤Phòng Công Tác Chính Trị Học Sinh Sinh Viên</span>
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
                        Hiển thị {{ $dsgiay->firstItem() }} đến {{ $dsgiay->lastItem() }} trong tổng {{ $dsgiay->total() }}
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
