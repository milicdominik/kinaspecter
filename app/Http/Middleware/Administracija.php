<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Administracija
{
    /**
     * Ako korisnik nije is_administracija onda 401
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        if (!$user)
          abort(401);

        if(!$user->hasAdminAccess())
          abort(401);

        return $next($request);
    }
}
