<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use App\Models\SupplierModel;
use Illuminate\Routing\Controller;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = BarangModel::all();

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
        return view("after-login.barang.create",compact('suppliers'));

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
            'id_supplier' => 'required',
            'harga_jual' => 'required',
            'harga_beli' => 'required',
            'stok' => 'required',
            'minimum_stok' => 'required',
            'satuan' => 'required',
        ], [
            'nama_barang.required' => 'Nama harus di isi',
            'id_supplier.required' => 'Supplier harus di isi',
            'harga_jual.required' => 'Harga jual harus di isi',
            'harga_beli.required' => 'Harga beli harus di isi',
            'stock.required' => 'Stock harus di isi',
            'minimum_stok.required' => 'minimum stok harus di isi',
            'satuan.required' => 'Satuan harus di isi',
        ]);

        $barang = BarangModel::findOrFail($id);
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'id_supplier' => $request->id_supplier,
            'harga_jual' => $request->harga_jual,
            'harga_beli' => $request->harga_beli,
            'stok' => $request->stok,
            'minimum_stok' => $request->minimum_stok,
            'satuan' => $request->satuan
        ]);

        return redirect()->route('barang')->with('success', 'Barang berhasil diubah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'id_supplier' => 'required',
            'harga_jual' => 'required',
            'harga_beli' => 'required',
            'stok' => 'required',
            'minimum_stok' => 'required',
            'satuan' => 'required',

        ], [
            'nama_barang.required' => 'Nama harus di isi',
            'supplier_id.required' => 'Supplier harus di isi',
            'harga_jual.required' => 'Harga jual harus di isi',
            'harga_beli.required' => 'Harga beli harus di isi',
            'stok.required' => 'Stock harus di isi',
            'minimum_stok.required' => 'minimum stok harus di isi',
            'satuan.required' => 'Satuan harus di isi',
        ]);

        BarangModel::create([
            'nama_barang' => $request->nama_barang,
            'id_supplier' => $request->id_supplier,
            'harga_jual' => $request->harga_jual,
            'harga_beli' => $request->harga_beli,
            'stok' => $request->stok,
            'minimum_stok' => $request->minimum_stok,
            'satuan' => $request->satuan
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
