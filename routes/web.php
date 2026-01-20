<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PKLController;
use App\Http\Controllers\depanController;
use App\Http\Controllers\jurusanController;
use App\Http\Controllers\prakerinCOntroller;
use App\Http\Controllers\kepsekCOntroller;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\SiswaLoginController;
use App\Http\Controllers\guru_pendampingController;
use App\Http\Controllers\guruPendampingLoginCOntroller;
use App\Http\Controllers\tbPrakerinController;
use App\Http\Controllers\kunjunganCOntroller;
use App\Http\Controllers\suratIzinPenarikanController;
use App\Http\Controllers\JurnalPKLController;
use App\Http\Controllers\hadirSiswaController;
use App\Http\Controllers\kegiatanHarianController;
use App\Http\Controllers\PesanCOntroller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [depanController::class, 'index']);

// Route::get('/model', [depanController::class, 'coba']);


Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'login']);
    Route::post('/login', [LoginController::class, 'logins']);
});

// Route::get('/loginSiswa', [LoginSiswaController::class, 'login']);
// Route::post('/loginSiswa', [LoginSiswaController::class, 'logins']);



Route::middleware('admin')->group(function () {
    Route::get('/Admin', [AdminController::Class, 'index']);
    Route::get('/Admin/Users', [UserController::Class, 'index']);
    Route::get('/Admin/Users/Tambah', [UserController::Class, 'tambah']);
    Route::post('/Admin/Users/Tambah', [UserController::Class, 'store']);
    Route::delete('/Admin/Users/hapus/{id}', [UserController::Class, 'hapus'])->name('users.destroy');
    Route::get('/Admin/Users/edit/{id}', [UserController::Class, 'ubah']);
    Route::post('/Admin/Users/edit/{id}', [UserController::Class, 'edit']);

    Route::get('/Admin/gantiFoto', [prakerinCOntroller::class, 'editFoto']);
    Route::post('/Admin/gantiFoto', [prakerinCOntroller::class, 'ubahFoto']);
});
Route::middleware('adminPrakerin')->group(function () {
    Route::get('/Admin/Pesan', [PesanCOntroller::class, 'index']);

    Route::get('/Admin/jurusan', [jurusanController::Class, 'index']);
    Route::get('/Admin/Jurusan/Tambah', [jurusanController::Class, 'tambah']);
    Route::post('/Admin/Jurusan/Tambah', [jurusanController::Class, 'store']);
    Route::delete('/Admin/jurusan/hapus/{id}', [jurusanController::Class, 'hapus'])->name('jurusan.destroy');
    Route::get('/Admin/jurusan/edit/{id}', [jurusanController::Class, 'ubah']);
    Route::post('/Admin/jurusan/edit/{id}', [jurusanController::Class, 'edit']);

    Route::get('/Admin/Siswa', [siswaController::Class, 'index']);
    Route::get('/Admin/Siswa/pdf', [siswaController::Class, 'print']);
    Route::post('/Admin/Siswa/pdf', [siswaController::Class, 'pdf']);

    Route::get('/Admin/siswa/Tambah', [siswaController::Class, 'tambah']);
    Route::post('/Admin/siswa/Tambah', [siswaController::Class, 'store']);
    Route::delete('/Admin/siswa/hapus/{nisn}', [siswaController::Class, 'hapus'])->name('siswa.destroy');
    Route::get('/Admin/siswa/edit/{id}', [siswaController::Class, 'ubah']);
    Route::post('/Admin/siswa/edit/{id}', [siswaController::Class, 'edit']);

    Route::get('/Admin/guru_pendamping', [guru_pendampingController::Class, 'index']);
    Route::get('/Admin/guru_pendamping/Tambah', [guru_pendampingController::Class, 'tambah']);
    Route::post('/Admin/guru_pendamping/Tambah', [guru_pendampingController::Class, 'store']);
    Route::delete('/Admin/guru_pendamping/hapus/{nip}', [guru_pendampingController::Class, 'hapus'])->name('guru_pendamping.destroy');
    Route::get('/Admin/guru_pendamping/edit/{id}', [guru_pendampingController::Class, 'ubah']);
    Route::post('/Admin/guru_pendamping/edit/{id}', [guru_pendampingController::Class, 'edit']);

    Route::get('/Admin/Prakerin', [tbPrakerinController::Class, 'index']);
    Route::post('/Admin/Prakerin/pdf', [tbPrakerinController::Class, 'pdf']);
    Route::get('/Admin/Prakerin/pdf', [tbPrakerinController::Class, 'Tentukanpdf']);
    Route::get('/Admin/Prakerin/Tambah', [tbPrakerinController::Class, 'tambah']);
    Route::post('/Admin/Prakerin/Tambah', [tbPrakerinController::Class, 'store']);
    Route::get('/Admin/Prakerin/Ubah/{idprakerin}', [tbPrakerinController::Class, 'edit']);
    Route::post('/Admin/Prakerin/Ubah/{idprakerin}', [tbPrakerinController::Class, 'ubah']);
    Route::delete('/Admin/Prakerin/hapus/{idprakerin}', [tbPrakerinController::Class, 'hapus'])->name('prakerin.destroy');

    Route::get('/Admin/Kunjungan', [kunjunganCOntroller::class, 'index']);
    Route::get('/Admin/Kunjungan/Tambah', [kunjunganCOntroller::class, 'tambah']);
    Route::post('/Admin/Kunjungan/Tambah', [kunjunganCOntroller::class, 'store']);
    Route::delete('/Admin/Kunjungan/hapus/{idkunjungan}', [kunjunganCOntroller::class, 'hapus'])->name('kunjungan.destroy');
    Route::get('/Admin/Kunjungan/edit/{idkunjungan}', [kunjunganCOntroller::class, 'edit']);
    Route::post('/Admin/Kunjungan/edit/{idkunjungan}', [kunjunganCOntroller::class, 'ubah']);

    Route::post('/Admin/Kunjungan/pdf', [kunjunganCOntroller::Class, 'pdf']);
    Route::get('/Admin/Kunjungan/pdf', [kunjunganCOntroller::Class, 'Tentukanpdf']);

    Route::get('/Admin/Kunjungan/file/{file}', [kunjunganCOntroller::class, 'lihatFile']);

    Route::get('/Admin/Kunjungan/Tambah/GetPrakerin/{idprakerin}', [kunjunganCOntroller::class, 'lihatPrakerin']);

    Route::get('/Admin/Prakerin/Tambah/Getpkl/{idpkl}', [tbPrakerinController::Class, 'lihatPKL']);
    Route::get('/Admin/Prakerin/Tambah/GetSiswa/{nisn}', [tbPrakerinController::Class, 'lihatSiswa']);
    Route::get('/Admin/Prakerin/Tambah/GetGuru/{nip}', [tbPrakerinController::Class, 'lihatGuru']);

    Route::delete('/Siswa/Pengajuan/hapus/{id}', [SiswaLoginController::class, 'Hapuspengajuan'])->name('pengajuan.destroy');
    Route::get('/Siswa/Pengajuan/ubah/{id}', [SiswaLoginController::class, 'editSurat']);
    Route::post('/Siswa/Pengajuan/ubah/{id}', [SiswaLoginController::class, 'ubahSurat']);
    Route::get('/Siswa/Admin/Pengantar/{id}', [SiswaLoginController::class, 'tambahPengantar']);

    Route::delete('/Siswa/foto/hapus/{nisn}', [SiswaLoginController::class, 'hapusFoto']);


    Route::get('/Admin/suratIzin/Tambah', [suratIzinPenarikanController::class, 'tambah']);
    Route::delete('/Admin/suratIzin/hapus/{id_izin}', [suratIzinPenarikanController::class, 'hapus'])->name('izin.destroy');
    Route::get('/Admin/suratIzin/edit/{id_izin}', [suratIzinPenarikanController::class, 'ubah']);
    Route::post('/Admin/suratIzin/edit/{id_izin}', [suratIzinPenarikanController::class, 'edit']);
    Route::post('/Admin/suratIzin/Tambah', [suratIzinPenarikanController::class, 'store']);

    Route::get('/Admin/suratPenarikan/dapatkanpkl/{idprakerin}', [suratIzinPenarikanController::class, 'dapatkanPKL']);

    Route::get('/Admin/suratPenarikan/Tambah', [suratIzinPenarikanController::class, 'tambahPenarikan']);
    Route::delete('/Admin/suratPenarikan/hapus/{id}', [suratIzinPenarikanController::class, 'hapusPenarikan'])->name('penarikan.destroy');
    Route::get('/Admin/suratPenarikan/edit/{id}', [suratIzinPenarikanController::class, 'ubahPenarikan']);
    Route::post('/Admin/suratPenarikan/edit/{id}', [suratIzinPenarikanController::class, 'editPenarikan']);
    Route::post('/Admin/suratPenarikan/Tambah', [suratIzinPenarikanController::class, 'storePenarikan']);

    Route::get('/Admin/JurnalPKL/Tambah', [JurnalPKLController::class, 'tambahh']);
    Route::delete('/Admin/JurnalPKL/hapus/{id}', [JurnalPKLController::class, 'hapus'])->name('jurnal.destroy');
    Route::post('/Admin/JurnalPKL/Tambah', [JurnalPKLController::class, 'store']);
    Route::get('/Admin/JurnalPKL/ubah/{id}', [JurnalPKLController::class, 'ubah']);
    Route::post('/Admin/JurnalPKL/ubah/{id}', [JurnalPKLController::class, 'edit']);
    Route::get('/Admin/JurnalPKL/status', [JurnalPKLController::class, 'status']);

    Route::delete('/Siswa/JurnalPKL/Absen/hapus/{id}', [hadirSiswaController::class, 'hapus'])->name('hadir.destroy');
    Route::get('/Siswa/JurnalPKL/status', [tbPrakerinController::class, 'status']);

    Route::get('/pkl', [PKLController::Class, 'index']);
    Route::get('/pkl/pdf', [PKLController::Class, 'print']);
    Route::post('/pkl/pdf', [PKLController::Class, 'pdf']);
    Route::get('/pkl/Tambah', [PKLController::Class, 'tambah']);
    Route::post('/pkl/Tambah', [PKLController::Class, 'store']);
    Route::delete('/pkl/hapus/{id}', [PKLController::Class, 'hapus'])->name('pkl.destroy');
    Route::get('/pkl/edit/{id}', [PKLController::Class, 'ubah']);
    Route::post('/pkl/edit/{id}', [PKLController::Class, 'edit']);

    Route::get('/Admin/JurnalPKL/prakerin/{idprakerin}', [JurnalPKLController::class, 'dapatkanPrakerin']);
});

