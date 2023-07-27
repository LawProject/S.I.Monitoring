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
        'semester',
        'status'
    ];


    protected $enumSemester = [1, 2, 3, 4, 5, 6];
    protected $enumStatus = ['aktive', 'tidak_aktive'];
    protected $casts = [
        'semester' => 'integer',
    ];


    public function setSemesterAttribute($value)
    {
        if (!in_array($value, $this->enumSemester)) {
            throw new \InvalidArgumentException("Invalid semester value: $value");
        }
        $this->attributes['semester'] = $value;
        // Set status mahasiswa menjadi "tidak aktif" ketika semester berubah
        $this->attributes['status'] = 'tidak_aktive';
    }
    public function setStatusAttribute($value)
    {
        if (!in_array($value, $this->enumStatus)) {
            throw new \InvalidArgumentException("Invalid status value: $value");
        }

        $this->attributes['status'] = $value;
    }
    public function updateStatus()
    {
        $jumlahKegiatan = $this->kegiatans()->where('status', true)->count();

        if ($jumlahKegiatan >= 2) {
            $this->status = 'aktive';
        } else {
            $this->status = 'tidak_aktive';
        }

        $this->save();
    }

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
            return 'aktive';
        } else {
            return 'tidak_aktive';
        }
    }
    public function status()
    {
        $today = now();
        $sixMonthsAgo = $today->subMonths(6);

        return $this->kegiatans()->where('created_at', '>=', $sixMonthsAgo)->count() < 2;
    }
    // public function save(array $options = [])
    // {
    //     // Panggil metode save() pada model induk
    //     parent::save($options);

    //     // Periksa perubahan semester
    //     if ($this->isDirty('semester')) {
    //         $this->updateStatus();
    //         $this->save(); // Simpan perubahan atribut status ke dalam database
    //     }
    // }
}
