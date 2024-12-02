<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $admin = User::create([
            'name' => 'Admin Kullanıcı',
            'email' => 'admin333@admin.com',
            'password' => bcrypt('password'), // Güçlü bir şifre kullanın
        ]);
    }
}
