@extends('web.layout')

@section('content')

    <div class="page-container faq-page-container">

        <!-- faq start -->
        <div class="faq-section">

            <div class="section-intro">
                <span class="section-title">@lang("Frequently asked questions")</span>
                <p class="section-description">
                    @lang("Do you have a question? You're not alone. If you can't find what you're looking for, we're always here to help.")
                </p>

                <a href="{{route('contact')}}" class="btn-red">
                    <span>@lang("Contact us")</span>
                </a>
            </div>

            <div class="accordion accordion-flush" id="accordionFlushExample">

                @forelse($faqs as $index => $faq)
                    <div class="accordion-item">
                        <div class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapse{{ $faq->id }}" aria-expanded="false" aria-controls="flush-collapse{{ $faq->id }}">
                                <span>{{ $index + 1 }}. {{ $faq->question }}</span>
                                <img src="{{asset('web/icons/accordion-icon.svg')}}" alt="">
                            </button>
                        </div>

                        <div id="flush-collapse{{ $faq->id }}" class="accordion-collapse collapse"
                             data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                {{ $faq->answer }}
                            </div>
                        </div>
                    </div>
                @empty
                <p class="text-center">Hələ ki, sual əlavə olunmayıb.</p>
                @endforelse

            </div>

        </div>
        <!-- faq end -->

        <!-- subscription start -->
        @include('web.components.subscription')
        <!-- subscription end -->

    </div>
@endsection
