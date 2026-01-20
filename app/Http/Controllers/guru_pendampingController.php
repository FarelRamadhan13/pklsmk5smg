<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\guruPendamping;
use App\Models\jurusan;
use Illuminate\Support\Facades\Storage;

class guru_pendampingController extends Controller
{
    public function index(){
        $guruPendamping = guruPendamping::join('tb_jurusan','tbl_gurupendamping.id_jurusan','=','tb_jurusan.id_jurusan')->select('tbl_gurupendamping.*','tb_jurusan.nama_jurusan')->get();
        $title = 'Daftar Guru pendamping';
        return view('guru_pendamping.index', ['title' => $title, 'guruPendamping' => $guruPendamping]);
        }

        public function tambah(){
            $title = 'Tambah Guru Pendamping';
            $jurusan = jurusan::get();
            return view('guru_pendamping.tambah', ['title' => $title, 'jurusan' => $jurusan]);
        }

        public function store(request $r){
            $r->validate([
                'nip' =>  'required|unique:tbl_gurupendamping,nip',
                'nama' => 'required',
                'alamat' => 'required',
                'password' => 'required',
                'passwordAseli' => 'required',
                'telp' => 'required',
                'tahun' => 'required',
                'jurusan' => 'required',
                'status' => 'required',
                'pangkat' => 'required',
                'jabatan' => 'required'
            ],
        [
            'nip.required' => 'NIP harus diisi',
            'nama.required' => 'Nama harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'password.required' => 'tolong isikan password',
            'passwordAseli.required' => 'Tolong isi verifikasi password',
            'telp.required' => 'Nomor telephone harus diisi',
            'tahun.required' => 'Tahun harus diisi',
            'jurusan.required' => 'Tolong pilih jurusan',
            'status.required' => 'Tolong pilih status',
            'pangkat.required' => 'Pangkat harus diisi',
            'jabatan.required' => 'Jabatan harus diisi',
    
        ]);
            if($r->password != $r->passwordAseli){
                return redirect()->back()->withInput()->with('pass', 'Password dan varifikasi password tidak sesuai');
            }
            guruPendamping::insert([
                'nip' => $r->nip,
                'nama' => $r->nama,
                'alamat' => $r->alamat,
                'password' => bcrypt($r->password),
                'telp' => $r->telp,
                'tahun' => $r->tahun,
                'id_jurusan' => $r->jurusan,
                'jabatan' => $r->jabatan,
                'pangkat' => $r->pangkat
            ]);

            return redirect('/Admin/guru_pendamping')->with('berhasil', 'Data Guru Pendamping berhasil ditambah');
        }

        public function hapus($nip){
            $user = guruPendamping::findorfail($nip);
           if ($user->foto_pendamping != 'default.png') {
           Storage::disk('public')->delete('foto_profile_guruPendamping/' . $user->foto_pendamping);
        }
            $user->delete();
            return redirect('/Admin/guru_pendamping')->with('berhasil', 'Data Guru Pendamping berhasil di Hapus');
        }

        public function ubah($nip){
            $guruPendamping = guruPendamping::findorfail($nip);
            $title = 'Edit data Guru Pendamping';
            $jurusan = jurusan::get();
            return view('guru_pendamping.edit', ['title' => $title, 'guruPendamping' => $guruPendamping, 'jurusan' => $jurusan]);
        }

        public function edit($nip, request $r){
            $guru = guruPendamping::findorfail($nip);
            if($r->ubahPass == '1'){
                $r->validate([
                    'nip' =>  'required',
                    'nama' => 'required',
                    'alamat' => 'required',
                    'password' => 'required',
                    'telp' => 'required',
                    'tahun' => 'required',
                    'jurusan' => 'required',
                    'status' => 'required',
                    'pangkat' => 'required',
                    'jabatan' => 'required'
                ],
            [
                'nip.required' => 'NIP harus diisi',
                'nama.required' => 'Nama harus diisi',
                'alamat.required' => 'Alamat harus diisi',
                'password.required' => 'tolong isikan password',
                'telp.required' => 'Nomor telephone harus diisi',
                'tahun.required' => 'Tahun harus diisi',
                'jurusan.required' => 'Tolong pilih jurusan',
                'status.required' => 'Tolong pilih status',
                'pangkat.required' => 'Pangkat harus diisi',
            'jabatan.required' => 'Jabatan harus diisi',

            ]);
            $guru->password = bcrypt($r->password);
            $guru->nama = $r->nama;
            $guru->alamat = $r->alamat;
            $guru->telp = $r->telp;
            $guru->status = $r->status;
            $guru->tahun = $r->tahun;
            $guru->pangkat = $r->pangkat;
            $guru->jabatan = $r->jabatan;
            $guru->id_jurusan = $r->jurusan;
            $guru->save();
        }else{
            $r->validate([
                'nip' =>  'required',
                'nama' => 'required',
                'alamat' => 'required',
             
                'telp' => 'required',
                'tahun' => 'required',
                'jurusan' => 'required',
                'status' => 'required',
                'pangkat' => 'required',
                'jabatan' => 'required'
            ],
            [
            'nip.required' => 'NIP harus diisi',
            'nama.required' => 'Nama harus diisi',
            'alamat.required' => 'Alamat harus diisi',
         
            'telp.required' => 'Nomor telephone harus diisi',
            'tahun.required' => 'Tahun harus diisi',
            'jurusan.required' => 'Tolong pilih jurusan',
            'status.required' => 'Tolong pilih status',
            'pangkat.required' => 'Pangkat harus diisi',
            'jabatan.required' => 'Jabatan harus diisi',
        ]);
        $guru->nama = $r->nama;
        $guru->alamat = $r->alamat;
        $guru->telp = $r->telp;
        $guru->status = $r->status;
        $guru->tahun = $r->tahun;
        $guru->pangkat = $r->pangkat;
        $guru->jabatan = $r->jabatan;
        $guru->id_jurusan = $r->jurusan;
        $guru->save();
        }
       
            return redirect('/Admin/guru_pendamping')->with('berhasil', 'Data Guru Pendamping berhasil diubah');
        }
    
}