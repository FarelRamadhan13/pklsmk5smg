<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\suratIzin;
use App\Models\siswa;
use App\Models\pkl;
use App\Models\User;
use App\Models\suratpenarikan;
use App\Models\tb_prakerin;
use Carbon\Carbon;
use App\Http\Controllers\pdf\pdfController;
use Illuminate\Support\Facades\Storage;

class suratIzinPenarikanController extends Controller
{
    public function index(){
        $title = 'Surat Izin Siswa';
        if(auth()->guard('siswa')->check()){
            $surat = suratIzin::join('tb_pkl','suratizinpkl.industri','=','tb_pkl.idpkl')->join('siswa','suratizinpkl.siswa','=','siswa.nisn')
            ->where('siswa','=',auth()->guard('siswa')->user()->nisn)->get();
        }else{
        $surat = suratIzin::join('tb_pkl','suratizinpkl.industri','=','tb_pkl.idpkl')->join('siswa','suratizinpkl.siswa','=','siswa.nisn')
        ->get();
        }

        return view('suratIzin.index', ['title' => $title, 'surat' => $surat]);
    }
    
    public function tambah(){
        $title = 'Tambah Surat Izin';
        $siswa = siswa::get();
        $industri = pkl::where('status','=','1')->get();
        $kSekolah = User::where('hak_akses','=','1')->get();

        return view('suratIzin.tambah', ['title' => $title, 'siswa' => $siswa, 'pkl' => $industri, 'kSekolah' => $kSekolah]);
    }

    public function store(request $r){
        $r->validate([
            'pkl' => 'required',
            'tanggal' => 'required',
            'pada_tanggal' => 'required',
            'berdasarkan' => 'required',
            'waktu' => 'required',
            'siswa' => 'required',
            'keperluan' => 'required',
            'tempat' => 'required',
            'kepalasekolah' => 'required',
        ],
        [
            'pkl.required' => 'Tolong pilih PKL/Industri',
            'tanggal.required' => 'Tolong inputkan tanggal',
            'pada_tanggal.required' => 'Tolong inputkan tanggal dijadwalkannya izin PKL',
            'waktu.required' => 'Tolong inputkan waktu dijadwalkannya izin PKL',
            'siswa.required' => 'Tolong pilih siswa',
            'bedasarkan.required' => 'Tolong pilih bedasarkan surat masuk / kegiatan',
            'keperluan.required' => 'Tolong inputkan keperluan izin PKL',
            'tempat.required' => 'Tolong inputkan tempat izin PKL',
            'kepalasekolah.required' => 'Tolong pilih kepala sekolah',
        ]);

        suratIzin::insert([
            'industri' => $r->pkl,
            'tanggal' => $r->tanggal,
            'pada_tanggal' => $r->pada_tanggal,
            'berdasarkan' => $r->berdasarkan,
            'waktu' => $r->waktu,
            'siswa' => $r->siswa,
            'keperluan' => $r->keperluan,
            'tempat' => $r->tempat,
            'kepsek' => $r->kepalasekolah,
            'tahun' => $r->tahun
        ]);

        return redirect('/Siswa/suratIzin')->with('berhasil', 'File surat izin berhasil di tambah');
    }

    public function hapus($id_izin){
        $surat = suratIzin::findorfail($id_izin);
        $no = $surat->id_izin;

        $surat->delete();
        return redirect('/Siswa/suratIzin')->with('berhasil', 'File surat izin id ' . $no . ' berhasil di hapus');
    }

    public function ubah($id_izin){
        $title = 'Ubah Surat Izin';
        $siswa = siswa::get();
        $industri = pkl::where('status','=','1')->get();
        $kSekolah = User::where('hak_akses','=','1')->get();
        $surat = suratIzin::findorfail($id_izin);

        return view('suratIzin.ubah', ['title' => $title, 'siswa' => $siswa, 'pkl' => $industri, 'kSekolah' => $kSekolah, 'surat' => $surat]);
    }

