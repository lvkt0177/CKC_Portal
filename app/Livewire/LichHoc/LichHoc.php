<?php

namespace App\Livewire\LichHoc;

use Livewire\Component;
use App\Models\Lop;
use App\Models\HocKy;
use App\Models\Tuan;
use App\Models\ThoiKhoaBieu;
use Carbon\Carbon;

class LichHoc extends Component
{
    public $lop;
    public $idTuan;
    public $hocKyId;

    public $hocKy;
    public $tuanDangChon;
    public $ngayTrongTuan = [];
    public $thoikhoabieu = [];

    public function mount(Lop $lop, $idTuan = null, $hocKyId = null)
    {
        $this->lop = $lop;
        $this->idTuan = $idTuan;
        $this->hocKyId = $hocKyId;

        $this->hocKy = HocKy::where('id_nien_khoa', $lop->id_nien_khoa)
                            ->where('id', $hocKyId)
                            ->first();

        $this->capNhatTheoTuan();
        
    }

    public function updatedIdTuan()
    {
        $this->capNhatTheoTuan();
    }

    public function capNhatTheoTuan()
    {
        $this->tuanDangChon = Tuan::find($this->idTuan);
        $this->layNgayTrongTuan();
        $this->layThoiKhoaBieu();
    }

    public function layDanhSachTuanTheoHocKy()
    {
        if (!$this->hocKy) return collect();

        return Tuan::whereDate('ngay_bat_dau', '>=', $this->hocKy->ngay_bat_dau)
            ->whereDate('ngay_ket_thuc', '<=', $this->hocKy->ngay_ket_thuc)
            ->orderBy('ngay_bat_dau')
            ->get();
    }

    protected function layNgayTrongTuan()
    {
        $this->ngayTrongTuan = [];
        $tuan = $this->tuanDangChon;
        if (!$tuan) return;

        $this->ngayTrongTuan = [];

        $bat_dau = Carbon::parse($tuan->ngay_bat_dau);
        $ket_thuc = Carbon::parse($tuan->ngay_ket_thuc);

        while ($bat_dau->lte($ket_thuc)) {
            $this->ngayTrongTuan[] = $bat_dau->copy();
            $bat_dau->addDay();
        }
    }

    protected function layThoiKhoaBieu()
    {

        $this->thoikhoabieu = [];
        
        if (!$this->idTuan) return;

        $this->thoikhoabieu = ThoiKhoaBieu::with([
            'lopHocPhan',
            'lopHocPhan.lop',
            'lopHocPhan.giangVien.hoSo',
            'phong',
            'tuan'
        ])
            ->whereHas('lopHocPhan', function ($query) {
                $query->where('id_lop', $this->lop->id);
            })
            ->where('id_tuan', $this->idTuan)
            ->get();
    }

    public function render()
    {
        return view('livewire.lich-hoc.lich-hoc', [
            'hocKy' => $this->hocKy,
            'thoikhoabieu' => $this->thoikhoabieu,
            'ngayTrongTuan' => $this->ngayTrongTuan,
            'lop' => $this->lop,
            'tuanDangChon' => $this->tuanDangChon,
            'dsTuan' => $this->layDanhSachTuanTheoHocKy(),
        ]);
    }
}