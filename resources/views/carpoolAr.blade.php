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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script
        src="https://cdn.jsdelivr.net/gh/dubrox/Multiple-Dates-Picker-for-jQuery-UI@master/jquery-ui.multidatespicker.js">
    </script>
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

</head>

<body>

    {{-- NAVBAR --}}

    @include('layout.navbarAr')

    {{-- --------------------------------- --}}

    <div class="carpoolPageContainer"><img src="/images/carpoolbg.jpg" alt="">
        <div class="carpoolPageContainerTop">
            <h1>خدمة نقل طلاب الجامعات</h1>
            <p>استمتع بالراحة والتوفير مع خدمة مشاركة السيارات الموثوقة للطلاب. احصل على جداول زمنية مرنة وأسعار تنافسية
                ووسيلة مواصلات صديقة للبيئة. انضم إلى مجتمع الطلاب اليوم للرحلات الممتعة والاقتصادية
            </p>
        </div>
    </div>

    <div class="carpoolPageContent">
        <div class="carpoolPageLeft">
            <div class="carpoolPageLeftContent">
                <h2>التعليمات</h2>
                <p>اختيار الاتجاه: يمكنك اختيار التنقل إلى الجامعة (اتجاه واحد) أو التنقل إلى ومن الجامعة (اتجاه ذهاب
                    وإياب)</p>
                <p>تحديد الوقت: يمكنك اختيار الوقت الذي يناسبك بشكل فردي، أو يمكنك تعيين جدول أسبوعي أو شهري لتلبية
                    احتياجاتك المتغيرة</p>
                <p>معلوماتك الشخصية: يرجى تقديم معلوماتك الشخصية الكاملة ومعلومات الجامعة حتى نتمكن من تقديم المساعدة
                    بشكل أفضل
                </p>
                <p> سيتواصل فريق خدمة العملاء لدينا بك لتأكيد التفاصيل وضمان توفير أفضل تجربة لك في خدمة نقل الطلاب</p>
            </div>
        </div>
        <div class="carpoolPageRight">
            <h2>صفحة الحجز</h2>

            <form method="POST" action="{{ route('carpool.storeAr') }}" class="carpoolForm">
                {{ csrf_field() }}

                @if(Session::has('success'))
                <div style="color:#DD001B;margin-bottom: 35px">
                    {{Session::get('success')}}
                </div>
                @endif

                <label for="name">الاسم الكامل</label>
                <input type="text" name="name" required>
                @if ($errors->has('name'))
                <span>{{ $errors->first('name') }}</span>
                @endif



                <label for="phone">رقم الهاتف</label>
                <input type="tel" name="phone" required>
                @if ($errors->has('phone'))
                <span>{{ $errors->first('phone') }}</span>
                @endif

                <label for="address">العنوان ( من اين ؟ )</label>
                <input type="text" name="address" required>
                @if ($errors->has('address'))
                <span>{{ $errors->first('address') }}</span>
                @endif

                <label for="university">الجامعة</label>
                <input type="text" name="university" required>
                @if ($errors->has('university'))
                <span>{{ $errors->first('university') }}</span>
                @endif


                <div class="tripContainer">
                    <a id="oneWayButton" class="oneWayButton">اتجاه واحد</a>
                    <a id="roundTripButton" class="roundTripButton">اتجاه ذهاب وإياب</a>
                </div>


                <label for="date">قم باختيار اليوم او الايام <img src="/icons/calendar.png" width="15px"></label>
                <input type="text" name="date" id="date" required readonly>
                @if ($errors->has('date'))
                <span>{{ $errors->first('date') }}</span>
                @endif

                <script>
                    $(document).ready(function () {
                        $('#date').multiDatesPicker({
                            minDate: 0,
                            onSelect: function(dateText, inst) {
                                // Get all selected dates and join them with a comma
                                var selectedDates = $(this).multiDatesPicker('getDates');
                                $(this).val(selectedDates.join(', '));
                            }
                        });
                    });
                </script>

                <div class="dateTimeContainer">
                    <div id="departureContainer">
                        <label for="departureTime">وقت الانطلاق</label>
                        <input type="time" name="departureTime" id="departureTime" required />
                        @if ($errors->has('departureTime'))
                        <span>{{ $errors->first('departureTime') }}</span>
                        @endif
                    </div>
                    <div id="comeBackContainer">
                        <label for="comeBackTime">وقت العودة</label>
                        <input type="time" name="comeBackTime" id="comeBackTime" />
                        @if ($errors->has('comeBackTime'))
                        <span>{{ $errors->first('comeBackTime') }}</span>
                        @endif
                    </div>
                </div>

                <button>قم بالحجز</button>

            </form>

        </div>
    </div>

    <script>
        $("#roundTripButton").click(function () {
            $("#comeBackContainer").css('display', 'block')
            $("#roundTripButton").css('background-color', '#272727')
            $("#roundTripButton").css('color', '#ffff')
            $("#oneWayButton").css('background-color', '#fff')
            $("#oneWayButton").css('color', 'black')
            $("#oneWayButton").css('border', '1px solid #272727')
});

$("#oneWayButton").click(function () {
        $("#comeBackContainer").css('display', 'none')
        $("#roundTripButton").css('background-color', '#ffff')
            $("#roundTripButton").css('color', 'black')
            $("#oneWayButton").css('background-color', '#272727')
            $("#oneWayButton").css('color', '#ffff')
    });

    </script>

    @include('layout.footerAr')

</body>

</html>