@extends('web.layout')

@section('content')


    <div class="page-container partners-container">

        <!-- hero start -->
        <div class="page-hero partners-hero">

            <img src="{{$banner? $banner->image : ''}}" alt="">

            <div class="hero-content">
                <span class="hero-title">@lang("Partners")</span>
                <span class="breadcrumb">@lang("Home") &nbsp; &nbsp;/ &nbsp; &nbsp; @lang("Partners")</span>
            </div>

            <div class="overlay"></div>

        </div>
        <!-- hero end -->

        <!-- partners start -->
        <div class="partners-section">

            <div class="section-header">

                <div class="section-header-left">
                    <span class="section-title">@lang("We are together to create value.")</span>
                    <div class="red-line"></div>
                    <p class="section-description">
                       @lang("As Tamstore Plus, we partner with world-class brands to provide our customers with only the highest quality and exclusive products. Our partner network is built on excellence and reliability.")
                    </p>
                </div>

                <div class="section-header-right">

                    <a href="#" class="btn-red" data-bs-toggle="modal" data-bs-target="#partnerModal">
                        <span>@lang("Become a partner")</span>
                    </a>

                    <a href="" class="btn-white-bordered">
                        <span>@lang("More information")</span>
                    </a>

                </div>

            </div>

            <div class="section-body">

                <div class="partners">

                    @foreach($partners as $partner)
                    <div class="partner-card">
                        <img src="{{$partner->image}}" alt="">

                        <div class="overlay"></div>
                    </div>
                    @endforeach
                </div>

                <div class="pagination-wrapper">
                    {{ $partners->links('web.partials.custom-pagination') }}
                </div>
            </div>

        </div>
        <!-- partners end -->

        <!-- features start -->
        <div class="features-section">

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
        <!-- features end -->

        <!-- contact us start -->
        <div class="contact-us">

            <div class="centered-div">
                <span class="section-title">Bizimlə əməkdaşlığa başlayın</span>

                <p class="section-description">
                    Tamstore Plus ailəsinin bir hissəsi olmaq və premium müştəri bazamıza çıxış
                    əldə etmək üçün müraciət edin.
                </p>

                <button class="open-form" data-bs-toggle="modal" data-bs-target="#partnerModal">
                    <span>Müraciət formasını doldurun</span>
                </button>
            </div>

        </div>
        <!-- contact us end -->

        <!-- application modal start -->
        <div class="modal fade" id="partnerModal" tabindex="-1" aria-labelledby="partnerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content application-form-modal">
                    <div class="modal-header">
                        <span class="form-title">Partnyor müraciəti</span>
                        <p class="form-description">
                            Tamstore+ ilə əməkdaşlıq üçün məlumatlarınızı təqdim edin. Komandamız müraciətinizi nəzərdən
                            keçirəcək.
                        </p>
                    </div>
                    <form id="partner-form">
                        <div class="modal-body">
                            <div class="input-with-label grid-item">
                                <label for="full_name">Ad və soyad</label>
                                <input type="text" id="full_name" name="full_name" placeholder="Ad və soyad" required>
                            </div>

                            <div class="input-with-label grid-item">
                                <label for="position">Vəzifə</label>
                                <input type="text" id="position" name="position" placeholder="Vəzifə">
                            </div>

                            <div class="input-with-label grid-item">
                                <label for="phone">Telefon nömrəsi</label>
                                <input type="text" id="phone" name="phone" placeholder="Telefon nömrəsi" class="numeric">
                            </div>

                            <div class="input-with-label grid-item">
                                <label for="email">E-mail ünvanı</label>
                                <input type="email" id="email" name="email" placeholder="E-mail ünvanı" required>
                            </div>

                            <div class="input-with-label grid-item">
                                <label for="company_name">Şirkətin adı</label>
                                <input type="text" id="company_name" name="company_name" placeholder="Şirkətin adı">
                            </div>

                            <div class="file-upload-input grid-item">
                                <label for="applicationFile" class="file-upload-box">
                                    <input type="file" id="applicationFile" name="file"
                                           accept=".pdf,.doc,.docx,.ppt,.pptx" hidden>
                                    <div class="upload-content">
                                        <div class="upload-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                <polyline points="17 8 12 3 7 8"></polyline>
                                                <line x1="12" y1="3" x2="12" y2="15"></line>
                                            </svg>
                                        </div>
                                        <span class="upload-title">Kataloq və ya təqdimat faylı</span>
                                        <span class="upload-subtitle">(PDF, DOC, PPT)</span>
                                    </div>
                                </label>
                                <div class="selected-file-name" id="fileNameDisplay"></div>
                            </div>

                            <div class="text-danger" id="partner-form-error"></div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-white-bordered" data-bs-dismiss="modal" aria-label="Close">
                                <span>Ləğv et</span>
                            </button>
                            <button type="submit" class="btn-red" id="partner-submit-btn">
                                <span>Müraciət göndər</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- application modal end -->

        <!-- success modal start -->
        <div class="modal fade" id="partnerSuccessModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content success-modal">
                    <div class="modal-header">
                        <span class="modal-title">Müraciətiniz qəbul edildi</span>
                        <p class="modal-description">
                            Partnyorluq üçün müraciətiniz qəbul olundu. Tamstore+ komandası ən qısa zamanda sizinlə
                            əlaqə saxlayacaq.
                        </p>
                    </div>
                    <div class="modal-body">
                        <img src="{{asset('web/icons/success-icon.svg')}}" alt="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-white-bordered" data-bs-dismiss="modal" aria-label="Close">
                            <span>Bağla</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- success modal end -->

        @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // File upload display
                const fileInput = document.getElementById('applicationFile');
                const fileNameDisplay = document.getElementById('fileNameDisplay');
                fileInput?.addEventListener('change', function() {
                    fileNameDisplay.textContent = this.files[0]?.name || '';
                });

                // Form submission
                const form = document.getElementById('partner-form');
                const errorEl = document.getElementById('partner-form-error');
                const submitBtn = document.getElementById('partner-submit-btn');

                form?.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    errorEl.textContent = '';

                    const formData = new FormData(this);

                    submitBtn.disabled = true;
                    submitBtn.querySelector('span').textContent = '...';

                    try {
                        const response = await fetch('{{ route("partner.application") }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                            },
                            body: formData,
                        });

                        const data = await response.json();

                        if (response.ok) {
                            const modal = bootstrap.Modal.getInstance(document.getElementById('partnerModal'));
                            modal?.hide();
                            form.reset();
                            fileNameDisplay.textContent = '';
                            new bootstrap.Modal(document.getElementById('partnerSuccessModal')).show();
                        } else {
                            const msg = data.errors
                                ? Object.values(data.errors).flat().join(', ')
                                : (data.message || 'Xəta baş verdi.');
                            errorEl.textContent = msg;
                        }
                    } catch (err) {
                        errorEl.textContent = 'Xəta baş verdi.';
                    } finally {
                        submitBtn.disabled = false;
                        submitBtn.querySelector('span').textContent = 'Müraciət göndər';
                    }
                });
            });
        </script>
        @endpush

    </div>


@endsection
