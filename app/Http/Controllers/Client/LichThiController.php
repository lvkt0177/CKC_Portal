<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LichThiController extends Controller
{
    //
    public function index()
    {
        return view("client.lichthi.index");
    }
}