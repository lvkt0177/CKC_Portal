<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ThoiKhoaBieu\ThoiKhoaBieuRequest;
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

        return view('admin.lichhoc.list', compact('ngayTrongTuan','thoikhoabieu','lop','dsHocKy','dsTuan','hocKy','tuanDangChon'));
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
                'so_luong_dang_ky' => $sinhVienList->count(),
                'loai_mon' => 0,
                'trang_thai' => 0,
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


}