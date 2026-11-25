@extends('layouts.site')
@php
    $g = \App\Support\GulfCut::class;
    $icons = [
        'crew' => '<path d="M8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm8 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM2 20c0-3.3 2.7-6 6-6s6 2.7 6 6m0-5.6A6 6 0 0 1 22 20"/>',
        'blade' => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="2.5"/><path d="M12 3v3m0 12v3M3 12h3m12 0h3M5.6 5.6l2.1 2.1m8.6 8.6 2.1 2.1m0-12.8-2.1 2.1m-8.6 8.6-2.1 2.1"/>',
        'shield' => '<path d="M12 3 4 6v6c0 4.5 3.4 8.3 8 9 4.6-.7 8-4.5 8-9V6l-8-3z"/><path d="m8.5 12 2.5 2.5 4.5-5"/>',
        'clock' => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3.5 2"/>',
        'tag' => '<path d="M3 12V4h8l10 10-8 8L3 12z"/><circle cx="7.5" cy="8.5" r="1.5"/>',
        'drop' => '<path d="M12 3s6 6.5 6 11a6 6 0 0 1-12 0c0-4.5 6-11 6-11z"/><path d="M9.5 15a2.5 2.5 0 0 0 2.5 2.5"/>',
    ];
@endphp

@push('head')
    {!! $g::preload($g::photo('ConcreteDemolitionServices.jpeg'), '(max-width: 760px) 100vw, 40vw') !!}
@endpush

@section('content')
{{-- 1. Hero --}}
<section class="hero home-hero">
    <div class="hero-bg" {!! $g::heroStyle($g::photo('Concrete-slab-3d-scanning.jpeg')) !!}></div>
    <div class="wrap hero-grid">
        <div data-animate>
            <p class="eyebrow">Cutting · Core drilling · Scanning · Demolition</p>
            <h1>Professional Concrete Cutting Services in Dubai UAE</h1>
            <h2>Precision Concrete Cutting &amp; Core Drilling Experts Across the UAE</h2>
            <p class="hero-lead">{!! $g::link('Gulf Cut is a trusted provider of professional concrete cutting services in the UAE, delivering safe, accurate, and efficient solutions for residential, commercial, and industrial projects. Using advanced diamond cutting technology and modern equipment, we specialize in concrete cutting, core drilling, wall sawing, slab cutting, wire sawing, concrete demolition, and structural modifications.') !!}</p>
            <div class="btn-row">
                <a class="btn" href="{{ route('contact') }}">Get Free Quote</a>
                <a class="btn btn-ghost" href="tel:{{ $g::PHONE_TEL }}" data-track="call">Call Us {{ $g::PHONE_DISPLAY }}</a>
            </div>
            <ul class="hero-facts">
                <li><strong>{{ count($g::cities()) }}</strong><span>cities &amp; emirates</span></li>
                <li><strong>3</strong><span>saw types: wall, floor, wire</span></li>
                <li><strong>GPR</strong><span>scan before the cut</span></li>
            </ul>
        </div>
        <figure class="hero-photo" data-animate="right">
            <img src="{{ $g::photo('ConcreteDemolitionServices.jpeg') }}" {!! $g::attrs($g::photo('ConcreteDemolitionServices.jpeg'), '(max-width: 760px) 100vw, 40vw') !!} alt="Gulf Cut crew on a controlled concrete demolition job in the UAE" fetchpriority="high" decoding="async">
            <figcaption class="hero-badge">
                <span>Scan</span><i aria-hidden="true"></i><span>Cut</span><i aria-hidden="true"></i><span>Remove</span>
            </figcaption>
        </figure>
    </div>
</section>

{{-- 2. Service quick links --}}
<nav class="service-rail" aria-label="Popular services">
    <div class="wrap service-rail-row">
        <span class="service-rail-label">Jump to</span>
        @foreach (array_slice($g::menu(), 0, 8) as $item)
            <a href="{{ url($item['slug']) }}">{{ $item['label'] }}</a>
        @endforeach
    </div>
</nav>

