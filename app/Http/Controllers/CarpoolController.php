<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\carpool;

class CarpoolController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => ['required', 'string', 'regex:/^[^\d]+$/'],
            'phone' => 'required',
            'address' => 'required',
            'university' => 'required',
            'date' => 'required',
            'departureTime' => 'required|date_format:H:i',
            'comeBackTime' => 'nullable|date_format:H:i',
        ], [
            'comeBackTime.after' => 'The come back time must be after the departure time.',
        ]);

        $name = $request->input('name');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $university = $request->input('university');
        $date = $request->input('date');
        $timeSlot1 = $request->input('departureTime');
        $timeSlot2 = $request->input('comeBackTime');

        // Convert time slots to 12-hour format with AM/PM indication
        $timeSlot1Formatted = date("h:i A", strtotime($timeSlot1));
        $timeSlot2Formatted = $timeSlot2 ? date("h:i A", strtotime($timeSlot2)) : null;

        $message = "Hello I need to take the university carpool Service.\n
        One way Trip\n\n
        My name is: $name\n
        Phone number: $phone\n\n
        My Address: $address\n
        University: $university\n\n
        Date: $date\n
        Departure Time: $timeSlot1Formatted";

        // Append comeback time to the message if it's not null
        if ($timeSlot2Formatted) {
            $message = "Hello I need to take the university carpool Service.\n
        Two way Trip\n\n
        My name is: $name\n
        Phone number: $phone\n\n
        My Address: $address\n
        University: $university\n\n
        Date: $date\n
        Departure Time: $timeSlot1Formatted
        \nComeback Time: $timeSlot2Formatted";
        }

        // Construct WhatsApp URL with message
        $url = "https://wa.me/+96176968224?text=" . urlencode($message);

        // Redirect to WhatsApp URL
        return redirect($url);
    }

    public function storeAr(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => ['required', 'string', 'regex:/^[^\d]+$/'],
            'phone' => 'required',
            'address' => 'required',
            'university' => 'required',
            'date' => 'required',
            'departureTime' => 'required|date_format:H:i',
            'comeBackTime' => 'nullable|date_format:H:i',
        ], [
            'comeBackTime.after' => 'The come back time must be after the departure time.',
        ]);

        $name = $request->input('name');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $university = $request->input('university');
        $date = $request->input('date');
        $timeSlot1 = $request->input('departureTime');
        $timeSlot2 = $request->input('comeBackTime');

        // Convert time slots to 12-hour format with AM/PM indication
        $timeSlot1Formatted = date("h:i A", strtotime($timeSlot1));
        $timeSlot2Formatted = $timeSlot2 ? date("h:i A", strtotime($timeSlot2)) : null;

        $message = "مرحبا اريد خدمة نقل الطلاب\n
    اتجاه واحد\n\n
            الاسم:\n
             $name\n
            الرقم: \n
            $phone\n\n
            العنوان:\n
             $address\n
            الجامعة:\n
             $university\n\n
            التاريخ:\n
             $date\n
            وقت الذهاب:\n
             $timeSlot1Formatted";

        // Append comeback time to the message if it's not null
        if ($timeSlot2Formatted) {
            $message = "مرحبا اريد خدمة نقل الطلاب\n
        اتجاه ذهاب و اياب\n\n
            الاسم:\n
             $name\n
            الرقم: \n
            $phone\n\n
            العنوان:\n
             $address\n
            الجامعة:\n
             $university\n\n
            التاريخ:\n
             $date\n
            وقت الذهاب:\n
             $timeSlot1Formatted
        وقت العودة:\n
         $timeSlot2Formatted";
        }

        // Construct WhatsApp URL with message
        $url = "https://wa.me/+96176968224?text=" . urlencode($message);

        // Redirect to WhatsApp URL
        return redirect($url);
    }
}
