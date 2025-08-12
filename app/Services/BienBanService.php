<?php
namespace App\Services;

use App\Repositories\BienBan\BienBanRepositoryInterface;
use App\Repositories\ChiTietBienBan\ChiTietBienBanRepositoryInterface;
use App\Models\Lop;
use App\Http\Requests\BienBanRequest;
use App\Models\SinhVien;
use App\Models\User;
use App\Models\Tuan;
use App\Models\ChiTietBienBanSHCN;
use App\Models\BienBanSHCN;
use Carbon\Carbon;
use App\Enum\RoleStudent;

class BienBanService
{
    public function __construct(
        protected BienBanRepositoryInterface $bienBanRepository,
        protected ChiTietBienBanRepositoryInterface $chiTietRepository
    ) {
       //
    }

    public function storeBienBanVaChiTiet(array $data, Lop $lop)
    {
        $bienBan = $this->bienBanRepository->create([
            'id_lop' => $lop->id,
            'id_sv' => $data['id_sv'],
            'id_gvcn' => User::find($lop->id_gvcn)->id,
            'id_tuan' => $data['id_tuan'],
            'tieu_de' => $data['tieu_de'] . ' Tuần ' . Tuan::find($data['id_tuan'])->tuan,
            'noi_dung' => $data['noi_dung'],
            'thoi_gian_bat_dau' => Carbon::createFromFormat('Y-m-d\TH:i', $data['thoi_gian_bat_dau']),
            'thoi_gian_ket_thuc' => Carbon::createFromFormat('Y-m-d\TH:i', $data['thoi_gian_ket_thuc']),
            'so_luong_sinh_vien' => $data['so_luong_sinh_vien'],
            'vang_mat' => $data['vang_mat'],
            'trang_thai' => $data['trang_thai'],
        ]);
        if ($bienBan && !empty($data['sinh_vien_vang'])) {
            foreach ($data['sinh_vien_vang'] as $id => $value) {
                $this->chiTietRepository->create([
                    'id_bien_ban_shcn' => $bienBan->id,
                    'id_sinh_vien' => $id,
                    'ly_do' => $value['ly_do'] ?? 'Không',
                    'loai' => $value['loai'] ?? 0,
                ]);
            }
        }

        return true;
    }

    public function updateBienBanVaChiTiet(array $data, BienBanSHCN $bienBan)
    {
        if($bienBan->trang_thai == 1) {
            return false;
        }
        $this->bienBanRepository->update($bienBan, [
            'id_lop' => $bienBan->id_lop,
            'id_sv' => $data['id_sv'],
            'id_gvcn' => User::find($bienBan->lop->id_gvcn)->id,
            'id_tuan' => $data['id_tuan'],
            'tieu_de' => $data['tieu_de'] . ' Tuần ' . Tuan::find($data['id_tuan'])->tuan,
            'noi_dung' => $data['noi_dung'],
            'thoi_gian_bat_dau' => Carbon::createFromFormat('Y-m-d\TH:i', $data['thoi_gian_bat_dau']),
            'thoi_gian_ket_thuc' => Carbon::createFromFormat('Y-m-d\TH:i', $data['thoi_gian_ket_thuc']),
            'so_luong_sinh_vien' => $data['so_luong_sinh_vien'],
            'vang_mat' => $data['vang_mat'],
        ]);

        if (!empty($data['sinh_vien_vang'])) {
            foreach ($data['sinh_vien_vang'] as $id => $value) {
                $this->chiTietRepository->updateOrCreate(
                    [
                        'id_bien_ban_shcn' => $bienBan->id,
                        'id_sinh_vien' => $id ?? null,
                    ],
                    [
                        'ly_do' => $value['ly_do'] ?? 'Không',
                        'loai' => $value['loai'] ?? 0,
                    ]
                );
            }
        }

        return true;
    }
}