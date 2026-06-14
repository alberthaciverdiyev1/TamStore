@extends('web.layout')

@section('content')

    <div class="page-container news-container">

    <!-- hero start -->
    <div class="page-hero news-hero">

        <img src="{{$banner? $banner->image : ''}}" alt="">

        <div class="hero-content">
            <span class="hero-title">@lang("News")</span>
            <span class="breadcrumb">@lang("Home") &nbsp; &nbsp;/&nbsp; &nbsp; @lang("News")</span>
        </div>

        <div class="overlay"></div>

    </div>
    <!-- hero end -->

    <!-- news start -->
    <div class="news-section">
        <ul class="nav nav-pills" id="news-tabs" role="tablist">

            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="tab-all" data-bs-toggle="pill" data-bs-target="#content-all"
                        type="button" role="tab" aria-controls="content-all" aria-selected="true" data-category-id="">
                    @lang("All")
                </button>
            </li>

            @foreach($newsCategories as $category)
                <li class="nav-item" role="presentation">
                    <button class="nav-link category-tab"
                            data-category-id="{{$category->id}}"
                            type="button">
                        {{$category->name}}
                    </button>
                </li>
            @endforeach

        </ul>

        <div class="tab-content" id="news-tabs-content">
            <!-- (burada ilk tab-pane html strukturunu əsas götürürük) -->
            <div class="tab-pane fade show active" id="content-all" role="tabpanel" aria-labelledby="tab-all">

                <div class="tab-pane-wrapper">

                    <div class="news-cards"  id="news-cards">


                    </div>

                    <nav aria-label="Səhifələmə" class="custom-pagination">
                        <ul class="pagination-list" id="news-pagination"></ul>
                    </nav>

                </div>

            </div>

        </div>
    </div>
    <!-- news end -->

    <!-- subscription start -->
        @include('web.components.subscription')

        <!-- subscription end -->

</div>

@endsection

@push('scripts')
    <script src="{{asset('web/js/pages/news.js')}}"></script>
@endpush