{{-- 3. Company intro --}}
<section class="section home-intro">
    <div class="wrap split">
        <div class="collage" data-animate>
            <img class="collage-main" src="{{ $g::photo('Concrete-staircase-Demolition.jpeg') }}" {!! $g::attrs($g::photo('Concrete-staircase-Demolition.jpeg')) !!} alt="Concrete staircase demolition by Gulf Cut" loading="lazy" decoding="async">
            <img class="collage-small" src="{{ $g::photo('Concrete-slab-core-cutting.jpeg') }}" {!! $g::attrs($g::photo('Concrete-slab-core-cutting.jpeg'), '240px') !!} alt="Diamond core drilling through a concrete slab" loading="lazy" decoding="async">
            <p class="collage-tag"><strong>Al Quoz</strong> Dubai base, UAE-wide crew</p>
        </div>
        <div data-animate>
            <p class="eyebrow">Gulf Cut UAE</p>
            <h2>Concrete Cutting &amp; Demolition Crew Based in Al Quoz, Dubai</h2>
            <p class="lead">{!! $g::link('Gulf Cut has built a reputation for delivering high-quality concrete cutting and demolition services throughout the UAE. Our experienced technicians combine industry expertise with advanced machinery to provide safe, efficient, and cost-effective solutions for projects of every size.') !!}</p>
            <p>{!! $g::link('Whether you need precise openings for HVAC systems, plumbing, electrical installations, or controlled demolition for renovation projects, our experienced team ensures every job is completed with accuracy, safety, and minimal disruption. We proudly serve clients across Dubai, Abu Dhabi, Sharjah, Ajman, Ras Al Khaimah, Fujairah, Umm Al Quwain, and other locations throughout the UAE.') !!}</p>
            <p>{!! $g::link('From residential villas and commercial buildings to industrial facilities and infrastructure projects, we handle every job with professionalism and attention to detail. Our services are designed to meet the highest safety standards while ensuring precision and minimal impact on surrounding structures.') !!}</p>
            <p>{!! $g::link('Using modern diamond cutting equipment, wall saws, wire saws, floor saws, and core drilling machines, we can safely cut reinforced concrete, slabs, walls, beams, columns, and other structural elements. Whether your project involves new construction, renovation, expansion, or selective demolition, Gulf Cut delivers reliable solutions tailored to your requirements.') !!}</p>
            <p>{!! $g::link('Our commitment to quality workmanship, timely project completion, and customer satisfaction has made us a preferred choice for contractors, builders, engineers, facility managers, and property owners across the UAE.') !!}</p>
            <div class="btn-row">
                <a class="btn" href="{{ route('about') }}">About Gulf Cut</a>
                <a class="btn btn-line" href="tel:{{ $g::PHONE_TEL }}" data-track="call">Call Us {{ $g::PHONE_DISPLAY }}</a>
            </div>
        </div>
    </div>
</section>

