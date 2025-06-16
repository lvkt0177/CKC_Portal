<?php

namespace App\Livewire\BinhLuan;

use Livewire\Component;
use App\Models\ThongBao;
use App\Enum\ActiveOrNotStatus;
use App\Models\BinhLuan;
use App\Rules\BinhLuanRules;

class CommentSection extends Component
{
    public ThongBao $thongbao;
    public $noi_dung = [];
    public $box_reply = null;
    public $id_binh_luan_cha = null;
    public $id_reply = null;
    public $binhLuans = [];
    public $noi_dung_chinh = '';
    
    protected $listeners = ['xoaBinhLuan' => 'xoaBinhLuan'];
    
    public function mount()
    {
        $this->loadBinhLuans();
    }

    public function setReplyTo($id)
    {
        $this->id_binh_luan_cha = $id;
        $this->id_reply = null;
    }

    public function setReplyToReply($id, $id_phan_hoi)
    {
        $this->id_reply = $id;
        $this->box_reply = $id_phan_hoi;
        $this->id_binh_luan_cha = null;
    }

    public function guiBinhLuan()
    {
        $id = $this->id_binh_luan_cha ?? $this->id_reply;

        $isReply = $id !== null;

        $noi_dung = $isReply ? ($this->noi_dung[$id] ?? null) : $this->noi_dung_chinh;

        $data = validator(['noi_dung' => $noi_dung], BinhLuanRules::rules(), BinhLuanRules::messages())->validate();

        BinhLuan::create([
            ...$data,
            'id_thong_bao' => $this->thongbao->id,
            'nguoi_binh_luan_id' => auth()->id(),
            'nguoi_binh_luan_type' => get_class(auth()->user()),
            'id_binh_luan_cha' => $id,
            'trang_thai' => ActiveOrNotStatus::ACTIVE,
        ]);

        if ($isReply) {
            unset($this->noi_dung[$id]);
            $this->id_binh_luan_cha = null;
            $this->id_reply = null;
        } else {
            $this->noi_dung_chinh = '';
        }

        $this->loadBinhLuans();
        session()->flash('success', 'Bình luận đã được gửi.');
    }

    public function xoaBinhLuan($id)
    {
        $binhluan = BinhLuan::find($id);

        if (!$binhluan || $binhluan->nguoi_binh_luan_id !== auth()->id()) {
            session()->flash('error', 'Bạn không có quyền xóa bình luận này.');
            return;
        }
    
        $binhluan->delete();
    
        $this->loadBinhLuans();
        session()->flash('success', 'Đã xoá bình luận.');
    }



    public function loadBinhLuans()
    {
        $this->binhLuans = BinhLuan::where('id_thong_bao', $this->thongbao->id)
        ->where('trang_thai', ActiveOrNotStatus::ACTIVE)
        ->whereNull('id_binh_luan_cha')
        ->with([
            'nguoiBinhLuan.hoSo',
            'binhLuanCon' => function ($query) {
                $query->where('trang_thai', ActiveOrNotStatus::ACTIVE)
                      ->orderBy('created_at', 'asc') 
                      ->with('nguoiBinhLuan.hoSo');
            }
        ])
        ->orderBy('created_at', 'desc')
        ->get();
    }

    public function render()
    {
        return view('livewire.binh-luan.comment-section', [
            'binhLuans' => $this->binhLuans,
        ]);
    }
}
