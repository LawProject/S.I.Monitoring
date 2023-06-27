<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mahasiswas')->insert([
            'namamhs'=>'Rahmadi',
            'nim'=>'20302041',
            'programstudi'=>'TeknikInformatika',
            'nik'=>'12345678910',
            'jenisbeasiswa'=>'KipKuliah'
        ]);
    }
}
