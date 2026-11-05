@php $g = \App\Support\GulfCut::class; @endphp
<section class="section quote-section" id="quote">
    <div class="wrap">
        <div class="quote-panel">
            <div class="quote-copy">
                <p class="eyebrow">Free quote</p>
                <h2>{{ $heading ?? 'Tell us about the job' }}</h2>
                <p>{{ $lead ?? 'Share the site, the opening and a phone number. Gulf Cut will call you back with a quotation.' }}</p>
                <div class="quote-contacts">
                    <a href="tel:{{ $g::PHONE_TEL }}">
                        <strong>Call</strong>
                        {{ $g::PHONE_DISPLAY }}
                    </a>
                    <a href="https://wa.me/971505962816" target="_blank" rel="noopener">
                        <strong>WhatsApp</strong>
                        {{ $g::PHONE_DISPLAY }}
                    </a>
                    <a href="mailto:{{ $g::EMAIL }}">
                        <strong>Email</strong>
                        {{ $g::EMAIL }}
                    </a>
                    <span>
                        <strong>Visit</strong>
                        {{ $g::ADDRESS }}
                    </span>
                </div>
            </div>
            @include('partials.quote-form')
        </div>
    </div>
</section>
