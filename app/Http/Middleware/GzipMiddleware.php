<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class GzipMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request $request
     * @param  Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $accept_encoding = $request->header('Accept-Encoding');
        $response = $next($request);

        if (str_contains($accept_encoding, 'gzip')) {
            $content = $response->content();
            $data = gzencode($content, 9);
            $response->setContent($data);

            return $response->withHeaders([
                'Content-Length' => strlen($data),
                'Content-Encoding' => 'gzip'
            ]);
        }
        return $response;
    }
}
