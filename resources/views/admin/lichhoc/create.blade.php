@extends('admin.layouts.app')

@section('title', 'Quản lý lịch học của sinh viên')

@section('css')
    <style>
        .form-section {
            padding: 40px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .form-control,
        .form-select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e1e1e1;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus,
        .form-select:focus {
            outline: none;
            border-color: #4facfe;
            box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
        }

        .form-control:disabled,
        .form-select:disabled {
            background-color: #f8f9fa;
            color: #6c757d;
            cursor: not-allowed;
        }

        .btn-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/lich.css') }}">

@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm teams-section">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">📅 Tạo thời khóa biểu</h3>
                        <a href="{{ route('giangvien.lichhoc.index') }}" class="btn btn-primary">Quay lại</a>
                    </div>
                    <div class="card-body">
                        <div class="form-info">
                            <h4>Thông tin chung</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Lớp</label>
                                        <input value="{{ $lop->ten_lop }}" name="lop" type="text"
                                            class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Học kỳ</label>
                                        <select class="form-select" id="hoc-ky">
                                            @foreach ($dsHocKy as $hk)
                                                <option value="{{ $hk->id }}">{{ $hk->ten_hoc_ky }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('giangvien.lichhoc.store') }}" id="phieu-len-lop-form"
                            data-confirm>
                            @csrf
                            <!-- Học phần -->
                            <div class="row">
                                <input type="hidden" name="hoc_ky" value="{{ $hocKy->id }}">
                                <input type="hidden" name="lop_id" value="{{ $lop->id }}">
                                <div class="col-md-12">
                                    <label for="mon_hoc" class="form-label">Chọn môn</label>
                                    <select id="mon_hoc" name="mon_hoc" class="form-control">
                                        <option value="">-- Chọn môn -- </option>
                                        @foreach ($monHoc as $mh)
                                            <option value="{{ $mh->id }}">
                                                {{ $mh->ten_mon }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <div id="sinhvien-details-container" class="mt-3"></div>
                                </div>
                                <!-- Tiết học -->
                                <div class="col-md-4 mb-3">
                                    <label for="buoi" class="form-label">Chọn buổi</label>
                                    <select id="buoi" name="buoi" class="form-select">
                                        <option value="">-- Chọn buổi --</option>
                                        <option value="sang">Sáng (Tiết 1-6)</option>
                                        <option value="chieu">Chiều (Tiết 7-12)</option>
                                        <option value="toi">Tối (Tiết 13-15)</option>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="tiet_bat_dau" class="form-label">Tiết bắt đầu</label>
                                    <select id="tiet_bat_dau" name="tiet_bat_dau" class="form-select" disabled>
                                        <option value="">-- Chọn tiết bắt đầu --</option>
                                        @error('tiet_bat_dau')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="so_tiet" class="form-label">Số tiết</label>
                                    <select id="so_tiet" name="so_tiet" class="form-select" disabled>
                                        <option value="">-- Chọn số tiết --</option>
                                    </select>
                                    @error('so_tiet')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Phòng học -->
                                <div class="mb-3 col-md-4">
                                    <label for="id_phong" class="form-label">Phòng học</label>
                                    <select id="id_phong" name="id_phong" class="form-select">
                                        @foreach ($phong as $p)
                                            <option value="{{ $p->id }}">{{ $p->ten }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="id_tuan" class="form-label">Tuần:</label>
                                    <select class="form-select" name="id_tuan">
                                        @if ($tuanDangChon)
                                            @foreach ($dsTuan as $tuan)
                                                <option value="{{ $tuan->id }}"
                                                    {{ $tuanDangChon->id == $tuan->id ? 'selected' : '' }}>
                                                    Tuần {{ $tuan->tuan }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <!-- Thứ trong tuần -->
                                <div class="col-md-4 mb-3">
                                    <label for="thu" class="form-label">📆 Thứ trong tuần</label>
                                    <select id="thu" name="thu" class="form-select">
                                        <option value="">-- Chọn thứ --</option>
                                        <option value="2">Thứ 2</option>
                                        <option value="3">Thứ 3</option>
                                        <option value="4">Thứ 4</option>
                                        <option value="5">Thứ 5</option>
                                        <option value="6">Thứ 6</option>
                                        <option value="7">Thứ 7</option>
                                    </select>
                                </div>

                                <div class="text-end">
                                    <button style=" padding: 12px 24px;" type="submit" class="btn btn-success">➕
                                        Thêm vào TKB
                                    </button>
                                </div>
                        </form>
                    </div>
                    <button id="load-list" class="btn btn-info">Xem trước</button>
                </div>

                <div id="list-container" style="display: none; margin-top: 20px;">

                    <livewire:lich-hoc.lich-hoc :lop="$lop" />

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('assets/admin/js/lich.js') }}"></script>

    <script>
        $(document).ready(function() {
            console.log('jQuery:', $.fn.jquery);
            console.log('Select2 exists:', typeof $.fn.select2);

            $('#id_lop_hoc_phan').select2({
                placeholder: "Chọn môn"
            });
        });

        document.getElementById('load-list').addEventListener('click', function() {
            document.getElementById('list-container').style.display = 'block';
        });
    </script>
@endsection
