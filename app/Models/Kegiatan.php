<?php

namespace App\Models; // Namespace untuk model Kegiatan

use Illuminate\Database\Eloquent\Factories\HasFactory; // Menggunakan trait HasFactory
use Illuminate\Database\Eloquent\Model; // Menggunakan kelas Model
use App\Models\User; // Menggunakan model User
use App\Models\Mahasiswa; // Menggunakan model Mahasiswa

class Kegiatan extends Model // Mendefinisikan kelas Kegiatan yang merupakan turunan dari Model
{
    use HasFactory; // Menggunakan trait HasFactory

    protected $fillable = [ // Kolom-kolom yang dapat diisi secara massal
        'nama',
        'jenis_kegiatan',
        'tanggal_kegiatan',
        'pelaksana',
        'foto',
        'penanggung_jawab',
        'status',
        'deskripsi_kegiatan'
    ];

    protected $casts = [ // Kolom yang perlu di-cast ke tipe data tertentu
        'status' => 'boolean',
    ];

    public function user() // Relasi belongsTo antara Kegiatan dan User
    {
        return $this->belongsTo(User::class);
    }

    public function mahasiswa() // Relasi belongsTo antara Kegiatan dan Mahasiswa
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
