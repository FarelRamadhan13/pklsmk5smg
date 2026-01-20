<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kunjungan;
use App\Models\tb_prakerin;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\pdf\pdfController;
use Carbon\Carbon;

class kunjunganCOntroller extends Controller
{
    public function index(){
        $title = 'Kunjungan';
        $kunjungan = kunjungan::join('tb_prakerin', 'tbl_kunjungan.idprakerin','=','tb_prakerin.idprakerin')
        ->join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')
        ->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')->get();
        return view('kunjungan.index', ['title' => $title, 'kunjungan' => $kunjungan]);
    }

    public function tambah(){
        $title = 'Tambah Kunjungan';
        $prakerin = tb_prakerin::join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
        ->select('tb_prakerin.*', 'tb_pkl.nama_pkl','tb_pkl.alamat_pkl', 'siswa.nama_siswa','siswa.kelas','tbl_gurupendamping.nama')->get();
        return view('kunjungan.tambah', ['title' => $title, 'prakerin' => $prakerin]);
    } 

    public function lihatPrakerin($idprakerin){
        $prakerinn = tb_prakerin::join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
        ->select('tb_prakerin.*', 'tb_pkl.nama_pkl','tb_pkl.alamat_pkl', 'siswa.nama_siswa','siswa.kelas','tbl_gurupendamping.nama')->findorfail($idprakerin);

        return response()->json(['prakerinn' => $prakerinn]);
    }

    public function store(request $r){
        $r->validate([
            'idprakerin' => 'required',
            'id_pkl' => 'required',
            'nama_pkl' => 'required',
            'alamat_pkl' => 'required',
            'nisn' => 'required',
            'nama' => 'required',
            'kelas' => 'required',
            'nip' => 'required',
        ],
        [
            'idprakerin.required' => 'Tolong pilih salah satu Id Prakerin',
            'id_pkl.required' => 'Tolong pilih salah satu Id Prakerin terlebih dahulu',
            'nama_pkl.required' => 'Tolong pilih salah satu Id Prakerin terlebih dahulu',
            'alamat_pkl.required' => 'Tolong pilih salah satu Id Prakerin terlebih dahulu',
            'nisn.required' => 'Tolong pilih salah satu Id Prakerin terlebih dahulu',
            'nama.required' => 'Tolong pilih salah satu Id Prakerin terlebih dahulu',
            'kelas.required' => 'Tolong pilih salah satu Id Prakerin terlebih dahulu',
            'nip.required' => 'Tolong pilih salah satu Id Prakerin terlebih dahulu',
        ]);

        kunjungan::insert([
            'idprakerin' => $r->idprakerin,
        ]);

        return redirect('/Admin/Kunjungan')->with(['berhasil' => 'Data kunjungan berhasil di tambah']);
    }

    public function hapus($idkunjungan){
        $kunjungan = kunjungan::findorfail($idkunjungan);
        if (!is_null($kunjungan->upload_data)) {
            Storage::disk('public')->delete('fileKunjungan/' . $kunjungan->upload_data);
        }
        
        $kunjungan->delete();
       
        return redirect('/Admin/Kunjungan')->with(['berhasil' => 'Data kunjungan berhasil di hapus']);
    }

    public function edit($idkunjungan){
        $kunjungan = kunjungan::join('tb_prakerin', 'tbl_kunjungan.idprakerin', '=', 'tb_prakerin.idprakerin')->findorfail($idkunjungan);
        if(auth()->guard('pendamping')->check()){
            if($kunjungan->nip != auth()->guard('pendamping')->user()->nip){
            return redirect('/Pendamping/Kunjungan');
            }
        }
        $title = 'Ubah Data kunjungan';
        $prakerin = tb_prakerin::get();
        return view('kunjungan.ubah', ['title' => $title, 'prakerin' => $prakerin, 'kunjungan' => $kunjungan]);
    }

    public function ubah($idkunjungan, request $r){
        $kunjungan = kunjungan::findorfail($idkunjungan);
        $r->validate([
            'file' => 'mimes:pdf,docx|max:2048',
        ],
        [
            'file.mimes' => 'File harus berupa PDF atau Docx (Word)',
            'file.max' => 'Ukuran file maksimal adalah 2 MB'
        ]);

        if($r->hasFile('file')){
            if ($kunjungan->upload_data != null) {
                Storage::disk('public')->delete('fileKunjungan/' . $kunjungan->upload_data);
            }
            $file = $r->file('file');
            $filename = $file->hashName();
            $file->storeAs('fileKunjungan', $filename, 'public');
            $kunjungan->upload_data = $filename;
            $kunjungan->tanggal = now();
        }

        $kunjungan->idprakerin = $r->idprakerin;
        
        $kunjungan->save();
        if(auth()->user()){
            return redirect('/Admin/Kunjungan')->with(['berhasil' => 'Data kunjungan berhasil di Ubah']);
        }else{
            return redirect('/Pendamping/Kunjungan')->with(['berhasil' => 'Data kunjungan berhasil di Ubah']);
        }
    }

