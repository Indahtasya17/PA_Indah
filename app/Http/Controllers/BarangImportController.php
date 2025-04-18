<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangImportController extends Controller
{
    public function index()
    {
        return view("after-login.barang-import.index");
    }
    public function create()
    {
        return view("after-login.barang-import.create");
    }
}
