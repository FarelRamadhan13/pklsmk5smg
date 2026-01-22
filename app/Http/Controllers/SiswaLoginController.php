<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\siswa;
use App\Models\jurusan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\kegiatan_harian;
use App\Models\guruPendamping;
use App\Models\tb_prakerin;
use App\Models\pkl;
use App\Models\User;
use App\Models\jurnalPKL;
use App\Models\suratPermohonan;
use App\Models\hadir;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cookie;


use Carbon\Carbon;

use App\Http\Controllers\pdf\pdfController;



class SiswaLoginController extends Controller
{
    public function index(){
        $title = ucwords(strtolower(auth()->guard('siswa')->user()->nama_siswa));
        $jurusan = jurusan::findorfail(auth()->guard('siswa')->user()->id_jurusan);
        $hitung_jurnal = jurnalPKL::join('tb_prakerin', 'tb_prakerin.idprakerin', '=', 'jurnalpkl.prakerin')
        ->join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')
        ->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
        ->join('tb_jurusan','siswa.id_jurusan','=','tb_jurusan.id_jurusan')
        ->select('jurnalpkl.*', 'tbl_gurupendamping.nama', 'tbl_gurupendamping.nip', 'siswa.*', 'tb_jurusan.*', 'tb_pkl.*')
        ->where('siswa.nisn', auth()->guard('siswa')->user()->nisn)->count();

        
            $jurnal = jurnalPKL::join('tb_prakerin', 'tb_prakerin.idprakerin', '=', 'jurnalpkl.prakerin')
        ->join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')
        ->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
        ->join('tb_jurusan','siswa.id_jurusan','=','tb_jurusan.id_jurusan')
        ->select('jurnalpkl.*', 'tbl_gurupendamping.nama', 'tbl_gurupendamping.nip', 'siswa.*', 'tb_jurusan.*', 'tb_pkl.*','tb_prakerin.start', 'tb_prakerin.end')
        ->where('siswa.nisn', auth()->guard('siswa')->user()->nisn)->latest('jurnalpkl.tanggal')->first();

        $tanggalHariIni = Carbon::today();
        $cek_hari = Carbon::today()->format('Y-m-d');

        
        if ($tanggalHariIni->isSaturday() || $tanggalHariIni->isSunday()) {
            $cek_hadir = 1;
            $cek_kegiatan = 1;

            if($hitung_jurnal > 0){

                // $absensi = hadir::where(function($query) use ($tanggalHariIni) {
                //     $query->where('tanggal', $tanggalHariIni->toDateString());
                // })->where('jurnal', '=', $jurnal->id)->count();

                $cek_absen = hadir::where(function($query) use ($tanggalHariIni) {
                    $query->where('tanggal', $tanggalHariIni->toDateString());
                })->where('jurnal', '=', $jurnal->id)->first();
                
                $cek_prakerin = tb_prakerin::join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
                ->select('tb_prakerin.*', 'tb_pkl.nama_pkl','tb_pkl.alamat_pkl', 'siswa.nama_siswa','siswa.kelas','tbl_gurupendamping.nama','siswa.id_jurusan')->where('siswa.nama_siswa','=',auth()->guard('siswa')->user()->nama_siswa)->count();

                $absen = hadir::where(function($query) {
                    $query->where('foto_pulang', '=', null)
                          ->orWhere('waktu_pulang', '=', null);
                })->where('jurnal', '=', $jurnal->id)->latest()->first();
                $cek_sakit = hadir::where(function($query) use ($tanggalHariIni) {
                    $query->where('izin', '=', '1')
                          ->where('tanggal', '=', $tanggalHariIni->toDateString());
                })->where('jurnal', '=', $jurnal->id)->count();
            }else{
                $cek_prakerin = tb_prakerin::join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
                ->select('tb_prakerin.*', 'tb_pkl.nama_pkl','tb_pkl.alamat_pkl', 'siswa.nama_siswa','siswa.kelas','tbl_gurupendamping.nama','siswa.id_jurusan')->where('siswa.nama_siswa','=',auth()->guard('siswa')->user()->nama_siswa)->count();

                $cek_absen = hadir::where(function($query) use ($tanggalHariIni) {
                    $query->where('tanggal', $tanggalHariIni->toDateString());
                })->where('jurnal', '=', null)->first();

                $absen = hadir::where(function($query) {
                    $query->where('foto_pulang', '=', null)
                          ->orWhere('waktu_pulang', '=', null);
                })->where('jurnal', '=', null)->latest()->first();
                $cek_sakit = hadir::where(function($query) use ($tanggalHariIni) {
                    $query->where('izin', '=', '1')
                          ->where('tanggal', '=', $tanggalHariIni->toDateString());
                })->where('jurnal', '=', null)->count();
            }
        } else {
        if ($hitung_jurnal > 0) {
                $absen = hadir::where(function($query) {
                $query->where('foto_pulang', '=', null)
                      ->orWhere('waktu_pulang', '=', null);
                })->where('jurnal', '=', $jurnal->id)->latest()->first();
        
                $cek_sakit = hadir::where(function($query) use ($tanggalHariIni) {
                    $query->where('izin', '=', '1')
                          ->where('tanggal', '=', $tanggalHariIni->toDateString());
                })->where('jurnal', '=', $jurnal->id)->count();
           
                $cek_hadir = hadir::where(function($query) use ($tanggalHariIni) {
                    $query->where('tanggal', $tanggalHariIni->toDateString());
                })->where('jurnal', '=', $jurnal->id)->count();

                $cek_absen = hadir::where(function($query) use ($tanggalHariIni) {
                    $query->where('tanggal', $tanggalHariIni->toDateString());
                })->where('jurnal', '=', $jurnal->id)->first();
        
                $cek_kegiatan = kegiatan_harian::where(function($query) use ($tanggalHariIni) {
                    $query->where('tanggal', $tanggalHariIni->toDateString());
                })->where('jurnal', '=', $jurnal->id)->count();

                $cek_prakerin = tb_prakerin::join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
                ->select('tb_prakerin.*', 'tb_pkl.nama_pkl','tb_pkl.alamat_pkl', 'siswa.nama_siswa','siswa.kelas','tbl_gurupendamping.nama','siswa.id_jurusan')->where('siswa.nama_siswa','=',auth()->guard('siswa')->user()->nama_siswa)->count();
        
        } else {
            $absen = hadir::where(function($query) {
                $query->where('foto_pulang', '=', null)
                      ->orWhere('waktu_pulang', '=', null);
            })->where('jurnal', '=', null)->latest()->first();

            $cek_absen = hadir::where(function($query) use ($tanggalHariIni) {
                $query->where('tanggal', $tanggalHariIni->toDateString());
            })->where('jurnal', '=', null)->first();
          
            $cek_sakit = hadir::where(function($query) use ($tanggalHariIni) {
                $query->where('izin', '=', '1')
                      ->where('tanggal', '=', $tanggalHariIni->toDateString());
            })->where('jurnal', '=', null)->count();

                $cek_hadir = hadir::where(function($query) use ($tanggalHariIni) {
                    $query->where('tanggal', $tanggalHariIni->toDateString());
                })->where('jurnal', '=', null)->count();
        
                $cek_kegiatan = kegiatan_harian::where(function($query) use ($tanggalHariIni) {
                    $query->where('tanggal', $tanggalHariIni->toDateString());
                })->where('jurnal', '=', null)->count();

               $cek_prakerin = tb_prakerin::join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
                ->select('tb_prakerin.*', 'tb_pkl.nama_pkl','tb_pkl.alamat_pkl', 'siswa.nama_siswa','siswa.kelas','tbl_gurupendamping.nama','siswa.id_jurusan')->where('siswa.nama_siswa','=',auth()->guard('siswa')->user()->nama_siswa)->count();
            
        }
    }
        return view('SiswaLogin.index', ['cek_prakerin' => $cek_prakerin, 'cek_absen' => $cek_absen, 'cek_sakit' => $cek_sakit,'title' => $title, 'cek_hadir' => $cek_hadir, 'cek_kegiatan' => $cek_kegiatan, 'jurusan' => $jurusan, 'jurnal' => $jurnal, 'absen' => $absen, 'cek_hari' => $cek_hari]);
    }

