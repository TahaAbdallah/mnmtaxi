<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use App\Models\Driver;

class DriverLocationUpdated implements ShouldBroadcast
{
    use SerializesModels;

    public $driverId;
    public $latitude;
    public $longitude;

    /**
     * Create a new event instance.
     *
     * @param int $driverId
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct($driverId, $latitude, $longitude)
    {
        $this->driverId = $driverId;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // Broadcast the event on a unique channel for each driver
        return new Channel('driver-location.' . $this->driverId);
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}