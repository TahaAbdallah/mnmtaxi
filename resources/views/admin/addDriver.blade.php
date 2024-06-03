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
        <form action="{{ route('drivers.store') }}" method="POST" class="form">
            @csrf
            <div>
                <h1>Add a new Driver</h1>
            </div>
            <div class="formInputs">
                <input type="text" name="name" placeholder="Driver Name"></input>
                @error('name')
                <span class="error">{{ $message }}</span>
                @enderror
                <input type="text" name="username" placeholder="Driver Username"></input>
                @error('username')
                <span class="error">{{ $message }}</span>
                @enderror
                <input type="password" name="password" placeholder="Password"></input>
                @error('password')
                <span class="error">{{ $message }}</span>
                @enderror
                <input type="text" name="driverPhoneNumber" placeholder="Driver Phone Number"></input>
                @error('driverPhoneNumber')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <button>Add Driver</button>
            </div>
        </form>


    </section>

</body>

</html>