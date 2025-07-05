@extends('admin.layouts.app')

@section('title', 'Tạo thông báo')

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
                        <h3 class="card-title mb-0">Tạo thông báo</h3>
                        <a href="{{ route('giangvien.thongbao.index') }}" class="btn btn-back btn-sm">Quay lại</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('giangvien.thongbao.store') }}" method="POST" data-confirm enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="tieu_de" class="form-label">Tiêu đề</label>
                                    <input type="text"
                                        class="form-control @error('tieu_de') is-invalid border-danger text-dark @enderror"
                                        id="tieu_de" name="tieu_de"  placeholder="Nhập tiêu đề biên bản..."
                                        value="{{ old('tieu_de') }}">
                                    @error('tieu_de')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Giảng viên</label>
                                    <input type="text" class="form-control" name="gvcn"
                                        value="{{ auth()->user()->hoSo->ho_ten }}" readonly>
                                </div>

                                <div class="col-md-4">
                                    <label for="ngay_gui" class="form-label">Ngày gửi</label>
                                    <input type="datetime-local"
                                        class="form-control @error('ngay_gui') is-invalid border-danger text-dark @enderror"
                                        id="ngay_gui" name="ngay_gui"
                                        value="{{ now()->format('Y-m-d\TH:i') }}"
                                        readonly>
                                </div>

                                <div class="col-md-4">
                                    <label for="tu_ai" class="form-label">Từ ai</label>
                                    <select name="tu_ai" id="tu_ai" class="form-control @error('tu_ai') is-invalid border-danger text-dark @enderror" >
                                        <option class="" value="{{ auth()->user()->roles[0]->name }}"> {{ auth()->user()->roles[0]->name }}</option>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <label for="file" class="form-label">File đính kèm</label>
                                    <input type="file" class="form-control" name="files[]" accept=".doc,.docx,.xls,.xlsx,.pdf" multiple>
                                    @error('files')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="noi_dung" class="form-label">Nội dung</label>
                                    <textarea id="noi_dung" name="noi_dung" class="form-control @error('noi_dung') is-invalid border-danger text-dark @enderror">{{ old('noi_dung') }}</textarea>
                                    @error('noi_dung')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4 d-flex">
                                <button type="submit" class="btn btn-add px-4">Tạo thông báo</button>
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
@endsection
