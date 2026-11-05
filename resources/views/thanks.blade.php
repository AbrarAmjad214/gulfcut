@extends('layouts.site')
@php $g = \App\Support\GulfCut::class; @endphp

@section('content')
<section class="thanks">
    <div class="wrap">
        <div class="thanks-card">
            <div class="thanks-mark" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="34" height="34"><path fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" d="M5 12.5 9.2 16.7 19 7.5"/></svg>
            </div>
            <p class="eyebrow">Request received</p>
            <h1>Thank you{{ $name ? ', '.$name : '' }}.</h1>
            <p class="thanks-lead">Gulf Cut has your project details. We will call you shortly with a quotation.</p>
            <div class="thanks-actions">
                <a class="btn" href="tel:{{ $g::PHONE_TEL }}">Call {{ $g::PHONE_DISPLAY }}</a>
                <a class="btn btn-line" href="https://wa.me/971505962816" target="_blank" rel="noopener">WhatsApp</a>
                <a class="btn btn-line" href="{{ route('home') }}">Back to home</a>
            </div>
            <div class="thanks-next">
                <div>
                    <strong>01</strong>
                    <h2>We review the job</h2>
                    <p>Opening size, thickness and site access.</p>
                </div>
                <div>
                    <strong>02</strong>
                    <h2>We call you back</h2>
                    <p>Same-day reply on working days.</p>
                </div>
                <div>
                    <strong>03</strong>
                    <h2>Site visit if needed</h2>
                    <p>Dubai and the rest of the UAE.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
