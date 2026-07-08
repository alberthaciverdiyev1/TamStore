<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('web.partials.head')

<body>

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
