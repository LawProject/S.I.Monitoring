<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kegiatan;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'namamhs',
        'nim',
        'programstudi',
        'nik',
        'jenisbeasiswa',


    ];
    // protected $casts = [
    //     'status' => 'enum:aktive,tidak_aktive',
    // ];

    public $timestamps = false;
    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class, 'mahasiswa_id');
    }
    public function uploads()
    {
        return $this->hasMany(Kegiatan::class);
    }
    public function getStatusAktif()
    {
        $jumlahKegiatan = $this->kegiatans()->count();

        if ($jumlahKegiatan >= 2) {
            return 'Aktive';
        } else {
            return 'Tidak_Aktive';
        }
    }
}
