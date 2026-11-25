@extends('layouts.site', [
    'title' => 'Page Not Found | Gulf Cut',
    'description' => 'This page has moved or no longer exists. Browse Gulf Cut concrete cutting, core drilling and demolition services in the UAE.',
    'noindex' => true,
])
@php $g = \App\Support\GulfCut::class; @endphp

@section('content')
<section class="thanks">
    <div class="wrap">
        <div class="thanks-card">
            <p class="eyebrow">Error 404</p>
            <h1>This page is not here</h1>
            <p class="thanks-lead">The link may be old, or the page has moved. These are the pages most people look for:</p>
            <div class="thanks-actions">
                <a class="btn" href="{{ route('services') }}">All services</a>
                <a class="btn btn-line" href="{{ route('contact') }}">Request a quote</a>
                <a class="btn btn-line" href="{{ route('home') }}">Back to home</a>
            </div>
            <div class="related not-found-links">
                @foreach ($g::menu() as $item)
                    <a href="{{ url($item['slug']) }}">{{ $item['label'] }}</a>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
