<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use RealRashid\SweetAlert\Facades\Alert;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // ...$variable => Variadic Parameter
    public function handle(Request $request, Closure $next, ...$role): Response
    {
        if (!$request->user() || !$request->user()->hasAnyRole($role)) {
            // abort(403, 'Anda tidak memiliki akses');
            alert()->error('Uppss', 'Anda tidak memiliki akses ke halaman ini');
            return redirect()->to('dashboard');
        }

        return $next($request);
    }
}
