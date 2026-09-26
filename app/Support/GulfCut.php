<?php

namespace App\Support;

class GulfCut
{
    public const PHONE_DISPLAY = '+971 50 596 2816';

    public const PHONE_TEL = '+971505962816';

    public const EMAIL = 'info@gulfcut.ae';

    public const ADDRESS = 'Al Qouz Fourth - Al Quoz - Dubai - United Arab Emirates';

    public const SITE = 'https://gulfcut.ae';

    public const VISIT = 'Dubai, Sharjah, Ajman, Abu Dhabi, United Arab Emirates';

    public static function logo(): string
    {
        return asset('images/cropped-logogulf-removebg-preview.png');
    }

    public static function img(?string $src, string $fallback = 'Concrete-wall-saw-cutting.jpeg'): string
    {
        $name = $fallback;
        if ($src) {
            $base = basename(parse_url($src, PHP_URL_PATH) ?: $src);
            $base = urldecode($base);
            if (is_file(public_path('images/'.$base))) {
                $name = $base;
            }
        }

        return asset('images/'.$name);
    }

    public static function href(string $href): string
    {
        $href = trim(html_entity_decode($href));
        if ($href === '' || $href === '#') {
            return route('contact');
        }

        $path = parse_url($href, PHP_URL_PATH);
        if (! is_string($path) || $path === '') {
            return route('contact');
        }

        $path = '/'.trim($path, '/');

        return $path === '/' ? route('home') : url($path);
    }

    /** @return array<int, array{label: string, slug: string}> */
    public static function menu(): array
    {
        return [
            ['label' => 'Wall Saw Cutting', 'slug' => 'wall-saw-cutting'],
            ['label' => 'Floor Saw Cutting', 'slug' => 'floor-saw-cutting'],
            ['label' => 'Core Cutting', 'slug' => 'core-cutting'],
            ['label' => 'Concrete Scanning', 'slug' => 'concrete-scanning'],
            ['label' => 'Wire Saw Cutting', 'slug' => 'wire-saw-cutting'],
            ['label' => 'Concrete Slab 3d Scanning', 'slug' => 'concrete-slab-3d-scanning'],
            ['label' => 'Concrete Slab Core Cutting', 'slug' => 'concrete-slab-core-cutting'],
            ['label' => 'Concrete Staircase Demolition', 'slug' => 'concrete-staircase-demolition'],
            ['label' => 'Concrete Slab Demolition', 'slug' => 'concrete-slab-demolition'],
            ['label' => 'Concrete Wall Core Cutting', 'slug' => 'concrete-wall-core-cutting'],
            ['label' => 'Concrete Demolition', 'slug' => 'concrete-demolition'],
            ['label' => 'Concrete Beam Cutting', 'slug' => 'concrete-beam-cutting'],
            ['label' => 'Concrete Demolition Services in UAE', 'slug' => 'concrete-demolition-services-uae'],
            ['label' => 'Core Cutting Services UAE', 'slug' => 'core-cutting-services-uae'],
            ['label' => 'Concrete Cutting Services UAE', 'slug' => 'concrete-cutting-services-uae'],
        ];
    }

    /** @return array<string, string> */
    public static function titles(): array
    {
        return [
            'home' => 'Concrete Cutting Dubai & UAE | Gulf Cut 0505962816',
            'about-us' => 'About Gulf Cut | Concrete Cutting Company UAE',
            'our-services' => 'Our Services | Gulf Cut UAE',
            'contact-us' => 'Contact Gulf Cut | Concrete Cutting UAE',
            'wall-saw-cutting' => 'Concrete Wall Saw Cutting Services in UAE | Gulf Cut UAE',
            'floor-saw-cutting' => 'Floor Saw Cutting Services UAE | Gulf Cut',
            'core-cutting' => 'Diamond Core Drilling Services UAE | Gulf Cut',
            'concrete-scanning' => 'Concrete Scanning Services UAE | GPR | Gulf Cut',
            'wire-saw-cutting' => 'Wire Saw Cutting Services UAE | Gulf Cut',
            'concrete-slab-3d-scanning' => 'Concrete Slab 3D Scanning UAE | Gulf Cut',
            'concrete-slab-core-cutting' => 'Concrete Slab Core Cutting Services UAE | Gulf Cut',
            'concrete-staircase-demolition' => 'Concrete Staircase Demolition UAE | Gulf Cut',
            'concrete-slab-demolition' => 'Concrete Slab Demolition Services UAE | Gulf Cut',
            'concrete-wall-core-cutting' => 'Concrete Wall Core Cutting Services UAE | Gulf Cut',
            'concrete-demolition' => 'Concrete Demolition Services UAE | Gulf Cut',
            'concrete-beam-cutting' => 'Concrete Beam Cutting Services UAE | Gulf Cut',
            'concrete-beam-core-cutting' => 'Concrete Beam Core Cutting Dubai | Diamond Drilling UAE',
            'concrete-demolition-services-uae' => 'Concrete Demolition Company in UAE | Gulf Cut',
            'core-cutting-services-uae' => 'Core Cutting Services in UAE | Diamond Drilling',
            'concrete-cutting-services-uae' => 'Concrete Cutting Services in UAE | Gulf Cut',
        ];
    }

