<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ThoiKhoaBieu\ThoiKhoaBieuRequest;
use App\Http\Requests\ThoiKhoaBieu\UpdateLichHocRequest;
use Carbon\Carbon;

//Model
use Illuminate\Support\Facades\Auth;
use App\Models\Lop;
use App\Models\DanhSachHocPhan;
use App\Models\Phong;
use App\Models\LopHocPhan;
use App\Models\User;
use App\Models\SinhVien;
use App\Models\NienKhoa;
use App\Models\NganhHoc;
use App\Models\MonHoc;
use App\Models\Nam;
use App\Models\Tuan;
use App\Models\HocKy;
use App\Models\ThoiKhoaBieu;
use App\Models\ChiTietChuongTrinhDaoTao;
use App\Models\ChuongTrinhDaoTao;

class LichHocController extends Controller
{
    //
    public function index(Request $request)
    {
        $nienKhoas = NienKhoa::orderBy('id', 'desc')->get();
        $nganhHocs = NganhHoc::orderBy('id', 'desc')->get();

        $id_nien_khoa = $request->input('id_nien_khoa') ?? NienKhoa::where('nam_bat_dau', '<', Carbon::now()->year)
            ->where('nam_ket_thuc', '>=', Carbon::now()->year)
            ->orderByDesc('nam_ket_thuc')
            ->first()?->id;
        $id_nganh_hoc = $request->input('id_nganh_hoc');
        
        $lops = Lop::with([
           'giangVien','giangVien.hoSo'
        ])->where('id_nien_khoa', $id_nien_khoa)
            ->when($id_nganh_hoc, function ($query) use ($id_nganh_hoc) {
                return $query->whereHas('giangVien.boMon.nganhHoc', function ($q) use ($id_nganh_hoc) {
                    $q->where('id', $id_nganh_hoc);
                });
            })
            ->orderBy('id', 'desc')
            ->get();
        return view('admin.lichhoc.index', compact('lops', 'nienKhoas', 'id_nien_khoa', 'id_nganh_hoc', 'nganhHocs'));
    }

