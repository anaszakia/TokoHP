<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleUserOnly
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->hasRole('User')) {
            return $next($request);
        }

        abort(403, 'Akses ditolak. Halaman ini hanya untuk User.');
    }
}

