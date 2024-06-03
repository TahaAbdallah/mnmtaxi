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

    {{-- GOOGLE PLACES SCRIPT --}}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdWfSJJ2c_entp53CpUFSIYnb960pQS5o&libraries=places">
    </script>

    <script src={{ asset('adminJs/addTrip.js') }}></script>
</head>

<body class="formBody">

    @include('admin.adminLayout.adminNavbar')

    <section class="formContainer">
        <form action="{{ route('trips.store') }}" method="POST" class="form">
            @csrf
            <div>
                <h1>Add a new Trip</h1>
            </div>
            <div class="formInputs">
                <input type="text" name="client_name" placeholder="Client Name"></input>
                <input type="text" name="client_phone_number" placeholder="Client Phone Number"></input>
                <input type="text" name="location" id="location" placeholder="Location"></input>
                <input type="text" name="destination" id="destination" placeholder="Destination"></input>
                <input type="date" name="date" title="Pickup Date"></input>
                <input type="time" name="time" title="Pickup Time"></input>
                <div>
                    <label for="driver">Assign to driver :</label>
                    <select name="driver_id" id="driver_id">
                        @foreach ( $drivers as $id => $name )
                        <option value={{ $id }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <textarea name="details" placeholder="you can add more details.." required></textarea>
            </div>
            <div>
                <button>Submit</button>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

        </form>

    </section>

</body>

</html>