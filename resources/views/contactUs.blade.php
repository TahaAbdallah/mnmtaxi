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

    {{-- CONTACT US PAGE --}}

    <form method="POST" action="{{ route('contact.us.store') }}">
        {{ csrf_field() }}

        <div class="contactUsContainer">
            <div class="contactUsImg">
                <img src="/images/contactUs.png" alt="">
            </div>
        </div>

        <div class="contactForm">
            @if(Session::has('success'))
            <div>
                {{Session::get('success')}}
            </div>
            @endif


            <h4> Get in touch with us today!</h4>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Your Name">
            @if ($errors->has('name'))
            <span>{{ $errors->first('name') }}</span>
            @endif
            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Your Phone">
            @if ($errors->has('phone'))
            <span>{{ $errors->first('phone') }}</span>
            @endif
            <input type="text" name="email" value="{{ old('email') }}" placeholder="Your Email">
            @if ($errors->has('email'))
            <span>{{ $errors->first('email') }}</span>
            @endif
            <textarea name="message" rows="3" placeholder="Your Message"></textarea>
            @if ($errors->has('message'))
            <span class="text-danger">{{ $errors->first('message') }}</span>
            @endif
            <button>Send a Request</button>

        </div>

    </form>

    <div class="contactUsParag">
        <p>Contact us for prompt and helpful support. Our dedicated office staff is here to address all your inquiries
            and provide high-quality assistance. We value your feedback and are committed to ensuring your satisfaction.
        </p>
    </div>

    <div class="contactUsDetails">
        <div class="contactDetailsPhones">
            <h4>Our Address</h4>
            <p>Lebanon, Khaldeh Aramoun</p>
        </div>
        <div class="contactDetailsPhones">
            <h4>Our Phones</h4>
            <a href="">+961 76 968 224</a>
            <a href="">+961 76 968 224</a>
        </div>
        <div class="contactDetailsPhones">
            <h4>Our Mail</h4>
            <a href="mailto: info@mnmtaxilb.com">info@mnmtaxilb.com</a>
        </div>
    </div>
    {{-- FOOTER --}}

    @include('layout.footer')

</body>

</html>