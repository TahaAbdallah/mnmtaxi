<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Trip and Update Driver Location</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    <h1>Confirm Trip and Update Driver Location</h1>

    <div id="location-info">
        <!-- Display driver location information here -->
    </div>

    <form id="confirmation-form" method="POST" action="{{ route('trips.confirm', ['trip' => $trip->id]) }}">
        @csrf

        <button id="fetch-location-btn">Confirm Trip and Update Location</button>

        <div>
            <label hidden for="latitude">Latitude:</label>
            <input hidden type="text" id="latitude" name="driver_latitude" value="{{ old('driver_latitude') }}"
                required>
        </div>
        <div>
            <label hidden for="longitude">Longitude:</label>
            <input hidden type="text" id="longitude" name="driver_longitude" value="{{ old('driver_longitude') }}"
                required>
        </div>

    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.getElementById('fetch-location-btn').addEventListener('click', function() {
            // Check if geolocation is supported
            if (navigator.geolocation) {
                // Fetch the current position
                navigator.geolocation.getCurrentPosition(function(position) {
                    // Extract latitude and longitude from the position object
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    
                    // Update the location information in the view
                    document.getElementById('location-info').innerHTML = `
                        <p>Latitude: ${latitude}</p>
                        <p>Longitude: ${longitude}</p>
                    `;
                    
                    // Update the latitude and longitude fields in the form
                    document.getElementById('latitude').value = latitude;
                    document.getElementById('longitude').value = longitude;

                    // Submit the form automatically after fetching location
                    document.getElementById('confirmation-form').submit();
                }, function(error) {
                    // Handle geolocation errors
                    console.error('Error fetching location:', error.message);
                });
            } else {
                // Geolocation is not supported by the browser
                console.error('Geolocation is not supported.');
            }
        });

       // Function to send location updates to the server
function sendLocationUpdates(tripId) {
    // Send location updates every 2 seconds
    setInterval(function() {
        navigator.geolocation.getCurrentPosition(function(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;

            // Send location data to the server
            $.ajax({
                url: '/update-location',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                },
                data: {
                    trip_id: tripId,
                    latitude: latitude,
                    longitude: longitude
                },
                success: function(response) {
                    console.log('Location update successful');
                },
                error: function(xhr, status, error) {
                    console.error('Error updating location:', error);
                }
            });
        }, function(error) {
            console.error('Error fetching location:', error.message);
        });
    }, 2000); // Send location updates every 2 seconds
}

// Example usage: Call sendLocationUpdates function with the trip ID
sendLocationUpdates({{ $trip->id }});

    </script>
</body>

</html>