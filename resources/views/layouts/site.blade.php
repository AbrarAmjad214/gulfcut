<!DOCTYPE html>
<html lang="en-AE">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>document.documentElement.classList.add('js')</script>
    @php
        $g = \App\Support\GulfCut::class;
        $site = config('services.site', []);
        $seoTitle = $title ?? 'Gulf Cut UAE';
        $seoDescription = $description ?? $g::description('home');
        $canonical = $g::canonical();
        $shareFile = $ogImage ?? $g::OG_IMAGE;
        $shareImage = $g::absoluteImage($shareFile);
        $shareSize = $g::imageSize($shareFile);
    @endphp
    <title>{{ $seoTitle }}</title>
    <meta name="description" content="{{ $seoDescription }}">
    @if (!empty($noindex))
        <meta name="robots" content="noindex, follow">
    @else
        <meta name="robots" content="index, follow, max-image-preview:large">
        <link rel="canonical" href="{{ $canonical }}">
    @endif
    @if (!empty($site['search_console']))
        <meta name="google-site-verification" content="{{ $site['search_console'] }}">
    @endif
    @if (!empty($site['bing']))
        <meta name="msvalidate.01" content="{{ $site['bing'] }}">
    @endif
    <meta property="og:type" content="{{ $ogType ?? 'website' }}">
    <meta property="og:locale" content="en_AE">
    <meta property="og:site_name" content="Gulf Cut UAE">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    @empty($noindex)
        <meta property="og:url" content="{{ $canonical }}">
    @endempty
    <meta property="og:image" content="{{ $shareImage }}">
    @if ($shareSize)
        <meta property="og:image:width" content="{{ $shareSize[0] }}">
        <meta property="og:image:height" content="{{ $shareSize[1] }}">
    @endif
    <meta property="og:image:alt" content="{{ $seoTitle }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $shareImage }}">
    @if (!empty($site['twitter']))
        <meta name="twitter:site" content="{{ '@'.ltrim($site['twitter'], '@') }}">
    @endif
    @isset($published)
        <meta property="article:published_time" content="{{ $published }}">
    @endisset
    @isset($modified)
        <meta property="article:modified_time" content="{{ $modified }}">
    @endisset
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="48x48">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/icon-192.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">
    <meta name="theme-color" content="#082848">
    @if (request()->route()?->getName() === 'home')
        <script type="application/ld+json">{!! $g::schema() !!}</script>
    @endif
    @if (count($g::breadcrumbs()) > 1)
        <script type="application/ld+json">{!! $g::breadcrumbSchema() !!}</script>
    @endif
    @if (!empty($schema))
        <script type="application/ld+json">{!! $schema !!}</script>
    @endif
    @stack('head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@600;700&family=Inter:wght@400;600;700&display=swap" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@600;700&family=Inter:wght@400;600;700&display=swap"></noscript>
    <link rel="stylesheet" href="{{ asset('css/site.css') }}?v=24">
    @if (!empty($site['gtm']))
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer',@json($site['gtm']));</script>
    @elseif (!empty($site['ga4']))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $site['ga4'] }}"></script>
        <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config',@json($site['ga4']));</script>
    @endif
</head>
<body>
    @if (!empty($site['gtm']))
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $site['gtm'] }}" height="0" width="0" style="display:none;visibility:hidden" title="Google Tag Manager"></iframe></noscript>
    @endif
    <a class="skip-link" href="#main">Skip to content</a>
    @include('partials.header')
    <main id="main">
        @yield('content')
    </main>
    @include('partials.footer')
    <a class="float-wa" href="{{ $g::WHATSAPP }}" target="_blank" rel="noopener" aria-label="WhatsApp Gulf Cut" data-track="whatsapp">WA</a>
    <a class="float-call" href="tel:{{ $g::PHONE_TEL }}" aria-label="Call Gulf Cut" data-track="call">Call</a>
    <script src="{{ asset('js/site.js') }}?v=4" defer></script>
</body>
</html>
