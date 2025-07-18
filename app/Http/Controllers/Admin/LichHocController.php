<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ThoiKhoaBieu\ThoiKhoaBieuRequest;
use App\Http\Requests\ThoiKhoaBieu\UpdateLichHocRequest;
use App\Http\Requests\ThoiKhoaBieu\DestroyLichHocRequest;
use Carbon\Carbon;

//Model
use Illuminate\Support\Facades\Auth;
use App\Models\Lop;
use App\Models\DanhSachHocPhan;
use App\Models\ChuyenNganh;
use App\Models\Phong;
use App\Models\LopHocPhan;
use App\Models\User;
use App\Models\SinhVien;
use App\Models\DanhSachSinhVien;
use App\Models\NienKhoa;
use App\Models\MonHoc;
use App\Models\Nam;
use App\Models\Tuan;
use App\Models\HocKy;
use App\Models\ThoiKhoaBieu;
use App\Models\ChiTietChuongTrinhDaoTao;
use App\Models\ChuongTrinhDaoTao;
use \Spatie\Permission\Models\Role;
use \Spatie\Permission\Models\Permission;
use App\Acl\Acl;

class LichHocController extends Controller
{
    public function __construct() {
        $this->middleware('permission:' . Acl::PERMISSION_VIEW_TIMETABLE, ['only' => ['index']]);
        $this->middleware('permission:' . Acl::PERMISSION_TIMETABLE_LIST, ['only' => ['list']]);
        $this->middleware('permission:' . Acl::PERMISSION_TIMETABLE_CREATE, ['only' => ['create', 'store']]);
        $this->middleware('permission:' . Acl::PERMISSION_TIMETABLE_UPDATE, ['only' => ['update']]);
        $this->middleware('permission:' . Acl::PERMISSION_TIMETABLE_DESTROY, ['only' => ['destroy']]);
        $this->middleware('permission:' . Acl::PERMISSION_TIMETABLE_COPY, ['only' => ['saoChepTuan']]);
    }

    public function index(Request $request)
    {   
        $nienKhoas = NienKhoa::orderBy('id', 'desc')->get();
        $nganhHocs = ChuyenNganh::select('ten_chuyen_nganh')
                ->distinct()
                ->get();


        $ten_chuyen_nganh = $request->input('ten_chuyen_nganh');
                
        $id_nien_khoa = $request->input('id_nien_khoa') ?? NienKhoa::where('nam_bat_dau', '<', Carbon::now()->year)
            ->where('nam_ket_thuc', '>=', Carbon::now()->year)
            ->orderByDesc('nam_ket_thuc')
            ->first()?->id;
        
        $lops = Lop::with(['nienKhoa', 'giangVien', 'chuyenNganh'])
            ->where('id_nien_khoa', $id_nien_khoa)
            ->when($ten_chuyen_nganh, function ($query) use ($ten_chuyen_nganh) {
                $query->whereHas('chuyenNganh', function ($q) use ($ten_chuyen_nganh) {
                    $q->where('ten_chuyen_nganh', $ten_chuyen_nganh);
                });
            })
            ->orderByDesc('id')
            ->get();
        return view('admin.lichhoc.index', compact('lops', 'nienKhoas', 'id_nien_khoa', 'ten_chuyen_nganh', 'nganhHocs'));
    }

