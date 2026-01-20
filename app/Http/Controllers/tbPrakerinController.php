<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tb_prakerin;
use App\Models\pkl;
use App\Models\siswa;
use App\Models\guruPendamping;
use Carbon\Carbon;
use App\Models\jurnalPKL;
use App\Http\Controllers\pdf\pdfController;
use App\Models\jurusan;

class tbPrakerinController extends Controller
{
    public function index(){
        $title = 'Daftar Prakerin';
        $prakerin = tb_prakerin::join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
        ->select('tb_prakerin.*', 'tb_pkl.nama_pkl','tb_pkl.alamat_pkl', 'siswa.nama_siswa','siswa.kelas','tbl_gurupendamping.nama')->get();
        return view('tb_prakerin.index', ['title' => $title, 'prakerin' => $prakerin]);
    }

    public function tambah(){
        $title = 'Tambah Prakerin';
        
        // $pkl = pkl::where('status', '=', '1')
        // ->whereRaw('quota_pkl - (SELECT COUNT(*) FROM tb_prakerin WHERE tb_prakerin.idpkl = tb_pkl.idpkl) > 0')
        // ->get();
        // $siswa = siswa::whereRaw('(SELECT COUNT(*) FROM tb_prakerin WHERE tb_prakerin.nisn = siswa.nisn) != 1')->get();
        $pkl = pkl::where('status', '=', '1')
        ->get();
        $siswa = siswa::get();
        $guru = guruPendamping::get();
        return view('tb_prakerin.tambah', ['title' => $title, 'pkl' => $pkl, 'siswa' => $siswa, 'guru' => $guru]);
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

    public function store(request $r){
        $r->validate([
            'id_pkl' => 'required',
            'namapkl' => 'required',
            'alamatpkl' => 'required',
            'nisn' => 'required',
            'namasiswa' => 'required',
            'kelas' => 'required',
            'nip' => 'required',
            'namaguru' => 'required',
            'start' => 'required',
            'end' => 'required',
        ],
        [
            'id_pkl.required' => 'Tolong pilih Id PKL',
            'namapkl.required' => 'Tolong pilih id PKL terlebih dahulu',
            'alamatpkl.required' => 'Tolong pilih id PKL terlebih dahulu',

            'nisn.required' => 'Tolong pilih NIS',
            'namasiswa.required' => 'Tolong pilih NIS terlebih dahulu',
            'kelas.required' => 'Tolong pilih NIS terlebih dahulu',

            'nip.required' => 'Tolong pilih NIP',
            'namaguru.required' => 'Tolong pilin NIP terlebih dahulu',

            'start.required' => 'Waktu mulai harus diisi',
            'end.required' => 'Waktu Selesai harus diisi',

        ]);
        $pklKuota = pkl::find($r->id_pkl);
        $prakerinCountForPkl = tb_prakerin::where('idpkl', $r->id_pkl)->count();
    
        // if ($pklKuota->quota_pkl - $prakerinCountForPkl <= 0) {
        //     return redirect()->back()->with('error', 'Kuota PKL sudah terpenuhi.')->withInput();
        // }
    
       
        $siswaCount = tb_prakerin::where('nisn', $r->nisn)->count();
    
        // if ($siswaCount > 0) {
        //     return redirect()->back()->with('error', 'Siswa sudah terdaftar pada prakerin lain.')->withInput();
        // }

        tb_prakerin::insert([
            'idpkl' => $r->id_pkl,
            'nisn' => $r->nisn,
            'nip' => $r->nip,
            'start' => $r->start,
            'end' => $r->end,
            'tahun' => $r->tahun,
            'username' => auth()->user()->username,
        ]);

        return redirect('/Admin/Prakerin')->with('berhasil', 'Data Prakerin berhasil di tambah');
    }

    public function edit($idprakerin){
        $title = 'Ubah Prakerin';
        $prakerin = tb_prakerin::findOrFail($idprakerin);
    
        $pkl = pkl::where('status', '=', '1')
          
            ->get();
    
        $siswa = siswa::get();
    
        $guru = guruPendamping::get();
    
        return view('tb_prakerin.ubah', ['title' => $title, 'prakerin' => $prakerin, 'pkl' => $pkl, 'siswa' => $siswa, 'guru' => $guru]);
    }

    public function ubah($idprakerin, request $r){
        $prakerin = tb_prakerin::findorfail($idprakerin);
        $pklKuota = Pkl::find($r->id_pkl);
        $prakerinCountForPkl = tb_prakerin::where('idpkl', $r->id_pkl)->where('idprakerin', '!=', $idprakerin)->count();
    
     
    
        // $siswaCount = tb_prakerin::where('nisn', $r->nisn)->where('idprakerin', '!=', $idprakerin)->count();
    
        // if ($siswaCount > 0) {
        //     return redirect()->back()->with('error', 'Siswa sudah terdaftar pada prakerin lain.');
        // }
    
        $r->validate([
            'id_pkl' => 'required',
            'namapkl' => 'required',
            'alamatpkl' => 'required',
            'nisn' => 'required',
            'namasiswa' => 'required',
            'kelas' => 'required',
            'nip' => 'required',
            'namaguru' => 'required',
            'start' => 'required',
            'end' => 'required',
        ],
        [
            'id_pkl.required' => 'Tolong pilih Id PKL',
            'namapkl.required' => 'Tolong pilih id PKL terlebih dahulu',
            'alamatpkl.required' => 'Tolong pilih id PKL terlebih dahulu',

            'nisn.required' => 'Tolong pilih NIS',
            'namasiswa.required' => 'Tolong pilih NIS terlebih dahulu',
            'kelas.required' => 'Tolong pilih NIS terlebih dahulu',

            'nip.required' => 'Tolong pilih NIP',
            'namaguru.required' => 'Tolong pilin NIP terlebih dahulu',

            'start.required' => 'Waktu mulai harus diisi',
            'end.required' => 'Waktu Selesai harus diisi',

        ]);
        $prakerin->idpkl = $r->id_pkl;
        $prakerin->nisn = $r->nisn;
        $prakerin->nip = $r->nip;
        $prakerin->start = $r->start;
        $prakerin->end = $r->end;
      
        $prakerin->tahun = $r->tahun;
        $prakerin->username = auth()->user()->username;
        $prakerin->save();

        return redirect('/Admin/Prakerin')->with('berhasil', 'Data Prakerin berhasil di Ubah');
    }

    public function hapus($idprakerin){
        $prakerin = tb_prakerin::findorfail($idprakerin);
        $prakerin->delete();
        return redirect('/Admin/Prakerin')->with('berhasil', 'Data Prakerin berhasil di Hapus');

    }

    public function tentukanpdf(){
        $title = 'Tentukan data cetak Prakerin';
        $jurusan = jurusan::get();
        return view('tb_prakerin.tentukan',['title' => $title, 'jurusan' => $jurusan]);
    }
    public function pdf(request $r){
       
       $prakerin = json_decode($r->input('printData'), true);
       
  
$pdf = new pdfController('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->MultiCell(0, 10, 'Daftar Prakerin', 0, 'C');
$pdf->Ln(10);

$pdf->Cell(50, 10, 'Laporan Prakerin', 0, 1);

$pdf->Ln(20);

$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(8, 10, 'No', 1, 0, 'C');
$pdf->Cell(20, 10, 'NIS', 1, 0, 'C');
$pdf->Cell(45, 10, 'Nama Siswa', 1, 0, 'C');  // Adjusted width of Nama Siswa column
$pdf->Cell(15, 10, 'Kelas', 1, 0, 'C');
$pdf->Cell(55, 10, 'Nama DUDI', 1, 0, 'C');
$pdf->Cell(35, 10, 'NIP', 1, 0, 'C');  // Adjusted width of NIP column
$pdf->Cell(40, 10, 'Nama Pembimbing', 1, 0, 'C');
$pdf->Cell(30, 10, 'Start', 1, 0, 'C');
$pdf->Cell(30, 10, 'End', 1, 1, 'C');

$no = 1;

if (empty($prakerin)) {
    $pdf->Cell(273, 10, 'Prakerin tidak di temukan', 1, 0, 'C');  // Adjusted total width
} else {
    foreach ($prakerin as $p) {
        $no++;
        if ($no % 4 == 0) {
            $pdf->AddPage();
            
        }
        $pdf->SetFont('Arial', '', 8);

        // Save the current position
        $x = $pdf->GetX();
        $y = $pdf->GetY();

        // No
        $pdf->MultiCell(8, 10, $p[0], 'URL', 'C');
        $cellHeightNo = $pdf->GetY() - $y;

        // Reset the position to the right of the last cell
        $pdf->SetXY($x + 8, $y);

        // NIS
        $pdf->MultiCell(20, 10, $p[4], 'URL', 'C');
        $cellHeightNISN = $pdf->GetY() - $y;

        // Reset the position to the right of the last cell
        $pdf->SetXY($x + 28, $y);

        // Nama Siswa
        $pdf->MultiCell(45, 10, $p[5], 'URL', 'C');  // Adjusted width of Nama Siswa column
        $cellHeightNama = $pdf->GetY() - $y;

        // Reset the position to the right of the last cell
        $pdf->SetXY($x + 73, $y);

        // Kelas
        $pdf->MultiCell(15, 10, $p[6], 'URL', 'C');
        $cellHeightKelas = $pdf->GetY() - $y;

        // Reset the position to the right of the last cell
        $pdf->SetXY($x + 88, $y);

        // Nama DUDI
        $pdf->MultiCell(55, 10, $p[2], 'URL', 'C');
        $cellHeightDUDI = $pdf->GetY() - $y;

        // Reset the position to the right of the last cell
        $pdf->SetXY($x + 143, $y);

        // NIP
        $pdf->MultiCell(35, 10, $p[7], 'URL', 'C');  // Adjusted width of NIP column
        $cellHeightNIP = $pdf->GetY() - $y;

        // Reset the position to the right of the last cell
        $pdf->SetXY($x + 178, $y);

        // Nama Pembimbing
        $pdf->MultiCell(40, 10, $p[8], 'URL', 'C');
        $cellHeightPembimbing = $pdf->GetY() - $y;

        // Reset the position to the right of the last cell
        $pdf->SetXY($x + 218, $y);

        
        // Start
        $pdf->MultiCell(30, 10, $p[9], 'URL', 'C');
        $cellHeightStart = $pdf->GetY() - $y;

        // Reset the position to the right of the last cell
        $pdf->SetXY($x + 248, $y);


        // End
        $pdf->MultiCell(30, 10, $p[10], 'URL', 'C');
        $cellHeightEnd = $pdf->GetY() - $y;

        // Find the maximum cell height
        $maxCellHeight = max($cellHeightNo, $cellHeightNISN, $cellHeightNama, $cellHeightKelas, $cellHeightDUDI, $cellHeightNIP, $cellHeightPembimbing, $cellHeightStart, $cellHeightEnd);

        // Draw boxes to adjust the height of the cells
        $pdf->SetXY($x, $y);
        $pdf->MultiCell(8, $maxCellHeight, '', 1);
        $pdf->SetXY($x + 8, $y);
        $pdf->MultiCell(20, $maxCellHeight, '', 1);
        $pdf->SetXY($x + 28, $y);
        $pdf->MultiCell(45, $maxCellHeight, '', 1);  // Adjusted width of Nama Siswa column
        $pdf->SetXY($x + 73, $y);
        $pdf->MultiCell(15, $maxCellHeight, '', 1);
        $pdf->SetXY($x + 88, $y);
        $pdf->MultiCell(55, $maxCellHeight, '', 1);
        $pdf->SetXY($x + 143, $y);
        $pdf->MultiCell(35, $maxCellHeight, '', 1);  // Adjusted width of NIP column
        $pdf->SetXY($x + 178, $y);
        $pdf->MultiCell(40, $maxCellHeight, '', 1);
        $pdf->SetXY($x + 218, $y);
        $pdf->MultiCell(30, $maxCellHeight, '', 1);
        $pdf->SetXY($x + 248, $y);
        $pdf->MultiCell(30, $maxCellHeight, '', 1);
    }
}

    $pdf->output('Daftar Prakerin.pdf', 'I');


exit;


    }

   public function status()
{
    $title = 'Status';
    $cek_hari = Carbon::today()->format('Y-m-d');
    $jurusanList = jurusan::get();

    $data = [];

    foreach ($jurusanList as $jurusan) {
        // Perulangan untuk kelas X
        for ($i = 1; $i <= 3; $i++) {
            $kelas = "X " . $jurusan->nama_jurusan . " " . $i;
            $data[] = $this->getJurnalStatusData($kelas, $cek_hari);
        }

        // Perulangan untuk kelas XI
        for ($i = 1; $i <= 3; $i++) {
            $kelas = "XI " . $jurusan->nama_jurusan . " " . $i;
            $data[] = $this->getJurnalStatusData($kelas, $cek_hari);
        }

        // Perulangan untuk kelas XII
        for ($i = 1; $i <= 3; $i++) {
            $kelas = "XII " . $jurusan->nama_jurusan . " " . $i;
            $data[] = $this->getJurnalStatusData($kelas, $cek_hari);
        }
    }

    return view('tb_prakerin.status', ['title' => $title, 'data' => $data, 'jurusan' => $jurusanList]);
}

private function getJurnalStatusData($kelas, $cek_hari)
{
    $jumlahBelumMulai = tb_prakerin::join('siswa', 'tb_prakerin.nisn', '=', 'siswa.nisn')
        ->where('siswa.kelas', '=', $kelas)
        ->where('tb_prakerin.start', '>', $cek_hari)
        ->count();

    $jumlahBerlangsung = tb_prakerin::join('siswa', 'tb_prakerin.nisn', '=', 'siswa.nisn')
        ->where('siswa.kelas', '=', $kelas)
        ->where('tb_prakerin.start', '<', $cek_hari)
        ->where('tb_prakerin.end', '>', $cek_hari)
        ->count();

    $jumlahSelesai = tb_prakerin::join('siswa', 'tb_prakerin.nisn', '=', 'siswa.nisn')
        ->where('siswa.kelas', '=', $kelas)
        ->where('tb_prakerin.end', '<', $cek_hari)
        ->count();

    return [
        'kelas' => $kelas,
        'jumlahBelumMulai' => $jumlahBelumMulai,
        'jumlahBerlangsung' => $jumlahBerlangsung,
        'jumlahSelesai' => $jumlahSelesai
    ];
}

    
    
}