    /** @return array<string, string> */
    public static function descriptions(): array
    {
        return [
            'home' => 'Gulf Cut provides concrete cutting, core drilling, wall sawing, wire sawing and demolition across Dubai and the UAE. Call 050 596 2816.',
            'about-us' => 'About Gulf Cut, a concrete cutting and demolition company in the UAE. Wall saws, core drilling and controlled demolition for contractors.',
            'our-services' => 'Concrete cutting services in the UAE: wall saw, floor saw, core drilling, wire saw, scanning and demolition by Gulf Cut.',
            'contact-us' => 'Contact Gulf Cut in Al Quoz, Dubai for concrete cutting, core drilling and demolition across the UAE. Call +971 50 596 2816.',
            'wall-saw-cutting' => 'Concrete wall saw cutting in Dubai and the UAE for doors, windows, lift openings and structural wall modifications. Gulf Cut.',
            'floor-saw-cutting' => 'Floor saw cutting in the UAE for roads, warehouses, industrial floors, trenches and expansion joints. Gulf Cut.',
            'core-cutting' => 'Diamond core drilling in the UAE for plumbing, electrical, HVAC and fire-protection openings in reinforced concrete. Gulf Cut.',
            'concrete-scanning' => 'Concrete scanning in the UAE to locate rebar, conduits, pipes and post-tension cables before cutting or drilling. Gulf Cut.',
            'wire-saw-cutting' => 'Wire saw cutting in the UAE for thick, heavily reinforced concrete, beams, bridges and large structures. Gulf Cut.',
            'concrete-slab-3d-scanning' => 'Concrete slab 3D scanning in the UAE to map rebar and embedded services before core drilling or cutting. Gulf Cut.',
            'concrete-slab-core-cutting' => 'Concrete slab core cutting in the UAE for plumbing, electrical and HVAC openings without damaging the surrounding slab. Gulf Cut.',
            'concrete-staircase-demolition' => 'Concrete staircase demolition in the UAE with controlled removal and minimal disruption to nearby structures. Gulf Cut.',
            'concrete-slab-demolition' => 'Concrete slab demolition in Dubai and the UAE for buildings, factories, warehouses and infrastructure. Gulf Cut.',
            'concrete-wall-core-cutting' => 'Concrete wall core cutting in the UAE for ducts, pipes and utility openings in reinforced walls. Gulf Cut.',
            'concrete-demolition' => 'Controlled concrete demolition in the UAE for slabs, walls, staircases, beams and columns. Gulf Cut.',
            'concrete-beam-cutting' => 'Concrete beam cutting in the UAE for structural modifications, renovations and construction upgrades. Gulf Cut.',
            'concrete-beam-core-cutting' => 'Concrete beam core cutting and diamond drilling in Dubai and the UAE, done with structural care. Gulf Cut.',
            'concrete-demolition-services-uae' => 'Concrete demolition company in the UAE for residential, commercial and industrial structures. Safe, controlled removal by Gulf Cut.',
            'core-cutting-services-uae' => 'Core cutting services across the UAE. Diamond drilling through slabs, walls and beams for MEP openings. Gulf Cut.',
            'concrete-cutting-services-uae' => 'Concrete cutting services across Dubai, Abu Dhabi, Sharjah and the UAE. Wall saw, slab, floor and wire saw cutting by Gulf Cut.',
        ];
    }

