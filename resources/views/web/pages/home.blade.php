@extends('web.layout')

@section('content')
    <div class="page-container homepage-container">

        <a href="" class="popup-container">

        <img src="https://cdn.pixabay.com/photo/2015/04/19/08/32/flower-729510_1280.jpg" alt="">

        <div class="popup-button">Ətraflı bax</div>

        <div class="close-popup">
            <img src="{{ asset('web/icons/close.svg') }}" alt="">
        </div>

    </a>

        <!-- hero start -->
        @if($banners->isNotEmpty())
            <div class="swiper heroSwiper">
                <div class="swiper-wrapper">

                    @foreach($banners as $banner)
                        <div class="swiper-slide">
                            <div class="homepage-hero">

                                <img src="{{$banner->image}}" alt="">

                                <div class="hero-content">

                                    <span class="first-slogan" data-splitting>{{$banner->first_title}}</span>

                                    <p class="second-slogan" data-splitting>
                                        {{$banner->second_title}}
                                    </p>

                                    <p class="hero-content-description" data-splitting>{{$banner->third_title}}
                                    </p>

                                    <div class="hero-content-actions">

                                        <a href="{{route('products')}}" class="btn-red">
                                            <span>@lang("Discover")</span>
                                        </a>

                                        <a href="{{route('branch')}}" class="btn-white-bordered">
                                            <span>@lang("Branches")</span>
                                        </a>

                                    </div>

                                </div>

                                <div class="overlay"></div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        @endif
        <!-- hero-end -->

        <!-- partners start -->
        <div class="partners-section">

            <div id="logoStrip" class="splide logo-strip">
                <div class="splide__track">
                    <ul class="splide__list">

                        @foreach($partners as $partner)
                            <li class="splide__slide">
                                <div class="logo-div"><img src="{{$partner->image}}" alt=""></div>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>

        </div>
        <!-- partners end -->

        <!-- static cards start -->
        <div class="static-cards">

            @foreach($homeCards as $card)
                <div class="static-card {{$card->image ? '' :'no-image'}}">

                    @if($card->image)
                        <img class="background-image" src="{{$card->image}}" alt="">
                    @endif

                    <div class="text-content">
                        {{--                        <img src="{{$card->icon}}" alt="" class="card-icon">--}}
                        <i class="{{$card->icon}}"></i>

                        <span class="card-title">{{$card->title}}</span>

                        <p class="card-description">
                            {{$card->subtitle}}
                        </p>
                    </div>

                    <svg class="background-svg" xmlns="http://www.w3.org/2000/svg" width="275" height="298"
                         viewBox="0 0 275 298" fill="none">
                        <path
                            d="M191.513 191.544C177.71 205.347 166.259 221.209 157.5 238.354C148.757 221.178 137.306 205.347 123.487 191.544C109.684 177.741 93.8223 166.29 76.6765 157.531C93.8532 148.788 109.684 137.337 123.487 123.518C137.29 109.715 148.741 93.8531 157.5 76.7073C166.243 93.8841 177.694 109.715 191.513 123.518C205.316 137.321 221.178 148.772 238.324 157.531C221.147 166.274 205.316 177.725 191.513 191.544ZM309.383 151.403C231.685 144.997 170.004 83.315 163.597 5.61726C163.288 1.85695 160.394 0 157.5 0C154.606 0 151.697 1.87242 151.403 5.61726C144.997 83.315 83.315 144.997 5.61726 151.403C-1.87242 152.022 -1.87242 162.993 5.61726 163.612C83.315 170.019 144.997 231.7 151.403 309.398C151.713 313.158 154.606 315.015 157.5 315.015C160.394 315.015 163.303 313.143 163.597 309.398C170.004 231.7 231.685 170.019 309.383 163.612C316.872 162.993 316.872 152.022 309.383 151.403Z"
                            fill="white" fill-opacity="0.04"/>
                    </svg>

                    <div class="overlay"></div>

                </div>

            @endforeach

        </div>
        <!-- static cards end -->

        <!-- categories start -->
        <div class="categories-section">

            <div class="section-header">
                <div class="section-header-left">
                    <span class="section-title">@lang("Categories")</span>
                    <div class="red-line"></div>
                    <p class="section-description">
                        @lang("Each of our products is specially selected for you.")
                    </p>
                </div>

                <div class="section-header-right">
                    <div class="section-header-right-actions">
                        <div class="swipe-buttons">
                            <button class="swipe-button c-btn-prew" type="button">
                                <img src="{{asset('web/icons/swiper-button-left.svg')}}" alt="">
                            </button>

                            <button class="swipe-button c-btn-next" type="button">
                                <img src="{{asset('web/icons/swiper-button-right.svg')}}" alt="">
                            </button>
                        </div>

                        <a href="{{route('products')}}" class="btn-more">
                            <span>@lang("See all")</span>
                            <img src="{{asset('web/icons/arrow-right-red.svg')}}" alt="">
                        </a>
                    </div>
                </div>
            </div>

            <div class="section-body">

                <div class="swiper categoriesSwiper">

                    <div class="swiper-wrapper">

                        @foreach($categories as $category)
                            <div class="swiper-slide">
                                <a href="{{ route('products', ['category_id' => $category->id]) }}" class="product-card">
                                    <div class="product-image">
                                        <img src="{{$category->image}}" alt="">
                                    </div>

                                    <div class="product-infos">
                                        <span class="product-title">{{$category->name}}</span>
                                        <p class="product-description">{{$category->info}}</p>
                                    </div>

                                </a>
                            </div>
                        @endforeach
                    </div>

                </div>

            </div>

        </div>
        <!-- categories end -->

        <!-- featured blogs start -->
        <div class="featured-blogs">

            <div class="section-header">

                <div class="section-header-left">

                    <span class="section-title">@lang("Blogs")</span>

                    <div class="red-line"></div>

                    <p class="section-description">
                        @lang("Featured blogs")
                    </p>

                </div>

                <div class="section-header-right">

                    <div class="section-header-right-actions">
                        <div class="swipe-buttons">
                            <button class="swipe-button b-btn-prew" type="button">
                                <img src="{{asset('web/icons/swiper-button-left.svg')}}" alt="">
                            </button>

                            <button class="swipe-button b-btn-next" type="button">
                                <img src="{{asset('web/icons/swiper-button-right.svg')}}" alt="">
                            </button>
                        </div>

                        <a href="{{route('blog.list')}}" class="btn-more">
                            <span>@lang("See all")</span>
                            <img src="{{asset('web/icons/arrow-right-red.svg')}}" alt="">
                        </a>
                    </div>


                </div>

            </div>

            <div class="section-body">

                <div class="swiper blogsSwiper">

                    <div class="swiper-wrapper">

                        @foreach($blogs as $blog)

                            <div class="swiper-slide">
                                <a href="{{route('blog.details',$blog->id)}}" class="blog-card">

                                    <div class="blog-image">
                                        <img src="{{$blog->image}}" alt="">
                                        @if($blog->category)
                                            <div class="blog-category">
                                                <span>{{$blog->category->name}}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="blog-infos">

                                        <div class="blog-meta">
                                            <span class="blog-date">{{$blog->date}}</span>
                                            <div class="dot"></div>
                                            <span>{{$blog->reading_time}}</span>
                                        </div>

                                        <span class="blog-title">
                                       {{$blog->title}}
                                    </span>

                                        <p class="blog-description">
                                            {!! $blog->description !!}
                                        </p>

                                        <button class="read-more">
                                            <span>@lang("Read")</span>
                                            <img src="{{asset('web/icons/arrow-right-red.svg')}}" alt="">
                                        </button>

                                    </div>

                                </a>
                            </div>
                        @endforeach

                    </div>

                </div>

            </div>

        </div>
        <!-- featured blogs end -->

        <!-- gallery start -->
        <div class="gallery-card homepage-gallery">

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

    </div>
@endsection
