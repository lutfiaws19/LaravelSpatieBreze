<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles if they don't exist
        Role::firstOrCreate(['name' => 'Admin']);
        Role::firstOrCreate(['name' => 'Pelanggan']);
        Role::firstOrCreate(['name' => 'Pemilik']);

        // Create admin user
        $Admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
        ]);
        $Admin->assignRole('Admin');

        // Create other users with roles
        $Pelanggan = User::create([
            'name' => 'pelanggan',
            'email' => 'pelanggan@gmail.com',
            'password' => bcrypt('pelanggan123'),
        ]);
        $Pelanggan->assignRole('Pelanggan');

        $Pemilik = User::create([
            'name' => 'pemilik',
            'email' => 'pemilik@gmail.com',
            'password' => bcrypt('pemilik123'),
        ]);
        $Pemilik->assignRole('Pemilik');
    }
}
