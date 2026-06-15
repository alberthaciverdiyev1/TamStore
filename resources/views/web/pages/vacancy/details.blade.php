@extends('web.layout')

@section('content')
    <div class="page-container vacancy-details-container">

        <div class="vacancy-head">
            <img src="{{$banner ? $banner->image : ''}}" alt="" class="vacancy-image">

            <div class="head-content">
                <span class="vacancy-location">{{strtoupper(__("Career"))}} @if($vacancy->city) • {{ $vacancy->city }} @endif</span>
                <span class="vacancy-title">{{ $vacancy->name }}</span>

                <div class="vacancy-meta">
                    @if($vacancy->salary)
                        <div class="meta-div">
                            <img src="{{asset('web/icons/clock-icon.svg')}}" alt="">
                            <span>{{ $vacancy->salary }}</span>
                        </div>
                    @endif
                    @if($vacancy->work_type_label)
                        <div class="meta-div">
                            <img src="{{asset('web/icons/clock-icon.svg')}}" alt="">
                            <span>{{ $vacancy->work_type_label }}</span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="overlay"></div>
        </div>

        <div class="vacancy-body">

            <div class="vacancy-body-left">
                <div class="vacancy-description">
                    <div class="vacancy-description-head">
                        <span class="title">@lang("General information about the job")</span>
                    </div>
                    @if($vacancy->description)
                        <div class="vacancy-description-body">
                                {!! $vacancy->description !!}
                        </div>
                    @endif
                </div>

                @if($vacancy->requirements)
                    <div class="requirements">
                        <span class="title">@lang("Requirements")</span>
                        <div class="requirement-div">
                            <img src="{{asset('web/icons/check-icon.svg')}}" alt="">
                            <span>{!! $vacancy->requirements !!}</span>
                        </div>
                    </div>
                @endif

                @if($vacancy->advantages && count($vacancy->advantages))
                    <div class="our-advantages">
                        <div class="our-advantages-head">
                            <span class="title">@lang("Our advantages")</span>
                        </div>

                        <div class="our-advantages-body">
                            @foreach($vacancy->advantages as $advantage)
                                @if(is_array($advantage) && isset($advantage['key']))
                                    <div class="our-advantages-card">
                                        <div class="card-icon">
                                            <img src="{{asset('web/icons/static-card-icon.svg')}}" alt="">
                                        </div>
                                        <div class="card-infos">
                                            <span class="card-infos-title">{{ $advantage['key'] }}</span>
                                            <span class="card-infos-description">{{ $advantage['value'] ?? '' }}</span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="vacancy-body-right">
                <div class="vacancy-actions">
                    <div class="vacancy-expiration">
                        @if($vacancy->application_deadline)
                            <span class="title">@lang("Application deadline")</span>
                            <span class="expiration-date">{{ $vacancy->application_deadline }}</span>
                        @endif
                    </div>

                    <button class="btn-red" data-bs-toggle="modal" data-bs-target="#vacancyDetailModal"
                            data-bs-id="{{ $vacancy->id }}" data-bs-name="{{ $vacancy->name }}">
                        <span>@lang("Apply")</span>
                    </button>

