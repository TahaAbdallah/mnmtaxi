{{-- NAVBAR --}}
<nav>
    <div class="topNavContent">
        <img src="icons/phoneIcon.png" alt="">
        <p href="">Call Us On :</p>
        <a href="https://wa.me/96176968224" target="_blank">+961 76 968 224</a>
        <p>|</p>
        <a href="https://wa.me/96176958565" target="_blank">+961 76 958 565</a>
        <p>|</p>
        <a href="https://wa.me/96171958565" target="_blank">+961 71 958 565</a>
    </div>

    <div class="mainNav">

        <div class="mainNavContent">
            <div><a href="/"><img src="images/MAndMLogo.png" alt=""></a></div>
            <div class="mainNavLinks">
                <a href="{{ route('welcome') }}" id="{{ request()->routeIs('welcome') ? 'active' : '' }}">Home</a>
                <a href="#ourServices">Our Services</a>
                <a href="{{ route('carpool') }}" id="{{ request()->routeIs('carpool') ? 'active' : '' }}">University
                    Carpooling</a>
                <a href="{{ route('about') }}" id="{{ request()->routeIs('about') ? 'active' : '' }}">About Us</a>
                <a href="{{ route('contact') }}" id="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact Us</a>

                <a href="{{ route('welcomeAr') }}" style="margin: 2px !important;margin-left:10px !important">عربي</a>
                <img src="images/langIcon.png" alt="" style="width:15px;color: #DD001B;">
            </div>

            <div class="mainNavBurger">
                <a onclick="openNav()"><img src="icons/burger.png" alt=""></a>
            </div>
        </div>

    </div>

    {{-- ----------------------------------------------------------------------- --}}

    <!-- The overlay -->
    <div id="myNav" class="overlay">

        <!-- Button to close the overlay navigation -->
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

        <!-- Overlay content -->
        <div class="overlay-content">
            <img src="images/langIcon.png" alt="" style="width:15px;color: #DD001B;">
            <a href="{{ route('welcomeAr') }}" style="margin: 2px !important;margin-left:10px !important;">عربي</a>
            <a href="{{ route('welcome') }}" id="{{ request()->routeIs('welcome') ? 'active' : '' }}">Home</a>
            <a href="#ourServices" onclick="closeNav()">Our Services</a>
            <a href="{{ route('carpool') }}" id="{{ request()->routeIs('carpool') ? 'active' : '' }}">University
                Carpooling</a>
            <a href="{{ route('about') }}" id="{{ request()->routeIs('about') ? 'active' : '' }}">About Us</a>
            <a href="{{ route('contact') }}" id="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact Us</a>
        </div>

    </div>

    <!-- Use any element to open/show the overlay navigation menu -->
    {{-- <span onclick="openNav()">open</span> --}}

    {{-- ----------------------------------------------------------------------- --}}



    <div class="mobileSecondNav">
        <a href="https://wa.me/96176968224" target="_blank">+961 76 968 224</a>
        <p>|</p>
        <a href="https://wa.me/96176958565" target="_blank">+961 76 958 565</a>
        <p>|</p>
        <a href="https://wa.me/96171958565" target="_blank">+961 71 958 565</a>
    </div>
</nav>