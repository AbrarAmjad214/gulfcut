@php $g = \App\Support\GulfCut::class; @endphp
<section class="closing">
    <div class="wrap closing-grid">
        <div>
            <p class="eyebrow">Schedule a visit</p>
            <h2>{{ $heading ?? 'Get safe, reliable concrete cutting now' }}</h2>
            <p>{{ $lead ?? 'Share the site and the opening. Gulf Cut will call you back with a time and a quotation.' }}</p>
        </div>
        <div class="closing-actions">
            <a class="closing-link" href="tel:{{ $g::PHONE_TEL }}">
                <strong>Call</strong>
                <span>{{ $g::PHONE_DISPLAY }}</span>
            </a>
            <a class="closing-link" href="https://wa.me/971505962816" target="_blank" rel="noopener">
                <strong>WhatsApp</strong>
                <span>Message the crew</span>
            </a>
            <a class="closing-link" href="mailto:{{ $g::EMAIL }}">
                <strong>Email</strong>
                <span>{{ $g::EMAIL }}</span>
            </a>
        </div>
    </div>
</section>