{{-- 4. Services --}}
<section class="section section-dark home-services">
    <div class="wrap">
        <div class="section-head split-head" data-animate>
            <div>
                <p class="eyebrow">What We Do</p>
                <h2>Our Professional Services</h2>
            </div>
            <div>
                <p>{!! $g::link('Specialist diamond cutting, coring, scanning and demolition, delivered to spec and on schedule across the UAE.') !!}</p>
                <a class="more" href="{{ route('services') }}">All services →</a>
            </div>
        </div>
        <div class="feature-grid">
            @foreach ($g::featured() as $service)
                <a class="feature-card" href="{{ url($service['slug']) }}" data-animate style="--delay: {{ ($loop->index % 4) * 70 }}ms">
                    <span class="feature-media">
                        <img src="{{ $g::photo($service['image']) }}" {!! $g::attrs($g::photo($service['image']), '(max-width: 760px) 100vw, (max-width: 1100px) 50vw, 25vw') !!} alt="{{ $service['title'] }}" loading="lazy" decoding="async">
                        <span class="num">{{ $service['n'] }}</span>
                    </span>
                    <span class="feature-body">
                        <h3>{{ $service['title'] }}</h3>
                        <p>{{ $service['text'] }}</p>
                        <span class="more">View service →</span>
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- 5. Why choose --}}
<section class="section">
    <div class="wrap">
        <div class="section-head center-head" data-animate>
            <p class="eyebrow">The Gulf Cut Standard</p>
            <h2>Why Choose Gulf Cut?</h2>
        </div>
        <div class="why-grid">
            @foreach ([
                ['crew', 'Experienced Professionals', 'Our skilled technicians have extensive experience handling concrete cutting, core drilling, and demolition projects across the UAE.'],
                ['blade', 'Advanced Equipment', 'We use the latest diamond cutting technology, wall saws, wire saws, floor saws, and core drilling machines to ensure precise and efficient results.'],
                ['shield', 'Safety First', 'Every project is completed following strict health and safety standards to protect workers, clients, and surrounding structures.'],
                ['clock', 'Fast Project Completion', 'Our efficient planning and experienced workforce help complete projects on time without compromising quality.'],
                ['tag', 'Affordable Pricing', 'We provide competitive pricing while maintaining the highest standards of workmanship and customer service.'],
                ['drop', 'Clean & Accurate Work', 'Our cutting methods produce smooth finishes with reduced vibration, minimal dust, and less noise compared to traditional demolition methods.'],
            ] as $point)
                <article class="why-card" data-animate style="--delay: {{ ($loop->index % 3) * 70 }}ms">
                    <span class="why-icon"><svg viewBox="0 0 24 24" aria-hidden="true">{!! $icons[$point[0]] !!}</svg></span>
                    <h3>{{ $point[1] }}</h3>
                    <p>{{ $point[2] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

{{-- 6. Process --}}
<section class="section section-paper">
    <div class="wrap">
        <div class="section-head center-head" data-animate>
            <p class="eyebrow">How It Works</p>
            <h2>Our Working Process</h2>
        </div>
        <ol class="timeline">
            @foreach ([
                ['Free Consultation', 'We discuss your project requirements and provide expert recommendations based on your construction or demolition needs.'],
                ['Site Inspection', 'Our team visits the site to evaluate the concrete structure, identify challenges, and determine the safest cutting or drilling method.'],
                ['Planning & Safety Assessment', 'Before work begins, we prepare a detailed execution plan, ensuring all safety measures and structural considerations are in place.'],
                ['Professional Execution', 'Using advanced diamond cutting equipment and modern techniques, our experienced technicians carry out the work efficiently and accurately.'],
                ['Final Inspection & Site Cleanup', 'Once the project is completed, we inspect the work to ensure quality standards are met and leave the site clean and ready for the next phase.'],
            ] as $step)
                <li data-animate style="--delay: {{ $loop->index * 80 }}ms">
                    <span class="timeline-dot">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <h3>{{ $step[0] }}</h3>
                    <p>{{ $step[1] }}</p>
                </li>
            @endforeach
        </ol>
    </div>
</section>

{{-- 7. Why it matters + specialised solutions --}}
<section class="section">
    <div class="wrap split split-reverse">
        <div data-animate>
            <p class="eyebrow">Why It Matters</p>
            <h2>Why Professional Concrete Cutting Services Matter</h2>
            <p>{!! $g::link('Concrete cutting plays a critical role in modern construction, renovation, and demolition projects. Whether you’re modifying an existing structure or preparing a new development, precision is essential to maintain structural integrity and ensure project safety. Professional concrete cutting allows contractors to create clean openings, remove damaged sections, and make structural changes without causing unnecessary damage to surrounding areas.') !!}</p>
            <p>{!! $g::link('At Gulf Cut, we use advanced diamond cutting technology that delivers accurate, vibration-controlled, and low-noise cutting solutions. Unlike traditional demolition methods, our equipment minimizes dust, reduces project downtime, and produces clean finishes that are ready for the next stage of construction. From residential villas to commercial towers and industrial facilities, we provide dependable concrete cutting services tailored to every project.') !!}</p>
            <a class="btn" href="tel:{{ $g::PHONE_TEL }}" data-track="call">Call Us {{ $g::PHONE_DISPLAY }}</a>
        </div>
        <figure data-animate="right">
            <img class="rounded" src="{{ $g::photo('Concrete-staircase-cutting.jpeg') }}" {!! $g::attrs($g::photo('Concrete-staircase-cutting.jpeg')) !!} alt="Diamond saw cutting a reinforced concrete staircase" loading="lazy" decoding="async">
        </figure>
    </div>
    <div class="wrap">
        <div class="section-head solutions-head" data-animate>
            <p class="eyebrow">The Gulf Cut Standard</p>
            <h2>Our Specialized Concrete Cutting Solutions</h2>
        </div>
        <div class="solution-grid">
            @foreach ([
                ['Diamond Concrete Cutting', 'Diamond cutting is one of the safest and most efficient methods for cutting reinforced concrete. Our high-performance diamond blades provide smooth, accurate cuts with minimal vibration, making them ideal for structural modifications and precision construction work.'],
                ['Reinforced Concrete Cutting', 'Reinforced concrete requires specialized equipment and experienced technicians. Our team is fully equipped to cut through reinforced slabs, walls, beams, and columns while protecting the surrounding structure.'],
                ['Structural Modification', 'Need to create a new doorway, enlarge a window opening, or modify a concrete structure? We provide controlled structural cutting services that meet engineering requirements while maintaining safety.'],
                ['Concrete Removal', 'After cutting is complete, we also provide safe concrete removal and debris clearance, helping keep your site clean and ready for the next construction phase.'],
            ] as $card)
                <article class="solution-card" data-animate style="--delay: {{ $loop->index * 70 }}ms">
                    <span class="solution-n">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <h3>{{ $card[0] }}</h3>
                    <p>{{ $card[1] }}</p>
                </article>
            @endforeach
        </div>
        <div class="commit-box" data-animate>
            <div>
                <p class="eyebrow">Safety &amp; quality</p>
                <h2>Our Commitment</h2>
            </div>
            <div>
                <p>{!! $g::link('Safety is at the heart of everything we do. Every project begins with a detailed site assessment and risk evaluation to ensure the safest cutting method is selected. Our trained technicians follow industry best practices and use modern equipment to reduce dust, vibration, and noise while protecting nearby structures.') !!}</p>
                <p>{!! $g::link('Our commitment to quality means every cut is measured, planned, and executed with precision. We continuously maintain our equipment and invest in the latest technologies to deliver consistent, high-quality workmanship on every project.') !!}</p>
            </div>
        </div>
    </div>
</section>

{{-- 8. Applications + benefits --}}
<section class="section section-paper">
    <div class="wrap duo">
        <div class="duo-card" data-animate>
            <img class="duo-photo" src="{{ $g::photo('Concrete-floor-cutting.jpeg') }}" {!! $g::attrs($g::photo('Concrete-floor-cutting.jpeg')) !!} alt="Concrete floor cutting" loading="lazy" decoding="async">
            <p class="eyebrow">Where We're Used</p>
            <h2>Applications of Our Services</h2>
            <p>{!! $g::link('Our concrete cutting and core drilling services are widely used for:') !!}</p>
            <ul class="ticks">
                @foreach (['Door and window openings', 'Lift shaft modifications', 'HVAC duct openings', 'Plumbing installations', 'Electrical conduit installations', 'Fire protection systems', 'Bridge construction', 'Road cutting', 'Industrial plant maintenance', 'Warehouse renovations', 'Building extensions', 'Shopping mall renovations', 'Hotel construction', 'Hospital infrastructure projects', 'Residential remodeling', 'Factory upgrades'] as $use)
                    <li>{{ $use }}</li>
                @endforeach
            </ul>
            <p>{!! $g::link('No matter the size or complexity of the project, Gulf Cut has the expertise and equipment to deliver precise and reliable results.') !!}</p>
        </div>
        <div class="duo-card duo-dark" data-animate="right">
            <p class="eyebrow">The Payoff</p>
            <h2>Benefits of Choosing Gulf Cut</h2>
            <p>{!! $g::link('Choosing Gulf Cut means working with a company that values precision, safety, and customer satisfaction. Here are some of the advantages of partnering with us:') !!}</p>
            <ul class="ticks">
                @foreach (['Experienced and certified technicians', 'Safe and controlled work methods', 'Accurate cutting with minimal vibration', 'Affordable and transparent pricing', 'Reliable customer support', 'Advanced diamond cutting technology', 'Fast response across the UAE', 'Reduced dust and noise', 'Timely project completion', 'Customized solutions for every project'] as $benefit)
                    <li>{{ $benefit }}</li>
                @endforeach
            </ul>
            <p>{!! $g::link('Our goal is to provide high-quality concrete cutting services that help clients complete their projects safely, efficiently, and on schedule.') !!}</p>
            <a class="btn" href="{{ route('contact') }}">Get Free Quote</a>
        </div>
    </div>
</section>

{{-- 9. Sectors and clients --}}
<section class="section">
    <div class="wrap">
        <div class="sector-grid">
            <div data-animate>
                <p class="eyebrow">Industries We Serve</p>
                <h2>Built For Every Sector</h2>
                <p>{!! $g::link('Our services support a wide range of industries across the UAE, including:') !!}</p>
                <div class="chips">
                    @foreach (['Residential Construction', 'Commercial Buildings', 'Industrial Facilities', 'Hospitals & Healthcare', 'Hotels & Hospitality', 'Shopping Malls', 'Schools & Universities', 'Government Projects', 'Infrastructure Development', 'Warehouses & Factories', 'Airports & Transport Facilities'] as $industry)
                        <span>{{ $industry }}</span>
                    @endforeach
                </div>
            </div>
            <div data-animate="right">
                <p class="eyebrow">Who We Work With</p>
                <h2>Our Clients</h2>
                <p>{!! $g::link('We proudly work with a wide range of clients across the UAE, including:') !!}</p>
                <div class="chips chips-soft">
                    @foreach (['Construction Companies', 'General Contractors', 'Civil Engineering Firms', 'MEP Contractors', 'Government Organizations', 'Property Developers', 'Facility Management Companies', 'Industrial Plants', 'Residential Property Owners', 'Commercial Building Owners', 'Hotels and Hospitality Groups', 'Educational Institutions'] as $client)
                        <span>{{ $client }}</span>
                    @endforeach
                </div>
                <p>{!! $g::link('We successfully complete residential, commercial, industrial, and infrastructure projects across the UAE with precision, safety, and efficiency.') !!}</p>
            </div>
        </div>
    </div>
</section>

{{-- 10. Coverage --}}
<section class="section section-dark home-coverage">
    <div class="marquee" aria-hidden="true">
        <div class="marquee-track">
            @foreach (range(1, 2) as $copy)
                @foreach ($g::cities() as $city)
                    <span>{{ $city }}</span>
                @endforeach
            @endforeach
        </div>
    </div>
    <div class="wrap">
        <div class="section-head split-head" data-animate>
            <div>
                <p class="eyebrow">Coverage, In Detail</p>
                <h2>Areas We Serve Across the UAE</h2>
            </div>
            <p>{!! $g::link('Gulf Cut proudly provides professional concrete cutting and core drilling services throughout the United Arab Emirates. We regularly serve clients in:') !!}</p>
        </div>
        <div class="city-grid">
            @foreach ($g::cities() as $city)
                <div data-animate style="--delay: {{ ($loop->index % 4) * 60 }}ms"><span class="pin" aria-hidden="true"></span>{{ $city }}</div>
            @endforeach
        </div>
        <p class="center" data-animate>{!! $g::link('Whether your project is a small residential renovation or a large commercial development, our experienced team is ready to deliver reliable and professional solutions anywhere in the UAE.') !!}</p>
    </div>
</section>

{{-- 11. Testimonials --}}
<section class="section section-paper">
    <div class="wrap quotes-wrap">
        <div class="quote-card" data-animate>
            <span class="quote-mark" aria-hidden="true">“</span>
            <p class="eyebrow">Stories of Trust</p>
            <h2>And Excellence.</h2>
            <div class="quotes" id="quotes" aria-live="polite">
                <blockquote class="quote on">
                    <p>“We hired Gulf Cut UAE for slab demolition and core drilling services. Excellent workmanship, fast response, and very competitive pricing.”</p>
                    <cite>Construction Contractor, Dubai</cite>
                </blockquote>
                <blockquote class="quote">
                    <p>“Gulf Cut UAE completed our concrete wall cutting project professionally and on time. Their team was highly skilled, organized, and safety-focused.”</p>
                    <cite>Project Manager, Abu Dhabi</cite>
                </blockquote>
                <blockquote class="quote">
                    <p>“Their wire saw cutting and staircase demolition services were exceptional. The work was completed cleanly with minimal disruption.”</p>
                    <cite>Villa Owner, Sharjah</cite>
                </blockquote>
            </div>
            <div class="quote-dots" id="quote-dots"></div>
        </div>
        <div class="stat" data-animate="right">
            <img src="{{ $g::photo('ConcreteDemolitionServices.jpeg') }}" {!! $g::attrs($g::photo('ConcreteDemolitionServices.jpeg'), '(max-width: 980px) 100vw, 30vw') !!} alt="Concrete demolition on site" loading="lazy" decoding="async">
            <div class="stat-num"><span data-count="{{ count($g::cities()) }}">{{ count($g::cities()) }}</span></div>
            <p>Cities and emirates covered</p>
            <small>One crew from Al Quoz, Dubai, across the UAE.</small>
        </div>
    </div>
</section>

{{-- 12. Google Business Profile --}}
@include('partials.google-profile')

{{-- 13. Projects --}}
<section class="section section-paper">
    <div class="wrap">
        <div class="section-head split-head" data-animate>
            <div>
                <p class="eyebrow">Projects</p>
                <h2>Recent cutting work</h2>
            </div>
            <div>
                <p>{!! $g::link('Openings, cores, floor sawing and removals from Gulf Cut sites in Dubai and the UAE.') !!}</p>
                <a class="more" href="{{ route('projects') }}">All projects →</a>
            </div>
        </div>
        <div class="blog-grid">
            @foreach (\App\Support\Projects::related('', 3) as $project)
                <a class="blog-card" href="{{ url('projects/'.$project['slug']) }}" data-animate style="--delay: {{ $loop->index * 70 }}ms">
                    <img src="{{ $g::photo($project['image']) }}" {!! $g::attrs($g::photo($project['image']), '(max-width: 760px) 100vw, 33vw') !!} alt="{{ $project['image_alt'] }}" loading="lazy" decoding="async">
                    <div>
                        <p class="blog-meta">{{ $project['location'] }}</p>
                        <h3>{{ $project['h1'] }}</h3>
                        <p>{{ $project['excerpt'] }}</p>
                        <span class="more">View project →</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- 14. Blog --}}