{{--                    <button class="btn-white-bordered">--}}
{{--                        <span>Yadda saxla</span>--}}
{{--                    </button>--}}

                    <div class="share-vacancy">
                        <span class="title">@lang("Share")</span>
                        <button class="copy-button" type="button" aria-label="Copy page link" data-tooltip="Copy">
                            <img src="{{asset('web/icons/copy.svg')}}" alt="">
                        </button>
                    </div>

                    <!-- application modal start -->
                    <div class="modal fade" id="vacancyDetailModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content send-cv-modal">
                                <div class="modal-header">
                                    <span class="form-title" id="modal-vacancy-title">{{ $vacancy->name }} - @lang("Apply")</span>
                                    <p class="form-description">
                                        @lang("Apply to join the Tamstore+ team. Maximum file size: 10MB.")
                                    </p>
                                </div>

                                <form id="vacancy-detail-form">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="hidden" name="vacancy_id" id="modal-vacancy-id" value="{{ $vacancy->id }}">

                                        <div class="input-with-label grid-item">
                                            <label for="detail_full_name">@lang("Name and surname")</label>
                                            <input type="text" id="detail_full_name" name="full_name" placeholder="@lang("Name and surname")" required>
                                        </div>

                                        <div class="input-with-label grid-item">
                                            <label for="detail_email">@lang("Email address")</label>
                                            <input type="email" id="detail_email" name="email" placeholder="@lang("Email address")" required>
                                        </div>

                                        <div class="input-with-label grid-item">
                                            <label for="detail_phone">@lang("Phone")</label>
                                            <input type="text" id="detail_phone" name="phone" placeholder="@lang("Phone")">
                                        </div>

                                        <div class="file-upload-input grid-item">
                                            <label for="detailVacancyFile" class="file-upload-box">
                                                <input type="file" id="detailVacancyFile" name="file" accept=".pdf,.doc,.docx,.ppt,.pptx" hidden>
                                                <div class="upload-content">
                                                    <div class="upload-icon">
                                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                            <polyline points="17 8 12 3 7 8"></polyline>
                                                            <line x1="12" y1="3" x2="12" y2="15"></line>
                                                        </svg>
                                                    </div>
                                                    <span class="upload-title">@lang("Attach your CV file here")</span>
                                                    <span class="upload-subtitle">(PDF, DOC, PPT)</span>
                                                </div>
                                            </label>
                                            <div class="selected-file-name" id="detailFileNameDisplay"></div>
                                        </div>

                                        <div class="text-danger" id="vacancy-detail-error"></div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn-white-bordered" data-bs-dismiss="modal" aria-label="Close">
                                            <span>@lang("Cancel")</span>
                                        </button>
                                        <button type="submit" class="btn-red" id="vacancy-detail-submit">
                                            <span>@lang("Send")</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- application modal end -->

                    <!-- success modal start -->
                    <div class="modal fade" id="vacancyDetailSuccessModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content success-modal">
                                <div class="modal-header">
                                    <span class="modal-title">@lang("Your application has been accepted.")</span>
                                    <p class="modal-description">
                                        @lang("Your application has been accepted. The Tamstore+ team will contact you as soon as possible.")
                                    </p>
                                </div>
                                <div class="modal-body">
                                    <img src="{{asset('web/icons/success-icon.svg')}}" alt="">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn-white-bordered" data-bs-dismiss="modal" aria-label="Close">
                                        <span>@lang("Close")</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- success modal end -->
                </div>

                <div class="other-vacancies">
                    <span class="title">@lang("Other vacancies")</span>

                    <div class="vacancies">
                        @foreach($vacancies as $v)
                            <div class="vacancy-card">
                                <span class="card-title">{{$v->name}}</span>
                                <button class="btn-red">
                                    <a href="{{route('vacancy.details', $v->id)}}" class="btn-red-link">

                                    <span>@lang("Details")</span>
                                    </a>
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <div class="btn-more">
                        <a href="{{route('vacancy.list')}}" >

                        <span>@lang("View all")</span>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var formModalEl = document.getElementById('vacancyDetailModal');
            var successModalEl = document.getElementById('vacancyDetailSuccessModal');

            var formModal = formModalEl ? new bootstrap.Modal(formModalEl) : null;
            var successModal = successModalEl ? new bootstrap.Modal(successModalEl) : null;

            if (formModalEl) {
                formModalEl.addEventListener('show.bs.modal', function (event) {
                    var button = event.relatedTarget;
                    var vacancyId = button.getAttribute('data-bs-id');
                    var vacancyName = button.getAttribute('data-bs-name');

                    var modalHiddenInput = formModalEl.querySelector('#modal-vacancy-id');
                    var modalTitleSpan = formModalEl.querySelector('#modal-vacancy-title');

                    if (modalHiddenInput) modalHiddenInput.value = vacancyId;
                    if (modalTitleSpan) modalTitleSpan.innerText = vacancyName + ' - Müraciət';

                    var errorDiv = formModalEl.querySelector('#vacancy-detail-error');
                    if (errorDiv) errorDiv.innerText = '';
                });
            }

            var fileInput = document.getElementById('detailVacancyFile');
            var fileNameDisplay = document.getElementById('detailFileNameDisplay');
            if (fileInput && fileNameDisplay) {
                fileInput.addEventListener('change', function() {
                    fileNameDisplay.innerText = this.files.length > 0 ? this.files[0].name : '';
                });
            }

            var form = document.getElementById('vacancy-detail-form');
            if (form) {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    var submitBtn = document.getElementById('vacancy-detail-submit');
                    var errorDiv = document.getElementById('vacancy-detail-error');

                    if (submitBtn) submitBtn.disabled = true;
                    if (errorDiv) errorDiv.innerText = '';

                    var formData = new FormData(form);

                    fetch('/vacancy-application', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                        .then(function (response) {
                            if (!response.ok) {
                                throw response;
                            }
                            return response.json();
                        })
                        .then(function (data) {
                            if (formModal) formModal.hide();
                            form.reset();
                            if (fileNameDisplay) fileNameDisplay.innerText = '';

                            if (successModal) successModal.show();
                        })
                        .catch(function (error) {
                            if (error.json) {
                                error.json().then(function (errData) {
                                    if (errorDiv) errorDiv.innerText = errData.message || 'Bir hata oluştu.';
                                });
                            } else {
                                if (errorDiv) errorDiv.innerText = 'Sistem hatası oluştu. Lütfen tekrar deneyin.';
                            }
                        })
                        .finally(function () {
                            if (submitBtn) submitBtn.disabled = false;
                        });
                });
            }
        });
    </script>
@endsection
