<div>
    <div>
        <label>Chọn tuần:</label>
        <select wire:model="id_tuan">
            @foreach ($dsTuan as $tuan)
                <option value="{{ $tuan->id }}">Tuần {{ $tuan->tuan }}</option>
            @endforeach
        </select>
    </div>

    <hr>

    <h4>Lịch học tuần: {{ $tuanDangChon->tuan ?? 'Không có' }}</h4>
    <ul>
        @foreach ($ngayTrongTuan as $ngay)
            <li>{{ $ngay->format('d/m/Y') }}</li>
        @endforeach
    </ul>

    <table>
        <thead>
            <tr>
                <th>Môn</th>
                <th>Phòng</th>
                <th>Giảng viên</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($thoikhoabieu as $tkb)
                <tr>
                    <td>{{ $tkb->lopHocPhan->monHoc->ten ?? '' }}</td>
                    <td>{{ $tkb->phong->ten_phong ?? '' }}</td>
                    <td>{{ $tkb->lopHocPhan->giangVien->hoTen() ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
