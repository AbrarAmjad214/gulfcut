{{--
    Google Business Profile block.
    variant 'full' (default): profile card + embedded map. Use once per page, on Home and Contact.
    variant 'band': one-line strip for inner pages.
--}}
@php
    $g = \App\Support\GulfCut::class;
    $variant = $variant ?? 'full';
    $googleMark = '<svg class="g-mark" viewBox="0 0 48 48" aria-hidden="true"><path fill="#4285F4" d="M45.1 24.5c0-1.6-.1-3.1-.4-4.5H24v8.5h11.8c-.5 2.7-2.1 5-4.4 6.6v5.5h7.1c4.2-3.8 6.6-9.5 6.6-16.1z"/><path fill="#34A853" d="M24 46c5.9 0 10.9-2 14.5-5.3l-7.1-5.5c-2 1.3-4.5 2.1-7.4 2.1-5.7 0-10.6-3.9-12.3-9.1H4.4v5.7C8 41 15.4 46 24 46z"/><path fill="#FBBC05" d="M11.7 28.2c-.4-1.3-.7-2.7-.7-4.2s.3-2.9.7-4.2v-5.7H4.4C2.9 17.1 2 20.4 2 24s.9 6.9 2.4 9.9l7.3-5.7z"/><path fill="#EA4335" d="M24 10.7c3.2 0 6.1 1.1 8.4 3.3l6.3-6.3C34.9 4.2 29.9 2 24 2 15.4 2 8 7 4.4 14.1l7.3 5.7c1.7-5.2 6.6-9.1 12.3-9.1z"/></svg>';
@endphp

@if ($variant === 'band')
    <section class="gbp-band">
        <div class="wrap gbp-band-row">
            {!! $googleMark !!}
            <p>
                <strong>{{ $g::GBP_NAME }}</strong>
                <span>Our Google Business Profile: photos, reviews and service area.</span>
            </p>
            <a class="btn btn-line" href="{{ $g::GBP_URL }}" target="_blank" rel="noopener" data-track="google-profile">View on Google</a>
        </div>
    </section>
@else
    <section class="section gbp {{ $tone ?? '' }}" id="google-profile">
        <div class="wrap gbp-grid">
            <div class="gbp-card" data-animate>
                <div class="gbp-head">
                    {!! $googleMark !!}
                    <div>
                        <p class="eyebrow">Google Business Profile</p>
                        <h2>{{ $heading ?? 'Find Gulf Cut on Google' }}</h2>
                    </div>
                </div>
                <p>{{ $lead ?? 'See our listing on Google Maps for site photos, customer reviews and the areas we cover. If Gulf Cut has worked on your site, a short review on Google helps other contractors find us.' }}</p>
                <dl class="gbp-facts">
                    <div><dt>Listed as</dt><dd>{{ $g::GBP_NAME }}</dd></div>
                    <div><dt>Phone</dt><dd><a href="tel:{{ $g::PHONE_TEL }}" data-track="call">{{ $g::PHONE_DISPLAY }}</a></dd></div>
                    <div><dt>Service area</dt><dd>{{ implode(', ', $g::cities()) }}</dd></div>
                </dl>
                <div class="btn-row">
                    <a class="btn" href="{{ $g::GBP_URL }}" target="_blank" rel="noopener" data-track="google-profile">View on Google Maps</a>
                    <a class="btn btn-line" href="{{ $g::GBP_URL }}" target="_blank" rel="noopener" data-track="google-review">Read &amp; write reviews</a>
                </div>
            </div>
            <div class="gbp-map" data-animate="right">
                <iframe src="{{ $g::mapEmbed() }}" title="{{ $g::GBP_NAME }} on Google Maps" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
            </div>
        </div>
    </section>
@endif
