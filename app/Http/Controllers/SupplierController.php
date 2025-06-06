<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupplierModel;
use Exception;
use Illuminate\Validation\ValidationException;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers =  SupplierModel::with('barangs')->get();
        return view('after-login.supplier.index', compact('suppliers'));
    }
    public function create()
    {
        return view('after-login.supplier.create');
    }
    public function edit($id)
    {
        $supplier = SupplierModel::findOrFail($id);
        return view('after-login.supplier.edit', compact('supplier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kontak' => 'required',
            'alamat' => 'required',
        ], [
            'nama.required' => 'Nama harus di isi',
            'kontak.required' => 'Kontak harus di isi',
            'alamat.required' => 'Alamat harus di isi',
        ]);

        SupplierModel::create([
            'nama' => $request->nama,
            'kontak' => $request->kontak,
            'alamat' => $request->alamat
        ]);

        return redirect()->route('supplier')->with('success', 'Supplier berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'kontak' => 'required',
            'alamat' => 'required',
        ], [
            'nama.required' => 'Nama harus di isi',
            'kontak.required' => 'Kontak harus di isi',
            'alamat.required' => 'Alamat harus di isi',
        ]);

        $supplier = SupplierModel::findOrFail($id);
        $supplier->update([
            'nama' => $request->nama,
            'kontak' => $request->kontak,
            'alamat' => $request->alamat
        ]);

        return redirect()->route('supplier')->with('success', 'Supplier berhasil diubah');
    }

    public function destroy($id)
    {
        try {
            $supplier = SupplierModel::findOrFail($id);
            $supplier->delete();
            return redirect()->route('supplier')->with('success', 'Supplier berhasil dihapus');
        } catch (Exception $e) {
            if ($e->getCode() === '23000') {
                return redirect()->back()->with('error', 'Tidak dapat menghapus supplier karena masih digunakan di tabel barang.');
            }

            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus supplier.');
        }
    }
}
