<?php

namespace App\Http\Middleware;

use Closure;

class PrivateAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('Api-Key');
        if ($token === env('API_KEY')) {
            return $next($request);
        }

        return response()->json([
            'message' => 'Missing or invalid token.'
        ]);
    }
}