    public static function description(string $key): string
    {
        return self::descriptions()[$key] ?? self::descriptions()['home'];
    }

    public static function canonical(?string $path = null): string
    {
        $path = $path ?? '/'.ltrim(request()->path(), '/');
        if ($path === '/' || $path === '') {
            return self::SITE.'/';
        }

        return self::SITE.'/'.trim($path, '/');
    }

    public static function absoluteImage(string $file): string
    {
        return self::SITE.'/images/'.ltrim($file, '/');
    }

    public static function schema(): string
    {
        return json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => 'Gulf Cut UAE',
            'url' => self::SITE.'/',
            'image' => self::absoluteImage('cropped-logogulf-removebg-preview.png'),
            'logo' => self::absoluteImage('cropped-logogulf-removebg-preview.png'),
            'telephone' => self::PHONE_TEL,
            'email' => self::EMAIL,
            'description' => self::description('home'),
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Al Qouz Fourth, Al Quoz',
                'addressLocality' => 'Dubai',
                'addressCountry' => 'AE',
            ],
            'areaServed' => ['Dubai', 'Abu Dhabi', 'Sharjah', 'Ajman', 'Ras Al Khaimah', 'Fujairah', 'Umm Al Quwain', 'Al Ain'],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /** @return array<int, array<string, mixed>> */
    public static function widgets(string $slug): array
    {
        $all = self::allWidgets();

        return $all[$slug] ?? [];
    }

    /** @return array<string, array<int, array<string, mixed>>> */
    public static function allWidgets(): array
    {
        static $all;

        if ($all === null) {
            $all = json_decode((string) file_get_contents(resource_path('data/widgets.json')), true) ?: [];
        }

        return $all;
    }

    /** @return array<int, array{title: string, text: string, image: string, slug: string}> */
    public static function directory(): array
    {
        return [
            ['title' => 'Concrete Slab Core Cutting', 'text' => 'Precise concrete slab core cutting services for plumbing, electrical, HVAC, and structural applications. We create accurate openings without damaging surrounding structures.', 'image' => 'Concrete-slab-core-cutting.jpeg', 'slug' => 'concrete-slab-core-cutting'],
            ['title' => 'Concrete Floor Demolition', 'text' => 'Efficient concrete floor demolition services for renovation, reconstruction, and industrial projects using modern demolition equipment.', 'image' => 'Concrete-floor-Demolition.jpeg', 'slug' => 'floor-saw-cutting'],
            ['title' => 'Concrete Wire Saw Cutting', 'text' => 'Heavy-duty wire saw cutting solutions for large concrete structures, bridges, beams, and thick reinforced concrete sections.', 'image' => 'Concrete-wire-saw-cutting.jpeg', 'slug' => 'wire-saw-cutting'],
            ['title' => 'Concrete Wall Core Cutting', 'text' => 'Accurate wall core cutting solutions for utility installation, duct openings, and structural modifications.', 'image' => 'Concrete-wall-core-cutting.jpeg', 'slug' => 'concrete-wall-core-cutting'],
            ['title' => 'Concrete Beam Core Cutting', 'text' => 'Specialized beam core cutting services performed with precision to maintain structural integrity and project safety.', 'image' => 'Concrete-beam-core-cutting.jpeg', 'slug' => 'concrete-beam-core-cutting'],
            ['title' => 'Concrete Floor Cutting', 'text' => 'Advanced floor cutting services for expansion joints, trench cutting, repair works, and industrial flooring applications.', 'image' => 'Concrete-floor-cutting.jpeg', 'slug' => 'floor-saw-cutting'],
            ['title' => 'Concrete Demolition Services', 'text' => 'Complete concrete demolition solutions for residential, commercial, and industrial structures using safe and efficient techniques.', 'image' => 'Concrete-Demolition-Services.jpeg', 'slug' => 'concrete-demolition'],
            ['title' => 'Concrete Beam Cutting', 'text' => 'Professional concrete beam cutting services for structural modifications, renovations, and construction upgrades.', 'image' => 'Concrete-beam-cutting.jpeg', 'slug' => 'concrete-beam-cutting'],
            ['title' => 'Concrete Slab 3D Scanning', 'text' => 'High-precision 3D concrete scanning services to detect hidden utilities, rebars, and embedded systems before cutting or drilling.', 'image' => 'Concrete-slab-3d-scanning.jpeg', 'slug' => 'concrete-slab-3d-scanning'],
            ['title' => 'Concrete Wall Saw Cutting', 'text' => 'Powerful wall saw cutting services for doors, windows, lift openings, and structural wall modifications with clean finishing.', 'image' => 'Concrete-wall-saw-cutting.jpeg', 'slug' => 'wall-saw-cutting'],
            ['title' => 'Concrete Staircase Cutting', 'text' => 'Professional staircase cutting services for residential and commercial construction projects with clean and accurate results.', 'image' => 'Concrete-staircase-cutting.jpeg', 'slug' => 'concrete-staircase-demolition'],
            ['title' => 'Concrete Staircase Demolition', 'text' => 'Safe staircase demolition services with controlled removal techniques to protect nearby structures and ensure site safety.', 'image' => 'Concrete-staircase-Demolition.jpeg', 'slug' => 'concrete-staircase-demolition'],
            ['title' => 'Concrete Slab Demolition', 'text' => 'Reliable concrete slab demolition for buildings, factories, warehouses, and infrastructure projects with minimal disruption.', 'image' => 'Concrete-slab-Demolition.jpeg', 'slug' => 'concrete-slab-demolition'],
            ['title' => 'Concrete Cutting Services UAE', 'text' => 'Professional concrete cutting services across the UAE for residential, commercial, and industrial projects, using advanced diamond cutting equipment.', 'image' => 'Concrete-staircase-cutting.jpeg', 'slug' => 'concrete-cutting-services-uae'],
            ['title' => 'Core Cutting Services UAE', 'text' => 'Diamond core drilling for slabs, walls, and beams, creating accurate openings for plumbing, electrical, HVAC, and fire protection.', 'image' => 'Concrete_Core_Cutting.png', 'slug' => 'core-cutting-services-uae'],
            ['title' => 'Concrete Demolition Services in UAE', 'text' => 'Controlled concrete demolition for slabs, walls, staircases, beams, and structural elements, with strict safety procedures.', 'image' => 'ConcreteDemolitionServices.jpeg', 'slug' => 'concrete-demolition-services-uae'],
        ];
    }

