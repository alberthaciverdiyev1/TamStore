<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('web.partials.head')

<body>


@isset($popup)
    @if (Request::is('/'))

        <div class="popup-container close">
            <div class="popup-content">
                @if($popup->url)
                    <a href="{{ $popup->url }}">
                        <img src="{{ asset('storage/' . $popup->image) }}" alt="">
                        <div class="popup-button">
                            <span>@lang("Details")</span>
                        </div>
                    </a>
                @else
                    <img src="{{ asset('storage/' . $popup->image) }}" alt="">
                @endif

                <div class="close-popup">
                    <img src="{{ asset('web/icons/close.svg') }}" alt="">
                </div>
            </div>
        </div>

    @endif
@endisset

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
