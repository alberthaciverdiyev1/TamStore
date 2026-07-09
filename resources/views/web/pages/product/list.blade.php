@extends('web.layout')

@section('content')
    <div class="page-container products-container">

        <div class="page-hero products-hero">

            <img src="{{ $banner ? $banner->image : '' }}" alt="">

            <div class="hero-content">
                <span class="hero-title">@lang('Products')</span>
                <span class="breadcrumb">@lang('Home') &nbsp; &nbsp;/ &nbsp; &nbsp; @lang('Products')</span>
            </div>

            <div class="overlay"></div>

        </div>

        <!-- product list start -->
        <div class="product-list">

            <div class="product-filters">

                <form action="{{ url()->current() }}" method="GET" id="filter-form">
                    @foreach (request()->except(['categories', 'filters', 'filter_options', 'min_price', 'max_price', 'brands', 'page']) as $key => $value)
                        @if(is_array($value))
                            @foreach($value as $subValue)
                                <input type="hidden" name="{{ $key }}[]" value="{{ $subValue }}">
                            @endforeach
                        @else
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endif
                    @endforeach

                    <div class="accordion-filters">

                        <span class="filter-title">@lang('Product catalog')</span>

                        {{-- yeni akordion start --}}
                        <div class="accordion" id="filterAccordionExample">
                            @foreach($categories as $category)
                                <div class="accordion-item">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-cat-{{$category->id}}" aria-expanded="true">

                                        <label class="custom-checkbox" onclick="event.stopPropagation();">
                                            <input type="checkbox" name="categories[]" value="{{$category->id}}"
                                                   onchange="this.form.submit()" {{ in_array($category->id, (array)request('categories')) ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                            <span class="label-text">{{$category->name}}</span>
                                        </label>
                                    </button>

                                    <div id="collapse-cat-{{$category->id}}" class="accordion-collapse collapse show"
                                         data-bs-parent="#filterAccordionExample">
                                        <div class="accordion-body">
                                            <div class="accordion" id="sub-accordion-{{$category->id}}">

                                                @foreach($category->filters as $filter)
                                                    <div class="accordion-item">
                                                        <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapse-filter-{{$filter->id}}"
                                                                aria-expanded="false">

                                                            <label class="custom-checkbox"
                                                                   onclick="event.stopPropagation();">
                                                                <input type="checkbox" name="filters[]"
                                                                       value="{{$filter->id}}"
                                                                       onchange="var opts=this.closest('.accordion-item').querySelectorAll('input[name=\'filter_options[]\']');if(this.checked){opts.forEach(function(e){e.checked=true})}else{opts.forEach(function(e){e.checked=false})}this.form.submit()" {{ in_array($filter->id, (array)request('filters')) ? 'checked' : '' }}>
                                                                <span class="checkmark"></span>
                                                                <span class="label-text">{{$filter->name}}</span>
                                                            </label>
                                                        </button>

                                                        <div id="collapse-filter-{{$filter->id}}"
                                                             class="accordion-collapse collapse"
                                                             data-bs-parent="#sub-accordion-{{$category->id}}">
                                                            <div class="accordion-body">
                                                                @foreach($filter->options as $option)
                                                                    <span class="filter-item">
                                                <label class="custom-checkbox">
                                                    <input type="checkbox" name="filter_options[]"
                                                           value="{{$option->id}}"
                                                           onchange="this.form.submit()" {{ in_array($option->id, (array)request('filter_options')) ? 'checked' : '' }}>
                                                    <span class="checkmark"></span>
                                                    <span class="label-text">{{$option->value}}</span>
                                                </label>
                                            </span>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{-- yeni akordion end --}}

                    </div>


                    <div class="brand-filter-wrapper">
                        <span class="filter-title">{{ strtoupper(__('Brand Choice')) }}</span>

                        <div class="checkbox-list">

                            @foreach ($brands as $brand)
                                @php
                                    $isBrandChecked =
                                        is_array(request()->input('brands')) &&
                                        in_array($brand->id, request()->input('brands'));
                                @endphp
                                <label class="custom-checkbox">
                                    <input type="checkbox" name="brands[]" value="{{ $brand->id }}"
                                           {{ $isBrandChecked ? 'checked' : '' }} onchange="this.form.submit()">
                                    <span class="checkmark"></span>
                                    <span class="label-text">{{ $brand->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </form>


            </div>

            <div class="products">

                <div class="products-header">

                    <span class="header-title">@lang('Products')</span>

                    {{--                    <div class="custom-sort-wrapper"> --}}
                    {{--                        <span class="sort-label">Sırala:</span> --}}

                    {{--                        <div class="sort-container" id="customSort"> --}}
                    {{--                            <div class="sort-trigger" id="sortTrigger"> --}}
                    {{--                                <span id="sortSelectedText">Yenilər</span> --}}
                    {{--                                <img src="{{asset('web/icons/accordion-arrow.svg')}}" alt="v" class="arrow-icon"> --}}
                    {{--                            </div> --}}

                    {{--                            <div class="sort-options" id="sortOptions"> --}}
                    {{--                                <div class="sort-option hidden-option" data-value="newest">Yenilər</div> --}}

                    {{--                                <div class="sort-option" data-value="price_asc">Ucuzdan bahaya</div> --}}
                    {{--                                <div class="sort-option" data-value="price_desc">Bahadan ucuza</div> --}}
                    {{--                                <div class="sort-option" data-value="popular">Populyar</div> --}}
                    {{--                            </div> --}}

                    {{--                            <input type="hidden" name="sort_by" id="sortHiddenInput" value="newest"> --}}
                    {{--                        </div> --}}
                    {{--                    </div> --}}

                </div>

                <div class="products-body">

                    <div class="product-cards">
                        @foreach ($products as $product)
                            <a href="{{ route('product.details', $product->slug ?? $product->id) }}"
                               class="product-card">

                                <div class="product-image">
                                    <img src="{{ $product->image }}" alt="">
                                </div>

                                <div class="product-infos">
                                    <span class="product-title">{{ $product->category_name }}</span>
                                    <p class="product-description">{{ $product->name }}</p>
                                </div>

                            </a>
                        @endforeach

                    </div>

                    <div class="pagination-wrapper">
                        {{ $products->links('web.partials.custom-pagination') }}
                    </div>

                    {{--                    <nav aria-label="Səhifələmə" class="custom-pagination"> --}}
                    {{--                        <ul class="pagination-list"> --}}

                    {{--                            <li class="page-item disabled"> --}}
                    {{--                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true"> --}}
                    {{--                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" --}}
                    {{--                                         stroke-linecap="round" stroke-linejoin="round"> --}}
                    {{--                                        <polyline points="15 18 9 12 15 6"></polyline> --}}
                    {{--                                    </svg> --}}
                    {{--                                </a> --}}
                    {{--                            </li> --}}

                    {{--                            <!-- Aktiv Səhifə --> --}}
                    {{--                            <li class="page-item active"> --}}
                    {{--                                <a class="page-link" href="#">1</a> --}}
                    {{--                            </li> --}}

                    {{--                            <!-- Digər Səhifələr --> --}}
                    {{--                            <li class="page-item"> --}}
                    {{--                                <a class="page-link" href="#">2</a> --}}
                    {{--                            </li> --}}

                    {{--                            <li class="page-item"> --}}
                    {{--                                <a class="page-link" href="#">3</a> --}}
                    {{--                            </li> --}}

                    {{--                            <!-- Üç nöqtə (Aradakı səhifələri qısaltmaq üçün) --> --}}
                    {{--                            <li class="page-item dots"> --}}
                    {{--                                <span class="page-link">...</span> --}}
                    {{--                            </li> --}}

                    {{--                            <!-- Sonuncu Səhifə --> --}}
                    {{--                            <li class="page-item"> --}}
                    {{--                                <a class="page-link" href="#">12</a> --}}
                    {{--                            </li> --}}

                    {{--                            <!-- Sağ Ox (İrəli) --> --}}
                    {{--                            <li class="page-item"> --}}
                    {{--                                <a class="page-link" href="#"> --}}
                    {{--                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" --}}
                    {{--                                         stroke-linecap="round" stroke-linejoin="round"> --}}
                    {{--                                        <polyline points="9 18 15 12 9 6"></polyline> --}}
                    {{--                                    </svg> --}}
                    {{--                                </a> --}}
                    {{--                            </li> --}}

                    {{--                        </ul> --}}
                    {{--                    </nav> --}}

                </div>

            </div>

        </div>
        <!-- product list end -->

        <!-- partners start -->
        <div class="partners-section">

            <div id="logoStrip" class="splide logo-strip">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($partners as $partner)
                            <li class="splide__slide">
                                <div class="logo-div"><img src="{{ $partner->image }}" alt=""></div>
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

    <script src="{{ asset('web/js/splide.js') }}"></script>
    <script src="{{ asset('web/js/rangeInput.js') }}"></script>
    <script src="{{ asset('web/js/sortSelect.js') }}"></script>
@endpush