    /** @return array<int, array{n: string, title: string, text: string, slug: string, image: string}> */
    public static function featured(): array
    {
        return [
            ['n' => '01', 'title' => 'Concrete Cutting Services', 'text' => 'We provide precise concrete cutting solutions for walls, floors, slabs, beams, and structural modifications using advanced diamond cutting technology. Our methods ensure clean cuts, reduced vibration, and maximum safety.', 'slug' => 'concrete-cutting-services-uae', 'image' => 'Concrete-wall-saw-cutting.jpeg'],
            ['n' => '02', 'title' => 'Core Cutting & Diamond Drilling', 'text' => 'Our core cutting services create accurate circular openings in reinforced concrete for plumbing, electrical, HVAC, and fire protection systems. Diamond core drilling delivers smooth, precise results with minimal dust and noise.', 'slug' => 'core-cutting', 'image' => 'Concrete-slab-core-cutting.jpeg'],
            ['n' => '03', 'title' => 'Wall Saw Cutting', 'text' => 'Wall saw cutting is ideal for creating door openings, windows, lift shafts, and structural modifications in reinforced concrete walls. Our advanced equipment guarantees accurate and controlled cutting.', 'slug' => 'wall-saw-cutting', 'image' => 'Concrete-wall-saw-cutting.jpeg'],
            ['n' => '04', 'title' => 'Slab Cutting', 'text' => 'We perform professional slab cutting for residential, commercial, and industrial construction projects. Our team safely cuts concrete floors, suspended slabs, bridge decks, and foundations.', 'slug' => 'concrete-slab-core-cutting', 'image' => 'Concrete-slab-Demolition.jpeg'],
            ['n' => '05', 'title' => 'Floor Saw Cutting', 'text' => 'Our floor sawing services are used for roads, warehouses, industrial floors, parking areas, and expansion joints. We ensure straight, accurate cuts for every application.', 'slug' => 'floor-saw-cutting', 'image' => 'Concrete-floor-cutting.jpeg'],
            ['n' => '06', 'title' => 'Wire Saw Cutting', 'text' => 'Wire saw cutting is the ideal solution for large or heavily reinforced concrete structures where conventional cutting methods are not suitable. This technique provides precision and flexibility for complex projects.', 'slug' => 'wire-saw-cutting', 'image' => 'Concrete-wire-saw-cutting.jpeg'],
            ['n' => '07', 'title' => 'Concrete Demolition', 'text' => 'We specialize in controlled concrete demolition, including slabs, walls, staircases, beams, columns, and structural elements. Our team follows strict safety procedures while minimizing disruption to nearby structures.', 'slug' => 'concrete-demolition', 'image' => 'ConcreteDemolitionServices.jpeg'],
            ['n' => '08', 'title' => 'Concrete Scanning', 'text' => 'Before cutting or drilling, our concrete scanning services help locate embedded reinforcement, electrical conduits, pipes, and post-tension cables, reducing the risk of accidental damage.', 'slug' => 'concrete-scanning', 'image' => 'Concrete-slab-3d-scanning.jpeg'],
        ];
    }

