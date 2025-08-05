<?php

namespace App\Http\Controllers;


use App\Models\MitraModel;
use Illuminate\Http\Request;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mitras = MitraModel::all();
        return view('after-login.mitra.index', compact('mitras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mitras = MitraModel::all();
        return view('after-login.mitra.create', compact('mitras'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kontak' => 'required',
            'alamat' => 'required',
        ]);

        MitraModel::create($request->all());
        return redirect()->route('mitra.index')->with('success', 'Data mitra berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mitra = MitraModel::findOrFail($id);
        return view('after-login.mitra.edit', compact('mitra'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',
            'kontak' => 'required',
            'alamat' => 'required',
        ]);

        $mitra = MitraModel::findOrFail($id);
        $mitra->update($request->all());
        return redirect()->route('mitra.index')->with('success', 'Data mitra berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        MitraModel::destroy($id);
        return redirect()->route('mitra.index')->with('success', 'Data mitra berhasil dihapus.');
    }
}
