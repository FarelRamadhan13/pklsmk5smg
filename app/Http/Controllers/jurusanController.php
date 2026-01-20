<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jurusan;
use App\Models\siswa;

class jurusanController extends Controller
{
    public function index(){
        $title = 'Daftar jurusan';
        $jurusan = jurusan::get();
        $siswa = siswa::get();
        return view('jurusan.index', ['title' => $title, 'jurusan' => $jurusan, 'siswa' => $siswa]);
    }

    public function tambah(){
        $title = 'Tambah jurusan';
        return view('jurusan.tambah', ['title' => $title]);
    }

    public function store(request $r){
        $r->validate([
            'nama' => 'required',
            
        ],
        [
            'nama.required' => "Nama jurusan harus diisi",
          
        ]);

        jurusan::insert([
            'nama_jurusan' => $r->nama,
          
          
        ]);

        return redirect('/Admin/jurusan')->with('berhasil', 'Data jurusan berhasil di tambah');
    }

    public function hapus($id){
        $jurusan = jurusan::findorfail($id);
       
       
        $jurusan->delete();
        return redirect('/Admin/jurusan')->with('berhasil', 'Data jurusan berhasil di Hapus');
    }

    public function ubah($id){
        $jurusan = jurusan::findorfail($id);
        $title = 'Ubah Data Users';
        return view('jurusan.ubah', ['title' => $title, 'jurusan' => $jurusan]);
    }

    public function edit($id, request $r){
        $jurusan = jurusan::findorfail($id);
        $r->validate([
            'nama' => 'required',
           
      
        ],
        [
            'nama.required' => "Nama jurusan harus diisi",
          
        ]);
        $jurusan->nama_jurusan = $r->nama;
    

        $jurusan->save();
        
       
     

        return redirect('/Admin/jurusan')->with('berhasil', 'Data jurusan berhasil diubah');
    }
}
