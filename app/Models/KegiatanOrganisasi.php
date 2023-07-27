<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Organisasi;

class KegiatanOrganisasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_org',
        'nama_kegiatan',
        'tempat_kegiatan',
        'tanggal_kegiatan',
        'foto_kegiatan',
        'pelaksana',
        'penanggung_jawab',
        'deskripsi',
        'organisasi_id',
        'user_id', // tambahkan kolom 'user_id' ke dalam $fillable
        'status_verifikasi',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class, 'organisasi_id');
    }
}
