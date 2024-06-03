<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mail;
use App\Mail\CarpoolMail;

class carpool extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'address', 'university', 'date', 'departureTime', 'comeBackTime'];

    public static function boot()
    {

        parent::boot();

        static::created(function ($item) {

            $adminEmail = "info@mnmtaxilb.com";
            Mail::to($adminEmail)->send(new CarpoolMail($item));
        });
    }
}
