<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pesan;

class PesanCOntroller extends Controller
{
    public function kirim(Request $r){
        if(auth()->guard('siswa')->check()){
             pesan::create([
            'nama' => auth()->guard('siswa')->user()->nama_siswa,
            'pesan' => $r->pesan
        ]);
    
        return response()->json(['message' => 'Pesan berhasil dikirim.']);
        }else{
            return response()->json(['message' => 'Kalau bisa jangan ngeSpam!.']);
        }
       
    }

    public function index(){
        $pesan = pesan::get();
        $pesan_ = pesan::where('status','=','0')->get();
        foreach ($pesan_ as $p) {
            $p->status = '1';
            $p->save();
        }
        
        $title = 'Pesan';
        return view('pesan.index', ['title' => $title, 'pesan' => $pesan]);
    }
    
}