    /** @return array<string, mixed>|null */
    public static function compose(string $slug): ?array
    {
        if (! isset(self::titles()[$slug]) || in_array($slug, ['home', 'about-us', 'our-services', 'contact-us'], true)) {
            return null;
        }

        $groups = self::groups($slug);
        if ($groups === []) {
            return null;
        }

        $hero = [
            'kicker' => 'Gulf Cut UAE',
            'heading' => self::titles()[$slug],
            'lead' => '',
            'paragraphs' => [],
            'image' => self::img(null),
        ];

        $rest = [];
        $closed = false;
        foreach ($groups as $group) {
            if (! $closed && ! self::isSectionTitle($group['title'])) {
                if ($group['title'] !== '' && ! preg_match('/^(about us|services|contact)$/i', $group['title'])) {
                    if (strlen($group['title']) < 32 && ! preg_match('/service|uae|dubai/i', $group['title'])) {
                        $hero['kicker'] = $group['title'];
                    } else {
                        $hero['heading'] = $group['title'];
                    }
                }
                foreach ($group['parts'] as $part) {
                    if ($part['type'] === 'text' && strlen($part['text']) > 30) {
                        if ($hero['lead'] === '') {
                            $hero['lead'] = $part['text'];
                        } else {
                            $hero['paragraphs'][] = $part['text'];
                        }
                    }
                    if ($part['type'] === 'image') {
                        $hero['image'] = self::img($part['src']);
                    }
                }
                continue;
            }
            $closed = true;
            $rest[] = $group;
        }

        $sections = [];
        $count = count($rest);
        for ($i = 0; $i < $count; $i++) {
            $group = $rest[$i];
            if (preg_match('/project with us/i', $group['title']) && isset($rest[$i + 1]) && preg_match('/30%/i', $rest[$i + 1]['title'])) {
                $group['title'] = $group['title'].' '.$rest[$i + 1]['title'];
                $group['parts'] = array_merge($group['parts'], $rest[$i + 1]['parts']);
                $i++;
            }

            $section = self::makeSection($group);
            if ($section === null) {
                continue;
            }

            if ($section['kind'] === 'cities') {
                while (isset($rest[$i + 1]) && $rest[$i + 1]['parts'] === [] && ! self::isSectionTitle($rest[$i + 1]['title']) && strlen($rest[$i + 1]['title']) < 40) {
                    $i++;
                    $section['items'][] = ['title' => $rest[$i]['title'], 'text' => '', 'image' => ''];
                }
            }

            $sections[] = $section;
        }

        return [
            'slug' => $slug,
            'title' => self::titles()[$slug],
            'hero' => $hero,
            'sections' => $sections,
        ];
    }

