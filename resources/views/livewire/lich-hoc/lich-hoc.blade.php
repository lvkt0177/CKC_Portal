<div>
    <div>
        <hr>
        <div class="row mb-3">
            <div class="col-md-3">
                <label class="me-2 mb-0 d-inline-block"><em>Chọn học kỳ:</em></label>
                <select wire:model.defer="hoc_ky_id" wire:change="$refresh" class="form-control">
                    @foreach ($dsHocKy as $ky)
                        <option value="{{ $ky->id }}">{{ $ky->ten_hoc_ky }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 ">
                <label class=""><em>Chọn tuần:</em></label>
                <select wire:model.defer="id_tuan" wire:change="$refresh" class="form-control">
                    @foreach ($dsTuan as $tuan)
                        <option value="{{ $tuan->id }}">Tuần {{ $tuan->tuan }}</option>
                    @endforeach
                </select>
            </div>
        </div>




        <h4>Lịch học tuần: {{ $tuanDangChon->tuan ?? 'Không có' }}</h4>
        <div class="container">
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
                                                        data-subject="{{ $tkb->lopHocPhan->ten_hoc_phan }}"
                                                        data-class="{{ $tkb->lopHocPhan->lop->ten_lop }}"
                                                        data-period="{{ $tkb->tiet_bat_dau }}-{{ $tkb->tiet_ket_thuc }}"
                                                        data-room="{{ $tkb->phong->ten }}"
                                                        data-teacher="{{ $tkb->lopHocPhan->giangVien->hoSo->ho_ten ?? '' }}"
                                                        data-date="{{ \Carbon\Carbon::parse($tkb->ngay)->format('d/m/Y') }}">
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
                                                        data-subject="{{ $tkb->lopHocPhan->ten_hoc_phan }}"
                                                        data-class="{{ $tkb->lopHocPhan->lop->ten_lop }}"
                                                        data-period="{{ $tkb->tiet_bat_dau }}-{{ $tkb->tiet_ket_thuc }}"
                                                        data-room="{{ $tkb->phong->ten }}"
                                                        data-teacher="{{ $tkb->lopHocPhan->giangVien->hoSo->ho_ten ?? '' }}"
                                                        data-date="{{ \Carbon\Carbon::parse($tkb->ngay)->format('d/m/Y') }}">
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
                                                        data-subject="{{ $tkb->lopHocPhan->ten_hoc_phan }}"
                                                        data-class="{{ $tkb->lopHocPhan->lop->ten_lop }}"
                                                        data-period="{{ $tkb->tiet_bat_dau }}-{{ $tkb->tiet_ket_thuc }}"
                                                        data-room="{{ $tkb->phong->ten }}"
                                                        data-teacher="{{ $tkb->lopHocPhan->giangVien->hoSo->ho_ten ?? '' }}"
                                                        data-date="{{ \Carbon\Carbon::parse($tkb->ngay)->format('d/m/Y') }}">
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
    </div>

</div>
