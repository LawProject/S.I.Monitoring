<?php

namespace App\Listeners;

use App\Events\MahasiswaRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Mahasiswa;
use App\Models\User;

class AssignUserIdToMahasiswa
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\MahasiswaRegistered  $event
     * @return void
     */
    public function handle(MahasiswaRegistered $event)
    {
        $user = User::where('nim', $event->nim)->first();

        if ($user) {
            $mahasiswa = Mahasiswa::where('nim', $event->nim)->first();
            $mahasiswa->user_id = $user->id;
            $mahasiswa->save();
        }
    }
}
