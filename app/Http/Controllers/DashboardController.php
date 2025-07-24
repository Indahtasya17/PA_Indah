<?php

namespace App\Http\Controllers;

use App\Models\TransaksiBarangModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\BarangModel;
use App\Models\TransaksiBarangItemModel;
use App\Models\SupplierModel;

class DashboardController extends Controller
{
    public function index()
    {

        $totalBarangMasuk = TransaksiBarangModel::where('tipe_transaksi', 'masuk')
            ->with('items')
            ->get()
            ->flatMap->items
            ->sum('stock');

        $totalBarangKeluar = TransaksiBarangModel::where('tipe_transaksi', 'keluar')
            ->with('items')
            ->get()
            ->flatMap->items
            ->sum('stock');

        $totalSupplier = SupplierModel::count();

        // Ambil 7 hari terakhir
        $tanggalLabels = collect(range(6, 0))->map(function ($daysAgo) {
            return Carbon::now()->subDays($daysAgo)->format('Y-m-d');
        });

        $labelTampilan = $tanggalLabels->map(function ($tgl) {
            return Carbon::parse($tgl)->format('d M');
        });

        $barangMasuk = [];
        $barangKeluar = [];

        foreach ($tanggalLabels as $tanggal) {
            // Barang Masuk
            $masuk = TransaksiBarangModel::whereDate('tanggal', $tanggal)
                ->where('tipe_transaksi', 'masuk')
                ->with('items')
                ->get()
                ->flatMap->items
                ->sum('stock');

            // Barang Keluar
            $keluar = TransaksiBarangModel::whereDate('tanggal', $tanggal)
                ->where('tipe_transaksi', 'keluar')
                ->with('items')
                ->get()
                ->flatMap->items
                ->sum('stock');

            $barangMasuk[] = $masuk;
            $barangKeluar[] = $keluar;
        }

        // Top 5 barang keluar terbanyak (7 hari terakhir)
        $top = TransaksiBarangItemModel::whereHas('barang')
            ->whereHas('transaksi', function ($query) {
                $query->where('tipe_transaksi', 'keluar')
                    ->where('tanggal', '>=', Carbon::now()->subDays(6)->startOfDay());
            })
            ->selectRaw('id_barang, SUM(stock) as total')
            ->groupBy('id_barang')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        $topLabels = [];
        $topData = [];

        foreach ($top as $item) {
            $barang = BarangModel::find($item->id_barang);
            $topLabels[] = $barang->nama_barang ?? 'Tidak Diketahui';
            $topData[] = $item->total;
        }

        $datasets = [
            'transaksi' => [
                'label' => $labelTampilan,
                'data' => [
                    'barang_masuk' => $barangMasuk,
                    'barang_keluar' => $barangKeluar
                ]
            ],
            'barang_keluar_terbanyak' => [
                'label' => $topLabels,
                'data' => $topData
            ]
        ];

        $barangs = BarangModel::with([
            'items' => function ($query) {
                $query->whereHas('transaksi', function ($q) {
                    $q->where('tipe_transaksi', 'keluar');
                })->where('created_at', '>=', now()->subDays(30));
            },
            'items.transaksi'
        ])->get();

        foreach ($barangs as $barang) {
            $penjualanMaksimal = $barang->items->max('stock');
            $totalTransaksi = $barang->items->count();
            $jumlahPenjualan = $barang->items->sum('stock');

            if ($totalTransaksi > 0) {
                $rata2Penjualan = $jumlahPenjualan / $totalTransaksi;
            } else {
                $rata2Penjualan = 0;
            }

            $safety_stock = round(($penjualanMaksimal - $rata2Penjualan) * $barang->waktu_tunggu);
            $barang->safety_stock = $safety_stock;
            $barang->rop = round(($barang->waktu_tunggu * $rata2Penjualan) + $safety_stock);

            $badgeColor = '';

            if ($safety_stock >= $barang->stok) {
                $badgeColor = 'warning';
            } else {
                $badgeColor = 'success';
            }

            if ($barang->stok == 0) {
                $badgeColor = 'danger';
            }

            $barang->badge_color = $badgeColor;
        }     
        $barangs = $barangs->whereIn('badge_color', ['warning', 'danger']);

        return view('after-login.dashboard.index', compact('datasets', 'totalBarangMasuk', 'totalBarangKeluar', 'totalSupplier', 'barangs'));

    }
}
