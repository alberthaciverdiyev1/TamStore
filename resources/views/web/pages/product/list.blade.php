@extends('web.layout')

@section('content')

    <div class="page-container products-container">

        <div class="page-hero products-hero">

            <img src="{{$banner? $banner->image : ''}}" alt="">

            <div class="hero-content">
                <span class="hero-title">@lang("Products")</span>
                <span class="breadcrumb">@lang("Home") &nbsp; &nbsp;/ &nbsp; &nbsp; @lang("Products")</span>
            </div>

            <div class="overlay"></div>

        </div>

        <!-- product list start -->
        <div class="product-list">

            <div class="product-filters">

                {{--                <div class="accordion-filters">--}}

                {{--                    <span class="filter-title">Məhsul kataloqu</span>--}}

                {{--                    <div class="accordion" id="accordionExample">--}}

                {{--                        @foreach($filters as $filter)--}}
                {{--                        <div class="accordion-item">--}}
                {{--                            <button class="accordion-button" type="button" data-bs-toggle="collapse"--}}
                {{--                                    data-bs-target="#{{$filter->id}}" aria-expanded="true" aria-controls="{{$filter->id}}">--}}
                {{--                                <span>{{$filter->name}}</span>--}}
                {{--                                <img class="arrow-white" src="{{asset('web/icons/accordion-arrow.svg')}}" alt="">--}}
                {{--                                <img class="arrow-red" src="{{asset('web/icons/accordion-arrow-red.svg')}}" alt="">--}}
                {{--                            </button>--}}

                {{--                            <div id="{{$filter->id}}" class="accordion-collapse collapse show"--}}
                {{--                                 data-bs-parent="#accordionExample">--}}
                {{--                                <div class="accordion-body">--}}
                {{--                                    @foreach($filter->options as $option)--}}
                {{--                                    <span class="filter-item">{{$option->value}}</span>--}}
                {{--                                    @endforeach--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        @endforeach--}}

                {{--                    </div>--}}

                {{--                </div>--}}

                {{--                <div class="range-input-container">--}}

                {{--                    <span class="filter-title">QİYMƏT ARALIĞI</span>--}}

                {{--                    <!-- Slayderin özü -->--}}
                {{--                    <div class="slider-container">--}}
                {{--                        <div class="slider-track" id="slider-track"></div>--}}

                {{--                        <input type="range" min="0" max="1000" value="20" id="slider-min">--}}
                {{--                        <input type="range" min="0" max="1000" value="450" id="slider-max">--}}
                {{--                    </div>--}}

                {{--                    <div class="price-values">--}}
                {{--                        <span id="display-min">20 ₼</span>--}}
                {{--                        <span id="display-max">450 ₼</span>--}}
                {{--                    </div>--}}

                {{--                    <!-- for backend -->--}}
                {{--                    <input type="hidden" name="min_price" id="input-min-price" value="20">--}}
                {{--                    <input type="hidden" name="max_price" id="input-max-price" value="450">--}}
                {{--                </div>--}}

                {{--                <div class="brand-filter-wrapper">--}}
                {{--                    <span class="filter-title">BREND SEÇİMİ</span>--}}

                {{--                    <div class="checkbox-list">--}}


                {{--                        @foreach($brands as $brand)--}}
                {{--                            <label class="custom-checkbox">--}}
                {{--                                <input type="checkbox" name="brands[]" value="{{$brand->id}}">--}}
                {{--                                <span class="checkmark"></span>--}}
                {{--                                <span class="label-text">{{$brand->name}}</span>--}}
                {{--                            </label>--}}

                {{--                        @endforeach--}}
                {{--                    </div>--}}
                {{--                </div>--}}

                <form action="{{ url()->current() }}" method="GET" id="filter-form">
                    {{-- URL'deki arama (search) kelimesi gibi diğer parametreler kaybolmasın diye koruyoruz --}}
                    @foreach(request()->except(['filter_options', 'min_price', 'max_price', 'brands', 'page']) as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach

                    <div class="accordion-filters">

                        <span class="filter-title">@lang("Product catalog")</span>

                        <div class="accordion" id="accordionExample">

                            @foreach($filters as $filter)
                                <div class="accordion-item">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{$filter->id}}" aria-expanded="true"
                                            aria-controls="collapse-{{$filter->id}}">
                                        <span>{{$filter->name}}</span>
                                        <img class="arrow-white" src="{{asset('web/icons/accordion-arrow.svg')}}"
                                             alt="">
                                        <img class="arrow-red" src="{{asset('web/icons/accordion-arrow-red.svg')}}"
                                             alt="">
                                    </button>

                                    <div id="collapse-{{$filter->id}}" class="accordion-collapse collapse show"
                                         data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            @foreach($filter->options as $option)
                                                @php
                                                    $isFilterChecked = is_array(request()->input('filter_options')) && in_array($option->id, request()->input('filter_options'));
                                                @endphp
                                                <span class="filter-item {{ $isFilterChecked ? 'active' : '' }}"
                                                      style="cursor: pointer; display: block;"
                                                      onclick="this.querySelector('input').click();">
                                            <input type="checkbox" name="filter_options[]" value="{{$option->id}}"
                                                   {{ $isFilterChecked ? 'checked' : '' }}
                                                   style="display: none;"
                                                   onclick="event.stopPropagation(); this.form.submit();">
                                            {{$option->value}}
                        </span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>

{{--                    <div class="range-input-container">--}}

{{--                        <span class="filter-title">{{strtoupper(__("Price Range"))}}</span>--}}

{{--                        @php--}}
{{--                            $minPrice = request()->input('min_price', 20);--}}
{{--                            $maxPrice = request()->input('max_price', 450);--}}
{{--                        @endphp--}}

{{--                        <div class="slider-container">--}}
{{--                            <div class="slider-track" id="slider-track"></div>--}}

{{--                            <input type="range" min="0" max="1000" value="{{ $minPrice }}" id="slider-min"--}}
{{--                                   onchange="this.form.submit()">--}}
{{--                            <input type="range" min="0" max="1000" value="{{ $maxPrice }}" id="slider-max"--}}
{{--                                   onchange="this.form.submit()">--}}
{{--                        </div>--}}

{{--                        <div class="price-values">--}}
{{--                            <span id="display-min">{{ $minPrice }} ₼</span>--}}
{{--                            <span id="display-max">{{ $maxPrice }} ₼</span>--}}
{{--                        </div>--}}

{{--                        <input type="hidden" name="min_price" id="input-min-price" value="{{ $minPrice }}">--}}
{{--                        <input type="hidden" name="max_price" id="input-max-price" value="{{ $maxPrice }}">--}}
{{--                    </div>--}}

                    <div class="brand-filter-wrapper">
                        <span class="filter-title">{{strtoupper(__("Brand Choice"))}}</span>

                        <div class="checkbox-list">

                            @foreach($brands as $brand)
                                @php
                                    $isBrandChecked = is_array(request()->input('brands')) && in_array($brand->id, request()->input('brands'));
                                @endphp
                                <label class="custom-checkbox">
                                    <input type="checkbox" name="brands[]" value="{{$brand->id}}"
                                           {{ $isBrandChecked ? 'checked' : '' }}
                                           onchange="this.form.submit()">
                                    <span class="checkmark"></span>
                                    <span class="label-text">{{$brand->name}}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </form>


            </div>

            <div class="products">

                <div class="products-header">

                    <span class="header-title">@lang("Products")</span>

{{--                    <div class="custom-sort-wrapper">--}}
{{--                        <span class="sort-label">Sırala:</span>--}}

{{--                        <div class="sort-container" id="customSort">--}}
{{--                            <div class="sort-trigger" id="sortTrigger">--}}
{{--                                <span id="sortSelectedText">Yenilər</span>--}}
{{--                                <img src="{{asset('web/icons/accordion-arrow.svg')}}" alt="v" class="arrow-icon">--}}
{{--                            </div>--}}

{{--                            <div class="sort-options" id="sortOptions">--}}
{{--                                <div class="sort-option hidden-option" data-value="newest">Yenilər</div>--}}

{{--                                <div class="sort-option" data-value="price_asc">Ucuzdan bahaya</div>--}}
{{--                                <div class="sort-option" data-value="price_desc">Bahadan ucuza</div>--}}
{{--                                <div class="sort-option" data-value="popular">Populyar</div>--}}
{{--                            </div>--}}

{{--                            <input type="hidden" name="sort_by" id="sortHiddenInput" value="newest">--}}
{{--                        </div>--}}
{{--                    </div>--}}

                </div>

                <div class="products-body">

                    <div class="product-cards">
                        @foreach($products as $product)

                            <a href="{{route('product.details',$product->slug ?? $product->id)}}" class="product-card">

                                <div class="product-image">
                                    <img src="{{$product->image}}" alt="">
                                </div>

                                <div class="product-infos">
                                    <span class="product-title">{{$product->category_name}}</span>
                                    <p class="product-description">{{$product->name}}</p>
                                </div>

                                {{--                            <div class="badget">--}}
                                {{--                                <span>HƏFTƏNIN SEÇIMI</span>--}}
                                {{--                            </div>--}}

                            </a>

                        @endforeach

                    </div>


                    <div class="pagination-wrapper">
                        {{ $products->links('web.partials.custom-pagination') }}
                    </div>

                    {{--                    <nav aria-label="Səhifələmə" class="custom-pagination">--}}
                    {{--                        <ul class="pagination-list">--}}

                    {{--                            <li class="page-item disabled">--}}
                    {{--                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">--}}
                    {{--                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"--}}
                    {{--                                         stroke-linecap="round" stroke-linejoin="round">--}}
                    {{--                                        <polyline points="15 18 9 12 15 6"></polyline>--}}
                    {{--                                    </svg>--}}
                    {{--                                </a>--}}
                    {{--                            </li>--}}

                    {{--                            <!-- Aktiv Səhifə -->--}}
                    {{--                            <li class="page-item active">--}}
                    {{--                                <a class="page-link" href="#">1</a>--}}
                    {{--                            </li>--}}

                    {{--                            <!-- Digər Səhifələr -->--}}
                    {{--                            <li class="page-item">--}}
                    {{--                                <a class="page-link" href="#">2</a>--}}
                    {{--                            </li>--}}

                    {{--                            <li class="page-item">--}}
                    {{--                                <a class="page-link" href="#">3</a>--}}
                    {{--                            </li>--}}

                    {{--                            <!-- Üç nöqtə (Aradakı səhifələri qısaltmaq üçün) -->--}}
                    {{--                            <li class="page-item dots">--}}
                    {{--                                <span class="page-link">...</span>--}}
                    {{--                            </li>--}}

                    {{--                            <!-- Sonuncu Səhifə -->--}}
                    {{--                            <li class="page-item">--}}
                    {{--                                <a class="page-link" href="#">12</a>--}}
                    {{--                            </li>--}}

                    {{--                            <!-- Sağ Ox (İrəli) -->--}}
                    {{--                            <li class="page-item">--}}
                    {{--                                <a class="page-link" href="#">--}}
                    {{--                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"--}}
                    {{--                                         stroke-linecap="round" stroke-linejoin="round">--}}
                    {{--                                        <polyline points="9 18 15 12 9 6"></polyline>--}}
                    {{--                                    </svg>--}}
                    {{--                                </a>--}}
                    {{--                            </li>--}}

                    {{--                        </ul>--}}
                    {{--                    </nav>--}}

                </div>

            </div>

        </div>
        <!-- product list end -->

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

        <!-- promo start -->

        @include('web.components.qr')


        <!-- promo end -->

    </div>

@endsection
@push('scripts')

    <script>
        document.getElementById('slider-min').addEventListener('input', function () {
            document.getElementById('input-min-price').value = this.value;
            document.getElementById('display-min').innerText = this.value + " ₼";
        });
        document.getElementById('slider-max').addEventListener('input', function () {
            document.getElementById('input-max-price').value = this.value;
            document.getElementById('display-max').innerText = this.value + " ₼";
        });
    </script>

    <script src="{{asset('web/js/splide.js')}}"></script>
    <script src="{{asset('web/js/rangeInput.js')}}"></script>
    <script src="{{asset('web/js/sortSelect.js')}}"></script>
@endpush
