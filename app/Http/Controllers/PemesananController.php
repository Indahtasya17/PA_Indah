<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function index()
    {
        return view('after-login.pemesanan.index');
    }
    public function create()
    {
        return view('after-login.pemesanan.create');
    }
    public function edit()
    {
        return view('after-login.pemesanan.edit');
    }
    public function detail()
    {
        return view('after-login.pemesanan.detail');
    }
}
