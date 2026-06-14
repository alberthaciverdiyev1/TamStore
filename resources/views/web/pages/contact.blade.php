@extends('web.layout')

@section('content')

    <div class="page-container contact-page-container">

        <!-- hero start -->
        <div class="page-hero about-hero">

            <img src="{{$banner? $banner->image : ''}}" alt="">

            <div class="hero-content">
                <span class="hero-title">@lang("Contact us")</span>
                <span class="breadcrumb">@lang("Home") &nbsp; &nbsp;/ &nbsp; &nbsp; @lang("Contact")</span>
            </div>

            <div class="overlay"></div>

        </div>
        <!-- hero end -->

        <!-- contact start -->
        <div class="contact-section">

            <div class="contact-infos">

                <div class="contact-infos-header">
                    <span class="infos-title">@lang("Contact information")</span>
                    <span class="infos-description">
                        @lang('How to contact us')
                    </span>
                </div>

                <div class="contact-infos-body">

                    @foreach($branches as $branch)
                        <div class="contact-info-card">

                            <div class="card-icon">
                                <img src="{{asset('web/icons/location-icon.svg')}}" alt="">
                            </div>

                            <div class="card-infos">
                                <span class="label">@lang("Address")</span>
                                <span class="value">{{$branch->address}}</span>
                            </div>

                        </div>
                    @endforeach


                </div>

            </div>

            <div class="contact-form">

                <div class="input-with-label grid-item">
                    <label for="">@lang("Name and surname")</label>
                    <input type="text" name="full_name" placeholder="@lang("Name and surname")">
                </div>

                <div class="input-with-label grid-item">
                    <label for="">@lang("Email address")</label>
                    <input type="text" name="email" placeholder="@lang("Email address")">
                </div>

                <div class="input-with-label grid-item">
                    <label for="">@lang("Subject")</label>
                    <input type="text" name="subject" placeholder="@lang("Subject of message")">
                </div>

                <div class="textarea-with-label grid-item">
                    <label for="">@lang("Message")</label>
                    <textarea type="text" name="message" placeholder="@lang("Message")"></textarea>
                </div>

                <button class="btn-red" data-name="send">
                    <span>@lang("Send message")</span>
                </button>

                <div class="text-success d-none"> </div>
            </div>

        </div>
        <!-- contact end -->

        <!-- map start -->
        <div class="map">
            {!! setting('contact.google_map') !!}
        </div>
        <!-- map end -->

        <!-- follow-us start -->
        <div class="follow-us-section">

            <div class="section-header">
                <div class="section-header-left">
                    <span class="section-title">@lang("Follow us")</span>
                    <div class="red-line"></div>
                    <p class="section-description">
                        @lang("Be the first to know about new collections and news")
                    </p>
                </div>

            </div>

            <div class="section-body">

                <a href="{{setting('social.instagram')}}" class="social-media-link-card">

                    <img src="{{asset('web/icons/insta.svg')}}" alt="">

                    <span class="link-title">Instagram</span>

                </a>

                <a href="{{setting('social.facebook')}}" class="social-media-link-card">

                    <img src="{{asset('web/icons/fb.svg')}}" alt="">

                    <span class="link-title">Facebook</span>

                </a>

                <a href="{{setting('social.youtube')}}"  class="social-media-link-card">

                    <img src="{{asset('web/icons/youtube.svg')}}" alt="">

                    <span class="link-title">YouTube</span>

                </a>

                <a href="{{setting('social.tiktok')}}"  class="social-media-link-card">

                    <img src="{{asset('web/icons/tiktok.svg')}}" alt="">

                    <span class="link-title">TikTok</span>

                </a>

            </div>

        </div>
        <!-- follow-us end -->

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sendBtn = document.querySelector('[data-name="send"]');
            const contactForm = document.querySelector('.contact-form');
            const successDiv = document.querySelector('.text-success');

            sendBtn.addEventListener('click', async () => {
                const formData = {
                    full_name: contactForm.querySelector('[name="full_name"]').value,
                    email:     contactForm.querySelector('[name="email"]').value,
                    subject:   contactForm.querySelector('[name="subject"]').value,
                    message:   contactForm.querySelector('[name="message"]').value,
                    _token:    document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                };

                try {
                    const response = await fetch('/contact', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(formData)
                    });

                    const result = await response.json();

                    if (response.ok) {
                        successDiv.textContent = result.message || 'Mesajınız uğurla göndərildi!';
                        successDiv.classList.remove('d-none');

                        contactForm.reset();

                    } else {
                        successDiv.textContent = result.message;
                        successDiv.classList.remove('d-none');
                    }
                        setTimeout(() => successDiv.classList.add('d-none'), 5000);
                } catch (error) {
                    console.error('Form göndərilmədi:', error);
                }
            });
        });
    </script>
@endsection
