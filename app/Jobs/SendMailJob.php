<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\GuiMatKhauMoi;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $sinhVien;
    public $matKhauMoi;

    /**
     * Create a new job instance.
     */
    public function __construct($sinhVien, $matKhauMoi)
    {
        $this->sinhVien = $sinhVien;
        $this->matKhauMoi = $matKhauMoi;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->sinhVien->email)->send(new GuiMatKhauMoi($this->sinhVien, $this->matKhauMoi));
    }
}
