@extends('layouts.site')
@php $g = \App\Support\GulfCut::class; @endphp

@section('content')
<section class="page-hero blog-hero" style="--hero:url('{{ $g::photo($project['image']) }}')">
    <div class="wrap" data-animate>
        @include('partials.crumbs')
        <p class="eyebrow">{{ $project['location'] }}</p>
        <h1>{{ $project['h1'] }}</h1>
    </div>
</section>

<section class="section">
    <div class="wrap blog-layout">
        <article class="blog-prose">
            <div class="project-facts">
                <div><strong>Location</strong><span>{{ $project['location'] }}</span></div>
                <div><strong>Scope</strong><span>{{ $project['scope'] }}</span></div>
                <div><strong>Method</strong><span>{{ $project['service_label'] }}</span></div>
            </div>
            @foreach ($project['sections'] as $section)
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
            @endforeach
            <img src="{{ $g::photo($project['extra_image']) }}" alt="{{ $project['extra_alt'] }}" loading="lazy" decoding="async">
        </article>
        <aside class="blog-side">
            <div class="icon-card">
                <p class="eyebrow">Same kind of job</p>
                <h3>{{ $project['service_label'] }}</h3>
                <p>Send the drawing, the thickness and the site. Gulf Cut will say how the cut should be done.</p>
                <a class="btn" href="{{ url($project['service']) }}">View service</a>
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
            <p class="eyebrow">More work</p>
            <h2>Other Gulf Cut projects</h2>
        </div>
        <div class="blog-grid">
            @foreach ($related as $item)
                <a class="blog-card" href="{{ url('projects/'.$item['slug']) }}">
                    <img src="{{ $g::photo($item['image']) }}" alt="{{ $item['image_alt'] }}" loading="lazy" decoding="async">
                    <div>
                        <p class="blog-meta">{{ $item['location'] }}</p>
                        <h3>{{ $item['h1'] }}</h3>
                        <span class="more">View project</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@include('partials.lead-band', [
    'heading' => 'Get a quote for this kind of work',
    'preset' => $project['service_label'],
    'source' => url()->current(),
])
@endsection
