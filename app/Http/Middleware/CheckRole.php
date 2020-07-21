<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckRole
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
        if(Auth()->user()->isAdmin == 1) {
            return $next($request);
        }
        return redirect('/home')->with("errors","Vous n'êtes pas autorisé à aller ici !");
    }
}
