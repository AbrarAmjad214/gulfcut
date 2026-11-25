@php $g = \App\Support\GulfCut::class; @endphp
<footer class="site-footer">
    <div class="wrap footer-grid">
        <div>
            <img class="footer-logo" src="{{ $g::logo() }}" alt="Gulf Cut UAE" width="84" height="64" loading="lazy" decoding="async">
            <p>At Gulf Cut UAE, we deliver safe, accurate, and high-performance concrete cutting and demolition solutions for residential, commercial, industrial, and infrastructure projects. With advanced machinery, experienced operators, and fast response times, we ensure every project is completed with maximum precision and minimum disruption.</p>
        </div>
        <div>
            <p class="footer-head">Quick Links</p>
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('about') }}">About Us</a>
            <a href="{{ route('services') }}">Services</a>
            <a href="{{ route('projects') }}">Projects</a>
            <a href="{{ route('blog') }}">Blog</a>
            <a href="{{ route('contact') }}">Contact</a>
        </div>
        <div>
            <p class="footer-head">Services</p>
            <a href="{{ route('contractor') }}">Cutting &amp; Demolition</a>
            <a href="{{ url('wall-saw-cutting') }}">Wall Saw Cutting</a>
            <a href="{{ url('floor-saw-cutting') }}">Floor Saw Cutting</a>
            <a href="{{ url('core-cutting-services-uae') }}">Core Cutting</a>
            <a href="{{ url('concrete-scanning') }}">Concrete Scanning</a>
            <a href="{{ url('wire-saw-cutting') }}">Wire Saw Cutting</a>
        </div>
        <div>
            <p class="footer-head">Get in Touch</p>
            <p>{{ $g::ADDRESS }}</p>
            <p><a href="mailto:{{ $g::EMAIL }}">{{ $g::EMAIL }}</a></p>
            <p><a href="tel:{{ $g::PHONE_TEL }}">{{ $g::PHONE_DISPLAY }}</a></p>
        </div>
    </div>
    <div class="wrap footer-copy">© {{ date('Y') }} Gulf Cut UAE. All rights reserved.</div>
</footer>
