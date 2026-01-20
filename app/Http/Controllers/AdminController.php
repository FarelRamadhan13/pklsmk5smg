<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\pkl;
use App\Models\jurusan;
use App\Models\siswa;
use App\Models\guruPendamping;
use App\Models\tb_prakerin;
use App\Models\kunjungan;
use Illuminate\Support\Facades\Storage;
use App\Models\pesan;
use App\Models\jurnalPKL;
use App\Models\suratPermohonan;
use App\Models\suratPendamping;

class AdminController extends Controller
{
    public function index(){
        $unreadMessagesCount = pesan::where('status','=','0')->count();
        $title = 'Admin';
        $pkl = pkl::count();
        $user = User::count();

        $jurusan = jurusan::count();
        $siswa = siswa::count();
        $pendamping = guruPendamping::count();
        $prakerin = tb_prakerin::count();
        $kunjungan = kunjungan::count();
        $jurnal = jurnalPKL::count();
        $pengajuan = suratPermohonan::count();
        $surat_pendamping = suratPendamping::count();
        return view('admin.index', ['title' => $title, 'surat_pendamping' => $surat_pendamping, 'pengajuan' => $pengajuan, 'jurnal' => $jurnal, 'user' => $user, 'pkl' => $pkl, 'jurusan' => $jurusan, 'siswa' => $siswa, 'unreadMessagesCount' => $unreadMessagesCount, 'pendamping' => $pendamping, 'prakerin' => $prakerin, 'kunjungan' => $kunjungan]);
    }
}
