@extends('layouts.site')
@php $g = \App\Support\GulfCut::class; @endphp

@section('content')
<section class="page-hero" style="--hero:url('{{ asset('images/Concrete-wire-saw-cutting.jpeg') }}')">
    <div class="wrap" data-animate>
        <p class="eyebrow">Contact</p>
        <h1>Contact Gulf Cut</h1>
        <p>Reach Us</p>
    </div>
</section>

<section class="section">
    <div class="wrap split">
        <div data-animate>
            <h2>Reach Us</h2>
            <p>Looking for reliable concrete cutting, demolition, or core drilling services in the UAE? Contact Gulf Cut UAE today for professional support, fast site inspection, and competitive quotations.</p>
            <ul class="reach">
                <li><strong>Visit Us</strong> {{ $g::ADDRESS }}</li>
                <li><strong>Call Us</strong> <a href="tel:{{ $g::PHONE_TEL }}">{{ $g::PHONE_DISPLAY }}</a></li>
                <li><strong>Message Us</strong> <a href="mailto:{{ $g::EMAIL }}">{{ $g::EMAIL }}</a></li>
            </ul>
            <img class="rounded contact-photo" src="{{ asset('images/Concrete-floor-cutting.jpeg') }}" alt="Concrete floor saw cutting">
        </div>
        <div data-animate>
            @include('partials.quote-form')
        </div>
    </div>
</section>

<section class="cta-band">
    <div class="wrap" data-animate>
        <h2>Get Safe, Reliable Concrete Cutting Services Now!</h2>
        <p>Schedule Your Consultation Today.</p>
        <a class="btn" href="tel:{{ $g::PHONE_TEL }}">{{ $g::PHONE_DISPLAY }}</a>
    </div>
</section>
@endsection
