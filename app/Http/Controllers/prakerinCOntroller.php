<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\pkl;
use App\Models\jurusan;
use App\Models\siswa;
use App\Models\guruPendamping;
use App\Models\tb_prakerin;
use App\Models\kunjungan;
use App\Models\pesan;
use Illuminate\Support\Facades\Storage;


class prakerinCOntroller extends Controller
{
    public function index(){
        $title = 'Guru Prakerin';
        $unreadMessagesCount = pesan::where('status','=','0')->count();
        $pkl = pkl::count();
        $user = User::count();
      
        $jurusan = jurusan::count();
        $siswa = siswa::count();
        $pendamping = guruPendamping::count();
        $prakerin = tb_prakerin::count();
        $kunjungan = kunjungan::count();
        return view('prakerin.index', ['title' => $title, 'user' => $user, 'pkl' => $pkl, 'jurusan' => $jurusan, 'siswa' => $siswa, 'unreadMessagesCount' => $unreadMessagesCount, 'pendamping' => $pendamping, 'prakerin' => $prakerin, 'kunjungan' => $kunjungan]);
    }

    public function gantiPassowrd(){
        $title = 'Ganti Data';
        return view('prakerin.gantiPassword', ['title' => $title]);
    }

    public function pass(request $r){
        $user = User::findorfail(auth()->user()->id);
        if($r->ubahPass == '1'){
            
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
    
}else{
    return redirect()->back()->withInput()->with('gagal', 'password lama tidak sesuai');
}
}
$r->validate([
    'name'=> 'required',
    'username' => 'required|unique:users,username,' .  $user->id,
],
[
    'name.required' => 'Tolong inputkan nama anda',
    'username.unique' => 'Username ' . $r->username . ' sudah ada',
    'username.required' => 'Tolong inputkan username anda'
]);
$user->name = $r->name;
$user->username = $r->username;
$user->save();
if(auth()->user()->hak_akses == '2'){

    return redirect('/prakerin')->with('berhasil', 'Data berhasil diubah, tolong gunakan data anda yang baru ketika login');
}else{
    
    return redirect('/kepsek')->with('berhasil', 'Data berhasil diubah, tolong gunakan data anda yang baru ketika login');
}
    }

    public function editFoto(){
        $title = 'Ganti foto Guru Prakerin';
        $user = user::findorfail(auth()->user()->id);

        return view('prakerin/ubahFoto', ['title' => $title, 'user' => $user]);
    }

    public function ubahFoto(request $r){
        $r->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif'
        ],
        [
            'foto.required' => 'Tolong inputkan foto anda',
            'foto.image' => 'Yang anda inputkan bukan foto',
            'foto.mimes' => 'Yang anda inputkan bukan foto'
        ]);

        $user = user::findorfail(auth()->user()->id);

        if ($user->foto != 'default.png') {
            Storage::disk('public')->delete('fotoProfileAdmin' . $user->foto);
        }
        
        $file = $r->file('foto');
        $fotoName = $file->hashName();
        // Storage::putFileAs('fotoProfileAdmin/', $file, $fotoName, 'public');
         Storage::disk('public')->putFileAs('fotoProfileAdmin', $file, $fotoName);

        $user->foto = $fotoName;
        $user->save();

        if(auth()->user()->hak_akses == '0'){
            return redirect('/Admin')->with('berhasil', 'Foto anda berhasil di Ubah');
        }elseif(auth()->user()->hak_akses == '2'){
        return redirect('/prakerin')->with('berhasil', 'Foto anda berhasil di Ubah');
    }else{
            return redirect('/kepsek')->with('berhasil', 'Foto anda berhasil di Ubah');

        }

    }
}