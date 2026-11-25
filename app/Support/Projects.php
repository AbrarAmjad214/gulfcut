<?php

namespace App\Support;

class Projects
{
    /** @return array<int, array<string, mixed>> */
    public static function all(): array
    {
        static $projects;

        return $projects ??= require resource_path('data/projects.php');
    }

    /** @return array<string, mixed>|null */
    public static function find(string $slug): ?array
    {
        foreach (self::all() as $project) {
            if ($project['slug'] === $slug) {
                return $project;
            }
        }

        return null;
    }

    /** @return array<int, array<string, mixed>> */
    public static function related(string $slug, int $limit = 3): array
    {
        return array_values(array_slice(
            array_filter(self::all(), fn (array $project) => $project['slug'] !== $slug),
            0,
            $limit
        ));
    }

    /** Fallback date for projects without their own 'date' key: when the project data last changed. */
    public static function date(): string
    {
        return date('Y-m-d', (int) filemtime(resource_path('data/projects.php')));
    }

    /** @param array<string, mixed> $project */
    public static function schema(array $project): string
    {
        return json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $project['h1'],
            'description' => $project['description'],
            'image' => GulfCut::absoluteImage($project['image']),
            'mainEntityOfPage' => GulfCut::canonical('/projects/'.$project['slug']),
            'datePublished' => $project['date'] ?? self::date(),
            'dateModified' => $project['updated'] ?? $project['date'] ?? self::date(),
            'author' => [
                '@type' => 'Organization',
                'name' => 'Gulf Cut UAE',
                'url' => GulfCut::SITE.'/',
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'Gulf Cut UAE',
                'url' => GulfCut::SITE.'/',
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => GulfCut::absoluteImage(GulfCut::LOGO_FILE),
                ],
            ],
            'about' => [
                '@type' => 'Service',
                'name' => $project['service_label'],
                'areaServed' => $project['location'],
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}
