<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
class admin
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
        if(auth()->check()){
            $user = Auth::user();

            if (!Hash::check(Cookie::get('password_hash'), $user->password)) {
                Auth::logout();
                session()->flush();
                Cookie::queue(Cookie::forget('password_hash'));
                return redirect('/login')->with(['gagal' => 'Tolong Login ulang']);
            }

            if(auth()->user()->hak_akses == '0'){
                if(auth()->user()->status != '0'){
                    Auth::logout();
                    session()->flush();
                    Cookie::queue(Cookie::forget('password_hash'));
                    return redirect('/login')->with('gagal', 'Akun sudah tidak aktif');
                }
                return $next($request);
            }
        }
        abort(404);
    }
}