    public function ubah(){
        $siswa = siswa::findorfail(auth()->guard('siswa')->user()->nisn);
        $jurusan = jurusan::get();
        $title = 'Edit Siswa';
        return view('SiswaLogin.edit', ['title' => $title, 'siswa' => $siswa, 'jurusan' => $jurusan]);
    }

    public function edit(request $r){
        $siswa = siswa::findorfail(auth()->guard('siswa')->user()->nisn);
        if($r->ubahPass == '1'){
            $r->validate([
                'nisn' =>  'required',
                'nama' => 'required|max:25',
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
            'nama.max' => 'Maksimal adalah 25 karakter',
           
            'passwordAseli.required' => 'Tolong isi verifikasi password',
            'telp.required' => 'Nomor telephone harus diisi',
            'kelas.required' => 'Tolong pilih kelas',
            'tahun.required' => 'Tahun harus diisi',
            'jurusan.required' => 'Tolong pilih jurusan',
            'nisn.unique' => 'NIS ' . $r->nisn . ' sudah ada',
           
        ]);
        $siswa->password = bcrypt($r->passwordAseli);
    }else{
        $r->validate([
            'nisn' =>  'required',
            'nama' => 'required|max:25',
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
        'nama.max' => 'Maksimal adalah 25 karakter',
       
       
        'telp.required' => 'Nomor telephone harus diisi',
        'kelas.required' => 'Tolong pilih kelas',
        'tahun.required' => 'Tahun harus diisi',
        'jurusan.required' => 'Tolong pilih jurusan',
       
       
    ]);
    }
    $siswa->nama_siswa = $r->nama;
    $siswa->alamat = $r->alamat;
    $siswa->telp = $r->telp;
    $siswa->kelas = $r->kelas;
    $siswa->tahun = $r->tahun;
    $siswa->golongan_darah = $r->golongan_darah;
    $siswa->nama_orang_tua_wali = $r->nama_ortu;
    $siswa->tempat_tanggal_lahir = $r->tampat_tanggal_lahir;
    $siswa->catatan_kesehatan = $r->catatan_kesehatan;
    $siswa->save();
        return redirect('/Siswa')->with('berhasil', 'Data profil kamu berhasil diubah'); 
    }

    public function prakerin(){
        $title = 'Prakerin';
        $prakerin = tb_prakerin::join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
        ->select('tb_prakerin.*', 'tb_pkl.nama_pkl','tb_pkl.alamat_pkl', 'siswa.nama_siswa','siswa.kelas','tbl_gurupendamping.nama','siswa.id_jurusan')->where('siswa.nama_siswa','=',auth()->guard('siswa')->user()->nama_siswa)->get();
        return view('siswa.prakerin', ['title' => $title, 'prakerin' => $prakerin]);
    }

    public function pengajuantambah(){
        $title = 'Pengajuan Siswa';
        if(auth()->guard('siswa')->check()){
            $siswa = siswa::where('nisn', '!=',auth()->guard('siswa')->user()->nisn)->get();

        }else{
            $siswa = siswa::get();
        }
        $pkl = pkl::where('Status','=','1')->get();
        $kSekolah = User::where('hak_akses','=','1')->get();
        return view('SiswaLogin.pengajuan', ['title' => $title, 'pkl' => $pkl, 'siswa' => $siswa, 'kSekolah' => $kSekolah]);
    }

    public function pengajuan(){
        $title = 'Pengajuan Siswa';
        if(auth()->guard('siswa')->check()){
           
            $surat = suratPermohonan::where('siswa1','=',auth()->guard('siswa')->user()->nisn)->orwhere('siswa2','=',auth()->guard('siswa')->user()->nisn)
            ->orwhere('siswa3','=',auth()->guard('siswa')->user()->nisn)->orwhere('siswa4','=',auth()->guard('siswa')->user()->nisn)->join('tb_pkl','suratpermohonan.industri','=','tb_pkl.idpkl')->where('tb_pkl.Status','=','1')->get();

        }else{
            $surat = suratPermohonan::join('tb_pkl','suratpermohonan.industri','=','tb_pkl.idpkl')->where('tb_pkl.Status','=','1')->get();
           
        }
      
       
        return view('SiswaLogin.surat', ['title' => $title, 'surat' => $surat]);
    }

