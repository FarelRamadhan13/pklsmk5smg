<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\hadir;
use App\Models\jurnalPKL;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Carbon\Carbon;
use App\Models\kegiatan_harian;
use App\Models\tb_prakerin;
use App\Http\Controllers\pdf\pdfController;


class hadirSiswaController extends Controller
{
     public function index($id){
          $title = 'Daftar hadir';

        if(!is_numeric($id)){
            abort(404);
        }

            $jurnal = jurnalPKL::join('tb_prakerin', 'tb_prakerin.idprakerin', '=', 'jurnalpkl.prakerin')
            ->join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')
            ->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
            ->join('tb_jurusan','siswa.id_jurusan','=','tb_jurusan.id_jurusan')
            ->select('jurnalpkl.id', 'tbl_gurupendamping.nama', 'tbl_gurupendamping.nip', 'siswa.*', 'tb_jurusan.*', 'tb_pkl.*')
            ->findorfail($id);
            if(auth()->guard('siswa')->check()){
                if($jurnal->nisn != auth()->guard('siswa')->user()->nisn){
                   abort(404);
                }
            }
            if(auth()->guard('pendamping')->check()){
                if($jurnal->nip != auth()->guard('pendamping')->user()->nip){
                    // return redirect('/Siswa/JurnalPKL');
                     abort(404);
                }
            }

$dataHadir = hadir::selectRaw('SUM(izin = 0) as hadir, SUM(izin = 1) as izin')
    ->where('jurnal', $jurnal->id)
    ->first();

$hadir = $dataHadir->hadir;
$izin = $dataHadir->izin;


            $tanggalHariIni = Carbon::today();
            $cek_hari = Carbon::today()->format('Y-m-d');
            $cek_hari_ini = Carbon::today()->isoFormat('dddd, D MMMM');
            $cek_sakit = hadir::where(function($query) use ($tanggalHariIni) {
                $query->where('izin', '=', '1')
                      ->where('tanggal', '=', $tanggalHariIni->toDateString());
            })->where('jurnal', '=', $jurnal->id)->count();

            if ($tanggalHariIni->isSaturday() || $tanggalHariIni->isSunday() || $cek_sakit >= 1) {
                $cek_hadir_hari = 1;
                $cek_kegiatan = 1;
                $absen = hadir::where(function($query) {
                    $query->where('foto_pulang', '=', null)
                          ->orWhere('waktu_pulang', '=', null);
                })->where('jurnal', '=', $jurnal->id)->latest()->first();
            } else {
                    $cek_hadir_hari = hadir::where(function($query) use ($tanggalHariIni) {
                        $query->where('tanggal', $tanggalHariIni->toDateString());
                    })->where('jurnal', '=', $jurnal->id)->count();

                    $cek_kegiatan = kegiatan_harian::where(function($query) use ($tanggalHariIni) {
                        $query->where('tanggal', $tanggalHariIni->toDateString());
                    })->where('jurnal', '=', $jurnal->id)->count();
                    $absen = hadir::where(function($query) {
                        $query->where('foto_pulang', '=', null)
                              ->orWhere('waktu_pulang', '=', null);
                        })->where('jurnal', '=', $jurnal->id)->latest()->first();
                }


        $cek = hadir::where(function($query){
                $query->where('foto_pulang','=',null)->orwhere('waktu_pulang','=',null);
        })->where('jurnal','=',$id)->count();
        $surat = hadir::where('jurnal', '=', $id)->orderBy('tanggal', 'desc')->get();


if ($tanggalHariIni !== null) {
    $cek_hadir = $surat->where('tanggal', $tanggalHariIni->toDateString())->count();
}

$cek_absen = jurnalPKL::join('tb_prakerin', 'tb_prakerin.idprakerin', '=', 'jurnalpkl.prakerin')
->select('tb_prakerin.start', 'tb_prakerin.end')
->findorfail($id);

$totalSecondsDatang = 0;
$totalSecondsPulang = 0;
$countDatang = 0;
$countPulang = 0;
$kurang_sesuai = 0;

$semua_absen = hadir::where('izin', '0')->where('jurnal', $jurnal->id)->get();

foreach ($semua_absen as $abs) {

    if (!is_null($abs->waktu_pulang) && $abs->waktu_datang > $abs->waktu_pulang) {
        $kurang_sesuai++;
    }


    if (!is_null($abs->waktu_datang)) {
        $totalSecondsDatang += Carbon::parse($abs->waktu_datang)->diffInSeconds(Carbon::today());
        $countDatang++;
    }


    if (!is_null($abs->waktu_pulang)) {
        $totalSecondsPulang += Carbon::parse($abs->waktu_pulang)->diffInSeconds(Carbon::today());
        $countPulang++;
    }
}


$averageSecondsDatang = $countDatang > 0 ? $totalSecondsDatang / $countDatang : 0;
$averageTimeDatang = $countDatang > 0 ? Carbon::today()->addSeconds($averageSecondsDatang)->toTimeString() : 'Tidak ada data';


$averageSecondsPulang = $countPulang > 0 ? $totalSecondsPulang / $countPulang : 0;
$averageTimePulang = $countPulang > 0 ? Carbon::today()->addSeconds($averageSecondsPulang)->toTimeString() : 'Tidak ada data';


 $sudah_absen = hadir::where(function($query) use ($tanggalHariIni) {
                    $query->where('tanggal', $tanggalHariIni->toDateString());
                })->where('jurnal', '=', $jurnal->id)->first();

        return view('hadir.index', ['averageTimeDatang' => $averageTimeDatang,'averageTimePulang' => $averageTimePulang,'kurang_sesuai' => $kurang_sesuai, 'hadir' => $hadir,'izin' => $izin, 'absen' => $absen,'jurnal' => $jurnal,'cek_hadir_hari' => $cek_hadir_hari,'cek_kegiatan' => $cek_kegiatan,'title' => $title, 'surat' => $surat, 'id' => $id, 'cek' => $cek, 'cek_hadir' => $cek_hadir, 'cek_absen' => $cek_absen, 'tanggalHariIni' => $tanggalHariIni, 'cek_sakit' => $cek_sakit, 'cek_hari' => $cek_hari, 'cek_hari_ini' => $cek_hari_ini, 'sudah_absen' => $sudah_absen]);
    }

