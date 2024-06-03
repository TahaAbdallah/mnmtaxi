<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Driver;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Notifications\TripAddedNotification;
use Twilio\Rest\Client as TwilioClient;
use App\Events\DriverLocationUpdated;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;



class TripController extends Controller
{

    public function notAssigned(Request $request)
    {

        $search = $request->input('search');

        // Query trips with search filter
        $trips = Trip::query()
            ->whereNull('driver_id')
            ->where(function ($query) use ($search) {
                $query->where('client_name', 'like', "%$search%")
                    ->orWhere('client_phone_number', 'like', "%$search%");
            })
            ->with('driver')
            ->latest()
            ->paginate(10);

        // Pass the trips data to the view
        return view('admin.notAssigned', compact('trips'));

    }

    public function assignDriver($id)
    {

        $trip = Trip::findOrFail($id);
        $drivers = Driver::pluck('name', 'id');
        return view('admin.assignDriver', ['trip' => $trip, 'drivers' => $drivers]);

    }

    public function saveAssignDriver(Request $request, $id)
    {
        $trip = Trip::findOrFail($id);
        $trip->update(['driver_id' => $request->input('driver_id')]);

        $driver = Driver::findOrFail($request->input('driver_id'));

        // Send WhatsApp message via Facebook Graph API
        $this->sendWhatsAppMessageToDriver($trip, $driver);
        $this->sendWhatsAppMessageAssigned($trip, $driver);

        $successMessage = 'Driver Assigned successfully';
        return redirect()->route('AdminPage')->with('successMessage', $successMessage);
    }

