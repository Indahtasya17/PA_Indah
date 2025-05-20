<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasukLokalController extends Controller
{
    
        public function index()
        {
            return view('after-login.masuk-lokal.index');
        }
        public function create()
        {
            return view('after-login.masuk-lokal.create');
        }
        public function edit()
        {
            return view('after-login.masuk-lokal.edit');
        }
        public function detail()
        {
            return view('after-login.masuk-lokal.detail');
        }
    
}
