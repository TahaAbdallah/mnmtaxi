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

    {{-- NAVBAR --}}

    @include('layout.navbarAr')

    {{-- ABOUT US PAGE --}}

    <form method="POST" action="{{ route('contact.us.storeAr') }}">
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


            <h4> قم بالتواصل معنا اليوم !</h4>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="اسمك">
            @if ($errors->has('name'))
            <span>{{ $errors->first('name') }}</span>
            @endif
            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="رقم الهاتف">
            @if ($errors->has('phone'))
            <span>{{ $errors->first('phone') }}</span>
            @endif
            <input type="text" name="email" value="{{ old('email') }}" placeholder="الايميل">
            @if ($errors->has('email'))
            <span>{{ $errors->first('email') }}</span>
            @endif
            <textarea name="message" rows="3" placeholder="رسالتك"></textarea>
            @if ($errors->has('message'))
            <span class="text-danger">{{ $errors->first('message') }}</span>
            @endif
            <button>ارسال الطلب</button>

        </div>

    </form>

    <div class="contactUsParag">
        <p>اتصل بنا للحصول على دعم سريع ومفيد. موظفونا المتخصصون موجودون هنا للرد على جميع استفساراتك وتقديم مساعدة
            عالية الجودة. نحن نقدر ملاحظاتك ونلتزم بضمان رضاك
        </p>
    </div>

    <div dir="rtl" class="contactUsDetails">
        <div class="contactDetailsPhones">
            <h4>عنواننا</h4>
            <p>لبنان, خلده عرمون</p>
        </div>
        <div dir="ltr" class="contactDetailsPhones">
            <h4>ارقامنا</h4>
            <a href="">+961 76 968 224</a>
            <a href="">+961 76 968 224</a>
        </div>
        <div class="contactDetailsPhones">
            <h4>الايميل</h4>
            <a href="mailto: info@mnmtaxilb.com">info@mnmtaxilb.com</a>
        </div>
    </div>


    {{-- FOOTER --}}

    @include('layout.footerAr')

</body>

</html>