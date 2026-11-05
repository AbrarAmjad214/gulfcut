@extends('layouts.site')
@php $g = \App\Support\GulfCut::class; @endphp

@section('content')
<section class="page-hero blog-hero" style="--hero:url('{{ $g::photo($post['image']) }}')">
    <div class="wrap" data-animate>
        @include('partials.crumbs')
        <p class="eyebrow">{{ $post['category'] }}</p>
        <h1>{{ $post['h1'] }}</h1>
        <p>{{ \Illuminate\Support\Carbon::parse($post['date'])->format('j F Y') }} · Gulf Cut UAE</p>
    </div>
</section>

<section class="section">
    <div class="wrap blog-layout">
        <article class="blog-prose">
            @foreach ($post['sections'] as $section)
                <h2>{{ $section['h2'] }}</h2>
                @foreach ($section['paragraphs'] as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
                @if (!empty($section['list']))
                    <ul class="ticks">
                        @foreach ($section['list'] as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                @endif
                @if (!empty($section['figure']))
                    <img src="{{ $g::photo($section['figure']['image']) }}" alt="{{ $section['figure']['alt'] }}" loading="lazy" decoding="async">
                @endif
                @if (!empty($section['links']))
                    <p class="related">
                        @foreach ($section['links'] as $link)
                            <a href="{{ url($link['slug']) }}">{{ $link['label'] }}</a>
                        @endforeach
                    </p>
                @endif
            @endforeach

            @if (!empty($post['faqs']))
                <h2>Questions we get on site</h2>
                <div class="faq-list">
                    @foreach ($post['faqs'] as $faq)
                        <details>
                            <summary>{{ $faq['q'] }}</summary>
                            <p>{{ $faq['a'] }}</p>
                        </details>
                    @endforeach
                </div>
            @endif
        </article>
        <aside class="blog-side">
            <div class="icon-card">
                <p class="eyebrow">Book this work</p>
                <h3>{{ $post['service_label'] }}</h3>
                <p>Gulf Cut cuts, drills and removes concrete across the UAE from Al Quoz, Dubai.</p>
                <a class="btn" href="{{ url($post['service']) }}">View service</a>
                <a class="btn btn-line" href="{{ route('contact') }}">Request a quote</a>
                <p><a href="tel:{{ $g::PHONE_TEL }}">{{ $g::PHONE_DISPLAY }}</a></p>
            </div>
        </aside>
    </div>
</section>

@if (count($related))
<section class="section section-paper">
    <div class="wrap">
        <div class="section-head">
            <p class="eyebrow">Keep reading</p>
            <h2>More concrete guides</h2>
        </div>
        <div class="blog-grid">
            @foreach ($related as $item)
                <a class="blog-card" href="{{ url('blog/'.$item['slug']) }}">
                    <img src="{{ $g::photo($item['image']) }}" alt="{{ $item['image_alt'] }}" loading="lazy" decoding="async">
                    <div>
                        <p class="blog-meta">{{ $item['category'] }}</p>
                        <h3>{{ $item['h1'] }}</h3>
                        <span class="more">Read guide</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@include('partials.lead-band', [
    'heading' => 'Get a quote for this work',
    'preset' => $post['h1'],
    'source' => url()->current(),
])
@endsection
