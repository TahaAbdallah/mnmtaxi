<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class WhatsAppController extends Controller
{

    public function sendPage()
    {
        return view('send-whatsapp');
    }


    public function send(Request $request)
    {
        // Validate the request data
        $request->validate([
            'location' => 'required',
            'destination' => 'required',
            'date' => 'required|date',
            'departureTime' => 'required|date_format:H:i',
            'comeBackTime' => 'required|date_format:H:i|after:departureTime',
        ], [
            'comeBackTime.after' => 'The come back time must be after the departure time.',
        ]);

        $location = $request->location;
        $destination = $request->destination;
        $date = $request->input('date');
        $timeSlot1 = $request->input('departureTime');
        $timeSlot2 = $request->input('comeBackTime');

        // Convert time slots to 12-hour format with AM/PM indication
        $timeSlot1Formatted = date("h:i A", strtotime($timeSlot1));
        $timeSlot2Formatted = date("h:i A", strtotime($timeSlot2));

        // Construct message with date and time slots
        $message = "Hello I need to take the Go and Return Service.\n\nDate: $date\nDeparture Time: $timeSlot1Formatted\nComeback Time: $timeSlot2Formatted\n\nLocation: $location\n\nDestination : $destination";

        // Construct WhatsApp URL with message
        $url = "https://wa.me/+96176968224?text=" . urlencode($message);

        // Redirect to WhatsApp URL
        return redirect($url);
    }

    public function sendAr(Request $request)
    {
        // Validate the request data
        $request->validate([
            'location' => 'required',
            'destination' => 'required',
            'date' => 'required|date',
            'departureTime' => 'required|date_format:H:i',
            'comeBackTime' => 'required|date_format:H:i|after:departureTime',
        ], [
            'comeBackTime.after' => 'The come back time must be after the departure time.',
        ]);

        $location = $request->location;
        $destination = $request->destination;
        $date = $request->input('date');
        $timeSlot1 = $request->input('departureTime');
        $timeSlot2 = $request->input('comeBackTime');

        // Convert time slots to 12-hour format with AM/PM indication
        $timeSlot1Formatted = date("h:i A", strtotime($timeSlot1));
        $timeSlot2Formatted = date("h:i A", strtotime($timeSlot2));

        // Construct message with date and time slots
        $message = "مرحبا اريد خدمة الذهاب والعودة\n\nالتاريخ: $date\n\nوقت الذهاب:\n $timeSlot1Formatted\n\nوقت العودة:\n $timeSlot2Formatted\n\nالعنوان: $location\n\nالوجهة : $destination";

        // Construct WhatsApp URL with message
        $url = "https://wa.me/+96176968224?text=" . urlencode($message);

        // Redirect to WhatsApp URL
        return redirect($url);
    }
}
