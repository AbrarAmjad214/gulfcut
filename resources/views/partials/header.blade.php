@php $g = \App\Support\GulfCut::class; @endphp
<div class="topbar">
    <div class="wrap topbar-row">
        <span>{{ $g::ADDRESS }}</span>
        <span class="topbar-links">
            <a href="tel:{{ $g::PHONE_TEL }}">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M6.6 10.8a15 15 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1-.25 11.5 11.5 0 0 0 3.6.58 1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 7a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1 11.5 11.5 0 0 0 .58 3.6 1 1 0 0 1-.26 1L6.6 10.8z"/></svg>
                {{ $g::PHONE_DISPLAY }}
            </a>
            <a href="mailto:{{ $g::EMAIL }}">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M4.5 5h15A1.5 1.5 0 0 1 21 6.5v11a1.5 1.5 0 0 1-1.5 1.5h-15A1.5 1.5 0 0 1 3 17.5v-11A1.5 1.5 0 0 1 4.5 5zm.4 1.6 6.7 4.5a.7.7 0 0 0 .8 0l6.7-4.5H4.9zM19.5 8.2l-6.4 4.3a2.2 2.2 0 0 1-2.4 0L4.5 8.2v9.3h15V8.2z"/></svg>
                {{ $g::EMAIL }}
            </a>
        </span>
    </div>
</div>
<header class="site-header" id="site-header">
    <div class="wrap nav-row">
        <a class="brand" href="{{ route('home') }}">
            <img src="{{ $g::logo() }}" alt="Gulf Cut">
        </a>
        <button class="burger" type="button" aria-label="Open menu" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>
        <nav class="main-nav" id="main-nav">
            <a href="{{ route('home') }}" @class(['active' => request()->routeIs('home')])>Home</a>
            <a href="{{ route('about') }}" @class(['active' => request()->routeIs('about')])>About us</a>
            <div class="drop">
                <a href="{{ route('services') }}" @class(['active' => request()->routeIs('services') || request()->routeIs('page')])>Our Services <span class="caret" aria-hidden="true"></span></a>
                <button class="drop-toggle" type="button" aria-expanded="false" aria-label="Show services"></button>
                <div class="mega">
                    <div class="wrap mega-grid">
                        @foreach ($g::megaMenu() as $column)
                            <div>
                                @foreach ($column['sections'] as $group)
                                    <p class="mega-kicker">{{ $group['title'] }}</p>
                                    @foreach ($group['items'] as $item)
                                        <a href="{{ url($item['slug']) }}">{{ $item['label'] }}</a>
                                    @endforeach
                                @endforeach
                            </div>
                        @endforeach
                        <a class="mega-card" href="{{ route('services') }}">
                            <img src="{{ $g::photo('Concrete-wall-saw-cutting.jpeg') }}" alt="Wall saw cutting a concrete wall" loading="lazy" decoding="async">
                            <span>
                                <strong>All services</strong>
                                <em>Cutting, core drilling, scanning and demolition across the UAE.</em>
                                <b>View all</b>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <a href="{{ route('blog') }}" @class(['active' => request()->routeIs('blog') || request()->routeIs('blog.show')])>Blog</a>
            <a href="{{ route('projects') }}" @class(['active' => request()->routeIs('projects') || request()->routeIs('projects.show')])>Projects</a>
            <a href="{{ route('contact') }}" @class(['active' => request()->routeIs('contact')])>Contact Us</a>
        </nav>
        <a class="btn btn-nav" href="{{ route('contact') }}">Contact Us!</a>
    </div>
</header>
