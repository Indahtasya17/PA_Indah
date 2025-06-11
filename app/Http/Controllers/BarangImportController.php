<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\TransaksiBarangModel;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BarangImportController extends Controller
{
    public function index()
    {
        return view("after-login.barang-import.index");
    }
    public function create()
    {
        $barangs = BarangModel::all();
        return view("after-login.barang-import.create", compact('barangs'));
    }
    public function edit()
    {
        $barangs = BarangModel::all();
        return view("after-login.barang-import.edit", compact('barangs'));
    }
    public function detail()
    {
        return view("after-login.barang-import.detail");
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'files' => 'required|array|min:1',
                'nopol' => 'required',
                'tanggal_masuk' => 'required',
                'no_invoice' => 'required',
                'no_container' => 'required',
                'barang' => 'required|array|min:1',
            ]);

            // Masukkan kedalam transaction
            $grandTotal = 0;

            foreach ($request->barang as $barang) {
                $pengali = 1;
                if ($request->satuan === 'ton') {
                    $pengali = 1000;
                } 
                $grandTotal += $barang['harga'] * $barang['stock'] * $pengali;
            }

            $transaksi = TransaksiBarangModel::create([
                ''
            ]);
            // Masukkan kedalam detail transaksi
            // Masukkan kedalam import files

        } catch (ValidationException $exception) {
            return redirect()->back()->withErrors($exception->errors())->withInput();
        }
    }
}
