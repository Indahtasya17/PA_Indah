<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use Illuminate\Http\Request;
use App\Models\KonfirmasiMasuk;
use App\Models\TransaksiBarangModel;

class KonfirmasiController extends Controller
{
    public function index()
    {
        $transaksis = TransaksiBarangModel::with(['items.barang', 'barang_import_masuk'])->where('tipe_transaksi', 'masuk')->where('sumber_transaksi', 'import')->orderBy('created_at', 'desc')->get();
        return view("after-login.konfirmasi.index", compact('transaksis'));
    }

    public function konfirmasi($id)
    {
        return view('after-login.konfirmasi.konfirmasi', compact('id'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'status' => 'required|string',
            'keterangan' => 'nullable|string'
        ]);

        $transaksi = TransaksiBarangModel::findOrFail($id);
        $transaksi->update([
            'status' => $request->status,
        ]);

        foreach ($transaksi->items as $item) {
            $barang = BarangModel::findOrFail($item->id_barang);
            $hargaLama = $barang->harga_beli;

            if ($hargaLama != $item->harga) {
                $jumlahAkhirHargaLama = $hargaLama * $barang->stok;
                $jumlahAkhirHargaBaru = $item->harga * $item->stock;
                $jumlahStock = $barang->stok + $item->stock;
                
                $hargaAkhir = ($jumlahAkhirHargaLama +  $jumlahAkhirHargaBaru) / $jumlahStock;
                
                $barang->harga_beli = $hargaAkhir;
            }
            $barang->stok += $item->stock;
            $barang->save();
        }

        $konfirmasi = KonfirmasiMasuk::create([
            'id_transaksi_barang' => $transaksi->id,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan ?? null,
            'status' => $request->status
        ]);

        return redirect()->route('konfirmasi.index')->with('success', 'Status berhasil diperbarui');
    }

}
