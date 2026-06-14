@extends("web.layout")

@section('content')

    <div class="page-container branches-container">

        <!-- hero start -->
        <div class="page-hero branches-hero">

            <img src="{{$banner? $banner->image : ''}}" alt="">

            <div class="hero-content">
                <span class="hero-title">@lang("Branches")</span>
                <span class="breadcrumb">@lang("Home") &nbsp; &nbsp;/ &nbsp; &nbsp; @lang("Branches")</span>
            </div>

            <div class="overlay"></div>

        </div>
        <!-- hero end -->

        <!-- branches start -->
        <div class="branches-section">

            <div class="section-header">

                <div class="section-header-left">

                    <span class="section-title">@lang("Meet our branches")</span>

                    <div class="red-line"></div>

                    <p class="section-description">
                        @lang("Find the Tamstore Plus address closest to you. We are waiting for you at every branch with our quality products and premium service.")
                    </p>

                </div>

                <div class="section-header-right">

                    <div class="search-input-div">

                        <input type="text" placeholder="@lang("Find a branch...")" data-name="search">

                        <img src="{{asset('web/icons/search-icon.svg')}}" alt="">

                    </div>

                </div>


            </div>

            <div class="section-body">

                <div class="branch-list" id="branch-list">

                    @foreach($branches as $branch)
                        <div class="branch-card">

                            <div class="card-header">

                                <div class="card-header-left">
                                    <span class="branch-name">{{$branch->name}}</span>
                                    <div class="branch-status">
                                        <div class="circle"></div>
                                        <span>{{$branch->is_open ? __("It's Open Now") : __("Not Open Now")}}</span>
                                    </div>
                                </div>

                            </div>

                            <div class="card-body">

                                <div class="branch-info">

                                    <img src="{{asset('web/icons/location-icon.svg')}}" alt="" class="info-icon">

                                    <span class="info-text">{{$branch->address}}</span>

                                </div>

                                <div class="branch-info">

                                    <img src="{{asset('web/icons/phone-icon.svg')}}" alt="" class="info-icon">

                                    <span class="info-text">{{$branch->phone_1}} / {{$branch->phone_2}}</span>

                                </div>

                                <div class="branch-info">

                                    <img src="{{asset('web/icons/clock-icon.svg')}}" alt="" class="info-icon">

                                    <span
                                        class="info-text">@lang("Everyday"): {{$branch->working_hours_start . '-' . $branch->working_hours_end}}</span>

                                </div>

                            </div>

                            <div class="card-footer">

                                <a href="#"
                                   class="show-on-map"
                                   data-lat="{{$branch->lat}}"
                                   data-lng="{{$branch->lng}}"
                                   data-zoom="{{$branch->zoom}}"
                                   onclick="showMap(event, '{{$branch->lat}}', '{{$branch->lng}}', '{{$branch->zoom}}')">
                                    <span>@lang("Show on map")</span>
                                </a>


                            </div>

                        </div>

                    @endforeach

                </div>

                <div class="map">
                    <iframe id="mainMap"
                            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3039.4!2d49.8!3d40.4!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1str!2s!4v1"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>

            </div>

        </div>
        <!-- branches end -->

        <!-- promo start -->
        @include('web.components.qr')
        <!-- promo end -->

    </div>

@endsection
@push('scripts')

    <script src="{{asset('web/js/pages/branches.js')}}"></script>
@endpush
