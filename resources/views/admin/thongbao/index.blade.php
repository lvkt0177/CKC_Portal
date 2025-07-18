@extends('admin.layouts.app')

@section('title', 'Thông báo cho sinh viên')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .lop-gui-toi {
            max-width: 450px;     
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm teams-section">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0"> Quản lý thông báo </h3>
                        <a href="{{ route('giangvien.thongbao.create') }}" class="btn btn-add">Thêm thông báo</a>
                    </div>

                    <div class="teams-section">
                        <table class="team-table align-middle" id="room-table">
                            <thead>
                                <tr class="text-center">
                                    <th>No.1</th>
                                    <th>Tiêu đề</th>
                                    <th>Người gửi</th>
                                    <th>Từ ai</th>
                                    <th>Ngày gửi</th>
                                    <th>Gửi tới lớp</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($thongBaos as $thongbao)
                                    <tr class="text-center">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $thongbao->tieu_de }}</td>
                                        <td>{{ $thongbao->giangVien->hoSo->ho_ten }}</td>
                                        <td>{{ $thongbao->tu_ai }}</td>
                                        <td>{{ $thongbao->ngay_gui->format('d/m/Y') }}</td>
                                        <td class="d-flex justify-content-center">
                                            @if($thongbao->tu_ai === 'Giáo viên bộ môn')
                                                <p>Gửi tới lớp học phần</p>
                                            @else
                                            <div class="lop-gui-toi" title="{{ $thongbao->ds_lops->pluck('ten_lop')->join(', ') }}">
                                                @foreach ($thongbao->ds_lops as $lop)
                                                    <span class="badge bg-info text-dark my-1">{{ $lop->ten_lop }}</span>
                                                @endforeach
                                            </div>
                                            @endif
                                        </td>
                                        <td><span
                                                class="badge bg-{{ $thongbao->trang_thai->getBadge() }}">{{ $thongbao->trang_thai->getLabel() }}</span>
                                        </td>
                                        <td class="d-flex justify-content-center">
                                            @if($thongbao->tu_ai !== 'Giáo viên bộ môn')
                                                <button type="button" class="btn btn-success mx-1" data-bs-toggle="modal"
                                                    data-bs-target="#modalChonLop{{ $thongbao->id }}">
                                                    <i class="fa-solid fa-paper-plane"></i>
                                                </button>
                                            @endif

                                            <div class="text-start">
                                                <div class="modal fade" id="modalChonLop{{ $thongbao->id }}" tabindex="-1"
                                                    aria-labelledby="modalChonLopLabel{{ $thongbao->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="modalChonLopLabel{{ $thongbao->id }}">
                                                                    Chọn lớp để gửi thông báo - {{ $thongbao->tieu_de }}
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Đóng"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('giangvien.thongbao.send-to-student', $thongbao) }}"
                                                                    method="POST" data-confirm>
                                                                    @csrf
                                                                    <div class="mb-3">
                                                                        <label for="selectLop{{ $thongbao->id }}"
                                                                            class="form-label">Chọn lớp</label>
                                                                        <select class="form-select js-select2"
                                                                            name="lop_ids[]"
                                                                            id="selectLop{{ $thongbao->id }}" multiple required>
                                                                            @foreach ($lops as $lop)
                                                                                <option value="{{ $lop->id }}">
                                                                                    {{ $lop->ten_lop }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="d-flex gap-2 mb-2">
                                                                        <button type="button" class="btn btn-sm btn-success btn-select-all" data-target="#selectLop{{ $thongbao->id }}">Chọn tất cả</button>
                                                                        <button type="button" class="btn btn-sm btn-secondary btn-deselect-all" data-target="#selectLop{{ $thongbao->id }}">Bỏ chọn tất cả</button>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Hủy</button>
                                                                        <button type="submit"
                                                                            class="btn btn-add">Gửi</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <a href="{{ route('giangvien.thongbao.show', $thongbao) }}"
                                                class="btn btn-dark btn-sm">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>

                                            @if ($thongbao->trang_thai->value == 0)
                                                <a href="{{ route('giangvien.thongbao.edit', $thongbao) }}"
                                                    class="btn btn-warning btn-sm mx-1">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>
                                                <form action="{{ route('giangvien.thongbao.destroy', $thongbao) }}"
                                                    method="POST" class="" data-confirm>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')
    <!-- jQuery -->

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.modal').on('shown.bs.modal', function () {
                $(this).find('.js-select2').select2({
                    dropdownParent: $(this)
                });
            });
        });

        $(document).ready(function () {
        $('.js-select2').select2({
            placeholder: 'Chọn lớp',
            allowClear: true,
            theme: 'bootstrap-5',
            width: '100%'
        });

        $('.btn-select-all').click(function () {
            const target = $(this).data('target');
            const $select = $(target);
            $select.find('option').prop('selected', true);
            $select.trigger('change');
        });

        $('.btn-deselect-all').click(function () {
            const target = $(this).data('target');
            const $select = $(target);
            $select.val(null).trigger('change');
        });
    });

    </script>


    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#room-table').DataTable({
                responsive: true,
                ordering: false,
                language: {
                    search: "Tìm kiếm:",
                    lengthMenu: "Hiển thị _MENU_ dòng",
                    info: "Hiển thị _START_ đến _END_ trong _TOTAL_ dòng",
                    paginate: {
                        previous: '<i class="fa-solid fa-arrow-left"></i>',
                        next: '<i class="fa-solid fa-arrow-right"></i>'
                    }
                },
                dom: '<"top"lf>rt<"bottom"ip><"clear">'
            });
        });

        $('#room-table').on('error.dt', function(e, settings, techNote, message) {
            console.error('DataTables Lỗi:', message);
            alert('Đã có lỗi khi tải bảng: ' + message);
        });
    </script>
@endsection