    public function list(Request $request,Lop $lop)
    {   
        $today = now();

        $dsPhong= Phong::all();
        
        $dsHocKy = HocKy::where('id_nien_khoa', $lop->id_nien_khoa)
                        ->orderBy('ngay_bat_dau')
                        ->get();

    
        $hocKy = null;

        if ($request->filled('hoc_ky')) {
            $hocKy = HocKy::find($request->hoc_ky);
        }

        if (!$hocKy) {
            $hocKy = HocKy::where('ngay_bat_dau', '<=', $today)
                        ->where('ngay_ket_thuc', '>=', $today)
                        ->first();
        }

        if (!$hocKy) {
            $hocKy = HocKy::where('ngay_ket_thuc', '<=', $today)
                        ->orderByDesc('ngay_ket_thuc')
                        ->first();
        }

       
        $dsTuan = Tuan::whereDate('ngay_bat_dau', '>=', $hocKy->ngay_bat_dau)
                    ->whereDate('ngay_ket_thuc', '<=', $hocKy->ngay_ket_thuc)
                    ->orderBy('tuan')
                    ->get();

        
        $tuanDangChon = $request->filled('id_tuan')
            ? Tuan::find($request->id_tuan)
            : $dsTuan->first();

        $tuan = $tuanDangChon;
        
        $ngayTrongTuan = collect();
        if ($tuan) {
            $bat_dau = \Carbon\Carbon::parse($tuan->ngay_bat_dau);
            $ket_thuc = \Carbon\Carbon::parse($tuan->ngay_ket_thuc);
            while ($bat_dau->lte($ket_thuc)) {
                $ngayTrongTuan->push($bat_dau->copy());
                $bat_dau->addDay();
            }
        }

        $thoikhoabieu = ThoiKhoaBieu::with([
            'lopHocPhan',
            'lopHocPhan.lop',
            'lopHocPhan.giangVien.hoSo',
            'phong',
            'tuan'
        ])
        ->whereHas('lopHocPhan', function ($query) use ($lop) {
            $query->where('id_lop', $lop->id);
        })
        ->where('id_tuan', $tuan->id ?? null)
        ->get();

        $dsgv = User::with('boMon.nganhHoc', 'hoSo')
        ->whereHas('boMon.nganhHoc', function ($query) use ($lop) {
            $query->where('id', $lop->id_nganh_hoc);
        })
        ->get();

        return view('admin.lichhoc.list', compact('ngayTrongTuan','thoikhoabieu','lop','dsHocKy','dsTuan','hocKy','tuanDangChon','dsgv','dsPhong'));
    }
    public function create(Request $request, Lop $lop)
    {
        
        $nienKhoa = $lop->nienKhoa;

        if ($nienKhoa && $nienKhoa->nam_ket_thuc <= now()->year) {
            return redirect()->route('giangvien.lichhoc.index')
                ->with('error', 'Lớp đã hết kỳ để tạo thời khóa biểu');
        }

        $today = now();

    
        $dsHocKy = HocKy::where('id_nien_khoa', $lop->id_nien_khoa)
            ->orderBy('ngay_bat_dau')
            ->get();

       
        $id_hoc_ky = $request->hoc_ky ?? $dsHocKy->first()?->id;
        $hocKy = HocKy::find($id_hoc_ky);

        if (!$hocKy) {
            return back()->with('error', 'Không tìm thấy học kỳ');
        }

       
        $dsTuan = Tuan::whereDate('ngay_bat_dau', '>=', $hocKy->ngay_bat_dau)
            ->whereDate('ngay_ket_thuc', '<=', $hocKy->ngay_ket_thuc)
            ->orderBy('tuan')->get();
        
        $tuanDangChon = $request->id_tuan
            ? Tuan::find($request->id_tuan)
            : $dsTuan->first();
       
        $tuan = $tuanDangChon;

     
        $monHoc = collect();
        if ($id_hoc_ky) {
            $monHoc = MonHoc::whereHas('chiTietChuongTrinhDaoTaos', function ($query) use ($lop, $id_hoc_ky) {
                    $query->where('id_hoc_ky', $id_hoc_ky)
                        ->whereHas('chuongTrinhDaoTao', function ($q) use ($lop) {
                            $q->whereHas('chuyenNganh', function ($sub) use ($lop) {
                                $sub->where('id_nganh_hoc', $lop->id_nganh_hoc);
                            });
                        });
                })
                ->where('loai_mon_hoc', '!=', 2)
                ->get();
        }

        $phong = Phong::all();

        $ngayTrongTuan = collect();
        if ($tuanDangChon) {
            $bat_dau = Carbon::parse($tuanDangChon->ngay_bat_dau);
            $ket_thuc = Carbon::parse($tuanDangChon->ngay_ket_thuc);
            while ($bat_dau->lte($ket_thuc)) {
                $ngayTrongTuan->push($bat_dau->copy());
                $bat_dau->addDay();
            }
        }

        $thoikhoabieu = ThoiKhoaBieu::with([
            'lopHocPhan',
            'lopHocPhan.lop',
            'lopHocPhan.giangVien.hoSo',
            'phong',
            'tuan'
        ])
        ->whereHas('lopHocPhan', function ($query) use ($lop) {
            $query->where('id_lop', $lop->id);
        })
        ->where('id_tuan', $tuanDangChon?->id)
        ->get();

        return view('admin.lichhoc.create', compact(
            'lop',
            'dsHocKy',
            'monHoc',
            'phong',
            'id_hoc_ky',
            'tuanDangChon',
            'dsTuan',
            'ngayTrongTuan',
            'thoikhoabieu',
            'hocKy'
        ));
    }


