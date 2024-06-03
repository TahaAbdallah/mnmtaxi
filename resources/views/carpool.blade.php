<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MnM Taxi</title>

    <link rel="icon" href="{{ asset('images/MAndMLogo.png') }}">
    <link rel="stylesheet" href={{ asset("css/homePage.css") }}>
    <link rel="stylesheet" href={{ asset("css/normalize.css") }}>
    <script src={{ asset("js/nav.js") }}></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script
        src="https://cdn.jsdelivr.net/gh/dubrox/Multiple-Dates-Picker-for-jQuery-UI@master/jquery-ui.multidatespicker.js">
    </script>
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

</head>

<body>

    {{-- NAVBAR --}}

    @include('layout.navbar')

    {{-- -------------------------------- --}}

    <div class="carpoolPageContainer"><img src="images/carpoolbg.jpg" alt="">
        <div class="carpoolPageContainerTop">
            <h1> University Carpooling</h1>
            <p>Experience convenience and savings with our reliable carpooling service for students. Enjoy flexible
                schedules, competitive prices, and eco-friendly commuting. Join our student community today for fun and
                economical rides.</p>
        </div>
    </div>

    <div class="carpoolPageContent">
        <div class="carpoolPageLeft">
            <div class="carpoolPageLeftContent">
                <h2>Instructions</h2>
                <p>Choose Direction: You can select traveling to the university (one-way) or traveling to and from the
                    university (round trip).</p>
                <p>Set Time: You can individually choose a time that suits you, or you can set a weekly or monthly
                    schedule
                    to accommodate your changing needs.</p>
                <p>Your Personal Information: Please provide your full personal details and university information so we
                    can
                    better assist you.</p>
                <p>Our customer service team will reach out to you to confirm the details and ensure the best experience
                    for
                    you in student transportation.</p>
            </div>
        </div>
        <div class="carpoolPageRight">
            <h2>Booking Section</h2>

            <form method="POST" action="{{ route('carpool.store') }}" class="carpoolForm">
                {{ csrf_field() }}

                @if(Session::has('success'))
                <div style="color:#DD001B;margin-bottom: 35px">
                    {{Session::get('success')}}
                </div>
                @endif

                <label for="name">Full Name</label>
                <input type="text" name="name" required>
                @if ($errors->has('name'))
                <span>{{ $errors->first('name') }}</span>
                @endif



                <label for="phone">Phone Number</label>
                <input type="tel" name="phone" required>
                @if ($errors->has('phone'))
                <span>{{ $errors->first('phone') }}</span>
                @endif

                <label for="address">Your Address ( From Where ? )</label>
                <input type="text" name="address" required>
                @if ($errors->has('address'))
                <span>{{ $errors->first('address') }}</span>
                @endif

                <label for="university">To University</label>
                <input type="text" name="university" required>
                @if ($errors->has('university'))
                <span>{{ $errors->first('university') }}</span>
                @endif


                <div class="tripContainer">
                    <a id="oneWayButton" class="oneWayButton">One-Way Trip</a>
                    <a id="roundTripButton" class="roundTripButton">Round Trip</a>
                </div>


                <label for="date">Choose your day(s) <img src="icons/calendar.png" width="15px"></label>
                <input type="text" name="date" id="date" required readonly>
                @if ($errors->has('date'))
                <span>{{ $errors->first('date') }}</span>
                @endif

                <script>
                    $(document).ready(function () {
                        $('#date').multiDatesPicker({
                            minDate: 0,
                            onSelect: function(dateText, inst) {
                                // Get all selected dates and join them with a comma
                                var selectedDates = $(this).multiDatesPicker('getDates');
                                $(this).val(selectedDates.join(', '));
                            }
                        });
                    });
                </script>

                <div class="dateTimeContainer">
                    <div id="departureContainer">
                        <label for="departureTime">Departure time</label>
                        <input type="time" name="departureTime" id="departureTime" required />
                        @if ($errors->has('departureTime'))
                        <span>{{ $errors->first('departureTime') }}</span>
                        @endif
                    </div>
                    <div id="comeBackContainer">
                        <label for="comeBackTime">Comeback time</label>
                        <input type="time" name="comeBackTime" id="comeBackTime" />
                        @if ($errors->has('comeBackTime'))
                        <span>{{ $errors->first('comeBackTime') }}</span>
                        @endif
                    </div>
                </div>

                <button>Submit</button>

            </form>

        </div>
    </div>

    <script>
        $("#roundTripButton").click(function () {
            $("#comeBackContainer").css('display', 'block')
            $("#roundTripButton").css('background-color', '#272727')
            $("#roundTripButton").css('color', '#ffff')
            $("#oneWayButton").css('background-color', '#fff')
            $("#oneWayButton").css('color', 'black')
            $("#oneWayButton").css('border', '1px solid #272727')
});

$("#oneWayButton").click(function () {
        $("#comeBackContainer").css('display', 'none')
        $("#roundTripButton").css('background-color', '#ffff')
            $("#roundTripButton").css('color', 'black')
            $("#oneWayButton").css('background-color', '#272727')
            $("#oneWayButton").css('color', '#ffff')
    });

    </script>




    {{-- FOOTER --}}

    @include('layout.footer')

</body>

</html>