<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        permission::create(['name' => 'view-dashboard']);
        permission::create(['name' => 'view-antrian']);
        permission::create(['name' => 'view-pelanggan']);
        permission::create(['name' => 'view-kerusakan']);

       
       $roleAdmin = Role::create(['name' => 'admin']);
        $roleAdmin->givePermissionTo([
            'view-dashboard',
            'view-antrian',
            'view-pelanggan',
            'view-kerusakan',
        ]);

        $rolePelanggan = Role::create(['name' => 'pelanggan']);
        $rolePelanggan->givePermissionTo([
            'view-dashboard',
            'view-pelanggan',
        ]);
        $rolepemilik = Role::create(['name' => 'pemilik']);
        $rolepemilik->givePermissionTo([
            'view-dashboard',
            'view-antrian',
            'view-pelanggan',
            'view-kerusakan',
        ]);
    }
}
