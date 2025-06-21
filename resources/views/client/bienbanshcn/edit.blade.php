@extends('client.layouts.app')

@section('title', 'Tạo biên bản mới')

@section('css')
    <style>
        .ck-editor__editable_inline {
            min-height: 400px;
            font-size: 16px;
            line-height: 1.5;
        }
    </style>


@endsection

@php
    use Carbon\Carbon;
    $today = Carbon::today();
@endphp

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Chỉnh sửa biên bản sinh hoạt chủ nhiệm - Lớp
                            {{ $thongTin->lop->ten_lop }}</h3>
                        <a href="{{ route('sinhvien.bienbanshcn.index', $thongTin->id_lop) }}" class="btn btn-primary btn-sm">Quay lại</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('sinhvien.bienbanshcn.update', $thongTin) }}" method="POST" data-confirm
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="tieu_de" class="form-label">Tiêu đề</label>
                                    <input type="text"
                                        class="form-control @error('tieu_de') is-invalid border-danger text-dark @enderror"
                                        id="tieu_de" name="tieu_de" required placeholder="Nhập tiêu đề biên bản..."
                                        value="Biên Bản Sinh Hoạt Chủ Nhiệm" readonly>
                                    @error('tieu_de')
                                        <div class="text-danger">Tieu de bi loi: {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="id_lop" class="form-label">Lớp</label>
                                    <input type="text" class="form-control" id="id_lop" name="id_lop"
                                        value="{{ $thongTin->lop->ten_lop }}" readonly>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Giáo viên chủ nhiệm</label>
                                    <input type="text" class="form-control" name="gvcn"
                                        value="{{ $thongTin->lop->giangVien->hoSo->ho_ten }}" readonly>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Thư ký đại diện</label>

                                    <select name="id_sv" id="id_sv"
                                        class="form-control @error('id_sv') is-invalid border-danger text-dark @enderror">
                                        @foreach ($thuKy as $tk)
                                            <option value="{{ $tk->id }}"
                                                {{ old('id_sv') == $tk->id ? 'selected' : '' }}
                                                {{ $thongTin->id_sv == $tk->id ? 'selected' : '' }}>
                                                {{ $tk->hoSo->ho_ten }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="id_tuan" class="form-label">Tuần</label>

                                    <select name="id_tuan" id="id_tuan"
                                        class="form-control @error('id_tuan') is-invalid border-danger text-dark @enderror"
                                        style="pointer-events: none;">
                                        <option value="">-- Chọn tuần --</option>
                                        @foreach ($tuans as $tuan)
                                            @php
                                                $start = Carbon::parse($tuan->ngay_bat_dau);
                                                $end = Carbon::parse($tuan->ngay_ket_thuc);
                                                $isCurrentWeek = $today->between($start, $end);
                                            @endphp
                                            <option value="{{ $tuan->id }}"
                                                {{ $isCurrentWeek || old('id_tuan') == $tuan->id ? 'selected' : '' }}>
                                                Tuần {{ $tuan->tuan }} ({{ $tuan->ngay_bat_dau->format('d/m/Y') }} - {{
                                                    $tuan->ngay_ket_thuc->format('d/m/Y') }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_tuan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="thoi_gian_bat_dau" class="form-label">Thời gian bắt đầu</label>
                                    <input type="datetime-local"
                                        class="form-control @error('thoi_gian_bat_dau') is-invalid border-danger text-dark @enderror"
                                        id="thoi_gian_bat_dau" name="thoi_gian_bat_dau"
                                        value="{{ old('thoi_gian_bat_dau', $thongTin->thoi_gian_bat_dau) }}">
                                </div>

                                <div class="col-md-4">
                                    <label for="thoi_gian_ket_thuc" class="form-label">Thời gian kết thúc</label>
                                    <input type="datetime-local"
                                        class="form-control @error('thoi_gian_ket_thuc') is-invalid border-danger text-dark @enderror"
                                        id="thoi_gian_ket_thuc" name="thoi_gian_ket_thuc"
                                        value="{{ old('thoi_gian_ket_thuc', $thongTin->thoi_gian_ket_thuc) }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="so_luong_sinh_vien" class="form-label">Số lượng sinh viên</label>
                                    <input type="number"
                                        class="form-control @error('so_luong_sinh_vien') is-invalid border-danger text-dark @enderror"
                                        id="so_luong_sinh_vien" name="so_luong_sinh_vien" min="0"
                                        value="{{ $thongTin->lop->sinhViens->count() }}" readonly>
                                </div>

                                <div class="col-md-6">
                                    <label for="vang_mat" class="form-label">Số lượng sinh viên vắng mặt</label>
                                    <input type="number"
                                        class="form-control @error('vang_mat') is-invalid border-danger text-dark @enderror"
                                        id="vang_mat" name="vang_mat" min="0" value="{{ old('vang_mat', $thongTin->vang_mat) }}" readonly>
                                </div>

                                {{-- Sinh viên vắng mặt --}}

                                <div class="col-md-12">
                                    @php
                                        $sinhVienVang = $thongTin->chiTietBienBanSHCN->pluck('id_sinh_vien')->toArray();
                                    @endphp
                                    <label for="sinhvien-select" class="form-label">Chọn sinh viên vắng mặt</label>
                                    <select id="sinhvien-select" class="form-control" multiple>
                                        @foreach ($thongTin->lop->sinhViens as $sv)
                                            <option value="{{ $sv->id }}"
                                                data-name="{{ $sv->ma_sv }} - {{ $sv->hoSo->ho_ten }}"
                                                {{ in_array($sv->id, $sinhVienVang) ? 'selected' : '' }}>
                                                {{ $sv->ma_sv }} - {{ $sv->hoSo->ho_ten }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                    <div id="sinhvien-details-container" class="mt-3">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="noi_dung" class="form-label">Nội dung</label>
                                    <textarea id="noi_dung" name="noi_dung" class="form-control">{{ old('noi_dung', $thongTin->noi_dung) }}</textarea>
                                </div>
                            </div>

                            <div class="mt-4 d-flex justify-content-between">
                                <button type="submit" class="btn btn-success px-4">Lưu biên bản</button>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        const oldValues = @json($thongTin->chiTietBienBanSHCN->keyBy('id_sinh_vien')->toArray() ?? old('sinh_vien_vang', []));
    </script>

    <script>
        $(document).ready(function() {
            const $select = $('#sinhvien-select');
            const $container = $('#sinhvien-details-container');
            let currentSelected = [];

            let isFormChanged = false;

            $('form').on('change input', function() {
                isFormChanged = true;
            });

            window.addEventListener('beforeunload', function(e) {
                if (isFormChanged) {
                    e.preventDefault();
                    e.returnValue = '';
                }
            });

            $('form').on('submit', function() {
                isFormChanged = false;
            });

            $select.select2({
                placeholder: "Tìm và chọn sinh viên",
                width: '100%'
            });

            $select.on('change', function () {
            let selectedCount = $(this).val().length;
            $('#vang_mat').val(selectedCount);
            });

            function renderSinhVien(id, name) {
                const lyDo = oldValues?.[id]?.ly_do || '';
                const loai = oldValues?.[id]?.loai || '';
                const chiTietId = oldValues?.[id]?.id;
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const deleteUrl = `/sinhvien/bienbanshcn/sinhvienvang/${chiTietId}`;

                const deleteForm = chiTietId ?
                    `
                    <button type="button" class="btn btn-danger btn-sm btn-delete-sinhvien" 
                        data-id="${id}" 
                        data-url="${deleteUrl}">
                        <i class="fas fa-trash-alt"></i>
                    </button>` :
                    '';

                const html = `
                    <div class="sinhvien-item row mb-3" id="sinhvien-${id}">
                        <hr class="w-100">

                        <!-- Thông tin sinh viên -->
                        <div class="col-md-2">
                            <input type="hidden" name="sinh_vien_vang[${id}][id]" value="${id}">
                            <label>Thông tin sinh viên</label>
                            <input type="text" value="${name}" class="form-control mb-2" readonly>
                        </div>

                        <!-- Lý do vắng -->
                        <div class="col-md-8">
                            <label>Lý do:</label>
                            <input type="text" name="sinh_vien_vang[${id}][ly_do]" value="${lyDo}" class="form-control mb-2" required>
                        </div>

                        <!-- Loại và nút xoá -->
                        <div class="col-md-2">
                            <div class="w-100 d-flex">
                                <!-- Loại -->
                                <div class="flex-grow-1 me-2">
                                    <label>Loại:</label>
                                    <select name="sinh_vien_vang[${id}][loai]" class="form-control" required>
                                        <option value="1" ${loai == 1 ? 'selected' : ''}>Có phép</option>
                                        <option value="0" ${loai == 0 ? 'selected' : ''}>Không phép</option>
                                    </select>
                                </div>

                                <!-- Nút xóa -->
                                <div class="d-flex align-items-end">
                                   ${deleteForm}
                                </div>
                            </div>
                        </div>
                    </div>

                `;
                $container.append(html);
            }

            $container.on('click', '.btn-delete-sinhvien', function() {

                const button = $(this);
                const id = button.data('id');
                const url = button.data('url');
                const csrfToken = $('meta[name="csrf-token"]').attr('content');

                if (confirm("Dữ liệu hiện tại sẽ bị thay đổi. Bạn có chắc chắn muốn xoá sinh viên này không?")) {
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: {
                            _token: csrfToken,
                            _method: 'DELETE'
                        },
                        success: function() {
                            alert('Xoá thành công');
                            $(`#sinhvien-${id}`).remove();
                            $(`#sinhvien-select option[value="${id}"]`).prop('selected', false)
                                .trigger('change');
                            delete oldValues[id];
                        },
                        error: function() {
                            alert(
                                'Xoá thất bại. Sinh viên này chưa được lưu trong biên bản Sinh Hoạt Chủ Nhiệm');
                        }
                    });
                }
            });

            const initial = $select.val() || [];
            initial.forEach(id => {
                const name = $select.find(`option[value="${id}"]`).data('name');
                renderSinhVien(id, name);
            });
            currentSelected = initial;

            $select.on('change', function() {
                const selected = $(this).val() || [];

                selected.forEach(id => {
                    if (!currentSelected.includes(id)) {
                        const name = $select.find(`option[value="${id}"]`).data('name');
                        renderSinhVien(id, name);
                    }
                });

                currentSelected.forEach(id => {
                    if (!selected.includes(id)) {
                        $('#sinhvien-' + id).remove();
                    }
                });

                currentSelected = selected;
            });
        });
    </script>

    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#noi_dung'), {
                language: 'vi',
                ckfinder: {
                    uploadUrl: '{{ route('ckeditor.upload') }}?&_token={{ csrf_token() }}'
                },
                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'bold', 'italic', 'underline', 'strikethrough', 'removeFormat',
                        '|',
                        'link', 'bulletedList', 'numberedList', 'todoList',
                        '|',
                        'outdent', 'indent',
                        '|',
                        'imageUpload', 'blockQuote', 'insertTable', 'mediaEmbed',
                        '|',
                        'undo', 'redo'
                    ]
                },
                image: {
                    toolbar: [
                        'imageTextAlternative',
                        'imageStyle:full',
                        'imageStyle:side'
                    ]
                },
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells'
                    ]
                }
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(error => {
                console.error(error);
            });
    </script>


@endsection
