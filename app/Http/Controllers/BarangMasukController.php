<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\FileModel;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TransaksiBarangModel;
use App\Models\BarangImportMasukModel;
use Illuminate\Support\Facades\Storage;
use App\Models\TransaksiBarangItemModel;
use Illuminate\Validation\ValidationException;

class BarangMasukController extends Controller
{
    public function index()
    {
        $transaksis = TransaksiBarangModel::with(['items.barang', 'barang_masuk'])
            ->where('tipe_transaksi', 'masuk')
            ->get();

        return view("after-login.barang-masuk.index", compact('transaksis'));
    }

    public function create()
    {
        $barangs = BarangModel::all();
        return view("after-login.barang-masuk.create", compact('barangs'));
    }

    public function edit($id)
    {
        $transaksi = TransaksiBarangModel::with(['items.barang', 'barang_masuk'])->findOrFail($id);
        $barangs = BarangModel::all();
        return view("after-login.barang-masuk.edit", compact('barangs', 'transaksi'));
    }

    public function detail()
    {
        return view("after-login.barang-masuk.detail");
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'files' => 'required|array|min:1',
                'no_polisi' => 'required',
                'tanggal' => 'required',
                'no_invoice' => 'required',
                'no_container' => 'required',
                'barang' => 'required|array|min:1',
            ], [
                'files.required' => 'File harus diisi',
                'no_polisi.required' => 'No polisi harus diisi',
                'tanggal.required' => 'Tanggal masuk harus diisi',
                'no_invoice.required' => 'No invoice harus diisi',
                'no_container.required' => 'No container harus diisi',
                'barang.required' => 'Barang harus diisi',
            ]);

            $total_tagihan = 0;

            $barangs = $request->barang;
            $jumlahs = $request->jumlah;
            $hargas = $request->harga;
            $satuans = $request->satuan;

            foreach ($barangs as $key => $barang) {
                $pengali = ($satuans[$key] === 'ton') ? 1000 : 1;
                $subtotal = $pengali * $hargas[$key] * $jumlahs[$key];
                $total_tagihan += $subtotal;
            }

            DB::beginTransaction();

            $transaksi = TransaksiBarangModel::create([
                'id_user' => auth()->user()->id,
                'tanggal' => $request->tanggal,
                'total_tagihan' => $total_tagihan,
                'no_polisi' => $request->no_polisi,
                'tipe_transaksi' => 'masuk',
                'sumber_transaksi' => 'lokal'
            ]);

            foreach ($barangs as $key => $barang) {
                $pengali = ($satuans[$key] === 'ton') ? 1000 : 1;
                $stock = $jumlahs[$key] * $pengali;
                $subtotal = $stock * $hargas[$key];

                TransaksiBarangItemModel::create([
                    'id_transaksi_barang' => $transaksi->id,
                    'id_barang' => $barang,
                    'harga' => $hargas[$key],
                    'stock' => $stock,
                    'subtotal' => $subtotal
                ]);
            }

            foreach ($request->files as $key => $item) {
                $nama_file = str_replace(' ', '', $request->file_names[$key]);
                $filename = time() . '-' . $nama_file . '.' . $item->getClientOriginalExtension();
                Storage::putFileAs('barang-masuk', $item, $filename);

                FileModel::create([
                    'id_transaksi_barang' => $transaksi->id,
                    'file' => $filename
                ]);
            }

            BarangMasukModel::create([
                'id_transaksi_barang' => $transaksi->id,
                'no_invoice' => $request->no_invoice,
                'no_container' => $request->no_container
            ]);

            DB::commit();

            return redirect()->route('barang-masuk.index')->with('success', 'Data berhasil ditambahkan');
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage())->with('error', 'Terjadi kesalahan saat menambahkan data');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'files' => 'required|array|min:1',
                'no_polisi' => 'required',
                'tanggal' => 'required',
                'no_invoice' => 'required',
                'no_container' => 'required',
                'barang' => 'required|array|min:1',
            ]);

            $transaksi = TransaksiBarangModel::findOrFail($id);
            $transaksi->update([
                'no_polisi' => $request->no_polisi,
                'tanggal' => $request->tanggal,
            ]);

            TransaksiBarangItemModel::where('id_transaksi_barang', $id)->delete();

            $total_tagihan = 0;
            foreach ($request->barang as $key => $id_barang) {
                $jumlah = $request->jumlah[$key];
                $harga = $request->harga[$key];
                $satuan = $request->satuan[$key];
                $pengali = ($satuan === 'ton') ? 1000 : 1;

                $stock = $jumlah * $pengali;
                $subtotal = $stock * $harga;
                $total_tagihan += $subtotal;

                TransaksiBarangItemModel::create([
                    'id_transaksi_barang' => $transaksi->id,
                    'id_barang' => $id_barang,
                    'harga' => $harga,
                    'stock' => $stock,
                    'subtotal' => $subtotal,
                ]);
            }

            $transaksi->update(['total_tagihan' => $total_tagihan]);

            $barang_masuk = BarangMasukModel::where('id_transaksi_barang', $id)->first();
            $barang_masuk->update([
                'no_invoice' => $request->no_invoice,
                'no_container' => $request->no_container,
            ]);

            DB::commit();

            return redirect()->route('barang-masuk.index')->with('success', 'Data berhasil diperbarui');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }
    
}
