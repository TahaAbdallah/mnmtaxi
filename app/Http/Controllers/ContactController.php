<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\contact;

class ContactController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:8|numeric',
            'message' => 'required'
        ]);

        contact::create($request->all());

        return redirect()->back()
            ->with(['success' => 'Thank you for contacting us. we will contact you shortly.']);
    }

    public function storeAr(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:8|numeric',
            'message' => 'required'
        ]);

        Contact::create($request->all());

        return redirect()->back()
            ->with(['success' => 'شكرا لتواصلكم معنا, سنقوم بالرد بأسرع وقت ممكن']);
    }
}
