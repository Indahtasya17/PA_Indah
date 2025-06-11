<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\FileModel;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\TransaksiBarangModel;
use Illuminate\Support\Facades\Storage;
use App\Models\TransaksiBarangItemModel;
use Illuminate\Validation\ValidationException;

class MasukLokalController extends Controller
{

    public function index()
    {
        $transaksis = TransaksiBarangModel::with(['items.barang'])->where('tipe_transaksi', 'masuk')->where('sumber_transaksi', 'lokal')->get();
        return view('after-login.masuk-lokal.index', compact('transaksis'));
    }


    public function create()
    {
        $barangs = BarangModel::all();
        return view('after-login.masuk-lokal.create', compact('barangs'));
    }
    public function edit($id)
    {
        $transaksi = TransaksiBarangModel::with(['items.barang'])->findOrFail($id);
        $barangs = BarangModel::all();
        return view('after-login.masuk-lokal.edit', compact('barangs','transaksi'));
    }
    public function detail()
    {
        return view('after-login.masuk-lokal.detail');
    }

    public function store(Request $request)
    {
        try {
            $request->validate(
                [
                    'file_uploads' => 'required|array|min:1',
                    'file_names' => 'required|array|min:1',
                    'tanggal' => 'required',
                    'no_polisi' => 'required',
                    'barang' => 'required|array|min:1',
                ],
                [
                    'file_uploads.required' => 'File harus di isi',
                    'file_names.required' => 'File harus di isi',
                    'tanggal.required' => 'Tanggal harus di isi',
                    'no_polisi.required' => 'No polisi harus di isi',
                    'barang.required' => 'Barang harus di isi.',
                ]
            );

            // Siapkan data untuk dimasukkan kedalam transaksi
            $total_tagihan = 0;

            $barangs = $request->barang;
            $jumlahs = $request->jumlah;
            $hargas = $request->harga;
            $satuans = $request->satuan;

            foreach ($barangs as $key => $barang) {
                $pengali = 1;

                if ($satuans[$key] === 'ton') {
                    $pengali = 1000;
                }

                $subtotal = $pengali * $hargas[$key] * $jumlahs[$key];

                $total_tagihan = $total_tagihan + $subtotal;
            }

            $tipe_transaksi = 'masuk';
            $sumber = 'lokal';
            $no_polisi = $request->no_polisi;
            $tanggal = $request->tanggal;
            $id_user = auth()->user()->id;

            DB::beginTransaction();

            // Masukkan kedalam transaksi
            $transaksi = TransaksiBarangModel::create([
                'id_user' => $id_user,
                'tanggal' => $tanggal,
                'total_tagihan' => $total_tagihan,
                'no_polisi' => $no_polisi,
                'tipe_transaksi' => $tipe_transaksi,
                'sumber_transaksi' => $sumber
            ]);

            if ($transaksi) {
                foreach ($barangs as $key => $barang) {
                    $pengali = 1;

                    if ($satuans[$key] === 'ton') {
                        $pengali = 1000;
                    }

                    $id_barang = $barang;
                    $harga = $hargas[$key];
                    $stock = $jumlahs[$key] * $pengali;
                    $subtotal = $pengali * $hargas[$key] * $jumlahs[$key];

                    // Tabel Transaksi Item
                    TransaksiBarangItemModel::create([
                        'id_transaksi_barang' => $transaksi->id,
                        'id_barang' => $id_barang,
                        'harga' => $harga,
                        'stock' => $stock,
                        'subtotal' => $subtotal
                    ]);
                }
            }
            // Tabel file
            foreach ($request->file_uploads as $key => $item) {
                $hapus_spasi_nama_file = str_replace(' ', '', $request->file_names[$key]);

                $filename = time() . '-' . $hapus_spasi_nama_file . '.' . $item->getClientOriginalExtension();

                Storage::putFileAs('lokal-masuk', $item, $filename);

                FileModel::create([
                    'id_transaksi_barang' => $transaksi->id,
                    'file' => $filename
                ]);
            }
            DB::commit();
            return redirect()->route('masuk-lokal')->with('success', 'Data berhasil ditambahkan');


        } catch (ValidationException $exception) {
            Log::info($exception->getMessage());
            DB::rollBack();
            return redirect()->back()->withErrors($exception->errors())->withInput();
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            DB::rollBack();
            return redirect()->back()->withErrors($exception->getMessage())->withInput();
        }
    }

}
