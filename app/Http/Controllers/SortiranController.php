<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\BarangModel;
use App\Models\SortirModel;
use App\Models\SortirsModel;
use Illuminate\Http\Request;

class SortiranController extends Controller
{
    public function index()
    {
        $sortirs = sortirsModel::all();
        return view('after-login.sortiran.index', compact('sortirs'));
    }
    public function create()
    {
        $barangs = BarangModel::all();
        return view('after-login.sortiran.create', compact('barangs'));
    }

    public function edit($id)
    {
        $barangs = BarangModel::all();
        $sortiran = SortirsModel::findOrFail($id);
        return view('after-login.sortiran.edit',compact('sortiran','barangs'));
    }
    public function detail()
    {
        return view('after-login.sortiran.detail');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required',
            'tanggal'=>'required',
            'jumlah_sortiran'=>'required',
            'satuan'=>'required',
            'jumlah_bagus'=>'required', 
            'jumlah_busuk'=>'required',
        ], [
            'id_barang.required' => 'Nama harus di isi',
            'tanggal.required' => 'Tanggal harus di isi',
            'jumlah_sortiran.required' => 'Jumlah Sortiranharus di isi',
            'satuan.required' => 'Satuan harus di isi',
            'jumlah_bagus.required' => 'Jumlah bagus harus di isi',
            'jumlah_busuk.required' => 'Jumlah rusak harus di isi',
        ]);

        SortirsModel::create([
            'id_barang' => $request->id_barang,
            'tanggal' => $request->tanggal,
            'jumlah_sortiran' => $request->jumlah_sortiran,
            'satuan' => $request->satuan,
            'jumlah_bagus' => $request->jumlah_bagus,
            'jumlah_busuk' => $request->jumlah_busuk,
        ]);

        return redirect()->route('sortiran')->with('success', 'Sortiran berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_barang' => 'required',
            'tanggal'=>'required',
            'jumlah_sortiran'=>'required',
            'satuan'=>'required',
            'jumlah_bagus'=>'required', 
            'jumlah_busuk'=>'required',

        ], [
            'id_barang.required' => 'Nama harus di isi',
            'tanggal.required' => 'Tanggal harus di isi',
            'jumlah_sortiran.required' => 'Jumlah Sortiranharus di isi',
            'satuan.required' => 'Satuan harus di isi',
            'jumlah_bagus.required' => 'Jumlah bagus harus di isi',
            'jumlah_busuk.required' => 'Jumlah rusak harus di isi',
        ]);

        $sortir = SortirsModel::findOrFail($id);
        $sortir->update([
            'id_barang' => $request->id_barang,
            'tanggal' => $request->tanggal,
            'jumlah_sortiran' => $request->jumlah_sortiran,
            'satuan' => $request->satuan,
            'jumlah_bagus' => $request->jumlah_bagus,
            'jumlah_busuk' => $request->jumlah_busuk,
        ]);

        return redirect()->route('sortiran')->with('success', 'Sortiran berhasil diubah');
    }

    public function destroy($id)
    {
        try {
            $sortir = SortirsModel::findOrFail($id);
            $sortir->delete();
            return redirect()->route('sortiran')->with('success', 'Sortiran berhasil dihapus');
        } catch (Exception $e) {
            if ($e->getCode() === '23000') {
                return redirect()->back()->with('error', 'Tidak dapat menghapus sortiran karena masih digunakan di tabel barang.');
            }

            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus sortiran.');
    }
    
}
}