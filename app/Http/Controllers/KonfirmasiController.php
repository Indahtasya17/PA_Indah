<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiBarangModel;

class KonfirmasiController extends Controller
{
    public function index()
    {
        $transaksis = TransaksiBarangModel::with(['items.barang', 'barang_import_masuk'])->where('tipe_transaksi', 'masuk')->where('sumber_transaksi', 'import')->get();
        return view("after-login.konfirmasi.index", compact('transaksis'));
    }   

    public function konfirmasi()
    {
        return view("after-login.konfirmasi.konfirmasi");
    }

    public function store(Request $request)
    {

    }
}
