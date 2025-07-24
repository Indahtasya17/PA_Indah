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
        $pelabuhan = TransaksiBarangModel::with(['items.barang'])->where('sumber_transaksi', 'import')->orderByDesc('created_at')->get();
        return view('after-login.pelabuhan.index', compact('pelabuhan'));
    }
    public function create()
    {
        $barangs = BarangModel::all();
        return view('after-login.pelabuhan.create', compact('barangs'));
    }

    public function edit($id)
    {
        $barangs = BarangModel::all();
        $pelabuhan = TransaksiBarangModel::with(['items', 'barang_import_masuk', 'import_file', 'riwayat_konfirmasi'])->findOrFail($id);
        return view('after-login.pelabuhan.edit', compact('pelabuhan', 'barangs'));
    }
    public function detail($id)
    {
        $pelabuhan = TransaksiBarangModel::with(['items.barang', 'barang_import_masuk', 'import_file', 'riwayat_konfirmasi'])->findOrFail($id);
        return view('after-login.pelabuhan.detail', compact('pelabuhan'));
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
                'laporan_surveyor' => 'required',
                'surat_persetujuan_pengeluaran_barang' => 'required',
                'surat_pengantar_pengeluaran_barang' => 'required',
                'pemberitahuan_impor_barang' => 'required',
                'kt_9'=> 'required',
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
                'laporan_surveyor' => 'Laporan Surveyor harus di isi',
                'surat_persetujuan_pengeluaran_barang' => 'Surat Persetujuan Pengeluaran Barang harus di isi',
                'surat_pengantar_pengeluaran_barang' => 'Surat Pengantar Pengeluaran Barang harus di isi',
                'pemberitahuan_impor_barang' => 'Pemberitahuan Impor Barang harus di isi',
                'kt_9' => 'KT-9 harus di isi',
            ]);

            DB::beginTransaction();

            $transaksiData = [
                'id_barang' => $request->id_barang,
                'tanggal' => $request->tanggal,
                'satuan' => $request->satuan,
                'no_polisi' => strtoupper($request->no_polisi),
                'id_user' => auth()->user()->id,
                'kontak_supir' => $request->kontak,
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
                'no_invoice' => strtoupper($request->no_invoice),
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
                'laporan_surveyor' => $this->uploadFile($request->laporan_surveyor, 'laporan-surveyor'),
                'surat_persetujuan_pengeluaran_barang' => $this->uploadFile($request->surat_persetujuan_pengeluaran_barang, 'surat-persetujuan-pengeluaran-barang'),
                'surat_pengantar_pengeluaran_barang' => $this->uploadFile($request->surat_pengantar_pengeluaran_barang, 'surat-pengantar-pengeluaran-barang'),
                'pemberitahuan_impor_barang' => $this->uploadFile($request->pemberitahuan_impor_barang, 'pemberitahuan-impor-barang'),
                'kt_9' => $this->uploadFile($request->kt_9, 'kt_9'),
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
            ]);

            DB::beginTransaction();

            $pengali = $request->satuan === "ton" ? 1000 : 1;
            $subtotal = $pengali * $request->harga_beli * $request->jumlah_barang;

            $transaksi = TransaksiBarangModel::findOrFail($id);

            $transaksi->update([
                'id_barang' => $request->id_barang,
                'tanggal' => $request->tanggal,
                'satuan' => $request->satuan,
                'no_polisi' => strtoupper($request->no_polisi),
                'kontak_supir' => $request->kontak,
                'total_tagihan' => $subtotal,
            ]);

            // update item (asumsi hanya 1 item per transaksi)
            TransaksiBarangItemModel::where('id_transaksi_barang', $id)
                ->update([
                    'id_barang' => $request->id_barang,
                    'harga' => $request->harga_beli,
                    'stock' => $request->jumlah_barang * $pengali,
                    'subtotal' => $subtotal,
                ]);

            // update informasi invoice & container
            BarangImportMasukModel::where('id_transaksi_barang', $id)
                ->update([
                    'no_invoice' => strtoupper($request->no_invoice),
                    'no_container' => strtoupper($request->no_container),
                ]);

            DB::commit();

            return redirect()->route('pelabuhan')->with('success', 'Data berhasil diperbarui');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
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