   public function datang($id){
         if(!is_numeric($id)){
            abort(404);
        }
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
        $tanggalHariIni = Carbon::today()->format('Y-m-d');

        $cek_absen = jurnalPKL::join('tb_prakerin', 'tb_prakerin.idprakerin', '=', 'jurnalpkl.prakerin')
        ->select('tb_prakerin.start', 'tb_prakerin.end')
        ->findorfail($id);

        if($cek_absen->start > $tanggalHariIni){
            return redirect('/Siswa/JurnalPKL/Absen/' . $id)->with('gagal', 'Kamu belum memulai prakerin');
            //  abort(404);
        }

        if($cek_absen->end < $tanggalHariIni){
            return redirect('/Siswa/JurnalPKL/Absen/' . $id)->with('gagal', 'Waktu prakerin kamu sudah selesai');
            //  abort(404);
        }

        $surat = hadir::where('jurnal', '=', $id)->get();

        $cek_hadir = $surat->where('tanggal', Carbon::today()->toDateString())->count();

        if($cek_hadir > 0){
            return redirect('/Siswa/JurnalPKL/Absen/' . $id)->with('absen', 'Kamu sudah absen hari ini');

        }

         $cek = hadir::whereNull('foto_pulang')->where('jurnal', '=', $id)->count();



        if ($cek > 0) {

            $pulangg = hadir::whereNull('foto_pulang')->where('jurnal', '=', $id)->first();
            return redirect('/Siswa/JurnalPKL/Absen/' . $id . '/pulang/' . $pulangg->id_hadir);
            //  abort(404);
        }
        $title = 'Absen datang';
        return view('hadir.tambah', ['title' => $title, 'id' => $id]);
    }

