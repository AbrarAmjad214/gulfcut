<?php

namespace App\Http\Middleware;

use App\Support\GulfCut;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Sends every non-canonical URL to its canonical form in a single 301:
 * www -> bare domain, http -> https (production), trailing slash removed,
 * old WordPress slugs mapped to their new pages.
 */
class RedirectTrailingSlash
{
    /** @var array<string, string> */
    private const LEGACY = [
        '/concrete-demolition' => '/concrete-demolition-services-uae',
        '/core-cutting' => '/core-cutting-services-uae',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->isMethod('GET') && ! $request->isMethod('HEAD')) {
            return $next($request);
        }

        $path = $request->getPathInfo();
        $clean = $path === '/' ? '/' : rtrim($path, '/');
        $clean = self::LEGACY[$clean] ?? $clean;

        $wrongHost = strcasecmp($request->getHost(), 'www.gulfcut.ae') === 0;
        $wrongScheme = app()->isProduction() && ! $request->secure();

        if ($wrongHost || $wrongScheme || $clean !== $path) {
            $base = ($wrongHost || $wrongScheme) ? GulfCut::SITE : $request->getSchemeAndHttpHost();
            $target = $base.$request->getBaseUrl().($clean === '/' ? '/' : $clean);
            $query = $request->getQueryString();

            return redirect()->away($query ? $target.'?'.$query : $target, 301);
        }

        return $next($request);
    }
}
