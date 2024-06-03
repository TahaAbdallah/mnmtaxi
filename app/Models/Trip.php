<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Driver;

class Trip extends Model
{
    protected $fillable = [
        'client_name',
        'client_phone_number',
        'location',
        'destination',
        'date',
        'time',
        'details',
        'driver_id',
        'status',
    ];

    // Define the relationship: Each trip belongs to a single driver
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
    use HasFactory;

}
