@if(setting('app.app_store_link') || setting('app.google_play_link'))

    <div class="app-promo-card">
        <div class="section-info">
            <div class="centered-div">
                <span class="title">@lang("Complete Your Lifestyle With Us")</span>
                <p class="description">@lang("Shopping is not just a necessity, it is a moment of pleasure. Tamstore Plus makes these moments unforgettable.")</p>

                <div class="store-links">

                    @if(setting('app.app_store_link'))
                        <a href="{{setting('app.app_store_link')}}" class="store-link">
                            <img src="{{asset('web/icons/apple-icon.svg')}}" alt="" class="store-icon">
                            <div class="link-texts">
                                <span>Download on the</span>
                                <span>App Store</span>
                            </div>
                        </a>
                    @endif
                    @if(setting('app.google_play_link'))

                        <a href="{{setting('app.google_play_link')}}" class="store-link">
                            <img src="{{asset('web/icons/apple-icon.svg')}}" alt="" class="store-icon">
                            <div class="link-texts">
                                <span>Download on the</span>
                                <span>App Store</span>
                            </div>
                        </a>
                    @endif

                </div>


            </div>
        </div>

        <div class="qr-code-container">

            <!-- (burada commentdəki elementləri silməyək hər ehtimal) -->

            <!-- <img src="assets/images/qr-background.jpg" alt="" class="background-image"> -->

            <img src="{{asset('web/images/qr-w-bg.png')}}" alt="" class="background-image">


            <div class="qr-code">
                <!-- <img src="assets/images/qr-w-bg.png" alt=""> -->
            </div>

            <!-- <div class="overlay"></div> -->

        </div>
    </div>
@endif
