<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectTrailingSlash
{
    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->getPathInfo();

        if ($request->isMethod('GET') && $path !== '/' && str_ends_with($path, '/')) {
            $target = rtrim($request->url(), '/');
            $query = $request->getQueryString();

            if ($query) {
                $target .= '?'.$query;
            }

            return redirect()->to($target, 301);
        }

        return $next($request);
    }
}
