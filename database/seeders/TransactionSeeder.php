<?php

namespace Database\Seeders;

use App\Models\BarangModel;
use App\Models\User;
use App\Models\TransaksiBarangModel;
use App\Models\TransaksiBarangItemModel;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $start = Carbon::create(2023, 12, 31);
        $end = Carbon::create(2024, 12, 31);

        foreach (BarangModel::all() as $barang) {
            $user = User::inRandomOrder()->first();

            for ($i = 0; $i < 20; $i++) {
                $tipe_transaksi = 'keluar';

                $randomTimestamp = rand($start->timestamp, $end->timestamp);
                $randomDate = Carbon::createFromTimestamp($randomTimestamp);
                
                $stock = fake()->numberBetween(10, 50);

                $transaksi = TransaksiBarangModel::create([
                    'id_user' => $user->id,
                    'tanggal' => $randomDate,
                    'total_tagihan' => $barang->harga_jual * $stock,
                    'tipe_transaksi' => $tipe_transaksi,
                    'sumber_transaksi' => fake()->randomElement(['lokal']),
                    'status' => 'diterima',
                    'created_at' => $randomDate,
                ]);


                TransaksiBarangItemModel::create([
                    'id_transaksi_barang' => $transaksi->id,
                    'id_barang' => $barang->id,
                    'stock' => $stock,
                    'harga' => $barang->harga_jual,
                    'subtotal' => $barang->harga_jual * $stock,
                    'created_at' => $randomDate,
                ]);
            }
        }
    }
}