    public function pdfSiswatambah(request $r){
           
    $r->validate([
        'pkl' => 'required',
        'jumlah' => 'required',
        'mulai' => 'required',
        'akhir' => 'required',
        'kepalasekolah' => 'required',
        'tahunPelajaran' => 'required',
        'tanggal' => 'required'
    ],
[
    'pkl.required' => 'Tolong pilih PKL / Industri',
    'jumlah.required' => 'Tolong pilih jumlah siswa',
    'mulai.required' => 'Tolong inputkan dimulainya PKL',
    'akhir.required' => 'Tolong inputkan tanggal akhir PKL',
    'kepalasekolah.required' => 'Tolong pilih kepala sekolah',
    'tahunPelajaran.required' => 'Tolong pilih tahun pelajaran',
    'tanggal.required' => 'Tolong inputkan tanggal'
]);
        if($r->jumlah == '1'){
            $r->validate([
                'siswa1' => 'required',
               
            ],
            [
                'siswa1.required' => 'Tolong pilih siswa pertama',
               
            ]);
            
            suratPermohonan::insert([
                'industri' => $r->pkl,
                'jumlah_siswa' => $r->jumlah,
                'tanggal_mulai' => $r->mulai,
                'tanggal_selesai' => $r->akhir,
                'kepsek' => $r->kepalasekolah,
                'tahun_pelajaran' => $r->tahunPelajaran,
                'tanggal' => $r->tanggal,
                'waktu_bulan' => $r->lama,
                'siswa1' => $r->siswa1,
                'tahun' => $r->tahun
            ]);
        }elseif($r->jumlah == '2'){
            if($r->siswa1 === $r->siswa2){
                return redirect()->back()->withInput()->with('error', 'Data Siswa tidak boleh ada yang sama');
            }
            $r->validate([
                'siswa1' => 'required',
                'siswa2' => 'required'
            ],
            [
                'siswa1.required' => 'Tolong pilih siswa pertama',
                'siswa2.required' => 'Tolong pilih siswa kedua'
            ]);

            suratPermohonan::insert([
                'industri' => $r->pkl,
                'jumlah_siswa' => $r->jumlah,
                'tanggal_mulai' => $r->mulai,
                'tanggal_selesai' => $r->akhir,
                'kepsek' => $r->kepalasekolah,
                'tahun_pelajaran' => $r->tahunPelajaran,
                'tanggal' => $r->tanggal,
                'waktu_bulan' => $r->lama,
                'siswa1' => $r->siswa1,
                'siswa2' => $r->siswa2,
                'tahun' => $r->tahun
            ]);

        }elseif($r->jumlah == '3'){
            if ($r->siswa1 === $r->siswa2 || $r->siswa1 === $r->siswa3 || $r->siswa2 === $r->siswa3) {
                return redirect()->back()->withInput()->with('error', 'Data Siswa tidak boleh ada yang sama');
            }
            
            $r->validate([
                'siswa1' => 'required',
                'siswa2' => 'required',
                'siswa3' => 'required'
            ],
            [
                'siswa1.required' => 'Tolong pilih siswa pertama',
                'siswa2.required' => 'Tolong pilih siswa kedua',
                'siswa3.required' => 'Tolong pilih siswa ketiga'
            ]);
            
            suratPermohonan::insert([
                'industri' => $r->pkl,
                'jumlah_siswa' => $r->jumlah,
                'tanggal_mulai' => $r->mulai,
                'tanggal_selesai' => $r->akhir,
                'kepsek' => $r->kepalasekolah,
                'tahun_pelajaran' => $r->tahunPelajaran,
                'tanggal' => $r->tanggal,
                'waktu_bulan' => $r->lama,
                'siswa1' => $r->siswa1,
                'siswa2' => $r->siswa2,
                'siswa3' => $r->siswa3,
                'tahun' => $r->tahun
            ]);

        }elseif($r->jumlah == '4'){
            if ($r->siswa1 === $r->siswa2 || $r->siswa1 === $r->siswa3 || $r->siswa1 === $r->siswa4 || $r->siswa2 === $r->siswa3 || $r->siswa2 === $r->siswa4 || $r->siswa3 === $r->siswa4) {
                return redirect()->back()->withInput()->with('error', 'Data Siswa tidak boleh sama');
            }
            
            $r->validate([
                'siswa1' => 'required',
                'siswa2' => 'required',
                'siswa3' => 'required',
                'siswa4' => 'required',

            ],
            [
                'siswa1.required' => 'Tolong pilih siswa pertama',
                'siswa2.required' => 'Tolong pilih siswa kedua',
                'siswa3.required' => 'Tolong pilih siswa ketiga',
                'siswa4.required' => 'Tolong pilih siswa keempat'
            ]);
            suratPermohonan::insert([
                'industri' => $r->pkl,
                'jumlah_siswa' => $r->jumlah,
                'tanggal_mulai' => $r->mulai,
                'tanggal_selesai' => $r->akhir,
                'kepsek' => $r->kepalasekolah,
                'tahun_pelajaran' => $r->tahunPelajaran,
                'tanggal' => $r->tanggal,
                'waktu_bulan' => $r->lama,
                'siswa1' => $r->siswa1,
                'siswa2' => $r->siswa2,
                'siswa3' => $r->siswa3,
                'siswa4' => $r->siswa4,
                'tahun' => $r->tahun

            ]);

        }
        return redirect('/Siswa/Pengajuan')->with('berhasil', 'Data Pengajuan berhasil ditambah');
    }
     
     
       

    public function getQuota($idpkl)
    {
        $quota = pkl::find($idpkl)->quota_pkl;
        return response()->json(['quota' => $quota]);
    }

    public function MultiCellWithColoredEmail($w, $h, $text, $email, $email_color = array(0, 0, 255))
    {
       
        $parts = explode($email, $text);

     
        $this->MultiCell($w, $h, $parts[0], 0, 'J');

       
        $x = $this->GetX();
        $y = $this->GetY();

        $this->SetTextColor($email_color[0], $email_color[1], $email_color[2]);
        $this->Cell($this->GetStringWidth($email), $h, $email, 0, 0, 'J', false);

       
        $this->SetTextColor(0, 0, 0);

      
        $this->SetXY($x + $this->GetStringWidth($email), $y);
        $this->MultiCell($w - $this->GetStringWidth($email), $h, $parts[1], 0, 'J');
    }

    public function pdf($id){
       
        function intToWord($number) {
            $words = [
                'nol', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh',
                'sebelas', 'dua belas', 'tiga belas', 'empat belas', 'lima belas', 'enam belas', 'tujuh belas', 'delapan belas', 'sembilan belas'
            ];
        
            if ($number < 20) {
                return $words[$number];
            } elseif ($number < 100) {
                return $words[floor($number / 10)] . ' puluh ' . $words[$number % 10];
            } elseif ($number < 200) {
                return 'seratus ' . intToWord($number % 100);
            } elseif ($number < 1000) {
                return $words[floor($number / 100)] . ' ratus ' . intToWord($number % 100);
            } elseif ($number < 2000) {
                return 'seribu ' . intToWord($number % 1000);
            } elseif ($number < 1000000) {
                return intToWord(floor($number / 1000)) . ' ribu ' . intToWord($number % 1000);
            } elseif ($number < 1000000000) {
                return intToWord(floor($number / 1000000)) . ' juta ' . intToWord($number % 1000000);
            } elseif ($number < 1000000000000) {
                return intToWord(floor($number / 1000000000)) . ' miliar ' . intToWord(fmod($number, 1000000000));
            } else {
                return 'out of range';
            }
        }
        $surat = suratPermohonan::findorfail($id);
        $id = sprintf('%04d', $surat->id);
        $kSekolah = User::findorfail($surat->kepsek);
        $lama = intToWord($surat->waktu_bulan);
        $jumlah = intToWord($surat->jumlah_siswa);
        $tanggalll = $surat->tanggal;
        $tanggall = Carbon::parse($tanggalll);
        $tanggal = $tanggall->isoFormat('D MMMM YYYY');

        $bulan = $tanggall->month;
        $romawi = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII',
        ];

        $formatBulanRomawi = $romawi[$bulan];

        $mulaiii = $surat->tanggal_mulai;
        $mulaii = Carbon::parse($mulaiii);
        $mulai = $mulaii->isoFormat('D MMMM YYYY');
        $akhirr = $surat->tanggal_selesai;
        $akhirr = Carbon::parse($akhirr);
        $akhir = $akhirr->isoFormat('D MMMM YYYY');

        $pkl = pkl::findorfail($surat->industri);
    if($surat->jumlah_siswa == '1'){
        if(auth()->guard('siswa')->check()){
            if($surat->siswa1 != auth()->guard('siswa')->user()->nisn){
                return redirect('/Siswa/Pengajuan');
            }
        }
        $siswa1 = siswa::findorfail($surat->siswa1);
        }elseif($surat->jumlah_siswa == '2'){
            if(auth()->guard('siswa')->check()){
                if($surat->siswa1 != auth()->guard('siswa')->user()->nisn && $surat->siswa2 != auth()->guard('siswa')->user()->nisn){
                    return redirect('/Siswa/Pengajuan');
                }
            }
            
            $siswa1 = siswa::findorfail($surat->siswa1);
            $siswa2 = siswa::findorfail($surat->siswa2);

        }elseif($surat->jumlah_siswa == '3'){
            if(auth()->guard('siswa')->check()){
                if($surat->siswa1 != auth()->guard('siswa')->user()->nisn && $surat->siswa2 != auth()->guard('siswa')->user()->nisn && $surat->siswa3 != auth()->guard('siswa')->user()->nisn){
                    return redirect('/Siswa/Pengajuan');
                }
            }
            $siswa1 = siswa::findorfail($surat->siswa1);
            $siswa2 = siswa::findorfail($surat->siswa2);
            $siswa3 = siswa::findorfail($surat->siswa3);

        }elseif($surat->jumlah_siswa == '4'){
            if(auth()->guard('siswa')->check()){
                if($surat->siswa1 != auth()->guard('siswa')->user()->nisn && $surat->siswa2 != auth()->guard('siswa')->user()->nisn && $surat->siswa3 != auth()->guard('siswa')->user()->nisn && $surat->siswa4 != auth()->guard('siswa')->user()->nisn){
                    return redirect('/Siswa/Pengajuan');
                }
            }
            $siswa1 = siswa::findorfail($surat->siswa1);
            $siswa2 = siswa::findorfail($surat->siswa2);
            $siswa3 = siswa::findorfail($surat->siswa3);
            $siswa4 = siswa::findorfail($surat->siswa4);
        }
        
