@extends('layouts.site')
@php $g = \App\Support\GulfCut::class; @endphp

@section('content')
<section class="page-hero" style="--hero:url('{{ $g::photo('Concrete-wire-saw-cutting.jpeg') }}')">
    <div class="wrap" data-animate>
        @include('partials.crumbs')
        <p class="eyebrow">Contact</p>
        <h1>Contact Gulf Cut</h1>
        <p>Reach Us</p>
    </div>
</section>

@include('partials.lead-band', [
    'heading' => 'Reach Us',
    'lead' => 'Send the site, the opening and a phone number. Gulf Cut will arrange a visit and send a quotation.',
])

@include('partials.closing', [
    'heading' => 'Get safe, reliable concrete cutting now',
    'lead' => 'Schedule a consultation today. Gulf Cut visits the site and sends a quotation.',
])
@endsection
