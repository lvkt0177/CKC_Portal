@extends('admin.layouts.app')

@section('title', 'Công tác giảng dạy')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/lich.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="container-fluid teams-section">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-primary">
                            <i class="fas fa-calendar-alt me-2"></i>
                            Sổ lên lớp
                        </h4>
                        <a href="{{ route('giangvien.phieulenlop.index') }}" class="btn btn-back">Quay lại</a>
                    </div>

                    <div class="card-body">
                        <form id="phieu-len-lop-form" method="POST" action="{{ route('giangvien.phieulenlop.store') }}"
                            data-confirm>
                            @csrf

                            <!-- Học phần -->
                            <div class="row">
                                <div class=" col-6">
                                    <label for="id_lop_hoc_phan" class="form-label">Chọn lớp học phần</label>
                                    <select id="id_lop_hoc_phan" name="id_lop_hoc_phan" class="form-control">
                                        <option value="">-- Chọn Lớp học phần -- </option>
                                        @foreach ($lopHocPhan as $lhp)
                                            <option value="{{ $lhp->id }}">{{ $lhp->ten_hoc_phan }}
                                                {{ $lhp->lop->ten_lop }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_lop_hoc_phan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="col-6">
                                    <label for="hien_dien" class="form-label">Hiện diện</label>
                                    <input type="number" id="hien_dien" value="{{ old('hien_dien') }}" name="hien_dien"
                                        class="form-control">
                                    @error('hien_dien')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <!-- Nội dung -->
                            <div class="mb-3">
                                <label for="noi_dung" class="form-label">Nội dung buổi học</label>
                                <textarea id="noi_dung" name="noi_dung" rows="4" class="form-control"></textarea>
                                @error('noi_dung')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="text-end">
                                <button style=" padding: 12px 24px;" class="btn btn-edit">Lưu phiếu</button>
                            </div>
                        </form>
                    </div>

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
                placeholder: "Chọn lớp học phần"
            });

        });
    </script>


@endsection
