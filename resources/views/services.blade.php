@extends('layouts.site')
@php $g = \App\Support\GulfCut::class; @endphp

@section('content')
<section class="page-hero" style="--hero:url('{{ asset('images/Concrete-wire-saw-cutting.jpeg') }}')">
    <div class="wrap" data-animate>
        <p class="eyebrow">Services</p>
        <h1>Our Professional Concrete Services</h1>
        <p>Specialist diamond cutting, coring, scanning and demolition across the UAE.</p>
    </div>
</section>

<section class="section">
    <div class="wrap service-grid">
        @foreach ($g::directory() as $item)
            <a class="service-card light" href="{{ url($item['slug']) }}" data-animate>
                <img src="{{ asset('images/'.$item['image']) }}" alt="{{ $item['title'] }}">
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
                <p>“We hired Gulf Cut UAE for slab demolition and core drilling services. Excellent workmanship, fast response, and very competitive pricing.”</p>
                <cite>Construction Contractor, Dubai</cite>
            </blockquote>
            <p>Gulf Cut UAE takes pride in delivering reliable concrete services with precision, safety, and professionalism. Our commitment to quality workmanship, timely project completion, and customer satisfaction has made us a trusted choice for residential, commercial, and industrial projects.</p>
        </div>
        <div class="portrait-row">
            <img src="{{ asset('images/Concrete-slab-core-cutting.jpeg') }}" alt="Concrete slab core cutting">
            <img src="{{ asset('images/Concrete-staircase-Demolition.jpeg') }}" alt="Concrete staircase demolition">
            <img src="{{ asset('images/Concrete-beam-cutting.jpeg') }}" alt="Concrete beam cutting">
        </div>
    </div>
</section>
@endsection
