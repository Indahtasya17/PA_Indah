<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $karyawanGudang = User::create([
            'name' => 'Gudang',
            'username' => 'indah',
            'password' => Hash::make('12345678')
        ]);

        $karyawanGudang->assignRole('karyawan-gudang');

        $karyawanPelabuhan = User::create([
            'name' => 'Pelabuhan',
            'username' => 'pelabuhan',
            'password' => Hash::make('12345678')
        ]);

        $karyawanPelabuhan->assignRole('karyawan-pelabuhan');

        $owner = User::create([
            'name' => 'Owner',
            'username' => 'owner',
            'password' => Hash::make('12345678')
        ]);

        $owner->assignRole('owner');
        
    }
}
