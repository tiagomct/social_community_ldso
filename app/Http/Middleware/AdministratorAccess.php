<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AdministratorAccess
{
    /**
     * Handle an incoming request.
     * Allows access only to Administrators
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!auth()->check()) {
            return redirect('login');
        }

        if(Auth::user()->role->id < 3) {
            return redirect()->back();
        }

        return $next($request);
    }
}
