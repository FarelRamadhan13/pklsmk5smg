<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tb_prakerin;
use App\Models\jurnalPKL;
use App\Models\User;
use App\Models\siswa;
use App\Models\hadir;
use App\Models\kegiatan_harian;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Http\Controllers\pdf\pdfController;

class JurnalPKLController extends Controller
{
    public function index(){
        $title = 'Jurnal PKL';
        $tanggalHariIni = Carbon::today();
        $cek_hari = Carbon::today()->format('Y-m-d');
        $kSekolah = User::where('hak_akses','=','1')->get();
        if(auth()->guard('siswa')->check()){
            $cekPrakerin = tb_prakerin::where('nisn','=',auth()->guard('siswa')->user()->nisn)->count();
            if($cekPrakerin == 0){
                return redirect('/Siswa')->with('gagal', 'Maaf, kamu belum terdaftar di Data Prakerin');
            }else{
                $prakerin = tb_prakerin::join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
                ->select('tb_prakerin.*', 'tb_pkl.nama_pkl','tb_pkl.alamat_pkl', 'siswa.nama_siswa','siswa.kelas','tbl_gurupendamping.nama')->where('tb_prakerin.nisn','=',auth()->guard('siswa')->user()->nisn)->latest()->first();
                $cekJurnal = jurnalPKL::where('prakerin','=',$prakerin->idprakerin)->count();

                if($cekJurnal == 0){
                    return view('jurnalPKL.tambah', ['title' => $title, 'prakerin' => $prakerin, 'kSekolah' => $kSekolah, 'tanggalHariIni' => $tanggalHariIni, 'cek_hari' => $cek_hari]);
                }else{
                    $surat = jurnalPKL::join('tb_prakerin', 'jurnalpkl.prakerin','=','tb_prakerin.idprakerin')->join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
                    ->select('jurnalpkl.*', 'tb_prakerin.*', 'tb_pkl.nama_pkl','tb_pkl.alamat_pkl', 'siswa.nama_siswa','siswa.kelas','tbl_gurupendamping.nama', 'tbl_gurupendamping.nip')->where('tb_prakerin.nisn','=',auth()->guard('siswa')->user()->nisn)->get();

                    return view('jurnalPKL.index', ['title' => $title, 'surat' => $surat, 'tanggalHariIni' => $tanggalHariIni, 'cek_hari' => $cek_hari]);
                }
            }
        }
        elseif(auth()->guard('pendamping')->check()){
            $surat = jurnalPKL::join('tb_prakerin', 'jurnalpkl.prakerin','=','tb_prakerin.idprakerin')->join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
            ->select('jurnalpkl.*', 'tb_prakerin.*', 'tb_pkl.nama_pkl','tb_pkl.alamat_pkl', 'siswa.nama_siswa','siswa.kelas','tbl_gurupendamping.nama', 'tbl_gurupendamping.nip')->where('tbl_gurupendamping.nip','=',auth()->guard('pendamping')->user()->nip)->get();
            return view('jurnalPKL.index', ['title' => $title, 'surat' => $surat, 'tanggalHariIni' => $tanggalHariIni, 'cek_hari' => $cek_hari]);
        }
        else{
            $surat = jurnalPKL::join('tb_prakerin', 'jurnalpkl.prakerin','=','tb_prakerin.idprakerin')->join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
            ->select('jurnalpkl.*', 'tb_prakerin.*', 'tb_pkl.nama_pkl','tb_pkl.alamat_pkl', 'siswa.nama_siswa','siswa.kelas','tbl_gurupendamping.nama', 'tbl_gurupendamping.nip')->get();
            return view('jurnalPKL.index', ['title' => $title, 'surat' => $surat, 'tanggalHariIni' => $tanggalHariIni, 'cek_hari' => $cek_hari]);
        }
    }

    public function editInstruktur($id){
        $title = 'Ubah nama instruktur';
        $Jurnal = jurnalPKL::findorfail($id);
        $validasiJurnal = $Jurnal->join('tb_prakerin', 'jurnalpkl.prakerin','=','tb_prakerin.idprakerin')->where('jurnalpkl.id', $id)->first();
        

        if($validasiJurnal->nisn != auth()->guard('siswa')->user()->nisn){
            abort(404);
        }
        
        return view('SiswaLogin.editInstruktur', ['surat' => $Jurnal, 'title' => $title]);
    }

