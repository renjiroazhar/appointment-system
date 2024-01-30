<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            [
                'nama' => 'Admin',
                'username' => 'admin',
                'password' => bcrypt('admin'),
                'no_hp' => '08123456789',
                'no_ktp' => '3374123456789',
                'alamat' => 'Jl. Admin',
                // 'created_at' => now()
            ]
        ]);
    }
}
