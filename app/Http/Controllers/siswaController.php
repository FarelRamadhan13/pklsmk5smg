<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\siswa;
use App\Models\jurusan;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\pdf\pdfController;
use Illuminate\Support\Facades\Storage;

class siswaController extends Controller
{
    public function index(){
        $siswa = siswa::join('tb_jurusan','siswa.id_jurusan','=','tb_jurusan.id_jurusan')->select('siswa.*','tb_jurusan.nama_jurusan')->get();
        $title = 'Daftar Siswa';
        return view('siswa.index', ['title' => $title, 'siswa' => $siswa]);
        }

        public function tambah(){
            $title = 'Tambah Siswa';
            $jurusan = jurusan::get();
            return view('siswa.tambah', ['title' => $title, 'jurusan' => $jurusan]);
        }

        public function store(request $r){
            $r->validate([
                'nisn' =>  'required|unique:siswa,nisn',
                'nama' => 'required',
                'alamat' => 'required',
                'password' => 'required',
                'passwordAseli' => 'required',
                'telp' => 'required',
                'kelas' => 'required',
                'tahun' => 'required',
                'jurusan' => 'required',
               
            ],
        [
            'nisn.required' => 'NIS harus diisi',
            'nama.required' => 'Nama harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'password.required' => 'Tolong isikan password',
            'passwordAseli.required' => 'Tolong isi verifikasi password',
            'telp.required' => 'Nomor telephone harus diisi',
            'kelas.required' => 'Tolong pilih kelas',
            'tahun.required' => 'Tahun harus diisi',
            'jurusan.required' => 'Tolong pilih jurusan',
            'nisn.unique' => 'NIS ' . $r->nisn . ' sudah ada',
           

        ]);
            if($r->password != $r->passwordAseli){
                return redirect()->back()->withInput()->with('pass', 'Password dan varifikasi password tidak sesuai');
            }
            siswa::insert([
                'nisn' => $r->nisn,
                'nama_siswa' => $r->nama,
                'alamat' => $r->alamat,
                'password' => bcrypt($r->password),
                'telp' => $r->telp,
                'kelas' => $r->kelas,
                'tahun' => $r->tahun,
                'id_jurusan' => $r->jurusan,
                'golongan_darah' => $r->golongan_darah,
                'nama_orang_tua_wali' => $r->nama_ortu,
                'tempat_tanggal_lahir' => $r->tampat_tanggal_lahir,
                'catatan_kesehatan' => $r->catatan_kesehatan
            ]);

            return redirect('/Admin/Siswa')->with('berhasil', 'Data siswa berhasil ditambah');
        }

        public function hapus($nisn){
            $user = siswa::findorfail($nisn);
          
           if ($user->foto_siswa != 'default.png') {
    Storage::disk('public')->delete('foto_profile_siswa/' . $user->foto_siswa);
}

            $user->delete();
            return redirect('/Admin/Siswa')->with('berhasil', 'Data Siswa berhasil di Hapus');
        }

        public function ubah($nisn){
            $siswa = siswa::findorfail($nisn);
            $title = 'Edit data siswa';
            $jurusan = jurusan::get();
            return view('siswa.edit', ['title' => $title, 'siswa' => $siswa, 'jurusan' => $jurusan]);
        }

