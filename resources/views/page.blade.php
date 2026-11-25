@extends('layouts.site')
@php
    $g = \App\Support\GulfCut::class;
    $title = $page['title'];
@endphp

@push('head')
    {!! $g::heroPreload($page['hero']['image']) !!}
@endpush

@section('content')
<section class="page-hero" {!! $g::heroStyle($page['hero']['image']) !!}>
    <div class="wrap hero-copy">
        @include('partials.crumbs')
        <p class="eyebrow">{{ $page['hero']['kicker'] }}</p>
        <h1>{{ $page['hero']['heading'] }}</h1>
        @if ($page['hero']['lead'])
            <p>{!! $g::link($page['hero']['lead']) !!}</p>
        @endif
        <div class="btn-row">
            <a class="btn" href="{{ route('contact') }}">Get Free Quote</a>
            <a class="btn btn-ghost" href="tel:{{ $g::PHONE_TEL }}">Call {{ $g::PHONE_DISPLAY }}</a>
        </div>
    </div>
</section>

@if ($page['hero']['paragraphs'])
<section class="section">
    <div class="wrap narrow">
        @foreach ($page['hero']['paragraphs'] as $paragraph)
            <p data-animate>{!! $g::link($paragraph) !!}</p>
        @endforeach
    </div>
</section>
@endif

@foreach ($page['sections'] as $section)
    @if ($section['kind'] === 'cta')
        @include('partials.closing', [
            'heading' => $section['title'],
            'lead' => $section['notes'][0] ?? 'Schedule a visit and Gulf Cut will quote the cut.',
        ])
    @elseif ($section['kind'] === 'related')
        <section class="section section-paper">
            <div class="wrap">
                <h2 data-animate>{{ $section['title'] ?: 'More Services' }}</h2>
                <div class="related">
                    @foreach ($section['items'] as $item)
                        <a href="{{ $item['href'] ?? route('services') }}">{{ $item['title'] }}</a>
                    @endforeach
                </div>
            </div>
        </section>
    @elseif ($section['kind'] === 'cities')
        <section class="section">
            <div class="wrap">
                <h2 data-animate>{{ $section['title'] }}</h2>
                @foreach ($section['notes'] as $note)
                    <p>{!! $g::link($note) !!}</p>
                @endforeach
                <div class="city-grid">
                    @foreach ($section['items'] as $item)
                        <div data-animate>{{ $item['title'] }}</div>
                    @endforeach
                </div>
                @foreach ($section['after'] ?? [] as $note)
                    <p class="center">{!! $g::link($note) !!}</p>
                @endforeach
            </div>
        </section>
    @else
        <section class="section {{ $loop->even ? 'section-paper' : '' }}">
            <div class="wrap {{ $section['images'] ? 'split' : '' }}">
                <div>
                    @if ($section['title'])
                        <h2 data-animate>{{ $section['title'] }}</h2>
                    @endif
                    @foreach ($section['notes'] as $note)
                        <p data-animate>{!! $g::link($note) !!}</p>
                    @endforeach
                    @if ($section['kind'] === 'cards')
                        <div class="icon-grid">
                            @foreach ($section['items'] as $item)
                                <article class="icon-card" data-animate>
                                    @if ($item['image'])
                                        <img src="{{ $item['image'] }}" {!! $g::attrs($item['image']) !!} alt="{{ $item['title'] }}" loading="lazy" decoding="async">
                                    @endif
                                    <h3>{!! $g::link($item['title']) !!}</h3>
                                    @if ($item['text'])<p>{{ $item['text'] }}</p>@endif
                                </article>
                            @endforeach
                        </div>
                    @elseif ($section['kind'] === 'steps')
                        <ol class="steps">
                            @foreach ($section['items'] as $item)
                                <li data-animate>
                                    <span>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                    <h3>{{ $item['title'] }}</h3>
                                </li>
                            @endforeach
                        </ol>
                    @elseif ($section['kind'] === 'checks')
                        <ul class="ticks">
                            @foreach ($section['items'] as $item)
                                <li>{{ $item['title'] }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                @if ($section['images'])
                    <figure data-animate="right">
                        <img class="rounded" src="{{ $section['images'][0] }}" {!! $g::attrs($section['images'][0]) !!} alt="{{ $section['title'] ?: 'Gulf Cut concrete cutting' }}" loading="lazy" decoding="async">
                    </figure>
                @endif
            </div>
        </section>
    @endif
@endforeach

@include('partials.related-links', ['slug' => $page['slug']])

@include('partials.google-profile', ['variant' => 'band'])

@include('partials.lead-band', [
    'heading' => 'Get a quote for this job',
    'preset' => $preset,
    'source' => url()->current(),
])
@endsection
