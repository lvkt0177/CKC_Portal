    <form method="GET" action="{{ route('giangvien.lichhoc.list', ['lop' => $lop]) }}" id="week-form">
        <div class="d-flex justify-content-end align-items-center">
            <div class="nav-buttons w-100 m-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="flex-shrink-0">
                        <label class="p-1">Tuần:</label>
                    </div>
                    <select class="form-control" name="id_tuan" onchange="form.submit()">
                        @if ($tuanDangChon)
                            @foreach ($dsTuan as $tuan)
                                <option value="{{ $tuan->id }}"
                                    {{ $tuanDangChon->id == $tuan->id ? 'selected' : '' }}>
                                    Tuần {{ $loop->index + 1 }}
                                    @php
                                        $tuanhientai = $tuanDangChon->id;
                                    @endphp
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="card-body d-flex justify-content-end ">

                    <button type="button" class="btn btn-sm btn-secondary"
                        style="border-top-right-radius: 0; border-bottom-right-radius: 0;background: #2c3e50;"
                        data-bs-toggle="modal" data-bs-target="#modalSaoChep">
                        <i class="bi bi-copy"></i> Sao chép tuần
                    </button>

                    <a href="{{ route('giangvien.lichhoc.create', ['lop' => $lop]) }}" title="Tạo thời khóa biểu mới"
                        class="btn btn-sm btn-primary"
                        style="border-top-left-radius: 0; border-bottom-left-radius: 0; white-space: nowrap; background: #2c3e50;">
                        <i class="bi bi-pencil-square"></i> Tạo lịch học
                    </a>

                </div>
            </div>
        </div>
        <input type="hidden" name="hoc_ky" value="{{ $hocKy->id }}">


    </form>
    <div class="container" style="max-width: 1500px;">
        <div class="schedule-table">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th class="time-column text-white" style="background: #2c3e50;">Ca
                            học</th>
                        @foreach ($ngayTrongTuan as $ngay)
                            <th class="day-header text-white" style="background: #2c3e50;">
                                {{ ucfirst($ngay->translatedFormat('l')) }}<br>
                                {{ $ngay->format('d/m/Y') }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <!-- Morning Session -->
                    <tr>
                        <td class="time-column">Sáng</td>
                        @foreach ($ngayTrongTuan as $ngay)
                            <td class="schedule-cell"
                                style="background-image: url('https://giaydantuongsacmau.com/upload/product/2020/12/10/giay-dan-tuong-soc-caro-image-20201210161206-350433-thumb.png');">
                                @php
                                    $daDung = [];
                                @endphp

                                @for ($so = 1; $so <= 6; $so++)
                                    @php $rendered = false; @endphp

                                    @foreach ($thoikhoabieu as $tkb)
                                        @php
                                            if (optional($lop->nienKhoas)->nam_bat_dau == now()->year) {
                                                dd($lop->nienKhoas->nam_bat_dau);
                                            }
                                            $bat_dau = $tkb->tiet_bat_dau;
                                            $ket_thuc = $tkb->tiet_ket_thuc;
                                            $so_tiet = $ket_thuc - $bat_dau + 1;
                                        @endphp

                                        @if ($tkb->ngay == $ngay->format('Y-m-d'))
                                            @if ($so == $bat_dau && !in_array($tkb->id, $daDung))
                                                <div class="class-card web-dev mb-2 border-left-{{ $tkb->lopHocPhan->loai_mon->getBadge() }}"
                                                    data-id="{{ $tkb->lopHocPhan->id }}" data-tkb="{{ $tkb->id }}"
                                                    data-subject="{{ $tkb->lopHocPhan->ten_hoc_phan }}"
                                                    data-class="{{ $tkb->lopHocPhan->lop->ten_lop }}"
                                                    data-period="{{ $tkb->tiet_bat_dau }}-{{ $tkb->tiet_ket_thuc }}"
                                                    data-room="{{ $tkb->phong->ten }}"
                                                    data-teacher="{{ $tkb->lopHocPhan->giangVien->hoSo->ho_ten ?? '' }}"
                                                    data-date="{{ \Carbon\Carbon::parse($tkb->ngay)->format('d/m/Y') }}"
                                                    data-day="{{ $tkb->ngay }}">
                                                    <div class="class-title">
                                                        {{ $tkb->lopHocPhan->ten_hoc_phan }}
                                                    </div>
                                                    <div class="class-details">

                                                        Lớp: {{ $tkb->lopHocPhan->lop->ten_lop }}<br>
                                                        Tiết:
                                                        {{ $tkb->tiet_bat_dau }}-{{ $tkb->tiet_ket_thuc }}<br>
                                                        Phòng: {{ $tkb->phong->ten }}<br>
                                                        GV:
                                                        {{ $tkb->lopHocPhan->giangVien->hoSo->ho_ten ?? '' }}<br>
                                                        Ngày:
                                                        {{ \Carbon\Carbon::parse($tkb->ngay)->format('d/m/Y') }}
                                                    </div>
                                                </div>
                                                @php
                                                    $rendered = true;
                                                    $daDung[] = $tkb->id;
                                                    break;
                                                @endphp
                                            @elseif ($so > $bat_dau && $so <= $ket_thuc)
                                                @php
                                                    $rendered = true;
                                                    break;
                                                @endphp
                                            @endif
                                        @endif
                                    @endforeach

                                    @if (!$rendered)
                                        <div class=""></div>
                                    @endif
                                @endfor
                            </td>
                        @endforeach
                    </tr>

                    {{--  Afternoon Session --}}
                    <tr>
                        <td class="time-column">Chiều</td>
                        @foreach ($ngayTrongTuan as $ngay)
                            <td class="schedule-cell"
                                style="background-image: url('https://giaydantuongsacmau.com/upload/product/2020/12/10/giay-dan-tuong-soc-caro-image-20201210161206-350433-thumb.png');">
                                @php
                                    $daDung = [];
                                @endphp

                                @for ($so = 7; $so <= 12; $so++)
                                    @php $rendered = false; @endphp

                                    @foreach ($thoikhoabieu as $tkb)
                                        @php
                                            $bat_dau = $tkb->tiet_bat_dau;
                                            $ket_thuc = $tkb->tiet_ket_thuc;
                                            $so_tiet = $ket_thuc - $bat_dau + 1;
                                        @endphp

                                        @if ($tkb->ngay == $ngay->format('Y-m-d'))
                                            @if ($so == $bat_dau && !in_array($tkb->id, $daDung))
                                                <div class="class-card web-dev mb-2 border-left-{{ $tkb->lopHocPhan->loai_mon->getBadge() }}"
                                                    data-id="{{ $tkb->lopHocPhan->id }}"
                                                    data-tkb="{{ $tkb->id }}"
                                                    data-subject="{{ $tkb->lopHocPhan->ten_hoc_phan }}"
                                                    data-class="{{ $tkb->lopHocPhan->lop->ten_lop }}"
                                                    data-period="{{ $tkb->tiet_bat_dau }}-{{ $tkb->tiet_ket_thuc }}"
                                                    data-room="{{ $tkb->phong->ten }}"
                                                    data-teacher="{{ $tkb->lopHocPhan->giangVien->hoSo->ho_ten ?? '' }}"
                                                    data-date="{{ \Carbon\Carbon::parse($tkb->ngay)->format('d/m/Y') }}"
                                                    data-day="{{ $tkb->ngay }}">
                                                    <div class="class-title">
                                                        {{ $tkb->lopHocPhan->ten_hoc_phan }}
                                                    </div>
                                                    <div class="class-details">
                                                        Lớp: {{ $tkb->lopHocPhan->lop->ten_lop }}<br>
                                                        Tiết:
                                                        {{ $tkb->tiet_bat_dau }}-{{ $tkb->tiet_ket_thuc }}<br>
                                                        Phòng: {{ $tkb->phong->ten }}<br>
                                                        GV:
                                                        {{ $tkb->lopHocPhan->giangVien->hoSo->ho_ten ?? '' }}<br>
                                                        Ngày:
                                                        {{ \Carbon\Carbon::parse($tkb->ngay)->format('d/m/Y') }}
                                                    </div>
                                                </div>
                                                @php
                                                    $rendered = true;
                                                    $daDung[] = $tkb->id;
                                                    break;
                                                @endphp
                                            @elseif ($so > $bat_dau && $so <= $ket_thuc)
                                                @php
                                                    $rendered = true;
                                                    break;
                                                @endphp
                                            @endif
                                        @endif
                                    @endforeach

                                    @if (!$rendered)
                                        <div class=""></div>
                                    @endif
                                @endfor
                            </td>
                        @endforeach
                    </tr>

                    {{-- Evening Session --}}
                    <tr>
                        <td class="time-column">Tối</td>
                        @foreach ($ngayTrongTuan as $ngay)
                            <td class="schedule-cell"
                                style="background-image: url('https://giaydantuongsacmau.com/upload/product/2020/12/10/giay-dan-tuong-soc-caro-image-20201210161206-350433-thumb.png');">
                                @php
                                    $daDung = [];
                                @endphp

                                @for ($so = 13; $so <= 15; $so++)
                                    @php $rendered = false; @endphp

                                    @foreach ($thoikhoabieu as $tkb)
                                        @php
                                            $bat_dau = $tkb->tiet_bat_dau;
                                            $ket_thuc = $tkb->tiet_ket_thuc;
                                            $so_tiet = $ket_thuc - $bat_dau + 1;
                                        @endphp

                                        @if ($tkb->ngay == $ngay->format('Y-m-d'))
                                            @if ($so == $bat_dau && !in_array($tkb->id, $daDung))
                                                <div class="class-card web-dev mb-2 border-left-{{ $tkb->lopHocPhan->loai_mon->getBadge() }}"
                                                    data-id="{{ $tkb->lopHocPhan->id }}"
                                                    data-tkb="{{ $tkb->id }}"
                                                    data-subject="{{ $tkb->lopHocPhan->ten_hoc_phan }}"
                                                    data-class="{{ $tkb->lopHocPhan->lop->ten_lop }}"
                                                    data-period="{{ $tkb->tiet_bat_dau }}-{{ $tkb->tiet_ket_thuc }}"
                                                    data-room="{{ $tkb->phong->ten }}"
                                                    data-teacher="{{ $tkb->lopHocPhan->giangVien->hoSo->ho_ten ?? '' }}"
                                                    data-date="{{ \Carbon\Carbon::parse($tkb->ngay)->format('d/m/Y') }}"
                                                    data-day="{{ $tkb->ngay }}">
                                                    <div class="class-title">
                                                        {{ $tkb->lopHocPhan->ten_hoc_phan }}
                                                    </div>
                                                    <div class="class-details">
                                                        Lớp: {{ $tkb->lopHocPhan->lop->ten_lop }}<br>
                                                        Tiết:
                                                        {{ $tkb->tiet_bat_dau }}-{{ $tkb->tiet_ket_thuc }}<br>
                                                        Phòng: {{ $tkb->phong->ten }}<br>
                                                        GV:
                                                        {{ $tkb->lopHocPhan->giangVien->hoSo->ho_ten ?? '' }}<br>
                                                        Ngày:
                                                        {{ \Carbon\Carbon::parse($tkb->ngay)->format('d/m/Y') }}
                                                    </div>
                                                </div>
                                                @php
                                                    $rendered = true;
                                                    $daDung[] = $tkb->id;
                                                    break;
                                                @endphp
                                            @elseif ($so > $bat_dau && $so <= $ket_thuc)
                                                @php
                                                    $rendered = true;
                                                    break;
                                                @endphp
                                            @endif
                                        @endif
                                    @endforeach

                                    @if (!$rendered)
                                        <div class=""></div>
                                    @endif
                                @endfor
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="legend">
            <div class="legend-item">
                <div class="legend-color bg-info"></div>
                <span>Lý thuyết</span>
            </div>
            <div class="legend-item ">
                <div class="legend-color bg-warning"></div>
                <span>Thực hành</span>
            </div>
            <div class="legend-item">
                <div class="legend-color bg-danger"></div>
                <span>Đại cương</span>
            </div>
            <div class="legend-item">
                <div class="legend-color bg-success"></div>
                <span>Módun</span>
            </div>
        </div>

    </div>
    <div class="modal fade" id="modalSaoChep" tabindex="-1" aria-labelledby="modalSaoChepLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 12px">
                <form action="{{ route('giangvien.lichhoc.copy') }}" method="POST">
                    @csrf
                    <div class="modal-header bg-dark text-white" style="background: #2c3e50;">
                        <h5 class="modal-title" id="modalSaoChepLabel">Sao chép thời khóa biểu</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Đóng"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="id_lop" value="{{ $lop->id }}">
                        <div class="row">
                            <input type="hidden" name="id_tuan_hien_tai" value="{{ $tuanhientai }}" readonly>
                            <div class="mb-3">
                                <label class="form-label">Bạn có chắc muốn sao chép thời khóa biểu tuần này sang tuần
                                </label>
                            </div>

                            <div>
                                <label for="id_tuan_sao_chep" class="form-label">Tuần cần sao chép</label>
                                <select class="form-select" name="id_tuan_sao_chep">
                                    @foreach ($dsTuan as $tuan)
                                        <option value="{{ $tuan->id }}">
                                            Tuần {{ $loop->index + 1 }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>




                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
