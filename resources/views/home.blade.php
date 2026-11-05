@extends('layouts.site')
@php $g = \App\Support\GulfCut::class; @endphp

@section('content')
<section class="hero">
    <div class="hero-bg" style="background-image:url('{{ $g::photo('Concrete-slab-3d-scanning.jpeg') }}')"></div>
    <div class="wrap hero-grid">
        <div data-animate>
            <p class="eyebrow">We Are Solving</p>
            <h1>Professional Concrete Cutting Services in Dubai UAE</h1>
            <h2>Precision Concrete Cutting &amp; Core Drilling Experts Across the UAE</h2>
            <p>Gulf Cut is a trusted provider of professional concrete cutting services in the UAE, delivering safe, accurate, and efficient solutions for residential, commercial, and industrial projects. Using advanced diamond cutting technology and modern equipment, we specialize in concrete cutting, core drilling, wall sawing, slab cutting, wire sawing, concrete demolition, and structural modifications.</p>
            <p>Whether you need precise openings for HVAC systems, plumbing, electrical installations, or controlled demolition for renovation projects, our experienced team ensures every job is completed with accuracy, safety, and minimal disruption. We proudly serve clients across Dubai, Abu Dhabi, Sharjah, Ajman, Ras Al Khaimah, Fujairah, Umm Al Quwain, and other locations throughout the UAE.</p>
            <div class="btn-row">
                <a class="btn" href="{{ route('contact') }}">Get Free Quote</a>
                <a class="btn btn-ghost" href="tel:{{ $g::PHONE_TEL }}">Call Us {{ $g::PHONE_DISPLAY }}</a>
            </div>
        </div>
        <figure class="hero-photo" data-animate="right">
            <img src="{{ $g::photo('ConcreteDemolitionServices.jpeg') }}" alt="Concrete demolition services" width="800" height="550" decoding="async">
        </figure>
    </div>
</section>

<section class="section">
    <div class="wrap split">
        <figure data-animate>
            <img src="{{ $g::photo('Concrete-staircase-Demolition.jpeg') }}" alt="Concrete staircase demolition" loading="lazy" decoding="async">
        </figure>
        <div data-animate>
            <p class="eyebrow">Gulf Cut UAE</p>
            <h2>Trusted Concrete Cutting &amp; Demolition Company in UAE</h2>
            <p>Gulf Cut has built a reputation for delivering high-quality concrete cutting and demolition services throughout the UAE. Our experienced technicians combine industry expertise with advanced machinery to provide safe, efficient, and cost-effective solutions for projects of every size.</p>
            <p>From residential villas and commercial buildings to industrial facilities and infrastructure projects, we handle every job with professionalism and attention to detail. Our services are designed to meet the highest safety standards while ensuring precision and minimal impact on surrounding structures.</p>
            <p>Using modern diamond cutting equipment, wall saws, wire saws, floor saws, and core drilling machines, we can safely cut reinforced concrete, slabs, walls, beams, columns, and other structural elements. Whether your project involves new construction, renovation, expansion, or selective demolition, Gulf Cut delivers reliable solutions tailored to your requirements.</p>
            <p>Our commitment to quality workmanship, timely project completion, and customer satisfaction has made us a preferred choice for contractors, builders, engineers, facility managers, and property owners across the UAE.</p>
            <div class="btn-row">
                <a class="btn" href="{{ route('about') }}">View More</a>
                <a class="btn btn-line" href="tel:{{ $g::PHONE_TEL }}">Call Us {{ $g::PHONE_DISPLAY }}</a>
            </div>
        </div>
    </div>
</section>

