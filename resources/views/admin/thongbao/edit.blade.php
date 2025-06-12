@extends('admin.layouts.app')

@section('title', 'Chỉnh sửa thông báo')

@section('css')
    <style>
        .ck-editor__editable_inline {
            min-height: 400px;
            font-size: 16px;
            line-height: 1.5;
        }
    </style>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-10">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Chỉnh sửa thông báo</h3>
                        <a href="{{ route('admin.thongbao.index') }}" class="btn btn-back btn-sm">Quay lại</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.thongbao.update', $thongbao) }}" method="POST" data-confirm
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="tieu_de" class="form-label">Tiêu đề</label>
                                    <input type="text"
                                        class="form-control @error('tieu_de') is-invalid border-danger text-dark @enderror"
                                        id="tieu_de" name="tieu_de" placeholder="Nhập tiêu đề biên bản..."
                                        value="{{ old('tieu_de', $thongbao->tieu_de) }}">
                                    @error('tieu_de')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Giảng viên</label>
                                    <input type="text" class="form-control" name="gvcn"
                                        value="{{ $thongbao->giangvien->hoSo->ho_ten }}" readonly>
                                </div>

                                <div class="col-md-4">
                                    <label for="ngay_gui" class="form-label">Ngày gửi</label>
                                    <input type="datetime-local"
                                        class="form-control @error('ngay_gui') is-invalid border-danger text-dark @enderror"
                                        id="ngay_gui" name="ngay_gui" value="{{ now()->format('Y-m-d\TH:i') }}" readonly>
                                </div>

                                <div class="col-md-4">
                                    <label for="tu_ai" class="form-label">Từ ai</label>
                                    
                                    <select name="tu_ai" id="tu_ai" class="form-control @error('tu_ai') is-invalid border-danger text-dark @enderror">
                                        @foreach ($capTren as $cap)
                                            <option value="{{ $cap->value }}"
                                                {{ old('tu_ai', $thongbao->tu_ai?->value) == $cap->value ? 'selected' : '' }}>
                                                {{ $cap->getLabel() }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <label for="file" class="form-label">File đính kèm (PDF, Word, Excel)</label>
                                    <input type="file" class="form-control" name="files[]"
                                        accept=".doc,.docx,.xls,.xlsx,.pdf" id="file" multiple>
                                    @error('files')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    @if (isset($thongbao) && $thongbao->file)
                                        <ul class="list-unstyled" id="file-list">
                                            @foreach ($thongbao->file as $file)
                                                <li class="d-flex justify-content-between align-items-center mb-2 file-item"
                                                    data-id="{{ $file->id }}">
                                                    <p class="mb-0">{{ $file->ten_file }}</p>
                                                    <button type="button" class="btn btn-sm btn-danger btn-delete-file"
                                                        data-id="{{ $file->id }}">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </button>
                                                </li>
                                                <hr>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>

                                <div class="col-12">
                                    <label for="noi_dung" class="form-label">Nội dung</label>
                                    <textarea id="noi_dung" name="noi_dung"
                                        class="form-control @error('noi_dung') is-invalid border-danger text-dark @enderror">{{ old('noi_dung', $thongbao->noi_dung) }}</textarea>
                                    @error('noi_dung')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4 d-flex">
                                <button type="submit" class="btn btn-add px-4">Chỉnh sửa thông báo</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <!-- Dùng CKEditor 5 bản Classic từ CDN -->
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

    <script>
        $(document).on('click', '.btn-delete-file', function() {
            const fileId = $(this).data('id');
            const $item = $(this).closest('.file-item');

            if (confirm('Dữ liệu sẽ không được khôi phục!. Bạn có chắc muốn xoá file này không?')) {
                $.ajax({
                    url: `/admin/thongbao/file/${fileId}`,
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        if (res.success) {
                            $item.next('hr').remove(); 
                            $item.remove();
                            alert(res.message);
                        } else {
                            alert('Lỗi khi xoá!');
                        }
                    },
                    error: function() {
                        alert('Không thể xoá file!');
                    }
                });
            }
        });
    </script>
    <script>
        document.getElementById('file').addEventListener('change', function(event) {
        const maxSize = 10 * 1024 * 1024; // 10MB
        const files = event.target.files;
        let errorFiles = [];

        for (let i = 0; i < files.length; i++) {
            if (files[i].size > maxSize) {
                errorFiles.push(files[i].name);
            }
        }

        if (errorFiles.length > 0) {
            alert("Các file sau vượt quá 10MB:\n" + errorFiles.join("\n"));
            event.target.value = "";
    });
    </script>
    
@endsection