Route::middleware('prakerin')->group(function () {
    Route::get('/prakerin', [prakerinCOntroller::class,  'index']);
    Route::get('/prakerin/gantiPassword', [prakerinCOntroller::class,  'gantiPassowrd']);
    Route::post('/prakerin/gantiPassword', [prakerinCOntroller::class,  'pass']);

    Route::get('/prakerin/gantiFoto', [prakerinCOntroller::class, 'editFoto']);
    Route::post('/prakerin/gantiFoto', [prakerinCOntroller::class, 'ubahFoto']);
});

Route::middleware('siswa')->group(function () {
    Route::get('/Siswa', [SiswaLoginController::class, 'index']);
    Route::get('/Siswa/gantiFoto', [SiswaLoginController::class, 'editFoto']);
    Route::post('/Siswa/gantiFoto', [SiswaLoginController::class, 'ubahFoto']);
    Route::get('/Siswa/gantiPassword', [SiswaLoginController::class, 'editPass']);
    Route::post('/Siswa/gantiPassword', [SiswaLoginController::class, 'ubahPass']);

    Route::get('/Siswa/Prakerin', [SiswaLoginController::class, 'prakerin']);
    Route::get('/Siswa/ubah', [SiswaLoginController::class, 'ubah']);
    Route::post('/Siswa/ubah', [SiswaLoginController::class, 'edit']);

    Route::get('/Siswa/JurnalPKL/ubahInstruktur/{id}', [JurnalPKLController::class, 'editInstruktur']);
    Route::post('/Siswa/JurnalPKL/ubahInstruktur/{id}', [JurnalPKLController::class, 'ubahInstruktur']);
    

    Route::post('/Siswa/JurnalPKL/Absensi/{id}', [hadirSiswaController::class, 'datangs']);
    Route::get('/Siswa/JurnalPKL/Absensi/{id}', [hadirSiswaController::class, 'datang']);

    Route::get('/Siswa/JurnalPKL/Absensi/{id}/pulang/{id_hadir}', [hadirSiswaController::class, 'pulang']);
    Route::post('/Siswa/JurnalPKL/Absensi/{id}/pulang/{id_hadir}', [hadirSiswaController::class, 'pulangs']);

   
});