    public function store(ThoiKhoaBieuRequest  $request)
    {
        $data = $request->validated();
        
        $lop = Lop::find( $data['lop_id'] );
        $tietKetThuc = $data['tiet_bat_dau'] + $data['so_tiet'] - 1;

       
        $tuan = Tuan::find($data['id_tuan']);
        if (!$tuan) {
            return redirect()->route('giangvien.lichhoc.create',['lop'=>$lop])->with('error', 'Tuần không tồn tại');
        }

        
        $ngayHoc = Carbon::parse($tuan->ngay_bat_dau)->addDays($data['thu'] - 2)->format('Y-m-d');
        
      
        
        $trungLich = ThoiKhoaBieu::where('ngay', $ngayHoc)
            ->where('id_phong', $data['id_phong'])
            ->where(function ($query) use ($data, $tietKetThuc) {
                $query->whereBetween('tiet_bat_dau', [$data['tiet_bat_dau'], $tietKetThuc])
                    ->orWhereBetween('tiet_ket_thuc', [$data['tiet_bat_dau'], $tietKetThuc])
                    ->orWhere(function ($q) use ($data, $tietKetThuc) {
                        $q->where('tiet_bat_dau', '<=', $data['tiet_bat_dau'])
                            ->where('tiet_ket_thuc', '>=', $tietKetThuc);
                    });
            })
            ->exists();
        
        if ($trungLich) {
            return redirect()->route('giangvien.lichhoc.create',['lop'=>$lop])->with('error','Phòng đã có lịch học trùng vào thời gian này.');
        }
        
        $trungLichLop = ThoiKhoaBieu::where('ngay', $ngayHoc)
            ->whereHas('lopHocPhan', function ($query) use ($data) {
                $query->where('id_lop', $data['lop_id']);
            })
            ->where(function ($query) use ($data, $tietKetThuc) {
                $query->whereBetween('tiet_bat_dau', [$data['tiet_bat_dau'], $tietKetThuc])
                    ->orWhereBetween('tiet_ket_thuc', [$data['tiet_bat_dau'], $tietKetThuc])
                    ->orWhere(function ($q) use ($data, $tietKetThuc) {
                        $q->where('tiet_bat_dau', '<=', $data['tiet_bat_dau'])
                            ->where('tiet_ket_thuc', '>=', $tietKetThuc);
                    });
            })
            ->exists();
         
        if ($trungLichLop) {
            return redirect()->route('giangvien.lichhoc.create',['lop'=>$lop])->with('error','Lớp đã có học phần khác trùng lịch vào thời gian này.');
        }



        $sinhVienList = SinhVien::where('id_lop', $data['lop_id'])->get();
      

        $tenMon = MonHoc::find($data['mon_hoc'])->ten_mon ?? 'Môn học';
       
        $monHoc = MonHoc::with('chiTietChuongTrinhDaoTaos.chuongTrinhDaoTao')->where('ten_mon', $tenMon)->first();
        
        $ct_ctdt = $monHoc->chiTietChuongTrinhDaoTaos->first();

        $ctdt = $ct_ctdt->ChuongTrinhDaoTao->first();
        
        
        
        $tenHocPhan = $tenMon . ' ' . $lop->ten_lop;
        $lopHocPhan = LopHocPhan::where('ten_hoc_phan', $tenHocPhan)
            ->where('id_lop', $data['lop_id'])
            ->first();  
        if (!$lopHocPhan) {
            $lopHocPhan = LopHocPhan::create([
                'ten_hoc_phan' => $tenMon . ' ' . $lop->ten_lop,
                'id_lop' => $data['lop_id'],
                'id_giang_vien' => null,
                'id_chuong_trinh_dao_tao' => $ct_ctdt->id_chuong_trinh_dao_tao, 
                'loai_lop_hoc_phan' => 0,
                'so_luong_sinh_vien' => $sinhVienList->count(),
                'loai_mon' => 0,
                'trang_thai' => 1,
            ]);    
            ThoiKhoaBieu::create([
                'id_tuan'         => $data['id_tuan'],
                'id_lop_hoc_phan' =>  $lopHocPhan->id,
                'id_phong'        => $data['id_phong'],
                'tiet_bat_dau'    => $data['tiet_bat_dau'],
                'tiet_ket_thuc'   => $tietKetThuc,
                'ngay'            => $ngayHoc,
            ]);
            
            foreach ($sinhVienList as $sv) {
                DanhSachHocPhan::firstOrCreate([
                    'id_sinh_vien'    => $sv->id,
                    'id_lop_hoc_phan' =>  $lopHocPhan->id,
                ], [
                    'loai_hoc' => 0, 
                ]);
            }
        } else {
        
            session()->flash('error', 'Lớp học phần này đã tồn tại. Không thể thêm trùng.');
            return back();
        }

        
        return redirect()->route('giangvien.lichhoc.create',['lop'=>$lop])
        ->with('success', 'Thêm thành công');
    }
    public function saoChepTuan(Request $request)
    {   
        
        $tuanHienTai = Tuan::find($request->id_tuan_hien_tai);
        $lop = Lop::find($request->id_lop);
       
        if (!$tuanHienTai || !$lop) {
            return back()->with('error', 'Không tìm thấy tuần hoặc lớp.');
        }

       
        $tuanTiepTheo = Tuan::find($request->id_tuan_sao_chep);
      
        if (!$tuanTiepTheo) {
            return back()->with('error', 'Không có tuần kế tiếp.');
        }

      
        $dsTKB = ThoiKhoaBieu::where('id_tuan', $tuanHienTai->id)
            ->whereHas('lopHocPhan', function ($query) use ($lop) {
                $query->where('id_lop', $lop->id);
            })
            ->get();

        foreach ($dsTKB as $tkb) {
           
            $thu = \Carbon\Carbon::parse($tkb->ngay)->dayOfWeekIso; 
            $ngayMoi = \Carbon\Carbon::parse($tuanTiepTheo->ngay_bat_dau)->addDays($thu - 1);

          
            $trungLich = ThoiKhoaBieu::where('ngay', $ngayMoi->format('Y-m-d'))
                ->where('id_phong', $tkb->id_phong)
                ->where(function ($query) use ($tkb) {
                    $query->whereBetween('tiet_bat_dau', [$tkb->tiet_bat_dau, $tkb->tiet_ket_thuc])
                        ->orWhereBetween('tiet_ket_thuc', [$tkb->tiet_bat_dau, $tkb->tiet_ket_thuc]);
                })
                ->exists();

            if ($trungLich) {
                continue; 
            }

            
            ThoiKhoaBieu::create([
                'id_tuan'         => $tuanTiepTheo->id,
                'id_lop_hoc_phan' => $tkb->id_lop_hoc_phan,
                'id_phong'        => $tkb->id_phong,
                'tiet_bat_dau'    => $tkb->tiet_bat_dau,
                'tiet_ket_thuc'   => $tkb->tiet_ket_thuc,
                'ngay'            => $ngayMoi->format('Y-m-d'),
            ]);
        }

        return redirect()->route('giangvien.lichhoc.list',['lop'=>$lop])->with('success', 'Đã sao chép thời khóa biểu sang tuần kế tiếp.');
    }
    public function update(UpdateLichHocRequest $request)
    {
        
        $data = $request->validated();
        

        $idLopHocPhan = $data['id_lop_hoc_phan'];
        $idGiaoVien   = $data['id_giao_vien'];
        $idLop        = $data['id_lop'];
        $tuanId       = $data['tuan'];
        $ngaybandau   = $data['ngay_ban_dau'];
        $ngay         = Carbon::parse($data['ngay'])->format('Y-m-d');
        $idPhong      = $data['id_phong'];
        dd($ngay);
        $lop  = Lop::find($idLop);
        $tuan = Tuan::find($tuanId);

        $lopHocPhan = LopHocPhan::find($idLopHocPhan);
        $thoikhoabieu = ThoiKhoaBieu::find($idLopHocPhan);
        
        if ($lopHocPhan) {
           
            $lopHocPhan->update([
                'id_giang_vien' => $idGiaoVien,
            ]);
        }
        $tkb = ThoiKhoaBieu::where('id_tuan', $tuanId)
            ->whereDate('ngay',$ngay)
            ->first();
        if ($tkb) {
            $tietBatDau = $tkb->tiet_bat_dau;
            $tietKetThuc = $tkb->tiet_ket_thuc;
        }
       
        $thoiKhoaBieu = ThoiKhoaBieu::where('id_lop_hoc_phan', $idLopHocPhan)
                   ->where('id_tuan', $tuanId)
                   ->whereDate('ngay', Carbon::parse($ngaybandau)->format('Y-m-d'))
                   ->first();
                   
       
        
        if ($thoiKhoaBieu && ($idPhong || $ngay)) {
            
            $trungLich = ThoiKhoaBieu::where('id_tuan', $tuanId)
                    ->whereDate('ngay', $ngay)
                    ->where(function ($query) use ($idPhong, $tietBatDau, $tietKetThuc) {
                        $query->where('id_phong', $idPhong)
                            ->where(function ($q) use ($tietBatDau, $tietKetThuc) {
                                $q->whereBetween('tiet_bat_dau', [$tietBatDau, $tietKetThuc])
                                    ->orWhereBetween('tiet_ket_thuc', [$tietBatDau, $tietKetThuc])
                                    ->orWhere(function ($sub) use ($tietBatDau, $tietKetThuc) {
                                        $sub->where('tiet_bat_dau', '<', $tietBatDau)
                                            ->where('tiet_ket_thuc', '>', $tietKetThuc);
                                    });
                            });
                    })
                    ->where('id_lop_hoc_phan', '!=', $idLopHocPhan)  
                    ->exists();
            

            dd($trungLich);
            if ($trungLich) {
                return redirect()->route('giangvien.lichhoc.list',['lop'=>$lop])
                ->with('error', 'Trùng phòng hoặc tiết học vào ngày đã chọn!');
            }

           
            
            $updateData = [];

            if ($idPhong) {
                $updateData['id_phong'] = $idPhong;
            }

            if ($ngay) {
                $updateData['ngay'] = $ngay;
            }

            $thoiKhoaBieu->update($updateData);
        }
        return redirect()->route('giangvien.lichhoc.list',['lop'=>$lop])
        ->with('success', 'Cập nhật thành công.');
    }

    public function destroy(Request $request)
    {
       
        dd($request->all());

        $idLopHocPhan = $request->id_lop_hoc_phan;
        $tietBatDau = $request->tiet_bat_dau;
        $ngay = $request->ngay;

        
        $lop = Lop::find($request->id_lop);

     
        $thoiKhoaBieu = ThoiKhoaBieu::where('id_lop_hoc_phan', $idLopHocPhan)
                            ->where('tiet_bat_dau', $tietBatDau)
                            ->where('ngay', $ngay)
                            ->first();

        if ($thoiKhoaBieu) {
            $thoiKhoaBieu->delete();
            return redirect()->route('giangvien.lichhoc.list', ['lop' => $lop])
                            ->with('success', 'Xóa thành công.');
        }

        return redirect()->route('giangvien.lichhoc.list', ['lop' => $lop])
                        ->with('error', 'Không tìm thấy, xóa không thành công.');
    }

}