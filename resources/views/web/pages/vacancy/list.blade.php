@extends('web.layout')

@section('content')

    <div class="page-container career-container">

        <!-- hero start -->
        <div class="page-hero partners-hero">

            <img src="{{$banner? $banner->image : ''}}" alt="">

            <div class="hero-content">
                <span class="hero-title">@lang("Career")</span>
                <span class="breadcrumb">@lang("Home") &nbsp; &nbsp;/ &nbsp; &nbsp; @lang("Career")</span>
            </div>

            <div class="overlay"></div>

        </div>
        <!-- hero end -->

        <!-- why-us start -->
        <div class="why-us-section">

            <div class="section-header">
                <div class="section-header-left">
                    <span class="section-title">@lang("Why do people love working at Tamstore?")</span>
                    <div class="red-line"></div>
                </div>

            </div>

            <div class="section-body">

                <div class="feature-card">

                    <div class="card-content">
                        <img src="{{asset('web/icons/f5.svg')}}" alt="">

                        <span class="card-title">@lang("Quality Assurance")</span>

                        <p class="card-description">
                           @lang("Each of our partners goes through a rigorous selection process and proves their compliance with our premium standards.")
                        </p>
                    </div>

                    <img class="background-icon" src="{{asset('web/icons/featured-card-bckr-icon.svg')}}" alt="">

                    <div class="overlay"></div>

                </div>

                <div class="feature-card">

                    <div class="card-content">
                        <img src="{{asset('web/icons/f1.svg')}}" alt="">

                        <span class="card-title">Keyfiyyət Təminatı</span>

                        <p class="card-description">
                            Hər bir partnyorumuz ciddi seçim mərhələsindən
                            keçərək premium standartlarımıza uyğunluğunu
                            sübut edir.
                        </p>
                    </div>

                    <img class="background-icon" src="{{asset('web/icons/featured-card-bckr-icon.svg')}}" alt="">

                    <div class="overlay"></div>

                </div>

                <div class="feature-card">

                    <div class="card-content">
                        <img src="{{asset('web/icons/f4.svg')}}" alt="">

                        <span class="card-title">Keyfiyyət Təminatı</span>

                        <p class="card-description">
                            Hər bir partnyorumuz ciddi seçim mərhələsindən
                            keçərək premium standartlarımıza uyğunluğunu
                            sübut edir.
                        </p>
                    </div>

                    <img class="background-icon" src="{{asset('web/icons/featured-card-bckr-icon.svg')}}" alt="">

                    <div class="overlay"></div>

                </div>

            </div>

        </div>
        <!-- why-us end -->

        <!-- vacancies start -->
        <div class="vacancies-section">

            <div class="section-header">

                <div class="section-header-left">
                    <span class="section-title">@lang("Active vacancies")</span>
                    <div class="red-line"></div>
                </div>

            </div>

            <div class="section-body">

                <div class="vacancy-cards">
                    @foreach($vacancies as $vacancy)
                        <a  href="{{ route('vacancy.details', $vacancy->id) }}" class="vacancy-card">

                            <span class="card-title">
                                {{ $vacancy->name }}
                            </span>
                            <button class="btn-red apply-btn" data-vacancy-id="{{ $vacancy->id }}" data-vacancy-name="{{ $vacancy->name }}" data-bs-toggle="modal" data-bs-target="#vacancyListModal">
                                <span>@lang("Details")</span>
                            </button>


                        </a>
                    @endforeach
                </div>

                <div class="pagination-wrapper">
                    {{ $vacancies->links('web.partials.custom-pagination') }}
                </div>

            </div>

        </div>
        <!-- vacancies end -->

        <!-- subscription start -->
        @include('web.components.subscription')
        <!-- subscription end -->


    </div>

@endsection
