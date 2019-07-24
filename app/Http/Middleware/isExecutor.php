<?php

namespace App\Http\Middleware;

use Closure;

class isExecutor {
  public function handle($request, Closure $next)
  {
      if(auth()->user()->isExecutor()) {
          return $next($request);
      }
      return response()->json(['message' => 'User not executor'], 400);
  }
}