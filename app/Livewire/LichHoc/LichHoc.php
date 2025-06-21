<?php

namespace App\Livewire\LichHoc;

use Livewire\Component;



//Model
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Lop;
use App\Models\HocKy;
use App\Models\Tuan;
use App\Models\ThoiKhoaBieu;
use Carbon\Carbon;

class LichHoc extends Component
{
    public $lop;
    public $dsHocKy = [];
    public $dsTuan = [];
    public $hocKy;
    public $tuanDangChon;
    public $ngayTrongTuan = [];
    public $thoikhoabieu = [];

    public $hoc_ky_id;
    public $id_tuan;

    public function mount(Lop $lop,)
    {
        
        $this->lop = $lop;

        $today = now();

        // Danh sách học kỳ
        $this->dsHocKy = HocKy::where('id_nien_khoa', $lop->id_nien_khoa)
                                ->orderBy('ngay_bat_dau')->get();
        if ($this->dsHocKy->count() > 0) {
            $this->dsHocKy->pop();
        }

        // Học kỳ hiện tại hoặc theo id
        $this->hocKy = $this->hoc_ky_id
            ? HocKy::find($this->hoc_ky_id)
            : HocKy::where('ngay_bat_dau', '<=', $today)
                   ->where('ngay_ket_thuc', '>=', $today)->first();

        if (!$this->hocKy) {
            $this->hocKy = HocKy::where('ngay_ket_thuc', '<=', $today)
                                ->orderByDesc('ngay_ket_thuc')->first();
        }

        // Danh sách tuần
        if ($this->hocKy) {
            $this->dsTuan = Tuan::whereDate('ngay_bat_dau', '>=', $this->hocKy->ngay_bat_dau)
                ->whereDate('ngay_ket_thuc', '<=', $this->hocKy->ngay_ket_thuc)
                ->orderBy('tuan')
                ->get();
        }

        // Tuần đang chọn
        $this->tuanDangChon = $this->id_tuan
            ? Tuan::find($this->id_tuan)
            : $this->dsTuan->first();

        // Ngày trong tuần
        $this->layNgayTrongTuan();

        // Lấy TKB
        $this->layThoiKhoaBieu();
    }

    public function updatedHocKyId()
    {
        dd('hoc_ky_id'. $this->hocKy->id);
        $this->mount($this->lop);
    }

    public function updatedIdTuan()
    {
        $this->capNhatTuan();
    }

    public function capNhatTuan()
    {
        dd('id_tuan', $this->id_tuan);
        $this->tuanDangChon = Tuan::find($this->id_tuan);
        $this->layNgayTrongTuan();
        $this->layThoiKhoaBieu();
    }

    public function layNgayTrongTuan()
    {
        $this->ngayTrongTuan = [];

        if ($this->tuanDangChon) {
            $bat_dau = Carbon::parse($this->tuanDangChon->ngay_bat_dau);
            $ket_thuc = Carbon::parse($this->tuanDangChon->ngay_ket_thuc);

            while ($bat_dau->lte($ket_thuc)) {
                $this->ngayTrongTuan[] = $bat_dau->copy();
                $bat_dau->addDay();
            }
        }
    }

    public function layThoiKhoaBieu()
    {
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
        ->where('id_tuan', $this->tuanDangChon->id ?? null)
        ->get();
    }

    public function render()
    {
        return view('livewire.lich-hoc.lich-hoc', [
        'thoikhoabieu' => $this->thoikhoabieu,
        'ngayTrongTuan' => $this->ngayTrongTuan,
        'lop' => $this->lop,
        'dsTuan' => $this->dsTuan,
        'dsHocKy' => $this->dsHocKy,
        'tuanDangChon' => $this->tuanDangChon,
        'hocKy' => $this->hocKy,
    ]);
    }
}