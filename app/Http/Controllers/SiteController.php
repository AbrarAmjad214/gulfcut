<?php

namespace App\Http\Controllers;

use App\Support\Blog;
use App\Support\GulfCut;
use App\Support\Projects;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function home(): View
    {
        return view('home', [
            'title' => GulfCut::titles()['home'],
            'description' => GulfCut::description('home'),
            'ogImage' => GulfCut::OG_IMAGE,
        ]);
    }

    public function about(): View
    {
        $paragraphs = [];
        $offers = [];
        $team = [];
        $photo = null;
        $pendingPhoto = null;

        foreach (GulfCut::widgets('about-us') as $item) {
            if ($item['type'] === 'text' && strlen($item['text']) > 80 && ! preg_match('/lorem ipsum/i', $item['text'])) {
                $paragraphs[] = $item['text'];
            }
            if ($item['type'] === 'image' && $photo === null) {
                $photo = GulfCut::img($item['src']);
            }
            if ($item['type'] === 'imagebox' && ($item['src'] ?? '') !== '') {
                $offers[] = $item;
            }
            if ($item['type'] === 'image' && $photo !== null) {
                $pendingPhoto = GulfCut::img($item['src']);
            }
            if ($item['type'] === 'imagebox' && ($item['src'] ?? '') === '' && isset($pendingPhoto)) {
                $team[] = [
                    'name' => $item['title'],
                    'role' => $item['text'],
                    'image' => $pendingPhoto,
                ];
                unset($pendingPhoto);
            }
        }

        return view('about', [
            'title' => GulfCut::titles()['about-us'],
            'description' => GulfCut::description('about-us'),
            'ogImage' => GulfCut::OG_IMAGE,
            'paragraphs' => $paragraphs,
            'offers' => $offers,
            'team' => $team,
            'photo' => $photo,
        ]);
    }

    public function services(): View
    {
        return view('services', [
            'title' => GulfCut::titles()['our-services'],
            'description' => GulfCut::description('our-services'),
            'ogImage' => 'Concrete-wire-saw-cutting.jpeg',
        ]);
    }

    public function contact(): View
    {
        return view('contact', [
            'title' => GulfCut::titles()['contact-us'],
            'description' => GulfCut::description('contact-us'),
            'ogImage' => 'Concrete-floor-cutting.jpeg',
            'schema' => GulfCut::contactSchema(),
        ]);
    }

    public function contractor(): View
    {
        $description = 'Concrete cutting and demolition contractor in Dubai and the UAE. Gulf Cut wall-saws reinforced concrete, then removes the cut panels. Call +971 50 596 2816.';

        return view('contractor', [
            'title' => 'Concrete Cutting & Demolition Contractor | Gulf Cut',
            'description' => $description,
            'ogImage' => GulfCut::OG_IMAGE,
            'schema' => GulfCut::serviceSchema('Concrete cutting and demolition contractor', $description, '/concrete-cutting-wall-saw-demolition-contractor', 'Concrete-wall-saw-cutting.jpeg'),
        ]);
    }

    public function projects(): View
    {
        return view('projects.index', [
            'title' => 'Concrete Cutting Projects UAE | Gulf Cut',
            'description' => 'Gulf Cut project photos: wall saw openings, floor sawing, slab core drilling, wire sawing, staircase removal and slab scanning in Dubai and the UAE.',
            'ogImage' => 'Concrete-beam-cutting.jpeg',
            'projects' => Projects::all(),
        ]);
    }

    public function project(string $slug): View
    {
        $project = Projects::find($slug);
        abort_if($project === null, 404);

        return view('projects.show', [
            'title' => $project['title'],
            'description' => $project['description'],
            'ogImage' => $project['image'],
            'project' => $project,
            'related' => Projects::related($slug),
            'schema' => Projects::schema($project),
        ]);
    }

    public function blog(): View
    {
        return view('blog.index', [
            'title' => 'Concrete Cutting Blog UAE | Gulf Cut',
            'description' => 'Guides on concrete cutting, core drilling, wall sawing, wire sawing, scanning and demolition in Dubai and the UAE by Gulf Cut.',
            'ogImage' => GulfCut::OG_IMAGE,
            'posts' => Blog::all(),
            'schema' => Blog::indexSchema(),
        ]);
    }

    public function post(string $slug): View
    {
        $post = Blog::find($slug);
        abort_if($post === null, 404);

        return view('blog.show', [
            'title' => $post['title'],
            'description' => $post['description'],
            'ogImage' => $post['image'],
            'ogType' => 'article',
            'published' => $post['date'],
            'modified' => $post['updated'] ?? $post['date'],
            'post' => $post,
            'related' => Blog::related($slug),
            'schema' => Blog::postSchema($post),
        ]);
    }

    public function show(string $slug): View
    {
        $page = GulfCut::compose($slug);
        abort_if($page === null, 404);

        $heroFile = basename((string) parse_url($page['hero']['image'], PHP_URL_PATH));

        $description = GulfCut::description($slug);
        $label = data_get(collect(GulfCut::menu())->firstWhere('slug', $slug), 'label', $page['hero']['heading']);

        return view('page', [
            'page' => $page,
            'title' => $page['title'],
            'description' => $description,
            'ogImage' => $heroFile,
            'preset' => $label,
            'schema' => GulfCut::serviceSchema($label, $description, '/'.$slug, $heroFile),
        ]);
    }

    public function sitemap(): Response
    {
        $stamp = fn (string $file) => date('Y-m-d', (int) filemtime($file));
        $views = fn (string $view) => $stamp(resource_path('views/'.$view.'.blade.php'));
        $widgets = $stamp(resource_path('data/widgets.json'));
        $layout = $views('layouts/site');
        $latest = fn (string ...$dates) => max($dates);

        $urls = [
            ['/', $latest($views('home'), $layout)],
            ['/about-us', $latest($views('about'), $widgets)],
            ['/our-services', $latest($views('services'), $layout)],
            ['/contact-us', $latest($views('contact'), $layout)],
            ['/concrete-cutting-wall-saw-demolition-contractor', $views('contractor')],
            ['/blog', max(array_column(Blog::all(), 'updated'))],
        ];
        foreach (Blog::all() as $post) {
            $urls[] = ['/blog/'.$post['slug'], $post['updated'] ?? $post['date']];
        }
        $urls[] = ['/projects', Projects::date()];
        foreach (Projects::all() as $project) {
            $urls[] = ['/projects/'.$project['slug'], $project['updated'] ?? $project['date'] ?? Projects::date()];
        }
        foreach (GulfCut::servicePages() as $slug) {
            $urls[] = ['/'.$slug, $latest($widgets, $views('page'))];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n".'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
        foreach ($urls as [$path, $date]) {
            $xml .= '    <url><loc>'.e(GulfCut::canonical($path)).'</loc><lastmod>'.e($date).'</lastmod></url>'."\n";
        }
        $xml .= '</urlset>'."\n";

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['required', 'string', 'max:40'],
            'address' => ['nullable', 'string', 'max:200'],
            'service' => ['nullable', 'string', 'max:160'],
            'details' => ['nullable', 'string', 'max:1000'],
            'page' => ['nullable', 'string', 'max:200'],
            'website' => ['nullable', 'string', 'max:200'],
        ]);

        if (! empty($data['website'])) {
            return redirect()->route('thanks');
        }

        $body = '<h2>New Gulf Cut quote</h2>'
            .'<p><strong>Name:</strong> '.e($data['name']).'</p>'
            .'<p><strong>Email:</strong> '.e($data['email']).'</p>'
            .'<p><strong>Phone:</strong> '.e($data['phone']).'</p>'
            .'<p><strong>Address:</strong> '.e($data['address'] ?? '').'</p>'
            .'<p><strong>Service:</strong> '.e($data['service'] ?? '').'</p>'
            .'<p><strong>Page:</strong> '.e($data['page'] ?? url()->previous()).'</p>'
            .'<p><strong>Details:</strong><br>'.nl2br(e($data['details'] ?? '')).'</p>';

        try {
            $name = str_replace(["\r", "\n"], '', $data['name']);
            Mail::html($body, function ($message) use ($data, $name) {
                $message->to(GulfCut::EMAIL)
                    ->replyTo($data['email'], $name)
                    ->subject('Quote request from '.$name);
            });
        } catch (\Throwable $e) {
            report($e);

            return back()->withInput()->with('mail_error', true)->withFragment('quote');
        }

        return redirect()->route('thanks')->with('lead_name', $name);
    }

    public function thanks(): View
    {
        return view('thanks', [
            'title' => 'Thank You | Gulf Cut',
            'description' => 'Gulf Cut received your quote request and will contact you shortly.',
            'noindex' => true,
            'name' => session('lead_name'),
        ]);
    }
}
