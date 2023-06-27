<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class OrganisasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organisasis')->insert([
            'namaorganisasi'=>'Hima Ti Polihasnur',
            'ketua'=>'Rahmadi',
            'pembina'=>'yazid aufar',
            'periode'=>'2023'
        ]);
    }
}
