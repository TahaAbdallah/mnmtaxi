<nav class="topNav">

    <div class="logoUser">

        <div class="logoUserLeft">
            <img src="/images/MAndMLogo.png">
            <h1>Admin Control Panel</h1>
        </div>

        {{-- <div class="logoUserRight">
            <p>Taha Abdallah</p>
            <a href=""><img src="/icons/logout.png"></a>
        </div> --}}

    </div>


    <div class="navbarLinks">
        <a href={{ route("AdminPage") }} id="{{ request()->routeIs('AdminPage') ? 'active' : '' }}">All Trips</a>
        <a href={{ route("addTrip") }} id="{{ request()->routeIs('addTrip') ? 'active' : '' }}">Add Trip</a>
        <a href={{ route("driver") }} id="{{ request()->routeIs('driver') ? 'active' : '' }}">Drivers</a>
    </div>

</nav>