<section class="section">
    <div class="wrap">
        <div class="section-head split-head" data-animate>
            <div>
                <p class="eyebrow">Blog</p>
                <h2>Guides for Dubai sites</h2>
            </div>
            <div>
                <p>{!! $g::link('How to choose concrete cutting, core drilling and demolition before the crew arrives.') !!}</p>
                <a class="more" href="{{ route('blog') }}">All guides →</a>
            </div>
        </div>
        <div class="blog-grid">
            @foreach (\App\Support\Blog::related('', 3) as $post)
                <a class="blog-card" href="{{ url('blog/'.$post['slug']) }}" data-animate style="--delay: {{ $loop->index * 70 }}ms">
                    <img src="{{ $g::photo($post['image']) }}" {!! $g::attrs($g::photo($post['image']), '(max-width: 760px) 100vw, 33vw') !!} alt="{{ $post['image_alt'] }}" loading="lazy" decoding="async">
                    <div>
                        <p class="blog-meta">{{ $post['category'] }}</p>
                        <h3>{{ $post['h1'] }}</h3>
                        <p>{{ $post['excerpt'] }}</p>
                        <span class="more">Read guide →</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- 15. Quote --}}
@include('partials.lead-band', [
    'heading' => 'Reach Us',
    'lead' => 'Looking for concrete cutting, demolition, or core drilling in the UAE? Send the site details and Gulf Cut will call you back with a quotation.',
])
@endsection
