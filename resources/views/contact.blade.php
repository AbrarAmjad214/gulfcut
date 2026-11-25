@extends('layouts.site')
@php $g = \App\Support\GulfCut::class; @endphp

@push('head')
    {!! $g::heroPreload($g::photo('Concrete-floor-cutting.jpeg')) !!}
@endpush

@section('content')
<section class="page-hero" {!! $g::heroStyle($g::photo('Concrete-floor-cutting.jpeg')) !!}>
    <div class="wrap">
        @include('partials.crumbs')
        <p class="eyebrow">Contact</p>
        <h1>Contact Gulf Cut for Concrete Cutting in the UAE</h1>
        <p>Call, WhatsApp or send the form. The crew works from Al Quoz, Dubai, and covers every emirate.</p>
        <div class="btn-row">
            <a class="btn" href="tel:{{ $g::PHONE_TEL }}" data-track="call">Call {{ $g::PHONE_DISPLAY }}</a>
            <a class="btn btn-ghost" href="{{ $g::WHATSAPP }}" target="_blank" rel="noopener" data-track="whatsapp">WhatsApp us</a>
        </div>
    </div>
</section>

@include('partials.lead-band', [
    'heading' => 'Request a quotation',
    'lead' => 'Send the site, the opening and a phone number. Gulf Cut will arrange a visit and send a quotation.',
])

<section class="section">
    <div class="wrap split">
        <div>
            <p class="eyebrow">Before you call</p>
            <h2>What to send for a fast quote</h2>
            <p>A concrete cutting price depends on the thickness, the reinforcement and how the cut piece leaves the building. These details let us quote without guessing:</p>
            <ul class="ticks">
                <li>Opening size or core diameter</li>
                <li>Wall, slab or beam thickness</li>
                <li>Drawing or a photo with the cut marked</li>
                <li>Floor level and site access</li>
                <li>Whether the area stays in use</li>
                <li>Whether scanning is needed first</li>
            </ul>
            <p>Not sure which method fits? Read <a href="{{ url('blog/wall-saw-vs-floor-saw-uae') }}">wall saw or floor saw</a>, or see <a href="{{ route('services') }}">all services</a>.</p>
        </div>
        <div class="office-card">
            <p class="eyebrow">Office</p>
            <h3>Gulf Cut UAE</h3>
            <dl class="gbp-facts">
                <div><dt>Address</dt><dd>{{ $g::ADDRESS }}</dd></div>
                <div><dt>Phone</dt><dd><a href="tel:{{ $g::PHONE_TEL }}" data-track="call">{{ $g::PHONE_DISPLAY }}</a></dd></div>
                <div><dt>WhatsApp</dt><dd><a href="{{ $g::WHATSAPP }}" target="_blank" rel="noopener" data-track="whatsapp">Message the crew</a></dd></div>
                <div><dt>Email</dt><dd><a href="mailto:{{ $g::EMAIL }}" data-track="email">{{ $g::EMAIL }}</a></dd></div>
                <div><dt>Google</dt><dd><a href="{{ $g::GBP_URL }}" target="_blank" rel="noopener" data-track="google-profile">{{ $g::GBP_NAME }}</a></dd></div>
            </dl>
        </div>
    </div>
</section>

@include('partials.google-profile', [
    'heading' => 'Gulf Cut on Google Maps',
    'tone' => 'section-paper',
])

<section class="section">
    <div class="wrap">
        <div class="section-head">
            <p class="eyebrow">Coverage</p>
            <h2>Where the crew works</h2>
            <p>Gulf Cut takes concrete cutting, core drilling, scanning and demolition jobs across the UAE.</p>
        </div>
        <div class="city-grid">
            @foreach ($g::cities() as $city)
                <div>{{ $city }}</div>
            @endforeach
        </div>
    </div>
</section>

@include('partials.closing', [
    'heading' => 'Get safe, reliable concrete cutting now',
    'lead' => 'Schedule a consultation today. Gulf Cut visits the site and sends a quotation.',
])
@endsection
