@extends('web.layout')

@section('content')

    <div class="page-container blog-details-container">

        <!-- blog details start -->
        <div class="blog-details">

            <div class="blog-details-header">
                <img src="{{$blog->image}}" alt="" class="blog-image">

                <div class="blog-details-header-content">

                    <div class="header-meta">
                        <div class="blog-category">
                            <span>{{$blog->category->name}}</span>
                        </div>
                        <span class="blog-date">{{$blog->date}}</span>
                    </div>

                    <span class="blog-title">
                       {{$blog->title}}
                    </span>

                    <!-- <div class="blog-writer">
                        <div class="writer-image">
                            <img src="assets/images/profile.webp" alt="">
                        </div>

                        <div class="writer-infos">
                            <span class="writer-name">Albert Haciverdiyev</span>
                            <span class="writer-position">Korporativ Kommunikasiyalar</span>
                        </div>

                    </div> -->

                    <div class="breadcrumb">
                        @lang("Home") / @lang("Blog details")
                    </div>

                </div>

                <div class="overlay"></div>
            </div>

            <div class="blog-details-body">

                <div class="share-blog">

                    <span class="title">@lang("SHARE")</span>

                    <button class="copy-button" type="button" aria-label="Copy page link" data-tooltip="Copy">
                        <img src="{{asset('web/icons/copy.svg')}}" alt="">
                    </button>

                    <button class="save-button">
                        <img src="{{asset('web/icons/save-icon.svg')}}" alt="">
                    </button>

                </div>

                <div class="blog-content">

                    <div class="text-content">
                        {!! $blog->description !!}
                    </div>

                    <div class="blog-tags">
                        @forelse($blog->tags as $tag)
                            <div class="tag">
                                <span>#{{$tag}}</span>
                            </div>
                        @empty
                        @endforelse
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
        <!-- blog details end -->

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
                            <button class="swipe-button btn-prew" type="button">
                                <img src="{{asset('web/icons/swiper-button-left.svg')}}" alt="">
                            </button>

                            <button class="swipe-button btn-next" type="button">
                                <img src="{{asset('web/icons/swiper-button-right.svg')}}" alt="">
                            </button>
                        </div>

                        <a href="{{route('blog.list')}}" class="btn-more">
                            <span>@lang("View all")</span>
                            <img src="{{asset('web/icons/arrow-right-red.svg')}}" alt="">
                        </a>
                    </div>


                </div>

            </div>

            <div class="section-body">

                <div class="swiper blogsSwiper">

                    <div class="swiper-wrapper">
                        @forelse($featuredBlogs as $blog)
                            <div class="swiper-slide">
                                <a href="{{route('blog.details',$blog->id)}}" class="blog-card">

                                    <div class="blog-image">
                                        <img src="{{$blog->image}}" alt="">

                                        <div class="blog-category">
                                            <span>{{$blog->category->name}}</span>
                                        </div>
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
                                            {!! $blog->description !!}.
                                        </p>

                                        <button class="read-more">
                                            <span>OXU</span>
                                            <img src="{{asset('web/icons/arrow-right-red.svg')}}" alt="">
                                        </button>

                                    </div>

                                </a>
                            </div>
                        @empty
                        @endforelse
                    </div>

                </div>

            </div>

        </div>
        <!-- featured blogs end -->

        <!-- subscription start -->
        @include('web.components.subscription')
        <!-- subscription end -->

    </div>
@endsection
@push('scripts')

    <script src="{{asset('web/js/pages/blogs.js')}}"></script>
@endpush
