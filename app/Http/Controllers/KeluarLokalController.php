<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TransaksiBarangModel;
use App\Models\TransaksiBarangItemModel;
use App\Models\BarangKeluarCustomerModel;
use Dotenv\Exception\ValidationException;

class KeluarLokalController extends Controller
{
    public function index()
    {
        $transaksis = TransaksiBarangModel::with(['items.barang', 'barang_keluar_customer'])->where('tipe_transaksi', 'keluar')->where('sumber_transaksi', 'lokal')->get();
        return view('after-login.keluar-lokal.index',compact('transaksis'));
    }
    public function create()
    {
    
        $barangs = BarangModel::all();
        return view('after-login.keluar-lokal.create', compact('barangs'));
    }
    public function edit($id)
    {
        $transaksi = TransaksiBarangModel::with(['items.barang', 'barang_keluar_customer'])->findOrFail($id);
        $barangs = BarangModel::all();
        return view('after-login.keluar-lokal.edit',compact('barangs','transaksi'));
    }
    public function detail()
    {
        return view('after-login.keluar-lokal.detail');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        try {
            $request->validate([
                'no_polisi' => 'required',
                'tanggal' => 'required',
                'nama_customer' => 'required',
                
            ], [
                'no_polisi.required' => 'No polisi harus di isi',
                'tanggal.required' => 'Tanggal keluar harus di isi',
                'nama_customer.required' => 'Nama customer harus di isi',
                
            ]);
            //siapkan data untuk dimasukan kedalam transaksi
            $total_tagihan = 0;

            $barangs = $request->barang;
            $jumlahs = $request->jumlah;
            $hargas = $request->harga;
            $satuans = $request->satuan;

            foreach ($barangs as $key => $barang) {
                $pengali = 1;
                if ($satuans[$key] === "ton") {
                    $pengali = 1000;
                }
                $subtotal = $hargas[$key] * $jumlahs[$key] * $pengali;

                $total_tagihan = $total_tagihan + $subtotal;
            }

            $tipe_transaksi = "keluar";
            $sumber_transaksi = "lokal";
            $no_polisi = $request->no_polisi;
            $tanggal = $request->tanggal;
            $nama_customer = $request->nama_customer;

            DB::beginTransaction();

            $transaksi = TransaksiBarangModel::create([
                'id_user' => auth()->user()->id,
                'tipe_transaksi' => $tipe_transaksi,
                'sumber_transaksi' => $sumber_transaksi,
                'no_polisi' => $no_polisi,
                'tanggal' => $tanggal,
                'nama_customer' => $nama_customer,
                'total_tagihan' => $total_tagihan,
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

            //tabel barang keluar model
            BarangKeluarCustomerModel::create([
                'id_transaksi_barang' => $transaksi->id,
                'nama_customer' => $request->nama_customer,
            ]);

            DB::commit();

            return redirect()->route('keluar-lokal.index')->with('success', 'Data berhasil disimpan');

        } catch (ValidationException $exception) {
            DB::rollBack();
            return redirect()->back()->withErrors($exception->errors())->withInput();
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data');
        }
        }
}

