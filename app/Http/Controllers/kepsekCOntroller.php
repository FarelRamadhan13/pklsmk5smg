<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\tb_prakerin;
use App\Models\kunjungan;
use Illuminate\Support\Facades\Hash;
class kepsekCOntroller extends Controller
{
    public function index(){
        $title = 'Kepala sekolah';
        $prakerin = tb_prakerin::count();
        $kunjungan = kunjungan::count();
        return view('kepsek.index', ['title' => $title, 'prakerin' => $prakerin, 'kunjungan' => $kunjungan]);
    }

    public function gantiPassowrd(){
        $title = 'Ganti Password';
        return view('kepsek.gantiPassword', ['title' => $title]);
    }

    public function pass(request $r){
        $user = User::findorfail(auth()->user()->id);
        $r->validate([
            'password' => 'required',
            'passwordAseli' => 'required',
        ],
    [
        'password.required' => 'Password harus diisi',
            'passwordAseli' => 'tolong verifikasi password',
    ]);

    if(Hash::check($r->password, $user->password)){
    $user->password = bcrypt($r->passwordAseli);
    $user->save();
    return redirect('/kepsek')->with('berhasil', 'Password berhasil diubah');
    }else{
        return redirect()->back()->withInput()->with('gagal', 'password lama tidak sesuai');
    }
    }
}
