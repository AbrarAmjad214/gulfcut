{{-- Topic-cluster links for a service page. Pass 'slug'. --}}
@php
    $g = \App\Support\GulfCut::class;
    $cluster = $g::cluster($slug);
    $topic = strtolower($cluster['title']);
@endphp
<section class="section related-hub">
    <div class="wrap">
        <div class="section-head split-head">
            <div>
                <p class="eyebrow">Keep exploring</p>
                <h2>More on {{ $topic === 'concrete' ? 'concrete cutting' : $topic }}</h2>
            </div>
            <p>Related services, site guides and finished jobs from Gulf Cut in Dubai and across the UAE.</p>
        </div>
        <div class="hub-grid">
            <nav class="hub-col" aria-label="Related services">
                <h3>Related services</h3>
                <ul>
                    @foreach ($cluster['services'] as $item)
                        <li><a href="{{ url($item['slug']) }}">{{ $item['label'] }}</a></li>
                    @endforeach
                </ul>
                <a class="more" href="{{ route('services') }}">All concrete cutting services →</a>
            </nav>
            <div class="hub-col">
                <h3>Guides</h3>
                <ul>
                    @foreach ($cluster['posts'] as $post)
                        <li><a href="{{ url('blog/'.$post['slug']) }}">{{ $post['h1'] }}</a><span>{{ $post['category'] }}</span></li>
                    @endforeach
                </ul>
                <a class="more" href="{{ route('blog') }}">All guides →</a>
            </div>
            <div class="hub-col">
                <h3>Projects</h3>
                <ul>
                    @foreach ($cluster['projects'] as $project)
                        <li><a href="{{ url('projects/'.$project['slug']) }}">{{ $project['h1'] }}</a><span>{{ $project['location'] }}</span></li>
                    @endforeach
                </ul>
                <a class="more" href="{{ route('projects') }}">All projects →</a>
            </div>
        </div>
    </div>
</section>
