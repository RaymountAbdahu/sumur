<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Data;

class WaterLevelUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // Jadikan properti ini publik agar bisa diakses di frontend
    public $data;

    public function __construct(Data $data)
    {
        $this->data = $data;
    }

    public function broadcastOn()
    {
        // Nama channel siaran kita
        return new Channel('water-level-channel');
    }

    public function broadcastAs()
    {
        // Nama event yang akan didengarkan oleh frontend
        return 'new-data';
    }
}