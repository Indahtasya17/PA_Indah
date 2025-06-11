<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use Illuminate\Http\Request;
use App\Models\PelabuhanModel;
use Illuminate\Support\Facades\Storage;

class PelabuhanController extends Controller
{

    public function index()
    {
        $pelabuhan = PelabuhanModel::all();
        return view('after-login.pelabuhan.index', compact('pelabuhan'));
    }
    public function create()
    {
        $barangs = BarangModel::all();
        return view('after-login.pelabuhan.create', compact('barangs'));
    }
    public function edit($id)
    {
        $pelabuhan = PelabuhanModel::findOrFail($id);
        $barangs = BarangModel::all();
        return view('after-login.pelabuhan.edit', compact('pelabuhan', 'barangs'));
    }
    public function detail($id)
    {
        $pelabuhan = PelabuhanModel::findOrFail($id);
        return view('after-login.pelabuhan.detail', compact('pelabuhan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required',
            'tanggal' => 'required',
            'no_polisi' => 'required',
            'jumlah_barang' => 'required',
            'jumlah_container' => 'required',
            'no_container' => 'required',
            'kontak' => 'required',
            'file' => 'required',
        ]);
        $file = $request->file('file');
        $namaFile = time() . '_' . $file->getClientOriginalName();
        $pelabuhan = PelabuhanModel::create([
            'id_barang' => $request->id_barang,
            'tanggal' => $request->tanggal,
            'no_polisi' => $request->no_polisi,
            'jumlah_barang' => $request->jumlah_barang,
            'jumlah_container' => $request->jumlah_container,
            'no_container' => $request->no_container,
            'kontak' => $request->kontak,
            'file' => $namaFile
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
            'no_polisi' => 'required',
            'jumlah_barang' => 'required',
            'jumlah_container' => 'required',
            'no_container' => 'required',
            'kontak' => 'required',
            'file' => 'sometimes',
        ], [
            'id_barang.required' => 'Barang harus di isi',
            'tanggal.required' => 'Tanggal harus di isi',
            'no_polisi.required' => 'No polisi harus di isi',
            'jumlah_barang.required' => 'Jumlah barang harus di isi',
            'jumlah_container.required' => 'Jumlah container harus di isi',
            'no_container.required' => 'No container harus di isi',
            'kontak.required' => 'Kontak harus di isi',
        ]);

        $pelabuhan = PelabuhanModel::findOrFail($id);
        $pelabuhan->id_barang = $request->id_barang;
        $pelabuhan->tanggal = $request->tanggal;
        $pelabuhan->no_polisi = $request->no_polisi;
        $pelabuhan->jumlah_barang = $request->jumlah_barang;
        $pelabuhan->jumlah_container = $request->jumlah_container;
        $pelabuhan->no_container = $request->no_container;
        $pelabuhan->kontak = $request->kontak;

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
        $pelabuhan = PelabuhanModel::findOrFail($id);
        $pelabuhan->delete();
        return redirect()->route('pelabuhan')->with('success', 'Data berhasil dihapus');
    }
}
