<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Driver extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'username', 'password', 'driverPhoneNumber', 'latitude', 'longitude',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Define the relationship: One driver can have many trips
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

}