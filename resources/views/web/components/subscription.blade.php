<div class="subscription-card">
    <img src="{{asset('web/images/blog-img2.jpg')}}" alt="">

    <div class="card-content">

        <div class="left-side">
            <span class="section-title">@lang('Be the first to get the news.')</span>

            <p class="section-description">
                @lang("Subscribe to our newsletter to be instantly informed about news and special campaigns.")
            </p>
        </div>

        <div class="right-side">

            <div class="subscription-form" id="subscribe-form">
                <div class="search-input-div">
                    <input type="email" id="subscribe-email" placeholder="E-poçt ünvanınız" required>
                </div>

                <button class="btn-red" id="subscribe-btn" type="button">
                    <span>@lang("Join")</span>
                </button>
            </div>

            <span class="warning-text" id="subscribe-message"></span>

        </div>

    </div>

    <div class="overlay"></div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('subscribe-btn');
        const emailInput = document.getElementById('subscribe-email');
        const messageEl = document.getElementById('subscribe-message');

        btn?.addEventListener('click', async function() {
            const email = emailInput?.value.trim();
            if (!email) {
                messageEl.textContent = 'Zəhmət olmasa e-poçt ünvanınızı daxil edin.';
                return;
            }

            btn.disabled = true;
            btn.querySelector('span').textContent = '...';

            try {
                const response = await fetch('{{ route("subscribe") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ email }),
                });

                const data = await response.json();

                if (response.ok) {
                    messageEl.textContent = data.message;
                    messageEl.style.color = 'green';
                    emailInput.value = '';
                } else {
                    messageEl.textContent = data.errors?.email?.[0] || data.message || 'Xəta baş verdi.';
                    messageEl.style.color = 'red';
                }
            } catch (error) {
                messageEl.textContent = 'Xəta baş verdi.';
                messageEl.style.color = 'red';
            } finally {
                btn.disabled = false;
                btn.querySelector('span').textContent = '{{ __("Join") }}';
            }
        });
    });
</script>
@endpush
