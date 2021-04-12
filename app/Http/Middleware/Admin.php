<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{


    public function handle($request, Closure $next)
    {
        if (! Auth::guard('adminweb')->check()) {
            return redirect()->route('get.admin.login');
        }

        return $next($request);
    }
}
