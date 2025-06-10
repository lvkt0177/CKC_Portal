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
                        <a href="{{ route('admin.phieulenlop.index') }}" class="btn btn-primary">Quay lại</a>
                    </div>

                    <div class="card-body">
                        <form id="phieu-len-lop-form" method="POST" action="{{ route('admin.phieulenlop.store') }}">
                            @csrf <!-- Đừng quên thêm CSRF token -->

                            <!-- Học phần -->
                            <div class="col-md-12">
                                <label for="id_lop_hoc_phan" class="form-label">Chọn lớp học phần</label>
                                <select id="id_lop_hoc_phan" name="id_lop_hoc_phan" class="form-control">
                                    <option value="">-- Chọn Lớp học phần -- </option>
                                    @foreach ($lopHocPhan as $lhp)
                                        <option value="{{ $lhp->id }}">{{ $lhp->ten_hoc_phan }}
                                            {{ $lhp->lop->ten_lop }}</option>
                                    @endforeach
                                </select>

                                <div id="sinhvien-details-container" class="mt-3"></div>
                            </div>
                            <!-- Tiết học -->
                            <div class="row">
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
                            </div>


                            <!-- Ngày học -->
                            <div class="mb-3">
                                <label for="ngay" class="form-label">Ngày học</label>
                                <input type="date" id="ngay" name="ngay" class="form-control" readonly
                                    value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">

                            </div>

                            <!-- Phòng học -->
                            <div class="mb-3">
                                <label for="id_phong" class="form-label">Phòng học</label>
                                <select id="id_phong" name="id_phong" class="form-select">
                                    @foreach ($phong as $p)
                                        <option value="{{ $p->id }}">{{ $p->ten }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="row">
                                {{-- Sỉ số  --}}
                                <div class="col-md-4 mb-3">
                                    <label for="si_so" class="form-label">Sỉ số</label>
                                    <input type="number" id="si_so" name="si_so" class="form-control" readonly>

                                </div>
                                {{-- Hiện diện --}}
                                <div class="col-md-4 mb-3">
                                    <label for="hien_dien" class="form-label">Hiện diện</label>
                                    <input type="number" id="hien_dien" name="hien_dien" class="form-control">
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
                                <button class="btn btn-success">Lưu phiếu</button>
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

    <script>
        $(document).ready(function() {
            console.log('jQuery:', $.fn.jquery);
            console.log('Select2 exists:', typeof $.fn.select2);
            const siSoMap = @json($siSoArray);
            $('#id_lop_hoc_phan').select2({
                placeholder: "Chọn lớp học phần"
            });
            $('#id_lop_hoc_phan').on('change', function() {
                const id = $(this).val();
                $('#si_so').val(siSoMap[id] || '0');
            });
        });
    </script>
    <script>
        const buoiSelect = document.getElementById('buoi');
        const tietBatDauSelect = document.getElementById('tiet_bat_dau');
        const soTietSelect = document.getElementById('so_tiet');


        // Phạm vi tiết theo buổi
        const buoiTietMap = {
            'sang': {
                min: 1,
                max: 6
            },
            'chieu': {
                min: 7,
                max: 12
            },
            'toi': {
                min: 13,
                max: 15
            }
        };

        // Cập nhật option tiết bắt đầu theo buổi
        function capNhatTietBatDau() {
            const buoi = buoiSelect.value;
            tietBatDauSelect.innerHTML = '<option value="">-- Chọn tiết bắt đầu --</option>';
            soTietSelect.innerHTML = '<option value="">-- Chọn số tiết --</option>';
            soTietSelect.disabled = true;


            if (!buoi || !buoiTietMap[buoi]) {
                tietBatDauSelect.disabled = true;
                return;
            }

            tietBatDauSelect.disabled = false;

            const {
                min,
                max
            } = buoiTietMap[buoi];
            for (let i = min; i <= max; i++) {
                const opt = document.createElement('option');
                opt.value = i;
                opt.textContent = 'Tiết ' + i;
                tietBatDauSelect.appendChild(opt);
            }
        }

        // Cập nhật option số tiết dựa trên tiết bắt đầu và buổi
        function capNhatSoTiet() {
            const buoi = buoiSelect.value;
            const tietBatDau = parseInt(tietBatDauSelect.value);
            soTietSelect.innerHTML = '<option value="">-- Chọn số tiết --</option>';


            if (!buoi || !buoiTietMap[buoi] || !tietBatDau) {
                soTietSelect.disabled = true;
                return;
            }

            soTietSelect.disabled = false;

            const {
                max
            } = buoiTietMap[buoi];
            const tietConLai = max - tietBatDau + 1;
            const maxSoTiet = Math.min(6, tietConLai);

            for (let i = 1; i <= maxSoTiet; i++) {
                const opt = document.createElement('option');
                opt.value = i;
                opt.textContent = i + ' tiết';
                soTietSelect.appendChild(opt);
            }
        }

        // Chia buổi học (hiển thị chi tiết tiết)
        function chiaBuoi(tietBatDau, soTiet) {
            const buoiHoc = {
                'Sáng': [],
                'Chiều': [],
                'Tối': []
            };

            for (let i = 0; i < soTiet; i++) {
                const tiet = tietBatDau + i;
                if (tiet >= 1 && tiet <= 6) buoiHoc['Sáng'].push(tiet);
                else if (tiet >= 7 && tiet <= 12) buoiHoc['Chiều'].push(tiet);
                else if (tiet >= 13 && tiet <= 15) buoiHoc['Tối'].push(tiet);
            }

            return buoiHoc;
        }

        function capNhatKetQuaChiaBuoi() {
            const tietBatDau = parseInt(tietBatDauSelect.value);
            const soTiet = parseInt(soTietSelect.value);

            if (!tietBatDau || !soTiet) {

                return;
            }

            const buoi = chiaBuoi(tietBatDau, soTiet);
            let output = "";

            for (const [tenBuoi, tietList] of Object.entries(buoi)) {
                if (tietList.length > 0) {
                    output += `<strong>${tenBuoi}:</strong> Tiết ${tietList.join(', ')}<br>`;
                }
            }


        }

        // Event listeners
        buoiSelect.addEventListener('change', () => {
            capNhatTietBatDau();
            soTietSelect.disabled = true;
        });

        tietBatDauSelect.addEventListener('change', () => {
            capNhatSoTiet();

        });

        soTietSelect.addEventListener('change', capNhatKetQuaChiaBuoi);

        // Khởi tạo khi load trang
        window.addEventListener('DOMContentLoaded', () => {
            capNhatTietBatDau();
            capNhatSoTiet();

        });
    </script>

@endsection
