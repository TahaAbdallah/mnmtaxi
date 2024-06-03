<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking Page</title>
    <!-- Load Google Maps API with your API key -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdWfSJJ2c_entp53CpUFSIYnb960pQS5o&callback=initMap"
        async defer></script>
</head>

<body>
    <h1>Tracking Page</h1>
    <div id="map" style="height: 80vh;"></div>

    <script>
        // Declare map and marker variables globally
        let map;
        let marker;

        // Initialize the map and display driver's location
        function initMap() {
            // Check if the browser supports WebSocket
            if (!window.WebSocket) {
                console.error('WebSocket is not supported in this browser.');
                return;
            }

            // Set up WebSocket connection
            const socket = new WebSocket('wss://127.0.0.1:6001');
            // const socket = new WebSocket('wss://ws-eu.pusher.com/app/319a8e1b781f560f2a27?protocol=7&client=js&version=8.0&flash=false');

            // When the WebSocket connection is open, subscribe to the channel
            socket.addEventListener('open', () => {
                socket.send(JSON.stringify({ action: 'subscribe', channel: 'driver-location' }));
            });

            // When a message is received from the WebSocket server
            socket.addEventListener('message', (event) => {
                const eventData = JSON.parse(event.data);

                // Check if the message contains driver location update
                if (eventData.action === 'driver-location-update') {
                    const latitude = eventData.latitude;
                    const longitude = eventData.longitude;

                    // Update the map with the new driver location
                    updateMap(latitude, longitude);
                }
            });

            // Retrieve driver's location from the trip details
            @if(isset($driverLocation['latitude']) && isset($driverLocation['longitude']))
            const driverLocation = { lat: {{ $driverLocation['latitude'] }}, lng: {{ $driverLocation['longitude'] }} };

            // Create a map centered at the driver's location
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: driverLocation
            });

            // Add a marker at the driver's location
            marker = new google.maps.Marker({
                position: driverLocation,
                map: map,
                title: 'Driver Location'
            });
            @else
            console.error('Driver location data is not available.');
            @endif
        }

        // Function to update the map with the new driver location
        function updateMap(latitude, longitude) {
            // Check if map and marker variables are initialized
            if (!map || !marker) {
                console.error('Map or marker is not initialized.');
                return;
            }

            // Update the marker position
            marker.setPosition({ lat: latitude, lng: longitude });

            // Pan the map to the new location
            map.panTo({ lat: latitude, lng: longitude });
        }

        // Fetch driver's location every 10 seconds (adjust interval as needed)
        setInterval(fetchDriverLocation, 3000);

        function fetchDriverLocation() {
            // Make an AJAX request to fetch the latest driver location
            fetch('{{ route("trips.driver-location", ["trip" => $trip->id]) }}')
                .then(response => response.json())
                .then(data => {
                    const latitude = data.latitude;
                    const longitude = data.longitude;

                    // Update the map with the new driver location
                    updateMap(latitude, longitude);
                })
                .catch(error => console.error('Error fetching driver location:', error));
        }
    </script>
</body>

</html>