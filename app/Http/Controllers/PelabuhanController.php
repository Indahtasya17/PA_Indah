<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PelabuhanController extends Controller
{

    public function index()
    {
        return view('karyawan.index');
    }

    public function create()
    {
        return view('karyawan.create');
    }

    public function edit($id)
    {
        return view('karyawan.edit');
    }
}
