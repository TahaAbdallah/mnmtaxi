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
        <form action={{ route('saveAssignDriver', $trip->id) }} method="post" class="form">
            @csrf
            @method('PUT')

            <div>
                <h1>Assign a Driver</h1>
            </div>
            <div class="formInputs">

                <p>{{ $trip->client_name }}</p>
                <p>{{ $trip->client_phone_number }}</p>
                <p>{{$trip->location }}</p>
                <p>{{ $trip->destination }}</p>
                <p>{{ $trip->date }}</p>
                <p>{{$trip->time }}</p>
                <p>{{$trip->details }}</p>

                <div>
                    <label for="driver">Assign to driver :</label>
                    <select name="driver_id" id="driver_id">
                        @foreach ( $drivers as $id => $name )
                        <option value={{ $id }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div>
                <button>Assign the Driver</button>
            </div>
        </form>
    </section>

</body>

</html>