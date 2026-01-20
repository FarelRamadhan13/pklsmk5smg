<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class pendamping
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->guard('pendamping')->check()) {
            if(auth()->guard('pendamping')->user()->status != '0'){
                Auth::guard('pendamping')->logout();
                return redirect('/login')->with('gagal', 'Akun sudah tidak aktif');
            }
            $pendamping = Auth::guard('pendamping')->user();

            if (!Hash::check(Cookie::get('password_hash'), $pendamping->password)) {
                Auth::guard('pendamping')->logout();
                session()->flush();
                Cookie::queue(Cookie::forget('password_hash'));
                return redirect('/login')->with(['gagal' => 'Tolong Login ulang']);
            }
            return $next($request);
        }
        
        // return redirect('/');
               abort(404);
    }
}
