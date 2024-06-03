// JavaScript to hide success message after 3 seconds
setTimeout(function () {
    var successMessage = document.getElementById('alertSuccess');
    if (successMessage) {
        successMessage.style.display = 'none';
    }
}, 3000);

// -----------------------------------------------

// SEARCH INPUT
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.querySelector('.searchInput');

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            this.closest('form').submit();
        });
    }
});



// -----------------------------------------------

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

// Initialize Google Places Autocomplete for location and destination fields
function initAutocomplete() {
    var options = {
        types: ['establishment'],
        componentRestrictions: { country: 'lb' } // Restrict to Lebanon
    };
    var locationAutocomplete = new google.maps.places.Autocomplete(document.getElementById('location'), options);
    var destinationAutocomplete = new google.maps.places.Autocomplete(document.getElementById('destination'), options);
}

// Load the Google Places Autocomplete API
google.maps.event.addDomListener(window, 'load', initAutocomplete);





