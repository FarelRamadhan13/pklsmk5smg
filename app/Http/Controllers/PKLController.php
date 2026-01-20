<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pkl;
use App\Http\Controllers\pdf\pdfController;

class PKLController extends Controller
{
    public function index(){
        $title = 'Daftar PKL';
        $pkl = pkl::get();
        return view('pkl.index', ['title' => $title, 'pkl' => $pkl]);
    }

    public function tambah(){
        $title = 'Tambah pkl';
        return view('pkl.tambah', ['title' => $title]);
    }

    public function store(request $r){
        $r->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'quota' => 'required',
            'tahun' => 'required',
            'status' => 'required',
            'telp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:12',
            'nama_pimpinan' => 'required',
            'bidang_usaha' => 'required'
        ],
        [
            'nama.required' => "Nama pkl harus diisi",
            'alamat.required' => "alamat harus diisi",
            'quota.required' => 'quota harus diisi',
            'tahun.required' => 'tahun harus diisi',
            'status.required' => 'Tolong pilih salah satu status',
            'telp.required' => 'Tolong inputkan nomor telephone PKL/Industri',
            'telp.regex' => 'Nomor telephone tidak valid',
            'telp.min' => 'Nomor telephone minimal 10 digit angka',
            'nama_pimpinan.required' => 'Tolong inputkan nama pimpinan PKL/Industri',
            'bidang_usaha.required' => 'Tolong inputkan bidang usaha PKL/Industri',
            'telp.max' => 'Nomor telephone terlalu panjang, maksimal adalah 12 digit angka'
        ]);

        if(auth()->check()){
            $pelaku = auth()->user()->username;
        }else{
            $pelaku = auth()->guard('siswa')->user()->nisn;
        }
        pkl::insert([
            'nama_pkl' => $r->nama,
            'alamat_pkl' => $r->alamat,
            'quota_pkl' => $r->quota,
            'Status' => $r->status,
            'tahun' => $r->tahun,
            'telp' => $r->telp,
            'nama_pimpinan' => $r->nama_pimpinan,
            'bidang_usaha' => $r->bidang_usaha,
            'pelaku' => $pelaku
        ]);

        return redirect('/pkl')->with('berhasil', 'Data pkl berhasil di tambah');
    }

    public function hapus($id){
        $pkl = pkl::findorfail($id);
        if(auth()->guard('siswa')->check()){
            if($pkl->pelaku != auth()->guard('siswa')->user()->nisn){
                return redirect('/pkl');
            }
        }
       
        $pkl->delete();
        return redirect('/pkl')->with('berhasil', 'Data pkl berhasil di Hapus');
    }

    public function ubah($id){
        $pkl = pkl::findorfail($id);
        if(auth()->guard('siswa')->check()){
            if($pkl->pelaku != auth()->guard('siswa')->user()->nisn){
                return redirect('/pkl');
            }
        }
        $title = 'Ubah Data Users';
        return view('pkl.ubah', ['title' => $title, 'pkl' => $pkl]);
    }

    public function edit($id, request $r){
        $pkl = pkl::findorfail($id);
        $r->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'quota' => 'required',
            'tahun' => 'required',
            'status' => 'required',
            'telp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:12',
            'nama_pimpinan' => 'required',
            'bidang_usaha' => 'required'
        ],
        [
            'nama.required' => "Nama pkl harus diisi",
            'alamat.required' => "alamat harus diisi",
            'quota.required' => 'quota harus diisi',
            'tahun.required' => 'tahun harus diisi',
            'status.required' => 'Tolong pilih salah satu status',
            'telp.required' => 'Tolong inputkan nomor telephone PKL/Industri',
            'telp.regex' => 'Nomor telephone tidak valid',
            'telp.min' => 'Nomor telephone minimal 10 digit angka',
            'nama_pimpinan.required' => 'Tolong inputkan nama pimpinan PKL/Industri',
            'bidang_usaha.required' => 'Tolong inputkan bidang usaha PKL/Industri',
            'telp.max' => 'Nomor telephone terlalu panjang, maksimal adalah 12 digit angka'
        ]);
        if(auth()->check()){
            $pelaku = auth()->user()->username;
        }else{
            $pelaku = auth()->guard('siswa')->user()->nisn;
        }
        $pkl->nama_pkl = $r->nama;
        $pkl->alamat_pkl = $r->alamat;
        $pkl->quota_pkl = $r->quota;
        $pkl->tahun = $r->tahun;
        $pkl->Status = $r->status;
        $pkl->telp = $r->telp;
        $pkl->nama_pimpinan = $r->nama_pimpinan;
        $pkl->bidang_usaha = $r->bidang_usaha;
        $pkl->pelaku_edit = $pelaku;
        $pkl->save();
        
       
     

        return redirect('/pkl')->with('berhasil', 'Data pkl berhasil diubah');
    }

    public function print(){
        $title = 'Print data Industri';
        return view('pkl.tentukan', ['title' => $title]);
    }

    public function pdf(request $r){
        // dd($r->pilih);
        if($r->pilih == '2'){
            $pkl = pkl::where('Status','=','0')->get();
            $status = 'Non Valid';
        }
        elseif($r->pilih == '1'){
            $pkl = pkl::where('Status','=','1')->get();
            $status = 'Valid';
        }else{
            $pkl = pkl::get();
        }
        $pdf = new pdfController('L','mm','A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->MultiCell(0, 10, 'Daftar Industri', 0, 'C');
        $pdf->Ln(10);
        $pdf->Cell(40, 5, 'Laporan', 0, 1);
        if($r->pilih == '2' || $r->pilih == '1'){
            $pdf->Cell(30, 10, 'Berdasarkan', 0, 1);
        $pdf->Cell(90, 5, 'Status Industri ' . $status, 0, 0);
        
        $pdf->Ln(10);
    }else{
        $pdf->Cell(90, 10, 'Semua Industri', 0, 0);
        $pdf->Ln(10);
    }
    $pdf->Ln(10);
        
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(98, 10, 'Nama', 1, 0, 'C');
    $pdf->Cell(98, 10, 'Alamat', 1, 0, 'C');
    $pdf->Cell(80, 10, 'No Telephone', 1, 1, 'C');
    $no = 1;
    if($pkl->isEmpty()){
        $pdf->Cell(276, 10, 'Industri tidak di temukan', 1, 0, 'C');
    }else{
    foreach($pkl as $p){
        $no++;
        if($no % 8 == 0){
            $pdf->AddPage();
        }
        $pdf->SetFont('Arial', '', 12);
    
        // Save the current position
        $x = $pdf->GetX();
        $y = $pdf->GetY();
    
        // Nama
        $pdf->MultiCell(98, 10, $p->nama_pkl, 'URL', 'C');
        $cellHeightNama = $pdf->GetY() - $y;
    
        // Reset the position to the right of the last cell
        $pdf->SetXY($x + 98, $y);
    
        // Alamat
        $pdf->MultiCell(98, 10, $p->alamat_pkl, 'URL', '');
        $cellHeightAlamat = $pdf->GetY() - $y;
    
        // Reset the position to the right of the last cell
        $pdf->SetXY($x + 196, $y);
    
        // No Telephone
        $pdf->MultiCell(80, 10, $p->telp, 'URL', 'C');
        $cellHeightTelp = $pdf->GetY() - $y;
    
        // Find the maximum cell height
        $maxCellHeight = max($cellHeightNama, $cellHeightAlamat, $cellHeightTelp);
    
        // Draw boxes to adjust the height of the cells
        $pdf->SetXY($x, $y);
        $pdf->MultiCell(98, $maxCellHeight, '', 1);
        $pdf->SetXY($x + 98, $y);
        $pdf->MultiCell(98, $maxCellHeight, '', 1);
        $pdf->SetXY($x + 196, $y);
        $pdf->MultiCell(80, $maxCellHeight, '', 1);
    }
}
if($r->pilih == '2' || $r->pilih == '1'){
    $pdf->Output('Laporan Industri PKL berdasarkan ' . $status . '.pdf', 'I');
}else{
    $pdf->Output('Laporan semua Industri PKL.pdf', 'I');
}
    
    
        exit;
    }
}
