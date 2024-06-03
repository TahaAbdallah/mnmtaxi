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

</head>

<body>

    <!-- Add this script at the bottom of your HTML body -->
    <script>
        // Restore scroll position after page reloads
    window.onload = function() {
        restoreScrollPosition();
    };
    </script>

    {{-- NAVBAR --}}

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

    @include('layout.navbarAr')

    {{-- LANDING PAGE --}}
    <div class="landingPageContainer">
        <div class="landingPage">
            <h1>خدمات <span>تاكسي</span> موثوقة و عالية الجودة</h1>
            <h2>اختر خدمتنا التي يمكنك الاعتماد عليها اليوم</h2>
            <img src="/images/landingImage.png" alt="">
            <a href="https://wa.me/96176968224" target="_blank">احجز الآن</a>


        </div>
        <div class="landingPageHr">
            <hr>
        </div>
    </div>

    {{-- FARE CALCULATOR --}}

    @include('fareCalculatorAr')


    {{-- OUR SERVICES --}}

    <div class="ourServicesContainer" id="ourServices">
        <h3>خدماتنا</h3>
        <div class="ourServicesDataContainer">

            <div class="servicetest">
                <div class="ourServicesData">
                    <div class="ourServicesDataImgcontainer">
                        <img src="images/airport.jpg" alt="">
                    </div>
                    <div>
                        <p><span>التوصيل من المطار:</span> اشعر وكأنك في المنزل بمجرد خروجك من المطار من خلال خدمة النقل
                            الترحيبية السلسة التي نقدمها</p>
                    </div>
                </div>

                <div class="ourServicesData">
                    <div class="ourServicesDataImgcontainer">
                        <img src="images/corporate.jpg" alt="">
                    </div>
                    <div>
                        <p><span>حساب الشركات:</span> ركز على عملك بينما نعتني بحركة المرور والمواصلات من أجلك</p>

                    </div>
                </div>
            </div>

            <div class="servicetest">
                <div class="ourServicesData">
                    <div class="ourServicesDataImgcontainer">
                        <img src="images/fullday.jpg" alt="">
                    </div>
                    <div>
                        <p><span>جولات ليوم كامل:</span> اكتشف مناطق الجذب في الدولة في سيارة مصممة خصيصًا لاحتياجاتك ،و
                            الاستمتاع برحلة لا تُنسى وقابلة للتخصيص </p>
                    </div>
                </div>

                <div class="ourServicesData">
                    <div class="ourServicesDataImgcontainer">
                        <img src="images/delivery.jpg" alt="">
                    </div>
                    <div>
                        <p><span>خدمات توصيل البضائع:</span> ركز خلال عملك على السرعة والانجاز, و دعنا نهتم بتوصيل
                            بضائعك
                            الى العاملاء</p>
                    </div>
                </div>
            </div>

        </div>




        <h3 id="carpoolTitle">خدمة نقل طلاب الجامعات</h3>
        <div class="carpoolService">
            <div><img src="images/carpool.jpg"></div>
            <div>
                <p>استمتع بالراحة والتوفير مع خدمة <span class="carpoolingSpan1">مشاركة السيارات الموثوقة للطلاب.</span>
                    احصل على جداول زمنية مرنة و<span class="carpoolingSpan2">أسعار
                        تنافسية</span> ووسيلة مواصلات <span class="carpoolingSpan3">صديقة للبيئة</span>. انضم إلى مجتمع
                    الطلاب اليوم للرحلات الممتعة
                    والاقتصادية</p>
                <p id="carpoolGetInTouch">!تواصل معنا اليوم</p>
                <a href="/ar/university-carpooling"">!قم بحجز موعدك الآن</a>
            </div>
        </div>



        <form method=" post" action="{{ route('send.whatsappAr') }}" onsubmit="storeScrollPosition()">
                    @csrf

                    <h3 id=" goComeBackTitle">رحلة الذهاب والعودة</h3>


                    <div class="goComeBackImg">
                        <img src="images/gobackride.jpg" alt="">
                    </div>

                    <div class="goComeBackContainer">

                        <div class="goComeBackService">


                            <button type="submit" class="goComeBackBtn goComeBackBtnMob" target="_blank">
                                تأكيد
                            </button>

                            {{-- <a class="goComeBackBtn goComeBackBtnMob" href="https://wa.me/96176968224"
                                target="_blank">

                                تأكيد
                            </a> --}}

                            {{-- <script>
                                function test(e) {
                            var n= document.getElementById('date').value; console.log(n); 
                            e.preventDefault();
                                            }
                            </script> --}}


                        </div>

                        <div class="goComeBackText">

                            <div>
                                <p>استمتع بمرونة رحلات تاكسي آم آند آم للذهاب والعودة، مثالية لرحلات الذهاب والعودة
                                    براحة
                                    حيث يمكنك حجز واحد لإتمام الرحلتين. تمتع بجداول مرنة وأسعار تنافسية.
                                </p>
                            </div>

                            <div class="goBackSched">

                                <label for="location">موقعك</label>
                                <input type="text" name="location" id="location" required />
                                <label for="destination">وجهتك</label>
                                <input type="text" name="destination" id="destination" required />

                                <div class="dateCont">
                                    <label class="chooseDay" for="date">اختر اليوم</label>
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
                                            <label for="departureTime" class="timePicker">وقت الذهاب</label>
                                            <input type="time" name="departureTime" id="departureTime" required />
                                            @if ($errors->has('departureTime'))
                                            <span>{{ $errors->first('departureTime') }}</span>
                                            @endif
                                        </div>
                                        <div id="">
                                            <label for="comeBackTime" class="timePicker">وقت العودة</label>
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
                                تأكيد
                            </button>

                        </div>
                        </form>
                    </div>


                    <div class="whatsappSection whatsappSectionAr">
                        <h3 id="whatsappSectionTitleAr">المساعدة في الحجز على الواتس اب
                        </h3>
                        <div>
                            <p>هل تحتاج إلى مساعدة أو تفضل الحجز عبر الواتساب؟ نحن هنا للمساعدة!
                                <br>
                                <br>
                                انقر فوق الزر أدناه للتواصل معنا. فريقنا جاهز لمساعدتك في أي شيء
                                أسئلة
                                قد يكون لديك أو لمساعدتك في إكمال الحجز بسهولة.
                            </p>
                        </div>

                        <a class="whatsappSectionBtn" href="https://wa.me/96176968224" target="_blank">
                            whatsapp
                            {{-- <button id="subtest" onclick="test()" class="goComeBackBtn">CONFIRM</button> --}}
                        </a>

                    </div>

                    {{-- WHAT WE OFFER --}}

                    <div class=" whatWeOfferContainer">
                        <div class="whatWeOfferContent">
                            <h4>ماذا نقدّم</h4>
                            <p>خدمة سيارات أجرة موثوقة وعالية الجودة. تتوفر برامج التشغيل المرخصة لدينا في أي وقت وفي أي
                                مكان. نحن
                                تحديد الأولويات
                                رضاك وتقديم وصول في الوقت المناسب وطرق فعالة. بشكل مثير ، نحن نقدم أيضًا خدمة التوصيل
                                خدمة لراحتك. جرب دعم العملاء الاستثنائي والنقل السلس
                                تجربة معنا. اختر خدمة سيارات الأجرة التي يمكن الاعتماد عليها اليوم</p>
                        </div>
                    </div>


                    {{-- APPLICATION SECTION --}}

                    {{-- <div class="appContainer">

                        <div class="appContent">
                            <p class="appContentTitle">جرب خدمتنا الاستثنائية واحترافنا وموثوقيتنا لجميع احتياجات النقل
                                والتسليم
                                الخاصة
                                بك</p>

                            <div class="appContentApplication">
                                <div class="appContentApplicationLeft">
                                    <p>قم بتحميل تطبيقنا</p>
                                    <a href="https://play.google.com/store/apps/details?id=com.mnm.taxiClient"
                                        target="_blank">
                                        <img src="/icons/googlePlay.png" alt="">
                                    </a>
                                    <a href="https://apps.apple.com/us/app/m-and-m-taxi/id1633544867?l=ar"
                                        target="_blank">
                                        <img src="/icons/appStore.png" alt="">
                                    </a>
                                </div>
                                <div class="appContentApplicationRight">
                                    <img src="/images/phoneApp.png" alt="">
                                </div>
                            </div>
                        </div>

                    </div> --}}


                    {{-- MAIN FEATURES SECTION --}}

                    <div class="mainFeaturesContainer">
                        <div class="mainFeaturesContent">
                            <h4>الخصائص الرئيسية</h4>
                            <h3>فوائدنا</h3>
                            <div class="mainFeaturesBigContent">

                                <div class="mainFeaturesBigContentLeft">
                                    <img src="/images/ourBenefitsCar.png" alt="">
                                </div>

                                <div class="mainFeaturesBigContentRight">
                                    <div class="mainFeaturesBigContentRightContent">
                                        <img src="/icons/cleanCarIcon.png" alt="">
                                        <p class="mainFeaturesBigContentRightContentTitle">سيارات نظيفة</p>
                                    </div>
                                    <p class="mainFeaturesBigContentRightContentParag">تجربة فاخرة خالية من التدخين ،
                                        نظيفة ، و
                                        يارات بحالة جيدة. نحن نفخر بضمان
                                        بيئة نقية لراحتك ومتعتك أثناء رحلتك</p>

                                    <div class="mainFeaturesBigContentRightContent">
                                        <img src="/icons/timelyService.png" alt="">
                                        <p class="mainFeaturesBigContentRightContentTitle">خدمة بوقت دقيق</p>
                                    </div>
                                    <p class="mainFeaturesBigContentRightContentParag">نحن نتفهم أهمية الالتزام
                                        بالمواعيد. مع
                                        فريقنا المتفاني ، نضمن لك وصولك إلى وجهتك في الوقت المحدد ، في كل مرة.
                                        يمكنك الاعتماد علينا للحصول على نقل موثوق وفعال</p>

                                    <div class="mainFeaturesBigContentRightContent">
                                        <img src="/icons/pleasure.png" alt="">
                                        <p class="mainFeaturesBigContentRightContentTitle">M&M اللذة مع</p>
                                    </div>
                                    <p class="mainFeaturesBigContentRightContentParag">رضا العملاء هو على رأس أولوياتنا.
                                        مع وجود
                                        عدد
                                        كبير من العملاء المخلصين وتقييمات عالية ، نسعى جاهدين لتوفير تجربة ممتعة بنسبة
                                        100٪.
                                        اخترنا
                                        للحصول على خدمة استثنائية</p>

                                    <div class="mainFeaturesBigContentRightContent">
                                        <img src="/icons/nationWide.png" alt="">
                                        <p class="mainFeaturesBigContentRightContentTitle">خدماتنا على صعيد وطني</p>
                                    </div>
                                    <p class="mainFeaturesBigContentRightContentParag">لم يكن حجز سيارة أجرة أسهل من أي
                                        وقت مضى.
                                        تطبيقنا
                                        سهل الاستخدام متاح في جميع أنحاء البلاد ، مما يجعله مناسبًا لك لحجز سيارة أجرة
                                        ببضع
                                        خطوات بسيطة.
                                        استمتع بالنقل الخالي من المتاعب أينما ذهبت</p>
                                </div>

                            </div>
                        </div>
                    </div>


                    {{-- FINAL IMG --}}

                    <div class="finalImg">
                        <img src="/images/finalImg.png" alt="">
                    </div>

                    {{-- ASSISTANCE SECTION --}}

                    <div dir="rtl" class="assistanceSectionContainer">
                        <div class="assistanceSectionContent">
                            <img src="/icons/assistanceIcon.png" alt="">
                            <h3>لديك سؤال أو تحتاج إلى مساعدة ؟</h3>
                        </div>
                        <p>اتصل بنا للحصول على دعم سريع ومفيد. موظفونا المتخصصون موجودون هنا للرد على جميع استفساراتك
                            وتقديم مساعدة عالية الجودة. نحن نقدر ملاحظاتك ونلتزم بضمان رضاك.
                            الحصول على اتصال معنا اليوم!</p>

                        <hr>
                    </div>


                    {{-- FOOTER --}}

                    @include('layout.footerAr')
</body>

</html>