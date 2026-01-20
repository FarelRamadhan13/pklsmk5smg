<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\siswa;
use App\Models\jurusan;



class depanController extends Controller
{
    public function index(){
        $title = 'PKL';
        
       
     
       
        // dd([$fotoPertama->foto]);
       if(auth()->check()){
        if(auth()->user()->hak_akses == '0'){
            return redirect('/Admin');
        }elseif(auth()->user()->hak_akses == '1'){
            return redirect('/kepsek');
        }elseif(auth()->user()->hak_akses == '2'){
            return redirect('/prakerin');
        }
       }elseif(auth()->guard('siswa')->check()){
        return redirect('/Siswa');
       }elseif(auth()->guard('pendamping')->check()){
        return redirect('/Pendamping');
       }else{
        return redirect('/login');
       }
    }

    public function galeri(){
        $foto = galeri::get();
        $title = 'galeri';
        return view('foto', ['title' => $title, 'foto' => $foto]);
    }

    public function contac(){
        $title = 'Contac Us';
        return view('contac', ['title' => $title]);
    }
    
    public function coba(){
        $title = 'Eula-coba';
        return view('eee', ['title' => $title]);
    }
}
