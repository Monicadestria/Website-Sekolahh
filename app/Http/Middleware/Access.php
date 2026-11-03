<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class Access
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = Auth::user();

        $currenRouteName = Route::currentRouteName();

        if($user && $user->accesses->contains('name', $currenRouteName)) {
            return $next($request);
        }

        return redirect()->back()->with('error', 'Anda tidak memiliki akses');
    }
}
