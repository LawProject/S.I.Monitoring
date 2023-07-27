<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use App\Models\User;
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
        $semester = $row[5];

        // Validasi nilai semester
        $enumSemester = ['1', '2', '3', '4', '5', '6'];
        if (!in_array($semester, $enumSemester)) {
            throw new \InvalidArgumentException("Invalid semester value: $semester");
        }

        return new Mahasiswa([
            'namamhs' => $row[0],
            'nim' => $row[1],
            'programstudi' => $row[2],
            'nik' => $row[3],
            'jenisbeasiswa' => $row[4],
            'semester' => $semester
        ]);
    }
}