<section class="section section-dark">
    <div class="wrap">
        <div class="section-head" data-animate>
            <p class="eyebrow">What We Do</p>
            <h2>Our Professional Services</h2>
            <p>Specialist diamond cutting, coring, scanning and demolition — delivered to spec, on schedule, across the UAE.</p>
        </div>
        <div class="service-grid">
            @foreach ($g::featured() as $service)
                <a class="service-card" href="{{ url($service['slug']) }}" data-animate style="--delay: {{ $loop->index * 60 }}ms">
                    <img src="{{ $g::photo($service['image']) }}" alt="{{ $service['title'] }}" loading="lazy" decoding="async">
                    <div>
                        <span class="num">{{ $service['n'] }}</span>
                        <h3>{{ $service['title'] }}</h3>
                        <p>{{ $service['text'] }}</p>
                        <span class="more">View service</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="section">
    <div class="wrap">
        <div class="section-head" data-animate>
            <p class="eyebrow">The Gulf Cut Standard</p>
            <h2>Why Choose Gulf Cut?</h2>
        </div>
        <div class="icon-grid">
            @foreach ([
                ['Experienced Professionals', 'Our skilled technicians have extensive experience handling concrete cutting, core drilling, and demolition projects across the UAE.'],
                ['Advanced Equipment', 'We use the latest diamond cutting technology, wall saws, wire saws, floor saws, and core drilling machines to ensure precise and efficient results.'],
                ['Safety First', 'Every project is completed following strict health and safety standards to protect workers, clients, and surrounding structures.'],
                ['Fast Project Completion', 'Our efficient planning and experienced workforce help complete projects on time without compromising quality.'],
                ['Affordable Pricing', 'We provide competitive pricing while maintaining the highest standards of workmanship and customer service.'],
                ['Clean & Accurate Work', 'Our cutting methods produce smooth finishes with reduced vibration, minimal dust, and less noise compared to traditional demolition methods.'],
            ] as $point)
                <article class="icon-card" data-animate>
                    <h3>{{ $point[0] }}</h3>
                    <p>{{ $point[1] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="band">
    <div class="wrap" data-animate>
        <p class="eyebrow">Coverage</p>
        <h2>Available Across UAE</h2>
        <p>We proudly provide concrete cutting, core drilling, and demolition services in:</p>
    </div>
    <div class="marquee" aria-hidden="true">
        <div class="marquee-track">
            @foreach (range(1, 2) as $copy)
                <span>Dubai</span><span>Abu Dhabi</span><span>Sharjah</span><span>Ajman</span><span>Ras Al Khaimah</span><span>Fujairah</span><span>Umm Al Quwain</span><span>Al Ain</span>
            @endforeach
        </div>
    </div>
</section>

<section class="section section-paper">
    <div class="wrap">
        <div class="section-head" data-animate>
            <p class="eyebrow">Industries We Serve</p>
            <h2>Built For Every Sector</h2>
            <p>Our services support a wide range of industries across the UAE, including:</p>
        </div>
        <div class="chips">
            @foreach (['Residential Construction', 'Commercial Buildings', 'Industrial Facilities', 'Hospitals & Healthcare', 'Hotels & Hospitality', 'Shopping Malls', 'Schools & Universities', 'Government Projects', 'Infrastructure Development', 'Warehouses & Factories', 'Airports & Transport Facilities'] as $industry)
                <span data-animate>{{ $industry }}</span>
            @endforeach
        </div>
    </div>
</section>

<section class="section">
    <div class="wrap">
        <div class="section-head" data-animate>
            <p class="eyebrow">How It Works</p>
            <h2>Our Working Process</h2>
        </div>
        <ol class="steps">
            @foreach ([
                ['Free Consultation', 'We discuss your project requirements and provide expert recommendations based on your construction or demolition needs.'],
                ['Site Inspection', 'Our team visits the site to evaluate the concrete structure, identify challenges, and determine the safest cutting or drilling method.'],
                ['Planning & Safety Assessment', 'Before work begins, we prepare a detailed execution plan, ensuring all safety measures and structural considerations are in place.'],
                ['Professional Execution', 'Using advanced diamond cutting equipment and modern techniques, our experienced technicians carry out the work efficiently and accurately.'],
                ['Final Inspection & Site Cleanup', 'Once the project is completed, we inspect the work to ensure quality standards are met and leave the site clean and ready for the next phase.'],
            ] as $step)
                <li data-animate>
                    <span>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <h3>{{ $step[0] }}</h3>
                    <p>{{ $step[1] }}</p>
                </li>
            @endforeach
        </ol>
    </div>
</section>

<section class="section section-split-media">
    <div class="wrap split">
        <div data-animate>
            <p class="eyebrow">Why It Matters</p>
            <h2>Why Professional Concrete Cutting Services Matter</h2>
            <p>Concrete cutting plays a critical role in modern construction, renovation, and demolition projects. Whether you’re modifying an existing structure or preparing a new development, precision is essential to maintain structural integrity and ensure project safety. Professional concrete cutting allows contractors to create clean openings, remove damaged sections, and make structural changes without causing unnecessary damage to surrounding areas.</p>
            <p>At Gulf Cut, we use advanced diamond cutting technology that delivers accurate, vibration-controlled, and low-noise cutting solutions. Unlike traditional demolition methods, our equipment minimizes dust, reduces project downtime, and produces clean finishes that are ready for the next stage of construction. From residential villas to commercial towers and industrial facilities, we provide dependable concrete cutting services tailored to every project.</p>
            <a class="btn" href="tel:{{ $g::PHONE_TEL }}">Call Us {{ $g::PHONE_TEL }}</a>
        </div>
        <figure data-animate="right">
            <img class="rounded" src="{{ $g::photo('Concrete-wall-saw-cutting.jpeg') }}" alt="Wall saw cutting reinforced concrete" loading="lazy" decoding="async">
        </figure>
    </div>
</section>

<section class="section section-paper">
    <div class="wrap">
        <div class="section-head" data-animate>
            <p class="eyebrow">The Gulf Cut Standard</p>
            <h2>Our Specialized Concrete Cutting Solutions</h2>
        </div>
        <div class="icon-grid four">
            @foreach ([
                ['Diamond Concrete Cutting', 'Diamond cutting is one of the safest and most efficient methods for cutting reinforced concrete. Our high-performance diamond blades provide smooth, accurate cuts with minimal vibration, making them ideal for structural modifications and precision construction work.'],
                ['Reinforced Concrete Cutting', 'Reinforced concrete requires specialized equipment and experienced technicians. Our team is fully equipped to cut through reinforced slabs, walls, beams, and columns while protecting the surrounding structure.'],
                ['Structural Modification', 'Need to create a new doorway, enlarge a window opening, or modify a concrete structure? We provide controlled structural cutting services that meet engineering requirements while maintaining safety.'],
                ['Concrete Removal', 'After cutting is complete, we also provide safe concrete removal and debris clearance, helping keep your site clean and ready for the next construction phase.'],
            ] as $card)
                <article class="icon-card" data-animate>
                    <h3>{{ $card[0] }}</h3>
                    <p>{{ $card[1] }}</p>
                </article>
            @endforeach
        </div>
        <div class="commit" data-animate>
            <h2>Our Commitment</h2>
            <p>Safety is at the heart of everything we do. Every project begins with a detailed site assessment and risk evaluation to ensure the safest cutting method is selected. Our trained technicians follow industry best practices and use modern equipment to reduce dust, vibration, and noise while protecting nearby structures.</p>
            <p>Our commitment to quality means every cut is measured, planned, and executed with precision. We continuously maintain our equipment and invest in the latest technologies to deliver consistent, high-quality workmanship on every project.</p>
        </div>
    </div>
</section>

<section class="section">
    <div class="wrap split">
        <div data-animate>
            <p class="eyebrow">Where We're Used</p>
            <h2>Applications of Our Services</h2>
            <p>Our concrete cutting and core drilling services are widely used for:</p>
            <ul class="ticks">
                @foreach (['Door and window openings', 'Lift shaft modifications', 'HVAC duct openings', 'Plumbing installations', 'Electrical conduit installations', 'Fire protection systems', 'Bridge construction', 'Road cutting', 'Industrial plant maintenance', 'Warehouse renovations', 'Building extensions', 'Shopping mall renovations', 'Hotel construction', 'Hospital infrastructure projects', 'Residential remodeling', 'Factory upgrades'] as $use)
                    <li>{{ $use }}</li>
                @endforeach
            </ul>
            <p>No matter the size or complexity of the project, Gulf Cut has the expertise and equipment to deliver precise and reliable results.</p>
        </div>
        <figure data-animate="right">
            <img class="rounded" src="{{ $g::photo('Concrete-floor-cutting.jpeg') }}" alt="Concrete floor cutting" loading="lazy" decoding="async">
        </figure>
    </div>
</section>

<section class="section section-dark">
    <div class="wrap">
        <div class="section-head" data-animate>
            <p class="eyebrow">Coverage, In Detail</p>
            <h2>Areas We Serve Across the UAE</h2>
            <p>Gulf Cut proudly provides professional concrete cutting and core drilling services throughout the United Arab Emirates. We regularly serve clients in:</p>
        </div>
        <div class="city-grid">
            @foreach (['Dubai', 'Abu Dhabi', 'Sharjah', 'Ajman', 'Umm Al Quwain', 'Ras Al Khaimah', 'Fujairah', 'Al Ain'] as $city)
                <div data-animate>{{ $city }}</div>
            @endforeach
        </div>
        <p class="center" data-animate>Whether your project is a small residential renovation or a large commercial development, our experienced team is ready to deliver reliable and professional solutions anywhere in the UAE.</p>
    </div>
</section>

<section class="section">
    <div class="wrap split">
        <div data-animate>
            <p class="eyebrow">The Payoff</p>
            <h2>Benefits of Choosing Gulf Cut</h2>
            <p>Choosing Gulf Cut means working with a company that values precision, safety, and customer satisfaction. Here are some of the advantages of partnering with us:</p>
            <ul class="ticks">
                @foreach (['Experienced and certified technicians', 'Safe and controlled work methods', 'Accurate cutting with minimal vibration', 'Affordable and transparent pricing', 'Reliable customer support', 'Advanced diamond cutting technology', 'Fast response across the UAE', 'Reduced dust and noise', 'Timely project completion', 'Customized solutions for every project'] as $benefit)
                    <li>{{ $benefit }}</li>
                @endforeach
            </ul>
            <p>Our goal is to provide high-quality concrete cutting services that help clients complete their projects safely, efficiently, and on schedule.</p>
        </div>
        <div data-animate>
            <p class="eyebrow">Who We Work With</p>
            <h2>Our Clients</h2>
            <p>We proudly work with a wide range of clients across the UAE, including:</p>
            <div class="chips">
                @foreach (['Construction Companies', 'General Contractors', 'Civil Engineering Firms', 'MEP Contractors', 'Government Organizations', 'Property Developers', 'Facility Management Companies', 'Industrial Plants', 'Residential Property Owners', 'Commercial Building Owners', 'Hotels and Hospitality Groups', 'Educational Institutions'] as $client)
                    <span>{{ $client }}</span>
                @endforeach
            </div>
            <p>We successfully complete residential, commercial, industrial, and infrastructure projects across the UAE with precision, safety, and efficiency.</p>
        </div>
    </div>
</section>

<section class="section section-paper">
    <div class="wrap quotes-wrap">
        <div data-animate>
            <p class="eyebrow">Stories of Trust</p>
            <h2>And Excellence.</h2>
            <div class="quotes" id="quotes">
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
        <div class="stat" data-animate>
            <div class="stat-num"><span data-count="98">0</span>%</div>
            <p>Customer Satisfaction</p>
            <small>Trusted by homes and businesses alike.</small>
            <img src="{{ $g::photo('ConcreteDemolitionServices.jpeg') }}" alt="Concrete demolition on site" loading="lazy" decoding="async">
        </div>
    </div>
</section>

<section class="section section-paper">
    <div class="wrap">
        <div class="section-head" data-animate>
            <p class="eyebrow">Projects</p>
            <h2>Recent cutting work</h2>
            <p>Openings, cores, floor sawing and removals from Gulf Cut sites in Dubai and the UAE.</p>
        </div>
        <div class="blog-grid">
            @foreach (\App\Support\Projects::related('', 3) as $project)
                <a class="blog-card" href="{{ url('projects/'.$project['slug']) }}" data-animate>
                    <img src="{{ $g::photo($project['image']) }}" alt="{{ $project['image_alt'] }}" loading="lazy" decoding="async">
                    <div>
                        <p class="blog-meta">{{ $project['location'] }}</p>
                        <h3>{{ $project['h1'] }}</h3>
                        <p>{{ $project['excerpt'] }}</p>
                        <span class="more">View project</span>
                    </div>
                </a>
            @endforeach
        </div>
        <p class="center"><a class="btn" href="{{ route('projects') }}">All projects</a></p>
    </div>
</section>

<section class="section">
    <div class="wrap">
        <div class="section-head" data-animate>
            <p class="eyebrow">Blog</p>
            <h2>Guides for Dubai sites</h2>
            <p>How to choose concrete cutting, core drilling and demolition before the crew arrives.</p>
        </div>
        <div class="blog-grid">
            @foreach (\App\Support\Blog::related('', 3) as $post)
                <a class="blog-card" href="{{ url('blog/'.$post['slug']) }}" data-animate>
                    <img src="{{ $g::photo($post['image']) }}" alt="{{ $post['image_alt'] }}" loading="lazy" decoding="async">
                    <div>
                        <p class="blog-meta">{{ $post['category'] }}</p>
                        <h3>{{ $post['h1'] }}</h3>
                        <p>{{ $post['excerpt'] }}</p>
                        <span class="more">Read guide</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

@include('partials.lead-band', [
    'heading' => 'Reach Us',
    'lead' => 'Looking for concrete cutting, demolition, or core drilling in the UAE? Send the site details and Gulf Cut will call you back with a quotation.',
])
@endsection