        $pdf = new pdfController('P', 'mm', array(216, 330));
        $pdf->AddFont('tahoma','','tahoma.php');
        $pdf->AddFont('tahoma','B','TAHOMAB0.php');
        $pdf->AddPage();
        $pdf->setFont('Times', '', 12);
        $pdf->image(Storage::disk('public')->path('logo/Jawa.PNG'), 17.5, 7.5, 38, 28);
        $pdf->image(Storage::disk('public')->path('default/smk.png'), 170, 7, 25, 29);
        $pdf->Cell(0, 5, 'PEMERINTAH PROVINSI JAWA TENGAH', 0, 1, 'C');
        $pdf->setFont('Times', '', 14);
        $pdf->Cell(0, 7, 'DINAS PENDIDIKAN', 0, 1, 'C');
        $pdf->setFont('Times', 'B', 14);
        $pdf->Cell(0, 5, 'SEKOLAH MENENGAH KEJURUAN NEGERI 5', 0, 1, 'C'); $pdf->Cell(0, 5, 'SEMARANG', 0, 1, 'C');
        $pdf->setFont('Times','',9);
        $pdf->Cell(0, 5, 'Jalan Dr. Cipto No. 121, Kec. Semarang Timur, Kota Semarang', 0, 1, 'C');
       
        $pdf->Cell(0, 2, 'Kode Pos 50124, Telepon 024-8416335, Faksimile 024-8447476, laman smkn5smg.sch.id', 0, 1, 'C');
            $pdf->Ln(3);
            $pdf->SetLineWidth(1);
            $pdf->Line($pdf->getX() + 14, $pdf->getY(), $pdf->getX() + 187, $pdf->getY());
        // $pdf->Ln(1);
        $pdf->SetMargins(25, 20, 20);
        $pdf->setY($pdf->getY() + 3);
        
       
        $pdf->setFont('tahoma', '', 12);
        $pdf->Cell(20, 5, 'Nomor', 0, 0);
        $pdf->Cell(0, 5, ': B/'. $id . '/'. $formatBulanRomawi .'/SMK.PKL/' . $surat->tahun , 0, 1);
        $pdf->setXY(130, 39.6);
        $pdf->Cell(0, 15, 'Semarang, ' . $tanggal, 0, 1, 'R');
        $pdf->Cell(20, 0, 'Lampiran' , 0, 0);
        $pdf->Cell(0, 0, ': -' , 0, 1);
        $pdf->Cell(20, 13, 'Perihal' , 0, 0);
        $pdf->Cell(3, 13, ': ' , 0, 0);
        $pdf->setFont('tahoma', 'B', 12);
        $pdf->Cell(0, 13, 'Permohonan Praktik Kerja Lapangan (PKL)' , 0, 1);
        $pdf->Ln(6);
        $pdf->setFont('tahoma', '', 12);

        
        $pdf->Cell(29, 7, 'Yth.  Pimpinan ', 0, 0);
        $pdf->setFont('tahoma', 'B', 12);
        $pdf->MultiCell(0, 7, $pkl->nama_pkl, 0, 'J');
        $pdf->setFont('tahoma', '', 12);
        $pdf->MultiCell(0, 7, $pkl->alamat_pkl, 0, 'J');
        $pdf->MultiCell(110, 7, 'Di Tempat', 0, 1);
        
        $pdf->SetY($pdf->getY() - 52.5);
            
        $pdf->setY($pdf->getY() + 55);
        $pdf->Ln(3);

        $pdf->setX($pdf->getX() + 8);
        $pdf->Cell(20, 10, 'Dengan hormat,', 0, 1);
        $pdf->setX($pdf->getX() + 8);
        $pdf->MultiCell(0, 8, 'Berdasarkan Program Kerja SMK Negeri 5 Semarang tentang Praktik Kerja Lapangan (PKL) Tahun Pelajaran ' . $surat->tahun_pelajaran . ', dengan ini kami mohon kepada Pimpinan ' . $pkl->nama_pkl . ' untuk berkenan menerima siswa SMK Negeri 5 Semarang untuk melaksanakan Praktik Kerja Lapangan (PKL) dalam waktu ' . $surat->waktu_bulan . ' ( ' . $lama . ' )  bulan mulai tanggal ' . $mulai . ' sampai dengan ' . $akhir . '. Adapun siswa yang akan mengikuti Praktik Kerja Lapangan (PKL) sejumlah ' . $surat->jumlah_siswa . ' ( ' . $jumlah .' ) orang dengan data sebagai berikut:', 0, 'J');
        $pdf->Ln(2);
        $pdf->SetLineWidth(0);
        $pdf->setX($pdf->getX() + 10);
        $pdf->setFont('tahoma', 'B', 12);
        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(85.9, 10, 'Nama', 1, 0, 'C');
        $pdf->Cell(39, 10, 'NIS', 1, 0, 'C');
        $pdf->Cell(25, 10, 'Kelas', 1, 1, 'C');

        $pdf->setX($pdf->getX() + 10);
        $pdf->setFont('tahoma', '', 10);
        $pdf->Cell(10, 10, '1', 1, 0, 'C');
        $pdf->Cell(85.9, 10, $siswa1->nama_siswa, 1, 0, 'C');
        $pdf->Cell(39, 10, $siswa1->nisn, 1, 0, 'C');
        $pdf->Cell(25, 10, $siswa1->kelas, 1, 1, 'C');
        

        if(isset($siswa2)){
            $pdf->setX($pdf->getX() + 10);
            $pdf->setFont('tahoma', '', 10);
            $pdf->Cell(10, 10, '2', 1, 0, 'C');
            $pdf->Cell(85.9, 10, $siswa2->nama_siswa, 1, 0, 'C');
            $pdf->Cell(39, 10, $siswa2->nisn, 1, 0, 'C');
            $pdf->Cell(25, 10, $siswa2->kelas, 1, 1, 'C');
        }

        if(isset($siswa3)){
            $pdf->setX($pdf->getX() + 10);
            $pdf->setFont('tahoma', '', 10);
            $pdf->Cell(10, 10, '3', 1, 0, 'C');
            $pdf->Cell(85.9, 10, $siswa3->nama_siswa, 1, 0, 'C');
            $pdf->Cell(39, 10, $siswa3->nisn, 1, 0, 'C');
            $pdf->Cell(25, 10, $siswa3->kelas, 1, 1, 'C');
        }

        if(isset($siswa4)){
            $pdf->setX($pdf->getX() + 10);
            $pdf->setFont('tahoma', '', 10);
            $pdf->Cell(10, 10, '4', 1, 0, 'C');
            $pdf->Cell(85.9, 10, $siswa4->nama_siswa, 1, 0, 'C');
            $pdf->Cell(39, 10, $siswa4->nisn, 1, 0, 'C');
            $pdf->Cell(25, 10, $siswa4->kelas, 1, 1, 'C');
        }
       
          
        $pdf->Ln(4);
        $pdf->setX($pdf->getX() + 8);
        
