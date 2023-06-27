<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Kegiatan;
use App\Models\Mahasiswa;
use App\Models\KegiatanOrganisasi;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nim',
        'email',
        'password',
        'foto'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class, 'user_id', 'id');
    }
    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class);
    }
    public function kegiatanOrganisasi()
    {
        return $this->hasMany(KegiatanOrganisasi::class, 'user_id', 'id');
    }
}
