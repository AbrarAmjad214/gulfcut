@php $g = \App\Support\GulfCut::class; @endphp
<div class="topbar">
    <div class="wrap topbar-row">
        <span>{{ $g::ADDRESS }}</span>
        <span class="topbar-links">
            <a href="tel:{{ $g::PHONE_TEL }}">{{ $g::PHONE_DISPLAY }}</a>
            <a href="mailto:{{ $g::EMAIL }}">{{ $g::EMAIL }}</a>
        </span>
    </div>
</div>
<header class="site-header" id="site-header">
    <div class="wrap nav-row">
        <a class="brand" href="{{ route('home') }}">
            <img src="{{ $g::logo() }}" alt="gulfcut-logo">
        </a>
        <button class="burger" type="button" aria-label="Open menu" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>
        <nav class="main-nav" id="main-nav">
            <a href="{{ route('home') }}" @class(['active' => request()->routeIs('home')])>Home</a>
            <a href="{{ route('about') }}" @class(['active' => request()->routeIs('about')])>About us</a>
            <div class="drop">
                <a href="{{ route('services') }}" @class(['active' => request()->routeIs('services') || request()->routeIs('page')])>Our Services</a>
                <div class="drop-panel">
                    @foreach ($g::menu() as $item)
                        <a href="{{ url($item['slug']) }}">{{ $item['label'] }}</a>
                    @endforeach
                </div>
            </div>
            <a href="{{ route('contact') }}" @class(['active' => request()->routeIs('contact')])>Contact Us</a>
            <a class="btn btn-nav" href="{{ route('contact') }}">Contact Us!</a>
        </nav>
    </div>
</header>
