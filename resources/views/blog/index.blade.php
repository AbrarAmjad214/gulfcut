@extends('layouts.site')
@php $g = \App\Support\GulfCut::class; @endphp

@section('content')
<section class="page-hero blog-hero" style="--hero:url('{{ $g::photo('Concrete-wall-saw-cutting.jpeg') }}')">
    <div class="wrap" data-animate>
        @include('partials.crumbs')
        <p class="eyebrow">Blog</p>
        <h1>Concrete Cutting Guides</h1>
        <p>Practical notes on diamond cutting, core drilling, scanning and demolition for sites in Dubai and the UAE.</p>
    </div>
</section>

<section class="section section-paper">
    <div class="wrap">
        <div class="blog-grid">
            @foreach ($posts as $post)
                <a class="blog-card" href="{{ url('blog/'.$post['slug']) }}">
                    <img src="{{ $g::photo($post['image']) }}" alt="{{ $post['image_alt'] }}" loading="lazy" decoding="async">
                    <div>
                        <p class="blog-meta">{{ $post['category'] }} · {{ \Illuminate\Support\Carbon::parse($post['date'])->format('j M Y') }}</p>
                        <h3>{{ $post['h1'] }}</h3>
                        <p>{{ $post['excerpt'] }}</p>
                        <span class="more">Read guide</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

@include('partials.lead-band', ['heading' => 'Need this on your site?'])
@endsection