    public function edit($id_izin, request $r){
        $r->validate([
            'pkl' => 'required',
            'tanggal' => 'required',
            'pada_tanggal' => 'required',
            'berdasarkan' => 'required',
            'waktu' => 'required',
            'siswa' => 'required',
            'keperluan' => 'required',
            'tempat' => 'required',
            'kepalasekolah' => 'required',
        ],
        [
            'pkl.required' => 'Tolong pilih PKL/Industri',
            'tanggal.required' => 'Tolong inputkan tanggal',
            'pada_tanggal.required' => 'Tolong inputkan tanggal dijadwalkannya izin PKL',
            'waktu.required' => 'Tolong inputkan waktu dijadwalkannya izin PKL',
            'siswa.required' => 'Tolong pilih siswa',
            'bedasarkan.required' => 'Tolong pilih bedasarkan surat masuk / kegiatan',
            'keperluan.required' => 'Tolong inputkan keperluan izin PKL',
            'tempat.required' => 'Tolong inputkan tempat izin PKL',
            'kepalasekolah.required' => 'Tolong pilih kepala sekolah',
        ]);
        $surat = suratIzin::findorfail($id_izin);
        $surat->industri = $r->pkl;
        $surat->tanggal = $r->tanggal;
        $surat->pada_tanggal = $r->pada_tanggal;
        $surat->berdasarkan = $r->berdasarkan;
        $surat->waktu = $r->waktu;
        $surat->siswa = $r->siswa;
        $surat->keperluan = $r->keperluan;
        $surat->tempat = $r->tempat;
        $surat->kepsek = $r->kepalasekolah;
        $surat->tahun = $r->tahun;
        $surat->save();

     

        return redirect('/Siswa/suratIzin')->with('berhasil', 'File surat izin dengan id ' . $surat->id_izin . ' berhasil di Ubah');
    }

