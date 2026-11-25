@extends('layouts.site')
@php $g = \App\Support\GulfCut::class; @endphp

@push('head')
    {!! $g::heroPreload($g::photo('Concrete-beam-cutting.jpeg')) !!}
@endpush

@section('content')
<section class="page-hero blog-hero" {!! $g::heroStyle($g::photo('Concrete-beam-cutting.jpeg')) !!}>
    <div class="wrap">
        @include('partials.crumbs')
        <p class="eyebrow">Projects</p>
        <h1>Concrete Cutting Projects</h1>
        <p>Wall saws, floor saws, core drilling, wire sawing and staircase removal on sites in Dubai and the UAE.</p>
    </div>
</section>

<section class="section section-paper">
    <div class="wrap">
        <div class="blog-grid">
            @foreach ($projects as $project)
                <a class="blog-card" href="{{ url('projects/'.$project['slug']) }}">
                    <img src="{{ $g::photo($project['image']) }}" {!! $g::attrs($g::photo($project['image'])) !!} alt="{{ $project['image_alt'] }}" loading="lazy" decoding="async">
                    <div>
                        <p class="blog-meta">{{ $project['location'] }}</p>
                        <h3>{{ $project['h1'] }}</h3>
                        <p>{{ $project['excerpt'] }}</p>
                        <span class="more">View project</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

@include('partials.google-profile', ['variant' => 'band'])

@include('partials.lead-band', ['heading' => 'Have a similar job?'])
@endsection
