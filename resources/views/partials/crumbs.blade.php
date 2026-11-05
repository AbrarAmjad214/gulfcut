@php $items = \App\Support\GulfCut::breadcrumbs(); @endphp
@if (count($items) > 1)
    <nav class="crumbs" aria-label="Breadcrumb">
        @foreach ($items as $item)
            @if (! $loop->first)
                /
            @endif
            @if ($loop->last)
                <span>{{ $item['name'] }}</span>
            @else
                <a href="{{ $item['url'] }}">{{ $item['name'] }}</a>
            @endif
        @endforeach
    </nav>
@endif