    public function ubahInstruktur(Request $r, $id){
        $Jurnal = jurnalPKL::findorfail($id);
        $validasiJurnal = $Jurnal->join('tb_prakerin', 'jurnalpkl.prakerin','=','tb_prakerin.idprakerin')->where('jurnalpkl.id', $id)->first();

        if($validasiJurnal->nisn != auth()->guard('siswa')->user()->nisn){
            abort(404);
        }

        $Jurnal->nama_instruktur = $r->nama_instruktur;
        $Jurnal->save();

        return redirect('/Siswa/JurnalPKL')->with('berhasil', 'Nama instruktur berhasil diubah');
    }

    public function tambahh(){
        $title = 'Jurnal PKL';

        $prakerin = tb_prakerin::join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')
            ->join('siswa','tb_prakerin.nisn','=','siswa.nisn')
            ->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
            ->whereDoesntHave('jurnalpkl')
            ->select('tb_prakerin.*', 'tb_pkl.nama_pkl', 'tb_pkl.alamat_pkl', 'siswa.nama_siswa', 'siswa.kelas', 'tbl_gurupendamping.nama')
            ->get();
        
        $kSekolah = User::where('hak_akses','=','1')->get();
        return view('jurnalPKL.tambah', ['title' => $title, 'prakerin' => $prakerin, 'kSekolah' => $kSekolah]);
    }
    public function tambah(request $r){
        $r->validate([
            'prakerin' => 'required',
            
            'nama_instruktur'  => 'required',
            'kepalasekolah'  => 'required',
            'tahunPelajaran' => 'required',
        ],
        [
            'prakerin.required' => 'Mohon pilih jenis prakerin yang tersedia.',
        
            'nama_instruktur.required' => 'Nama instruktur wajib diisi.',
            'kepalasekolah.required' => 'Nama kepala sekolah wajib diisi.',
            'tahunPelajaran.required' => 'Mohon pilih tahun pelajaran anda',
        ]);

        jurnalPKL::insert([
            'prakerin' => $r->prakerin,
            'tanggal' => $r->tanggal,
            'nama_instruktur' => $r->nama_instruktur,
            'tahun_pelajaran' => $r->tahunPelajaran,
            'tahun' => $r->tahun,
            'kepsek' => $r->kepalasekolah
        ]);

       
        return redirect('/Siswa/JurnalPKL')->with('berhasil', 'Jurnal PKL berhasil ditambah');
        
    }

    public function store(request $r){
        $r->validate([
            'prakerin' => 'required',
            
            'nama_instruktur'  => 'required',
            'kepalasekolah'  => 'required',
            'tahunPelajaran' => 'required',
        ],
        [
            'prakerin.required' => 'Mohon pilih jenis prakerin yang tersedia.',
        
            'nama_instruktur.required' => 'Nama instruktur wajib diisi.',
            'kepalasekolah.required' => 'Nama kepala sekolah wajib diisi.',
            'tahunPelajaran.required' => 'Mohon pilih tahun pelajaran anda',
        ]);

        jurnalPKL::insert([
            'prakerin' => $r->prakerin,
            'tanggal' => $r->tanggal,
            'nama_instruktur' => $r->nama_instruktur,
            'tahun_pelajaran' => $r->tahunPelajaran,
            'tahun' => $r->tahun,
            'kepsek' => $r->kepalasekolah
        ]);

        
        return redirect('/Siswa/JurnalPKL')->with('berhasil', 'Jurnal PKL berhasil ditambah');
        
    }

    

