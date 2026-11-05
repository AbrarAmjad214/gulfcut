<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $g = \App\Support\GulfCut::class;
        $seoTitle = $title ?? 'Gulf Cut UAE';
        $seoDescription = $description ?? $g::description('home');
        $canonical = $g::canonical();
        $shareImage = $g::absoluteImage($ogImage ?? 'Concrete-wall-saw-cutting.jpeg');
    @endphp
    <title>{{ $seoTitle }}</title>
    <meta name="description" content="{{ $seoDescription }}">
    @if (!empty($noindex))
        <meta name="robots" content="noindex, follow">
    @endif
    <link rel="canonical" href="{{ $canonical }}">
    <meta property="og:type" content="{{ $ogType ?? 'website' }}">
    <meta property="og:site_name" content="Gulf Cut UAE">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:image" content="{{ $shareImage }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $shareImage }}">
    @isset($published)
        <meta property="article:published_time" content="{{ $published }}">
    @endisset
    <link rel="icon" href="{{ $g::logo() }}">
    <script type="application/ld+json">{!! $g::schema() !!}</script>
    @if (count($g::breadcrumbs()) > 1)
        <script type="application/ld+json">{!! $g::breadcrumbSchema() !!}</script>
    @endif
    @if (!empty($schema))
        <script type="application/ld+json">{!! $schema !!}</script>
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@600;700&family=Inter:wght@400;600&display=swap" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@600;700&family=Inter:wght@400;600&display=swap"></noscript>
    <link rel="stylesheet" href="{{ asset('css/site.css') }}?v=18">
    @stack('head')
</head>
<body>
    @include('partials.header')
    <main>
        @yield('content')
    </main>
    @include('partials.footer')
    <a class="float-wa" href="https://wa.me/971505962816" target="_blank" rel="noopener" aria-label="WhatsApp Gulf Cut">WA</a>
    <a class="float-call" href="tel:+{{ ltrim(\App\Support\GulfCut::PHONE_TEL, '+') }}" aria-label="Call Gulf Cut">Call</a>
    <script src="{{ asset('js/site.js') }}?v=3" defer></script>
</body>
</html>
