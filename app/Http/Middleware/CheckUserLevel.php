<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah pengguna memiliki level yang sesuai
        if (auth()->check() && auth()->user()->hasLevel($level)) {
            return $next($request);
        }

        // Jika tidak, redirect ke halaman lain (misalnya home)
        return redirect()->route('login')->with('error', 'Access Denied');
    }
}