    public function lihat($id){
        
            $surat = jurnalPKL::join('tb_prakerin', 'tb_prakerin.idprakerin', '=', 'jurnalpkl.prakerin')
            ->join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')
            ->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
            ->join('tb_jurusan','siswa.id_jurusan','=','tb_jurusan.id_jurusan')
            ->select('jurnalpkl.*', 'tbl_gurupendamping.nama', 'tbl_gurupendamping.nip', 'siswa.*', 'tb_jurusan.*', 'tb_pkl.*')
            ->findorfail($id);
        if(auth()->guard('siswa')->check()){
            if($surat->nisn != auth()->guard('siswa')->user()->nisn){
                return redirect('/Siswa/JurnalPKL');
            }
        }
        if(auth()->guard('pendamping')->check()){
            if($surat->nip != auth()->guard('pendamping')->user()->nip){
                return redirect('/Siswa/JurnalPKL');
            }
        }


        $kegiatan = kegiatan_harian::where('jurnal','=',$id)->get();


       $kSekolah = User::findorfail($surat->kepsek);
       $tanggalll = $surat->tanggal;
       $tanggall = Carbon::parse($tanggalll);
       $tanggal = $tanggall->isoFormat('D MMMM YYYY');

       $hadir = hadir::where('jurnal','=',$id)->get();
        $pdf = new pdfController('P', 'mm', array(216, 330));
        $pdf->AddPage();
        $pdf->SetLineWidth(0.65);

        $pdf->Rect(4.1, 4.1, $pdf->GetPageWidth() - 8.2, $pdf->GetPageHeight() - 8.2);

        $pdf->setFont('Arial', '', 9);
        $pdf->image(Storage::disk('public')->path('logo/Jawa.PNG'), 9, 6, 35, 25);
        $pdf->image(Storage::disk('public')->path('default/smk.png'), 178, 6, 22, 26);
        $pdf->Cell(0, 0, 'PEMERINTAH PROVINSI JAWA TENGAH', 0, 1, 'C');
        $pdf->setFont('Times', '', 9);
        $pdf->Cell(0, 7, 'DINAS PENDIDIKAN', 0, 1, 'C');
        $pdf->setFont('Times', 'B', 12);
        $pdf->Cell(0, 3, 'SEKOLAH MENENGAH KEJURUAN NEGERI 5', 0, 1, 'C'); 
        $pdf->Cell(0, 5, 'SEMARANG', 0, 1, 'C');
        $pdf->setFont('Times','',8);
    
        $pdf->Cell(0, 4, 'Jalan Dr. Cipto No. 121, Kec. Semarang Timur, Kota Semarang', 0, 1, 'C');
    
        $pdf->Cell(0, 2, 'Telepon 0294-572623  Faksimile 0294-572623 Surat Elektronik smktelukendal@yahoo.com smk@smkn3kendal.sch.id ', 0, 1, 'C');
        $pdf->Cell(0, 5, '', 0, 0, 'C');
        $pdf->Ln(2.5);

        $pdf->SetLineWidth(1);
        $pdf->Line($pdf->getX() + 3, $pdf->getY(), $pdf->getX() + 194, $pdf->getY());
        $pdf->Ln(1.1);
        $pdf->SetLineWidth(0);

        $pdf->Line($pdf->getX() + 3, $pdf->getY(), $pdf->getX() + 194, $pdf->getY());
    $pdf->Ln(20);
    $pdf->image(Storage::disk('public')->path('default/smk.png'), 68, $pdf->getY());
    $pdf->Ln(80);
    $pdf->SetFont('times', 'B', 24);
    $pdf->MultiCell(0, 25, 'BUKU KEGIATAN HARIAN SISWA', 0, 'C');
    $pdf->MultiCell(0, 0, 'PRAKTIK KERJA LAPANGAN', 0, 'C');
    $pdf->Ln(30);
    $pdf->setX($pdf->getX() + 20);
    $pdf->SetFont('times', 'B', 14);
    $pdf->Cell(42, 10, 'NAMA SISWA                                                                         ', 0, 0, '');
       $pdf->setX($pdf->getX() + 10);
       $pdf->Cell(40, 10, ': ' . $surat->nama_siswa, 0, 1, '');

       $pdf->setX($pdf->getX() + 20);
    $pdf->Cell(42, 10, 'KOMP KEAHLIAN                                                                         ', 0, 0, '');
       $pdf->setX($pdf->getX() + 10);
       $pdf->Cell(40, 10, ': ' . $surat->nama_jurusan, 0, 1, '');
       
       $pdf->setX($pdf->getX() + 20);
    $pdf->Cell(42, 10, 'KELAS/NIS                                                                         ', 0, 0, '');
    $pdf->setX($pdf->getX() + 10);
    $pdf->Cell(40, 10, ': ' . $surat->kelas . '/ ...', 0, 1, '');

    $pdf->setX($pdf->getX() + 20);
    $pdf->Cell(42, 10, 'Tempat PKL                                                                         ', 0, 0, '');
    $pdf->setX($pdf->getX() + 10);
    $pdf->Cell(40, 10, ': ' . $surat->nama_pkl, 0, 1, '');
    $pdf->Ln(20);
    $pdf->Cell(0, 10, 'TAHUN PELAJARAN ' . $surat->tahun_pelajaran, 0, 1, 'C');

    $pdf->AddPage();
    $pdf->SetLineWidth(0.65);

    $pdf->Rect(4.1, 4.1, $pdf->GetPageWidth() - 8.2, $pdf->GetPageHeight() - 8.2);
    $pdf->Ln(20);
    $pdf->SetFont('times', 'B', 16);
    $pdf->Cell(0, 10, 'VISI MISI SMK NEGERI 5 SEMARANG', 0, 1, 'C');
    $pdf->Ln(10);
    
    $pdf->setX($pdf->getX() + 14);
    $pdf->SetFont('times', 'B', 14);
    $pdf->Cell(0, 10, 'Visi:', 0, 1, '');
    $pdf->setX($pdf->getX() + 14);
    $pdf->SetFont('times', '', 14);
    $pdf->MultiCell(190, 7, '"Pencetak tamatan yang berakhlak mulia, kompeten, mandiri, berdaya saing global
  dan berwawasan lingkungan.".', 0, 'J');
    
    $pdf->Ln(10);
    $pdf->setX($pdf->getX() + 14);
    $pdf->SetFont('times', 'B', 14);
    $pdf->Cell(0, 10, 'Misi:', 0, 1, '');
    $pdf->setX($pdf->getX() + 14);
    $pdf->SetFont('times', '', 14);
    $pdf->MultiCell(190, 8, '1.   Meningkatkan keimanan dan ketaqwaan pada Tuhan Yang Maha Esa.', 0, 1);
      
      $pdf->setX($pdf->getX() + 14);
      $pdf->MultiCell(190, 8, '2.	  Mengoptimalkan pembelajaran berbasis projek dan teaching factory.', 0, 1);
      
      $pdf->setX($pdf->getX() + 14);
      $pdf->MultiCell(190, 8, '3.	  Meningkatkan kerja sama dengan institusi pasangan (DU/DI) dan stakeholder.', 0, 1);
      
      $pdf->setX($pdf->getX() + 14);
      $pdf->MultiCell(190, 8, '4.	  Mengembangkan unit produksi, pendidikan & latihan (short course), sertifikasi
      kompetensi serta usaha mandiri.', 0, 1);
      
      
      $pdf->setX($pdf->getX() + 14);
      $pdf->MultiCell(190, 8, '5.	  Meningkatkan penguasaan bahasa asing dan teknologi informasi untuk pengembangan 
      wawasan global.', 0, 1);
      
      $pdf->setX($pdf->getX() + 14);
      $pdf->MultiCell(190, 8, '6.	  Menciptakan lingkungan sekolah yang kondusif, bersih, indah, nyaman dan rindang.', 0, 1);
      
      
      
      $pdf->AddPage();
      $pdf->SetLineWidth(0.65);
      $pdf->Rect(4.1, 4.1, $pdf->GetPageWidth() - 8.2, $pdf->GetPageHeight() - 8.2);
      $pdf->SetFont('times', 'B', 16);
      $pdf->Cell(0, 10, 'TATA TERTIB PESERTA', 0, 1, 'C');
      $pdf->Cell(0, 10, 'PRAKTIK KERJA LAPANGAN', 0, 1, 'C');
      $pdf->Ln(10);
      $pdf->SetFont('times', '', 14);
      $pdf->setX($pdf->getX() + 11);
      $pdf->Cell(0, 10, '1.  Kewajiban', 0, 1, '');
      $pdf->setX($pdf->getX() + 14);
      $pdf->MultiCell(190, 6.3, 'a. 	Peserta wajib mengikuti pembekalan sebelum melaksanakan Praktik Kerja
     Lapangan di Sekolah dan Industri. ', 0, 1);
      $pdf->setX($pdf->getX() + 14);
      $pdf->MultiCell(190, 6.3, 'b. 	Peserta bersedia melaksanakan Praktik Kerja Lapangan di Industri sesuai dengan
     Industri dan waktu yang ditentukan. ', 0, 1);
    $pdf->setX($pdf->getX() + 14);
    $pdf->MultiCell(190, 6.3, 'c.  Peserta wajib mengikuti peraturan yang ditetapkan oleh Industri.', 0, 1);
    $pdf->setX($pdf->getX() + 14);
    $pdf->MultiCell(190, 6.3, 'd.  Peserta sanggup melaksanakan instruksi dari guru pembimbing dan pembimbing 
     Industri.', 0, 1);
    $pdf->setX($pdf->getX() + 14);
    $pdf->MultiCell(190, 6.3, 'e.  Peserta hadir di industri 15 menit sebelum kerja.', 0, 1);
    $pdf->setX($pdf->getX() + 14);
    $pdf->MultiCell(190, 6.3, 'f.  Dalam perjalanan ke industri, peserta wajib memakai seragam sekolah sesuai
     ketentuan.', 0, 1);
    $pdf->setX($pdf->getX() + 14);
    $pdf->MultiCell(190, 6.3, 'g.  Peserta harus memakai pakaian kerja (wear park) dari sekolah / industri selama
     melaksanakan tugas di Industri.', 0, 1);
    $pdf->setX($pdf->getX() + 14);
    $pdf->MultiCell(190, 6.3, 'h.  Peserta harus bertingkah laku sopan, disiplin, bertanggung jawab dan selalu 
     mencerminkan sikap seorang pelajar yang baik.', 0, 1);
    $pdf->setX($pdf->getX() + 14);
    $pdf->MultiCell(190, 6.3, 'i.   Peserta wajib memperhatikan rambu-rambu keselamatan kerja dengan baik.', 0, 1);
    $pdf->setX($pdf->getX() + 14);
    $pdf->MultiCell(190, 6.3, 'j.   Peserta wajib menjaga nama baik Sekolah, Industri dan diri sendiri.', 0, 1);
    $pdf->setX($pdf->getX() + 14);
    $pdf->MultiCell(190, 6.3, 'k.  Peserta harus selalu mengisi buku jurnal setiap kali setelah melaksanakan 
     kegiatan dan dimintakan tandatangan pada Pembimbing Industri maupun Guru 
     Pembimbing Sekolah pada waktu data monitoring.', 0, 1);
    $pdf->setX($pdf->getX() + 14);
    $pdf->MultiCell(190, 6.3, 'l.   Peserta yang menemui permasalahan selama melaksanakan Praktik Kerja 
     Lapangan, maka diharapkan segera lapor ke Pembimbing Industri atau Guru
     Pembimbing Sekolah.', 0, 1);
    $pdf->setX($pdf->getX() + 14);
    $pdf->MultiCell(190, 6.3, 'm. Peserta menyerahkan Buku Jurnal pada Team PKL setelah selesai melaksanakan 
     Praktik Industri dan mengikuti evaluasi.', 0, 1);
$pdf->Ln(5);
     $pdf->setX($pdf->getX() + 11);
     $pdf->Cell(0, 10, '2.  Larangan', 0, 1, '');
     $pdf->setX($pdf->getX() + 14);
     $pdf->MultiCell(190, 6.3, 'a.	Peserta tidak diperkenankan meninggalkan indutri tanpa seijin dari Industri / 
    Perusahaan.', 0, 1);
     $pdf->setX($pdf->getX() + 14);
      $pdf->MultiCell(190, 6.3, 'b.	Peserta tidak diperkenankan membawa sesuatu apapun dari Industri / 
    Perusahaan tanpa seijin dari Industri /Perusahaan. ', 0, 1);
    $pdf->setX($pdf->getX() + 14);
    $pdf->MultiCell(190, 6.3, 'c.	Peserta  tidak boleh membuat keonaran/ keributan selama di Industri / 
    Perusahaan. ', 0, 1);
    $pdf->setX($pdf->getX() + 14);
    $pdf->MultiCell(190, 6.3, 'd.	Peserta tidak boleh membuat laporan palsu/ menipu terhadap Guru Pembimbing
    Sekolah maupun Pembimbing Industri. ', 0, 1);
    $pdf->Ln(5);
   
    $pdf->SetLineWidth(0.65);
    $pdf->Rect(4.1, 4.1, $pdf->GetPageWidth() - 8.2, $pdf->GetPageHeight() - 8.2);
    $pdf->setX($pdf->getX() + 11);
     $pdf->Cell(0, 10, '3.  Sanksi', 0, 1, '');
     $pdf->setX($pdf->getX() + 14);
     $pdf->MultiCell(190, 6.3, 'a.	Diingatkan dan ditegur oleh Pembimbing Sekolah maupun Pembimbing Industri', 0, 1);
     $pdf->setX($pdf->getX() + 14);
      $pdf->MultiCell(190, 6.3, 'b.	Ditarik dari PKL di Industri untuk dibimbing di sekolah', 0, 1);
    $pdf->setX($pdf->getX() + 14);
    $pdf->MultiCell(190, 6.3, 'c.	Dikeluarkan dari sekolah atau dikembalikan kepada orangtua', 0, 1);
        
    
      $pdf->AddPage();
      $pdf->SetLineWidth(0.65);
      $pdf->Rect(4.1, 4.1, $pdf->GetPageWidth() - 8.2, $pdf->GetPageHeight() - 8.2);
      $pdf->SetFont('times', 'B', 14);
      $pdf->Cell(0, 10, 'IDENTITAS SISWA', 0, 1, 'C');
      $pdf->Ln(18);
      $pdf->SetFont('times', 'B', 12);
      $pdf->setX($pdf->getX() + 15);
      $pdf->Cell(60, 12, 'Nama Siswa                   ', 0, 0, '');
       $pdf->setX($pdf->getX() + 15);
       $pdf->Cell(40, 12, ': ' . $surat->nama_siswa, 0, 1, '');

       $pdf->setX($pdf->getX() + 15);
       $pdf->Cell(60, 12, 'TEMPAT TANGGAL LAHIR                  ', 0, 0, '');
       $pdf->setX($pdf->getX() + 15);
       $pdf->Cell(40, 12, ': ' . $surat->tempat_tanggal_lahir, 0, 1, '');
    
       $pdf->setX($pdf->getX() + 15);
       $pdf->Cell(60, 12, 'KELAS / NIS	                  ', 0, 0, '');
       $pdf->setX($pdf->getX() + 15);
       $pdf->Cell(40, 12, ': ' . $surat->kelas . '/ ...', 0, 1, '');
       
       $pdf->setX($pdf->getX() + 15);
       $pdf->Cell(60, 12, 'KOMPETENSI KEAHLIAN                  ', 0, 0, '');
       $pdf->setX($pdf->getX() + 15);
       $pdf->Cell(40, 12, ': ' . $surat->nama_jurusan, 0, 1, '');
       
       $pdf->setX($pdf->getX() + 15);
       $pdf->Cell(60, 12, 'ALAMAT SISWA                  ', 0, 0, '');
       $pdf->setXY($pdf->getX() + 15, $pdf->getY() + 2.999);
       $pdf->Cell(1, 6, ':' , 0, 0, '');
       $pdf->setX($pdf->getX() + 2);
       $pdf->MultiCell(103, 6,  $surat->alamat, 0, 'J');

       $pdf->setXY($pdf->getX() + 15, $pdf->getY() + 2);
       $pdf->Cell(60, 12, 'GOLONGAN DARAH                  ', 0, 0, '');
       $pdf->setXY($pdf->getX() + 15, $pdf->getY());
       $pdf->Cell(40, 12, ': ' . $surat->golongan_darah, 0, 1, '');

       $pdf->setX($pdf->getX() + 15);
       $pdf->Cell(60, 12, 'NAMA ORANG TUA / WALI                  ', 0, 0, '');
       $pdf->setX($pdf->getX() + 15);
       $pdf->Cell(40, 12, ': ' . $surat->nama_orang_tua_wali, 0, 1, '');

       $pdf->setX($pdf->getX() + 15);
       $pdf->Cell(60, 12, 'CATATAN KESEHATAN                 ', 0, 0, '');
       $pdf->setXY($pdf->getX() + 15, $pdf->getY() + 2.999);
       $pdf->MultiCell(120, 6, ': ' . $surat->catatan_kesehatan, 0, 1, '');
      
       $pdf->Ln(7);
       $pdf->SetLineWidth(0.25);
       $pdf->Rect(40, 210, 30, 40);
       $pdf->SetFont('times', '', 12);
       $pdf->setXY(120, 207);
       $pdf->Cell(0, 10, 'Semarang, ' . $tanggal, 0, 1, '');
       $pdf->setXY(120, 217);
       $pdf->Cell(50, 3, 'Kepala Sekolah,', 0, 1, '');
       $pdf->setXY(120, 243);
       $pdf->setFont('times', 'B', 12);
       $pdf->Cell(0, 3, $kSekolah->name, 0, 1, '');
       $pdf->setFont('times', '', 12);
       $pdf->setX(120);
       $pdf->Cell(0, 8, 'NIP.' . $kSekolah->username, 0, 1, '');
      $pdf->Rect(4.1, 4.1, $pdf->GetPageWidth() - 8.2, $pdf->GetPageHeight() - 8.2);


      $pdf->AddPage();
      $pdf->SetLineWidth(0.65);
      $pdf->Rect(4.1, 4.1, $pdf->GetPageWidth() - 8.2, $pdf->GetPageHeight() - 8.2);
      $pdf->SetFont('times', 'B', 14);
      $pdf->Cell(0, 10, 'IDENTITAS DUNIA USAHA / INDUSTRI', 0, 1, 'C');
      $pdf->Ln(18);

      $pdf->SetFont('times', 'B', 12);
      $pdf->setX($pdf->getX() + 15);
      $pdf->Cell(60, 12, 'NAMA INDUSTRI/BENGKEL                   ', 0, 0, '');
       $pdf->setX($pdf->getX() + 15);
       $pdf->Cell(40, 12, ': ' . $surat->nama_pkl, 0, 1, '');

      $pdf->setX($pdf->getX() + 15);
      $pdf->Cell(60, 12, 'BIDANG USAHA	                   ', 0, 0, '');
       $pdf->setX($pdf->getX() + 15);
       $pdf->Cell(40, 12, ': ' . $surat->bidang_usaha, 0, 1, '');

       $pdf->setX($pdf->getX() + 15);
       $pdf->Cell(60, 12, 'ALAMAT INDUSTRI                  ', 0, 0, '');
       $pdf->setXY($pdf->getX() + 15, $pdf->getY() + 2.999);
       $pdf->Cell(1, 6, ':', 0, 0, '');
       $pdf->setX($pdf->getX() + 2);
       $pdf->MultiCell(102, 6, $surat->alamat_pkl, 0, 'J');
$pdf->Ln(2);
       $pdf->setX($pdf->getX() + 15);
      $pdf->Cell(60, 12, 'NOMOR TELEPON	                   ', 0, 0, '');
       $pdf->setX($pdf->getX() + 15);
       $pdf->Cell(40, 12, ': ' . $surat->telp, 0, 1, '');

       $pdf->setX($pdf->getX() + 15);
      $pdf->Cell(60, 12, 'NAMA PIMPINAN		                   ', 0, 0, '');
       $pdf->setX($pdf->getX() + 15);
       $pdf->Cell(40, 12, ': ' . $surat->nama_pimpinan, 0, 1, '');

       $pdf->setX($pdf->getX() + 15);
      $pdf->Cell(60, 12, 'NAMA INSTRUKTUR		                   ', 0, 0, '');
       $pdf->setX($pdf->getX() + 15);
       $pdf->Cell(40, 12, ': ' . $surat->nama_instruktur, 0, 1, '');
       
       $pdf->setX($pdf->getX() + 15);
      $pdf->Cell(60, 12, 'NAMA GURU PEMBIMBING		                   ', 0, 0, '');
       $pdf->setX($pdf->getX() + 15);
       $pdf->Cell(40, 12, ': ' . $surat->nama, 0, 1, '');

       
       $pdf->setXY(120, 217);
       $pdf->setFont('times', '', 12);
       $pdf->Cell(50, 3, '.........................., ...........................................', 0, 1, '');
       $pdf->setXY(120, 253);
       $pdf->setFont('times', 'B', 12);
       $pdf->Cell(0, 3, '(.....................................................................)', 0, 1, '');
       $pdf->setFont('times', '', 10);
       $pdf->setX(120);
       $pdf->Cell(0, 8, 'Nama terang dan tanda tangan', 0, 1, '');

       
        

      $pdf->output('JurnalPKL ' . $surat->nama_siswa  . '.pdf', 'I');
      exit;
    }

    public function dapatkanPrakerin($idprakerin){
        $pkl = tb_prakerin::join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa', 'tb_prakerin.nisn','=','siswa.nisn')
        ->select('tb_pkl.nama_pkl','tb_pkl.alamat_pkl','siswa.nama_siswa')->findorfail($idprakerin);
        return response()->json(['pkl' => $pkl]);
    }

    public function hapus($id){
        $surat = jurnalPKL::findorfail($id);
        $surat->delete();

        return redirect('/Siswa/JurnalPKL')->with('berhasil', 'Jurnal PKL berhasil dihapus');
    }

    public function ubah($id){
        $title = 'Ubah Jurnal PKL';

        $prakerin = tb_prakerin::join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')
            ->join('siswa','tb_prakerin.nisn','=','siswa.nisn')
            ->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
            ->whereDoesntHave('jurnalpkl')
            ->select('tb_prakerin.*', 'tb_pkl.nama_pkl', 'tb_pkl.alamat_pkl', 'siswa.nama_siswa', 'siswa.kelas', 'tbl_gurupendamping.nama')
            ->get();

        $surat = jurnalPKL::findorfail($id);
        $awal = tb_prakerin::join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')
        ->join('siswa','tb_prakerin.nisn','=','siswa.nisn')
        ->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
        ->select('tb_prakerin.*', 'tb_pkl.nama_pkl', 'tb_pkl.alamat_pkl', 'siswa.nama_siswa', 'siswa.kelas', 'tbl_gurupendamping.nama')
        ->findorfail($surat->prakerin);
        
        $kSekolah = User::where('hak_akses','=','1')->get();
        return view('jurnalPKL.edit', ['title' => $title, 'prakerin' => $prakerin, 'kSekolah' => $kSekolah, 'awal' => $awal, 'surat' => $surat]);
    }

    public function edit($id, request $r){
        $surat = jurnalPKL::findorfail($id);
        $r->validate([
            'prakerin' => 'required',
            
            'nama_instruktur'  => 'required',
            'kepalasekolah'  => 'required',
            'tahunPelajaran' => 'required',
        ],
        [
            'prakerin.required' => 'Mohon pilih jenis prakerin yang tersedia.',
        
            'nama_instruktur.required' => 'Nama instruktur wajib diisi.',
            'kepalasekolah.required' => 'Nama kepala sekolah wajib diisi.',
            'tahunPelajaran.required' => 'Mohon pilih tahun pelajaran anda',
        ]);

        $surat->prakerin = $r->prakerin;
        $surat->tanggal = $r->tanggal;
        $surat->nama_instruktur = $r->nama_instruktur;
        $surat->tahun_pelajaran = $r->tahunPelajaran;
        $surat->tahun = $r->tahun;
        $surat->kepsek = $r->kepalasekolah;
        $surat->save();

        return redirect('/Siswa/JurnalPKL')->with('berhasil', 'Jurnal PKL berhasil di Ubah');
        
    }
}
