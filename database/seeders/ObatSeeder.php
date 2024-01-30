<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('obat')->insert([
            [
                'nama_obat' => 'Paramex',
                'kemasan' => 'Strip',
                'harga' => '5500',
                // 'created_at' => now()
            ],
            [
                'nama_obat' => 'Paracetamol',
                'kemasan' => 'Strip',
                'harga' => '20000',
                // 'created_at' => now()
            ],
            [
                'nama_obat' => 'Citirizen',
                'kemasan' => 'Strip',
                'harga' => '5000',
                // 'created_at' => now()
            ]
        ]);
    }
}