   public function datangs($id, request $r){
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

        $surat = hadir::where('jurnal', '=', $id)->get();

        $cek_hadir = $surat->where('tanggal', Carbon::today()->toDateString())->count();

        if($cek_hadir > 0){
            return redirect('/Siswa/JurnalPKL/Absen/' . $id)->with('absen', 'Kamu sudah absen hari ini');

        }

        $tanggalHariIni = Carbon::today()->format('Y-m-d');

        $cek_absen = jurnalPKL::join('tb_prakerin', 'tb_prakerin.idprakerin', '=', 'jurnalpkl.prakerin')
        ->select('tb_prakerin.start', 'tb_prakerin.end')
        ->findorfail($id);

        if($cek_absen->start > $tanggalHariIni){
            // return redirect('/Siswa/JurnalPKL/Absen/' . $id)->with('gagal', 'Kamu belum memulai prakerin');
             abort(404);
        }

        if($cek_absen->end < $tanggalHariIni){
            // return redirect('/Siswa/JurnalPKL/Absen/' . $id)->with('gagal', 'Waktu prakerin kamu sudah selesai');
             abort(404);
        }



        $cek = hadir::whereNull('foto_pulang')->where('jurnal', '=', $id)->count();

        if ($cek > 0) {
            return redirect('/Siswa/JurnalPKL/Absen/' . $id)->with('berhasil', 'Kamu sudah absen');

        }


//       $file = $r->input('foto');
// $fotoName = $file->hashName();
// $destinationPath = storage_path('app/public/foto_siswa_datang');

//  $capturedImage = $r->input('capturedImage');
//     $imageData = explode(',', $capturedImage)[1];
//     $imageName = uniqid() . '.jpeg';
//     Storage::disk('public')->put('foto_siswa_datang/' . $imageName, base64_decode($imageData));




// if (!file_exists($destinationPath)) {
//     mkdir($destinationPath, 0755, true);
// }


// $imagePath = $file->getPathName();
// list($width, $height, $type) = @getimagesize($imagePath);


// switch ($type) {
//     case IMAGETYPE_JPEG:
//         $image = imagecreatefromjpeg($imagePath);
//         break;
//     case IMAGETYPE_PNG:
//         $image = imagecreatefrompng($imagePath);
//         break;
//     case IMAGETYPE_GIF:
//         $image = imagecreatefromgif($imagePath);
//         break;
//     default:
//         throw new \Exception('Unsupported image type');
// }


// $quality = 50;


// $savePath = $destinationPath . '/' . $fotoName;
// if ($type == IMAGETYPE_JPEG) {
//     imagejpeg($image, $savePath, $quality);
// } elseif ($type == IMAGETYPE_PNG) {
//     imagepng($image, $savePath, round($quality / 10));
// } elseif ($type == IMAGETYPE_GIF) {
//     imagegif($image, $savePath);
// }


// imagedestroy($image);



       if($r->izin == '0'){
        $r->validate([
    'capturedImage' => 'required',
], [
    'capturedImage.required' => 'Tolong klik Ambil Foto!',
]);

$capturedImage = $r->input('capturedImage');


$imageData = explode(',', $capturedImage)[1];

$imageData = base64_decode($imageData);


$imageName = uniqid() . '.jpeg';

$relativePath = 'foto_siswa_datang/' . $imageName;


Storage::disk('public')->put($relativePath, $imageData);


$imageUrl = asset('storage/' . $relativePath);


        hadir::insert([
            'tanggal' => now(),
            'waktu_datang' => now()->format('H:i:s'),
            'foto_datang' =>  $imageName,
            'jurnal' => $id,
            'latitude' => $r->latitude,
            'longitude' => $r->longitude,
            'izin' => '0'
        ]);
        return redirect('/Siswa/JurnalPKL/Absen/' . $id)->with('berhasil', ' Berhasil absensi datang ke industri pada pukul ' . now()->format('H:i:s'));
    }else{


      $r->validate([
    'izin' => 'required|image|mimes:jpeg,png,jpg',
], [
    'izin.required' => 'Tolong inputkan Foto',
    'izin.image' => 'Tolong inputkan Foto',
    'izin.mimes' => 'Tolong inputkan Foto',
]);

$file = $r->file('izin');
$fotoName = $file->hashName();

$tempPath = $file->getPathName();
list($width, $height, $type) = @getimagesize($tempPath);

// Buat resource image
switch ($type) {
    case IMAGETYPE_JPEG:
        $image = imagecreatefromjpeg($tempPath);
        break;
    case IMAGETYPE_PNG:
        $image = imagecreatefrompng($tempPath);
        break;
    case IMAGETYPE_GIF:
        $image = imagecreatefromgif($tempPath);
        break;
    default:
        throw new \Exception('Unsupported image type');
}

$quality = 20;


// $localTempPath = storage_path('public/storage/foto_siswa_datang/' . $fotoName);
$localTempPath = public_path('storage/foto_siswa_datang/' . $fotoName);
if (!file_exists(dirname($localTempPath))) {
    mkdir(dirname($localTempPath), 0755, true);
}

if ($type == IMAGETYPE_JPEG) {
    imagejpeg($image, $localTempPath, $quality);
} elseif ($type == IMAGETYPE_PNG) {
    imagepng($image, $localTempPath, round($quality / 10));
} elseif ($type == IMAGETYPE_GIF) {
    imagegif($image, $localTempPath);
}

imagedestroy($image);


$publicUrl = asset('storage/foto_siswa_datang/' . $fotoName);

        hadir::insert([
            'tanggal' => now(),
            'waktu_datang' => now()->format('H:i:s'),
            'foto_datang' =>  $fotoName,
            'jurnal' => $id,
            'latitude' => $r->latitude,
            'longitude' => $r->longitude,
            'izin' => '1',
            'foto_pulang' =>  $fotoName,
            'waktu_pulang' => now()->format('H:i:s'),
        ]);
        return redirect('/Siswa/JurnalPKL/Absen/' . $id)->with('berhasil', ' Berhasil izin');

    }




    }


