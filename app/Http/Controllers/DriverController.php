<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DriverController extends Controller
{

    public function driverPage()
    {
        $drivers = Driver::paginate(10);
        return view('admin.drivers', ['drivers' => $drivers]);
    }

    public function create()
    {
        return view('admin.addDriver');
    }

public function storeDriver(Request $request)
{
    // Validate the request data
    $request->validate([
        'name' => 'required|string',
        'username' => 'required|string|unique:drivers',
        'password' => 'required|string',
        'driverPhoneNumber' => [
                'required',
                'string',
                'regex:/^(03|70|71|76|78|79|81)\d{6}$/',
                Rule::unique('drivers', 'driverPhoneNumber')->ignore($request->id) // Unique phone number in the drivers table
            ],
    ],
['driverPhoneNumber.unique' => 'The phone number has already been taken.',
            'driverPhoneNumber.regex' => 'The phone number must be 8 digits and start with 03, 70, 71, 76, 78, 79, or 81.',        ]);

    // Create a new driver instance
    Driver::create([
        'name' => $request->name,
        'username' => $request->username,
        'password' => bcrypt($request->password),
        'driverPhoneNumber' => $request->driverPhoneNumber,
    ]);

    $successMessage = 'Driver created successfully';
        return redirect()->route('driver')->with('successMessage', $successMessage);
}

public function destroyDriver($id)
{
    $driver = Driver::findOrFail($id);
    $driver->delete();

    return redirect()->route('driver')->with('successMessage', 'Driver deleted successfully');
}

public function editDriver($id)
{
    $driver = Driver::findOrFail($id);
    return view('admin.editDriver', ['driver' => $driver]);
}

public function updateDriver(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => [
            'required',
            'string',
            Rule::unique('drivers', 'name')->ignore($request->id)
        ],
        'driverPhoneNumber' => [
            'required',
            'string',
            'regex:/^(03|70|71|76|78|79|81)\d{6}$/',
            Rule::unique('drivers', 'driverPhoneNumber')->ignore($request->id) // Unique phone number in the drivers table
        ],
    ], [
        'name.unique' => 'The driver name has already been taken.',
        'driverPhoneNumber.unique' => 'The phone number has already been taken.',
        'driverPhoneNumber.regex' => 'The phone number must be 8 digits and start with 03, 70, 71, 76, 78, 79, or 81.',        ]);
        
        $driver = Driver::findOrFail($id);
    $driver->update($validatedData);

     $driver->trips()->update(['driver_id' => $driver->id]);

    $successMessage = 'Driver created successfully';
    return redirect()->route('driver')->with('successMessage', $successMessage);
}

}