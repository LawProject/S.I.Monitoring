<?php

namespace App\Observers;

use App\Models\Mahasiswa;

class MahasiswaObserver
{
    /**
     * Handle the Mahasiswa "created" event.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return void
     */
    public function created(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Handle the Mahasiswa "updated" event.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return void
     */
    public function updated(Mahasiswa $mahasiswa)
    {
        if ($mahasiswa->isDirty('semester')) {
            $mahasiswa->kegiatans()->update(['status' => false]); // Mengubah status kegiatan menjadi false
            $mahasiswa->updateStatus(); // Memperbarui status berdasarkan jumlah kegiatan
            $mahasiswa->save(); // Simpan perubahan ke dalam database
        }
    }

    /**
     * Handle the Mahasiswa "deleted" event.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return void
     */
    public function deleted(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Handle the Mahasiswa "restored" event.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return void
     */
    public function restored(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Handle the Mahasiswa "force deleted" event.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return void
     */
    public function forceDeleted(Mahasiswa $mahasiswa)
    {
        //
    }
}
