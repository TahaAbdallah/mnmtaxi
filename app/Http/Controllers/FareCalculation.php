<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Twilio\Rest\Client as TwilioClient;
use App\Models\Trip;
use App\Models\Driver;
use Carbon\Carbon;
use App\Notifications\TripAddedNotification;
use Illuminate\Support\Facades\Log;



class FareCalculation extends Controller
{

    public function calculateFare(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'location' => 'required',
            'destination' => 'required',
        ]);

        // Get the location and destination from the request
        $location = $request->input('location');
        $destination = $request->input('destination');

        // Calculate the distance using Google Maps Distance Matrix API
        $distance = $this->calculateDistance($location, $destination);

        // Ensure that both location and destination are valid Google addresses
        if (!$this->isValidAddress($location) || !$this->isValidAddress($destination)) {
            return redirect()->back()->withErrors(['message' => 'Please enter valid location and destination.']);
        }


        // Calculate fare based on distance
        if ($distance <= 3) {
            // Basic fare $3.8 + $0.38 for each additional km
            $fare = (350000 + 35000 * ($distance - 1)) / 90000;
        } elseif ($distance <= 20) {
            // Basic fare $3.8 + $0.33 for each additional km
            $fare = (350000 + 30000 * ($distance - 1)) / 90000;
        } else {
            // No basic fare for distances above 20 km, $0.88 for each km
            $fare = (80000 * $distance) / 90000;
        }

        // Round fare to 2 decimal places
        // $fare = round($fare, 1);
        $fare = number_format($fare);

        return view('fareResult', ['fare' => $fare, 'distance' => $distance, 'location' => $location, 'destination' => $destination]);
    }

    public function storeClientTrip(Request $request)
{
    // Validate the request data
    $request->validate([
        'client_name' => 'required|string',
        'client_phone_number' =>  [
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
        'details' => 'required',
    ]);

    $status = 'Not Assigned';

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

    
 // Send WhatsApp message via Facebook Graph API
 $this->sendWhatsAppMessage($trip);

    // Redirect to a success page or any other route
    return redirect()->route('welcome')->with('success', 'Your order has been confirmed, we will contact you shortly.');
}


public function sendWhatsAppMessage($trip)
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
                ['type' => 'text', 'text' => $trip->client_name],
            ]
    ],

        [
            'type' => 'body',
            'parameters' => [
                ['type' => 'text', 'text' => $trip->client_name],
                ['type' => 'text', 'text' => $trip->client_phone_number],
                ['type' => 'text', 'text' => $trip->location],
                ['type' => 'text', 'text' => $trip->destination],
                ['type' => 'text', 'text' => $trip->date],
                ['type' => 'text', 'text' => $trip->time],
                ['type' => 'text', 'text' => $trip->details],
                ['type' => 'text', 'text' => $trip->client_phone_number]
            ]
    ],
    [
            'type' => 'button',
    'sub_type' => 'url',
    'index' => '0',
            'parameters' => [
               ['type' => 'text', 'text' => (string)$trip->id],
            ]
    ],
    ];

        // Define the message payload
        $payload = [
            'messaging_product' => 'whatsapp',
            'to' => '96176958565',
            'type' => 'template',
            'template' => [
                'name' => 'trip_request_from_client',
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
    
    
   



    // public function calculateFareAr(Request $request)
    // {
    //     // Validate the form inputs
    //     $request->validate([
    //         'location' => 'required',
    //         'destination' => 'required',
    //     ]);

    //     // Get the location and destination from the request
    //     $location = $request->input('location');
    //     $destination = $request->input('destination');

    //     // Calculate the distance using Google Maps Distance Matrix API
    //     $distance = $this->calculateDistance($location, $destination);

    //     // Ensure that both location and destination are valid Google addresses
    //     if (!$this->isValidAddress($location) || !$this->isValidAddress($destination)) {
    //         return redirect()->back()->withErrors(['message' => 'الرجاء إدخال الموقع والوجهة الصحيحة.']);
    //     }

    //     // Calculate fare based on distance
    //     if ($distance <= 3) {
    //         // Basic fare $3.8 + $0.38 for each additional km
    //         $fare = (350000 + 35000 * ($distance - 1)) / 90000;
    //     } elseif ($distance <= 20) {
    //         // Basic fare $3.8 + $0.33 for each additional km
    //         $fare = (350000 + 30000 * ($distance - 1)) / 90000;
    //     } else {
    //         // No basic fare for distances above 20 km, $0.88 for each km
    //         $fare = (80000 * $distance) / 90000;
    //     }

    //     // Round fare to 2 decimal places
    //     // $fare = round($fare, 1);
    //     $fare = number_format($fare);


    //     return view('fareResultAr', ['fare' => $fare, 'distance' => $distance]);
    // }

    private function calculateDistance($origin, $destination)
    {
        // Make a request to Google Maps Distance Matrix API
        $client = new Client();
        $response = $client->get('https://maps.googleapis.com/maps/api/distancematrix/json', [
            'query' => [
                'origins' => $origin,
                'destinations' => $destination,
                'key' => 'AIzaSyBdWfSJJ2c_entp53CpUFSIYnb960pQS5o',
            ]
        ]);

        // Parse the JSON response
        $data = json_decode($response->getBody(), true);

        // Check if the response contains distance information
        if (isset($data['rows'][0]['elements'][0]['distance']['value'])) {
            // Extract the distance from the response
            $distance = $data['rows'][0]['elements'][0]['distance']['value'] / 1000; // Distance in kilometers
            return $distance;
        } else {
            // Handle the case where distance information is not available
            // For example, you can return a default distance or throw an exception
            return null;
        }
    }


    // public function confirmFare(Request $request)
    // {
    //     // Retrieve fare confirmation data from request body
    //     $fareName = $request->input('name');
    //     $fareNum = $request->input('numb');
    //     $location = $request->input('location');
    //     $destination = $request->input('destination');
    //     $fare = $request->input('fare');
    //     $distance = $request->input('distance');


    //     // Send WhatsApp message using Twilio
    //     $twilio = new TwilioClient(env('TWILIO_SID'), env('TWILIO_TOKEN'));

    //     $twilio->messages->create(
    //         'whatsapp:+9613159525',
    //         [
    //             'from' => 'whatsapp:+14155238886',
    //             'body' => 'You have a new Trip Request.

    //                 Client name:
    //                 ' . $fareName . '
    //                 From:'
    //                 . $location . '
    //                 To:'
    //                 . $destination . '
                    
    //                 distance:'
    //                 . $distance . '

    //                 Estimated Fare:'
    //                 . $fare . '

    //                 Contact the client on their whatsapp:
    //                 https://wa.me/+961' . $fareNum
    //         ]
    //     );

    //     // Return response
    //     return redirect()->route('welcome')->with('success', 'Your order has been confirmed, we will contact you shortly.');
    // }

    // public function confirmFareAr(Request $request)
    // {
    //     // Retrieve fare confirmation data from request body
    //     $fareName = $request->input('name');
    //     $fareNum = $request->input('numb');
    //     $location = $request->input('location');
    //     $destination = $request->input('destination');
    //     $fare = $request->input('fare');
    //     $distance = $request->input('distance');

    //     // Send WhatsApp message using Twilio
    //     $twilio = new TwilioClient(env('TWILIO_SID'), env('TWILIO_TOKEN'));

    //     $twilio->messages->create(
    //         'whatsapp:+96176968224',
    //         [
    //             'from' => 'whatsapp:+14155238886',
    //             'body' => 'لديك تأكيد أجرة جديدة.

    //             اسم العميل:
    //                 ' . $fareName . '
    //                 من:'
    //                 . $location . '
    //                 الى:'
    //                 . $destination . '
    //                 المسافة:'
    //                 . $distance . '

    //                 السعر المتوقع:'
    //                 . $fare . '

    //                 تواصل مع العميل على الواتساب الخاص به:
    //                 https://wa.me/+961' . $fareNum
    //         ]
    //     );

    //     // Return response
    //     return redirect()->route('welcomeAr')->with('success', 'لقد تم تأكيد طلبك، وسوف نتصل بك قريبا.');
    // }

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
}