Route::middleware('pendamping')->group(function () {
    Route::get('/Pendamping', [guruPendampingLoginCOntroller::class, 'index']);
    Route::get('/Pendamping/Prakerin', [guruPendampingLoginCOntroller::class, 'prakerin']);
    Route::get('/Pendamping/gantiFoto', [guruPendampingLoginCOntroller::class, 'editFoto']);
    Route::post('/Pendamping/gantiFoto', [guruPendampingLoginCOntroller::class, 'ubahFoto']);
    
    Route::get('/Pendamping/gantiPassword', [guruPendampingLoginCOntroller::class, 'editPass']);
    Route::post('/Pendamping/gantiPassword', [guruPendampingLoginCOntroller::class, 'ubahPass']);

    Route::get('/Pendamping/Prakerin/Tambah/Getpkl/{idpkl}', [guruPendampingLoginCOntroller::Class, 'lihatPKL']);
    Route::get('/Pendamping/Prakerin/Tambah/GetSiswa/{nisn}', [guruPendampingLoginCOntroller::Class, 'lihatSiswa']);
    Route::get('/Pendamping/Prakerin/Tambah/GetGuru/{nip}', [guruPendampingLoginCOntroller::Class, 'lihatGuru']);

    Route::get('/Pendamping/Kunjungan', [guruPendampingLoginCOntroller::class, 'kunjungan']);
    Route::get('/Pendamping/Kunjungan/file/{file}', [kunjunganCOntroller::class, 'lihatFile']);
    Route::get('/Pendamping/Kunjungan/edit/{idkunjungan}', [kunjunganCOntroller::class, 'edit']);
    Route::post('/Pendamping/Kunjungan/edit/{idkunjungan}', [kunjunganCOntroller::class, 'ubah']);

    Route::get('/Pendamping/ubah', [guruPendampingLoginCOntroller::class, 'ubah']);

    Route::post('/Pendamping/ubah', [guruPendampingLoginCOntroller::class, 'edit']);

    Route::get('/Pendamping/Kunjungan/Tambah/GetPrakerin/{idprakerin}', [kunjunganCOntroller::class, 'lihatPrakerin']);

    Route::post('/validasi-absensi', [hadirSiswaController::class, 'validasiAbsensi']);
});

