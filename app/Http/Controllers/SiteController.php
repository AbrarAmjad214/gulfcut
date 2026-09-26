<?php

namespace App\Http\Controllers;

use App\Support\GulfCut;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function home(): View
    {
        return view('home', [
            'title' => GulfCut::titles()['home'],
            'description' => GulfCut::description('home'),
            'ogImage' => 'Concrete-wall-saw-cutting.jpeg',
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
            'ogImage' => 'Concrete-wall-saw-cutting.jpeg',
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
        ]);
    }

    public function show(string $slug): View
    {
        $page = GulfCut::compose($slug);
        abort_if($page === null, 404);

        $heroFile = basename((string) parse_url($page['hero']['image'], PHP_URL_PATH));

        return view('page', [
            'page' => $page,
            'title' => $page['title'],
            'description' => GulfCut::description($slug),
            'ogImage' => $heroFile,
        ]);
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['required', 'string', 'max:40'],
            'address' => ['nullable', 'string', 'max:200'],
            'service' => ['nullable', 'string', 'max:80'],
        ]);

        return back()->with('sent', true);
    }
}
