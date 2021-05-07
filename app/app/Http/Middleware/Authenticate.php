<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Auth;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request, $guard='admin')
    {
        // if (! $request->expectsJson()) {
        //     return route('login');
        // }
        if (Auth::guard($guard)->guest())
        {
            if ($request->ajax() || $request->wantsJson())
            {
                return response('Unauthorized.', 401);
            }
            else
            {
                if($guard == 'admin')
                {
                    return redirect()->route('admin.auth');
                }
                return redirect()->route('login');
            }
        }
        return $next($request);
    }
}
