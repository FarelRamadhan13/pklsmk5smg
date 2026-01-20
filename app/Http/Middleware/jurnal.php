<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class jurnal
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
        if (auth()->guard('pendamping')->check() || (auth()->check() && auth()->user()->hak_akses == '0') ||  (auth()->check() && auth()->user()->hak_akses == '2')) {
            if(auth()->guard('pendamping')->check() && auth()->guard('pendamping')->user()->status != '0') {
                auth()->guard('pendamping')->logout();
                return redirect('/login')->with('gagal', 'Akun sudah tidak aktif');
            } elseif(auth()->check() && auth()->user()->status != '0') {
                auth()->logout();
                return redirect('/login')->with('gagal', 'Akun sudah tidak aktif');
            }
            if(auth()->check()){
                $user = Auth::user();

                if (!Hash::check(Cookie::get('password_hash'), $user->password)) {
                    Auth::logout();
                    session()->flush();
                    Cookie::queue(Cookie::forget('password_hash'));
                    return redirect('/login')->with(['gagal' => 'Tolong Login ulang']);
                }
            }
            if(auth()->guard('pendamping')->check()){
                $pendamping = Auth::guard('pendamping')->user();
    
                if (!Hash::check(Cookie::get('password_hash'), $pendamping->password)) {
                    Auth::guard('pendamping')->logout();
                    session()->flush();
                    Cookie::queue(Cookie::forget('password_hash'));
                    return redirect('/login')->with(['gagal' => 'Tolong Login ulang']);
                }
            }
            
            return $next($request);
        }
        if(auth()->guard('siswa')->check()){
            $siswa = Auth::guard('siswa')->user();

            if (!Hash::check(Cookie::get('password_hash'), $siswa->password)) {
                Auth::guard('siswa')->logout();
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
