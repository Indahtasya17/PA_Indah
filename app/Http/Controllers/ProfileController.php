<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('after-login.profile.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('profile')->with('success', 'Password berhasil diperbarui.');
    }
}
