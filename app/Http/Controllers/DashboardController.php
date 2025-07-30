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
    { {
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

            $tanggalLabels = collect(range(6, 0))->map(function ($daysAgo) {
                return Carbon::now()->subDays($daysAgo)->format('Y-m-d');
            });

            $labelTampilan = $tanggalLabels->map(function ($tgl) {
                return Carbon::parse($tgl)->format('d M');
            });

            $barangMasuk = [];
            $barangKeluar = [];

            foreach ($tanggalLabels as $tanggal) {
                $masuk = TransaksiBarangModel::whereDate('tanggal', $tanggal)
                    ->where('tipe_transaksi', 'masuk')
                    ->with('items')
                    ->get()
                    ->flatMap->items
                    ->sum('stock');

                $keluar = TransaksiBarangModel::whereDate('tanggal', $tanggal)
                    ->where('tipe_transaksi', 'keluar')
                    ->with('items')
                    ->get()
                    ->flatMap->items
                    ->sum('stock');

                $barangMasuk[] = $masuk;
                $barangKeluar[] = $keluar;
            }

            $top = TransaksiBarangItemModel::whereHas('barang')
                ->whereHas('transaksi', function ($query) {
                    $query->where('tipe_transaksi', 'keluar');
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

            // Semua barang keluar (tanpa batasan waktu)
            $semuaBarangKeluar = TransaksiBarangItemModel::whereHas('barang')
                ->whereHas('transaksi', function ($query) {
                    $query->where('tipe_transaksi', 'keluar');
                })
                ->selectRaw('id_barang, SUM(stock) as total')
                ->groupBy('id_barang')
                ->orderByDesc('total')
                ->get();

            $semuaLabels = [];
            $semuaData = [];

            foreach ($semuaBarangKeluar as $item) {
                $barang = BarangModel::find($item->id_barang);
                $semuaLabels[] = $barang->nama_barang ?? 'Tidak Diketahui';
                $semuaData[] = $item->total;
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
                ],
                'semua_barang_keluar' => [
                    'label' => $semuaLabels,
                    'data' => $semuaData
                ]
            ];

            $currentYear = now()->year;
            $start = Carbon::create($currentYear - 1, 1, 1)->startOfDay();
            $end = Carbon::create($currentYear, 1, 1)->startOfDay();

            $barangs = BarangModel::with([
                'items' => function ($query) use ($start, $end) {
                    $query->whereHas('transaksi', function ($q) use ($start, $end) {
                        $q->where('tipe_transaksi', 'keluar')->whereBetween('tanggal', [$start, $end]);
                    });
                },
                'items.transaksi'
            ])->get();

            foreach ($barangs as $barang) {
                $penjualanMaksimal = $barang->items->max('stock');
                $totalTransaksi = $barang->items->count();
                $jumlahPenjualan = $barang->items->sum('stock');

                $rata2Penjualan = $totalTransaksi > 0 ? $jumlahPenjualan / $totalTransaksi : 0;

                $safety_stock = round(($penjualanMaksimal - $rata2Penjualan) * $barang->waktu_tunggu);
                $barang->safety_stock = $safety_stock;
                $barang->rop = round(($barang->waktu_tunggu * $rata2Penjualan) + $safety_stock);

                $badgeColor = 'success';
                if ($barang->rop >= $barang->stok) {
                    $badgeColor = 'warning';
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
}
