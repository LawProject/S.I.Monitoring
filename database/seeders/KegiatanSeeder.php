<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kegiatans')->insert([
            'nama' => 'Rahmadi',
            'jenis_kegiatan' => 'Organisasi',
            'pelaksana' => 'Hima TI',
            'penanggung_jawab' => 'zidane',

        ]);
    }
}
