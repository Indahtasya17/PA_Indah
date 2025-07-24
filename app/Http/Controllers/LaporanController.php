<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\BarangModel;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TransaksiBarangModel;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $transaksis = $this->getTransaksis($request);

        $barangs = BarangModel::all();

        return view("after-login.laporan.index", compact('transaksis', 'barangs'));
    }

    public function print(Request $request)
    {
        $transaksis = $this->getTransaksis($request);

        $kategori = $request->kategori;
        $id_barang = $request->id_barang;
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;

        $transaksis = TransaksiBarangModel::query();

        if ($kategori) {
            $transaksis->where('tipe_transaksi', $kategori);
        }

        if ($id_barang) {
            $transaksis->whereHas('items', function ($q) use ($id_barang) {
                $q->where('id_barang', $id_barang);
            });
        }

        if ($tanggal_awal && $tanggal_akhir) {
            $transaksis->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir]);
        }

        $transaksis = $transaksis->get();

        $pdf = Pdf::loadView('after-login.laporan.print', compact('transaksis', 'kategori'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('laporan-barang.pdf');

    }

    private function getTransaksis($request)
    {
        $kategori = $request->get('kategori');
        $id_barang = $request->get('id_barang');
        $tanggal_awal = $request->get('tanggal_awal');
        $tanggal_akhir = $request->get('tanggal_akhir');

        $transaksis = TransaksiBarangModel::query();

        if ($kategori != null) {
            $transaksis->where('tipe_transaksi', $kategori);
        }

        if ($id_barang != null) {
            $transaksis->whereHas('items', function ($query) use ($id_barang) {
                $query->where('id_barang', $id_barang);
            });
        }


        if ($tanggal_awal != null && $tanggal_akhir != null) {
            // dd($tanggal_akhir, $tanggal_awal);
            $transaksis->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir]);
        }

        $transaksis = $transaksis->get();

        return $transaksis;
    }
}