    public function sendWhatsAppMessageToDriver($trip, $driver)
    {
        // Define the API URL
        $url = 'https://graph.facebook.com/v19.0/332401343284741/messages';

        // Define the authorization token
        $token = 'EAAU5xb9ARasBOzDwpNbEYAlNHassZBLllzgawy2g3oVGSpBlazbGyABc0LXjdUKLh9iALaQmfp6LvTw189uvZB0WevmtsyZAiRUJgJydyJU43TV779iJWS29PF5sVzHGQG7TggkwFNnRqqYUHvVQTM4vEy9K657YZB0nxoW2mZB1sLRdJiQoJpwdDhLK3';

        // Prepare the components with variables
        $components = [
            [
                'type' => 'body',
                'parameters' => [
                    ['type' => 'text', 'text' => $driver->name],
                    ['type' => 'text', 'text' => $trip->client_name],
                    ['type' => 'text', 'text' => $trip->location],
                    ['type' => 'text', 'text' => $trip->destination],
                    ['type' => 'text', 'text' => $trip->date],
                    ['type' => 'text', 'text' => $trip->time],
                    ['type' => 'text', 'text' => $trip->details],
                ]
            ],
            [
                'type' => 'button',
                'sub_type' => 'url',
                'index' => '0',
                'parameters' => [
                    ['type' => 'text', 'text' => (string) $trip->id],
                ]
            ],
        ];

        // Define the message payload
        $payload = [
            'messaging_product' => 'whatsapp',
            'to' => '+961' . $driver->driverPhoneNumber,
            'type' => 'template',
            'template' => [
                'name' => 'driver_confirm_trip   ',
                'language' => [
                    'code' => 'en_US'
                ],
                'components' => $components
            ]
        ];

        // Make the HTTP POST request
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ])->post($url, $payload);
        // Check the response status and handle accordingly
        if ($response->successful()) {
            Log::info('WhatsApp message sent successfully: ', ['response' => $response->json()]);
            return response()->json(['message' => 'Message sent successfully!']);
        } else {
            $error = $response->json();
            Log::error('Failed to send WhatsApp message: ', ['error' => $error]);
            return response()->json(['error' => 'Failed to send message', 'details' => $error], $response->status());
        }
    }

    public function sendWhatsAppMessageAssigned($trip, $driver)
    {
        // Define the API URL
        $url = 'https://graph.facebook.com/v19.0/332401343284741/messages';

        // Define the authorization token
        $token = 'EAAU5xb9ARasBOzDwpNbEYAlNHassZBLllzgawy2g3oVGSpBlazbGyABc0LXjdUKLh9iALaQmfp6LvTw189uvZB0WevmtsyZAiRUJgJydyJU43TV779iJWS29PF5sVzHGQG7TggkwFNnRqqYUHvVQTM4vEy9K657YZB0nxoW2mZB1sLRdJiQoJpwdDhLK3';

        // Prepare the components with variables
        $components = [
            [
                'type' => 'header',
                'parameters' => [
                    ['type' => 'text', 'text' => $driver->name],
                ]
            ],

            [
                'type' => 'body',
                'parameters' => [
                    ['type' => 'text', 'text' => $driver->name],
                    ['type' => 'text', 'text' => $trip->client_name],
                    ['type' => 'text', 'text' => $trip->location],
                    ['type' => 'text', 'text' => $trip->destination],
                    ['type' => 'text', 'text' => $trip->client_phone_number],
                    ['type' => 'text', 'text' => $trip->id]
                ]
            ]
        ];

        // Define the message payload
        $payload = [
            'messaging_product' => 'whatsapp',
            'to' => '96176958565',
            'type' => 'template',
            'template' => [
                'name' => 'message_has_been_assigned',
                'language' => [
                    'code' => 'en_US'
                ],
                'components' => $components
            ]
        ];

        // Make the HTTP POST request
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ])->post($url, $payload);
        // Check the response status and handle accordingly
        if ($response->successful()) {
            Log::info('WhatsApp message sent successfully: ', ['response' => $response->json()]);
            return response()->json(['message' => 'Message sent successfully!']);
        } else {
            $error = $response->json();
            Log::error('Failed to send WhatsApp message: ', ['error' => $error]);
            return response()->json(['error' => 'Failed to send message', 'details' => $error], $response->status());
        }
    }

    public function addTrip()
    {
        // Fetch all available drivers
        $drivers = Driver::pluck('name', 'id');
        return view('admin.addTrip', ['drivers' => $drivers]);
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'client_name' => 'required|string',
            'client_phone_number' => [
                'required',
                'string',
                'regex:/^(03|70|71|76|78|79|81)\d{6}$/',
            ],
            'location' => 'required|string',
            'destination' => 'required|string',
            'date' => 'required|date|after_or_equal:' . Carbon::today()->format('d-m-Y'),
            'time' => [
                'required',
                function ($attribute, $value, $fail) {
                    $currentTime = Carbon::now()->format('H:i'); // Get the current time in the format 'H:i'

                    // Compare input time with the current time
                    if ($value < $currentTime) {
                        $fail('The time must be the current time or later.');
                    }
                },
            ],
        ]);


        // Get the location and destination from the request
        $location = $request->input('location');
        $destination = $request->input('destination');

        // Ensure that both location and destination are valid Google addresses
        if (!$this->isValidAddress($location) || !$this->isValidAddress($destination)) {
            return redirect()->back()->withErrors(['message' => 'Please enter valid location and destination.']);
        }

        $status = 'pending';

        // Create a new trip instance
        $trip = Trip::create([
            'client_name' => $request->client_name,
            'client_phone_number' => $request->client_phone_number,
            'location' => $request->location,
            'destination' => $request->destination,
            'date' => $request->date,
            'time' => $request->time,
            'details' => $request->details,
            'driver_id' => $request->input('driver_id'),
        ]);

        // Retrieve the driver's phone number
        $driver = Driver::findOrFail($request->input('driver_id'));
        $driverPhoneNumber = $driver->driverPhoneNumber;

        $this->sendWhatsAppMessageAssigned($trip, $driver);
        $this->sendWhatsAppMessageToDriver($trip, $driver);


        // Redirect to a success page or any other route
        return redirect()->route('AdminPage')->with('success', 'Trip added successfully');
    }



    private function isValidAddress($address)
    {
        // Use Google Maps Geocoding API to validate the address
        $client = new Client();
        $response = $client->get('https://maps.googleapis.com/maps/api/geocode/json', [
            'query' => [
                'address' => $address,
                'key' => 'AIzaSyBdWfSJJ2c_entp53CpUFSIYnb960pQS5o',
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        return isset($data['results']) && count($data['results']) > 0;
    }

    public function destroyTrip($id)
    {
        $trip = Trip::findOrFail($id);
        $trip->delete();

        return redirect()->route('AdminPage')->with('successMessage', 'Trip deleted successfully');
    }

    public function confirmView(Trip $trip)
    {
        return view('locationConfirmation', ['trip' => $trip]);
    }


    public function finishView(Trip $trip)
    {
        return view('locationConfirmed', ['trip' => $trip]);
    }

    public function confirm(Request $request, Trip $trip)
    {
        // Validate the latitude and longitude inputs
        $request->validate([
            'driver_latitude' => 'required|numeric',
            'driver_longitude' => 'required|numeric',
        ]);

        // Update the driver's location
        $trip->driver()->update([
            'latitude' => $request->input('driver_latitude'),
            'longitude' => $request->input('driver_longitude'),
        ]);

        // Fire the DriverLocationUpdated event to broadcast the updated location
        event(new DriverLocationUpdated($trip->driver_id, $request->input('driver_latitude'), $request->input('driver_longitude')));

        // Confirm the trip (you can add additional logic here as needed)
        $trip->update(['status' => 'confirmed']);

        // Redirect to a success page or any other route
        return redirect()->route('trips.finish.view', ['trip' => $trip])->with('success', 'Trip confirmed successfully.');
    }

    public function finish(Request $request, Trip $trip)
    {
        // Validate the latitude and longitude inputs
        $request->validate([
            'driver_latitude' => 'required|numeric',
            'driver_longitude' => 'required|numeric',
        ]);

        // Update the driver's location
        $trip->driver()->update([
            'latitude' => $request->input('driver_latitude'),
            'longitude' => $request->input('driver_longitude'),
        ]);

        // Fire the DriverLocationUpdated event to broadcast the updated location
        event(new DriverLocationUpdated($trip->driver_id, $request->input('driver_latitude'), $request->input('driver_longitude')));

        // Confirm the trip (you can add additional logic here as needed)
        $trip->update(['status' => 'Finished']);

        // Redirect to a success page or any other route
        return redirect()->route('welcome');
    }

    public function updateLocation(Request $request)
    {
        $tripId = $request->input('trip_id');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        // Update the driver's location in the database
        $trip = Trip::findOrFail($tripId);
        // Update the driver's location in the database
        $driver = $trip->driver;
        $driver->update([
            'latitude' => $latitude,
            'longitude' => $longitude
        ]);
        return response()->json(['success' => true]);
    }

    public function generateTrackingLink($tripId)
    {
        // Generate the tracking link with the trip ID
        $trackingLink = route('tracking', ['tripId' => $tripId]);

        // Return the tracking link
        return $trackingLink;
    }


}
