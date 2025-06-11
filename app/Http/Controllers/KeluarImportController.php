<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeluarImportController extends Controller
{
    public function index()
    {
        return view('after-login.keluar-import.index');
    }
    public function create()
    {
        return view('after-login.keluar-import.create');
    }
    public function edit()
    {
        return view("after-login.keluar-import.edit");
    }
    public function detail()
    {
        return view("after-login.keluar-import.detail");
    }
}
