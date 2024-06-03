<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class HomeController extends Controller
{

    public function home()
    {
        return view('welcome');
    }

    public function carpool()
    {
        return view('carpool');
    }

    public function about()
    {
        return view('aboutUs');
    }

    public function contact()
    {
        return view('contactUs');
    }


    public function indexAr()
    {
        return view('welcomeAr');
    }

    public function carpoolAr()
    {
        return view('carpoolAr');
    }

    public function aboutAr()
    {
        return view('aboutUsAr');
    }

    public function contactAr()
    {
        return view('contactUsAr');
    }

   
}