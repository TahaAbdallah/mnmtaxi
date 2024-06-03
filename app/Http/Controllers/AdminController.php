<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\Driver;
use Illuminate\Validation\Rule;
use App\Models\Trip;
use Carbon\Carbon;
use GuzzleHttp\Client;
// use Twilio\Rest\Client as TwilioClient;
use App\Events\DriverLocationUpdated;
use App\Events\TaxiLocationUpdated;




class AdminController extends Controller
{
    public function home(Request $request)
    {
        $search = $request->input('search');

    // Query trips with search filter
    $trips = Trip::query()
        ->where('client_name', 'like', "%$search%")
        ->orWhere('client_phone_number', 'like', "%$search%")
        ->with('driver')
        ->latest()
        ->paginate(10);

    return view('admin.homePage', compact('trips'));
    }

    // public function storeTrip(Request $request)
    // {
    //     $request->validate([
    //         'client_name' => 'required|string',
    //         'client_phone_number' => 'required|string|digits:8',
    //         'location' => 'required|string',
    //         'destination' => 'required|string',
    //         'date' => 'required|date|after_or_equal:' . Carbon::today()->format('d-m-Y'),
    //         'time' => 'required|date_format:H:i',
    //         'driver_id' => 'required|exists:drivers,id', // Ensure driver exists in the database
    //     ]);

    //     $status = 'pending';

       

    //     // Create the trip
    //     $trip = Trip::create($request->all());

    //     // Redirect or do something else upon success
    //     return redirect()->route('AdminPage')->with('success', 'Trip created successfully, a message will be sent to the driver.');
    // }

    // public function addTrip()
    // {
    //     $drivers = Driver::pluck('name', 'id'); 
    //      return view('admin.addTrip', ['drivers' => $drivers]);
    // }

//     public function destroyTrip($id)
// {
//     $trip = Trip::findOrFail($id);
//     $trip->delete();

//     return redirect()->route('AdminPage')->with('successMessage', 'Trip deleted successfully');
// }

   


}