        $pdf->setFont('tahoma', '', 12);
        $pdf->MultiCell(0, 7, 'Adapun jawaban Bpk/Ibu/Sdr untuk menerima/belum menerima siswa/siswi kami, dapat dikirim melalui email Urs Praktek Kerja Lapangan (email=pklsmkn5smg@gmail.com).', 0, 'J');
        $pdf->setXY($pdf->getX() + 8, $pdf->getY() + 2);
        $pdf->setFont('tahoma', '', 12);
        $pdf->MultiCell(0, 7, 'Demikian Surat Permohonan PKL ini kami sampaikan. Atas perhatian, dukungan, serta kesediaannya disampaikan terima kasih. ', 0, 'J');
      
      
      
      
    //    $pdf->Ln(2);
       $pdf->setX($pdf->getX() + 150);
       $pdf->setXY(120, $pdf->getY() + 18);
       $pdf->Cell(50, 3, 'Kepala Sekolah,', 0, 1, '');
       $pdf->setXY(120, $pdf->getY() + 18.997);
       $pdf->setFont('tahoma', 'B', 12);
       $pdf->Cell(0, 3, $kSekolah->name, 0, 1, '');
       $pdf->setFont('tahoma', '', 12);
       $pdf->setX(120);
       $pdf->Cell(0, 8, 'NIP.' . $kSekolah->username, 0, 1, '');


       $pdf->SetMargins(10, 10, 10);
       $pdf->AddPage();
        $pdf->setFont('Times', '', 12);
        $pdf->image(Storage::disk('public')->path('logo/Jawa.PNG'), 17.5, 7.5, 38, 28);
        $pdf->image(Storage::disk('public')->path('default/smk.png'), 170, 7, 25, 29);
        $pdf->Cell(0, 5, 'PEMERINTAH PROVINSI JAWA TENGAH', 0, 1, 'C');
        $pdf->setFont('Times', '', 14);
        $pdf->Cell(0, 7, 'DINAS PENDIDIKAN', 0, 1, 'C');
        $pdf->setFont('Times', 'B', 14);
        $pdf->Cell(0, 5, 'SEKOLAH MENENGAH KEJURUAN NEGERI 5', 0, 1, 'C'); $pdf->Cell(0, 5, 'SEMARANG', 0, 1, 'C');
        $pdf->setFont('Times','',9);
        $pdf->Cell(0, 5, 'Jalan Dr. Cipto No. 121, Kec. Semarang Timur, Kota Semarang', 0, 1, 'C');
       
        $pdf->Cell(0, 2, 'Kode Pos 50124, Telepon 024-8416335, Faksimile 024-8447476, laman smkn5smg.sch.id', 0, 1, 'C');
            $pdf->Ln(3);
            $pdf->SetLineWidth(1);
            $pdf->Line($pdf->getX() + 14, $pdf->getY(), $pdf->getX() + 187, $pdf->getY());
       $pdf->Ln(2);
        // $pdf->setY($pdf->getY() + 1);
       $pdf->setFont('tahoma', '', 12);
      
       $pdf->setFont('tahoma', 'B', 12);
       $pdf->Cell(0, 10, 'PERSETUJUAN PENGAJUAN PRAKERIN' , 0, 1, 'C');
       $pdf->setFont('tahoma', '', 12);
       $pdf->Cell(0, 10, 'Tahun Pelajaran ' . $surat->tahun_pelajaran , 0, 1, 'C');
       $pdf->Cell(0, 10, 'Waktu Pelaksanaan : '. $mulai .' sampai dengan ' . $akhir , 0, 1, 'C');
       $pdf->Ln(10);
       $pdf->setX($pdf->getX() + 25);
       $pdf->Cell(31.3, 10, 'Nama DU/Di (Bengkel)                   ', 0, 0, '');
       $pdf->setX($pdf->getX() + 30);
       $pdf->setFont('tahoma', 'B', 12);
       $pdf->MultiCell(100, 10, ': ' , 0, 0, '');
       $pdf->setXY($pdf->getX() + 88, $pdf->getY() - 10);
       $pdf->MultiCell(100, 10, ' ' . $pkl->nama_pkl , 0, 1, '');

       $pdf->setFont('tahoma', '', 12);
       $pdf->setX($pdf->getX() + 25);
       $pdf->Cell(31.3, 10, 'Nama Pimpinan                   ', 0, 0, '');
       $pdf->setX($pdf->getX() + 30);
       $pdf->Cell(100, 10, ': ' . $pkl->nama_pimpinan , 0, 1, '');

       $pdf->setFont('tahoma', '', 12);
      
       $pdf->setX($pdf->getX() + 25);
       $pdf->Cell(31.3, 10, 'Alamat DU/DI                   ', 0, 0, '');
       $pdf->setX($pdf->getX() + 30);
       $pdf->MultiCell(90, 10, ':' , 0, 0, '');
       $pdf->setXY($pdf->getX() + 89.2, $pdf->getY() - 10);
       $pdf->MultiCell(90, 10, $pkl->alamat_pkl , 0, 'J', '');

       $pdf->setFont('tahoma', '', 12);
       $pdf->setX($pdf->getX() + 25);
       $pdf->Cell(31.3, 10, 'No. Tlp. / Hp                   ', 0, 0, '');
       $pdf->setX($pdf->getX() + 30);
       $pdf->Cell(100, 10, ': ' . $pkl->telp , 0, 1, '');

       $pdf->setFont('tahoma', '', 12);
       $pdf->setX($pdf->getX() + 25);
       $pdf->Cell(31.3, 10, 'Nama Siswa                   ', 0, 0, '');
       $pdf->setX($pdf->getX() + 30);
       $pdf->Cell(100, 10, ': ', 0, 1, '');

       $pdf->SetLineWidth(0);
        $pdf->setX($pdf->getX() + 32);
        $pdf->setFont('tahoma', 'B', 12);
        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(74, 10, 'Nama', 1, 0, 'C');
        $pdf->Cell(39, 10, 'NIS', 1, 0, 'C');
        $pdf->Cell(25, 10, 'Kelas', 1, 1, 'C');

        $pdf->setX($pdf->getX() + 32);
        $pdf->setFont('tahoma', '', 10);
        $pdf->Cell(10, 10, '1', 1, 0, 'C');
        $pdf->Cell(74, 10, $siswa1->nama_siswa, 1, 0, 'C');
        $pdf->Cell(39, 10, $siswa1->nisn, 1, 0, 'C');
        $pdf->Cell(25, 10, $siswa1->kelas, 1, 1, 'C');
        

        if(isset($siswa2)){
            $pdf->setX($pdf->getX() + 32);
            $pdf->setFont('tahoma', '', 10);
            $pdf->Cell(10, 10, '2', 1, 0, 'C');
            $pdf->Cell(74, 10, $siswa2->nama_siswa, 1, 0, 'C');
            $pdf->Cell(39, 10, $siswa2->nisn, 1, 0, 'C');
            $pdf->Cell(25, 10, $siswa2->kelas, 1, 1, 'C');
        }

