<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jurnalPKL;
use App\Models\kegiatan_harian;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Http\Controllers\pdf\pdfController;
use Carbon\Carbon;
use App\Models\hadir;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class kegiatanHarianController extends Controller
{
   public function index($id){
        $title = 'Daftar Kegiatan harian';
          if(!is_numeric($id)){
            abort(404);
        }

            $jurnal = jurnalPKL::join('tb_prakerin', 'tb_prakerin.idprakerin', '=', 'jurnalpkl.prakerin')
            ->join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')
            ->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
            ->join('tb_jurusan','siswa.id_jurusan','=','tb_jurusan.id_jurusan')
            ->select('jurnalpkl.*', 'tbl_gurupendamping.nama', 'tbl_gurupendamping.nip', 'siswa.*', 'tb_jurusan.*', 'tb_pkl.*')
            ->findorfail($id);
            if(auth()->guard('siswa')->check()){
                if($jurnal->nisn != auth()->guard('siswa')->user()->nisn){
                    // return redirect('/Siswa/JurnalPKL');
                     abort(404);
                }
            }
            if(auth()->guard('pendamping')->check()){
                if($jurnal->nip != auth()->guard('pendamping')->user()->nip){
                    // return redirect('/Siswa/JurnalPKL');
                     abort(404);
                }
            }
             $tanggalHariIni = Carbon::today();
        $cek_sakit = hadir::where(function($query) use ($tanggalHariIni) {
                $query->where('izin', '=', '1')
                      ->where('tanggal', '=', $tanggalHariIni->toDateString());
            })->where('jurnal', '=', $jurnal->id)->count();

             $hadir = hadir::where('jurnal', '=', $id)->get();
       $cek_hadir = $hadir->where('tanggal', $tanggalHariIni->toDateString())->count();
        $surat = kegiatan_harian::where('jurnal', '=', $id)->orderBy('tanggal', 'desc')->get();

         $jumlah_kegiatan = kegiatan_harian::where('jurnal', '=', $id)->count();
        $hari_ini = $tanggalHariIni->format('Y-m-d');
        $cek_hari_ini = Carbon::today()->isoFormat('dddd, D MMMM');
        $cek_kegiatan = jurnalPKL::join('tb_prakerin', 'tb_prakerin.idprakerin', '=', 'jurnalpkl.prakerin')
        ->select('tb_prakerin.start', 'tb_prakerin.end')
        ->findorfail($id);

        return view('kegiatan.index', ['hari_ini' => $hari_ini,'title' => $title, 'surat' => $surat, 'id' => $id, 'cek_kegiatan' => $cek_kegiatan, 'tanggalHariIni' => $tanggalHariIni, 'jurnal' => $jurnal, 'cek_hadir' => $cek_hadir, 'cek_sakit' => $cek_sakit, 'cek_hari_ini' => $cek_hari_ini, 'jumlah_kegiatan' => $jumlah_kegiatan]);
    }

     public function tambah($id){
        $title = 'Tambah Kegiatan harian';
         if(!is_numeric($id)){
            abort(404);
        }
           $jurnal = jurnalPKL::join('tb_prakerin', 'tb_prakerin.idprakerin', '=', 'jurnalpkl.prakerin')
            ->join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')
            ->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
            ->join('tb_jurusan','siswa.id_jurusan','=','tb_jurusan.id_jurusan')
            ->select('jurnalpkl.*', 'tbl_gurupendamping.nama', 'siswa.*', 'tb_jurusan.*', 'tb_pkl.*')
            ->findorfail($id);
        if(auth()->guard('siswa')->check()){

            if(auth()->guard('siswa')->check()){
                if($jurnal->nisn != auth()->guard('siswa')->user()->nisn){
                    // return redirect('/Siswa/JurnalPKL');
                     abort(404);
                }
            }
        }
        $tanggalHariIni = Carbon::today();

          $cek_sakit = hadir::where(function($query) use ($tanggalHariIni) {
                $query->where('izin', '=', '1')
                      ->where('tanggal', '=', $tanggalHariIni->toDateString());
            })->where('jurnal', '=', $jurnal->id)->count();

             $hadir = hadir::where('jurnal', '=', $id)->get();
       $cek_hadir = $hadir->where('tanggal', $tanggalHariIni->toDateString())->count();
        $surat = kegiatan_harian::where('jurnal', '=', $id)->get();

        if($cek_hadir == 0 && $cek_sakit == 0){
// return redirect('/Siswa/JurnalPKL/harian/' . $id)->with('gagal', 'Belum absen datang');
 abort(404);
}
elseif($cek_sakit > 0){
// return redirect('/Siswa/JurnalPKL/harian/' . $id)->with('gagal', 'Sudah izin');
 abort(404);
}

        $tanggalHariIni = Carbon::today()->format('Y-m-d');
        $cek_kegiatan = jurnalPKL::join('tb_prakerin', 'tb_prakerin.idprakerin', '=', 'jurnalpkl.prakerin')
        ->select('tb_prakerin.start', 'tb_prakerin.end')
        ->findorfail($id);

        if($cek_kegiatan->start > $tanggalHariIni){
            // return redirect('/Siswa/JurnalPKL/harian/' . $id)->with('gagal', 'Prakerin belum dimulai');
             abort(404);
        }

        if($cek_kegiatan->end < $tanggalHariIni){
            // return redirect('/Siswa/JurnalPKL/harian/' . $id)->with('gagal', 'Prakerin sudah selesai');
             abort(404);
        }

        return view('kegiatan.tambah', ['title' => $title, 'id' => $id]);
    }

   public function store($id, request $r){
        if(!is_numeric($id)){
            abort(404);
        }
                    $jurnal = jurnalPKL::join('tb_prakerin', 'tb_prakerin.idprakerin', '=', 'jurnalpkl.prakerin')
            ->join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')
            ->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
            ->join('tb_jurusan','siswa.id_jurusan','=','tb_jurusan.id_jurusan')
            ->select('jurnalpkl.*', 'tbl_gurupendamping.nama', 'siswa.*', 'tb_jurusan.*', 'tb_pkl.*')
            ->findorfail($id);
        if(auth()->guard('siswa')->check()){

            if(auth()->guard('siswa')->check()){
                if($jurnal->nisn != auth()->guard('siswa')->user()->nisn){
                    return redirect('/Siswa/JurnalPKL');
                }
            }

        }

  $tanggalHariIni = Carbon::today();

          $cek_sakit = hadir::where(function($query) use ($tanggalHariIni) {
                $query->where('izin', '=', '1')
                      ->where('tanggal', '=', $tanggalHariIni->toDateString());
            })->where('jurnal', '=', $jurnal->id)->count();

             $hadir = hadir::where('jurnal', '=', $id)->get();
       $cek_hadir = $hadir->where('tanggal', $tanggalHariIni->toDateString())->count();
        $surat = kegiatan_harian::where('jurnal', '=', $id)->get();

        if($cek_hadir == 0 && $cek_sakit == 0){
// return redirect('/Siswa/JurnalPKL/harian/' . $id)->with('gagal', 'Belum absen datang');
 abort(404);
}
elseif($cek_sakit > 0){
return redirect('/Siswa/JurnalPKL/harian/' . $id)->with('gagal', 'Sudah izin');
}
        $tanggalHariIni = Carbon::today()->format('Y-m-d');;
        $cek_kegiatan = jurnalPKL::join('tb_prakerin', 'tb_prakerin.idprakerin', '=', 'jurnalpkl.prakerin')
        ->select('tb_prakerin.start', 'tb_prakerin.end')
        ->findorfail($id);

        if($cek_kegiatan->start > $tanggalHariIni){
            // return redirect('/Siswa/JurnalPKL/harian/' . $id)->with('gagal', 'Prakerin belum dimulai');
             abort(404);
        }

        if($cek_kegiatan->end < $tanggalHariIni){
            // return redirect('/Siswa/JurnalPKL/harian/' . $id)->with('gagal', 'Prakerin sudah selesai');
             abort(404);
        }


        $r->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg',
            'uraian' => 'required|max:199'
        ],
        [
            'foto.required' => 'Tolong inputkan foto kegiatan kamu',
            'foto.image' => 'Yang kamu inputkan bukan foto',
            'foto.mimes' => 'Yang kamu inputkan bukan foto',
            'uraian.required' => 'Tolong inputkan uraian kegiatan',
            'uraian.max' => 'Uraian terlalu panjang'
        ]);

