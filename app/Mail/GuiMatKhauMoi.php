<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GuiMatKhauMoi extends Mailable
{
    use Queueable, SerializesModels;

    public $sinhVien;
    public $matKhauMoi;

    public function __construct($sinhVien, $matKhauMoi)
    {
        $this->sinhVien = $sinhVien;
        $this->matKhauMoi = $matKhauMoi;
    }

    public function build()
    {
        return $this->subject('Cấp lại mật khẩu CKC')->view('emails.gui-mat-khau-moi');
    }
}

