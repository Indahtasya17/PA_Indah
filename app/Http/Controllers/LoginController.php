<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginPage()
    {
        return view ('authentication.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => "required|string",
            'password' => "required|string"
        ]);

        $credentials = $request->only([
            'username',
            'password'
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('pelabuhan');
        }
        return redirect()->route('login');
    }
    public function logout(Request$request)
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
