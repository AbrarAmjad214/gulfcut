@extends('layouts.site')
@php $g = \App\Support\GulfCut::class; @endphp

@section('content')
<section class="page-hero" style="--hero:url('{{ $g::photo('Concrete-wall-saw-cutting.jpeg') }}')">
    <div class="wrap" data-animate>
        @include('partials.crumbs')
        <p class="eyebrow">UAE contractor</p>
        <h1>Concrete Cutting, Wall Saw Cutting &amp; Demolition Contractor</h1>
        <p>Gulf Cut cuts, wall-saws and removes reinforced concrete for contractors across Dubai and the UAE.</p>
        <div class="btn-row">
            <a class="btn" href="{{ route('contact') }}">Get Free Quote</a>
            <a class="btn btn-ghost" href="tel:{{ $g::PHONE_TEL }}">Call {{ $g::PHONE_DISPLAY }}</a>
        </div>
    </div>
</section>

<section class="section">
    <div class="wrap split">
        <div>
            <p class="eyebrow">One crew</p>
            <h2>Hire the contractor for the cut and the removal</h2>
            <p>Main contractors call Gulf Cut when a drawing needs a new opening and the old concrete has to come out. We set the wall saw on the line, cut the slab or wall, and take the piece away without breaking the structure around it.</p>
            <p>The yard is in Al Quoz, Dubai. The same team covers Abu Dhabi, Sharjah, Ajman and the rest of the UAE for concrete cutting, wall saw cutting and controlled demolition.</p>
            <ul class="ticks">
                <li>Concrete cutting for walls, slabs, floors and beams</li>
                <li>Wall saw cutting for doors, windows and lift openings</li>
                <li>Demolition of slabs, stairs, beams and cut panels</li>
                <li>Scanning first when the concrete may hold cables or pipes</li>
            </ul>
        </div>
        <figure>
            <img class="rounded" src="{{ $g::photo('Concrete-Demolition-Services.jpeg') }}" alt="Controlled concrete demolition on a Gulf Cut site" loading="lazy" decoding="async">
        </figure>
    </div>
</section>

<section class="section section-paper">
    <div class="wrap">
        <div class="section-head">
            <p class="eyebrow">What we take on</p>
            <h2>Cutting, wall saw and demolition</h2>
        </div>
        <div class="service-grid">
            <a class="service-card light" href="{{ url('concrete-cutting-services-uae') }}">
                <img src="{{ $g::photo('Concrete-floor-cutting.jpeg') }}" alt="Concrete floor saw cutting" loading="lazy" decoding="async">
                <div>
                    <h3>Concrete cutting</h3>
                    <p>Diamond cutting for slabs, floors, walls and beams. Straight lines, controlled depth, and an edge the next trade can use.</p>
                    <span class="more">View service</span>
                </div>
            </a>
            <a class="service-card light" href="{{ url('wall-saw-cutting') }}">
                <img src="{{ $g::photo('Concrete-wall-saw-cutting.jpeg') }}" alt="Wall saw cutting a reinforced concrete wall" loading="lazy" decoding="async">
                <div>
                    <h3>Wall saw cutting</h3>
                    <p>Track saws for doorways, windows, shafts and structural openings in reinforced walls, with the cut panel supported before it is freed.</p>
                    <span class="more">View service</span>
                </div>
            </a>
            <a class="service-card light" href="{{ url('concrete-demolition-services-uae') }}">
                <img src="{{ $g::photo('Concrete-staircase-Demolition.jpeg') }}" alt="Concrete staircase cut for removal" loading="lazy" decoding="async">
                <div>
                    <h3>Demolition contractor</h3>
                    <p>Controlled removal of slabs, stairs, beams and cut sections. Pieces are sized so they can be carried out, not smashed through the floor.</p>
                    <span class="more">View service</span>
                </div>
            </a>
            <a class="service-card light" href="{{ url('concrete-scanning') }}">
                <img src="{{ $g::photo('Concrete-slab-3d-scanning.jpeg') }}" alt="Scanning a concrete slab before cutting" loading="lazy" decoding="async">
                <div>
                    <h3>Scan before the saw</h3>
                    <p>Where the slab or wall may hold rebar, conduits or post-tension cables, we scan and mark the line before any cut starts.</p>
                    <span class="more">View service</span>
                </div>
            </a>
        </div>
    </div>
</section>

<section class="section">
    <div class="wrap">
        <div class="section-head">
            <p class="eyebrow">On site</p>
            <h2>How a contractor job runs</h2>
            <p>Send the drawing, the thickness and the site address. Gulf Cut confirms the method, then cuts and removes the concrete.</p>
        </div>
        <ol class="steps">
            <li>
                <span>01</span>
                <h3>Drawing and site check</h3>
                <p>Opening size, wall or slab thickness, access, and what has to stay in use next door.</p>
            </li>
            <li>
                <span>02</span>
                <h3>Scan if needed</h3>
                <p>Steel, pipes and cables marked before the saw or the drill is set on the line.</p>
            </li>
            <li>
                <span>03</span>
                <h3>Wall saw or floor saw</h3>
                <p>Diamond cutting on the marked line, with water and slurry kept off the live areas.</p>
            </li>
            <li>
                <span>04</span>
                <h3>Controlled demolition</h3>
                <p>The freed concrete is cut into pieces and taken out. The surrounding structure stays.</p>
            </li>
            <li>
                <span>05</span>
                <h3>Handover</h3>
                <p>Edges left ready for the builder. The floor is cleared for the next trade.</p>
            </li>
        </ol>
    </div>
</section>

@include('partials.lead-band', [
    'heading' => 'Book the cutting and demolition crew',
    'lead' => 'Send the drawing and a phone number. Gulf Cut will call you back about concrete cutting, wall saw cutting or demolition.',
    'preset' => 'Concrete Cutting, Wall Saw & Demolition',
    'source' => url()->current(),
])
@include('partials.closing', [
    'heading' => 'Need a demolition contractor on a live site?',
    'lead' => 'Call Gulf Cut in Al Quoz. We cover Dubai and the rest of the UAE.',
])
@endsection
