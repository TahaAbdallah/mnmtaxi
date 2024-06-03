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






        <div class="flexBetween">
            <div>
                <h1 style="margin: 0px">All Drivers</h1>
            </div>
            <div>
                <a href={{ route("drivers.create") }}>
                    <button>Add a Driver</button>
                </a>
            </div>
        </div>

        @if ($drivers->isEmpty())
        <div class="tableOverflow">
            <table class="adminTable" style="width: 100%">
                <tr class="header">
                    <th>Driver Name</th>
                    <th>Driver Username</th>
                    <th>Phone Number</th>
                    <th>Action</th>
                </tr>

                <tr>
                    <td>
                        <p>No drivers available.</p>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

            </table>
        </div>

        @else

        <div class="tableOverflow">
            <table class="adminTable" style="width: 100%">
                <tr class="header">
                    <th>Driver Name</th>
                    <th>Driver Username</th>
                    <th>Phone Number</th>
                    <th>Action</th>
                </tr>

                @foreach ($drivers as $driver)

                <tr>
                    <td>{{ $driver->name }}</td>
                    <td>{{ $driver->username }}</td>
                    <td>{{ $driver->driverPhoneNumber }}</td>
                    <td id="deleteBtn">
                        <a href="{{ route('editDriver', $driver->id) }}">
                            <img src="/icons/edit.png">
                        </a>

                        <a href="{{ route('destroyDriver', $driver->id) }}"
                            onclick="return confirm('Are you sure you want to delete this driver?')">
                            X
                        </a>


                    </td>
                </tr>

                @endforeach


            </table>
        </div>

        {{ $drivers->links('vendor.pagination.bootstrap-5') }}


        @endif
    </section>



</body>

</html>