        public function edit($nisn, request $r){
            $siswa = siswa::findorfail($nisn);
            if($r->ubahPass == '1'){
                $r->validate([
                    'nisn' =>  'required',
                    'nama' => 'required',
                    'alamat' => 'required',
                   
                    'passwordAseli' => 'required',
                    'telp' => 'required',
                    'kelas' => 'required',
                    'tahun' => 'required',
                    'jurusan' => 'required',
                   
                ],
            [
                'nisn.required' => 'NIS harus diisi',
                'nama.required' => 'Nama harus diisi',
                'alamat.required' => 'Alamat harus diisi',
               
                'passwordAseli.required' => 'Tolong isi verifikasi password',
                'telp.required' => 'Nomor telephone harus diisi',
                'kelas.required' => 'Tolong pilih kelas',
                'tahun.required' => 'Tahun harus diisi',
                'jurusan.required' => 'Tolong pilih jurusan',
                'nisn.unique' => 'NIS ' . $r->nisn . ' sudah ada',
                
            ]);
            $siswa->password = bcrypt($r->passwordAseli);
            $siswa->nama_siswa = $r->nama;
            $siswa->alamat = $r->alamat;
            $siswa->telp = $r->telp;
            $siswa->kelas = $r->kelas;
            $siswa->tahun = $r->tahun;
            $siswa->id_jurusan = $r->jurusan;
            $siswa->golongan_darah = $r->golongan_darah;
            $siswa->nama_orang_tua_wali = $r->nama_ortu;
            $siswa->tempat_tanggal_lahir = $r->tampat_tanggal_lahir;
            $siswa->catatan_kesehatan = $r->catatan_kesehatan;
            $siswa->save();
        }else{
            $r->validate([
                'nisn' =>  'required',
                'nama' => 'required',
                'alamat' => 'required',
               
              
                'telp' => 'required',
                'kelas' => 'required',
                'tahun' => 'required',
                'jurusan' => 'required',
                
            ],
        [
            'nisn.required' => 'NIS harus diisi',
            'nama.required' => 'Nama harus diisi',
            'alamat.required' => 'Alamat harus diisi',
           
           
            'telp.required' => 'Nomor telephone harus diisi',
            'kelas.required' => 'Tolong isikan kelas',
            'tahun.required' => 'Tahun harus diisi',
            'jurusan.required' => 'Tolong pilih jurusan',
           
           
        ]);

        $siswa->nama_siswa = $r->nama;
        $siswa->alamat = $r->alamat;
        $siswa->telp = $r->telp;
        $siswa->kelas = $r->kelas;
        $siswa->tahun = $r->tahun;
        $siswa->id_jurusan = $r->jurusan;
        $siswa->golongan_darah = $r->golongan_darah;
        $siswa->nama_orang_tua_wali = $r->nama_ortu;
        $siswa->tempat_tanggal_lahir = $r->tampat_tanggal_lahir;
        $siswa->catatan_kesehatan = $r->catatan_kesehatan;
        $siswa->save();
        }
       
            return redirect('/Admin/Siswa')->with('berhasil', 'Data siswa berhasil diubah');
        }

        public function print(){
            $title = 'Print data Siswa';
            $jurusan = jurusan::get();
            return view('siswa.tentukan', ['title' => $title, 'jurusan' => $jurusan]);
        }

        public function pdf(request $r){
            // dd($r->pilih);
            if($r->pilih != null){
                $siswa = siswa::join('tb_jurusan','siswa.id_jurusan','=','tb_jurusan.id_jurusan')->select('siswa.*','tb_jurusan.nama_jurusan')
                ->where('siswa.id_jurusan','=',$r->pilih)->get();
                $juruss = jurusan::where('id_jurusan','=',$r->pilih)->first();
                $jur = $juruss->nama_jurusan;
            }else{
            $siswa = siswa::join('tb_jurusan','siswa.id_jurusan','=','tb_jurusan.id_jurusan')->select('siswa.*','tb_jurusan.nama_jurusan')->get();
            $jur = 'Semua Jurusan yang tersedia';
            }
            $pdf = new pdfController('L','mm','A4');
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->MultiCell(0, 10, 'Daftar Siswa', 0, 'C');
            $pdf->Ln(10);
            $pdf->Cell(40, 5, 'Laporan', 0, 1);
            $pdf->Cell(30, 10, 'Jurusan', 0, 0);
            $pdf->Cell(10, 10, ':', 0, 0);
            $pdf->Cell(50, 10, $jur, 0, 1);
            $pdf->Ln(10);
            $pdf->SetFont('Arial', 'B', 12);
            
            $pdf->Cell(50, 10, 'NIS', 1, 0, 'C');
            $pdf->Cell(80, 10, 'Nama', 1, 0, 'C');
            // $pdf->Cell(40, 10, 'Alamat', 1, 0, 'C');
            $pdf->Cell(40, 10, 'Telephone', 1, 0, 'C');
            $pdf->Cell(40, 10, 'Kelas', 1, 0, 'C');
            $pdf->Cell(40, 10, 'Tahun', 1, 0, 'C');
            $pdf->Cell(20, 10, 'Jurusan', 1, 1, 'C'); 
            
            foreach($siswa as $s){
                $pdf->SetFont('Arial', '', 12);
                $pdf->Cell(50, 10, $s->nisn, 1, 0, 'C');
                $pdf->Cell(80, 10, $s->nama_siswa, 1, 0, 'C');
                // $pdf->Cell(40, 10, $s->alamat, 1, 0, 'C');
                $pdf->Cell(40, 10, $s->telp, 1, 0, 'C');
                $pdf->Cell(40, 10, $s->kelas, 1, 0, 'C');
                $pdf->Cell(40, 10, $s->tahun, 1, 0, 'C');
                $pdf->Cell(20, 10, $s->nama_jurusan, 1, 1, 'C');
            }
            $pdf->output();
            exit;
        }
    
}
