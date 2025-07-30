<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        $roles = [
            'karyawan-gudang',
            'karyawan-pelabuhan',
            'owner'
        ];

        $permissions = [
            'create-barang-masuk'
        ];

        foreach ($roles as $role) {
            Role::create(['name' =>$role]);
        }

        foreach ($permissions as $permission) {
            Permission::create(['name'=>$permission]);
        }
    }
}
