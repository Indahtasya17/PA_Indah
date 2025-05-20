<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeluarLokalController extends Controller
{
    public function index()
    {
        return view('after-login.keluar-lokal.index');
    }
    public function create()
    {
        return view('after-login.keluar-lokal.create');
    }
    public function edit()
    {
        return view('after-login.keluar-lokal.edit');
    }
    public function detail()
    {
        return view('after-login.keluar-lokal.detail');
    }
}