Route::middleware('kepsek')->group(function () {
    Route::get('/kepsek', [kepsekCOntroller::class,  'index']);
    Route::get('/kepsek/gantiPassword', [prakerinCOntroller::class,  'gantiPassowrd']);
    Route::post('/kepsek/gantiPassword', [prakerinCOntroller::class,  'pass']);
    Route::get('/kepsek/Prakerin', [tbPrakerinController::Class, 'index']);
    Route::post('/kepsek/Prakerin/pdf', [tbPrakerinController::Class, 'pdf']);
    Route::get('/kepsek/Prakerin/pdf', [tbPrakerinController::Class, 'Tentukanpdf']);


    Route::get('/kepsek/gantiFoto', [prakerinCOntroller::class, 'editFoto']);
    Route::post('/kepsek/gantiFoto', [prakerinCOntroller::class, 'ubahFoto']);
});

Route::middleware('adminPendamping')->group(function () {
    Route::get('/Pendamping/Pengajuan', [guruPendampingLoginCOntroller::class, 'Daftarpengajuan']);
    Route::delete('/Pendamping/Pengajuan/hapus/{id}', [guruPendampingLoginCOntroller::class, 'Hapuspengajuan'])->name('tugas.destroy');
    Route::get('/Pendamping/Pengajuan/ubah/{id}', [guruPendampingLoginCOntroller::class, 'Ubahpengajuan']);
    Route::post('/Pendamping/Pengajuan/ubah/{id}', [guruPendampingLoginCOntroller::class, 'Editpengajuan']);
    Route::get('/Pendamping/Pengajuan/file/{id}', [guruPendampingLoginCOntroller::class, 'pengajuanPDF']);
    Route::get('/Pendamping/Pengajuan/tambah', [guruPendampingLoginCOntroller::class, 'pengajuan']);
    Route::post('/Pendamping/Pengajuan/tambah', [guruPendampingLoginCOntroller::class, 'pengajuanTambah']);
});