        if(isset($siswa3)){
            $pdf->setX($pdf->getX() + 32);
            $pdf->setFont('tahoma', '', 10);
            $pdf->Cell(10, 10, '3', 1, 0, 'C');
            $pdf->Cell(74, 10, $siswa3->nama_siswa, 1, 0, 'C');
            $pdf->Cell(39, 10, $siswa3->nisn, 1, 0, 'C');
            $pdf->Cell(25, 10, $siswa3->kelas, 1, 1, 'C');
        }

        if(isset($siswa4)){
            $pdf->setX($pdf->getX() + 32);
            $pdf->setFont('tahoma', '', 10);
            $pdf->Cell(10, 10, '4', 1, 0, 'C');
            $pdf->Cell(74, 10, $siswa4->nama_siswa, 1, 0, 'C');
            $pdf->Cell(39, 10, $siswa4->nisn, 1, 0, 'C');
            $pdf->Cell(25, 10, $siswa4->kelas, 1, 1, 'C');
        }

        $pdf->setFont('tahoma', '', 12);
        $pdf->setX($pdf->getX() + 150);
        $pdf->setXY(120, 236);
        $pdf->Cell(50, 3, 'Menyetujui,', 0, 1, '');
        $pdf->setXY(120, 243.2);
        $pdf->Cell(50, 3, 'Ka. Program TKR/TKJ/RPL/TEI/KI', 0, 1, '');
        $pdf->setXY(120, 265);
        $pdf->setFont('tahoma', '', 12);
        $pdf->Cell(0, 3, '(..................................................)', 0, 1, '');
        $pdf->setFont('tahoma', '', 12);
        $pdf->setX(120);
        $pdf->Cell(0, 8, 'NIP', 0, 1, '');
    //    $pdf->setX($pdf->getX() + 46.2);
        $pdf->Output('I', 'pengajuan' . $id .'.pdf');
        exit;
    }
    public function Hapuspengajuan($id){
        $surat = suratPermohonan::findorfail($id);
        if($surat->suratPengantar == '1'){
            $pesanTambahan = ' dan Surat Pengantar ';
        }else{
            $pesanTambahan = ' ';
        }
        $surat->delete();
        return redirect('/Siswa/Pengajuan')->with('berhasil', 'Surat Pengajuan' . $pesanTambahan . 'berhasil dihapus');
    }

    public function tambahPengantar($id){
        $surat = suratPermohonan::findorfail($id);
        $surat->suratPengantar = '1';
        $surat->tanggal_pengantar = now();
        $surat->save();
        return redirect('/Siswa/Pengajuan')->with('berhasil', 'Surat Pengantar berhasil di Tambahkan di surat permohonan nomor ' . $surat->id);
    }

    public function pdfPengantar($id){
        
        function intToWord($number) {
            $words = [
                'nol', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh',
                'sebelas', 'dua belas', 'tiga belas', 'empat belas', 'lima belas', 'enam belas', 'tujuh belas', 'delapan belas', 'sembilan belas'
            ];
        
            if ($number < 20) {
                return $words[$number];
            } elseif ($number < 100) {
                return $words[floor($number / 10)] . ' puluh ' . $words[$number % 10];
            } elseif ($number < 200) {
                return 'seratus ' . intToWord($number % 100);
            } elseif ($number < 1000) {
                return $words[floor($number / 100)] . ' ratus ' . intToWord($number % 100);
            } elseif ($number < 2000) {
                return 'seribu ' . intToWord($number % 1000);
            } elseif ($number < 1000000) {
                return intToWord(floor($number / 1000)) . ' ribu ' . intToWord($number % 1000);
            } elseif ($number < 1000000000) {
                return intToWord(floor($number / 1000000)) . ' juta ' . intToWord($number % 1000000);
            } elseif ($number < 1000000000000) {
                return intToWord(floor($number / 1000000000)) . ' miliar ' . intToWord(fmod($number, 1000000000));
            } else {
                return 'out of range';
            }
        }
        $surat = suratPermohonan::findorfail($id);
        if($surat->suratPengantar != '1'){
            return redirect()->back()->with('error', 'Surat pengantar belum tersedia');
        }
        $id = sprintf('%04d', $surat->id);
        $kSekolah = User::findorfail($surat->kepsek);
        $lama = intToWord($surat->waktu_bulan);
        $jumlah = intToWord($surat->jumlah_siswa);
        $tanggalll = $surat->tanggal_pengantar;
        $tanggall = Carbon::parse($tanggalll);
        $tanggal = $tanggall->isoFormat('D MMMM YYYY');

        $bulan = $tanggall->month;
        $romawi = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII',
        ];

        $formatBulanRomawi = $romawi[$bulan];

        $mulaiii = $surat->tanggal_mulai;
        $mulaii = Carbon::parse($mulaiii);
        $mulai = $mulaii->isoFormat('D MMMM YYYY');
        $akhirr = $surat->tanggal_selesai;
        $akhirr = Carbon::parse($akhirr);
        $akhir = $akhirr->isoFormat('D MMMM YYYY');

        $pkl = pkl::findorfail($surat->industri);
    if($surat->jumlah_siswa == '1'){
        if(auth()->guard('siswa')->check()){
            if($surat->siswa1 != auth()->guard('siswa')->user()->nisn){
                return redirect('/Siswa/Pengajuan');
            }
        }
        $siswa1 = siswa::findorfail($surat->siswa1);
        }elseif($surat->jumlah_siswa == '2'){
            if(auth()->guard('siswa')->check()){
                if($surat->siswa1 != auth()->guard('siswa')->user()->nisn && $surat->siswa2 != auth()->guard('siswa')->user()->nisn){
                    return redirect('/Siswa/Pengajuan');
                }
            }
            $siswa1 = siswa::findorfail($surat->siswa1);
            $siswa2 = siswa::findorfail($surat->siswa2);

        }elseif($surat->jumlah_siswa == '3'){
            if(auth()->guard('siswa')->check()){
                if($surat->siswa1 != auth()->guard('siswa')->user()->nisn && $surat->siswa2 != auth()->guard('siswa')->user()->nisn && $surat->siswa3 != auth()->guard('siswa')->user()->nisn){
                    return redirect('/Siswa/Pengajuan');
                }
            }
            $siswa1 = siswa::findorfail($surat->siswa1);
            $siswa2 = siswa::findorfail($surat->siswa2);
            $siswa3 = siswa::findorfail($surat->siswa3);

        }elseif($surat->jumlah_siswa == '4'){
            if(auth()->guard('siswa')->check()){
                if($surat->siswa1 != auth()->guard('siswa')->user()->nisn && $surat->siswa2 != auth()->guard('siswa')->user()->nisn && $surat->siswa3 != auth()->guard('siswa')->user()->nisn && $surat->siswa4 != auth()->guard('siswa')->user()->nisn){
                    return redirect('/Siswa/Pengajuan');
                }
            }
            $siswa1 = siswa::findorfail($surat->siswa1);
            $siswa2 = siswa::findorfail($surat->siswa2);
            $siswa3 = siswa::findorfail($surat->siswa3);
            $siswa4 = siswa::findorfail($surat->siswa4);
        }
        $pdf = new pdfController('P', 'mm', array(216, 330));
        $pdf->AddFont('tahoma','','tahoma.php');
        $pdf->AddFont('tahoma','B','TAHOMAB0.php');
         $pdf->AddPage();
        $pdf->setFont('Times', '', 12);
        $pdf->image(Storage::disk('public')->path('logo/Jawa.PNG'), 9, 7.5, 38, 28);
        $pdf->image(Storage::disk('public')->path('default/smk.png'), 175, 7, 25, 29);

        $pdf->Cell(0, 5, 'PEMERINTAH PROVINSI JAWA TENGAH', 0, 1, 'C');
        $pdf->setFont('Times', '', 14);
        $pdf->Cell(0, 7, 'DINAS PENDIDIKAN', 0, 1, 'C');
        $pdf->setFont('Times', 'B', 14);
        $pdf->Cell(0, 5, 'SEKOLAH MENENGAH KEJURUAN NEGERI 5', 0, 1, 'C'); $pdf->Cell(0, 5, 'SEMARANG', 0, 1, 'C');
        $pdf->setFont('Times','',9);
        $pdf->Cell(0, 5, 'Jalan Dr. Cipto No. 121, Kec. Semarang Timur, Kota Semarang', 0, 1, 'C');
       
        $pdf->Cell(0, 2, 'Kode Pos 50124, Telepon 024-8416335, Faksimile 024-8447476, laman smkn5smg.sch.id', 0, 1, 'C');
            $pdf->Ln(3);
            $pdf->SetLineWidth(1);
            $pdf->Line($pdf->getX(), $pdf->getY(), $pdf->getX() + 197, $pdf->getY());
        $pdf->setY($pdf->getY() + 1);
        $pdf->setFont('tahoma', '', 12);
        $pdf->Cell(20, 8, 'Nomor', 0, 0);
        $pdf->Cell(0, 8, ': B/'. $id . '/'. $formatBulanRomawi .'/SMK.PKL/' . $surat->tahun , 0, 1);
        $pdf->setXY(130, 37.6);
        $pdf->Cell(0, 18, 'Semarang, ' . $tanggal, 0, 1, 'R');
        $pdf->Cell(20, -5, 'Lampiran' , 0, 0);
        $pdf->Cell(0, -5, ': -' , 0, 1);
        $pdf->Cell(20, 17, 'Perihal' , 0, 0);
        $pdf->Cell(3, 17, ': ' , 0, 0);
        $pdf->setFont('tahoma', 'B', 12);
        $pdf->Cell(0, 17, 'Pengantar Praktik Kerja Lapangan (PKL)' , 0, 1);
        $pdf->Ln(6);
        $pdf->setFont('tahoma', '', 12);
        
        $pdf->Cell(29, 7, 'Yth.  Pimpinan ', 0, 0);
        $pdf->setFont('tahoma', 'B', 12);
        $pdf->MultiCell(110, 7, $pkl->nama_pkl, 0, 'J');
        $pdf->setFont('tahoma', '', 12);
        $pdf->MultiCell(110, 7, $pkl->alamat_pkl, 0, 'J');
        $pdf->MultiCell(110, 7, 'Di Tempat', 0, 1);
        
        $pdf->SetY($pdf->getY() - 52.5);
           
            $pdf->setY($pdf->getY() + 55);
            $pdf->Ln(5);

            $pdf->setX($pdf->getX() + 15.3);
        $pdf->Cell(20, 10, 'Dengan hormat,', 0, 1);
        $pdf->setX($pdf->getX() + 15.3);
        $pdf->MultiCell(0, 8, 'Sesuai dengan Surat Permohonan PKL yang pernah kami sampaikan sebelumnya serta Persetujuan PKL dari ' . $pkl->nama_pkl . ', dengan ini kami menugaskan siswa untuk melaksanakan Praktik Kerja Lapangan (PKL) Tahun Pelajaran ' . $surat->tahun_pelajaran . ' selama ' . $surat->waktu_bulan .' ( ' . $lama . ' ) bulan mulai tanggal ' . $mulai . ' sampai dengan ' . $akhir . '. Kami mohon bantuan untuk dapat  menerima serta membimbing siswa kami sesuai dengan jadwal kegiatan dan tata tertib yang berlaku di perusahaan. Adapun siswa yang akan mengikuti kegiatan PKL adalah:', 0, 'J');
        $pdf->Ln(4);
        $pdf->SetLineWidth(0);
        $pdf->setX($pdf->getX() + 17);
        $pdf->setFont('tahoma', '', 12);
        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(67, 10, 'Nama', 1, 0, 'C');
        $pdf->Cell(51, 10, 'NIS', 1, 0, 'C');
        $pdf->Cell(45, 10, 'Kelas', 1, 1, 'C');

        $pdf->setX($pdf->getX() + 17);
        $pdf->setFont('tahoma', '', 12);
        $pdf->Cell(10, 10, '1', 1, 0, 'C');
        $pdf->Cell(67, 10, $siswa1->nama_siswa, 1, 0, 'C');
        $pdf->Cell(51, 10, $siswa1->nisn, 1, 0, 'C');
        $pdf->Cell(45, 10, $siswa1->kelas, 1, 1, 'C');
        

        
        if(isset($siswa2)){
            $pdf->setX($pdf->getX() + 17);
            $pdf->setFont('tahoma', '', 12);
            $pdf->Cell(10, 10, '2', 1, 0, 'C');
            $pdf->Cell(67, 10, $siswa2->nama_siswa, 1, 0, 'C');
            $pdf->Cell(51, 10, $siswa2->nisn, 1, 0, 'C');
            $pdf->Cell(45, 10, $siswa2->kelas, 1, 1, 'C');
        }

        if(isset($siswa3)){
            $pdf->setX($pdf->getX() + 17);
            $pdf->setFont('tahoma', '', 12);
            $pdf->Cell(10, 10, '3', 1, 0, 'C');
            $pdf->Cell(67, 10, $siswa3->nama_siswa, 1, 0, 'C');
            $pdf->Cell(51, 10, $siswa3->nisn, 1, 0, 'C');
            $pdf->Cell(45, 10, $siswa3->kelas, 1, 1, 'C');
        }

        if(isset($siswa4)){
            $pdf->setX($pdf->getX() + 17);
            $pdf->setFont('tahoma', '', 12);
            $pdf->Cell(10, 10, '4', 1, 0, 'C');
            $pdf->Cell(67, 10, $siswa4->nama_siswa, 1, 0, 'C');
            $pdf->Cell(51, 10, $siswa4->nisn, 1, 0, 'C');
            $pdf->Cell(45, 10, $siswa4->kelas, 1, 1, 'C');
        }
        
        
       
          
        $pdf->Ln(4);
        $pdf->setX($pdf->getX() + 15.5);
        $pdf->setFont('tahoma', '', 12);
        $pdf->MultiCell(0, 8, 'Demikian Surat Pengantar PKL ini kami sampaikan, atas perhatian, dukungan, serta kesediaannya disampaikan terima kasih.');
        // $pdf->image(Storage::disk('public')->path('logo/Jawa.PNG'), 6, 9, 37, 28);
      
      
    //    $pdf->Ln();
       $pdf->setX($pdf->getX() + 150);
       $pdf->setXY(120, 275);
       $pdf->Cell(50, 3, 'Kepala Sekolah,', 0, 1, '');
       $pdf->setXY(120, $pdf->getY() + 20.997);
       $pdf->setFont('tahoma', 'B', 12);
       $pdf->Cell(0, 3, $kSekolah->name, 0, 1, '');
       $pdf->setFont('tahoma', '', 12);
       $pdf->setX(120);
       $pdf->Cell(0, 8, 'NIP.' . $kSekolah->username, 0, 1, '');


       

        $pdf->Output('I', 'pengantar' . $id .'.pdf');
        exit;
    }

    public function editSurat($id){
        $title = 'Ubah surat Pengajuan Siswa';
        $surat = suratPermohonan::findorfail($id);
            $siswa = siswa::get();
            $pkl = pkl::where('Status','=','1')->get();
        $kSekolah = User::where('hak_akses','=','1')->get();
        return view('SiswaLogin.pengajuanEdit', ['title' => $title, 'pkl' => $pkl, 'siswa' => $siswa, 'kSekolah' => $kSekolah, 'surat' => $surat]);
    }

    public function ubahSurat($id, request $r){
        $surat = suratPermohonan::findorfail($id);
        $r->validate([
            'pkl' => 'required',
            'jumlah' => 'required',
            'mulai' => 'required',
            'akhir' => 'required',
            'kepalasekolah' => 'required',
            'tahunPelajaran' => 'required',
            'tanggal' => 'required'
        ],
    [
        'pkl.required' => 'Tolong pilih PKL / Industri',
        'jumlah.required' => 'Tolong pilih jumlah siswa',
        'mulai.required' => 'Tolong inputkan dimulainya PKL',
        'akhir.required' => 'Tolong inputkan tanggal akhir PKL',
        'kepalasekolah.required' => 'Tolong pilih kepala sekolah',
        'tahunPelajaran.required' => 'Tolong pilih tahun pelajaran',
        'tanggal.required' => 'Tolong inputkan tanggal'
    ]);
            if($r->jumlah == '1'){
                $r->validate([
                    'siswa1' => 'required',

                ],
                [
                    'siswa1.required' => 'Tolong pilih siswa pertama',
                   
                ]);

                $surat->siswa1 = $r->siswa1;
                
            }elseif($r->jumlah == '2'){
                if($r->siswa1 === $r->siswa2){
                    return redirect()->back()->withInput()->with('error', 'Data Siswa tidak boleh ada yang sama');
                }
                $r->validate([
                    'siswa1' => 'required',
                    'siswa2' => 'required'
                ],
                [
                    'siswa1.required' => 'Tolong pilih siswa pertama',
                    'siswa2.required' => 'Tolong pilih siswa kedua'
                ]);
    
                $surat->siswa1 = $r->siswa1;
                $surat->siswa2 = $r->siswa2;
    
            }elseif($r->jumlah == '3'){
                if($r->siswa1 === $r->siswa2 && $r->siswa1 === $r->siswa3){
                    return redirect()->back()->withInput()->with('error', 'Data Siswa tidak boleh ada yang sama');
                }
                $r->validate([
                    'siswa1' => 'required',
                    'siswa2' => 'required',
                    'siswa3' => 'required'
                ],
                [
                    'siswa1.required' => 'Tolong pilih siswa pertama',
                    'siswa2.required' => 'Tolong pilih siswa kedua',
                    'siswa3.required' => 'Tolong pilih siswa ketiga'
                ]);
                $surat->siswa1 = $r->siswa1;
                $surat->siswa2 = $r->siswa2;
                $surat->siswa3 = $r->siswa3;
               
            }elseif($r->jumlah == '4'){
                if($r->siswa1 === $r->siswa2 && $r->siswa1 === $r->siswa3 && $r->siswa1 === $r->siswa4){
                    return redirect()->back()->withInput()->with('error', 'Data Siswa tidak boleh sama');
                }
                $r->validate([
                    'siswa1' => 'required',
                    'siswa2' => 'required',
                    'siswa3' => 'required',
                    'siswa4' => 'required',
    
                ],
                [
                    'siswa1.required' => 'Tolong pilih siswa pertama',
                    'siswa2.required' => 'Tolong pilih siswa kedua',
                    'siswa3.required' => 'Tolong pilih siswa ketiga',
                    'siswa4.required' => 'Tolong pilih siswa keempat'
                ]);

                $surat->siswa1 = $r->siswa1;
                $surat->siswa2 = $r->siswa2;
                $surat->siswa3 = $r->siswa3;
                $surat->siswa4 = $r->siswa4;
              
            }
           if($r->pengantar == '0'){
            $surat->suratPengantar = '0';
            $surat->tanggal_pengantar = null;
           }else{
            $surat->suratPengantar = '1';
            $surat->tanggal_pengantar = $r->tanggal_pengantar;
           }
            $surat->industri = $r->pkl;
            $surat->jumlah_siswa =$r->jumlah;
            $surat->tanggal_mulai = $r->mulai;
            $surat->tanggal_selesai = $r->akhir;
            $surat->kepsek = $r->kepalasekolah;
            $surat->tahun_pelajaran = $r->tahunPelajaran;
            $surat->tanggal = $r->tanggal;
            $surat->waktu_bulan = $r->lama;
            $surat->tahun = $r->tahun;
            $surat->save();
            return redirect('/Siswa/Pengajuan')->with('berhasil', 'Surat Pengantar berhasil di Ubah di surat permohonan nomor ' . $surat->id);

    
    }

    public function editFoto(){
        $title = 'Ganti foto siswa';
        $siswa = siswa::findorfail(auth()->guard('siswa')->user()->nisn);

        return view('SiswaLogin.ubahFoto', ['title' => $title, 'siswa' => $siswa]);
    }

    public function ubahFoto(request $r){
        $r->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif'
        ],
        [
            'foto.required' => 'Tolong inputkan foto kamu',
            'foto.image' => 'Yang kamu inputkan bukan foto',
            'foto.mimes' => 'Yang kamu inputkan bukan foto'
        ]);

        $siswa = siswa::findorfail(auth()->guard('siswa')->user()->nisn);
        // if($siswa->foto_siswa != 'default.png'){
        //     unlink(public_path('foto_profile_siswa/' . $siswa->foto_siswa));
        // }
        // $file = $r->file('foto');
        // $fotoName = $file->hashName();
        // $file->move(public_path('/foto_profile_siswa'),$fotoName);

        if ($siswa->foto_siswa != 'default.png') {
           Storage::disk('public')->delete('foto_profile_siswa/' . $siswa->foto_siswa);
        }
        
        $file = $r->file('foto');
        $fotoName = $file->hashName();
        Storage::disk('public')->putFileAs('foto_profile_siswa/', $file, $fotoName);

        $siswa->foto_siswa = $fotoName;
        $siswa->save();

        return redirect('/Siswa')->with('berhasil', 'Foto kamu berhasil di Ubah');


    }

    public function hapusFoto($nisn){
        $siswa = siswa::findorfail($nisn);

       if ($siswa->foto_siswa != 'default.png') {
    Storage::disk('public')->delete('foto_profile_siswa/' . $siswa->foto_siswa);
}

        $siswa->foto_siswa = 'default.png';
        $siswa->save();

        return redirect('/Admin/Siswa')->with('berhasil', 'Foto siswa berhasil di Hapus');
    }

    public function editPass(){
        $title = 'Ubah Password';
        return view('SiswaLogin.ubahPass', ['title' => $title]);
    }

    public function ubahPass(Request $request){
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed',
        ],
    [
        'current_password.required' => 'Tolong isi Password lama',
        'new_password.required' => 'Tolong isi Password baru',
        'new_password.confirmed' => 'Tolong konfirmasi password'
    ]);
    
        $siswa = Auth::guard('siswa')->user();
    
        if (!Hash::check($request->current_password, $siswa->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai']);
        }
    
        $siswa->password = Hash::make($request->new_password);
        $siswa->save();
    
        
        Auth::guard('siswa')->logout();
        session()->flush();
        return redirect('login')->with('berhasil', 'Password berhasil diubah. Silakan login kembali.');
    }
    }

