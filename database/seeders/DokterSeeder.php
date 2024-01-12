<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dokters')->insert([
            [
                'nama' => 'Dr. Andi',
                'alamat' => 'Jl. Raya No. 1',
                'no_hp' => '081234567890',
                'password' => bcrypt('dokter'),
                'id_poli' => 1,
                'created_at' => now()
            ],
            [
                'nama' => 'Dr. Budi',
                'alamat' => 'Jl. Raya No. 2',
                'no_hp' => '081234567891',
                'password' => bcrypt('dokter'),
                'id_poli' => 2,
                'created_at' => now()
            ],
            [
                'nama' => 'Dr. Caca',
                'alamat' => 'Jl. Raya No. 3',
                'no_hp' => '081234567892',
                'password' => bcrypt('dokter'),
                'id_poli' => 3,
                'created_at' => now()
            ],

        ]);
    }
}
