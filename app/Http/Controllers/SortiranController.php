<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SortiranController extends Controller
{
    public function index()
    {
        return view('after-login.sortiran.index');
    }
    public function create()
    {
        return view('after-login.sortiran.create');
    }
    public function edit()
    {
        return view('after-login.sortiran.edit');
    }
    public function detail()
    {
        return view('after-login.sortiran.detail');
    }
}
