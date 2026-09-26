@extends('layouts.site')
@php $g = \App\Support\GulfCut::class; @endphp

@section('content')
<section class="page-hero" style="--hero:url('{{ $photo }}')">
    <div class="wrap" data-animate>
        <p class="eyebrow">About Us</p>
        <h1>Trusted Concrete Cutting &amp; Demolition Company in UAE</h1>
    </div>
</section>

<section class="section">
    <div class="wrap narrow" data-animate>
        @foreach ($paragraphs as $paragraph)
            <p>{{ $paragraph }}</p>
        @endforeach
    </div>
    <div class="wrap offer-grid">
        @foreach ($offers as $offer)
            <article class="offer" data-animate>
                <img src="{{ $g::img($offer['src']) }}" alt="{{ $offer['title'] }}">
                <h3>{{ $offer['title'] }}</h3>
                <p>{{ $offer['text'] }}</p>
            </article>
        @endforeach
    </div>
</section>

<section class="section section-paper">
    <div class="wrap">
        <div class="section-head" data-animate>
            <p class="eyebrow">Dedicated to Quality</p>
            <h2>Safety, and Trust.</h2>
            <p>Our experienced operators and technical specialists work closely with clients to deliver customized solutions that meet project requirements and timelines.</p>
        </div>
        <div class="team-grid">
            @foreach ([
                ['Concrete-wall-saw-cutting.jpeg', 'Wall Saw Cutting', 'Precise openings in reinforced concrete walls.'],
                ['Concrete-floor-cutting.jpeg', 'Floor Saw Cutting', 'Straight cuts for slabs, roads, and industrial floors.'],
                ['Concrete-wire-saw-cutting.jpeg', 'Wire Saw Cutting', 'Controlled cutting for thick, heavily reinforced structures.'],
            ] as $shot)
                <article data-animate>
                    <img src="{{ asset('images/'.$shot[0]) }}" alt="{{ $shot[1] }}">
                    <h3>{{ $shot[1] }}</h3>
                    <p>{{ $shot[2] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="cta-band">
    <div class="wrap" data-animate>
        <h2>Get Safe, Reliable Concrete Cutting Services Now!</h2>
        <p>Schedule Your Consultation Today.</p>
        <div class="btn-row">
            <a class="btn" href="{{ route('contact') }}">Contact Us</a>
            <a class="btn btn-ghost" href="tel:{{ $g::PHONE_TEL }}">{{ $g::PHONE_DISPLAY }}</a>
        </div>
    </div>
</section>
@endsection
