<?php

namespace Database\Seeders;

use App\Models\SupplierModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $supplier = [
            'nama' => 'Sarah',
            'alamat' => 'India',
            'kontak' => '91-9167441944',
            'waktu_tunggu' => '7',
        ];
        [
            'nama' => 'Rahul',
            'alamat' => 'India',
            'kontak' => '91-9167441944',
            'waktu_tunggu' => '14',
        ];

        SupplierModel::create($supplier);
    }
}
