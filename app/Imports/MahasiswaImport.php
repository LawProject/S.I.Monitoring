<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Facades\Excel;

class MahasiswaImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Mahasiswa([
            'namamhs' => $row[0],
            'nim' => $row[1],
            'programstudi' => $row[2],
            'nik' => $row[3],
            'jenisbeasiswa' => $row[4]
        ]);
    }
}
