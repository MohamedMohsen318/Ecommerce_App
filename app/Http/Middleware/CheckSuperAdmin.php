<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSuperAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $admin = auth()->guard('admin')->user();

        if (! $admin || ! $admin->isSuperAdmin()) {
            abort(403, 'You are not authorized to access this page.');
        }

        return $next($request);
    }
}
