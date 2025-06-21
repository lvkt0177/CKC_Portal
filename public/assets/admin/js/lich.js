
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
