<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MnM Taxi</title>

    <link rel="icon" href="{{ asset('images/MAndMLogo.png') }}">

    <link rel="stylesheet" href={{ asset("css/adminPage.css") }}>
    <link rel="stylesheet" href={{ asset("css/normalize.css") }}>

    {{-- GOOGLE PLACES SCRIPT --}}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdWfSJJ2c_entp53CpUFSIYnb960pQS5o&libraries=places">
    </script>

</head>

<body class="formBody">

    <section class="formContainer">
        <form action="{{ route('storeClientTrip') }}" method="post" class="form">
            @csrf
            <div>
                <h1>Trip Details</h1>
                <h3>Your estimated fare: ${{ $fare }}</h3>
                <h3>Distance: {{ $distance }} kilometers</h3>
            </div>
            <div class="formInputs">
                <input type="text" name="client_name" placeholder="Enter Your Name"></input>
                <input type="text" name="client_phone_number" placeholder="Phone Number"></input>
                <input type="text" name="location" value="{{ $location }}" id="location" placeholder="Location"
                    hidden></input>
                <input type="text" name="destination" value="{{ $destination }}" id="destination"
                    placeholder="Destination" hidden></input>
                <label for="date">Pickup Date:</label>
                <input type="date" name="date" title="Pickup Date"></input>
                <label for="time">Pickup Time:</label>
                <input type="time" name="time" title="Pickup Time"></input>
                <input type="text" name="driver_id" value="" hidden></input>
                <textarea name="details" placeholder="More details.." required></textarea>
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







{{--
<div class="everything">
    <div class="allCont">
        <div class="data">
            <div class="fareConfirmationTitle">
                <h3>Your estimated fare: ${{ $fare }}</h3>
                <p>Distance: {{ $distance }} kilometers</p>
            </div>

            <div class="fareConfirmationContainer">
                <form action={{ route('confirmFare') }} method="post" class="fareConfirmationForm">
                    @csrf
                    <input type="text" name="fare" value="{{ $fare }}" hidden></input>
                    <input type="text" name="distance" value="{{ $distance }}" hidden></input>
                    <input type="text" name="location" value="{{ $location }}" hidden></input>
                    <input type="text" name="destination" value="{{ $destination }}" hidden></input>
                    <input type="text" name="name" placeholder="Enter Your Name" required></input>
                    <input type="text" name="numb" placeholder="Enter Your Number" pattern="[0-9]{8}"
                        title="Please enter a valid phone number (03123456)" required></input>
                    <button>Confirm</button>
                </form>
            </div>
        </div>

    </div>
</div> --}}

{{-- <style>
    html {
        overflow: hidden;
    }

    .everything {
        background: #fff;
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .allCont {
        background: #f3f3f3;
        padding: 20px;
        border: 1px solid #e8e8e8;
        border-radius: 50px;
        width: 300px;
        height: 450px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .data {
        width: fit-content;
        height: fit-content;
    }

    h3 {
        text-align: center;
        font-family: 'raleway';
        color: #DD001B;
    }

    p {
        font-family: 'raleway';
        color: #272727;
    }

    .fareConfirmationTitle {
        text-align: center
    }

    .fareConfirmationContainer {
        display: flex;
        flex-direction: column;
        align-items: center;
        height: fit-content;
    }

    .fareConfirmationForm {
        display: flex;
        flex-direction: column;
        height: fit-content;

    }

    input {
        margin: 10px 0px;
    }

    button {
        padding: 10px 20px;
        margin-right: 10px;
        border: none;
        border-radius: 5px;
        background-color: #DD001B;
        color: #fff;
        cursor: pointer;
    }

    button:hover {
        background-color: #9e0114;
    }
</style> --}}