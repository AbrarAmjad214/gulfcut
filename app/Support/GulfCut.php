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

    public const WHATSAPP = 'https://wa.me/971505962816';

    public const LOGO_FILE = 'cropped-logogulf-removebg-preview.png';

    public const OG_IMAGE = 'og-gulfcut.jpg';

    /** Google Business Profile: name exactly as listed, and the stable CID link to the listing. */
    public const GBP_NAME = 'Gulfcut Core & Concrete Cutting';

    public const GBP_URL = 'https://maps.google.com/?cid=1094418168651678183';

    /** Centre of the listing's map view (a service-area listing, so not a street address). */
    private const GBP_CENTER = '25.3199447,55.5462772';

    /** @var array<string, array{0: int, 1: int}|null> */
    private static array $sizes = [];

    /** @var array<string, string> */
    private static array $photos = [];

    public static function logo(): string
    {
        return asset('images/'.self::LOGO_FILE);
    }

    /** Link to the Google Business Profile (opens the listing with reviews and photos). */
    public static function mapUrl(): string
    {
        return self::GBP_URL;
    }

    /** Embeddable map of the Google Business Profile listing. */
    public static function mapEmbed(): string
    {
        return 'https://maps.google.com/maps?q='.rawurlencode(self::GBP_NAME).'&ll='.self::GBP_CENTER.'&z=10&output=embed';
    }

    /** @return array{0: int, 1: int}|null */
    public static function imageSize(string $file): ?array
    {
        $file = basename((string) (parse_url($file, PHP_URL_PATH) ?: $file));
        if (! array_key_exists($file, self::$sizes)) {
            $path = public_path('images/'.$file);
            $info = is_file($path) ? @getimagesize($path) : false;
            self::$sizes[$file] = $info ? [(int) $info[0], (int) $info[1]] : null;
        }

        return self::$sizes[$file];
    }

    /**
     * width/height, plus srcset when a 640px copy exists, for an <img> under /images.
     */
    public static function attrs(string $url, string $sizes = '(max-width: 760px) 100vw, 50vw'): string
    {
        $size = self::imageSize($url);
        if ($size === null) {
            return '';
        }

        $out = 'width="'.$size[0].'" height="'.$size[1].'"';
        $srcset = self::srcset($url);
        if ($srcset !== '') {
            $out .= ' srcset="'.e($srcset).'" sizes="'.e($sizes).'"';
        }

        return $out;
    }

    public static function srcset(string $url): string
    {
        $file = basename((string) (parse_url($url, PHP_URL_PATH) ?: $url));
        $size = self::imageSize($file);
        $small = preg_replace('/\.(jpe?g|png|webp)$/i', '-640.webp', $file);
        if ($size === null || $size[0] <= 700 || ! is_string($small) || ! is_file(public_path('images/'.$small))) {
            return '';
        }

        return asset('images/'.$small).' 640w, '.asset('images/'.$file).' '.$size[0].'w';
    }

    /** A <link rel="preload"> tag for the above-the-fold hero image. */
    public static function preload(string $url, string $sizes = '(max-width: 760px) 100vw, 50vw'): string
    {
        $tag = '<link rel="preload" as="image" href="'.e($url).'" fetchpriority="high"';
        $srcset = self::srcset($url);
        if ($srcset !== '') {
            $tag .= ' imagesrcset="'.e($srcset).'" imagesizes="'.e($sizes).'"';
        }

        return $tag.'>';
    }

    /** Small (640px) copy of an image if one exists, else the image itself. */
    public static function small(string $url): string
    {
        $file = basename((string) (parse_url($url, PHP_URL_PATH) ?: $url));
        $small = preg_replace('/\.(jpe?g|png|webp)$/i', '-640.webp', $file);

        return is_string($small) && is_file(public_path('images/'.$small)) ? asset('images/'.$small) : $url;
    }

    /** style="" attribute for a .page-hero background (small copy on phones). */
    public static function heroStyle(string $url): string
    {
        return 'style="'.e("--hero:url('".$url."');--hero-sm:url('".self::small($url)."')").'"';
    }

    /** Preload tags for a .page-hero background, matching the media query used in site.css. */
    public static function heroPreload(string $url): string
    {
        $small = self::small($url);
        if ($small === $url) {
            return '<link rel="preload" as="image" href="'.e($url).'" fetchpriority="high">';
        }

        return '<link rel="preload" as="image" href="'.e($small).'" media="(max-width: 760px)" fetchpriority="high">'
            .'<link rel="preload" as="image" href="'.e($url).'" media="(min-width: 761px)" fetchpriority="high">';
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

        return self::photo($name);
    }

    public static function photo(string $name): string
    {
        return self::$photos[$name] ??= self::resolvePhoto($name);
    }

    private static function resolvePhoto(string $name): string
    {
        $name = basename(str_replace('\\', '/', $name));
        $webp = preg_replace('/\.(jpe?g|png)$/i', '.webp', $name);
        $original = public_path('images/'.$name);
        $modern = public_path('images/'.$webp);
        if (is_string($webp) && $webp !== $name && is_file($modern) && (! is_file($original) || filesize($modern) < filesize($original))) {
            return asset('images/'.$webp);
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
        $path = [
            '/core-cutting' => '/core-cutting-services-uae',
            '/concrete-demolition' => '/concrete-demolition-services-uae',
        ][$path] ?? $path;

        return $path === '/' ? route('home') : url($path);
    }

    /** Most contextual keyword links added to one page. */
    public const MAX_AUTO_LINKS = 10;

    /** @var array<string, bool> targets already linked on this request */
    private static array $linked = [];

    private static int $linkCount = 0;

    /**
     * Target keyword(s) for each page. The first phrase is the page's primary keyword;
     * every phrase found in body copy elsewhere on the site links to that page once.
     *
     * @return array<string, array<int, string>>
     */
    public static function keywordMap(): array
    {
        return [
            'wall-saw-cutting' => ['wall saw cutting', 'wall sawing', 'concrete wall cutting', 'wall saw'],
            'floor-saw-cutting' => ['floor saw cutting', 'floor sawing', 'floor cutting', 'floor saw'],
            'wire-saw-cutting' => ['wire saw cutting', 'wire sawing', 'wire saw'],
            'concrete-beam-cutting' => ['concrete beam cutting', 'beam cutting'],
            'concrete-cutting-services-uae' => ['concrete cutting services', 'concrete cutting'],
            'core-cutting-services-uae' => ['core cutting services', 'diamond core drilling', 'core drilling', 'core cutting'],
            'concrete-slab-core-cutting' => ['slab core cutting', 'slab core drilling'],
            'concrete-wall-core-cutting' => ['wall core cutting', 'wall core drilling'],
            'concrete-beam-core-cutting' => ['beam core cutting', 'beam core drilling'],
            'concrete-scanning' => ['gpr concrete scanning', 'gpr scanning', 'concrete scanning', 'gpr'],
            'concrete-slab-3d-scanning' => ['slab 3d scanning', '3d scanning', 'slab scanning', 'slab scan'],
            'concrete-staircase-demolition' => ['staircase demolition', 'staircase removal', 'stair removal', 'staircase'],
            'concrete-slab-demolition' => ['slab demolition', 'floor demolition', 'slab removal'],
            'concrete-demolition-services-uae' => ['concrete demolition services', 'controlled demolition', 'concrete demolition'],
            'concrete-cutting-wall-saw-demolition-contractor' => ['cutting and demolition contractor', 'demolition contractor'],
        ];
    }

    /**
     * Escape plain copy and turn the first mention of each target keyword into an internal link.
     * Never links the current page, links each target once per page, stops at MAX_AUTO_LINKS.
     */
    public static function link(?string $text): string
    {
        $html = e((string) $text);
        if ($html === '' || self::$linkCount >= self::MAX_AUTO_LINKS) {
            return $html;
        }

        static $pattern = null;
        static $targets = [];
        if ($pattern === null) {
            foreach (self::keywordMap() as $slug => $phrases) {
                foreach ($phrases as $phrase) {
                    $targets[mb_strtolower($phrase)] = $slug;
                }
            }
            $phrases = array_keys($targets);
            usort($phrases, fn (string $a, string $b) => mb_strlen($b) <=> mb_strlen($a));
            $pattern = '/\b('.implode('|', array_map(fn (string $p) => preg_quote($p, '/'), $phrases)).')\b/iu';
        }

        $current = trim(request()->path(), '/');

        return (string) preg_replace_callback($pattern, function (array $m) use ($targets, $current) {
            $slug = $targets[mb_strtolower($m[1])] ?? null;
            if ($slug === null || $slug === $current || isset(self::$linked[$slug]) || self::$linkCount >= self::MAX_AUTO_LINKS) {
                return $m[0];
            }
            self::$linked[$slug] = true;
            self::$linkCount++;

            return '<a class="text-link" href="'.e(url($slug)).'">'.$m[0].'</a>';
        }, $html);
    }

    /** Display name for a service slug, from the mega menu. */
    public static function label(string $slug): string
    {
        foreach (self::megaMenu() as $column) {
            foreach ($column['sections'] as $group) {
                foreach ($group['items'] as $item) {
                    if ($item['slug'] === $slug) {
                        return $item['label'];
                    }
                }
            }
        }

        return ucwords(str_replace('-', ' ', $slug));
    }

    /**
     * Topic cluster for a service page: sibling services from the same mega-menu group
     * (padded with hub pages), plus the guides and projects written about that group.
     *
     * @return array{title: string, services: array<int, array{label: string, slug: string}>, posts: array<int, array<string, mixed>>, projects: array<int, array<string, mixed>>}
     */
    public static function cluster(string $slug): array
    {
        $title = 'Concrete';
        $slugs = [$slug];
        $services = [];
        foreach (self::megaMenu() as $column) {
            foreach ($column['sections'] as $group) {
                $groupSlugs = array_column($group['items'], 'slug');
                if (in_array($slug, $groupSlugs, true)) {
                    $title = $group['title'];
                    $slugs = $groupSlugs;
                    $services = array_values(array_filter($group['items'], fn (array $i) => $i['slug'] !== $slug));
                }
            }
        }

        // Pad small clusters with the hub pages, so every service links to at least four others.
        foreach (['concrete-scanning', 'concrete-slab-3d-scanning', 'concrete-cutting-services-uae', 'core-cutting-services-uae', 'concrete-demolition-services-uae', 'wall-saw-cutting'] as $hub) {
            if (count($services) >= 5) {
                break;
            }
            if ($hub !== $slug && ! in_array($hub, array_column($services, 'slug'), true)) {
                $services[] = ['label' => self::label($hub), 'slug' => $hub];
            }
        }

        $pick = function (array $items, int $limit) use ($slug, $slugs): array {
            $exact = array_filter($items, fn (array $i) => ($i['service'] ?? '') === $slug);
            $group = array_filter($items, fn (array $i) => in_array($i['service'] ?? '', $slugs, true) && ($i['service'] ?? '') !== $slug);
            $rest = array_values(array_filter($items, fn (array $i) => ! in_array($i['service'] ?? '', $slugs, true)));
            // Rotate the fallback list per page so links spread across all posts/projects.
            if ($rest !== []) {
                $shift = crc32($slug) % count($rest);
                $rest = array_merge(array_slice($rest, $shift), array_slice($rest, 0, $shift));
            }

            return array_slice(array_values(array_merge($exact, $group, $rest)), 0, $limit);
        };

        return [
            'title' => $title,
            'services' => $services,
            'posts' => $pick(Blog::all(), 3),
            'projects' => $pick(Projects::all(), 3),
        ];
    }

    /** Slugs served by the generic service page template (routes and sitemap use this list). */
    /** @return array<int, string> */
    public static function servicePages(): array
    {
        return [
            'wall-saw-cutting', 'floor-saw-cutting', 'concrete-scanning', 'wire-saw-cutting',
            'concrete-slab-3d-scanning', 'concrete-slab-core-cutting', 'concrete-staircase-demolition',
            'concrete-slab-demolition', 'concrete-wall-core-cutting', 'concrete-beam-cutting',
            'concrete-beam-core-cutting', 'concrete-demolition-services-uae', 'core-cutting-services-uae',
            'concrete-cutting-services-uae',
        ];
    }

    /** @return array<int, array{label: string, slug: string}> */
    public static function menu(): array
    {
        return [
            ['label' => 'Wall Saw Cutting', 'slug' => 'wall-saw-cutting'],
            ['label' => 'Floor Saw Cutting', 'slug' => 'floor-saw-cutting'],
            ['label' => 'Core Cutting', 'slug' => 'core-cutting-services-uae'],
            ['label' => 'GPR Concrete Scanning', 'slug' => 'concrete-scanning'],
            ['label' => 'Wire Saw Cutting', 'slug' => 'wire-saw-cutting'],
            ['label' => 'Concrete Slab 3d Scanning', 'slug' => 'concrete-slab-3d-scanning'],
            ['label' => 'Concrete Slab Core Cutting', 'slug' => 'concrete-slab-core-cutting'],
            ['label' => 'Concrete Staircase Demolition', 'slug' => 'concrete-staircase-demolition'],
            ['label' => 'Concrete Slab Demolition', 'slug' => 'concrete-slab-demolition'],
            ['label' => 'Concrete Wall Core Cutting', 'slug' => 'concrete-wall-core-cutting'],
            ['label' => 'Concrete Beam Cutting', 'slug' => 'concrete-beam-cutting'],
            ['label' => 'Demolition Services UAE', 'slug' => 'concrete-demolition-services-uae'],
            ['label' => 'Concrete Cutting Services UAE', 'slug' => 'concrete-cutting-services-uae'],
        ];
    }

    /** @return array<int, array{sections: array<int, array{title: string, items: array<int, array{label: string, slug: string}>}>}> */
    public static function megaMenu(): array
    {
        return [
            [
                'sections' => [
                    [
                        'title' => 'Cutting',
                        'items' => [
                            ['label' => 'Wall Saw Cutting', 'slug' => 'wall-saw-cutting'],
                            ['label' => 'Floor Saw Cutting', 'slug' => 'floor-saw-cutting'],
                            ['label' => 'Wire Saw Cutting', 'slug' => 'wire-saw-cutting'],
                            ['label' => 'Concrete Beam Cutting', 'slug' => 'concrete-beam-cutting'],
                            ['label' => 'Concrete Cutting Services UAE', 'slug' => 'concrete-cutting-services-uae'],
                        ],
                    ],
                ],
            ],
            [
                'sections' => [
                    [
                        'title' => 'Core drilling',
                        'items' => [
                            ['label' => 'Core Cutting', 'slug' => 'core-cutting-services-uae'],
                            ['label' => 'Slab Core Cutting', 'slug' => 'concrete-slab-core-cutting'],
                            ['label' => 'Wall Core Cutting', 'slug' => 'concrete-wall-core-cutting'],
                            ['label' => 'Beam Core Cutting', 'slug' => 'concrete-beam-core-cutting'],
                        ],
                    ],
                    [
                        'title' => 'Scanning',
                        'items' => [
                            ['label' => 'GPR Scanning', 'slug' => 'concrete-scanning'],
                            ['label' => 'Slab 3D Scanning', 'slug' => 'concrete-slab-3d-scanning'],
                        ],
                    ],
                ],
            ],
            [
                'sections' => [
                    [
                        'title' => 'Demolition',
                        'items' => [
                            ['label' => 'Staircase Demolition', 'slug' => 'concrete-staircase-demolition'],
                            ['label' => 'Slab Demolition', 'slug' => 'concrete-slab-demolition'],
                            ['label' => 'Demolition Services UAE', 'slug' => 'concrete-demolition-services-uae'],
                            ['label' => 'Cutting & Demolition Contractor', 'slug' => 'concrete-cutting-wall-saw-demolition-contractor'],
                        ],
                    ],
                ],
            ],
        ];
    }

    /** @return array<string, string> */
    public static function titles(): array
    {
        return [
            'home' => 'Concrete Cutting Company Dubai & UAE | Gulf Cut',
            'about-us' => 'About Gulf Cut | Concrete Cutting Company UAE',
            'our-services' => 'Concrete Cutting & Demolition Services | Gulf Cut',
            'contact-us' => 'Contact Gulf Cut | Concrete Cutting UAE',
            'wall-saw-cutting' => 'Concrete Wall Saw Cutting Services in UAE | Gulf Cut UAE',
            'floor-saw-cutting' => 'Floor Saw Cutting Services UAE | Gulf Cut',
            'concrete-scanning' => 'GPR Concrete Scanning Dubai & UAE | Gulf Cut',
            'wire-saw-cutting' => 'Wire Saw Cutting Services UAE | Gulf Cut',
            'concrete-slab-3d-scanning' => 'Slab 3D Scan Before Cutting UAE | Gulf Cut',
            'concrete-slab-core-cutting' => 'Concrete Slab Core Cutting Services UAE | Gulf Cut',
            'concrete-staircase-demolition' => 'Concrete Staircase Demolition UAE | Gulf Cut',
            'concrete-slab-demolition' => 'Concrete Slab Demolition Services UAE | Gulf Cut',
            'concrete-wall-core-cutting' => 'Concrete Wall Core Cutting Services UAE | Gulf Cut',
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
            'home' => 'Gulf Cut cuts, core-drills and removes reinforced concrete across Dubai and the UAE. Wall saws, floor saws, wire saws and demolition from Al Quoz.',
            'about-us' => 'Gulf Cut is a concrete cutting and demolition company in Al Quoz, Dubai. Wall saws, core drilling and controlled removal for contractors across the UAE.',
            'our-services' => 'Concrete cutting services across the UAE: wall saw, floor saw, core drilling, wire saw, GPR scanning, slab 3D scanning and controlled demolition by Gulf Cut.',
            'contact-us' => 'Contact Gulf Cut in Al Qouz Fourth, Al Quoz, Dubai for concrete cutting, core drilling and demolition across the UAE. Call +971 50 596 2816.',
            'wall-saw-cutting' => 'Concrete wall saw cutting in Dubai and the UAE for doors, windows, lift openings and structural wall changes. Gulf Cut tracks the cut and leaves a clean edge.',
            'floor-saw-cutting' => 'Floor saw cutting in Dubai and the UAE for warehouse slabs, trenches and joints. Gulf Cut leaves a straight edge and keeps the rest of the floor in use.',
            'concrete-scanning' => 'GPR concrete scanning in Dubai and the UAE. Gulf Cut locates rebar, conduits, pipes and post-tension cables in the concrete before a saw or a core drill starts.',
            'wire-saw-cutting' => 'Wire saw cutting in Dubai and the UAE for thick concrete and beams a track saw cannot reach. Gulf Cut loops the wire and keeps the cut on the line.',
            'concrete-slab-3d-scanning' => '3D scanning of concrete slabs in Dubai and the UAE before cutting or drilling. Gulf Cut maps rebar and services in the slab, then marks the clear lines.',
            'concrete-slab-core-cutting' => 'Concrete slab core cutting in Dubai and the UAE for plumbing, electrical and HVAC. Gulf Cut drills a round opening and leaves the surrounding slab intact.',
            'concrete-staircase-demolition' => 'Concrete staircase demolition in Dubai and the UAE. Gulf Cut cuts the flight into pieces, carries them out, and leaves the slab and walls standing.',
            'concrete-slab-demolition' => 'Concrete slab demolition in Dubai and the UAE for buildings, factories and warehouses. Gulf Cut saws the slab into panels and removes them safely.',
            'concrete-wall-core-cutting' => 'Concrete wall core cutting in Dubai and the UAE. Diamond drilling for ducts, pipes and cables through reinforced walls, leaving a round opening.',
            'concrete-beam-cutting' => 'Concrete beam cutting in Dubai and the UAE for structural changes. Gulf Cut saws the beam on the marked line and keeps the rest of the frame in place.',
            'concrete-beam-core-cutting' => 'Concrete beam core cutting in Dubai and the UAE. Diamond drilling through reinforced beams for pipes and cables, so the beam around the hole stays sound.',
            'concrete-demolition-services-uae' => 'Concrete demolition company in the UAE for homes, commercial buildings and industrial sites. Gulf Cut cuts slabs, walls and stairs, then removes the concrete.',
            'core-cutting-services-uae' => 'Core cutting services across Dubai and the UAE. Gulf Cut diamond-drills slabs, walls and beams for plumbing, electrical, HVAC and fire-protection openings.',
            'concrete-cutting-services-uae' => 'Concrete cutting across Dubai, Abu Dhabi, Sharjah and the UAE. Gulf Cut runs wall saws, floor saws and wire saws for openings and structural changes.',
        ];
    }

    public static function description(string $key): string
    {
        return self::descriptions()[$key] ?? self::descriptions()['home'];
    }

    public static function canonical(?string $path = null): string
    {
        $path = $path ?? request()->path();
        $path = parse_url($path, PHP_URL_PATH) ?: $path;
        $path = '/'.ltrim($path, '/');
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
            '@type' => 'HomeAndConstructionBusiness',
            '@id' => self::SITE.'/#business',
            'name' => 'Gulf Cut UAE',
            'url' => self::SITE.'/',
            'image' => self::absoluteImage(self::OG_IMAGE),
            'logo' => self::absoluteImage(self::LOGO_FILE),
            'telephone' => self::PHONE_TEL,
            'email' => self::EMAIL,
            'description' => self::description('home'),
            'hasMap' => self::mapUrl(),
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => self::PHONE_TEL,
                'email' => self::EMAIL,
                'contactType' => 'customer service',
                'areaServed' => 'AE',
                'availableLanguage' => ['English'],
            ],
            'knowsAbout' => array_column(self::menu(), 'label'),
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Al Qouz Fourth',
                'addressLocality' => 'Al Quoz',
                'addressRegion' => 'Dubai',
                'addressCountry' => 'AE',
            ],
            'areaServed' => array_map(fn (string $city) => [
                '@type' => 'City',
                'name' => $city,
            ], self::cities()),
        ] + self::sameAs(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /** @return array<int, string> */
    public static function cities(): array
    {
        return ['Dubai', 'Abu Dhabi', 'Sharjah', 'Ajman', 'Ras Al Khaimah', 'Fujairah', 'Umm Al Quwain', 'Al Ain'];
    }

    /** @return array<string, array<int, string>> */
    private static function sameAs(): array
    {
        $links = array_values(array_unique(array_filter(array_merge(
            [self::GBP_URL],
            (array) config('services.site.same_as', [])
        ))));

        return ['sameAs' => $links];
    }

    /** @return array<string, string> */
    private static function provider(): array
    {
        return [
            '@type' => 'HomeAndConstructionBusiness',
            '@id' => self::SITE.'/#business',
            'name' => 'Gulf Cut UAE',
            'url' => self::SITE.'/',
            'telephone' => self::PHONE_TEL,
        ];
    }

    public static function serviceSchema(string $name, string $description, string $path, string $image): string
    {
        return json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => $name,
            'serviceType' => $name,
            'description' => $description,
            'url' => self::canonical($path),
            'image' => self::absoluteImage($image),
            'provider' => self::provider(),
            'areaServed' => array_map(fn (string $city) => ['@type' => 'City', 'name' => $city], self::cities()),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    public static function contactSchema(): string
    {
        return json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'ContactPage',
            'name' => 'Contact Gulf Cut',
            'url' => self::canonical('/contact-us'),
            'about' => self::provider() + self::sameAs() + [
                'email' => self::EMAIL,
                'hasMap' => self::mapUrl(),
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => 'Al Qouz Fourth',
                    'addressLocality' => 'Al Quoz',
                    'addressRegion' => 'Dubai',
                    'addressCountry' => 'AE',
                ],
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /** @return array<int, array{name: string, url: string}> */
    public static function breadcrumbs(): array
    {
        $route = request()->route();
        $name = $route?->getName();
        $items = [['name' => 'Home', 'url' => self::canonical('/')]];

        $add = function (string $label, string $path) use (&$items): void {
            $items[] = ['name' => $label, 'url' => self::canonical($path)];
        };

        switch ($name) {
            case 'about':
                $add('About', '/about-us');
                break;
            case 'services':
                $add('Services', '/our-services');
                break;
            case 'contact':
                $add('Contact', '/contact-us');
                break;
            case 'contractor':
                $add('Services', '/our-services');
                $add('Cutting and demolition contractor', '/concrete-cutting-wall-saw-demolition-contractor');
                break;
            case 'blog':
                $add('Blog', '/blog');
                break;
            case 'blog.show':
                $add('Blog', '/blog');
                $post = Blog::find((string) $route->parameter('slug'));
                if ($post) {
                    $add($post['h1'], '/blog/'.$post['slug']);
                }
                break;
            case 'projects':
                $add('Projects', '/projects');
                break;
            case 'projects.show':
                $add('Projects', '/projects');
                $project = Projects::find((string) $route->parameter('slug'));
                if ($project) {
                    $add($project['h1'], '/projects/'.$project['slug']);
                }
                break;
            case 'page':
                $slug = (string) $route->parameter('slug');
                $add('Services', '/our-services');
                $label = preg_replace('/\s+\|\s+.*$/', '', self::titles()[$slug] ?? ucwords(str_replace('-', ' ', $slug)));
                $add((string) $label, '/'.$slug);
                break;
            default:
                return $items;
        }

        return $items;
    }

    public static function breadcrumbSchema(): string
    {
        $list = [];
        foreach (self::breadcrumbs() as $i => $item) {
            $list[] = [
                '@type' => 'ListItem',
                'position' => $i + 1,
                'name' => $item['name'],
                'item' => $item['url'],
            ];
        }

        return json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $list,
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
            ['title' => 'Cutting & Demolition Contractor', 'text' => 'Concrete cutting, wall saw cutting and controlled demolition for contractors across Dubai and the UAE.', 'image' => 'Concrete-wall-saw-cutting.jpeg', 'slug' => 'concrete-cutting-wall-saw-demolition-contractor'],
            ['title' => 'Concrete Slab Core Cutting', 'text' => 'Precise concrete slab core cutting services for plumbing, electrical, HVAC, and structural applications. We create accurate openings without damaging surrounding structures.', 'image' => 'Concrete-slab-core-cutting.jpeg', 'slug' => 'concrete-slab-core-cutting'],
            ['title' => 'Concrete Wire Saw Cutting', 'text' => 'Heavy-duty wire saw cutting solutions for large concrete structures, bridges, beams, and thick reinforced concrete sections.', 'image' => 'Concrete-wire-saw-cutting.jpeg', 'slug' => 'wire-saw-cutting'],
            ['title' => 'Concrete Wall Core Cutting', 'text' => 'Accurate wall core cutting solutions for utility installation, duct openings, and structural modifications.', 'image' => 'Concrete-wall-core-cutting.jpeg', 'slug' => 'concrete-wall-core-cutting'],
            ['title' => 'Concrete Beam Core Cutting', 'text' => 'Specialized beam core cutting services performed with precision to maintain structural integrity and project safety.', 'image' => 'Concrete-beam-core-cutting.jpeg', 'slug' => 'concrete-beam-core-cutting'],
            ['title' => 'Concrete Floor Cutting', 'text' => 'Advanced floor cutting services for expansion joints, trench cutting, repair works, and industrial flooring applications.', 'image' => 'Concrete-floor-cutting.jpeg', 'slug' => 'floor-saw-cutting'],
            ['title' => 'Concrete Beam Cutting', 'text' => 'Professional concrete beam cutting services for structural modifications, renovations, and construction upgrades.', 'image' => 'Concrete-beam-cutting.jpeg', 'slug' => 'concrete-beam-cutting'],
            ['title' => 'Concrete Slab 3D Scanning', 'text' => 'High-precision 3D concrete scanning services to detect hidden utilities, rebars, and embedded systems before cutting or drilling.', 'image' => 'Concrete-slab-3d-scanning.jpeg', 'slug' => 'concrete-slab-3d-scanning'],
            ['title' => 'Concrete Wall Saw Cutting', 'text' => 'Powerful wall saw cutting services for doors, windows, lift openings, and structural wall modifications with clean finishing.', 'image' => 'Concrete-wall-saw-cutting.jpeg', 'slug' => 'wall-saw-cutting'],
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
            ['n' => '01', 'title' => 'Concrete Cutting Services', 'text' => 'We provide precise concrete cutting solutions for walls, floors, slabs, beams, and structural modifications using advanced diamond cutting technology. Our methods ensure clean cuts, reduced vibration, and maximum safety.', 'slug' => 'concrete-cutting-services-uae', 'image' => 'Concrete-beam-cutting.jpeg'],
            ['n' => '02', 'title' => 'Core Cutting & Diamond Drilling', 'text' => 'Our core cutting services create accurate circular openings in reinforced concrete for plumbing, electrical, HVAC, and fire protection systems. Diamond core drilling delivers smooth, precise results with minimal dust and noise.', 'slug' => 'core-cutting-services-uae', 'image' => 'Concrete-slab-core-cutting.jpeg'],
            ['n' => '03', 'title' => 'Wall Saw Cutting', 'text' => 'Wall saw cutting is ideal for creating door openings, windows, lift shafts, and structural modifications in reinforced concrete walls. Our advanced equipment guarantees accurate and controlled cutting.', 'slug' => 'wall-saw-cutting', 'image' => 'Concrete-wall-saw-cutting.jpeg'],
            ['n' => '04', 'title' => 'Slab Cutting', 'text' => 'We perform professional slab cutting for residential, commercial, and industrial construction projects. Our team safely cuts concrete floors, suspended slabs, bridge decks, and foundations.', 'slug' => 'concrete-slab-demolition', 'image' => 'Concrete-slab-Demolition.jpeg'],
            ['n' => '05', 'title' => 'Floor Saw Cutting', 'text' => 'Our floor sawing services are used for roads, warehouses, industrial floors, parking areas, and expansion joints. We ensure straight, accurate cuts for every application.', 'slug' => 'floor-saw-cutting', 'image' => 'Concrete-floor-cutting.jpeg'],
            ['n' => '06', 'title' => 'Wire Saw Cutting', 'text' => 'Wire saw cutting is the ideal solution for large or heavily reinforced concrete structures where conventional cutting methods are not suitable. This technique provides precision and flexibility for complex projects.', 'slug' => 'wire-saw-cutting', 'image' => 'Concrete-wire-saw-cutting.jpeg'],
            ['n' => '07', 'title' => 'Concrete Demolition', 'text' => 'We specialize in controlled concrete demolition, including slabs, walls, staircases, beams, columns, and structural elements. Our team follows strict safety procedures while minimizing disruption to nearby structures.', 'slug' => 'concrete-demolition-services-uae', 'image' => 'Concrete-Demolition-Services.jpeg'],
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
            if (! $closed && ! self::isSectionTitle($group['title']) && ! self::hasCards($group)) {
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

        $hero['heading'] = self::cleanHeading($hero['heading']);

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
                $section['after'] = [];
                while (isset($rest[$i + 1]) && $rest[$i + 1]['title'] !== '' && ! self::isSectionTitle($rest[$i + 1]['title']) && strlen($rest[$i + 1]['title']) < 40 && ! self::hasCards($rest[$i + 1])) {
                    $i++;
                    $section['items'][] = ['title' => $rest[$i]['title'], 'text' => '', 'image' => ''];
                    foreach ($rest[$i]['parts'] as $part) {
                        if ($part['type'] === 'text' && trim((string) $part['text']) !== '') {
                            $section['after'][] = $part['text'];
                        }
                    }
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

    private static function cleanHeading(string $heading): string
    {
        return trim((string) preg_replace('/\s+\|\s+.*$/', '', rtrim(trim($heading), ':')));
    }

    /** @param  array{title: string, parts: array<int, array<string, mixed>>}  $group */
    private static function hasCards(array $group): bool
    {
        foreach ($group['parts'] as $part) {
            if (in_array($part['type'] ?? '', ['imagebox', 'list'], true)) {
                return true;
            }
            if (($part['type'] ?? '') === 'icon' && ! self::isContactIcon($part)) {
                return true;
            }
        }

        return false;
    }

    /** @param  array<string, mixed>  $part */
    private static function isContactIcon(array $part): bool
    {
        $label = trim((string) ($part['title'] ?? '')).trim((string) ($part['text'] ?? ''));

        return $label === '' || (bool) preg_match('/^[+\d\s()-]+$/', $label) || (bool) preg_match('/^(call|contact|email|whatsapp)\b/i', $label);
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
                if ($part['type'] === 'icon' && self::isContactIcon($part)) {
                    continue;
                }
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
                if (preg_match('/30%\s*off|claim now/i', (string) $part['text'])) {
                    continue;
                }
                $notes[] = $part['text'];
            } elseif ($part['type'] === 'image') {
                $images[] = self::img($part['src']);
            } elseif ($part['type'] === 'button') {
                if (preg_match('/30%\s*off|claim now/i', (string) ($part['text'] ?? ''))) {
                    continue;
                }
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
        if (str_contains($t, '30%') || str_contains($t, 'project with us') || str_contains($t, 'claim now')) {
            return null;
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
            'title' => self::cleanHeading($title),
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
