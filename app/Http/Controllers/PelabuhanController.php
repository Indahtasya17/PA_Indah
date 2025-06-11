<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\TransaksiBarangModel;
use Illuminate\Http\Request;
use App\Models\PelabuhanModel;
use Illuminate\Support\Facades\Storage;

class PelabuhanController extends Controller
{

    public function index()
    {
        $pelabuhan = TransaksiBarangModel::all();
        return view('after-login.pelabuhan.index', compact('pelabuhan'));
    }
    public function create()
    {
        $barangs = BarangModel::all();
        return view('after-login.pelabuhan.create', compact('barangs'));
    }

    public function edit($id)
    {
        $barang = TransaksiBarangModel::findOrFail($id);
        $barangs = BarangModel::all();
        return view('after-login.pelabuhan.edit', compact( 'barangs'));
    }
    public function detail($id)
    {
        $barang = TransaksiBarangModel::findOrFail($id);
        return view('after-login.pelabuhan.detail', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required',
            'tanggal' => 'required',
            'jumlah_barang' => 'required',
            'satuan' => 'required',
            'no_invoice' => 'required',
            'no_container' => 'required',
            'no_polisi' => 'required',
            'kontak' => 'required',
            'harga_beli' => 'required',
            'file' => 'file|mimes:pdf,jpg,jpeg,png,doc,docx|max:2048',
            'id_user' => 'required'
        ]);
        $file = $request->file('file');
        $namaFile = time() . '_' . $file->getClientOriginalName();
        $pelabuhan = TransaksiBarangModel::create([
            'id_barang' => $request->id_barang,
            'tanggal' => $request->tanggal,
            'jumlah_barang' => $request->jumlah_barang,
            'satuan' => $request->satuan,
            'no_invoice' => $request->no_invoice,
            'no_container' => $request->no_container,
            'no_polisi' => $request->no_polisi,
            'kontak' => $request->kontak,
            'harga_beli' => $request->harga_beli,
            'file' => $namaFile,
            'id_user' => $request->id_user
        ]);

        if ($pelabuhan) {
            Storage::putFileAs('pelabuhan', $file, $namaFile);
        }

        return redirect()->route('pelabuhan')->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_barang' => 'required',
            'tanggal' => 'required',
            'jumlah_barang' => 'required',
            'satuan' => 'required',
            'no_invoice' => 'required',
            'no_container' => 'required',
            'no_polisi' => 'required',
            'kontak' => 'required',
            'harga_beli' => 'required',
            'file' => 'required',
        ], [
            'id_barang.required' => 'Barang harus di isi',
            'tanggal.required' => 'Tanggal harus di isi',
            'jumlah_barang.required' => 'Jumlah barang harus di isi',
            'satuan.required' => 'Satuan harus di isi',
            'no_invoice.required' => 'No invoice harus di isi',
            'no_container.required' => 'No container harus di isi',
            'no_polisi.required' => 'No polisi harus di isi',
            'kontak.required' => 'Kontak harus di isi',
            'harga_beli.required' => 'Harga beli harus di isi',
            'file.required'=> '',
        ]);

        $pelabuhan = TransaksiBarangModel::findOrFail($id);
        $pelabuhan->id_barang = $request->id_barang;
        $pelabuhan->tanggal = $request->tanggal;
        $pelabuhan->jumlah_barang = $request->jumlah_barang;
        $pelabuhan->satuan = $request->satuan;
        $pelabuhan->no_invoice = $request->no_invoice;
        $pelabuhan->no_container = $request->no_container;
        $pelabuhan->no_polisi = $request->no_polisi;
        $pelabuhan->kontak = $request->kontak;
        $pelabuhan->harga_beli = $request->harga_beli;
        $pelabuhan->id_user = $request->id_user;

        if ($request->has('file')) {
            $file = $request->file('file');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $pelabuhan->file = $namaFile;
        }

        if ($pelabuhan->save()) {
            if ($request->has('file')) {
                Storage::putFileAs('pelabuhan', $file, $namaFile);
            }
        }

        return redirect()->route('pelabuhan')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $pelabuhan = TransaksiBarangModel::findOrFail($id);
        $pelabuhan->delete();
        return redirect()->route('pelabuhan')->with('success', 'Data berhasil dihapus');
    }
}
