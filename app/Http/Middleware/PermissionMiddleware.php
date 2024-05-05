<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->permission == "0") //0 - tik peržiūra, 1 - paprastas vartotojas, 2 - skaitantis vartotojas, 3 - administratorius.
        {
                return redirect()->back();
        }

        return $next($request);
    }
}
