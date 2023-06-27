<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KegiatanOrganisasi;

class KegiatanOrganisasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nama_org' => 'Organisasi A',
                'nama_kegiatan' => 'Kegiatan A',
                'tempat_kegiatan' => 'Tempat A',
                'tanggal_kegiatan' => '2023-06-21',
                'foto_kegiatan' => 'fotoA.jpg',
                'pelaksana' => 'Pelaksana A',
                'penanggung_jawab' => 'Penanggung Jawab A',
                'deskripsi' => 'Deskripsi kegiatan A'
            ],
        ];
        foreach ($data as $item) {
            KegiatanOrganisasi::create($item);
        }
    }
}
