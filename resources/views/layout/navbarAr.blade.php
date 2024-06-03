<nav>
    <div class="topNavContent">
        <img src="/icons/phoneIcon.png" alt="">
        <p href="">اتصل بنا :</p>
        <a href="https://wa.me/96176968224" target="_blank">+961 76 968 224</a>
        <p>|</p>
        <a href="https://wa.me/96176958565" target="_blank">+961 76 958 565</a>
        <p>|</p>
        <a href="https://wa.me/96171958565" target="_blank">+961 71 958 565</a>
    </div>

    <div class="mainNav">
        <div class="mainNavContent">
            <div><a href="/ar"><img src="/images/MAndMLogo.png" alt=""></a></div>
            <div class="mainNavLinks">
                <a href="{{ route('welcomeAr') }}"
                    id="{{ request()->routeIs('welcomeAr') ? 'active' : '' }}">الرئيسية</a>
                <a href="/ar/#ourServices" id="">خدماتنا</a>

                <a href="{{ route('carpoolAr') }}" id="{{ request()->routeIs('carpoolAr') ? 'active' : '' }}">
                    نقل
                    طلاب الجامعات</a>

                <a href="{{ route('aboutAr') }}" id="{{ request()->routeIs('aboutAr') ? 'active' : '' }}">معلومات
                    عنا</a>
                <a href="{{ route('contactAr') }}" id="{{ request()->routeIs('contactAr') ? 'active' : '' }}">تواصل
                    معنا</a>

                <a href="{{ route('welcome') }}" style="margin: 2px !important;margin-left:10px !important">English</a>
                <img src="/images/langIcon.png" alt="" style="width:15px;color: #DD001B;">
            </div>
            <div class="mainNavBurger">
                <a onclick="openNav()"><img src="/icons/burger.png" alt=""></a>
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
            <img src="/images/langIcon.png" alt="" style="width:15px;color: #DD001B;">
            <a href="{{ route('welcome') }}" style="margin: 2px !important;margin-left:10px !important;">English</a>
            <a href="{{ route('welcomeAr') }}" id="{{ request()->routeIs('welcomeAr') ? 'active' : '' }}">الرئيسية</a>
            <a href="/ar/#ourServices" onclick="closeNav()">خدماتنا</a>
            <a href="{{ route('carpoolAr') }}" id="{{ request()->routeIs('carpoolAr') ? 'active' : '' }}">نقل طلاب
                الجامعات</a>
            <a href="{{ route('aboutAr') }}" id="{{ request()->routeIs('aboutAr') ? 'active' : '' }}">معلومات عنا</a>
            <a href="{{ route('contactAr') }}" id="{{ request()->routeIs('contactAr') ? 'active' : '' }}">تواصل معنا</a>
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