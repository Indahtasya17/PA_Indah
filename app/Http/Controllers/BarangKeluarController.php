<?php


namespace App\Http\Controllers;
use Exception;
use App\Models\BarangModel;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TransaksiBarangModel;
use App\Models\TransaksiBarangItemModel;
use App\Models\BarangKeluarCustomerModel;
use Illuminate\Validation\ValidationException;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $transaksis = TransaksiBarangModel::with(['items.barang', 'barang_keluar_customer'])->where('tipe_transaksi', 'keluar')->orderBy('created_at', 'desc')->get();
        return view('after-login.barang-keluar.index', compact('transaksis'));
    }
    
    public function create()
    {
        $barangs = BarangModel::all();
        return view('after-login.barang-keluar.create', compact('barangs'));
        
    }

    public function edit($id)
    {
        $transaksi = TransaksiBarangModel::find($id);
        $barangs = BarangModel::all();

        return view("after-login.barang-keluar.edit", compact('barangs', 'transaksi'));
    }
    public function detail($id)
    {
        $transaksi = TransaksiBarangModel::find($id);
        return view("after-login.barang-keluar.detail", compact('transaksi'));
    }


    public function store(Request $request)
    {
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
                'no_polisi' => strtoupper($no_polisi),
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

                    // Tabel Barang
                    $barang = BarangModel::find($id_barang);
                    $barang->stok -= $stock; // mengurangi stok di data barang    
                    $barang->save();
                }
            }

            //tabel barang keluar model
            BarangKeluarCustomerModel::create([
                'id_transaksi_barang' => $transaksi->id,
                'nama_customer' => $request->nama_customer,
            ]);

            DB::commit();

            return redirect()->route('barang-keluar.index')->with('success', 'Data Berhasil Ditambahkan');

        } catch (ValidationException $exception) {
            DB::rollBack();
            return redirect()->back()->withErrors($exception->errors())->withInput();
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data');
        }
    }

    public function update(Request $request, $id)
    {
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
                'kontak_supir' => $request->kontak,
            ]);

            // Simpan dulu
            $deletedItems = TransaksiBarangItemModel::where('id_transaksi_barang', $id)->get();

            // Hapus dan update item lama
            TransaksiBarangItemModel::where('id_transaksi_barang', $id)->delete();

            // Normalkan dulu data barang
            foreach ($deletedItems as $item) {
                $barang = BarangModel::find($item->id_barang);
                $barang->stok += $item->stock;
                $barang->save();
            }

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

                // Masukkan stock baru
                $barang = BarangModel::find($barang);
                $barang->stok -= $stock;
                $barang->save();
            }

            DB::commit();

            return redirect()->route('barang-keluar.index')->with('success', 'Data Berhasil Diubah');
        } catch (ValidationException $exception) {
            DB::rollBack();
            return redirect()->back()->withErrors($exception->errors())->withInput();
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengubah data');
        }
    }

    public function destroy($id)
    {
        $barang_keluar = TransaksiBarangModel::findOrFail($id);
        $barang_keluar->delete();
        return redirect()->route('barang-keluar.index')->with('success', 'Data berhasil dihapus');
    }

}

