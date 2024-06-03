<head>
    <!-- Other meta tags and stylesheets -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdWfSJJ2c_entp53CpUFSIYnb960pQS5o&libraries=places">
    </script>
</head>


<h1>احسب أجرة رحلتك</h1>

<div class="fareCalculatorContainer">

    <div class="fareDesc">
        <h3>هل تخطط لرحلتك؟</h3>
        <p>
            استخدم حاسبة الأجرة المريحة لدينا لتقدير تكلفة رحلتك.
            ما عليك سوى إدخال نقطة البداية والوجهة، وسنزودك بتقدير فوري للأجرة بناءً على السعر
            على هيكل التسعير الشفاف لدينا.
        </p>
    </div>

    <div class="fareFormContainer">
        <form action={{ route('fare.calculationAr') }} method="post">
            @csrf
            <input type="text" name="location" id="location" placeholder="أدخل موقعك" autocomplete="off" required><br>
            <input type="text" name="destination" id="destination" placeholder="أدخل وجهتك" autocomplete="off"
                required><br>
            @if($errors->any())
            <div class="alert">
                <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <button type="button" onclick="getUserLocation()">استخدم موقعي</button>
            <button type="submit">حساب الأجرة</button>
            <button type="button" onclick="clearInputs()">مسح</button>
        </form>
    </div>

</div>

<script>
    // Function to get user's geolocation
    function getUserLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showUserLocation);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    // Function to handle the geolocation result
    function showUserLocation(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        var locationInput = document.getElementById('location');

        // Use reverse geocoding to get the address from coordinates
        var geocoder = new google.maps.Geocoder();
        var latlng = { lat: parseFloat(latitude), lng: parseFloat(longitude) };

        geocoder.geocode({ 'location': latlng }, function (results, status) {
            if (status === 'OK') {
                if (results[0]) {
                    locationInput.value = results[0].formatted_address;
                } else {
                    alert('No results found');
                }
            } else {
                alert('Geocoder failed due to: ' + status);
            }
        });
    }

    // Function to clear input fields
    function clearInputs() {
        document.getElementById('location').value = '';
        document.getElementById('destination').value = '';
    }

    // Initialize Google Places Autocomplete for location and destination fields
    function initAutocomplete() {
        var options = {
             types: ['establishment'],
            componentRestrictions: {country: 'lb'} // Restrict to Lebanon
        };
        var locationAutocomplete = new google.maps.places.Autocomplete(document.getElementById('location'), options);
        var destinationAutocomplete = new google.maps.places.Autocomplete(document.getElementById('destination'), options);
    }
    // Load the Google Places Autocomplete API
    google.maps.event.addDomListener(window, 'load', initAutocomplete);
</script>

<style>
    .fareCalculatorContainer {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 0px 25px;
    }

    .fareDesc {
        text-align: center
    }

    .fareFormContainer {
        width: fit-content;
        height: fit-content;
    }

    h1 {
        text-align: center;
        font-family: 'raleway';
        font-size: 35px;
        font-weight: 700;
        color: #DD001B;
        margin: 30px 0px !important;
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

    /* Add custom styles for the input fields */
    input[type="text"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .alert {
        padding: 2px;
        background-color: #f44336;
        /* Red color */
        color: white;
        border-radius: 5px;
        margin-bottom: 20px;
        position: relative;
    }

    .close-btn {
        position: absolute;
        top: 0;
        right: 10px;
        cursor: pointer;
        color: white;
        font-size: 20px;
    }

    .close-btn:hover {
        color: black;
    }

    /* Add custom styles for the buttons */
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


    @media screen and (max-width: 768px) {
        h1 {
            margin: 15px 0px !important;
        }

        h3 {
            font-family: 'raleway';
            font-size: 20px;
            font-weight: 700;
            color: #DD001B;
            text-align: center;
        }
    }


    @media screen and (max-width: 600px) {

        .fareCalculatorContainer {
            margin: 0px 5px;
        }

        h3 {
            font-family: 'raleway';
            font-size: 20px;
            font-weight: 700;
            color: #DD001B;
            margin: 15px 0px !important;
            text-align: center;
        }

        button {
            padding: 5px 10px;
            font-size: 14px;

        }
    }
</style>