    public function pulang($id, $id_hadir){
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

        $absensi = hadir::where('jurnal', $jurnal->id)->findOrFail($id_hadir);


        if ($absensi->foto_pulang !== null) {
            return redirect('/Siswa/JurnalPKL/Absen/' . $id)->with('berhasil', 'Kamu sudah absensi pulang.');
        }

        $title = 'Absen pulang';
        return view('hadir.pulang', ['title' => $title, 'id' => $id]);
    }

    public function pulangs($id, $id_hadir, request $r){
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

          $absensi = hadir::findOrFail($id_hadir);


        if ($absensi->foto_pulang !== null) {
            return redirect('/Siswa/JurnalPKL/Absen/' . $id)->with('berhasil', 'Kamu sudah absensi pulang.');
        }
//         $r->validate([
//             'foto' => 'required|image|mimes:jpeg,png,jpg',

//         ],
//         [
//             'foto.required' => 'Tolong inputkan foto kamu saat berada di industri',
//             'foto.image' => 'Yang kamu inputkan bukan foto',
//             'foto.mimes' => 'Yang kamu inputkan bukan foto',

//         ]);

//        function compressImage($filePath, $destinationPath, $quality = 70) {
//     list($width, $height, $type) = @getimagesize($filePath);

//     switch ($type) {
//         case IMAGETYPE_JPEG:
//             $image = imagecreatefromjpeg($filePath);
//             imagejpeg($image, $destinationPath, $quality);
//             break;
//         case IMAGETYPE_PNG:
//             $image = imagecreatefrompng($filePath);
//             imagepng($image, $destinationPath, round($quality / 10));
//             break;
//         case IMAGETYPE_GIF:
//             $image = imagecreatefromgif($filePath);
//             imagegif($image, $destinationPath);
//             break;
//         default:
//             throw new \Exception('Unsupported image type');
//     }

//     imagedestroy($image);
// }


// $file = $r->file('foto');
// $fotoName = $file->hashName();


// $tempPath = $file->getPathName();


// $compressedImagePath = storage_path('app/public/foto_siswa_pulang/' . $fotoName);


// if (!file_exists(dirname($compressedImagePath))) {
//     mkdir(dirname($compressedImagePath), 0755, true);
// }


// compressImage($tempPath, $compressedImagePath);
$r->validate([
    'capturedImage' => 'required',
], [
    'capturedImage.required' => 'Tolong klik Ambil Foto!',
]);

$capturedImage = $r->input('capturedImage');

$imageData = explode(',', $capturedImage)[1];

$imageData = base64_decode($imageData);

$imageName = uniqid() . '.jpeg';

$relativePath = 'storage/foto_siswa_pulang/' . $imageName;

$destinationPath = public_path($relativePath);

if (!file_exists(dirname($destinationPath))) {
    mkdir(dirname($destinationPath), 0755, true);
}

file_put_contents($destinationPath, $imageData);


        $hadir = hadir::findOrFail($id_hadir);
        $hadir->waktu_pulang = now()->format('H:i:s');
        $hadir->foto_pulang = $imageName;
        $hadir->latitude_pulang = $r->latitude_pulang;
        $hadir->longitude_pulang = $r->longitude_pulang;
        $hadir->save();

        if($hadir->waktu_datang > $hadir->waktu_pulang){
             return redirect('/Siswa/JurnalPKL/Absen/' . $id)->with('berhasil', '😶 Lain kali jangan lupakan absen pulang')->with('pulang', true);
        }else{
        return redirect('/Siswa/JurnalPKL/Absen/' . $id)->with('berhasil', ' Berhasil absensi pulang industri pada pukul ' . now()->format('H:i:s'))->with('pulang', true);
        }

    }

