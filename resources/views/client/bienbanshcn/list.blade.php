@extends('client.layouts.app')

@section('title', 'Biên bản Sinh hoạt chủ nhiệm')

@section('css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="{{ asset('assets/client/css/report.css') }}">
    <style>
        .avatar-sm {
            width: 2.5rem;
            height: 2.5rem;
            font-size: 0.875rem;
        }

        .avatar-xs {
            width: 1.5rem;
            height: 1.5rem;
            font-size: 0.75rem;
        }

        .table> :not(caption)>*>* {
            padding: 1rem 0.75rem;
        }

        .table-hover>tbody>tr:hover>td {
            background-color: rgba(13, 110, 253, 0.05);
        }

        .card {
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(13, 110, 253, 0.3);
        }

        .table thead th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.875rem;
            letter-spacing: 0.5px;
        }

        @media (max-width: 768px) {
            .table-responsive {
                font-size: 0.875rem;
            }

            .avatar-sm {
                width: 2rem;
                height: 2rem;
                font-size: 0.75rem;
            }

            .table> :not(caption)>*>* {
                padding: 0.75rem 0.5rem;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="report-header">
            <h4 class="mb-1">Thư ký quản lý Sinh hoạt chủ nhiệm</h4>
            <small class="opacity-75">Những thông tin mới nhất trong tuần</small>
        </div>
        <div class="text-end report-header my-1">
            <a href="{{ route('sinhvien.bienbanshcn.create', $lop  ) }}" class="btn btn-outline-success" title="Tạo biên bản"><i class="fa fa-plus" aria-hidden="true"></i></a>
            <a href="{{ route('sinhvien.bienbanshcn.index') }}" class="btn btn-dark" title="Quay lai">Quay lại</a>
        </div>

        <!-- Table Section -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col" class="border-0 ps-4">
                                            <i class="fas fa-file-alt me-2"></i>Tiêu đề
                                        </th>
                                        <th scope="col" class="border-0">
                                            <i class="fas fa-user-tie me-2"></i>Giáo viên chủ nhiệm
                                        </th>
                                        <th scope="col" class="border-0">
                                            <i class="fas fa-clock me-2"></i>Thời gian
                                        </th>
                                        <th scope="col" class="border-0">
                                            <i class="fas fa-inbox me-2"></i>Trạng thái
                                        </th>
                                        <th scope="col" class="border-0 text-center">
                                            <i class="fas fa-cog me-2"></i>Thao tác
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($bienBanSHCN as $index => $bienBan)
                                        <tr class="align-middle">
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div
                                                            class="avatar-sm bg-primary bg-gradient rounded-circle d-flex align-items-center justify-content-center">
                                                            <i class="fas fa-envelope text-white"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-0 text-dark">{{ $bienBan->tieu_de }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-2">
                                                        <div
                                                            class="avatar-xs bg-success bg-gradient rounded-circle d-flex align-items-center justify-content-center">
                                                            <i class="fas fa-user text-white"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <span class="fw-semibold text-dark">{{ $bienBan->gvcn->hoSo->ho_ten }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-muted">
                                                    <div class="fw-semibold">
                                                        {{ $bienBan->created_at->format('d/m/Y') }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-muted">
                                                    <div class="fw-semibold">
                                                        <span class="badge bg-{{ $bienBan->trang_thai->getBadge() }}">{{ $bienBan->trang_thai->getLabel() }}</div></span>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('sinhvien.bienbanshcn.show', $bienBan->id) }}"
                                                    class="btn btn-outline-primary btn-sm" target="_blank"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Xem chi tiết"><i class="fas fa-eye"></i></a>
                                                @if($bienBan->trang_thai->getLabel() == 'Chưa gửi')
                                                <a href="{{ route('sinhvien.bienbanshcn.edit', $bienBan->id) }}"
                                                    class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Sửa"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-5">
                                                <div class="text-muted">
                                                    <i class="fas fa-inbox fa-3x mb-3 opacity-50"></i>
                                                    <h5 class="text-muted">Không có biên bản nào</h5>
                                                    <p class="mb-0">Chưa có biên bản sinh hoạt chủ nhiệm nào được tạo.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endsection