    public function lihatIzin($id_izin){
        
        $surat = suratIzin::findorfail($id_izin);
        if(auth()->guard('siswa')->check()){
            if($surat->siswa != auth()->guard('siswa')->user()->nisn){
                return redirect('/Siswa/suratPenarikan');
            }
        }
        $kSekolah = user::findorfail($surat->kepsek);
        $tanggalll = $surat->tanggal;
        $tanggall = Carbon::parse($tanggalll);
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
        $id = sprintf('%04d', $surat->id_izin);
        $pkl = pkl::findorfail($surat->industri);
        $siswa = siswa::findorfail($surat->siswa);
        $date = Carbon::parse($surat->pada_tanggal);
        $pada_tanggal = $date->isoFormat('dddd, D MMMM');
        $tanggal = $tanggall->isoFormat('D MMMM YYYY');


        $pdf = new pdfController('P', 'mm', 'A4');
        $pdf->AddFont('tahoma','','tahoma.php');
        $pdf->AddFont('tahoma','B','TAHOMAB0.php');
        $pdf->AddPage();
        $pdf->setFont('tahoma', '', 12);
        $pdf->image(Storage::disk('public')->path('logo/Jawa.PNG'), 9, 7.5, 38, 28);
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
          $pdf->Ln(1);
        
       
        $pdf->setFont('tahoma', '', 12);
        $pdf->setX($pdf->getX() + 3.5);
        $pdf->Cell(20, 10, 'Nomor', 0, 0);
        $pdf->Cell(50, 10, ': B/'. $id . '/' . $formatBulanRomawi . '/SMK.PKL/' . $surat->tahun , 0, 1);
        $pdf->setY(37.6);
        $pdf->Cell(186, 17, 'Semarang, ' . $tanggal, 0, 1, 'R');
        $pdf->setX($pdf->getX() + 3.5);
        $pdf->Cell(20, 0, 'Perihal' , 0, 0);
        $pdf->Cell(3, 0, ': ' , 0, 0);
        $pdf->setFont('tahoma', 'B', 12);
        $pdf->Cell(0, 0, 'Permohonan Dispensasi Ijin PKL' , 0, 1);
        $pdf->Ln(10);
        $pdf->setFont('tahoma', '', 12);
        
        $pdf->setX($pdf->getX() + 3.5);
        $pdf->Cell(29, 7, 'Yth.  Pimpinan ', 0, 0);
        $pdf->setFont('tahoma', 'B', 12);
        $pdf->setX($pdf->getX() + 3.5);
        $pdf->MultiCell(110, 7, $pkl->nama_pkl, 0, 'J');
        $pdf->setFont('tahoma', '', 12);
        $pdf->setX($pdf->getX() + 3.5);
        $pdf->MultiCell(110, 7, $pkl->alamat_pkl, 0, 'J');
        $pdf->setX($pdf->getX() + 3.5);
        $pdf->MultiCell(110, 7, 'Di Tempat', 0, 1);
        $pdf->Ln(5);

        $pdf->setX($pdf->getX() + 23);
        $pdf->Cell(20, 10, 'Dengan hormat,', 0, 1);
        $pdf->setX($pdf->getX() + 23);
        $pdf->MultiCell(0, 8, 'Berdasarkan '. $surat->berdasarkan . ', dengan ini kami meminta Dispensasi untuk 
Ijin Praktik Kerja Lapangan pada:', 0, 1);
        $pdf->Ln(6);

        $pdf->setX($pdf->getX() + 23);
        $pdf->Cell(55, 6.32, 'Hari/Tanggal                          ', 0, 0, '');
        $pdf->setFont('tahoma', 'B', 12);
        $pdf->setX($pdf->getX() + 10);
        $pdf->Cell(40, 6.32, ': ' . $pada_tanggal, 0, 1, '');
        $pdf->setFont('tahoma', '', 12);
        $waktuSurat = Carbon::parse($surat->waktu)->format('H:i');
        $pdf->setX($pdf->getX() + 23);
        $pdf->Cell(55, 6.32, 'Waktu                          ', 0, 0, '');
        $pdf->setX($pdf->getX() + 10);
        $pdf->Cell(40, 6.32, ': ' . $waktuSurat . ' s/d selesai', 0, 1, '');
        $pdf->setFont('tahoma', '', 12);

        $pdf->setX($pdf->getX() + 23);
        $pdf->Cell(55, 6.32, 'Nama Peserta                          ', 0, 0, '');
        $pdf->setFont('tahoma', 'B', 12);
        $pdf->setX($pdf->getX() + 10);
        $pdf->Cell(40, 6.32, ': ' . $siswa->nama_siswa, 0, 1, '');
        $pdf->setFont('tahoma', '', 12);

        $pdf->setX($pdf->getX() + 23);
        $pdf->Cell(55, 6.32, 'Tempat Kegiatan                          ', 0, 0, '');
        $pdf->setX($pdf->getX() + 10);
        $pdf->Cell(40, 6.32, ': ' . $surat->tempat, 0, 1, '');
        $pdf->setFont('tahoma', '', 12);

        $pdf->setX($pdf->getX() + 23);
        $pdf->Cell(55, 6.32, 'Keperluan                          ', 0, 0, '');
        $pdf->setX($pdf->getX() + 10);
        $pdf->Cell(1, 6.32, ':', 0, 0, '');
        $pdf->setX($pdf->getX() + 2);
        $pdf->MultiCell(87, 6.32, $surat->keperluan, 0, 'J');
        $pdf->setFont('tahoma', '', 12);
        $pdf->Ln(7);

        $pdf->setX($pdf->getX() + 23);
        $pdf->MultiCell(0, 8, 'Demikian Surat dispensasi untuk ijin PKL ini kami sampaikan. Atas perhatian kami 
disampaikan terima kasih. ', 0, 1);


        $pdf->setX($pdf->getX() + 150);
        $pdf->setXY(120, 244);
        $pdf->Cell(50, 3, 'Kepala Sekolah,', 0, 1, '');
        $pdf->setXY(120, 265);
        $pdf->setFont('tahoma', 'B', 12);
        $pdf->Cell(0, 3, $kSekolah->name, 0, 1, '');
        $pdf->setFont('tahoma', '', 12);
        $pdf->setX(120);
        $pdf->Cell(0, 8, 'NIP.' . $kSekolah->username, 0, 1, '');
        $pdf->output('I', 'SuratIzin' . $id . '.pdf');
        exit;
    }

    public function indexPenarikan(){
        $title = 'Surat Penarikan Siswa';
        if(auth()->guard('siswa')->check()){
            $surat = suratpenarikan::join('tb_prakerin','suratpenarikan.prakerin','=','tb_prakerin.idprakerin')
            ->join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')
            ->where('tb_prakerin.nisn','=',auth()->guard('siswa')->user()->nisn)->get();
        }elseif(auth()->guard('pendamping')->check()){
            
                $surat = suratpenarikan::join('tb_prakerin','suratpenarikan.prakerin','=','tb_prakerin.idprakerin')
            ->join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')
            ->join('tbl_gurupendamping', 'tb_prakerin.nip', '=', 'tbl_gurupendamping.nip')
            ->where('tb_prakerin.nip','=',auth()->guard('pendamping')->user()->nip)->get();

        }
        else{
        $surat = suratpenarikan::join('tb_prakerin','suratpenarikan.prakerin','=','tb_prakerin.idprakerin')
        ->join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')
        ->get();
        }

        return view('suratPenarikan.index', ['title' => $title, 'surat' => $surat]);
    }

    
    public function tambahPenarikan(){
        $title = 'Tambah Surat penarikan';
        $prakerin = tb_prakerin::join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
        ->select('tb_prakerin.*', 'tb_pkl.nama_pkl','tb_pkl.alamat_pkl', 'siswa.nama_siswa','siswa.kelas','tbl_gurupendamping.nama')->get();
        $kSekolah = User::where('hak_akses','=','1')->get();

        return view('suratPenarikan.tambah', ['title' => $title, 'kSekolah' => $kSekolah, 'prakerin' => $prakerin]);
    }

    public function dapatkanPKL($idprakerin){
        $pkl = tb_prakerin::join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa', 'tb_prakerin.nisn','=','siswa.nisn')
        ->select('tb_pkl.nama_pkl','tb_pkl.alamat_pkl','siswa.nama_siswa')->findorfail($idprakerin);
        return response()->json(['pkl' => $pkl]);
    }

    public function storePenarikan(request $r){
        $r->validate([
            'prakerin' => 'required',
            'tanggal' => 'required',
            'alasan' => 'required',
           
            'kepalasekolah' => 'required',
        ],
        [
            'prakerin.required' => 'Tolong pilih Prakerin',
            'tanggal.required' => 'Tolong inputkan tanggal',
            'alasan.required' => 'Tolong inputkan Alasan Penarikan Siswa',
    
            'kepalasekolah.required' => 'Tolong pilih kepala sekolah',
        ]);

        suratpenarikan::insert([
            'prakerin' => $r->prakerin,
            'tanggal' => $r->tanggal,
            'alasan' => $r->alasan,
            'kepsek' => $r->kepalasekolah,
            'tahun' => $r->tahun
        ]);

        return redirect('/Siswa/suratPenarikan')->with('berhasil', 'File surat Penarikan berhasil di tambah');
    }

    public function lihatPenarikan($id){
        $surat = suratpenarikan::join('tb_prakerin','suratpenarikan.prakerin','=','tb_prakerin.idprakerin')
        ->join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')->join('tb_jurusan','siswa.id_jurusan','=','tb_jurusan.id_jurusan')
        ->findorfail($id);

        $prakerin = tb_prakerin::findorfail($surat->prakerin);
        if(auth()->guard('siswa')->check()){
            if($surat->nisn != auth()->guard('siswa')->user()->nisn){
                return redirect('/Siswa/suratPenarikan');
            }
        }
        if(auth()->guard('pendamping')->check()){
            if($prakerin->nip != auth()->guard('pendamping')->user()->nip){
                return redirect('/Siswa/suratPenarikan');
            }
        }
        $kSekolah = user::findorfail($surat->kepsek);
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
        $id = sprintf('%04d', $surat->id);
      
        $pdf = new pdfController('P', 'mm', 'A4');
        $pdf->AddFont('tahoma','','tahoma.php');
        $pdf->AddFont('tahoma','B','TAHOMAB0.php');
        $pdf->AddPage();
        $pdf->setFont('Arial', '', 12);
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

        $pdf->Ln(1);
        
       
        $pdf->setFont('tahoma', '', 12);
        $pdf->setX($pdf->getX() + 3.5);
        $pdf->Cell(20, 10, 'Nomor', 0, 0);
        $pdf->Cell(50, 10, ': B/'. $id . '/' . $formatBulanRomawi . '/SMK.PKL/' . $surat->tahun , 0, 1);
        $pdf->setY(37.6);
        $pdf->Cell(186.4, 17, 'Semarang, ' . $tanggal, 0, 1, 'R');
        $pdf->setX($pdf->getX() + 3.5);
        $pdf->Cell(20, 0, 'Perihal' , 0, 0);
        $pdf->Cell(3, 0, ': ' , 0, 0);
        $pdf->setFont('tahoma', 'B', 12);
        $pdf->Cell(0, 0, 'Penarikan Siswa PKL' , 0, 1);
        $pdf->Ln(10);
        $pdf->setFont('tahoma', '', 12);
        
        $pdf->setX($pdf->getX() + 3.5);
        $pdf->Cell(29, 7, 'Yth.  Pimpinan ', 0, 0);
        $pdf->setFont('tahoma', 'B', 12);
        $pdf->setX($pdf->getX() + 3.5);
        $pdf->MultiCell(110, 7, $surat->nama_pkl, 0, 'J');
        $pdf->setFont('tahoma', '', 12);
        $pdf->setX($pdf->getX() + 3.5);
        $pdf->MultiCell(110, 7, $surat->alamat_pkl, 0, 'J');
        $pdf->setX($pdf->getX() + 3.5);
        $pdf->MultiCell(110, 7, 'Di Tempat', 0, 1);
        $pdf->Ln(5);

        $pdf->setX($pdf->getX() + 23);
        $pdf->Cell(20, 10, 'Dengan hormat,', 0, 1);
        $pdf->setX($pdf->getX() + 23);
        $pdf->MultiCell(160, 8, 'Berdasarkan pertimbangan pembimbing PKL, Ketua Kompetensi Keahlian ' . $surat->nama_jurusan .' dan Koordinator Praktek Kerja Lapangan SMKN 5 Semarang. Permohonan maaf kami sampaikan kepada '. $surat->nama_pkl .', dengan ini kami menarik siswa SMKN 5 Semarang dari  '. $surat->nama_pkl .' dengan alasan '.$surat->alasan .'. Penarikan siswa di '. $surat->nama_pkl .', ini atas nama :', 0, 'J');
        $pdf->Ln(4);
        $pdf->SetLineWidth(0);
        $pdf->setX($pdf->getX() + 23);
        $pdf->setFont('tahoma', 'B', 12);
        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(70, 10, 'Nama', 1, 0, 'C');
        $pdf->Cell(49.5, 10, 'NIS', 1, 0, 'C');
        $pdf->Cell(29, 10, 'Kelas', 1, 1, 'C');

        $pdf->setX($pdf->getX() + 23);
        $pdf->setFont('tahoma', '', 12);
        $pdf->Cell(10, 20, '1', 1, 0, 'C');
        $pdf->Cell(70, 20, $surat->nama_siswa, 1, 0, 'C');
        $pdf->Cell(49.5, 20, $surat->nisn, 1, 0, 'C');
        $pdf->Cell(29, 20, $surat->kelas, 1, 1, 'C');
        $pdf->Ln(5);
        $pdf->setX($pdf->getX() + 23);
        $pdf->MultiCell(160, 8, 'Demikian Surat penarikan PKL ini kami sampaikan. Atas perhatian yang diberikan,  kami sampaikan terima kasih. ', 0, 'J');
        
        $pdf->setX($pdf->getX() + 150);
        $pdf->setXY(120, 244);
        $pdf->Cell(50, 3, 'Kepala Sekolah,', 0, 1, '');
        $pdf->setXY(120, 265);
        $pdf->setFont('tahoma', 'B', 12);
        $pdf->Cell(0, 3, $kSekolah->name, 0, 1, '');
        $pdf->setFont('tahoma', '', 12);
        $pdf->setX(120);
        $pdf->Cell(0, 8, 'NIP.' . $kSekolah->username, 0, 1, '');

      
        

        $pdf->output('I', 'Penarikan' . $id . '.pdf');
        exit;
    }

    public function ubahPenarikan($id){
        $title = 'Ubah Surat Izin';
        $kSekolah = User::where('hak_akses','=','1')->get();
        $prakerin = tb_prakerin::join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
        ->select('tb_prakerin.*', 'tb_pkl.nama_pkl','tb_pkl.alamat_pkl', 'siswa.nama_siswa','siswa.kelas','tbl_gurupendamping.nama')->get();
        $surat = suratpenarikan::findorfail($id);

        return view('suratPenarikan.ubah', ['title' => $title, 'prakerin' => $prakerin, 'kSekolah' => $kSekolah, 'surat' => $surat]);
    }

    public function editPenarikan($id, request $r){
        $surat = suratpenarikan::findorfail($id);
        $r->validate([
            'prakerin' => 'required',
            'tanggal' => 'required',
            'alasan' => 'required',
           
            'kepalasekolah' => 'required',
        ],
        [
            'prakerin.required' => 'Tolong pilih Prakerin',
            'tanggal.required' => 'Tolong inputkan tanggal',
            'alasan.required' => 'Tolong inputkan Alasan Penarikan Siswa',
    
            'kepalasekolah.required' => 'Tolong pilih kepala sekolah',
        ]);

        $surat->prakerin = $r->prakerin;
        $surat->tanggal = $r->tanggal;
        $surat->alasan = $r->alasan;
        $surat->kepsek = $r->kepalasekolah;
        $surat->tahun = $r->tahun;
        $surat->save();

        return redirect('/Siswa/suratPenarikan')->with('berhasil', 'File surat Penarikan Id ' . $surat->id . ' berhasil di Ubah');
    }

    public function hapusPenarikan($id){
        $surat = suratpenarikan::findorfail($id);
        $id = $surat->id;
        $surat->delete();

        return redirect('/Siswa/suratPenarikan')->with('berhasil', 'File surat Penarikan Id ' . $id . ' berhasil di Hapus');
    }

}
