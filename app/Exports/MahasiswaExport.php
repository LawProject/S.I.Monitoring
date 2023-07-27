<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;


class MahasiswaExport implements FromQuery, WithMapping, ShouldAutoSize, WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function Query()
    {
        return Mahasiswa::Query();
    }

    public function map($mahasiswa): array
    {
        return [
            $mahasiswa->namamhs,
            $mahasiswa->nim,
            $mahasiswa->programstudi,
            $mahasiswa->nik,
            $mahasiswa->jenisbeasiswa,
            $mahasiswa->semester,
            $mahasiswa->status

        ];
    }
    public function headings(): array
    {
        return [
            'Nama Mahasiswa',
            'Nim',
            'Program Studi',
            'Nik',
            'Jenis Beasiswa',
            'Semester ',
            'Status Mahasiswa'
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Styling untuk heading
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => '000000',
                    ],
                ],
            ],
        ];
    }
}
