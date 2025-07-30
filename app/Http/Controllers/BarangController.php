<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use App\Models\SupplierModel;
use Illuminate\Routing\Controller;

class BarangController extends Controller
{
    public function index()
    {
        $currentYear = now()->year;
        $start = Carbon::create($currentYear - 1, 1, 1)->startOfDay();

        $end = Carbon::create($currentYear, 1, 1)->startOfDay();

        $barangs = BarangModel::with([
            'items' => function ($query)use ($start, $end) {
                $query->whereHas('transaksi', function ($q)use($start, $end) {
                    $q->where('tipe_transaksi', 'keluar')->whereBetween('tanggal', [$start, $end]);
                });
            },
            'items.transaksi'
        ])->get();

        foreach ($barangs as $barang) {
            $penjualanMaksimal = $barang->items->max('stock');
            $totalTransaksi = $barang->items->count();
            $jumlahPenjualan = $barang->items->sum('stock');

            if ($totalTransaksi > 0) {
                $rata2Penjualan = $jumlahPenjualan / $totalTransaksi;
            } else {
                $rata2Penjualan = 0;
            }

            $safety_stock = round(($penjualanMaksimal - $rata2Penjualan) * $barang->waktu_tunggu);
            $barang->safety_stock = $safety_stock;
            $barang->rop = round(($barang->waktu_tunggu * $rata2Penjualan) + $safety_stock);

            $badgeColor = '';

            if ($barang->rop >= $barang->stok) {
                $badgeColor = 'warning';
            } else {
                $badgeColor = 'success';
            }

            if ($barang->stok == 0) {
                $badgeColor = 'danger';
            }

            $barang->badge_color = $badgeColor;
        }

        return view("after-login.barang.index", compact('barangs'));
    }

    public function getById($id)
    {
        $barang = BarangModel::find($id);
        return $barang;
    }

    public function create()
    {
        $suppliers = SupplierModel::all();
        return view("after-login.barang.create", compact('suppliers'));
    }
    public function edit($id)
    {
        $barang = BarangModel::findOrfail($id);
        $suppliers = SupplierModel::all();
        return view("after-login.barang.edit", compact('barang', 'suppliers'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required|unique:barangs,kode_barang,' . $id,
            'id_supplier' => 'required',
            'harga_jual' => 'required',
            'harga_beli' => 'required',
            'stok' => 'required',
            'waktu_tunggu' => 'required',

        ], [
            'nama_barang.required' => 'Nama harus di isi',
            'kode_barang.required' => 'Kode barang harus di isi',
            'kode_barang.unique' => 'Kode barang sudah ada',
            'id_supplier.required' => 'Supplier harus di isi',
            'harga_jual.required' => 'Harga jual harus di isi',
            'harga_beli.required' => 'Harga beli harus di isi',
            'stock.required' => 'Stock harus di isi',
            'waktu_tunggu.required' => 'Lead Time harus di isi',
        ]);

        $barang = BarangModel::findOrFail($id);
        $harga_beli = str_replace(['Rp', '.'], '', $request->harga_beli);
        $harga_jual = str_replace(['Rp', '.'], '', $request->harga_jual);
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'kode_barang' => $request->kode_barang,
            'id_supplier' => $request->id_supplier,
            'harga_jual' => $request->harga_jual,
            'harga_beli' => $request->harga_beli,
            'stok' => $request->stok, 
            'waktu_tunggu' => $request->waktu_tunggu,
        ]);

        return redirect()->route('barang')->with('success', 'Barang berhasil diubah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required|unique:barangs,kode_barang',
            'id_supplier' => 'required',
            'harga_jual' => 'required',
            'harga_beli' => 'required',
            'stok' => 'required',
            'waktu_tunggu' => 'required',

        ], [
            'nama_barang.required' => 'Nama harus di isi',
            'kode_barang.required' => 'Kode barang harus di isi',
            'kode_barang.unique' => 'Kode barang sudah ada',
            'supplier_id.required' => 'Supplier harus di isi',
            'harga_jual.required' => 'Harga jual harus di isi',
            'harga_beli.required' => 'Harga beli harus di isi',
            'stok.required' => 'Stock harus di isi',
            'waktu_tunggu.required' => 'Lead Time harus di isi',
        ]);

        $harga_beli = str_replace(['Rp', '.'], '', $request->harga_beli);
        $harga_jual = str_replace(['Rp', '.'], '', $request->harga_jual);

        BarangModel::create([
            'nama_barang' => $request->nama_barang,
            'kode_barang' => $request->kode_barang,
            'id_supplier' => $request->id_supplier,
            'harga_jual' => $request->harga_jual,
            'harga_beli' => $request->harga_beli,
            'stok' => $request->stok,
            'waktu_tunggu' => $request->waktu_tunggu,
        ]);

        return redirect()->route('barang')->with('success', 'Barang berhasil ditambahkan');
    }
    public function detail()
    {
        return view("after-login.barang.detail");
    }
    public function destroy($id)
    {
        try {
            $barang = BarangModel::findOrFail($id);
            $barang->delete();
            return redirect()->route('barang')->with('success', 'Barang berhasil dihapus');
        } catch (Exception $e) {
            if ($e->getCode() === '23000') {
                return redirect()->back()->with('error', 'Tidak dapat menghapus supplier karena masih digunakan di tabel barang.');
            }

            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus supplier.');
        }
    }
}
