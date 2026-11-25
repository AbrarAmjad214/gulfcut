@extends('layouts.site')
@php $g = \App\Support\GulfCut::class; @endphp

@push('head')
    {!! $g::heroPreload($g::photo('Concrete-wire-saw-cutting.jpeg')) !!}
@endpush

@section('content')
<section class="page-hero" {!! $g::heroStyle($g::photo('Concrete-wire-saw-cutting.jpeg')) !!}>
    <div class="wrap">
        @include('partials.crumbs')
        <p class="eyebrow">Services</p>
        <h1>Our Professional Concrete Services</h1>
        <p>Specialist diamond cutting, coring, scanning and demolition across the UAE.</p>
    </div>
</section>

<section class="section">
    <div class="wrap service-grid">
        @foreach ($g::directory() as $item)
            <a class="service-card light" href="{{ url($item['slug']) }}" data-animate>
                <img src="{{ $g::photo($item['image']) }}" {!! $g::attrs($g::photo($item['image'])) !!} alt="{{ $item['title'] }}" loading="lazy" decoding="async">
                <div>
                    <h3>{{ $item['title'] }}</h3>
                    <p>{{ $item['text'] }}</p>
                    <span class="more">View More</span>
                </div>
            </a>
        @endforeach
    </div>
</section>

<section class="section section-paper">
    <div class="wrap quotes-wrap">
        <div>
            <p class="eyebrow">Stories of Trust</p>
            <h2>And Excellence.</h2>
            <blockquote class="quote on">
                <p>“Gulf Cut UAE completed our concrete wall cutting project professionally and on time. Their team was highly skilled, organized, and safety-focused.”</p>
                <cite>Project Manager, Abu Dhabi</cite>
            </blockquote>
            <p>Gulf Cut UAE takes pride in delivering reliable concrete services with precision, safety, and professionalism. Our commitment to quality workmanship, timely project completion, and customer satisfaction has made us a trusted choice for residential, commercial, and industrial projects.</p>
        </div>
        <div class="portrait-row">
            <img src="{{ $g::photo('Concrete-slab-core-cutting.jpeg') }}" {!! $g::attrs($g::photo('Concrete-slab-core-cutting.jpeg')) !!} alt="Concrete slab core cutting" loading="lazy" decoding="async">
            <img src="{{ $g::photo('Concrete-staircase-Demolition.jpeg') }}" {!! $g::attrs($g::photo('Concrete-staircase-Demolition.jpeg')) !!} alt="Concrete staircase demolition" loading="lazy" decoding="async">
            <img src="{{ $g::photo('Concrete-beam-cutting.jpeg') }}" {!! $g::attrs($g::photo('Concrete-beam-cutting.jpeg')) !!} alt="Concrete beam cutting" loading="lazy" decoding="async">
        </div>
    </div>
</section>

@include('partials.lead-band', ['heading' => 'Not sure which service you need?'])
@endsection
