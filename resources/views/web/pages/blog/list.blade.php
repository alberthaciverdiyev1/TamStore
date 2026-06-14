@extends('web.layout')

@section('content')
    <div class="page-container blogs-container">

        <!-- hero start -->
        <div class="page-hero blogs-hero">

            <img src="{{$banner? $banner->image : ''}}" alt="">

            <div class="hero-content">
                <span class="hero-title">@lang("Blogs")</span>
                <span class="breadcrumb">@lang("Home") &nbsp; &nbsp;/ &nbsp; &nbsp; @lang("Blogs")</span>
            </div>

            <div class="overlay"></div>

        </div>
        <!-- hero end -->

        <!-- blogs start -->
        <div class="blogs-section">
            <ul class="nav nav-pills" id="blogs-tabs" role="tablist">

                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="tab-all" data-bs-toggle="pill" data-bs-target="#content-all"
                            type="button" role="tab" aria-controls="content-all" aria-selected="true" data-category-id="">
                        @lang("All")
                    </button>
                </li>

                @foreach($blogCategories as $category)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link category-tab"
                                data-category-id="{{$category->id}}"
                                type="button">
                            {{$category->name}}
                        </button>
                    </li>
                @endforeach

            </ul>

            <div class="tab-content" id="blogs-tabs-content">
                <div class="tab-pane fade show active" id="content-all" role="tabpanel" aria-labelledby="tab-all">

                    <div class="tab-pane-wrapper">

                        <div class="blog-cards" id="blog-cards">

                        </div>

                        <nav aria-label="Səhifələmə" class="custom-pagination">
                            <ul class="pagination-list" id="blog-pagination"></ul>
                        </nav>

                    </div>


                </div>

            </div>
        </div>
        <!-- blogs end -->

        <!-- subscription start -->
        @include('web.components.subscription')

        <!-- subscription end -->

    </div>

@endsection
@push('scripts')

    <script src="{{asset('web/js/pages/blogs.js')}}"></script>
@endpush
