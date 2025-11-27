<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UmumController extends Controller
{
    public function index()
{
    $riwayat = [];

    return view('umum.dashboard', compact('riwayat'));
}
}
    
