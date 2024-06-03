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

    <script src={{ asset('adminJs/addTrip.js') }}></script>
</head>

<body>

    @include('admin.adminLayout.adminNavbar')

    <section class="tableSection">

        @if(session('successMessage'))
        <div id="alertSuccess">
            {{ session('successMessage') }}
        </div>
        @endif

        <h1>All Trips</h1>

        <form method="GET" action="{{ route('AdminPage') }}">
            <input type="text" name="search" class="searchInput" placeholder="Search for Trips.."
                title="Type in a name or phone number" value="{{ request()->input('search') }}">
        </form>
        <button class="notAssigned" onclick="window.location.href='{{ route('notAssigned') }}'">Not Assigned
            Trips</button>

        <div class="tableOverflow">
            @if ($trips->isEmpty())

            <table class="adminTable">
                <tr class="header">
                    <th>Client Name</th>
                    <th>Phone Number</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Date & Time</th>
                    <th>Assigned To</th>
                    <th>Status</th>
                    <th>Live Tracking</th>
                    <th>Share Tracking</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td>
                        <p>No Trips available.</p>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>

            @else
            <table class="adminTable">
                <tr class="header">
                    <th>Client Name</th>
                    <th>Phone Number</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Date & Time</th>
                    <th>Assigned To</th>
                    <th>Status</th>
                    <th>Live Tracking</th>
                    <th>Share Tracking</th>
                    <th>Action</th>
                </tr>
                @foreach ($trips as $trip )
                @if (is_null($trip->driver))
                <tr onclick="window.location.href='{{ route('assignDriver', $trip->id) }}'">
                    <td>{{ $trip -> client_name }}</td>
                    <td>{{ $trip -> client_phone_number }}</td>
                    <td>{{ $trip -> location }}</td>
                    <td>{{ $trip -> destination }}</td>
                    <td>{{ $trip->date}} | {{ $trip ->time }}</td>
                    <td>Not Assigned</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td id="deleteBtn">
                        <a href="{{ route('destroyTrip', $trip->id) }}"
                            onclick="return confirm('Are you sure you want to delete this driver?')">
                            X
                        </a>
                    </td>
                </tr>

                @else
                <tr>
                    <td>{{ $trip -> client_name }}</td>
                    <td>{{ $trip -> client_phone_number }}</td>
                    <td>{{ $trip -> location }}</td>
                    <td>{{ $trip -> destination }}</td>
                    <td>{{ $trip->date}} | {{ $trip ->time }}</td>
                    <td>{{ $trip->driver->name }}</td>
                    <td>{{ $trip->status }}</td>
                    <td style="text-align:center"><a href="{{ route('tracking',$trip->id) }}" target="_blank">
                            <img src="{{ asset('icons/track.png') }}" height="40px"></a></td>
                    <td style="text-align:center">
                        <a href="#" id="shareButton" data-url="{{ route('tracking',$trip->id) }}"><img src={{
                                asset('icons/share.png') }} height="30px"></a>
                    </td>
                </tr>
                @endif
                </tr>
                @endforeach
            </table>
        </div>

        <script>
            document.getElementById('shareButton').addEventListener('click', function() {
    // Get the URL you want to share
    var urlToShare = this.getAttribute('data-url');;

    // Check if the browser supports the Web Share API
    if (navigator.share) {
        navigator.share({
            title: 'Share Link',
            url: urlToShare
        })
        .then(() => console.log('Link shared successfully'))
        .catch((error) => console.error('Error sharing link:', error));
    } else {
        // Fallback for browsers that do not support Web Share API
        // You can use any other method here to share the link
        // For example, opening a new window with the shareable link
        window.open('https://api.whatsapp.com/send?text=' + encodeURIComponent(urlToShare), '_blank');
    }
});
        </script>

        {{ $trips->links('vendor.pagination.bootstrap-5') }}
        @endif
    </section>

</body>

</html>