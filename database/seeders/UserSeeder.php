<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@cafe.com',
            'password' => Hash::make('password'),
            'role_id' => 1
        ]);

        
        User::create([
            'name' => 'Karyawan 1',
            'email' => 'karyawan@cafe.com',
            'password' => Hash::make('password'),
            'role_id' => 2
        ]);

        
        User::create([
            'name' => 'Petugas 1',
            'email' => 'petugas@cafe.com',
            'password' => Hash::make('password'),
            'role_id' => 3
        ]);
    }
}