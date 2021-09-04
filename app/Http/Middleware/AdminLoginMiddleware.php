<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // tạo mới middlewawre : php artisan make:middleware AdminLoginMiddleware
        if (Auth::check()) {
            if (Auth::user()->type == 1) {
                return $next($request);
            } else {
                return redirect()->route('admin.getLogin');
            }
        } else {
            return redirect()->route('admin.getLogin');
        }
    }
}