$file = $r->file('foto');
$fotoName = $file->hashName();
$imagePath = $file->getPathName();

// Ambil info dimensi dan tipe gambar
list($width, $height, $type) = @getimagesize($imagePath);

// Buat resource dari file asli
switch ($type) {
    case IMAGETYPE_JPEG:
        $image = imagecreatefromjpeg($imagePath);
        break;
    case IMAGETYPE_PNG:
        $image = imagecreatefrompng($imagePath);
        break;
    case IMAGETYPE_GIF:
        $image = imagecreatefromgif($imagePath);
        break;
    default:
        throw new \Exception('Unsupported image type');
}

// Kompres gambar ke file sementara
$quality = 20;
$tempPath = sys_get_temp_dir() . '/temp_' . $fotoName;

if ($type == IMAGETYPE_JPEG) {
    imagejpeg($image, $tempPath, $quality);
} elseif ($type == IMAGETYPE_PNG) {
    imagepng($image, $tempPath, round($quality / 10));
} elseif ($type == IMAGETYPE_GIF) {
    imagegif($image, $tempPath);
}
imagedestroy($image);

// Simpan hasil kompres ke public/storage/foto_kegiatan
$finalPath = 'foto_kegiatan/' . $fotoName;
Storage::disk('public')->put($finalPath, file_get_contents($tempPath));

