<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use Exception;
use Illuminate\Http\Request;
use App\Models\PelabuhanModel;
use App\Models\ImportFileModel;
use Illuminate\Support\Facades\DB;
use App\Models\TransaksiBarangModel;
use App\Models\BarangImportMasukModel;
use Illuminate\Support\Facades\Storage;
use App\Models\TransaksiBarangItemModel;
use Log;

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
        return view('after-login.pelabuhan.edit', compact('barangs'));
    }
    public function detail($id)
    {
        $barang = TransaksiBarangModel::findOrFail($id);
        return view('after-login.pelabuhan.detail', compact('barang'));
    }

    public function store(Request $request)
    {
        try {
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
                'sales_contract' => 'required',
                'invoice' => 'required',
                'packing_list' => 'required',
                'bill_of_loading' => 'required',
                'phytosanitary_certificate' => 'required',
                'health_certificate' => 'required',
                'fumigation_certificate' => 'required',
                'certificate_of_origin' => 'required',
                'prior_notice' => 'required',
                'insurance' => 'required',
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
                'sales_contract.required' => 'Sales contract harus di isi',
                'invoice.required' => 'Invoice harus di isi',
                'packing_list.required' => 'Packing list harus di isi',
                'bill_of_loading.required' => 'Bill of loading harus di isi',
                'phytosanitary_certificate.required' => 'Phytosanitary certificate harus di isi',
                'health_certificate.required' => 'Health certificate harus di isi',
                'fumigation_certificate.required' => 'Fumigation certificate harus di isi',
                'certificate_of_origin.required' => 'Certificate of origin harus di isi',
                'prior_notice.required' => 'Prior notice harus di isi',
                'insurance.required' => 'Insurance harus di isi',
            ]);

            DB::beginTransaction();

            $transaksiData = [
                'id_barang' => $request->id_barang,
                'tanggal' => $request->tanggal,
                'satuan' => $request->satuan,
                'no_polisi' => $request->no_polisi,
                'id_user' => auth()->user()->id,
                'tipe_transaksi' => 'masuk',
                'sumber_transaksi' => 'import',
            ];

            $pengali = $request->satuan === "ton" ? 1000 : 1;
            $subtotal = $pengali * $request->harga_beli * $request->jumlah_barang;
            $transaksiData['total_tagihan'] = $subtotal;

            $newTransaksi = TransaksiBarangModel::create($transaksiData);

            Log::info($newTransaksi);

            // Insert into transaksi barang items
            $transaksiBarangItemData = [
                'id_transaksi_barang' => $newTransaksi->id,
                'id_barang' => $request->id_barang,
                'harga' => $request->harga_beli,
                'stock' => $request->jumlah_barang * $pengali,
                'subtotal' => $subtotal,
            ];

            $trxItem = TransaksiBarangItemModel::create($transaksiBarangItemData);

            Log::info($trxItem);

            // Insert into barang import masuk
            $barangImportMasukData = [
                'id_transaksi_barang' => $newTransaksi->id,
                'no_invoice' => $request->no_invoice,
                'no_container' => $request->no_container,
            ];

            $import = BarangImportMasukModel::create($barangImportMasukData);

            Log::info($import);

            // Prepare filename on arrays
            $importData = [
                'id_transaksi_barang' => $newTransaksi->id,
                'tanggal' => $newTransaksi->tanggal,
                'sales_contract' => $this->uploadFile($request->sales_contract, 'sales-contract'),
                'invoice' => $this->uploadFile($request->invoice, 'invoice'),
                'packing_list' => $this->uploadFile($request->packing_list, 'packing-list'),
                'bill_of_loading' => $this->uploadFile($request->bill_of_loading, 'bill-of-loading'),
                'phytosanitary_certificate' => $this->uploadFile($request->phytosanitary_certificate, 'phytosanitary-certificate'),
                'health_certificate' => $this->uploadFile($request->health_certificate, 'health-certificate'),
                'fumigation_certificate' => $this->uploadFile($request->fumigation_certificate, 'fumigation_certificate'),
                'certificate_of_origin' => $this->uploadFile($request->certificate_of_origin, 'certificate-of-origin'),
                'prior_notice' => $this->uploadFile($request->prior_notice, 'prior-nootice'),
                'insurance' => $this->uploadFile($request->insurance, 'insurance'),
            ];

            $file = ImportFileModel::create($importData);

            Log::info($file);

            DB::commit();

            return redirect()->route('pelabuhan')->with('success', 'Data berhasil ditambahkan');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
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
            'file.required' => '',
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

    private static function uploadFile($file, $prefix)
    {
        $namaFile = $prefix . '-' . time() . '-' . $file->getClientOriginalName();

        $path = 'barang-masuk/' . $prefix;

        Storage::putFileAs($path, $file, $namaFile);
        return $path . '/' . $namaFile;
    }
}
