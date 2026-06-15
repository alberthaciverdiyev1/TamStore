@extends('web.layout')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
          integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <div class="page-container product-details-container">

        <!-- bradcrumb start -->
        <div class="custom-breadcrumb">
            <span class="breadcrumb">@lang("Home") &nbsp; &nbsp;/ &nbsp; &nbsp; {{$product->name}}</span>
        </div>
        <!-- bradcrumb end -->

        <!-- product details start -->
        <div class="product-details">

            <!-- fotorama start -->
            <div class="fotorama-container">

                <!-- fotorama -->
                <div class="fotorama-wrapper">

                    <div class="fotorama position-relative">

                        <div class="stage position-relative">

                            <div class="swiper fotoramaSwiper" id="mainSwiper">
                                <div class="swiper-wrapper">

                                    @foreach($product->images as $image)
                                        <div class="swiper-slide">
                                            <img src="{{$image}}" alt="">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>

                            <button class="fullscreen-open" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <img src="{{asset('web/icons/fotorama-open.svg')}}" alt="">
                            </button>

                            <div class="pagination">
                                <div></div>
                            </div>

                        </div>

                        <div class="thumbs-container" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <div class="swiper mainThumbsSwiper">

                                <div class="swiper-wrapper thumbs">

                                    @foreach($product->images as $image)

                                        <div class="swiper-slide">
                                            <div class="thumbs-img active">
                                                <img src="{{$image}}" alt="">
                                            </div>
                                        </div>
                                    @endforeach


                                    <div class="overlay position-absolute">+12 @lang("image")</div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- fotorama modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen">
                        <div class="modal-content">

                            <div class="fotorama">

                                <div class="stage">

                                    <div class="swiper fotoramaSwiper" id="modalSwiper">
                                        <div class="swiper-wrapper">
                                            @foreach($product->images as $image)

                                                <div class="swiper-slide">
                                                    <img src="{{$image}}" alt="">
                                                </div>

                                            @endforeach

                                        </div>
                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                    </div>

                                </div>

                                <div class="thumbs">
                                    <div class="swiper thumbSwiper">
                                        <div class="swiper-wrapper">

                                            @foreach($product->images as $image)

                                                <div class="swiper-slide">
                                                    <img src="{{$image}}" alt="">
                                                </div>

                                            @endforeach

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <button class="fullscreen-close" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <img src="{{asset('web/icons/fotorama-close.svg')}}" alt="">
                            </button>

                        </div>
                    </div>
                </div>

            </div>
            <!-- fotorama end -->

            <div class="product-infos">
                <span class="product-title">
                    {{$product->name}}
                </span>

                <div class="product-info-card">

                    <p class="product-description">
                        {{$product->short_description}}

                    </p>

                    <div class="product-features">

                        @foreach($product->tags as $tag)
                            @if(is_array($tag) && !empty($tag[app()->getLocale()]))
                                <div class="product-feature">

                                    @if(!empty($tag['icon']))
                                        @php
                                            $rawIcon = $tag['icon'];
                                            $iconClass = str_starts_with($rawIcon, 'fas-')
                                                ? 'fa-solid fa-' . substr($rawIcon, 4)
                                                : $rawIcon;
                                        @endphp
                                        <i class="{{ $iconClass }}"></i>
                                    @endif

                                    <span>{{ $tag[app()->getLocale()] }}</span>

                                </div>
                            @endif
                        @endforeach


                    </div>


                </div>

                <div class="technical-specifications">

                    <span class="title">@lang("Technical indicators")</span>

                    @foreach($product->filters as $filter)
                        <div class="tecnical-info-box">
                            <span class="label">{{$filter->name}}</span>
                            <div>
                                @foreach($filter->options as $option)
                                    <span class="value">{{$option->name}}</span>
                                @endforeach
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>

        </div>

        <div class="detailed-description-container">
            <div class="detailed-description-box">

                <span class="title">@lang("Product details")</span>

                    {!! $product->description !!}

            </div>
        </div>

        <!-- product details end -->

        <!-- featured products start -->
        <div class="featured-products">

            <div class="section-header">

                <div class="section-header-left">

                    <span class="section-title">@lang("What we have chosen for you")</span>

                    <div class="red-line"></div>

                    <p class="section-description">
                        @lang("Recommended")
                    </p>

                </div>

                <div class="section-header-right">

                    <div class="section-header-right-actions">
                        <div class="swipe-buttons">
                            <button class="swipe-button p-btn-prew" type="button">
                                <img src="{{asset('web/icons/swiper-button-left.svg')}}" alt="">
                            </button>

                            <button class="swipe-button p-btn-next" type="button">
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

                <div class="swiper productsSwiper">

                    <div class="swiper-wrapper">

                        @foreach($similar as $product)
                            <div class="swiper-slide">
                                <a href="{{route('product.details',$product->slug)}}" class="product-card">

                                    <div class="product-image">
                                        <img src="{{$product->image}}" alt="">
                                    </div>

                                    <div class="product-infos">
                                        <span class="product-title">{{$product->category_name}}</span>
                                        <p class="product-description">{{$product->name}}</p>
                                    </div>

                                    {{--                                <div class="badget">--}}
                                    {{--                                    <span>HƏFTƏNIN SEÇIMI</span>--}}
                                    {{--                                </div>--}}

                                </a>
                            </div>

                        @endforeach


                    </div>

                </div>

            </div>

        </div>
        <!-- featured blogs end -->

    </div>
@endsection
@push('scripts')
    <script src="{{asset('web/js/fotorama.js')}}"></script>

@endpush
