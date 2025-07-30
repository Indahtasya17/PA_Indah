<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('after-login.user.index', compact('users'));
    }

    // Tampilkan form tambah karyawan
    public function create()
    {
        $roles = Role::whereNot('name', 'owner')->get();
        return view('after-login.user.create',compact('roles'));
    }

    // Simpan data karyawan baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->username)
        ]);

        $user->assignRole('karyawan-gudang');

        return redirect()->route('after-login.user.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    // Tampilkan form edit karyawan
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::whereNot('name', 'owner')->get();
        return view('after-login.user.edit', compact('user','roles'));
    }

    // Simpan perubahan data karyawan
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,' . $user->id,
        ]);

        $user->name = $request->name;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'Karyawan berhasil diperbarui.');
    }
}
