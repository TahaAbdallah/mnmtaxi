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
    <link rel="stylesheet" href={{ asset("css/multidatespicker.css") }}>
    <script src={{ asset("js/nav.js") }}></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script
        src="https://cdn.jsdelivr.net/gh/dubrox/Multiple-Dates-Picker-for-jQuery-UI@master/jquery-ui.multidatespicker.js">
    </script>
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script>
        // Store scroll position before form submission
        function storeScrollPosition() {
            sessionStorage.setItem('scrollPosition', window.scrollY);
        }
    
        // Restore scroll position after page reloads
        function restoreScrollPosition() {
            var scrollPosition = sessionStorage.getItem('scrollPosition');
            if (scrollPosition !== null) {
                window.scrollTo(0, scrollPosition);
                sessionStorage.removeItem('scrollPosition');
            }
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdWfSJJ2c_entp53CpUFSIYnb960pQS5o&libraries=places">
    </script>
</head>

<body>

    <!-- Add this script at the bottom of your HTML body -->
    <script>
        // Restore scroll position after page reloads
    window.onload = function() {
        restoreScrollPosition();
    };
    </script>

    @if(session('success'))
    <div class="top-alert">
        <span class="top-alert-close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
        {{ session('success') }}
    </div>
    @endif

    <style>
        .top-alert {
            padding: 20px;
            background-color: #f44336;
            /* Red color */
            color: white;
            border-radius: 5px;
            margin-bottom: 20px;
            position: relative;
            top: 0;
        }

        .top-alert-close-btn {
            position: absolute;
            top: 0;
            right: 10px;
            cursor: pointer;
            color: white;
            font-size: 25px;
        }

        .top-alert-close-btn:hover {
            color: black;
        }
    </style>

    @include('layout.navbar')



    {{-- LANDING PAGE --}}
    <div class="landingPageContainer">
        <div class="landingPage">
            <h1>Reliable And High Quality <span>Taxi</span> Service</h1>
            <h2>Choose our dependable taxi service today</h2>
            <img src="images/landingImage.png" alt="">
            <a href="https://wa.me/96176968224" target="_blank">Book Now</a>
        </div>
        <div class="landingPageHr">
            <hr>
        </div>
    </div>

    {{-- FARE CALCULATOR --}}

    @include('fareCalculator')


    {{-- OUR SERVICES --}}
    <div class="ourServicesContainer" id="ourServices">
        <h3>Our Services</h3>

        <div class="ourServicesDataContainer">

            <div class="servicetest">
                <div class="ourServicesData">
                    <div class="ourServicesDataImgcontainer">
                        <img src="images/airport.jpg" alt="">
                    </div>
                    <div>
                        <p><span>Airport Pickups:</span> Feel at home as soon as you step out of the airport with our
                            welcoming and seamless pickup service.</p>
                    </div>
                </div>

                <div class="ourServicesData">
                    <div class="ourServicesDataImgcontainer">
                        <img src="images/corporate.jpg" alt="">
                    </div>
                    <div>
                        <p><span>Corporate Accounts:</span> Focus on your business while we take care of the traffic and
                            transportation for you.</p>
                    </div>
                </div>
            </div>

            <div class="servicetest">
                <div class="ourServicesData">
                    <div class="ourServicesDataImgcontainer">
                        <img src="images/fullday.jpg" alt="">
                    </div>
                    <div>
                        <p><span>Full-Day Tours:</span> Explore the country's attractions in a car tailored to your
                            needs,
                            enjoying a memorable and customizable journey.</p>
                    </div>
                </div>

                <div class="ourServicesData">
                    <div class="ourServicesDataImgcontainer">
                        <img src="images/delivery.jpg" alt="">
                    </div>
                    <div>
                        <p><span>Delivery Service:</span> Focus on your business while we take care of the traffic and
                            transportation for you.</p>
                    </div>
                </div>
            </div>

        </div>


        {{-- CARPOOL SERVICE --}}

        <h3 id="carpoolTitle">University Carpooling Service</h3>
        <div class="carpoolService">
            <div><img src="images/carpool.jpg"></div>
            <div>
                <p>Experience convenience and savings with our reliable <span class="carpoolingSpan1">carpooling</span>
                    service for
                    students. Enjoy flexible
                    schedules, <span class="carpoolingSpan2">competitive prices</span>, and <span
                        class="carpoolingSpan3">eco-friendly</span> commuting. Join
                    our student community today for fun
                    and
                    economical rides.</p>
                <p id="carpoolGetInTouch">Get in touch with us today!</p>
                <a href="/university-carpooling">Make a Reservation Now !</a>
            </div>
        </div>

        {{-- WHATSAPP FORM SERVICE --}}



        <form method="post" action="{{ route('send.whatsapp') }}" onsubmit="storeScrollPosition()">
            @csrf

            <h3 id="goComeBackTitle">Go and Come Back Ride
            </h3>
            <div class="goComeBackImg">
                <img src="images/gobackride.jpg" alt="">
            </div>

            <div class="goComeBackContainer">

                <div class="goComeBackService">
                    <button type="submit" class="goComeBackBtn goComeBackBtnMob" target="_blank">
                        CONFIRM
                    </button>
                </div>

                <div class="goComeBackText">

                    <div>
                        <p>Experience the convenience of M&M Taxi's round-trip rides with our Go and Return service.
                            Book
                            once
                            and enjoy the flexibility for your entire journey. Enjoy flexible schedules, competitive
                            prices
                        </p>
                    </div>

                    <div class="goBackSched">

                        <label for="location">Your Location</label>
                        <input type="text" name="location" id="location" required />
                        <label for="destination">your Destination</label>
                        <input type="text" name="destination" id="destination" required />

                        <div class="dateCont">
                            <label class="chooseDay" for="date">Choose your day </label>
                            <input type="text" id="date" name="date" class="date" readonly>
                        </div>
                        <script>
                            $(document).ready(function () {
    $('#date').multiDatesPicker({
        minDate: 0,
        maxPicks: 1,
        onSelect: function(dateText, inst) {
            $(this).val(dateText);
        }
    });

  
});
                        </script>


                        <div class="dateTimeContainer">

                            <div class="timeCont">
                                <div id="">
                                    <label for="departureTime" class="timePicker">Departure time</label>
                                    <input type="time" name="departureTime" id="departureTime" required />
                                    @if ($errors->has('departureTime'))
                                    <span>{{ $errors->first('departureTime') }}</span>
                                    @endif
                                </div>
                                <div id="">
                                    <label for="comeBackTime" class="timePicker">Comeback time</label>
                                    <input type="time" name="comeBackTime" id="comeBackTime" />
                                </div>
                            </div>


                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                        </div>

                    </div>


                    <button type="submit" class="goComeBackBtn goComeBackBtnDesk" target="_blank">
                        CONFIRM
                    </button>

                </div>




        </form>



        {{-- ------------------ --}}

    </div>


    {{-- WHATSAPP SECTION --}}


    <div class="whatsappSection">
        <h3 id="whatsappSectionTitle">Booking Assistance On Whatsapp
        </h3>
        <div>
            <p>Need assistance or prefer to book through Whatsapp? we're here to help!
                <br>
                <br>
                Click the button belowto connect with us on Whatsapp.Our team is ready to assist you with any questions
                you may have or to help you complete your booking conveniently.
            </p>
        </div>

        <a class="whatsappSectionBtn" href="https://wa.me/96176968224" target="_blank">
            whatsapp
            {{-- <button id="subtest" onclick="test()" class="goComeBackBtn">CONFIRM</button> --}}
        </a>

    </div>



    {{-- WHAT WE OFFER --}}

    <div class="whatWeOfferContainer">
        <div class="whatWeOfferContent">
            <h4>What We Offer</h4>
            <p>Reliable and high-quality taxi service. Our licensed drivers are available anytime, anywhere. We
                prioritize
                your satisfaction and offer timely arrivals and efficient routes. Excitingly, we also offer a delivery
                service for your convenience. Experience exceptional customer support and a seamless transportation
                experience with us. Choose our dependable taxi service today.</p>
        </div>
    </div>


    {{-- APPLICATION SECTION --}}

    {{-- <div class="appContainer">

        <div class="appContent">
            <p class="appContentTitle">Experience our exceptional service, professionalism, and reliability for all your
                transportation and
                delivery needs.</p>

            <div class="appContentApplication">
                <div class="appContentApplicationLeft">
                    <p>Download Our Mobile App</p>
                    <a href="https://play.google.com/store/apps/details?id=com.mnm.taxiClient" target="_blank">
                        <img src="icons/googlePlay.png" alt="">
                    </a>
                    <a href="https://apps.apple.com/us/app/m-and-m-taxi/id1633544867?l=ar" target="_blank">
                        <img src="icons/appStore.png" alt="">
                    </a>
                </div>
                <div class="appContentApplicationRight">
                    <img src="images/phoneApp.png" alt="">
                </div>
            </div>
        </div>

    </div> --}}


    {{-- MAIN FEATURES SECTION --}}

    <div class="mainFeaturesContainer">
        <div class="mainFeaturesContent">
            <h4>MAIN FEATURES</h4>
            <h3>OUR BENEFITS</h3>
            <div class="mainFeaturesBigContent">

                <div class="mainFeaturesBigContentLeft">
                    <img src="images/ourBenefitsCar.png" alt="">
                </div>

                <div class="mainFeaturesBigContentRight">
                    <div class="mainFeaturesBigContentRightContent">
                        <img src="icons/cleanCarIcon.png" alt="">
                        <p class="mainFeaturesBigContentRightContentTitle">Clean Cars</p>
                    </div>
                    <p class="mainFeaturesBigContentRightContentParag">Experience the luxury of smoke-free, clean, and
                        well-maintained cars. We take pride in ensuring a
                        pristine environment for your comfort and enjoyment during your journey.</p>

                    <div class="mainFeaturesBigContentRightContent">
                        <img src="icons/timelyService.png" alt="">
                        <p class="mainFeaturesBigContentRightContentTitle">Timely Service</p>
                    </div>
                    <p class="mainFeaturesBigContentRightContentParag">We understand the importance of punctuality. With
                        our dedicated team, we guarantee that you will arrive at your destination on time, every time.
                        Count on us for reliable and efficient transportation.</p>

                    <div class="mainFeaturesBigContentRightContent">
                        <img src="icons/pleasure.png" alt="">
                        <p class="mainFeaturesBigContentRightContentTitle">M&M Pleasure</p>
                    </div>
                    <p class="mainFeaturesBigContentRightContentParag">Customer satisfaction is our top priority. With a
                        large number of loyal customers and high ratings, we strive to provide a 100% pleasurable
                        experience. Choose us for exceptional service and satisfaction.</p>

                    <div class="mainFeaturesBigContentRightContent">
                        <img src="icons/nationWide.png" alt="">
                        <p class="mainFeaturesBigContentRightContentTitle">Nationwide</p>
                    </div>
                    <p class="mainFeaturesBigContentRightContentParag">Booking a taxi has never been easier. Our
                        user-friendly application is available nationwide, making it convenient for you to reserve a
                        taxi with just a few simple steps. Enjoy hassle-free transportation wherever you go.</p>
                </div>

            </div>
        </div>
    </div>


    {{-- FINAL IMG --}}

    <div class="finalImg">
        <img src="images/finalImg.png" alt="">
    </div>

    {{-- ASSISTANCE SECTION --}}

    <div class="assistanceSectionContainer">
        <div class="assistanceSectionContent">
            <img src="icons/assistanceIcon.png" alt="">
            <h3>Have a Question Or Need Assistance ?</h3>
        </div>
        <p>Contact us for prompt and helpful support. Our dedicated office staff is here to address all your inquiries
            and provide high-quality assistance. We value your feedback and are committed to ensuring your satisfaction.
            Get in touch with us today!</p>

        <hr>
    </div>

    @include('layout.footer')

</body>

</html>