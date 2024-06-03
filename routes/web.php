<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WhatsAppController;
use App\Events\DriverLocation;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Http\Request;
use App\Models\Driver; 
use App\Http\Controllers\TripController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\TrackingController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'App\Http\Controllers\HomeController@home')->name('welcome');
Route::get('/university-carpooling', 'App\Http\Controllers\HomeController@carpool')->name('carpool');
Route::get('/about-us', 'App\Http\Controllers\HomeController@about')->name('about');
Route::get('/contact-us', 'App\Http\Controllers\HomeController@contact')->name('contact');


Route::get('/ar', 'App\Http\Controllers\HomeController@indexAr')->name('welcomeAr');
Route::get('/ar/university-carpooling', 'App\Http\Controllers\HomeController@carpoolAr')->name('carpoolAr');
Route::get('/ar/about-us', 'App\Http\Controllers\HomeController@aboutAr')->name('aboutAr');
Route::get('/ar/contact-us', 'App\Http\Controllers\HomeController@contactAr')->name('contactAr');


// EMAIL ROUTES 
Route::post('/contact-us', 'App\Http\Controllers\ContactController@store')->name('contact.us.store');
Route::post('/ar/contact-us', 'App\Http\Controllers\ContactController@storeAr')->name('contact.us.storeAr');


// CARPOOL ROUTES
Route::post('/university-carpooling', 'App\Http\Controllers\CarpoolController@store')->name('carpool.store');
Route::post('/ar/university-carpooling', 'App\Http\Controllers\CarpoolController@storeAr')->name('carpool.storeAr');


// WHATSAPP ROUTES
Route::post('/send-whatsapp', 'App\Http\Controllers\WhatsAppController@send')->name('send.whatsapp');
Route::any('/ar/send-whatsappAr', 'App\Http\Controllers\WhatsAppController@sendAr')->name('send.whatsappAr');


// FARE CALCULATION ROUTES
Route::any('/fare-calculator', 'App\Http\Controllers\FareCalculation@calculateFare')->name('fare.calculation');
Route::any('/confirm-fare', 'App\Http\Controllers\FareCalculation@confirmFare')->name('confirmFare');
Route::post('/store-client-trip', 'App\Http\Controllers\FareCalculation@storeClientTrip')->name('storeClientTrip');
Route::any('/fare-calculatorAr', 'App\Http\Controllers\FareCalculation@calculateFareAr')->name('fare.calculationAr');
Route::any('/confirm-fareAr', 'App\Http\Controllers\FareCalculation@confirmFareAr')->name('confirmFareAr');




/////////////////////// ADMIN ROUTE ///////////////////////

Route::get('/admin', 'App\Http\Controllers\AdminController@home')->name('AdminPage');
// TRIP ROUTES
Route::get('/admin/not-assigned', 'App\Http\Controllers\TripController@notAssigned')->name('notAssigned');
Route::get('/admin/assign-driver/{id}', 'App\Http\Controllers\TripController@assignDriver')->name('assignDriver');
Route::any('/admin/save-assign-driver/{id}', 'App\Http\Controllers\TripController@saveAssignDriver')->name('saveAssignDriver');
Route::get('/admin/add-trip', 'App\Http\Controllers\TripController@addTrip')->name('addTrip');
Route::post('/admin/adding-trip', 'App\Http\Controllers\TripController@store')->name('trips.store');
Route::any('/admin/trip-destroy/{id}', 'App\Http\Controllers\TripController@destroyTrip')->name('destroyTrip');



// DRIVER ROUTES
Route::get('/admin/drivers', 'App\Http\Controllers\DriverController@driverPage')->name('driver');
Route::get('/admin/drivers/create', 'App\Http\Controllers\DriverController@create')->name('drivers.create');
Route::post('/admin/drivers/creating', 'App\Http\Controllers\DriverController@storeDriver')->name('drivers.store');
Route::any('/admin/driver-destroy/{id}', 'App\Http\Controllers\DriverController@destroyDriver')->name('destroyDriver');
Route::get('/admin/driver/{id}/edit', 'App\Http\Controllers\DriverController@editDriver')->name('editDriver');
Route::any('/admin/driver-edit/{id}', 'App\Http\Controllers\DriverController@updateDriver')->name('updateDriver');









           


// routes/web.php


Route::get('/trips/confirm/{trip}', 'App\Http\Controllers\TripController@confirmView')->name('trips.confirm.view');
Route::post('/trips/confirm/{trip}', 'App\Http\Controllers\TripController@confirm')->name('trips.confirm');
Route::get('/trips/{trip}/finish', 'App\Http\Controllers\TripController@finishView')->name('trips.finish.view');
Route::post('/trips/{trip}/finish', 'App\Http\Controllers\TripController@finish')->name('trips.finish');
Route::post('/update-location', 'App\Http\Controllers\TripController@updateLocation');


Route::get('/tracking/{tripId}', 'App\Http\Controllers\TrackingController@showTrackingPage')->name('tracking');
Route::get('trips/{trip}/driver-location', 'App\Http\Controllers\TrackingController@getDriverLocation')->name('trips.driver-location');