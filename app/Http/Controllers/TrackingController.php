<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver; 
use App\Models\Trip;

class TrackingController extends Controller
{

   
// // ----------------------------------------------TRACKING SYSTEM 

public function showTrackingPage($tripId)
{
    // Retrieve the trip details
    $trip = Trip::findOrFail($tripId);

// Retrieve the driver's location from the associated driver
$driverLocation = [
    'latitude' => $trip->driver->latitude,
    'longitude' => $trip->driver->longitude
];

// Pass the trip details and driver's location to the view
return view('tracking', compact('trip', 'driverLocation'));
}

public function getDriverLocation(Request $request, Trip $trip)
{
    // Retrieve the driver's location from the trip details
    $driverLocation = [
        'latitude' => $trip->driver->latitude,
        'longitude' => $trip->driver->longitude
    ];

    // Return the driver's location data as JSON response
    return response()->json($driverLocation);
}

}