    public function pdf($id){
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
        $title = 'Tentukan pdf absen siswa pulang';
        return view('hadir.tentukan', ['title' => $title, 'id' => $id]);
    }

    public function getpdf($id, request $r){
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
            $hadir = hadir::where(function($query) use ($awal, $akhir) {
                $query->whereBetween('tanggal', [$awal, $akhir]);
                })->where('jurnal', '=', $id)->get();
        }else{
           $hadir = hadir::where('jurnal', '=', $id)->get();
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

$pdf = new pdfController('P', 'mm', 'A4');
 $pdf->AddFont('tahoma','','tahoma.php');
        $pdf->AddFont('tahoma','B','TAHOMAB0.php');
$pdf->AddPage();
$pdf->SetLineWidth(0.65);
$pdf->Rect(4.1, 4.1, $pdf->GetPageWidth() - 8.2, $pdf->GetPageHeight() - 8.2);

$pdf->setFont('times', 'B', 16);
$pdf->Cell(0, 10, 'DAFTAR HADIR SISWA', 0, 1, 'C');

if ($r->tentukan == '1') {
    $pdf->Cell(0, 10, 'Dari tanggal ' . $tanggalAwal . ' sampai tanggal ' . $tanggalAkhir, 0, 1, 'C');
}

$pdf->Ln(8);
$pdf->SetLineWidth(0.25);
$pdf->Cell(40, 20, 'Tanggal', 1, 0, 'C');
$pdf->Cell(75, 10, 'Datang', 1, 0, 'C');
$pdf->Cell(75, 10, 'Pulang', 1, 1, 'C');
$pdf->SetX($pdf->getX() + 40);
$pdf->Cell(37.5, 10, 'Waktu', 1, 0, 'C');
$pdf->Cell(37.5, 10, 'Foto', 1, 0, 'C');
$pdf->Cell(37.5, 10, 'Waktu', 1, 0, 'C');
$pdf->Cell(37.5, 10, 'Foto', 1, 1, 'C');

$pdf->SetLineWidth(0.65);
$pdf->Rect(4.1, 4.1, $pdf->GetPageWidth() - 8.2, $pdf->GetPageHeight() - 8.2);

if ($hadir->isEmpty()) {
    $pdf->SetLineWidth(0.25);
    $pdf->Cell(190, 25, 'Daftar hadir siswa kosong', 1, 1, 'C');
} else {
    $no = 1;
    foreach ($hadir as $h) {
        $no++;
        if($no % 7 == 0){
            $pdf->AddPage();
        }
        $pdf->SetLineWidth(0.25);
        $pdf->setFont('times', '', 12);
        $tanggal_h = $h->tanggal;
        $tanggalh = Carbon::parse($tanggal_h);
        $tanggal_hadir = $tanggalh->isoFormat('D MMMM YYYY');
        $pdf->Cell(40, 31, $tanggal_hadir, 1, 0, 'C');

        if ($h->izin == 0) {
            $pdf->Cell(37.5, 31, $h->waktu_datang ?? '-', 1, 0, 'C');
            $pdf->Cell(37.5, 31, '', 1, 0, 'C');
            $pdf->Cell(37.5, 31, $h->waktu_pulang ?? '-', 1, 0, 'C');
            $pdf->Cell(37.5, 31, '', 1, 1, 'C');

            $originalFotoDatangPath = Storage::disk('public')->path('foto_siswa_datang/' . $h->foto_datang);
            $pdf->image($originalFotoDatangPath, $pdf->GetX() + 78.2, $pdf->GetY() - 30.5, 36.1, 30);

            if (!empty($h->foto_pulang)) {
                $originalFotoPulangPath = Storage::disk('public')->path('foto_siswa_pulang/' . $h->foto_pulang);
                $pdf->image($originalFotoPulangPath, $pdf->GetX() + 153.2, $pdf->GetY() - 30.5, 36.1, 30);
            }
        } else {
            $pdf->Cell(112.5, 31, 'Izin', 1, 0, 'C');
            $pdf->Cell(37.5, 31, '', 1, 1, 'C');
            $originalFotoDatangPath = Storage::disk('public')->path('foto_siswa_datang/' . $h->foto_datang);
            $pdf->image($originalFotoDatangPath, $pdf->GetX() + 153.2, $pdf->GetY() - 30.5, 36.1, 30);
        }
        $pdf->SetLineWidth(0.65);
        $pdf->Rect(4.1, 4.1, $pdf->GetPageWidth() - 8.2, $pdf->GetPageHeight() - 8.2);
    }

     $pdf->setX($pdf->getX() + 150);
       $pdf->setXY(120, 250);
       $pdf->Cell(50, 3, 'Pembimbing, ...................................', 0, 1, '');
       $pdf->setXY(120, $pdf->getY() + 20.997);
       $pdf->setFont('tahoma', 'B', 12);
       $pdf->Cell(0, 3, '..............................................', 0, 1, '');

}

$pdf->output('DaftarHadir ' . $surat->nama_siswa . '.pdf', 'D');
exit;
    }

    public function hapus($id){
        $hadir = hadir::findorfail($id);
        Storage::disk('public')->delete('foto_siswa_datang/' . $hadir->foto_datang);


        if($hadir->foto_pulang != null){
           Storage::disk('public')->delete('foto_siswa_pulang/' . $hadir->foto_pulang);

        }

        $hadir->delete();
        return redirect()->back()->with('berhasil', 'Salah satu data hadir siswa berhasil dihapus');
    }

    public function validasiAbsensi(Request $request)
{
    $validatedData = $request->validate([
        'id_hadir' => 'required',
        'validasi_datang' => 'required',
        'validasi_pulang' => 'required',
    ]);

    try {

        $absensi = hadir::findOrFail($validatedData['id_hadir']);

        $absensi->validasi_datang = $validatedData['validasi_datang'];
        $absensi->validasi_pulang = $validatedData['validasi_pulang'];

        $absensi->save();

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}

}
