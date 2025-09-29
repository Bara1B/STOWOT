<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);

        $headers = [
            'X-Frame-Options' => 'DENY',
            'X-Content-Type-Options' => 'nosniff',
            'Referrer-Policy' => 'no-referrer-when-downgrade',
            // Minimal CSP; extend as needed. Allow Vite HMR only in local env.
            'Content-Security-Policy' => $this->csp(),
        ];

        foreach ($headers as $key => $value) {
            if (!$response->headers->has($key)) {
                $response->headers->set($key, $value);
            }
        }

        return $response;
    }

    protected function csp(): string
    {
        if (app()->environment('local')) {
            // Allow Vite dev server and common CDNs in local
            return "default-src 'self'; "
                . "img-src 'self' data: blob:; "
                . "font-src 'self' https://fonts.gstatic.com https://fonts.bunny.net https://cdnjs.cloudflare.com https://cdn.jsdelivr.net data:; "
                . "style-src 'self' 'unsafe-inline' http://localhost:5173 http://127.0.0.1:5173 https://fonts.googleapis.com https://fonts.bunny.net https://cdnjs.cloudflare.com https://cdn.jsdelivr.net; "
                . "script-src 'self' 'unsafe-inline' 'unsafe-eval' http://localhost:5173 http://127.0.0.1:5173 https://cdnjs.cloudflare.com https://cdn.jsdelivr.net; "
                . "connect-src 'self' ws://localhost:5173 ws://127.0.0.1:5173";
        }
        // Production: allow required CDNs for fonts/styles; limit scripts to self by default
        return "default-src 'self'; "
            . "img-src 'self' data: blob:; "
            . "font-src 'self' https://fonts.gstatic.com https://fonts.bunny.net https://cdnjs.cloudflare.com https://cdn.jsdelivr.net data:; "
            . "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://fonts.bunny.net https://cdnjs.cloudflare.com; "
            . "script-src 'self'; "
            . "connect-src 'self'";
    }
}
