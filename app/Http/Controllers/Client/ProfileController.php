<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Profile\ChangePasswordRequest;
use Auth;
use Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $sinhVien = Auth::guard('student')->user();
        return view('client.profile.index', compact('sinhVien'));
    }
}
