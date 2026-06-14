@extends('web.layout')

@section('content')

    <div class="page-container news-details-container">

        <!-- news details start -->
        <div class="news-details">
            <div class="news-details-header">
                <img src="{{$news->image}}" alt="" class="news-image">

                <div class="news-details-header-content">

                    <div class="header-meta">
                        <div class="news-category">
                            <span>{{$news->category->name}}</span>
                        </div>
                        <span class="news-date">{{$news->date}}</span>
                    </div>

                    <span class="news-title">
                        {{$news->title}}
                    </span>

                    <!-- <div class="news-writer">
                        <div class="writer-image">
                            <img src="assets/images/profile.webp" alt="">
                        </div>

                        <div class="writer-infos">
                            <span class="writer-name">Albert Haciverdiyev</span>
                            <span class="writer-position">Korporativ Kommunikasiyalar</span>
                        </div>

                    </div> -->

                    <div class="breadcrumb">
                        @lang("Home") / @lang("News details")
                    </div>

                </div>

                <div class="overlay"></div>
            </div>

            <div class="news-details-body">

                <div class="share-news">

                    <span class="title">@lang("SHARE")</span>

                    <button class="copy-button" type="button" aria-label="Copy page link" data-tooltip="Copy">
                        <img src="{{asset('web/icons/copy.svg')}}" alt="">
                    </button>

                    <button class="save-button">
                        <img src="{{asset('web/icons/save-icon.svg')}}" alt="">
                    </button>

                </div>

                <div class="news-content">

                    <div class="text-content">
                        {!! $news->description !!}
                    </div>

                    <div class="news-tags">

                        @foreach ($news->tags as $tag)
                        <div class="tag">
                            <span>#{{$tag}}</span>
                        </div>
                        @endforeach

                    </div>

                </div>

                <div class="useful-links">

                    <span class="title">@lang("USEFUL LINKS")</span>

                    <a href="" class="useful-link">
                        <img src="{{asset('web/icons/document-icon.svg')}}" alt="">

                        <span>Media Kit (Yüklə)</span>
                    </a>

                    <a href="" class="useful-link">
                        <img src="{{asset('web/icons/id-icon.svg')}}" alt="">

                        <span>Mətbuat Mərkəzi</span>
                    </a>

                    <a href="" class="useful-link">
                        <img src="{{asset('web/icons/speaker-icon.svg')}}" alt="">

                        <span>Sponsorluq Sorğuları</span>
                    </a>

                </div>

            </div>
        </div>
        <!-- news details start -->

        <!-- subscription start -->
        @include('web.components.subscription')

        <!-- subscription end -->

    </div>
@endsection
