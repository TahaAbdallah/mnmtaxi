<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MnM Taxi</title>

    <link rel="icon" href="{{ asset('images/MAndMLogo.png') }}">
    <link rel="stylesheet" href={{ asset("css/homePage.css") }}>
    <link rel="stylesheet" href={{ asset("css/normalize.css") }}>
    <script src={{ asset("js/nav.js") }}></script>

</head>

<body>

    @include('layout.navbar')

    {{-- ABOUT US PAGE --}}

    <div class="aboutUsContainer">
        <h3>About Us</h3>
        <div class="aboutUsImg">
            <img src="images/aboutUs.png" alt="">
        </div>

        <p>M&M Taxi is a Lebanon-based company that offers dependable, punctual, and secure taxi services, Our
            company
            embraces an innovative operating model and a flexible management system, enabling us to readily adapt to
            the
            evolving demands of our customers and the market.M&M Taxi takes pride in providing reliable
            transportation
            solutions to our valued customers. Whether you need a ride to the airport, a quick trip to run errands,
            or
            transportation for a special event, our professional drivers are committed to delivering a superior
            experience.
            With our user-friendly taxi app, booking a ride has never been easier. Simply download the M&M Taxi app,
            input
            your pick-up and drop-off locations, and our advanced system will efficiently dispatch a nearby driver
            to
            your
            location.At M&M Taxi, we understand that customer satisfaction is paramount. That's why we strive to
            deliver
            exceptional service with every ride. Our drivers are courteous, professional, and well-versed in
            navigating
            the
            local area, ensuring a smooth and enjoyable journey. Additionally, our fares are competitive and
            transparent,
            providing our customers with fair pricing and no surprises.</p>
    </div>

    <div class="aboutUsSecondContainer">
        <h4>Our Fleet :</h4>
        <p>To exceed your expectations, M&M Taxi maintains a diverse fleet of vehicles that will surpass your needs. Our
            expanding fleet consists of brand-new cars that are owned, maintained, and operated by our company,
            guaranteeing
            top-quality service.</p>
        <h4>Our Drivers :</h4>
        <p>M&M Taxi is dedicated to providing an exceptional customer experience, and we understand that our drivers
            play a
            vital role as the first point of contact with our clients. With a strong focus on customer satisfaction, we
            carefully select our drivers and provide them with ongoing training to ensure a customer-oriented approach.
        </p>
        <h4>Our Objectives :</h4>
        <p>at M&M Taxi revolve around establishing ourselves as the premier choice for taxi services in Lebanon. Through
            an
            aggressive marketing campaign, we aim to secure a leading position in the market and become the number one
            taxi
            company in the country.</p>
        <h4>Our Team :</h4>
        <p>Behind our success is a dedicated team at our Call Center & Dispatcher. They employ a state-of-the-art
            dispatching system that efficiently assigns the closest vehicle on the map when a call comes in, ensuring
            timely
            service for our customers. Our operators receive orders and enter them into the system, while our
            dispatchers
            coordinate and monitor the fleet.</p>
        <h4>Our Values :</h4>
        <p>At M&M Taxi, our values shape every aspect of our operations. We are committed to delivering convenience,
            prioritizing our clients' needs, and ensuring their safety throughout the taxi experience. To cater to
            different
            requirements.</p>
        <h4>Our Vision :</h4>
        <p>at M&M Taxi is to maintain our competitive edge through flexibility and professionalism in a dynamic
            environment.
            We believe that our full-time employees, whether drivers or staff, contribute to our success through their
            helpful and courteous behaviour, which remains a key element of our service.</p>
    </div>

    <div class="aboutUsThirdContainer">
        <div class="aboutUsThirdContainerContent">
            <p>Choose M&M Taxi for a convenient, client-centric, and safe taxi experience. Our dedicated team, modern
                fleet,
                and commitment to excellence make us the ideal choice for all your transportation needs. Download the
                M&M
                Taxi app today and discover the difference.</p>
        </div>
    </div>
    {{-- FOOTER --}}

    @include('layout.footer')

</body>

</html>