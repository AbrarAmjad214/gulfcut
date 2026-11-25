<?php

namespace App\Support;

class Blog
{
    /** @return array<int, array<string, mixed>> */
    public static function all(): array
    {
        static $posts;

        if ($posts === null) {
            $posts = require resource_path('data/blog.php');
            usort($posts, fn (array $a, array $b) => strcmp($b['date'], $a['date']));
        }

        return $posts;
    }

    /** @return array<string, mixed>|null */
    public static function find(string $slug): ?array
    {
        foreach (self::all() as $post) {
            if ($post['slug'] === $slug) {
                return $post;
            }
        }

        return null;
    }

    /** @return array<int, array<string, mixed>> */
    public static function related(string $slug, int $limit = 3): array
    {
        $others = array_values(array_filter(self::all(), fn (array $post) => $post['slug'] !== $slug));
        $current = self::find($slug);
        if ($current === null) {
            // No current post (home page): newest post from each category first, for variety.
            $seen = [];
            $first = [];
            $later = [];
            foreach ($others as $post) {
                if (isset($seen[$post['category']])) {
                    $later[] = $post;
                } else {
                    $seen[$post['category']] = true;
                    $first[] = $post;
                }
            }

            return array_slice(array_merge($first, $later), 0, $limit);
        }

        // Same category first (topic cluster), then the newest of the rest.
        $same = array_filter($others, fn (array $post) => $post['category'] === $current['category']);
        $rest = array_filter($others, fn (array $post) => $post['category'] !== $current['category']);

        return array_slice(array_values(array_merge($same, $rest)), 0, $limit);
    }

    public static function indexSchema(): string
    {
        return self::encode([
            '@context' => 'https://schema.org',
            '@type' => 'Blog',
            'name' => 'Gulf Cut Concrete Cutting Blog',
            'url' => GulfCut::canonical('/blog'),
            'description' => 'Guides on concrete cutting, core drilling, scanning and demolition in Dubai and the UAE.',
            'publisher' => self::publisher(),
            'blogPost' => array_map(fn (array $post) => [
                '@type' => 'BlogPosting',
                'headline' => $post['h1'],
                'url' => GulfCut::canonical('/blog/'.$post['slug']),
                'datePublished' => $post['date'],
                'image' => GulfCut::absoluteImage($post['image']),
            ], self::all()),
        ]);
    }

    /** @param array<string, mixed> $post */
    public static function postSchema(array $post): string
    {
        $url = GulfCut::canonical('/blog/'.$post['slug']);
        $graph = [
            [
                '@type' => 'BlogPosting',
                'headline' => $post['h1'],
                'description' => $post['description'],
                'datePublished' => $post['date'],
                'dateModified' => $post['updated'],
                'mainEntityOfPage' => $url,
                'image' => GulfCut::absoluteImage($post['image']),
                'author' => self::publisher(),
                'publisher' => self::publisher(),
            ],
        ];

        if (! empty($post['faqs'])) {
            $graph[] = [
                '@type' => 'FAQPage',
                'mainEntity' => array_map(fn (array $faq) => [
                    '@type' => 'Question',
                    'name' => $faq['q'],
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $faq['a'],
                    ],
                ], $post['faqs']),
            ];
        }

        return self::encode([
            '@context' => 'https://schema.org',
            '@graph' => $graph,
        ]);
    }

    /** @return array<string, string> */
    private static function publisher(): array
    {
        return [
            '@type' => 'Organization',
            'name' => 'Gulf Cut UAE',
            'url' => GulfCut::SITE.'/',
            'logo' => GulfCut::absoluteImage(GulfCut::LOGO_FILE),
        ];
    }

    /** @param array<string, mixed> $data */
    private static function encode(array $data): string
    {
        return json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}
