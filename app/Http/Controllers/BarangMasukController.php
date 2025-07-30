<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\FileModel;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TransaksiBarangModel;
use Illuminate\Support\Facades\Storage;
use App\Models\TransaksiBarangItemModel;
use Illuminate\Validation\ValidationException;

class BarangMasukController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->filter;

        $query = TransaksiBarangModel::with(['items.barang'])
            ->where('tipe_transaksi', 'masuk')->orderBy('created_at', 'desc');

        if ($filter != null) {

            $filters = ['import', 'lokal'];

            if (in_array($filter, $filters)) {
                $query = $query->where('sumber_transaksi', 'like', '%' . $filter . '%');
            }
        }

        $transaksis = $query->get();

        return view("after-login.barang-masuk.index", compact('transaksis'));
    }

    public function create()
    {
        $barangs = BarangModel::all();
        return view("after-login.barang-masuk.create", compact('barangs'));
    }

    public function edit($id)
    {
        $transaksi = TransaksiBarangModel::with(['items.barang', 'barang_masuk', 'file'])->findOrFail($id);
        $barangs = BarangModel::all();
        return view("after-login.barang-masuk.edit", compact('barangs', 'transaksi'));

    }

    public function detail($id)
    {
        $transaksi = TransaksiBarangModel::with(['items.barang', 'barang_masuk', 'file', 'import_file', 'barang_import_masuk'])->findOrFail($id);
        return view("after-login.barang-masuk.detail", compact('transaksi'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'tanggal' => 'required',
                'no_polisi' => 'required',
                'kontak_supir' => 'required',
                'barang' => 'required|array|min:1',
                'file_upload' => 'required|file',
            ], [
                'tanggal.required' => 'Tanggal masuk harus diisi',
                'no_polisi.required' => 'Nomor Polisi harus diisi',
                'kontak_supir.required' => 'Kontak harus diisi',
                'barang.required' => 'Barang harus diisi',
                'file_upload.required' => 'File harus diisi',
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
                'no_polisi' => strtoupper($request->no_polisi),
                'kontak_supir' => $request->kontak_supir,
                'tipe_transaksi' => 'masuk',
                'sumber_transaksi' => 'lokal'
            ]);

            foreach ($barangs as $key => $barang) {
                $pengali = ($satuans[$key] === 'ton') ? 1000 : 1;
                $stock = $jumlahs[$key] * $pengali;
                $subtotal = $stock * $hargas[$key];

                $updateBarang = BarangModel::findOrFail($barang);
                $hargaLama = $updateBarang->harga_beli;
                TransaksiBarangItemModel::create([
                    'id_transaksi_barang' => $transaksi->id,   
                    'id_barang' => $barang,
                    'harga' => $hargas[$key],
                    'harga_modal_lama' => $hargaLama,
                    'stock' => $stock,
                    'subtotal' => $subtotal
                ]);

                if ($hargaLama != $hargas[$key]) {
                    $jumlahAkhirHargaLama = $hargaLama * $updateBarang->stok;
                    $jumlahAkhirHargaBaru = $hargas[$key] * $stock;
                    $jumlahStock = $updateBarang->stok + $stock;
                    $hargaAkhir = ($jumlahAkhirHargaLama +  $jumlahAkhirHargaBaru) / $jumlahStock;

                    $updateBarang->harga_beli = $hargaAkhir;
                }

                $updateBarang->stok += $stock;
                $updateBarang->save();
            }

            $uploadedFile = $request->file('file_upload');
            $filename = time() . '-' . $uploadedFile->getClientOriginalName();
            Storage::putFileAs('barang-masuk', $uploadedFile, $filename);

            FileModel::create([
                'id_transaksi_barang' => $transaksi->id,
                'file' => $filename
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
            $request->validate([
                'tanggal' => 'required',
                'no_polisi' => 'required',
                'kontak_supir' => 'required',
                'barang' => 'required|array|min:1',
                'file_upload' => 'sometimes|file',
            ], [
                'tanggal.required' => 'Tanggal masuk harus diisi',
                'no_polisi.required' => 'Nomor Polisi harus diisi',
                'kontak_supir.required' => 'Kontak harus diisi',
                'barang.required' => 'Barang harus diisi',
            ]);

            DB::beginTransaction();

            $transaksi = TransaksiBarangModel::find($id);

            $barangs = $request->barang;
            $jumlahs = $request->jumlah;
            $hargas = $request->harga;
            $satuans = $request->satuan;

            $total_tagihan = 0;
            foreach ($barangs as $key => $barang) {
                $pengali = ($satuans[$key] === 'ton') ? 1000 : 1;
                $subtotal = $pengali * $hargas[$key] * $jumlahs[$key];
                $total_tagihan += $subtotal;
            }

            // Update transaksi
            $transaksi->update([
                'tanggal' => $request->tanggal,
                'total_tagihan' => $total_tagihan,
                'no_polisi' => strtoupper($request->no_polisi),
                'kontak_supir' => $request->kontak_supir,
            ]);

            // Simpan datanya yang akan dihapus
            $deletedItems = TransaksiBarangItemModel::where('id_transaksi_barang', $id)->get(); 

            // Hapus datanya
            TransaksiBarangItemModel::where('id_transaksi_barang', $id)->delete(); 

            // Update stock untuk mengurangkan data yang lama
            foreach ($deletedItems as $item) {
                $barang = BarangModel::findOrFail($item->id_barang);
                $barang->stok -= $item->stock;
                $barang->harga_beli = $item->harga_modal_lama;
                $barang->save();
            }

            // Simpan data baru
            foreach ($barangs as $key => $barang) {
                $pengali = ($satuans[$key] === 'ton') ? 1000 : 1;
                $stock = $jumlahs[$key] * $pengali;
                $subtotal = $stock * $hargas[$key];

                $updateBarang = BarangModel::findOrFail($barang);
                $hargaLama = $updateBarang->harga_beli;
                TransaksiBarangItemModel::create([
                    'id_transaksi_barang' => $transaksi->id,
                    'id_barang' => $barang,
                    'harga' => $hargas[$key],
                    'harga_modal_lama' => $hargaLama,
                    'stock' => $stock,
                    'subtotal' => $subtotal
                ]);

                if ($hargaLama != $hargas[$key]) {
                    $jumlahAkhirHargaLama = $hargaLama * $updateBarang->stok;
                    $jumlahAkhirHargaBaru = $hargas[$key] * $stock;
                    $jumlahStock = $updateBarang->stok + $stock;
                    $hargaAkhir = ($jumlahAkhirHargaLama +  $jumlahAkhirHargaBaru) / $jumlahStock;

                    $updateBarang->harga_beli = $hargaAkhir;
                }

                $updateBarang->stok += $stock;
                $updateBarang->save();
            }

            // Upload file jika ada
            if ($request->hasFile('file_upload')) {
                $uploadedFile = $request->file('file_upload');
                $filename = time() . '-' . $uploadedFile->getClientOriginalName();
                Storage::putFileAs('barang-masuk', $uploadedFile, $filename);

                // Hapus file lama jika perlu, lalu simpan yang baru
                FileModel::where('id_transaksi_barang', $transaksi->id)->delete();

                FileModel::create([
                    'id_transaksi_barang' => $transaksi->id,
                    'file' => $filename
                ]);
            }

            DB::commit();
            return redirect()->route('barang-masuk.index')->with('success', 'Data berhasil diperbarui');

        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage())->with('error', 'Terjadi kesalahan saat memperbarui data');
        }

    }

    public function destroy($id)
    {
        $barang_masuk = TransaksiBarangModel::findOrFail($id);
        $barang_masuk->delete();
        return redirect()->route('barang-masuk.index')->with('success', 'Data Berhasil Dihapus');
    }
}


