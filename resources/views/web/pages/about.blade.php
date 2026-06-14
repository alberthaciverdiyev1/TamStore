@extends('web.layout')

@section('content')

    <div class="page-container about-page-container">


        <!-- hero start -->
        <div class="page-hero about-hero">

            <img src="{{$banner? $banner->image : ''}}" alt="">

            <div class="hero-content">
                <span class="hero-title">@lang("About")</span>
                <span class="breadcrumb">@lang("Home") &nbsp; &nbsp;/ &nbsp; &nbsp; @lang("About")</span>
            </div>

            <div class="overlay"></div>

        </div>
        <!-- hero end -->

        <!-- our story start -->
        <div class="our-story-section">

            <div class="image-side">
                <img src="{{asset('web/images/story.png')}}" alt="">
            </div>

            <div class="text-side">

                <div class="centered-div">

                    <span class="title">@lang("Our Brand Story")</span>

                    <div class="red-line"></div>

                    <p class="text-content">
                        @php $lang = app()->getLocale() @endphp
                        {!! setting("about.$lang") !!}
                    </p>

                    <!-- <a href="" class="btn-more">
                        <span>Daha çox öyrən</span>
                        <img src="assets/icons/arrow-right-white.svg" alt="">
                    </a> -->

                </div>


            </div>

        </div>
        <!-- our story end -->

        <!-- our mission start -->
        <div class="our-mission-section">

            <div class="section-header">
                <span class="section-title">Dəyərlərimiz və Missiyamız</span>
                <div class="red-line"></div>
            </div>

            <div class="section-body">

                <div class="info-card grid-item">

                    <img src="{{asset('web/icons/static-card-icon.svg')}}" alt="">

                    <span class="card-title">Bizim Missiyamız</span>

                    <p class="card-description">
                        Hər bir azərbaycanlı ailəsinə ən təzə, ən keyfiyyətli və ekoloji
                        təmiz məhsulları çatdırmaq, rəqəmsal və fiziki alış-veriş
                        təcrübəsini mükəmməlləşdirməkdir.
                    </p>

                </div>

                <div class="info-card grid-item">

                    <img src="{{asset('web/icons/static-card-icon.svg')}}" alt="">

                    <span class="card-title">Ekoloji Məsuliyyət</span>

                    <p class="card-description">
                        Plastik istifadəsini minimuma endirərək,
                        davamlı gələcək üçün çalışırıq.
                    </p>

                </div>

                <div class="info-card grid-item">

                    <img src="{{asset('web/icons/static-card-icon.svg')}}" alt="">

                    <span class="card-title">Dürüstlük</span>

                    <p class="card-description">
                        Müştərilərimizlə olan
                        münasibətlərimizdə şəffaflıq və güvən
                        əsas prinsipimizdir.
                    </p>

                </div>

                <div class="info-card grid-item">

                    <img src="{{asset('web/icons/static-card-icon.svg')}}" alt="">

                    <span class="card-title">Bizim Missiyamız</span>

                    <p class="card-description">
                        Hər bir azərbaycanlı ailəsinə ən təzə, ən keyfiyyətli və ekoloji
                        təmiz məhsulları çatdırmaq, rəqəmsal və fiziki alış-veriş
                        təcrübəsini mükəmməlləşdirməkdir.
                    </p>

                </div>

                <div class="info-card grid-item">

                    <img src="{{asset('web/icons/static-card-icon.svg')}}" alt="">

                    <span class="card-title">Ekoloji Məsuliyyət</span>

                    <p class="card-description">
                        Plastik istifadəsini minimuma endirərək,
                        davamlı gələcək üçün çalışırıq.
                    </p>

                </div>

            </div>

        </div>
        <!-- our mission end -->

        <!-- counts start -->
        <div class="counts-section">

            <div class="count-box">
                <span class="count-value scramble-text">{{setting("statistic.branch")}}+</span>
                <span class="count-label">{{strtoupper(__("Branch"))}}</span>
            </div>

            <div class="count-box">
                <span class="count-value scramble-text">{{setting("statistic.employee")}}+</span>
                <span class="count-label">@lang("EMPLOYEE")</span>
            </div>

            <div class="count-box">
                <span class="count-value scramble-text">{{setting("statistic.customer")}}+</span>
                <span class="count-label">@lang("LOYAL CUSTOMER")</span>
            </div>

            <div class="count-box">
                <span class="count-value scramble-text">{{setting("statistic.product")}}+</span>
                <span class="count-label">@lang("MƏHSUL ÇEŞIDI")</span>
            </div>

        </div>
        <!-- counts end -->

        <!-- our team start -->
        <div class="our-team-section">

            <div class="section-header">
                <span class="section-title">@lang("Tamstore+ Team")</span>
                <div class="red-line"></div>
            </div>

            <div class="section-body bento-grid">

                <div class="bento-item item-large">
                    <img src="{{asset("storage/".setting('big_team_image'))}}" alt="">
                </div>

                <div class="bento-item item-top-right">
                    <img src="{{asset("storage/".setting('small_team_image'))}}" alt="">
                </div>

                <a href="{{route("home")}}" class="bento-item item-bottom-right">
                    <div class="text-content">
                        <span class="title">@lang("Step into the Future with Us")</span>
                        <p class="description">@lang("We are improving ourselves for the better every day.")</p>
                        <img src="{{asset('web/icons/arrow-right-white.svg')}}" alt="">
                    </div>
                </a>

            </div>
            <!-- our team end -->


        </div>

        <!-- gallery start -->
        <div class="gallery-card about-gallery">

            <div class="section-header">
                <span class="section-title">
                    @lang("Gallery")
                </span>
            </div>

            <div class="section-body">
                <swiper-container class="mySwiper" pagination="false" loop="true" effect="coverflow" grab-cursor="true"
                                  centered-slides="true" slides-per-view="auto" coverflow-effect-rotate="50"
                                  coverflow-effect-stretch="0" coverflow-effect-depth="100"
                                  coverflow-effect-modifier="1"
                                  coverflow-effect-slide-shadows="true">
                    @foreach($galleries as $gallery)
                        <swiper-slide>
                            <img src="{{$gallery->image}}"/>
                        </swiper-slide>
                    @endforeach


                </swiper-container>
            </div>

        </div>
        <!-- gallery end -->

        <!-- promo start -->
        @include("web.components.qr")

        <!-- promo end -->

        <!-- partners start -->
        <div class="partners-section">

            <div id="logoStrip" class="splide logo-strip">
                <div class="splide__track">
                    <ul class="splide__list">

                        @foreach($partners as $partner)
                            <li class="splide__slide">
                                <div class="logo-div"><img src="{{asset($partner->image)}}" alt=""></div>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>

        </div>
        <!-- partners end -->

    </div>

@endsection