    public function lihatFile($file){
     $kunjungan = kunjungan::where('upload_data','=',$file)->join('tb_prakerin','tbl_kunjungan.idprakerin','=','tb_prakerin.idprakerin')
     ->join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->first();
     if(auth()->guard('pendamping')->check()){
        if($kunjungan->nip != auth()->guard('pendamping')->user()->nip){
        return redirect('/Pendamping/Kunjungan');
        }
    }
     $filePath = 'fileKunjungan/' . $file;

     if (Storage::exists($filePath)) {
        
        $downloadFile = 'FileKunjungan(' . $kunjungan->nama_pkl . ').' . pathinfo($file, PATHINFO_EXTENSION);

       
        return response()->download(Storage::disk('public')->path('fileKunjungan/' . $file), $downloadFile);
    } else {
       
        return response()->json(['error' => 'File not found'], 404);
    }
    }


    public function tentukanpdf(){
        $title = 'Tentukan Tanggal Kunjungan';
        return view('kunjungan.tentukan',['title' => $title]);
    }
    public function pdf(request $r){
        $r->validate([
            'awal' => 'required',
            'akhir' => 'required'
        ], [
            'awal.required' => 'Tanggal Awal harus diisi',
            'akhir.required' => 'Tanggal Akhir harus diisi'
        ]);
        
        $kunjungan = Kunjungan::join('tb_prakerin', 'tbl_kunjungan.idprakerin','=','tb_prakerin.idprakerin')
            ->join('tb_pkl', 'tb_prakerin.idpkl','=','tb_pkl.idpkl')
            ->join('siswa', 'tb_prakerin.nisn','=','siswa.nisn')
            ->join('tbl_gurupendamping', 'tb_prakerin.nip','=','tbl_gurupendamping.nip')
            ->whereBetween('tanggal', [$r->awal, $r->akhir])
            ->get();
        
        $pdf = new pdfController('L', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->MultiCell(0, 10, 'Daftar Kunjungan', 0, 'C');
        $pdf->Ln(10);
        $pdf->setFont('Arial','B',14);

        $awal = Carbon::parse($r->awal);
        $tanggal_awal = $awal->isoFormat('D MMMM YYYY');
        $pdf->Cell(40, 5, 'Laporan', 0, 1);
        $pdf->Cell(50, 10, 'Dari Tanggal', 0, 0);
        $pdf->Cell(10, 10, ':', 0, 0);
        $pdf->Cell(50, 10, $tanggal_awal, 0, 1);

        $akhir = Carbon::parse($r->akhir);
        $tanggal_akhir = $akhir->isoFormat('D MMMM YYYY');
        $pdf->Cell(50, 10, 'Sampai Tanggal', 0, 0);
        $pdf->Cell(10, 10, ':', 0, 0);
        $pdf->Cell(50, 10, $tanggal_akhir, 0, 1);

        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 10);
        
        $pdf->Cell(15, 10, 'Id', 1, 0, 'C');
        $pdf->Cell(20, 10, 'Id Prakerin', 1, 0, 'C');
        $pdf->Cell(20, 10, 'ID PKL', 1, 0, 'C');
        $pdf->Cell(45, 10, 'Nama PKL', 1, 0, 'C');
        $pdf->Cell(55, 10, 'Alamat PKL', 1, 0, 'C');
        $pdf->Cell(35, 10, 'NIP', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Nama Guru', 1, 0, 'C');
        $pdf->Cell(25, 10, 'Tanggal', 1, 0, 'C');
        $pdf->Cell(15, 10, 'Tahun', 1, 1, 'C');
        
        if($kunjungan->isEmpty()){
            $pdf->Cell(280, 30, 'Data kunjungan sekitar tanggal ' . $tanggal_awal . ' sampai ' . $tanggal_akhir . ' tidak tersedia', 1, 1, 'C');
        }else{
        foreach($kunjungan as $k) {
            $pdf->SetFont('Arial', '', 8);
            $pdf->Cell(15, 10, $k->idkunjungan, 1, 0, 'C');
            $pdf->Cell(20, 10, $k->idprakerin, 1, 0, 'C');
            $pdf->Cell(20, 10, $k->idpkl, 1, 0, 'C');
            $pdf->Cell(45, 10, $k->nama_pkl, 1, 0, 'C');
            $pdf->Cell(55, 10, $k->alamat_pkl, 1, 0, 'C');
            $pdf->Cell(35, 10, $k->nip, 1, 0, 'C');
            $pdf->Cell(50, 10, $k->nama, 1, 0, 'C');
            $tanggall = Carbon::parse($k->tanggall);
        $tanggal = $tanggall->isoFormat('D MMMM YYYY');
            $pdf->Cell(25, 10, $tanggal, 1, 0, 'C');
            $pdf->Cell(15, 10, $k->tahun, 1, 1, 'C');
        }
    }
        
        $pdf->Output();
        exit;
    }
}        
