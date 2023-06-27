<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Mahasiswa;
use App\Models\User;

class MahasiswaRegistered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $nim;

    public function __construct($nim)
    {
        $this->nim = $nim;
    }
    public function handle()
    {
        $user = User::where('nim', $this->nim)->first();

        if ($user) {
            $mahasiswa = Mahasiswa::where('nim', $this->nim)->first();
            $mahasiswa->user_id = $user->id;
            $mahasiswa->save();
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