    /** @return array<int, array{title: string, parts: array<int, array<string, mixed>>}> */
    private static function groups(string $slug): array
    {
        $groups = [];
        $current = ['title' => '', 'parts' => []];

        foreach (self::widgets($slug) as $item) {
            if (($item['type'] ?? '') === 'icon' && preg_match('/contact us/i', (string) ($item['title'] ?? ''))) {
                continue;
            }
            if (($item['type'] ?? '') === 'text' && preg_match('/^Home\s*[–\-]/u', (string) ($item['text'] ?? ''))) {
                continue;
            }
            if (($item['type'] ?? '') === 'text' && preg_match('/lorem ipsum/i', (string) ($item['text'] ?? ''))) {
                continue;
            }
            if (($item['type'] ?? '') === 'heading') {
                if ($current['title'] !== '' || $current['parts'] !== []) {
                    $groups[] = $current;
                }
                $current = ['title' => $item['text'], 'parts' => []];
                continue;
            }
            $current['parts'][] = $item;
        }

        if ($current['title'] !== '' || $current['parts'] !== []) {
            $groups[] = $current;
        }

        return $groups;
    }

    private static function isSectionTitle(string $title): bool
    {
        return (bool) preg_match('/what we offer|key advantage|working system|more service|why choose|application|areas we serve|frequently|30%|project with us|schedule your|contact gulf|our concrete|why concrete|benefits of|who we work|specialized|how it works|what we do/i', $title);
    }

    /** @param  array{title: string, parts: array<int, array<string, mixed>>}  $group
     * @return array<string, mixed>|null
     */
    private static function makeSection(array $group): ?array
    {
        $title = trim($group['title']);
        if (preg_match('/electrical services/i', $title)) {
            $title = 'Get Safe, Reliable Concrete Cutting Services Now!';
        }
        if ($title === '' && $group['parts'] === []) {
            return null;
        }

        $items = [];
        $notes = [];
        $images = [];
        $buttons = [];

        foreach ($group['parts'] as $part) {
            if (in_array($part['type'], ['icon', 'imagebox'], true)) {
                $label = trim((string) ($part['title'] ?? ''));
                $text = trim((string) ($part['text'] ?? ''));
                if ($label === '' && $text === '') {
                    continue;
                }
                $items[] = [
                    'title' => $label !== '' ? $label : $text,
                    'text' => $label !== '' ? $text : '',
                    'image' => ! empty($part['src']) ? self::img($part['src']) : '',
                ];
            } elseif ($part['type'] === 'list') {
                foreach ($part['items'] as $line) {
                    $items[] = ['title' => $line, 'text' => '', 'image' => ''];
                }
            } elseif ($part['type'] === 'text') {
                $notes[] = $part['text'];
            } elseif ($part['type'] === 'image') {
                $images[] = self::img($part['src']);
            } elseif ($part['type'] === 'button') {
                $buttons[] = [
                    'title' => str_replace(['Demolation', 'Concreate'], ['Demolition', 'Concrete'], $part['text']),
                    'text' => '',
                    'image' => '',
                    'href' => self::href((string) ($part['href'] ?? '')),
                ];
            }
        }

        $kind = 'prose';
        $t = strtolower($title);
        if (str_contains($t, '30%') || str_contains($t, 'project with us')) {
            $kind = 'promo';
        } elseif (str_contains($t, 'more service') || ($buttons !== [] && $items === [] && $notes === [])) {
            $kind = 'related';
            $items = $buttons;
        } elseif (str_contains($t, 'schedule your') || str_contains($t, 'contact gulf')) {
            $kind = 'cta';
        } elseif (str_contains($t, 'areas we serve')) {
            $kind = 'cities';
        } elseif (str_contains($t, 'working system') || str_contains($t, 'working process')) {
            $kind = 'steps';
        } elseif ($items !== [] && self::itemsLookLikeList($items)) {
            $kind = 'checks';
        } elseif ($items !== []) {
            $kind = 'cards';
        }

        if ($kind === 'prose' && $notes === [] && $images === [] && $items === []) {
            return null;
        }
        if ($kind === 'cta' && $notes === [] && $buttons === []) {
            $buttons[] = ['title' => 'Set Your Schedule', 'href' => route('contact')];
        }

        return [
            'kind' => $kind,
            'title' => $title,
            'items' => $kind === 'related' ? $items : ($kind === 'cta' ? $buttons : $items),
            'notes' => $notes,
            'images' => $images,
        ];
    }

    /** @param  array<int, array<string, mixed>>  $items */
    private static function itemsLookLikeList(array $items): bool
    {
        foreach ($items as $item) {
            if (($item['text'] ?? '') !== '' || ($item['image'] ?? '') !== '') {
                return false;
            }
        }

        return true;
    }
}
