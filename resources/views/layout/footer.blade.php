{{-- FOOTER --}}

<footer>
    <div class="footerLeft">
        <a href="">
            <img src="images/MAndMLogo.png" alt="">
        </a>
        <p>Reliable And High Quality Taxi Service</p>
        <div class="footerLeftContent">
            <img src="icons/emailIcon.png" alt="">
            <a href="mailto: info@mnmtaxilb.com">info@mnmtaxilb.com</a>
        </div>
        <div class="footerLeftContent">
            <div>
                <img src="icons/telephoneIcon.png" alt="">
            </div>
            <div class="footerPhoneContent">
                <a href="https://wa.me/96176968224" target="_blank"> +961 76 968 224</a>
                <p> | </p>
                <a href="https://wa.me/96176958565" target="_blank">+961 76 958 565</a>
                <p> | </p>
                <a href="https://wa.me/96171958565" target="_blank">+961 71 958 565</a>
            </div>
        </div>
        <div class="footerLeftContent">
            <img src="icons/locationIcon.png" alt="">
            <a>Lebanon, Khaldeh Aramoun</a>
        </div>
    </div>
    <div class="footerRight">
        <a href="{{ route('welcome') }}" id="{{ request()->routeIs('welcome') ? 'active' : '' }}">Home</a>
        <a href="#ourServices">Our Services</a>
        <a href="{{ route('carpool') }}" id="{{ request()->routeIs('carpool') ? 'active' : '' }}">University
            Carpooling</a>
        <a href="{{ route('about') }}" id="{{ request()->routeIs('about') ? 'active' : '' }}">About Us</a>
        <a href="{{ route('contact') }}" id="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact Us</a>
    </div>
</footer>

<div class="footerHrContainer">
    <hr class="footerHr">
</div>

<div class="finalFooter">
    <a>M&M Taxi © 2023. All Rights Reserved. Powered by Sun Design Agency.</a>
    <div class="finalFooterIcons">
        <a href="https://instagram.com/mandmtaxis?igshid=MzRlODBiNWFlZA==" target="_blank">
            <img src="icons/instagramIcon.png" alt="">
        </a>
        <a href="https://wa.me/96176968224" target="_blank">
            <img src="icons/whatsappIcon.png" alt="">
        </a>
    </div>
</div>