    public function list(Request $request,Lop $lop)
    {   
        $nienKhoa = $lop->nienKhoa;

        if ($nienKhoa && $nienKhoa->nam_ket_thuc <= now()->year) {
            return redirect()->route('giangvien.lichhoc.index')
                ->with('error', 'Lớp đã hết kỳ để tạo thời khóa biểu');
        }
        $today = now();

        $dsPhong= Phong::all();
        
        $dsHocKy = HocKy::where('id_nien_khoa', $lop->id_nien_khoa)
                        ->where('ngay_ket_thuc','>=',$today)
                        ->orderBy('ngay_bat_dau')
                        ->get();
        $hocKy = null;

        if ($request->filled('hoc_ky')) {
            $hocKy = HocKy::where('id_nien_khoa', $lop->id_nien_khoa)
                        ->find($request->hoc_ky);
        }

        if (!$hocKy) {
            $hocKy = $dsHocKy->first();
        }

        if (!$hocKy) {
            $hocKy = HocKy::where('id_nien_khoa', $lop->id_nien_khoa)
                        ->where('ngay_ket_thuc', '<=', $today)
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
       
        $dsgv = User::with('boMon.chuyenNganh.khoa')
            ->whereHas('roles', function ($q) {
                $q->whereIn('name', [Acl::ROLE_GIANG_VIEN_BO_MON]);
            })
            ->whereHas('boMon.chuyenNganh.khoa', function ($query) use ($lop) {
                $query->where('id', $lop->chuyenNganh->id_khoa);
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
            ->where('ngay_ket_thuc','>=',$today)
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
            $monHoc =  MonHoc::whereHas('chiTietChuongTrinhDaoTaos', function ($query) use ($lop,$id_hoc_ky) {
                    $query->where('id_hoc_ky', $id_hoc_ky)
                        ->whereHas('chuongTrinhDaoTao', function ($subQuery) use ($lop) {
                            $subQuery->where('id_chuyen_nganh', $lop->id_chuyen_nganh);
                        });
                })
                ->where('loai_mon_hoc', '!=', 5)
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

        $sinhVienList = DanhSachSinhVien::where('id_lop', $data['lop_id'])->get();

        $tenMon = MonHoc::find($data['mon_hoc'])->ten_mon ?? 'Môn học';
       
        $monHoc = MonHoc::with('chiTietChuongTrinhDaoTaos.chuongTrinhDaoTao')->where('ten_mon', $tenMon)->first();
        
        $ct_ctdt = $monHoc->chiTietChuongTrinhDaoTaos->first();

        $ctdt = $ct_ctdt->ChuongTrinhDaoTao->first();
        
        $soTiet = ChiTietChuongTrinhDaoTao::where('id_mon_hoc', $monHoc->id)
            ->value('so_tiet');
        
        $tenHocPhan = $tenMon;
        $lopHocPhan = LopHocPhan::where('ten_hoc_phan', $tenHocPhan)
            ->where('id_lop', $data['lop_id'])
            ->first(); 
        
        if (!$lopHocPhan) {
            $lopHocPhan = LopHocPhan::create([
                'ten_hoc_phan' => $tenMon,
                'id_lop' => $data['lop_id'],
                'id_giang_vien' => null,
                'id_chuong_trinh_dao_tao' => $ct_ctdt->id_chuong_trinh_dao_tao, 
                'loai_lop_hoc_phan' => 0,
                'so_luong_sinh_vien' => $sinhVienList->count(),
                'gioi_han_dang_ky' => 20,
                'loai_mon' => $monHoc->loai_mon_hoc,
                'trang_thai' => 1,
            ]);    
           
            foreach ($sinhVienList as $sv) {
                DanhSachHocPhan::firstOrCreate([
                    'id_sinh_vien'    => $sv->sinhVien->id,
                    'id_lop_hoc_phan' =>  $lopHocPhan->id,
                ], [
                    'loai_hoc' => 0, 
                ]);
            }
        }
        $tongSoTiet = ThoiKhoaBieu::where('id_lop_hoc_phan', $lopHocPhan->id)
        ->get()
        ->sum(function ($tkb) {
            return $tkb->tiet_ket_thuc - $tkb->tiet_bat_dau + 1;
        });
        if($tongSoTiet == $soTiet ){
            return redirect()->route('giangvien.lichhoc.create',['lop'=>$lop])
        ->with('error', 'Môn học đã hết tiết được tạo!');
        }
        ThoiKhoaBieu::create([
                'id_tuan'         => $data['id_tuan'],
                'id_lop_hoc_phan' =>  $lopHocPhan->id,
                'id_phong'        => $data['id_phong'],
                'tiet_bat_dau'    => $data['tiet_bat_dau'],
                'tiet_ket_thuc'   => $tietKetThuc,
                'ngay'            => $ngayHoc,
            ]);
            
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
        $idGiaoVien   = $data['id_giao_vien'] ?? null;
        $idLop        = $data['id_lop'];
        $idPhong      = $data['id_phong'] ?? null;
        $ngay         = $data['ngay'];
        $ngayBanDau   = $data['ngay_ban_dau'];

        $lop          = Lop::findOrFail($idLop);
        $lopHocPhan   = LopHocPhan::findOrFail($idLopHocPhan);

        // Tìm bản ghi TKB cũ
        $tkb = ThoiKhoaBieu::where('id_lop_hoc_phan', $idLopHocPhan)
            ->whereDate('ngay', $ngayBanDau)
            ->first();

        if (!$tkb) {
            return back()->with('error', 'Không tìm thấy thời khóa biểu để cập nhật.');
        }

        $tietBatDau  = $tkb->tiet_bat_dau;
        $tietKetThuc = $tkb->tiet_ket_thuc;

        // Nếu đổi giảng viên, kiểm tra trùng
        if ($idGiaoVien && $idGiaoVien != $lopHocPhan->id_giang_vien) {
            $isTrungGV = ThoiKhoaBieu::whereDate('ngay', $ngay ?? $tkb->ngay)
                ->where('id', '!=', $tkb->id)
                ->whereBetween('tiet_bat_dau', [$tietBatDau, $tietKetThuc])
                ->orWhereBetween('tiet_ket_thuc', [$tietBatDau, $tietKetThuc])
                ->whereHas('lopHocPhan', function ($q) use ($idGiaoVien, $lopHocPhan) {
                    $q->where('id_giang_vien', $idGiaoVien)
                    ->where('id', '!=', $lopHocPhan->id);
                })
                ->exists();

            if ($isTrungGV) {
                return back()->with('error', 'Giảng viên đã có lịch trùng thời gian.');
            }

            $lopHocPhan->update(['id_giang_vien' => $idGiaoVien]);
        }

        // Kiểm tra phòng trùng
        if ($idPhong) {
            $isTrungPhong = ThoiKhoaBieu::whereDate('ngay', $ngay ?? $tkb->ngay)
                ->where('id', '!=', $tkb->id)
                ->where('id_phong', $idPhong)
                ->where(function ($q) use ($tietBatDau, $tietKetThuc) {
                    $q->where('tiet_bat_dau', '<=', $tietKetThuc)
                    ->where('tiet_ket_thuc', '>=', $tietBatDau);
                })
                ->exists();

            if ($isTrungPhong) {
                return back()->with('error', 'Phòng đã có lịch trùng vào thời gian này.');
            }
        }

        // Kiểm tra trùng trong cùng lớp (khác học phần)
        $trungTrongLop = ThoiKhoaBieu::whereDate('ngay', $ngay ?? $tkb->ngay)
            ->where('id', '!=', $tkb->id)
            ->whereHas('lopHocPhan', function ($q) use ($lopHocPhan) {
                $q->where('id_lop', $lopHocPhan->id_lop)
                ->where('id', '!=', $lopHocPhan->id);
            })
            ->where(function ($q) use ($tietBatDau, $tietKetThuc) {
                $q->where('tiet_bat_dau', '<=', $tietKetThuc)
                ->where('tiet_ket_thuc', '>=', $tietBatDau);
            })
            ->exists();

        if ($trungTrongLop) {
            return back()->with('error', 'Lớp này đã có lịch trùng vào thời gian này.');
        }

        // Kiểm tra trùng khác lớp (trùng phòng hoặc trùng giảng viên)
        $trungKhacLop = ThoiKhoaBieu::whereDate('ngay', $ngay ?? $tkb->ngay)
            ->where('id', '!=', $tkb->id)
            ->where(function ($q) use ($idPhong, $tietBatDau, $tietKetThuc, $tkb) {
                $q->where('id_phong', $idPhong ?? $tkb->id_phong)
                ->where('tiet_bat_dau', '<=', $tietKetThuc)
                ->where('tiet_ket_thuc', '>=', $tietBatDau);
            })
            ->orWhere(function ($q) use ($idGiaoVien, $lopHocPhan, $tietBatDau, $tietKetThuc) {
                $q->whereHas('lopHocPhan', function ($q2) use ($idGiaoVien, $lopHocPhan) {
                    $q2->where('id_giang_vien', $idGiaoVien ?? $lopHocPhan->id_giang_vien)
                    ->where('id_lop', '!=', $lopHocPhan->id_lop);
                })
                ->where('tiet_bat_dau', '<=', $tietKetThuc)
                ->where('tiet_ket_thuc', '>=', $tietBatDau);
            })
            ->exists();

        if ($trungKhacLop) {
            return back()->with('error', 'Lớp khác đã có lịch trùng với phòng hoặc giảng viên.');
        }

        // Cập nhật dữ liệu
        $updateData = [];
        if ($idPhong) $updateData['id_phong'] = $idPhong;
        if ($ngay) {
            $updateData['ngay'] = $ngay;

            $tuan = Tuan::where('ngay_bat_dau', '<=', $ngay)
                ->where('ngay_ket_thuc', '>=', $ngay)
                ->first();

            if ($tuan) {
                $updateData['id_tuan'] = $tuan->id;
            }
        }

        $tkb->update($updateData);

        return redirect()->route('giangvien.lichhoc.list', ['lop' => $lop])
            ->with('success', 'Cập nhật thời khóa biểu thành công.');
    }


    public function destroy(DestroyLichHocRequest $request)
    {
        $data = $request->validated();
        $idTKB = $data['id_tkb'];
        $thoiKhoaBieu = ThoiKhoaBieu::find($idTKB);
        if ($thoiKhoaBieu) {
            $thoiKhoaBieu->delete();
            return redirect()->back()
                            ->with('success', 'Xóa thành công.');
        }
        return redirect()->back()
                        ->with('error', 'Không tìm thấy, xóa không thành công.');
    }

    private function kiemTraTrungTiet($query, $tietBatDau, $tietKetThuc)
    {
        return $query->where(function ($q) use ($tietBatDau, $tietKetThuc) {
            $q->whereBetween('tiet_bat_dau', [$tietBatDau, $tietKetThuc])
            ->orWhereBetween('tiet_ket_thuc', [$tietBatDau, $tietKetThuc])
            ->orWhere(function ($subQ) use ($tietBatDau, $tietKetThuc) {
                $subQ->where('tiet_bat_dau', '<=',$tietKetThuc)
                    ->where('tiet_ket_thuc', '>=', $tietBatDau );
            });
        });
    }

    /**
     * Kiểm tra có bị trùng lịch hay không.
     *
     * @param string $ngay              Ngày cần kiểm tra
     * @param int|null $idPhong         ID phòng học (có thể null)
     * @param int|null $idGiaoVien      ID giảng viên (có thể null)
     * @param int $tietBatDau
     * @param int $tietKetThuc
     * @param int|null $excludeTkbId    ID thời khóa biểu cần loại trừ (khi update)
     * @return bool
     */
    public function checkLichTrung($ngay, $idPhong, $idGiaoVien, $tietBatDau, $tietKetThuc, $excludeTkbId = null): bool
    {
        $query = ThoiKhoaBieu::whereDate('ngay', $ngay)
            ->where(function ($q) use ($tietBatDau, $tietKetThuc) {
                $q->where('tiet_bat_dau', '<=', $tietKetThuc)
                ->where('tiet_ket_thuc', '>=', $tietBatDau);
            });

        if ($excludeTkbId) {
            $query->where('id', '!=', $excludeTkbId);
        }

        if ($idPhong) {
            $query->where('id_phong', $idPhong);
        }

        if ($idGiaoVien) {
            $query->whereHas('lopHocPhan', function ($q) use ($idGiaoVien) {
                $q->where('id_giang_vien', $idGiaoVien);
            });
        }

        return $query->exists();
    }
}