<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KegiatanOrganisasi;
use App\Models\User;

class Organisasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaorganisasi',
        'nim',
        'pembina',
        'ketua',
        'periode',
        'status' // tambahkan kolom 'status' ke dalam $fillable
    ];

    protected $enumStatus = ['aktif', 'tidak_aktif'];

    public function setStatusAttribute($value)
    {
        if (!in_array($value, $this->enumStatus)) {
            throw new \InvalidArgumentException("Invalid status value: $value");
        }

        $this->attributes['status'] = $value;
    }

    public function updateStatus()
    {
        $jumlahKegiatan = $this->kegiatan_organisasis()
            ->where('status_verifikasi', true)
            ->count();

        if ($jumlahKegiatan >= 2) {
            $this->attributes['status'] = 'aktif';
        } else {
            $this->attributes['status'] = 'tidak_aktif';
        }

        $this->save();
    }

    public $timestamps = false;

    protected $attributes = [
        'status' => 'tidak_aktif',
    ];

    public function kegiatan_organisasis()
    {
        return $this->hasMany(KegiatanOrganisasi::class, 'organisasi_id');
    }

    public function uploads()
    {
        return $this->hasMany(KegiatanOrganisasi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kegiatanOrganisasis()
    {
        return $this->hasManyThrough(KegiatanOrganisasi::class, User::class);
    }
}
