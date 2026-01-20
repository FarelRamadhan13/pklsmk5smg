<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\siswa;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function login(){
        $title = 'PKL SMK N 5 Semarang';
        return view('login', ['title' => $title]);
    }

    public function logins(Request $r)
    {
        $loginAttempts = session('login_attempts', 0);
    $lastLoginAttempt = session('last_login_attempt', null);

    // Reset login attempts if 10 minutes have passed since the last failed attempt
    if ($lastLoginAttempt && now()->diffInMinutes($lastLoginAttempt) >= 20) {
        $loginAttempts = 0;
        session(['login_attempts' => $loginAttempts, 'last_login_attempt' => now()]);
         session()->forget(['cooldown', 'cooldown_time', 'cooldown_start_time']);
    }

    $cooldownTime = 0;
    if ($loginAttempts >= 2 && $lastLoginAttempt) {
        $cooldownTime = max(0, 42 - now()->diffInSeconds($lastLoginAttempt));
        
        // Reset login attempts if cooldown just ended
        if ($cooldownTime <= 0) {
            $loginAttempts = 0;
            session(['login_attempts' => $loginAttempts, 'last_login_attempt' => now()]);
             session()->forget(['cooldown', 'cooldown_time', 'cooldown_start_time']);
        }
    }

    // Check for cooldown period
    if ($cooldownTime > 0) {
        return redirect()->back()->withInput()->with([
            'cooldown' => 'Terlalu banyak percobaan login. Silakan coba lagi setelah ' . $cooldownTime . ' detik.', 
            'cooldown_time' => $cooldownTime
        ]);
    }
        $r->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'NIS/NIP harus diisi',
            'password.required' => 'Password harus diisi'
        ]);
    
        $credentials = [
            'username' => $r->username,
            'password' => $r->password
        ];
    
        $remember = $r->has('remember'); 

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            if ($user->status != '0') {
                return redirect()->back()->withInput()->with('gagal', 'Akun sudah tidak aktif');
            }
             session()->forget(['cooldown', 'cooldown_time', 'cooldown_start_time']);
           
            if($remember){
                Cookie::queue(Cookie::make('password_hash', $r->password, 2592000)); 
            } else {
                Cookie::queue(Cookie::make('password_hash', $r->password, 120)); 
            }
          
            if ($user->hak_akses == '0') {
                return redirect('/Admin')->with('login', 'Selamat Datang');
            } elseif ($user->hak_akses == '2') {
                return redirect('/prakerin')->with('login', 'Selamat Datang');
            } elseif ($user->hak_akses == '1') {
                return redirect('/kepsek')->with('login', 'Selamat Datang');
            }
        } elseif (Auth::guard('siswa')->attempt(['nisn' => $r->username, 'password' => $r->password], $remember)) {
             session()->forget(['cooldown', 'cooldown_time', 'cooldown_start_time']);
            $r->session()->regenerate(true);
            $siswa = Auth::guard('siswa')->user();
            if($remember){
                Cookie::queue(Cookie::make('password_hash', $r->password, 2592000)); 
            } else {
                Cookie::queue(Cookie::make('password_hash', $r->password, 120)); 
            }
            return redirect('/Siswa')->with('login', 'Selamat Datang');
        } elseif (Auth::guard('pendamping')->attempt(['nip' => $r->username, 'password' => $r->password], $remember)) {
             session()->forget(['cooldown', 'cooldown_time', 'cooldown_start_time']);
            $user = Auth::guard('pendamping')->user();
            if ($user->status != '0') {
                return redirect()->back()->withInput()->with('gagal', 'Akun sudah tidak aktif');
            }
            $r->session()->regenerate(true);
            if($remember){
                Cookie::queue(Cookie::make('password_hash', $r->password, 2592000)); 
            } else {
                Cookie::queue(Cookie::make('password_hash', $r->password, 120)); 
            }
            return redirect('/Pendamping')->with('login', 'Selamat Datang');
        }
    
        if ($r->username === 'Messi' && $r->password === 'Messi Siuu') {
            return redirect()->back()->with('messi-siuu', 'Suii');
        }
        $loginAttempts = min($loginAttempts + 1, 2);
    session(['login_attempts' => $loginAttempts, 'last_login_attempt' => now()]);
        return redirect()->back()->withInput()->with('gagal', 'NIS/NIP atau Password salah');
    }
    

    public function logout(){
        Auth::logout();
        Auth::guard('siswa')->logout();
        Auth::guard('pendamping')->logout();
        session()->flush();
                Cookie::queue(Cookie::forget('password_hash'));
        return redirect('/login')->with('logout', 'Berhasil logout');;
    }
    
    
    // public function guru(){
    //     $guru = array(
    //         array("pangkat"=>"197209082005012000", "jabatan"=>"197209082005012000", "nip"=>"197209082005012000", "nama"=>"197209082005012000", "alamat"=>"197209082005012000", "telp"=>"197209082005012000", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"197209082005012000"),
    //         array("pangkat"=>"199101202022211003", "jabatan"=>"199101202022211003", "nip"=>"199101202022211003", "nama"=>"199101202022211003", "alamat"=>"199101202022211003", "telp"=>"199101202022211003", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"199101202022211003"),
    //         array("pangkat"=>"198101182023211002", "jabatan"=>"198101182023211002", "nip"=>"198101182023211002", "nama"=>"198101182023211002", "alamat"=>"198101182023211002", "telp"=>"198101182023211002", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"198101182023211002"),
    //         array("pangkat"=>"198808232014022001", "jabatan"=>"198808232014022001", "nip"=>"198808232014022001", "nama"=>"198808232014022001", "alamat"=>"198808232014022001", "telp"=>"198808232014022001", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"198808232014022001"),
    //         array("pangkat"=>"199005062023211008", "jabatan"=>"199005062023211008", "nip"=>"199005062023211008", "nama"=>"199005062023211008", "alamat"=>"199005062023211008", "telp"=>"199005062023211008", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"199005062023211008"),
    //         array("pangkat"=>"199212122019022004", "jabatan"=>"199212122019022004", "nip"=>"199212122019022004", "nama"=>"199212122019022004", "alamat"=>"199212122019022004", "telp"=>"199212122019022004", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"199212122019022004"),
    //         array("pangkat"=>"199210012022212013", "jabatan"=>"199210012022212013", "nip"=>"199210012022212013", "nama"=>"199210012022212013", "alamat"=>"199210012022212013", "telp"=>"199210012022212013", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"199210012022212013"),
    //         array("pangkat"=>"197705222010012009", "jabatan"=>"197705222010012009", "nip"=>"197705222010012009", "nama"=>"197705222010012009", "alamat"=>"197705222010012009", "telp"=>"197705222010012009", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"197705222010012009"),
    //         array("pangkat"=>"199006252023211010", "jabatan"=>"199006252023211010", "nip"=>"199006252023211010", "nama"=>"199006252023211010", "alamat"=>"199006252023211010", "telp"=>"199006252023211010", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"199006252023211010"),
    //         array("pangkat"=>"197510052005011007", "jabatan"=>"197510052005011007", "nip"=>"197510052005011007", "nama"=>"197510052005011007", "alamat"=>"197510052005011007", "telp"=>"197510052005011007", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"197510052005011007"),
    //         array("pangkat"=>"198803142011012013", "jabatan"=>"198803142011012013", "nip"=>"198803142011012013", "nama"=>"198803142011012013", "alamat"=>"198803142011012013", "telp"=>"198803142011012013", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"198803142011012013"),
    //         array("pangkat"=>"197605162006042015", "jabatan"=>"197605162006042015", "nip"=>"197605162006042015", "nama"=>"197605162006042015", "alamat"=>"197605162006042015", "telp"=>"197605162006042015", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"197605162006042015"),
    //         array("pangkat"=>"199403132022212014", "jabatan"=>"199403132022212014", "nip"=>"199403132022212014", "nama"=>"199403132022212014", "alamat"=>"199403132022212014", "telp"=>"199403132022212014", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"199403132022212014"),
    //         array("pangkat"=>"197712172014062002", "jabatan"=>"197712172014062002", "nip"=>"197712172014062002", "nama"=>"197712172014062002", "alamat"=>"197712172014062002", "telp"=>"197712172014062002", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"197712172014062002"),
    //         array("pangkat"=>"197704252009031003", "jabatan"=>"197704252009031003", "nip"=>"197704252009031003", "nama"=>"197704252009031003", "alamat"=>"197704252009031003", "telp"=>"197704252009031003", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"197704252009031003"),
    //         array("pangkat"=>"196610112007011004", "jabatan"=>"196610112007011004", "nip"=>"196610112007011004", "nama"=>"196610112007011004", "alamat"=>"196610112007011004", "telp"=>"196610112007011004", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"196610112007011004"),
    //         array("pangkat"=>"198611072009032007", "jabatan"=>"198611072009032007", "nip"=>"198611072009032007", "nama"=>"198611072009032007", "alamat"=>"198611072009032007", "telp"=>"198611072009032007", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"198611072009032007"),
    //         array("pangkat"=>"197408132009031001", "jabatan"=>"197408132009031001", "nip"=>"197408132009031001", "nama"=>"197408132009031001", "alamat"=>"197408132009031001", "telp"=>"197408132009031001", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"197408132009031001"),
    //         array("pangkat"=>"197706092022212003", "jabatan"=>"197706092022212003", "nip"=>"197706092022212003", "nama"=>"197706092022212003", "alamat"=>"197706092022212003", "telp"=>"197706092022212003", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"197706092022212003"),
    //         array("pangkat"=>"197711132014062003", "jabatan"=>"197711132014062003", "nip"=>"197711132014062003", "nama"=>"197711132014062003", "alamat"=>"197711132014062003", "telp"=>"197711132014062003", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"197711132014062003"),
    //         array("pangkat"=>"197312092008012005", "jabatan"=>"197312092008012005", "nip"=>"197312092008012005", "nama"=>"197312092008012005", "alamat"=>"197312092008012005", "telp"=>"197312092008012005", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"197312092008012005"),
    //         array("pangkat"=>"197409182006041005", "jabatan"=>"197409182006041005", "nip"=>"197409182006041005", "nama"=>"197409182006041005", "alamat"=>"197409182006041005", "telp"=>"197409182006041005", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"197409182006041005"),
    //         array("pangkat"=>"197808132009031005", "jabatan"=>"197808132009031005", "nip"=>"197808132009031005", "nama"=>"197808132009031005", "alamat"=>"197808132009031005", "telp"=>"197808132009031005", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"197808132009031005"),
    //         array("pangkat"=>"198804242022212010", "jabatan"=>"198804242022212010", "nip"=>"198804242022212010", "nama"=>"198804242022212010", "alamat"=>"198804242022212010", "telp"=>"198804242022212010", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"198804242022212010"),
    //         array("pangkat"=>"196508261988032010", "jabatan"=>"196508261988032010", "nip"=>"196508261988032010", "nama"=>"196508261988032010", "alamat"=>"196508261988032010", "telp"=>"196508261988032010", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"196508261988032010"),
    //         array("pangkat"=>"197905232005011008", "jabatan"=>"197905232005011008", "nip"=>"197905232005011008", "nama"=>"197905232005011008", "alamat"=>"197905232005011008", "telp"=>"197905232005011008", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"197905232005011008"),
    //         array("pangkat"=>"196810052003121003", "jabatan"=>"196810052003121003", "nip"=>"196810052003121003", "nama"=>"196810052003121003", "alamat"=>"196810052003121003", "telp"=>"196810052003121003", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"196810052003121003"),
    //         array("pangkat"=>"197301282008011006", "jabatan"=>"197301282008011006", "nip"=>"197301282008011006", "nama"=>"197301282008011006", "alamat"=>"197301282008011006", "telp"=>"197301282008011006", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"197301282008011006"),
    //         array("pangkat"=>"198206062011011010", "jabatan"=>"198206062011011010", "nip"=>"198206062011011010", "nama"=>"198206062011011010", "alamat"=>"198206062011011010", "telp"=>"198206062011011010", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"198206062011011010"),
    //         array("pangkat"=>"199408012022211010", "jabatan"=>"199408012022211010", "nip"=>"199408012022211010", "nama"=>"199408012022211010", "alamat"=>"199408012022211010", "telp"=>"199408012022211010", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"199408012022211010"),
    //         array("pangkat"=>"198009042022211005", "jabatan"=>"198009042022211005", "nip"=>"198009042022211005", "nama"=>"198009042022211005", "alamat"=>"198009042022211005", "telp"=>"198009042022211005", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"198009042022211005"),
    //         array("pangkat"=>"198809042022212021", "jabatan"=>"198809042022212021", "nip"=>"198809042022212021", "nama"=>"198809042022212021", "alamat"=>"198809042022212021", "telp"=>"198809042022212021", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"198809042022212021"),
    //         array("pangkat"=>"197611152010012011", "jabatan"=>"197611152010012011", "nip"=>"197611152010012011", "nama"=>"197611152010012011", "alamat"=>"197611152010012011", "telp"=>"197611152010012011", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"197611152010012011"),
    //         array("pangkat"=>"198002022006041011", "jabatan"=>"198002022006041011", "nip"=>"198002022006041011", "nama"=>"198002022006041011", "alamat"=>"198002022006041011", "telp"=>"198002022006041011", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"198002022006041011"),
    //         array("pangkat"=>"198207232022212021", "jabatan"=>"198207232022212021", "nip"=>"198207232022212021", "nama"=>"198207232022212021", "alamat"=>"198207232022212021", "telp"=>"198207232022212021", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"198207232022212021"),
    //         array("pangkat"=>"197305022008011005", "jabatan"=>"197305022008011005", "nip"=>"197305022008011005", "nama"=>"197305022008011005", "alamat"=>"197305022008011005", "telp"=>"197305022008011005", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"197305022008011005"),
    //         array("pangkat"=>"199604212022212007", "jabatan"=>"199604212022212007", "nip"=>"199604212022212007", "nama"=>"199604212022212007", "alamat"=>"199604212022212007", "telp"=>"199604212022212007", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"199604212022212007"),
    //         array("pangkat"=>"198310232011012012", "jabatan"=>"198310232011012012", "nip"=>"198310232011012012", "nama"=>"198310232011012012", "alamat"=>"198310232011012012", "telp"=>"198310232011012012", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"198310232011012012"),
    //         array("pangkat"=>"198004022022211011", "jabatan"=>"198004022022211011", "nip"=>"198004022022211011", "nama"=>"198004022022211011", "alamat"=>"198004022022211011", "telp"=>"198004022022211011", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"198004022022211011"),
    //         array("pangkat"=>"197204032014062003", "jabatan"=>"197204032014062003", "nip"=>"197204032014062003", "nama"=>"197204032014062003", "alamat"=>"197204032014062003", "telp"=>"197204032014062003", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"197204032014062003"),
    //         array("pangkat"=>"196811222005012008", "jabatan"=>"196811222005012008", "nip"=>"196811222005012008", "nama"=>"196811222005012008", "alamat"=>"196811222005012008", "telp"=>"196811222005012008", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"196811222005012008"),
    //         array("pangkat"=>"197809252011012003", "jabatan"=>"197809252011012003", "nip"=>"197809252011012003", "nama"=>"197809252011012003", "alamat"=>"197809252011012003", "telp"=>"197809252011012003", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"197809252011012003"),
    //         array("pangkat"=>"196705112005012005", "jabatan"=>"196705112005012005", "nip"=>"196705112005012005", "nama"=>"196705112005012005", "alamat"=>"196705112005012005", "telp"=>"196705112005012005", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"196705112005012005"),
    //         array("pangkat"=>"197412272008011002", "jabatan"=>"197412272008011002", "nip"=>"197412272008011002", "nama"=>"197412272008011002", "alamat"=>"197412272008011002", "telp"=>"197412272008011002", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"197412272008011002"),
    //         array("pangkat"=>"196412292000032001", "jabatan"=>"196412292000032001", "nip"=>"196412292000032001", "nama"=>"196412292000032001", "alamat"=>"196412292000032001", "telp"=>"196412292000032001", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"196412292000032001"),
    //         array("pangkat"=>"198005172022212014", "jabatan"=>"198005172022212014", "nip"=>"198005172022212014", "nama"=>"198005172022212014", "alamat"=>"198005172022212014", "telp"=>"198005172022212014", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"198005172022212014"),
    //         array("pangkat"=>"196804122008011010", "jabatan"=>"196804122008011010", "nip"=>"196804122008011010", "nama"=>"196804122008011010", "alamat"=>"196804122008011010", "telp"=>"196804122008011010", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"196804122008011010"),
    //         array("pangkat"=>"196510152008012004", "jabatan"=>"196510152008012004", "nip"=>"196510152008012004", "nama"=>"196510152008012004", "alamat"=>"196510152008012004", "telp"=>"196510152008012004", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"196510152008012004"),
    //         array("pangkat"=>"198110052014062004", "jabatan"=>"198110052014062004", "nip"=>"198110052014062004", "nama"=>"198110052014062004", "alamat"=>"198110052014062004", "telp"=>"198110052014062004", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"198110052014062004"),
    //         array("pangkat"=>"197804292010012007", "jabatan"=>"197804292010012007", "nip"=>"197804292010012007", "nama"=>"197804292010012007", "alamat"=>"197804292010012007", "telp"=>"197804292010012007", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"197804292010012007"),
    //         array("pangkat"=>"199110122022211005", "jabatan"=>"199110122022211005", "nip"=>"199110122022211005", "nama"=>"199110122022211005", "alamat"=>"199110122022211005", "telp"=>"199110122022211005", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"199110122022211005"),
    //         array("pangkat"=>"197505102022212006", "jabatan"=>"197505102022212006", "nip"=>"197505102022212006", "nama"=>"197505102022212006", "alamat"=>"197505102022212006", "telp"=>"197505102022212006", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"197505102022212006"),
    //         array("pangkat"=>"197708072008012012", "jabatan"=>"197708072008012012", "nip"=>"197708072008012012", "nama"=>"197708072008012012", "alamat"=>"197708072008012012", "telp"=>"197708072008012012", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"197708072008012012"),
    //         array("pangkat"=>"197005092008012007", "jabatan"=>"197005092008012007", "nip"=>"197005092008012007", "nama"=>"197005092008012007", "alamat"=>"197005092008012007", "telp"=>"197005092008012007", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"197005092008012007"),
    //         array("pangkat"=>"197611032022211005", "jabatan"=>"197611032022211005", "nip"=>"197611032022211005", "nama"=>"197611032022211005", "alamat"=>"197611032022211005", "telp"=>"197611032022211005", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"197611032022211005"),
    //         array("pangkat"=>"198412132022212011", "jabatan"=>"198412132022212011", "nip"=>"198412132022212011", "nama"=>"198412132022212011", "alamat"=>"198412132022212011", "telp"=>"198412132022212011", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"198412132022212011"),
    //         array("pangkat"=>"198703132022211003", "jabatan"=>"198703132022211003", "nip"=>"198703132022211003", "nama"=>"198703132022211003", "alamat"=>"198703132022211003", "telp"=>"198703132022211003", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"198703132022211003"),
    //         array("pangkat"=>"198104272009031009", "jabatan"=>"198104272009031009", "nip"=>"198104272009031009", "nama"=>"198104272009031009", "alamat"=>"198104272009031009", "telp"=>"198104272009031009", "tahun"=>"2024", "id_jurusan"=>"1", "status"=>"0", "password"=>"198104272009031009")
    //     );
    //     foreach ($guru as $gurus) {
    //         DB::table('tbl_gurupendamping')->insert([
    //             'nip' => $gurus['nip'],
    //             'nama' => $gurus['nama'],
    //             'alamat' => $gurus['alamat'],
    //             'telp' => $gurus['telp'],
    //             'tahun' => $gurus['tahun'],
    //             'id_jurusan' => $gurus['id_jurusan'],
    //             'status' => $gurus['status'],
    //             'jabatan' => $gurus['jabatan'],
    //             'pangkat' => $gurus['pangkat'],
    //             'password' => Hash::make($gurus['password']),
    //         ]);
    //     }
        
    //     echo 'berhasil';
    // }

   
    

   
}
