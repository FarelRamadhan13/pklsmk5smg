<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use APp\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $title = 'Daftar Users';
        $user = User::get();
        return view('users.index', ['title' => $title, 'users' => $user]);
    }

    public function tambah(){
        $title = 'Tambah User';
        return view('users.tambah', ['title' => $title]);
    }

    public function store(request $r){
        $r->validate([
            'username' => 'required|unique:users,username',
            'name' => 'required',
            'password' => 'required',
            'passwordAseli' => 'required',
            'foto' => 'image|mimes:jpg,jpeg,png,gif',
            'hak_akses' => 'required',
            'status' => 'required'
        ],
        [
            'username.required' => 'Username harus diisi',
            'name.required' => 'Nama harus diisi',
            'username.unique' => 'Username ' . $r->username . ' sudah ada',
            'password.required' => 'Password harus diisi',
            'passwordAseli' => 'tolong verifikasi password',
            'foto.image' => 'Yang anda inputkan bukan foto',
            'foto.mimes' => 'Yang anda inputkan bukan foto',
            'hak_akses.required' => 'Tolong pilih salah satu hak akses',
            'status.required' => 'Tolong pilih statusnya'
        ]);
        if($r->password != $r->passwordAseli){
            return redirect()->back()->withInput()->with('pass', 'Password dan varifikasi password tidak sesuai');
        }

        if ($r->hasFile('foto')) {
            $foto = $r->file('foto');
            $fotoName = $foto->hashName();
            Storage::disk('public')->putFileAs('fotoProfileAdmin', $foto, $fotoName);
        } else {
            $fotoName = 'default.png';
        }
        User::insert([
            'username' => $r->username,
            'name' => $r->name,
            'password' => bcrypt($r->password),
            'foto' => $fotoName,
            'hak_akses' => $r->hak_akses,
            'status' => $r->status
        ]);

        return redirect('/Admin/Users')->with('berhasil', 'Data Users berhasil di tambah');
    }

    public function hapus($id){
        $user = User::findorfail($id);
        if($user->foto != 'default.png') {
            Storage::disk('public')->delete('fotoProfileAdmin/' . $user->foto);
        }
        $user->delete();
        return redirect('/Admin/Users')->with('berhasil', 'Data Users berhasil di Hapus');
    }

    public function ubah($id){
        $user = User::findorfail($id);
        $title = 'Ubah Data Users';
        return view('users.ubah', ['title' => $title, 'user' => $user]);
    }

    public function edit($id, request $r){
        $user = User::findorfail($id);
        if($r->ubahPass == '0'){
            $r->validate([
                'username' => 'required|unique:users,username,' .  $user->id,
                'name' => 'required',
                'foto' => 'image|mimes:jpg,jpeg,png,gif',
            ],
            [
                'username.required' => 'Username harus diisi',
                'name.required' => 'Nama harus diisi',
                'username.unique' => 'Username ' . $r->username . ' sudah ada',
                'foto.image' => 'Yang anda inputkan bukan foto',
                'foto.mimes' => 'Yang anda inputkan bukan foto',
            ]);
            if ($r->hasFile('foto')) {
                if ($user->foto != 'default.png') {
                   Storage::disk('public')->delete('fotoProfileAdmin' . $user->foto);
                }
                
                $foto = $r->file('foto');
                $fotoName = $foto->hashName();
              Storage::disk('public')->putFileAs('fotoProfileAdmin', $foto, $fotoName);
                $user->foto = $fotoName;
            }
        }
        elseif($r->ubahPass == '1'){
            $r->validate([
                'username' => 'required|unique:users,username,' . $user->id,
                'name' => 'required',
                'password' => 'required',
                'passwordAseli' => 'required',
                'foto' => 'image|mimes:jpg,jpeg,png,gif',
            ],
            [
                'username.required' => 'Username harus diisi',
                'name.required' => 'Nama harus diisi',
                'username.unique' => 'Username ' . $r->username . ' sudah ada',
                'password.required' => 'Password harus diisi',
                'passwordAseli' => 'tolong isikan Password baru',
                'foto.image' => 'Yang anda inputkan bukan foto',
                'foto.mimes' => 'Yang anda inputkan bukan foto',
            ]);

            if(Hash::check($r->password, $user->password)){
                if($r->hasFile('foto')) {
                    if ($user->foto != 'default.png') {
                        Storage::disk('public')->delete('fotoProfileAdmin/' . $user->foto);
                    }
                    $foto = $r->file('foto');
                    $fotoName = $foto->hashName();
                    Storage::disk('public')->putFileAs('fotoProfileAdmin', $foto, $fotoName);
                    $user->foto = $fotoName;
                }
                $user->password = bcrypt($r->passwordAseli);
                $user->username = $r->username;
                $user->name = $r->name;
                $user->hak_akses = $r->hak_akses;
                $user->status = $r->status;
                $user->save();

                if($user->id === auth()->user()->id){
                Auth::logout();
                return redirect('login')->with('berhasil', 'Berhasil diubah, tolong Login ulang');
                }


            }
            else{
                return redirect()->back()->withInput()->with('pass', 'Password lama tidak sesuai');
            }
        }
       
        $user->username = $r->username;
        $user->name = $r->name;
        $user->hak_akses = $r->hak_akses;
        $user->status = $r->status;
        $user->save();
        return redirect('/Admin/Users')->with('berhasil', 'Data Users berhasil diubah');
    }
}
