<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MnM Taxi Admin Page</title>

    <link rel="icon" href="{{ asset('images/MAndMLogo.png') }}">

    <link rel="stylesheet" href={{ asset("css/adminPage.css") }}>
    <link rel="stylesheet" href={{ asset("css/normalize.css") }}>

</head>

<body class="formBody">

    @include('admin.adminLayout.adminNavbar')

    <section class="formContainer">
        <form action={{ route('updateDriver', $driver->id) }} method="post" class="form">
            @csrf
            @method('PUT')
            <div>
                <h1>Edit Driver</h1>
            </div>
            <div class="formInputs">
                <input type="text" name="name" value={{ $driver->name }}></input>
                @error('name')
                <span class="error">{{ $message }}</span>
                @enderror
                <input type="text" name="username" value={{ $driver->username }}></input>
                @error('username')
                <span class="error">{{ $message }}</span>
                @enderror
                <input type="text" name="driverPhoneNumber" value={{$driver->driverPhoneNumber }}></input>
                @error('driverPhoneNumber')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <button>Update</button>
            </div>
        </form>
    </section>

</body>

</html>