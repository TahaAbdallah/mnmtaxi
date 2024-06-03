<footer>
    <div class="footerLeft">
        <a href="">
            <img src="/images/MAndMLogo.png" alt="">
        </a>
        <p>خدمات تاكسي موثوقة وعالية الجودة</p>
        <div class="footerLeftContent">
            <img src="/icons/emailIcon.png" alt="">
            <a href="mailto: info@mnmtaxilb.com">info@mnmtaxilb.com</a>
        </div>
        <div class="footerLeftContent">
            <div>
                <img src="/icons/telephoneIcon.png" alt="">
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
            <img src="/icons/locationIcon.png" alt="">
            <a>لبنان, خلده عرمون</a>
        </div>
    </div>
    <div class="footerRight">
        <a href="{{ route('welcomeAr') }}" id="{{ request()->routeIs('welcomeAr') ? 'active' : '' }}">الرئيسية</a>
        <a href="/ar/#ourServices" id="">خدماتنا</a>

        <a href="{{ route('carpoolAr') }}" id="{{ request()->routeIs('carpoolAr') ? 'active' : '' }}">
            نقل
            طلاب الجامعات</a>

        <a href="{{ route('aboutAr') }}" id="{{ request()->routeIs('aboutAr') ? 'active' : '' }}">معلومات
            عنا</a>
        <a href="{{ route('contactAr') }}" id="{{ request()->routeIs('contactAr') ? 'active' : '' }}">تواصل
            معنا</a>
    </div>
</footer>

<div class="footerHrContainer">
    <hr class="footerHr">
</div>

<div dir="rtl" class="finalFooter">
    <a>M&M Taxi © 2023. جميع الحقوق محفوظة. طوّر من قبل Sun Design Agency.</a>
    <div class="finalFooterIcons">
        <a href="https://instagram.com/mandmtaxis?igshid=MzRlODBiNWFlZA==" target="_blank">
            <img src="/icons/instagramIcon.png" alt="">
        </a>
        <a href="https://wa.me/96176968224" target="_blank">
            <img src="/icons/whatsappIcon.png" alt="">
        </a>
    </div>
</div>