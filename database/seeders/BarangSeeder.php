<?php

namespace Database\Seeders;

use App\Models\BarangModel;
use App\Models\SupplierModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $barangs = [
            [
                'nama_barang' => 'Bawang Bombai',
                'kode_barang' => 'BABO001',
                'harga_beli' => 10000,
                'harga_jual' => 20000,
                'stok' => 400,
                'waktu_tunggu' => 14,
                'sumber' => 'import'
            ],
            [
                'nama_barang' => 'Bawang Putih',
                'kode_barang' => 'BAPU001',
                'harga_beli' => 15000,
                'harga_jual' => 25000,
                'stok' => 450,
                'waktu_tunggu' => 14,
                'sumber' => 'import'
            ],
            [
                'nama_barang' => 'Bawang Merah Bima',
                'kode_barang' => 'BMBI001',
                'harga_beli' => 10000,
                'harga_jual' => 20000,
                'stok' => 500,
                'waktu_tunggu' => 7,
                'sumber' => 'lokal'
            ],
        ];
        
        $supplier = SupplierModel::first();
        foreach ($barangs as $barang) {
            $barang['id_supplier'] = $supplier->id;
            BarangModel::create($barang);
        }
    }
}