// Hapus file sementara
unlink($tempPath);

// URL akses publik
$imageUrl = asset('storage/' . $finalPath);


        kegiatan_harian::insert([
            'jurnal' => $id,
            'foto' => $fotoName,
            'uraian' => $r->uraian,
            'tanggal' => $r->tanggal
        ]);

        return redirect('Siswa/JurnalPKL/harian/' . $id)->with('berhasil', 'Data kegiatan harian berhasil ditambah');
    }

    public function hapus($id, $id_kegiatan){
        if(auth()->guard('siswa')->check()){
            $jurnal = jurnalPKL::join('tb_prakerin', 'tb_prakerin.idprakerin', '=', 'jurnalpkl.prakerin')
            ->join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')
            ->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
            ->join('tb_jurusan','siswa.id_jurusan','=','tb_jurusan.id_jurusan')
            ->select('jurnalpkl.*', 'tbl_gurupendamping.nama', 'siswa.*', 'tb_jurusan.*', 'tb_pkl.*')
            ->findorfail($id);
            if(auth()->guard('siswa')->check()){
                if($jurnal->nisn != auth()->guard('siswa')->user()->nisn){
                    return redirect('/Siswa/JurnalPKL');
                }
            }
        }

        if(auth()->guard('siswa')->check()){
            $tanggalHariIni = Carbon::today();
            $hari_ini = $tanggalHariIni->format('Y-m-d');
            $kegiatan = kegiatan_harian::where('jurnal', $jurnal->id)->findorfail($id_kegiatan);
            if($kegiatan->tanggal != $hari_ini){
              /*  return redirect()->back()->with('gagal', 'Kamu sudah tidak bisa menghapus kegiatan harian kamu');*/
               abort(404);
            }
        }else{
        $kegiatan = kegiatan_harian::findorfail($id_kegiatan);
        }


Storage::disk('public')->delete('foto_kegiatan/' . $kegiatan->foto);

$kegiatan->delete();

        return redirect('Siswa/JurnalPKL/harian/' . $id)->with('berhasil', 'Data kegiatan harian berhasil di Hapus');
    }

    public function ubah($id, $id_kegiatan){
         if(!is_numeric($id)){
            abort(404);
        }
        $title = 'Ubah Kegiatan';
        if(auth()->guard('siswa')->check()){
            $jurnal = jurnalPKL::join('tb_prakerin', 'tb_prakerin.idprakerin', '=', 'jurnalpkl.prakerin')
            ->join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')
            ->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
            ->join('tb_jurusan','siswa.id_jurusan','=','tb_jurusan.id_jurusan')
            ->select('jurnalpkl.*', 'tbl_gurupendamping.nama', 'siswa.*', 'tb_jurusan.*', 'tb_pkl.*')
            ->findorfail($id);
            if(auth()->guard('siswa')->check()){
                if($jurnal->nisn != auth()->guard('siswa')->user()->nisn){
                    // return redirect('/Siswa/JurnalPKL');
                     abort(404);
                }
            }
            $tanggalHariIni = Carbon::today();
            $hari_ini = $tanggalHariIni->format('Y-m-d');
            $kegiatan = kegiatan_harian::where('jurnal', $jurnal->id)->findorfail($id_kegiatan);
            if($kegiatan->tanggal != $hari_ini){
                // return redirect()->back()->with('gagal', 'Kamu sudah tidak bisa mengedit kegiatan harian kamu');
                 abort(404);
            }
        }else{

        $kegiatan = kegiatan_harian::findorfail($id_kegiatan);
        }


        return view('kegiatan.edit', ['title' => $title, 'id' => $id, 'kegiatan' => $kegiatan]);
    }

    public function edit($id, $id_kegiatan, request $r){
        if(auth()->guard('siswa')->check()){
            $jurnal = jurnalPKL::join('tb_prakerin', 'tb_prakerin.idprakerin', '=', 'jurnalpkl.prakerin')
            ->join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')
            ->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
            ->join('tb_jurusan','siswa.id_jurusan','=','tb_jurusan.id_jurusan')
            ->select('jurnalpkl.*', 'tbl_gurupendamping.nama', 'siswa.*', 'tb_jurusan.*', 'tb_pkl.*')
            ->findorfail($id);
            if(auth()->guard('siswa')->check()){
                if($jurnal->nisn != auth()->guard('siswa')->user()->nisn){
                    // return redirect('/Siswa/JurnalPKL');
                     abort(404);
                }
            }

        }

        $r->validate([
            'foto' => 'image|mimes:jpeg,png,jpg',
            'uraian' => 'required|max:199'
        ],
        [

            'foto.image' => 'Yang kamu inputkan bukan foto',
            'foto.mimes' => 'Yang kamu inputkan bukan foto',
            'uraian.required' => 'Tolong inputkan uraian kegiatan',
            'uraian.max' => 'Uraian terlalu panjang'
        ]);

        if(auth()->guard('siswa')->check()){
            $tanggalHariIni = Carbon::today();
            $hari_ini = $tanggalHariIni->format('Y-m-d');
            $kegiatan = kegiatan_harian::where('jurnal', $jurnal->id)->findorfail($id_kegiatan);
            if($kegiatan->tanggal != $hari_ini){
                // return redirect()->back()->with('gagal', 'Kamu sudah tidak bisa mengedit kegiatan harian kamu');
                 abort(404);
            }
        }else{
        $kegiatan = kegiatan_harian::findorfail($id_kegiatan);
        }

        if ($r->hasFile('foto')) {

            if ($kegiatan->foto != null) {
                Storage::disk('public')->delete('foto_kegiatan/' . $kegiatan->foto);
            }


    $file = $r->file('foto');
$fotoName = $file->hashName();

$kegiatan->foto = $fotoName;


$imagePath = $file->getPathName();
list($width, $height, $type) = @getimagesize($imagePath);


switch ($type) {
    case IMAGETYPE_JPEG:
        $image = imagecreatefromjpeg($imagePath);
        break;
    case IMAGETYPE_PNG:
        $image = imagecreatefrompng($imagePath);
        break;
    case IMAGETYPE_GIF:
        $image = imagecreatefromgif($imagePath);
        break;
    default:
        throw new \Exception('Unsupported image type');
}

// Kompresi gambar
$quality = 20;
$tempPath = sys_get_temp_dir() . '/' . $fotoName;

if ($type == IMAGETYPE_JPEG) {
    imagejpeg($image, $tempPath, $quality);
} elseif ($type == IMAGETYPE_PNG) {
    imagepng($image, $tempPath, round($quality / 10));
} elseif ($type == IMAGETYPE_GIF) {
    imagegif($image, $tempPath);
}


imagedestroy($image);

$savePath = 'foto_kegiatan/' . $fotoName;
Storage::disk('public')->put($savePath, file_get_contents($tempPath));


unlink($tempPath);

        }

        $kegiatan->uraian = $r->uraian;
        $kegiatan->save();

        return redirect('Siswa/JurnalPKL/harian/' . $id)->with('berhasil', 'Data kegiatan harian berhasil di Ubah');
    }

    public function pdf($id){
        $jurnal = jurnalPKL::join('tb_prakerin', 'tb_prakerin.idprakerin', '=', 'jurnalpkl.prakerin')
        ->join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')
        ->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
        ->join('tb_jurusan','siswa.id_jurusan','=','tb_jurusan.id_jurusan')
        ->select('jurnalpkl.*', 'tbl_gurupendamping.nama', 'siswa.*', 'tb_jurusan.*', 'tb_pkl.*')
        ->findorfail($id);
        if(auth()->guard('siswa')->check()){
            if(auth()->guard('siswa')->check()){
                if($jurnal->nisn != auth()->guard('siswa')->user()->nisn){
                    return redirect('/Siswa/JurnalPKL');
                }
            }
        }
        $title = 'Tentukan pdf absen siswa pulang';
        return view('kegiatan.tentukan', ['title' => $title, 'id' => $id]);
    }

    public function getpdf($id, request $r){
        $jurnal = jurnalPKL::join('tb_prakerin', 'tb_prakerin.idprakerin', '=', 'jurnalpkl.prakerin')
        ->join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')
        ->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
        ->join('tb_jurusan','siswa.id_jurusan','=','tb_jurusan.id_jurusan')
        ->select('jurnalpkl.*', 'tbl_gurupendamping.nama', 'siswa.*', 'tb_jurusan.*', 'tb_pkl.*')
        ->findorfail($id);
        if(auth()->guard('siswa')->check()){
            if(auth()->guard('siswa')->check()){
                if($jurnal->nisn != auth()->guard('siswa')->user()->nisn){
                    return redirect('/Siswa/JurnalPKL');
                }
            }
        }


        if($r->tentukan == '1'){
            $r->validate([
                'awal' => 'required',
                'akhir' => 'required'
            ],
            [
                'awal.required' => 'Tolong isikan tanggal awal',
                'akhir.required' => 'Tolong isikan tanggal akhir'
            ]);

            $awal = $r->awal;
            $akhir = $r->akhir;

             if($awal > $akhir){
                return redirect()->back()->withInput()->with('error', 'Bagian sampai tanggal tidak bisa lebih awal dari pada antara tanggal');
            }

            $kegiatan = kegiatan_harian::where(function($query) use ($awal, $akhir) {
                $query->whereBetween('tanggal', [$awal, $akhir]);
                })->where('jurnal', '=', $id)->get();
        }else{
            $kegiatan = kegiatan_harian::where('jurnal','=',$id)->get();
        }

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

    $kSekolah = User::findorfail($surat->kepsek);
    $tanggalll = $surat->tanggal;
    $tanggall = Carbon::parse($tanggalll);
    $tanggal = $tanggall->isoFormat('D MMMM YYYY');

    $tgl_awal = $r->awal;
    $tgll_awal = Carbon::parse($tgl_awal);
    $tanggalAwal = $tgll_awal->isoFormat('D MMMM YYYY');

    $tgl_akhir = $r->akhir;
    $tgll_akhir = Carbon::parse($tgl_akhir);
    $tanggalAkhir = $tgll_akhir->isoFormat('D MMMM YYYY');
    if (!file_exists(public_path('temp_pdf'))) {
        mkdir(public_path('temp_pdf'), 0755, true);
    }


    $pdf = new pdfController('P', 'mm', 'A4');
    $pdf->AddPage();
     $pdf->AddFont('tahoma','','tahoma.php');
        $pdf->AddFont('tahoma','B','TAHOMAB0.php');
    $pdf->SetLineWidth(0.65);
    $pdf->Rect(4.1, 4.1, $pdf->GetPageWidth() - 8.2, $pdf->GetPageHeight() - 8.2);
    $pdf->setFont('times', 'B', 12);
    $pdf->Cell(0, 10, 'KEGIATAN HARIAN', 0, 1, 'C');
    if($r->tentukan == '1'){
        $pdf->Cell(0, 10, 'Dari tanggal ' . $tanggalAwal . ' sampai tanggal ' . $tanggalAkhir, 0, 1, 'C');
    }
    $pdf->Ln(8);
    $pdf->SetLineWidth(0.25);
    $pdf->Cell(10, 20, 'NO', 1, 0, 'C');
    $pdf->Cell(40, 20, 'HARI/ TANGGAL', 1, 0, 'C');
    $pdf->Cell(101.5, 20, 'URAIAN KEGIATAN', 1, 0, 'C');
    $pdf->Cell(37.5, 20, 'FOTO', 1, 1, 'C');

    $nomor_harian = 1;
    if($kegiatan->isEmpty()){
        $pdf->Cell(189, 25, 'Belum ada kegiatan', 1, 0, 'C');
    }
    foreach ($kegiatan as $k) {
        if($nomor_harian % 8 == 0){
            $pdf->AddPage();
            $pdf->SetLineWidth(0.25);
            $pdf->Line($pdf->getX() + 50, $pdf->getY(), $pdf->getX() + 160, $pdf->getY());
        }
        $pdf->SetLineWidth(0.25);
        $pdf->setFont('times', '', 12);

        $tgl_kegiatan = Carbon::parse($k->tanggal);
        $tanggal_kegiatan = $tgl_kegiatan->isoFormat('dddd, D MMMM');

        $x = $pdf->GetX();
        $y = $pdf->GetY();

        $pdf->Cell(10, 25, $nomor_harian++, 1, 0, 'C');
        $pdf->Cell(40, 25, $tanggal_kegiatan, 1, 0, 'C');

        $uraian = $k->uraian;
        $cellWidth = 101.5;
        $cellHeight = 25;
        $xUraian = $pdf->GetX();
        $yUraian = $pdf->GetY();

        if(strlen($uraian) < 55){
            $pdf->Cell($cellWidth, $cellHeight, $uraian, 1, 0, 'C');
        } else {
            $pdf->SetXY($xUraian, $yUraian + 3);
            $pdf->MultiCell($cellWidth, 5, $uraian, 0, 'C');

            $currentHeight = $pdf->GetY() - $yUraian;
            if ($currentHeight < $cellHeight) {
                $pdf->SetXY($xUraian, $yUraian + $currentHeight);
                $pdf->Cell($cellWidth, $cellHeight - $currentHeight, '', 'LBR', 0, 'C');
            }
            $pdf->SetXY($x + 151.5, $y);
        }

        $pdf->Cell(37.5, $cellHeight, '', 1, 1, 'C');

        $pdf->Image(
            Storage::disk('public')->path('foto_kegiatan/' . $k->foto),
            $pdf->GetX() + 152.2,
            $pdf->GetY() - 24.5,
            36.1,
            24
        );

        $pdf->SetLineWidth(0.65);
        $pdf->Rect(4.1, 4.1, $pdf->GetPageWidth() - 8.2, $pdf->GetPageHeight() - 8.2);
    }
     $pdf->setX($pdf->getX() + 150);
       $pdf->setXY(120, 250);
       $pdf->Cell(50, 3, 'Pembimbing, ...................................', 0, 1, '');
       $pdf->setXY(120, $pdf->getY() + 20.997);
       $pdf->setFont('tahoma', 'B', 12);
       $pdf->Cell(0, 3, '..............................................', 0, 1, '');
       $pdfFilePath = public_path('temp_pdf/KegiatanHarian_' . $jurnal->nama_siswa . '.pdf');
    $pdf->Output($pdfFilePath, 'F');

    return response()->download($pdfFilePath)->deleteFileAfterSend(true);
    }
}
