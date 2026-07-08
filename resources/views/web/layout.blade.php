<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('web.partials.head')

<body>


@if (Request::is('/'))
    <a href="/etrafli-bax" class="popup-container close">
        <div class="popup-content">
            <img src="https://cdn.pixabay.com/photo/2015/04/19/08/32/flower-729510_1280.jpg" alt="">

            <div class="popup-button">
                <span>Ətraflı bax</span>
            </div>

            <div class="close-popup">
                <img src="{{ asset('web/icons/close.svg') }}" alt="">
            </div>
        </div>
    </a>
@endif

    <!-- header start -->
    <div id="header-placeholder">
        @include('web.partials.header')
    </div>
    <!-- header end -->

    <!-- main start -->
    {!! setting('scripts.body') !!}

    @yield('content')
    <!-- main end -->

    <!-- footer start -->
    <div id="footer-placeholder">
        @include('web.partials.footer')
    </div>
    <!-- footer end -->

    <button class="btn-red phone-button">
        <span>{{ setting('contact.phone') }}</span>
    </button>


    <!-- scripts -->
    @include('web.partials.scripts')
</body>

</html>
