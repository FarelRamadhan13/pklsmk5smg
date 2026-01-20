<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jurusan;
use App\Models\guruPendamping;
use App\Models\tb_prakerin;
use App\Models\pkl;
use App\Models\siswa;
use App\Models\User;
use App\Models\kunjungan;
use App\Http\Controllers\pdf\pdfController;
use App\Models\suratPendamping;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class guruPendampingLoginCOntroller extends Controller
{

    public function index(){
        $title = 'Guru Pendamping';
        $jurusan = jurusan::findorfail(auth()->guard('pendamping')->user()->id_jurusan);
        return view('guru_pendampingLogin.index', ['title' => $title, 'jurusan' => $jurusan]);
    }

    public function ubah(){
        $guruPendamping = guruPendamping::findorfail(auth()->guard('pendamping')->user()->nip);
        $jurusan = jurusan::get();
        $title = 'Edit Guru Pendamping';
        return view('guru_pendampingLogin.edit', ['title' => $title, 'jurusan' => $jurusan, 'guruPendamping' => $guruPendamping]);
    }

    public function edit(request $r){
        $guru = guruPendamping::findorfail(auth()->guard('pendamping')->user()->nip);

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
            $guru->password = bcrypt($r->passwordAseli);
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
        }
        $guru->nama = $r->nama;
        $guru->alamat = $r->alamat;
        $guru->telp = $r->telp;
        $guru->status = $r->status;
        $guru->tahun = $r->tahun;
        $guru->pangkat = $r->pangkat;
        $guru->jabatan = $r->jabatan;
        $guru->id_jurusan = $r->jurusan;
        $guru->save();
        return redirect('/Pendamping')->with('berhasil', 'Data anda berhasil diubah'); 
    }

    public function prakerin(){
        $title = 'Daftar Prakerin';
        $prakerin = tb_prakerin::join('tb_pkl', 'tb_prakerin.idpkl', '=', 'tb_pkl.idpkl')
    ->join('siswa', 'tb_prakerin.nisn', '=', 'siswa.nisn')
    ->join('tbl_gurupendamping', 'tb_prakerin.nip', '=', 'tbl_gurupendamping.nip')
    ->select('tb_prakerin.*', 'tb_pkl.nama_pkl', 'tb_pkl.alamat_pkl', 'siswa.nama_siswa', 'siswa.kelas', 'tbl_gurupendamping.nama', 'siswa.id_jurusan')
    ->where('tb_prakerin.nip', auth()->guard('pendamping')->user()->nip)
    ->get();

        return view('guru_pendampingLogin.prakerin', ['title' => $title, 'prakerin' => $prakerin]);
    }

    public function editPrakerin($idprakerin, request $r){
        $title = 'Ubah data prakerin';
        $prakerin = tb_prakerin::findOrFail($idprakerin);
    
        $pkl = pkl::where('status', '=', '1')
            ->whereRaw('quota_pkl - (SELECT COUNT(*) FROM tb_prakerin WHERE tb_prakerin.idpkl = tb_pkl.idpkl AND tb_prakerin.idprakerin != ?) > 0', [$prakerin->idprakerin])
            ->get();
    
        $siswa = siswa::whereRaw('(SELECT COUNT(*) FROM tb_prakerin WHERE tb_prakerin.nisn = siswa.nisn AND tb_prakerin.idprakerin != ?) = 0', [$prakerin->idprakerin])
            ->get();
    
        $guru = guruPendamping::get();
        return view('guru_pendampingLogin.ubahPrakerin', ['title' => $title, 'prakerin' => $prakerin, 'pkl' => $pkl, 'siswa' => $siswa, 'guru' => $guru]);
    }
    public function lihatPKL($idpkl){
        $pkll = pkl::find($idpkl);

        return response()->json(['pkll' => $pkll]);
    }

    public function lihatSiswa($nisn){
        $siswaa = siswa::find($nisn);

        return response()->json(['siswaa' => $siswaa]);
    }

    public function lihatGuru($nip){
        $guruu = guruPendamping::find($nip);

        return response()->json(['guruu' => $guruu]);
    }

    public function ubahPrakerin($idprakerin, request $r){
        $prakerin = tb_prakerin::findorfail($idprakerin);
    
        $prakerin->tahun = $r->tahun;
        $prakerin->save();

        return redirect('/Pendamping/Prakerin')->with('berhasil', 'Data Prakerin berhasil di Ubah');
    }

    public function kunjungan(){
        $title = 'Kunjungan';
        $kunjungan = kunjungan::join('tb_prakerin', 'tbl_kunjungan.idprakerin','=','tb_prakerin.idprakerin')
        ->join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')
        ->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')->where('nama','=',auth()->guard('pendamping')->user()->nama)->get();
        $pendamping = guruPendamping::get();
        return view('kunjungan.index', ['title' => $title, 'kunjungan' => $kunjungan, 'pendamping' => $pendamping]);
    }

    public function pengajuan(){
        $title = 'Surat Perintah Tugas';
        $pkl = pkl::where('Status','=','1')->get();
        $pendamping = guruPendamping::get();
        $kSekolah = User::where('hak_akses','=','1')->get();
        return view('guru_pendampingLogin.tugas', ['title' => $title, 'pkl' => $pkl, 'kSekolah' => $kSekolah, 'pendamping' => $pendamping]);
    }

    public function pengajuanPDF($id){
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
        
        
       
        
        $surat = suratPendamping::findorfail($id);
        if(auth()->guard('pendamping')->check()){
            if(auth()->guard('pendamping')->user()->nip != $surat->nip){
                return redirect('/Pendamping/Pengajuan');
            }
        }
        $terbilang = intToWord($surat->lama);
        $kSekolah = User::findorfail($surat->kepala_sekolah);
        Carbon::setLocale('id');
        $tanggal = $surat->tanggal;
        $date = Carbon::parse($tanggal);
        $formattedDate = $date->isoFormat('dddd, D MMMM YYYY');

        $bulan = $date->month;
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

        $tanggal_berangkat = $surat->tanggal_berangkat;
        $berangkatt = Carbon::parse($tanggal_berangkat);
        $berangkat = $berangkatt->isoFormat('D MMMM YYYY');
        
        $tanggal_kembali = $surat->tanggal_harus_kembali;
        $kembalii = Carbon::parse($tanggal_kembali);
        $kembali = $kembalii->isoFormat('D MMMM YYYY');

        $formatTanggal = $date->isoFormat('D MMMM YYYY');
        $pendamping = guruPendamping::findorfail($surat->nip);
        $pkl = pkl::findorfail($surat->industri);
        
        $id = sprintf('%04d', $surat->id);

        $pdf = new pdfController('P', 'mm', array(210, 330));
        $pdf->AddFont('tahoma','','tahoma.php');
        $pdf->AddFont('tahoma','B','TAHOMAB0.php');
        $pdf->AddPage();
        $pdf->image(Storage::disk('public')->path('logo/Jawa.PNG'), 10, 7.5, 38, 28);
        $pdf->image(Storage::disk('public')->path('default/smk.png'), 168, 7, 25, 29);
        $pdf->setFont('Times', '', 12);
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
        $pdf->Line($pdf->getX() + 5, $pdf->getY(), $pdf->getX() + 185, $pdf->getY());
       $pdf->Ln(10);
    
       $pdf->setFont('Arial', '', 14);
       $pdf->Cell(0, 5, 'SURAT PERINTAH TUGAS', 0, 1, 'C');
       $pdf->setFont('tahoma', '', 12);
       $pdf->Cell(0, 9, 'NOMOR : B/094/' . $id . '/'.$formatBulanRomawi.'/SMK.PKL/' . $surat->tahun, 0, 1, 'C');
       $pdf->setFont('Arial', '', 12);
       $pdf->Ln(10);
       $pdf->setX($pdf->getX() + 15);
       $pdf->Cell(31.3, 6, 'Dasar           :', 0, 0, '');
       $pdf->MultiCell(140, 6, 'Pedoman PKL Peserta Didik SMK Dit PSMK Ditjendikdasmen Kemendikbud 2024', 0, 'L', false);
       $pdf->Ln(4);
       $pdf->Cell(0, 5, 'MEMERINTAHKAN', 0, 1, 'C');
       $pdf->Ln(4);
       $pdf->setX($pdf->getX() + 15);
       $pdf->Cell(31.3, 6, 'Kepada        :', 0, 0, '');
       $pdf->Cell(31.3, 6, 'Nama                    ', 0, 0, '');
       $pdf->setX($pdf->getX() + 10);
       $pdf->setFont('tahoma', '', 12);
       $pdf->Cell(40, 6, ': ' . $pendamping->nama, 0, 1, '');
       $pdf->setFont('Arial', '', 12);
       $pdf->setX($pdf->getX() + 46.2);
       $pdf->Cell(31.3, 6, 'NIP                        ', 0, 0, '');
       $pdf->setX($pdf->getX() + 10);
       $pdf->setFont('tahoma', '', 12);
       $pdf->Cell(40, 6, ': ' .  $pendamping->nip, 0, 1, '');
       $pdf->setFont('Arial', '', 12);
       $pdf->setX($pdf->getX() + 46.2);
       $pdf->Cell(31.3, 6, 'Pangkat, gol ruang  ', 0, 0, '');
       $pdf->setX($pdf->getX() + 10);
       $pdf->setFont('tahoma', '', 12);
       $pdf->Cell(40, 6, ': ' .  $pendamping->pangkat, 0, 1, '');
       $pdf->setFont('Arial', '', 12);
       $pdf->setX($pdf->getX() + 46.2);
       $pdf->Cell(31.3, 6, 'Jabatan                  ', 0, 0, '');
       $pdf->setX($pdf->getX() + 10);
       $pdf->setFont('tahoma', '', 12);
       $pdf->Cell(40, 6, ': ' .   $pendamping->jabatan, 0, 1, '');
       $pdf->Ln(6);
       $pdf->setX($pdf->getX() + 15);
       $pdf->MultiCell(180, 6, 'Untuk ' . $surat->tujuan . ' siswa Praktik kerja Lapangan. Pada hari ' . $formattedDate, 0, 'L', false);
       $pdf->Ln(2);
    $pdf->setX($pdf->getX() + 15);
    $pdf->Cell(40, 6, 'Di:', 0, 1, '');
    $pdf->Ln(3);
    $pdf->setX($pdf->getX() + 15);
    $pdf->SetFont('tahoma', 'B', 12);
       $pdf->Cell(40, 6, $pkl->nama_pkl, 0, 1, '');
       $pdf->setX($pdf->getX() + 15);
       $pdf->SetFont('tahoma', '', 12);
       $pdf->Cell(40, 6, $pkl->alamat_pkl, 0, 1, '');
       $pdf->setXY(120, 220);
       $pdf->MultiCell(59, 6, 'Ditetapkan di Semarang pada tanggal ' . $formatTanggal, 0, 'L', false);
       $pdf->setXY(120, 237);
       $pdf->Cell(50, 3, 'KEPALA SEKOLAH,', 0, 1, '');
       $pdf->setXY(120, 263);
       $pdf->setFont('Arial', 'B', 12);
       $pdf->Cell(0, 3, $kSekolah->name, 0, 1, '');
       $pdf->setFont('Arial', '', 12);
       $pdf->setX(120);
       $pdf->Cell(0, 8, 'NIP.' . $kSekolah->username, 0, 1, '');


    //    $pdf->AddPage();
    //    $pdf->SetFont('Arial', 'B', 16);
    //    $pdf->Cell(40, 10, 'Halaman 1');

    //    // Tambahkan halaman kedua
    //    $pdf->AddPage();
    //    $pdf->SetFont('Arial', 'B', 16);
    //    $pdf->Cell(40, 10, 'Halaman 2');

    $pdf->AddPage('P', array(210, 297));
    $pdf->image(Storage::disk('public')->path('logo/Jawa.PNG'), 10, 7.5, 38, 28);
        $pdf->image(Storage::disk('public')->path('default/smk.png'), 168, 7, 25, 29);
    $pdf->setFont('Times', '', 12);
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
    $pdf->Line($pdf->getX() + 5, $pdf->getY(), $pdf->getX() + 185, $pdf->getY());
   $pdf->Ln(4);
   $pdf->setFont('Arial', 'u', 14);
       $pdf->Cell(0, 5, 'SURAT PERINTAH PERJALANAN DINAS', 0, 1, 'C');
       $pdf->Ln(3);
       $pdf->setFont('Arial', '', 12);
       $pdf->Cell(0, 6, 'NOMOR : B/094/' . $id . '/'.$formatBulanRomawi.'/SMK.PKL/' . $surat->tahun, 0, 1, 'C');
       $pdf->Ln(2);
       $pdf->Line($pdf->getX() + 5, $pdf->getY(), $pdf->getX() + 185, $pdf->getY());

       $pdf->setX($pdf->getX() + 5.2);
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '1.  Pejabat yang memberi perintah', 'TRB', 0, '');

       $pdf->setX($pdf->getX());
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '  Kepala Sekolah', 'LTB', 1, '');
       
       $pdf->setX($pdf->getX() + 5.2);
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '2.  Nama pegawai yang diperintahkan', 'TRB', 0, '');

       $pdf->setX($pdf->getX());
       $pdf->SetLineWidth(0.2); 
       $pdf->setFont('tahoma', '', 12);
       $pdf->Cell(90, 10, '  ' . $pendamping->nama, 'LTB', 1, '');
       $pdf->setFont('Arial', '', 12);

       $pdf->setX($pdf->getX() + 5.2);
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '3.  a.	Pangkat dan golongan menurut PP No.6', 'TR', 0, '');

       $pdf->setXY($pdf->getX(), $pdf->getY() + 3);
       $pdf->SetLineWidth(0.2); 
       $pdf->setFont('tahoma', '', 12);
       $pdf->Cell(90, 7, '  ' . $pendamping->pangkat, '', 1, '');
       $pdf->setFont('Arial', '', 12);

       $pdf->setXY($pdf->getX() + 5.2, $pdf->getY() - 5);
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '      	  Th. 1997', 'R', 1, '');

       $pdf->setX($pdf->getX() + 5.2);
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '     b. Jabatan', 'R', 0, '');

       $pdf->setX($pdf->getX());
       $pdf->SetLineWidth(0.2); 
       $pdf->setFont('tahoma', '', 12);
       $pdf->Cell(90, 10, '  ' . $pendamping->jabatan, 'L', 1, '');
       $pdf->setFont('Arial', '', 12);

       $pdf->setX($pdf->getX() + 5.2);
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '     c. Tingkat menurut perjalanan', 'RB', 0, '');

       $pdf->setX($pdf->getX());
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '  ' . 'Dinas', 'LB', 1, '');

       $pdf->setX($pdf->getX() + 5.2);
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '4.  Maksud perjalanan DInas', 'TRB', 0, '');

       $pdf->setX($pdf->getX());
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '  ' . $surat->tujuan . ' ' . 'siswa Praktik Kerja Lapangan', 'LTB', 1, '');

       $pdf->setX($pdf->getX() + 5.2);
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '5.  Alat angkut yang dipergunakan', 'TRB', 0, '');

       $pdf->setX($pdf->getX());
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '  Kendaraan ' . $surat->kendaraan, 'LTB', 1, '');

       $pdf->setX($pdf->getX() + 5.2);
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '6.  a. Tempat berangkat', 'TRB', 0, '');

       $pdf->setX($pdf->getX());
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '  SMK Negeri 5 Semarang', 'LTB', 1, '');

       $pdf->setX($pdf->getX() + 5.2);
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '     b. Tempat Tujuan', 'TRB', 0, '');

       $pdf->setX($pdf->getX());
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '  ' . $pkl->nama_pkl, 'LTB', 1, '');

       $pdf->setX($pdf->getX() + 5.2);
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '7.  a. Lama perjalanan dinas', 'TR', 0, '');

       $pdf->setX($pdf->getX());
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '  ' . $surat->lama . ' (' . $terbilang . ') Hari', 'LT', 1, '');

       $pdf->setX($pdf->getX() + 5.2);
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '     b. Tanggal berangkat', 'R', 0, '');

       $pdf->setX($pdf->getX());
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '  ' . $berangkat, 'L', 1, '');

       $pdf->setX($pdf->getX() + 5.2);
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '     c. Tanggal harus kembali', 'R', 0, '');

       $pdf->setX($pdf->getX());
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '  ' . $kembali, 'L', 1, '');

       $pdf->setX($pdf->getX() + 5.2);
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '8.  Pengikut', 'TRB', 0, '');

       $pdf->setX($pdf->getX());
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '  -', 'LT', 1, '');

       $pdf->setX($pdf->getX() + 5.2);
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '9.  Pembebanan anggaran', 'TR', 0, '');

       $pdf->setX($pdf->getX());
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '  ', 'LT', 1, '');

       $pdf->setY($pdf->getY() - 4);
       $pdf->setX($pdf->getX() + 5.2);
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '     a. instansi', 'R', 0, '');

       $pdf->setX($pdf->getX());
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '  SMK Negeri 5 Semarang ', 'L', 1, '');

       $pdf->setY($pdf->getY() - 3);
       $pdf->setX($pdf->getX() + 5.2);
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '     b. mata anggaran', 'RB', 0, '');

       $pdf->setX($pdf->getX());
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '  Anggaran Sekolah ', 'LB', 1, '');

       $pdf->setX($pdf->getX() + 5.2);
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '10.  Keterangan lain lain', 'TRB', 0, '');

       $pdf->setX($pdf->getX());
       $pdf->SetLineWidth(0.2); 
       $pdf->Cell(90, 10, '  ' . $surat->keterangan, 'LTB', 1, '');

      

   $pdf->SetFont('Arial', '', 12);
   $pdf->setXY(120, 233);
   $pdf->MultiCell(59, 6, 'Dikeluarkan di Semarang pada tanggal ' . $formatTanggal, 0, 'L', false);
   $pdf->setXY(120, 246);
   $pdf->Cell(50, 3, 'KEPALA SEKOLAH,', 0, 1, '');
   $pdf->setXY(120, 265);
   $pdf->setFont('Arial', 'B', 12);
   $pdf->Cell(0, 3, $kSekolah->name, 0, 1, '');
   $pdf->setFont('Arial', '', 12);
   $pdf->setX(120);
   $pdf->Cell(0, 8, 'NIP.' . $kSekolah->username, 0, 1, '');

   $pdf->AddPage('P', array(210, 297));
   $pdf->setFont('Arial', '', 10);
   $pdf->setX($pdf->getX() + 90);
   $pdf->Cell(0, 8, 'SPPD No.', 0, 1, '');
   $pdf->setXY($pdf->getX() + 105.9, $pdf->getY() - 8);
   $pdf->Cell(0, 6.5, ': B/094/' . $id . '/'.$formatBulanRomawi.'/SMK.PKL/' . $surat->tahun, 0, 1, 'C');
   $pdf->setX($pdf->getX() + 90);
   $pdf->Cell(0, 4, 'Berangkat dari', 0, 1, '');
   $pdf->setX($pdf->getX() + 90);
   $pdf->Cell(0, 5, '(Tempat kedudukan)', 0, 1, '');
   $pdf->setXY($pdf->getX() + 125, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ': SMK Negeri 5 Semarang', 0, 1, '');
   $pdf->setX($pdf->getX() + 90);
   $pdf->Cell(0, 5, 'Pada tanggal', 0, 1, '');
   $pdf->setXY($pdf->getX() + 125, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ': ' . $berangkat, 0, 1, '');
   $pdf->setX($pdf->getX() + 90);
   $pdf->Cell(0, 4, 'Ke ', 0, 1, '');
   $pdf->setFont('tahoma', '', 10);
   $pdf->setX($pdf->getX() + 90);
   $pdf->Cell(0, 5, '1. ' . $pkl->nama_pkl , 0, 1, '');
   $pdf->Ln(10);
   $pdf->setX($pdf->getX() + 90);
   $pdf->setFont('Arial', '', 10);
   $pdf->MultiCell(95, 5, 'Selaku pelaksana teknis kegiatan/yang melaksanakan perjalanan dinas', 0, 'J');
   $pdf->setX($pdf->getX() + 90);
   $pdf->setFont('tahoma', '', 10);
   $pdf->Cell(0, 5, $pendamping->nama, 0, 1, '');
   $pdf->setFont('Arial', '', 10);
   $pdf->Ln(6);
   $pdf->setX($pdf->getX() + 15);
   $pdf->Cell(0, 5, 'I.', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 20, $pdf->getY() - 5);
   $pdf->Cell(0, 5, 'Tiba di', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 40, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ':    .................................................', 0 , 1, '');
   $pdf->Ln(3);
   $pdf->setX($pdf->getX() + 20);
   $pdf->Cell(0, 5, 'Pada', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 40, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ':    .................................................', 0 , 1, '');
   $pdf->setX($pdf->getX() + 20);
   $pdf->Cell(0, 5, 'tanggal', 0 , 1, '');
   $pdf->setX($pdf->getX() + 20);
   $pdf->Cell(0, 5, 'Kepala', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 40, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ':   ', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 100, $pdf->getY() - 23.4);
   $pdf->Cell(0, 5, 'Berangkat dari', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 127.5, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ':    .................................................', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 100, $pdf->getY());
   $pdf->Cell(0, 5, 'Ke', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 127.5, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ':    .................................................', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 100, $pdf->getY());
   $pdf->Cell(0, 5, 'Pada tanggal', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 127.5, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ':    .................................................', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 100, $pdf->getY());
   $pdf->Cell(0, 5, 'Kepala', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 127.5, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ': ', 0 , 1, '');
   $pdf->Ln(6);
   $pdf->Line($pdf->getX() + 5, $pdf->getY(), $pdf->getX() + 185, $pdf->getY());

   $pdf->Ln(6);
   $pdf->setX($pdf->getX() + 15);
   $pdf->Cell(0, 5, 'II.', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 20, $pdf->getY() - 5);
   $pdf->Cell(0, 5, 'Tiba di', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 40, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ':    .................................................', 0 , 1, '');
   $pdf->Ln(3);
   $pdf->setX($pdf->getX() + 20);
   $pdf->Cell(0, 5, 'Pada', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 40, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ':    .................................................', 0 , 1, '');
   $pdf->setX($pdf->getX() + 20);
   $pdf->Cell(0, 5, 'tanggal', 0 , 1, '');
   $pdf->setX($pdf->getX() + 20);
   $pdf->Cell(0, 5, 'Kepala', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 40, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ':   ', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 100, $pdf->getY() - 23.4);
   $pdf->Cell(0, 5, 'Berangkat dari', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 127.5, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ':    .................................................', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 100, $pdf->getY());
   $pdf->Cell(0, 5, 'Ke', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 127.5, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ':    .................................................', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 100, $pdf->getY());
   $pdf->Cell(0, 5, 'Pada tanggal', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 127.5, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ':    .................................................', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 100, $pdf->getY());
   $pdf->Cell(0, 5, 'Kepala', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 127.5, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ': ', 0 , 1, '');
   $pdf->Ln(6);
   $pdf->Line($pdf->getX() + 5, $pdf->getY(), $pdf->getX() + 185, $pdf->getY());

   $pdf->Ln(6);
   $pdf->setX($pdf->getX() + 15);
   $pdf->Cell(0, 5, 'III.', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 20, $pdf->getY() - 5);
   $pdf->Cell(0, 5, 'Tiba di', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 40, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ':    .................................................', 0 , 1, '');
   $pdf->Ln(3);
   $pdf->setX($pdf->getX() + 20);
   $pdf->Cell(0, 5, 'Pada', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 40, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ':    .................................................', 0 , 1, '');
   $pdf->setX($pdf->getX() + 20);
   $pdf->Cell(0, 5, 'tanggal', 0 , 1, '');
   $pdf->setX($pdf->getX() + 20);
   $pdf->Cell(0, 5, 'Kepala', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 40, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ':   ', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 100, $pdf->getY() - 23.4);
   $pdf->Cell(0, 5, 'Berangkat dari', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 127.5, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ':    .................................................', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 100, $pdf->getY());
   $pdf->Cell(0, 5, 'Ke', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 127.5, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ':    .................................................', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 100, $pdf->getY());
   $pdf->Cell(0, 5, 'Pada tanggal', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 127.5, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ':    .................................................', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 100, $pdf->getY());
   $pdf->Cell(0, 5, 'Kepala', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 127.5, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ': ', 0 , 1, '');
   $pdf->Ln(6);
   $pdf->Line($pdf->getX() + 5, $pdf->getY(), $pdf->getX() + 185, $pdf->getY());

   $pdf->Ln(6);
   $pdf->setX($pdf->getX() + 15);
   $pdf->Cell(0, 5, 'IV.', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 20, $pdf->getY() - 5);
   $pdf->Cell(0, 5, 'Tiba di', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 40, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ':    .................................................', 0 , 1, '');
   $pdf->Ln(3);
   $pdf->setX($pdf->getX() + 20);
   $pdf->Cell(0, 5, 'Pada', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 40, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ':    .................................................', 0 , 1, '');
   $pdf->setX($pdf->getX() + 20);
   $pdf->Cell(0, 5, 'tanggal', 0 , 1, '');
   $pdf->setX($pdf->getX() + 20);
   $pdf->Cell(0, 5, 'Kepala', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 40, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ':   ', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 100, $pdf->getY() - 23.4);
   $pdf->Cell(0, 5, 'Berangkat dari', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 127.5, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ':    .................................................', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 100, $pdf->getY());
   $pdf->Cell(0, 5, 'Ke', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 127.5, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ':    .................................................', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 100, $pdf->getY());
   $pdf->Cell(0, 5, 'Pada tanggal', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 127.5, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ':    .................................................', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 100, $pdf->getY());
   $pdf->Cell(0, 5, 'Kepala', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 127.5, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ': ', 0 , 1, '');
   $pdf->Ln(6);
   $pdf->Line($pdf->getX() + 5, $pdf->getY(), $pdf->getX() + 185, $pdf->getY());
   $pdf->Ln(5);
   $pdf->setX($pdf->getX() + 19.9);
   $pdf->Cell(0, 5, 'V.', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 27, $pdf->getY() - 5);
   $pdf->Cell(0, 5, 'Tiba kembali di', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 55, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ': .................................................', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 27, $pdf->getY());
   $pdf->Cell(0, 5, 'Pada tanggal', 0 , 1, '');
   $pdf->setXY($pdf->getX() + 55, $pdf->getY() - 5);
   $pdf->Cell(0, 5, ': .................................................', 0 , 1, '');
   $pdf->Ln(5);
   $pdf->setX($pdf->getX() + 19.9);
   $pdf->MultiCell(165, 5, 'Telah diperiksa, dengan keterangan bahwa perjalanan tersebut di atas benar dilakukan atas perintahnya dan semata-mata untuk kepentingan jabatan dalam waktu yang sesingkat-singkatnya.', 0, 'J');
   $pdf->setXY(120, 237);
   $pdf->SetFont('Arial', '', 12);
       $pdf->Cell(50, 3, 'KEPALA SEKOLAH,', 0, 1, '');
       $pdf->setXY(120, 263);
       $pdf->setFont('Arial', 'B', 12);
       $pdf->Cell(0, 3, $kSekolah->name, 0, 1, '');
       $pdf->setFont('Arial', '', 12);
       $pdf->setX(120);
       $pdf->Cell(0, 8, 'NIP.' . $kSekolah->username, 0, 1, '');
   


   $pdf->Output('SuratTugas' . $surat->id  . '.pdf', 'I');
        exit;

       
    }

    public function Daftarpengajuan(){
        if(auth()->guard('pendamping')->check()){
            $surat = suratPendamping::where('suratpendamping.nip','=',auth()->guard('pendamping')->user()->nip)->join('tbl_gurupendamping', 'suratpendamping.nip','=','tbl_gurupendamping.nip')->join('tb_pkl', 'suratpendamping.industri','=','tb_pkl.idpkl')->select('suratpendamping.*', 'tbl_gurupendamping.nama', 'tb_pkl.nama_pkl')->get();
        }else{
            $surat = suratPendamping::join('tbl_gurupendamping', 'suratpendamping.nip','=','tbl_gurupendamping.nip')->join('tb_pkl', 'suratpendamping.industri','=','tb_pkl.idpkl')->select('suratpendamping.*', 'tbl_gurupendamping.nama', 'tb_pkl.nama_pkl')->get();
        }
        $title = 'Daftar Surat tugas guru pendamping';
        return view('surat_guru_pendamping.index', ['surat' => $surat, 'title' => $title]);
    }

    public function pengajuanTambah(request $r){
        if(auth()->guard('pendamping')->check()){
        $r->validate([
            'tujuan' => 'required',
            'tanggal' => 'required',
            'lama' => 'required',
            'tanggalberangkat' => 'required',
            'tanggalharuskembali' => 'required',
            'pkl' => 'required',
            'kepalasekolah' => 'required',
            'kendaraan' => 'required',
            'keterangan' => 'max:10'
        ],
        [
            'tujuan.required' => 'Tolong pilih tujuannya',
            'tanggal.required' => 'Tolong inputkan tanggalnya',
            'lama.required' => 'Tolong inputkan lamanya (dalam hari)',
            'tanggalberangkat.required' => 'Tolong inputkan tanggal berangkat',
            'tanggalharuskembali.required' => 'Tolong inputkan tanggal harus kembali',
            'pkl.required' => 'Tolong pilih PKL atau Industri yang tersedia',
            'kepalasekolah.required' => 'Tolong Pilih kepala sekolah',
            'kendaraan.required' => 'Tolong inputkan kendaraan',
            'keterangan.max' => 'Maksimal adalah 20 karakter'
        ]);
    }else{
        $r->validate([
            'tujuan' => 'required',
            'tanggal' => 'required',
            'lama' => 'required',
            'tanggalberangkat' => 'required',
            'tanggalharuskembali' => 'required',
            'pkl' => 'required',
            'kepalasekolah' => 'required',
            'nip' => 'required',
            'kendaraan' => 'required',
            'keterangan' => 'max:10'
        ],
        [
            'tujuan.required' => 'Tolong pilih tujuannya',
            'tanggal.required' => 'Tolong inputkan tanggalnya',
            'lama.required' => 'Tolong inputkan lamanya (dalam hari)',
            'tanggalberangkat.required' => 'Tolong inputkan tanggal berangkat',
            'tanggalharuskembali.required' => 'Tolong inputkan tanggal harus kembali',
            'pkl.required' => 'Tolong pilih PKL atau Industri yang tersedia',
            'kepalasekolah.required' => 'Tolong Pilih kepala sekolah',
            'nip.required' => 'Tolong pilih guru pendamping',
            'kendaraan.required' => 'Tolong inputkan kendaraan',
            'keterangan.max' => 'Maksimal adalah 20 karakter'
        ]);
    }
        suratPendamping::insert([
            'tujuan' => $r->tujuan,
            'tanggal' => $r->tanggal,
            'lama' => $r->lama,
            'tanggal_berangkat' => $r->tanggalberangkat,
            'tanggal_harus_kembali' => $r->tanggalharuskembali,
            'kepala_sekolah' => $r->kepalasekolah,
            'industri' => $r->pkl,
            'tahun' => $r->tahun,
            'nip' => $r->nip,
            'kendaraan' => $r->kendaraan,
            'keterangan' => $r->keterangan,
        ]);
        return redirect('/Pendamping/Pengajuan')->with('berhasil', 'Data Surat Tugas berhasil di tambah');
    }

    public function Hapuspengajuan($id){
        $surat = suratPendamping::findorfail($id);
        if(auth()->guard('pendamping')->check()){
            if(auth()->guard('pendamping')->user()->nip != $surat->nip){
                return redirect('/Pendamping/Pengajuan')->with('error', 'Terjadi Kesalahan');
            }
        }
        $surat->delete();
        return redirect('/Pendamping/Pengajuan')->with('berhasil', 'Surat Tugas berhasil dihapus');
    }

    public function Ubahpengajuan($id){
        $surat = suratPendamping::findorfail($id);
        if(auth()->guard('pendamping')->check()){
            if(auth()->guard('pendamping')->user()->nip != $surat->nip){
                return redirect()->back()->with('error', 'Terjadi Kesalahan');
            }
        }
        $pkl = pkl::where('Status','=','1')->get();
        $pendamping = guruPendamping::get();
        $kSekolah = User::where('hak_akses','=','1')->get();
        $title = 'Ubah Surat Tugas';
        return view('guru_pendampingLogin.tugasEdit', ['title' => $title, 'surat' => $surat, 'pkl' => $pkl, 'pendamping' => $pendamping, 'kSekolah' => $kSekolah]);
    }

    public function Editpengajuan($id, request $r){
        $surat = suratPendamping::findorfail($id);
        if(auth()->guard('pendamping')->check()){
            $r->validate([
                'tujuan' => 'required',
                'tanggal' => 'required',
                'lama' => 'required',
                'tanggalberangkat' => 'required',
                'tanggalharuskembali' => 'required',
                'pkl' => 'required',
                'kepalasekolah' => 'required',
                'kendaraan' => 'required',
                'keterangan' => 'max:10'
            ],
            [
                'tujuan.required' => 'Tolong pilih tujuannya',
                'tanggal.required' => 'Tolong inputkan tanggalnya',
                'lama.required' => 'Tolong inputkan lamanya (dalam hari)',
                'tanggalberangkat.required' => 'Tolong inputkan tanggal berangkat',
                'tanggalharuskembali.required' => 'Tolong inputkan tanggal harus kembali',
                'pkl.required' => 'Tolong pilih PKL atau Industri yang tersedia',
                'kepalasekolah.required' => 'Tolong Pilih kepala sekolah',
                'kendaraan.required' => 'Tolong inputkan kendaraan',
                'keterangan.max' => 'Maksimal adalah 10 karakter'
            ]);
        }else{
            $r->validate([
                'tujuan' => 'required',
                'tanggal' => 'required',
                'lama' => 'required',
                'tanggalberangkat' => 'required',
                'tanggalharuskembali' => 'required',
                'pkl' => 'required',
                'kepalasekolah' => 'required',
                'nip' => 'required',
                'kendaraan' => 'required',
                'keterangan' => 'max:10'
            ],
            [
                'tujuan.required' => 'Tolong pilih tujuannya',
                'tanggal.required' => 'Tolong inputkan tanggalnya',
                'lama.required' => 'Tolong inputkan lamanya (dalam hari)',
                'tanggalberangkat.required' => 'Tolong inputkan tanggal berangkat',
                'tanggalharuskembali.required' => 'Tolong inputkan tanggal harus kembali',
                'pkl.required' => 'Tolong pilih PKL atau Industri yang tersedia',
                'kepalasekolah.required' => 'Tolong Pilih kepala sekolah',
                'nip.required' => 'Tolong pilih guru pendamping',
                'kendaraan.required' => 'Tolong inputkan kendaraan',
                'keterangan.max' => 'Maksimal adalah 10 karakter'
            ]);
        }
  

        $surat->tujuan = $r->tujuan;
        $surat->tanggal = $r->tanggal;
        $surat->lama = $r->lama;
        $surat->tanggal_berangkat = $r->tanggalberangkat;
        $surat->tanggal_harus_kembali = $r->tanggalharuskembali;
        $surat->kepala_sekolah = $r->kepalasekolah;
        $surat->industri = $r->pkl;
        $surat->tahun = $r->tahun;
        $surat->nip = $r->nip;
        $surat->kendaraan = $r->kendaraan;
        $surat->keterangan = $r->keterangan;
        $surat->save();

        return redirect('/Pendamping/Pengajuan')->with('berhasil', 'Surat Tugas berhasil diUbah');
    }

    public function editFoto(){
        $title = 'Ganti foto Guru Pendamping';
        $pendamping = guruPendamping::findorfail(auth()->guard('pendamping')->user()->nip);

        return view('guru_pendampingLogin/ubahFoto', ['title' => $title, 'pendamping' => $pendamping]);
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

        $pendamping = guruPendamping::findorfail(auth()->guard('pendamping')->user()->nip);

        // if($pendamping->foto_pendamping != 'default.png'){
        //     unlink(public_path('foto_profile_guruPendamping/' . $pendamping->foto_pendamping));
        // }
        // $file = $r->file('foto');
        // $fotoName = $file->hashName();
        // $file->move(public_path('/foto_profile_guruPendamping'),$fotoName);

        if ($pendamping->foto_pendamping != 'default.png') {
           Storage::disk('public')->delete('foto_profile_guruPendamping/' . $pendamping->foto_pendamping);
        }
        
        $file = $r->file('foto');
        $fotoName = $file->hashName();
        Storage::disk('public')->putFileAs('foto_profile_guruPendamping', $file, $fotoName);

        $pendamping->foto_pendamping = $fotoName;
        $pendamping->save();

        return redirect('/Pendamping')->with('berhasil', 'Foto anda berhasil di Ubah');


    }

    public function editPass(){
        $title = 'Ubah Password';
        return view('guru_pendampingLogin.ubahPass', ['title' => $title]);
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
    
        $pendamping = Auth::guard('pendamping')->user();
    
        if (!Hash::check($request->current_password, $pendamping->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai']);
        }
    
        $pendamping->password = Hash::make($request->new_password);
        $pendamping->save();
    
        Auth::guard('pendamping')->logout();
        session()->flush();
        return redirect('login')->with('berhasil', 'Password berhasil diubah. Silakan login kembali.');
    }
}
