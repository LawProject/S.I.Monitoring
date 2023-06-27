<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KegiatanOrganisasi;

class Organisasi extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function kegiatanOrganisasis()
    {
        return $this->hasManyThrough(KegiatanOrganisasi::class, User::class);
    }
}
