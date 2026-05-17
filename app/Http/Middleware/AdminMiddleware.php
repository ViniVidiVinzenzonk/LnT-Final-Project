<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // kalau belum login redirect ke login dulu
        if (!Auth::check()) {
            return redirect('/login');
        }

        // kalau udah login tapi bukan admin, redirect ke halaman barang user
        if (Auth::user()->role !== 'admin') {
            return redirect('/barang')->with('error', 'Hei! Kamu gak punya akses ke halaman itu ya.');
        }

        return $next($request);
    }
}