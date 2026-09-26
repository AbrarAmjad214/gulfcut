@extends('layouts.site')
@php
    $g = \App\Support\GulfCut::class;
    $title = $page['title'];
@endphp

@section('content')
<section class="page-hero" style="--hero:url('{{ $page['hero']['image'] }}')">
    <div class="wrap hero-copy" data-animate>
        <p class="eyebrow">{{ $page['hero']['kicker'] }}</p>
        <h1>{{ $page['hero']['heading'] }}</h1>
        @if ($page['hero']['lead'])
            <p>{{ $page['hero']['lead'] }}</p>
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
            <p data-animate>{{ $paragraph }}</p>
        @endforeach
    </div>
</section>
@endif

@foreach ($page['sections'] as $section)
    @if ($section['kind'] === 'promo')
        <section class="promo">
            <div class="wrap" data-animate>
                <h2>{{ $section['title'] }}</h2>
                <a class="btn" href="{{ route('contact') }}">Claim Now!</a>
            </div>
        </section>
    @elseif ($section['kind'] === 'cta')
        <section class="cta-band">
            <div class="wrap" data-animate>
                <h2>{{ $section['title'] }}</h2>
                @foreach ($section['notes'] as $note)
                    <p>{{ $note }}</p>
                @endforeach
                <a class="btn" href="{{ route('contact') }}">Set Your Schedule</a>
            </div>
        </section>
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
                    <p>{{ $note }}</p>
                @endforeach
                <div class="city-grid">
                    @foreach ($section['items'] as $item)
                        <div data-animate>{{ $item['title'] }}</div>
                    @endforeach
                </div>
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
                        <p data-animate>{{ $note }}</p>
                    @endforeach
                    @if ($section['kind'] === 'cards')
                        <div class="icon-grid">
                            @foreach ($section['items'] as $item)
                                <article class="icon-card" data-animate>
                                    @if ($item['image'])
                                        <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}">
                                    @endif
                                    <h3>{{ $item['title'] }}</h3>
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
                        <img class="rounded" src="{{ $section['images'][0] }}" alt="{{ $section['title'] ?: 'Gulf Cut concrete cutting' }}">
                    </figure>
                @endif
            </div>
        </section>
    @endif
@endforeach
@endsection