Route::middleware('pengajuan')->group(function () {
    Route::get('get-quota/{idpkl}', [SiswaLoginController::class, 'getQuota']);
    Route::get('/Siswa/Pengajuan', [SiswaLoginController::class, 'pengajuan']);
    Route::get('/Siswa/Pengajuan/file/{id}', [SiswaLoginController::class, 'pdf']);

    Route::get('/Siswa/Pengantar/{id}', [SiswaLoginController::class, 'pdfPengantar']);
    Route::get('/Siswa/JurnalPKL', [JurnalPKLController::class, 'index']);
    Route::post('/Siswa/JurnalPKL', [JurnalPKLController::class, 'tambah']);
    Route::get('/Siswa/JurnalPKL/lihat/{id}', [JurnalPKLController::class, 'lihat']);
});

Route::middleware('pengajuantambah')->group(function () {
    Route::get('/Siswa/Pengajuan/tambah', [SiswaLoginController::class, 'pengajuantambah']);
    Route::post('/Siswa/Pengajuan/tambah', [SiswaLoginController::class, 'pdfSiswatambah']);
});

Route::middleware('suratizinpenarikan')->group(function () {
    Route::get('/Siswa/suratIzin', [suratIzinPenarikanController::class, 'index']);
    Route::get('/suratIzin/lihat/{id_izin}', [suratIzinPenarikanController::class, 'lihatIzin']);

    Route::get('/Siswa/suratPenarikan', [suratIzinPenarikanController::class, 'indexPenarikan']);
    Route::get('/suratPenarikan/lihat/{id_izin}', [suratIzinPenarikanController::class, 'lihatPenarikan']);
});

Route::middleware('jurnal')->group(function(){
    Route::get('/Siswa/JurnalPKL/Absen/{id}', [hadirSiswaController::class, 'index']);
    Route::get('/Siswa/JurnalPKL/Absen/pdf/{id}', [hadirSiswaController::class, 'pdf']);
    Route::post('/Siswa/JurnalPKL/Absen/pdf/{id}', [hadirSiswaController::class, 'getpdf']);
    
    Route::get('/Siswa/JurnalPKL/harian/{id}', [kegiatanHarianController::class, 'index']);
    Route::get('/Siswa/JurnalPKL/harian/pdf/{id}', [kegiatanHarianController::class, 'pdf']);
    Route::post('/Siswa/JurnalPKL/harian/pdf/{id}', [kegiatanHarianController::class, 'getpdf']);
    Route::get('/Siswa/JurnalPKL/harian/tambah/{id}', [kegiatanHarianController::class, 'tambah']);
    Route::post('/Siswa/JurnalPKL/harian/tambah/{id}', [kegiatanHarianController::class, 'store']);

    Route::delete('/Siswa/JurnalPKL/harian/{id}/hapus/{id_kegiatan}', [kegiatanHarianController::class, 'hapus'])->name('harian.destroy');
    Route::get('/Siswa/JurnalPKL/harian/{id}/ubah/{id_kegiatan}', [kegiatanHarianController::class, 'ubah']);
    Route::post('/Siswa/JurnalPKL/harian/{id}/ubah/{id_kegiatan}', [kegiatanHarianController::class, 'edit']);
});

Route::post('/kirimPesan', [PesanCOntroller::class, 'kirim']);

Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/simulate-419', function () {
    abort(419);
});
Route::get('/test-505', function () {
    abort(505);
});
Route::get('/kirimPesan', function () {
    abort(404);
});
Route::get('/test-500', function() {
    abort(500);
});

// Route::get('/chat', [ChatbotController::class, 'index']);
// Route::post('/chat', [ChatbotController::class, 'getResponse']);
