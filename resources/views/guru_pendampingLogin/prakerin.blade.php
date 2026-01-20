@extends('layout.app')
@section('content')

@php
use Carbon\Carbon;
@endphp
<div class="container">
    <div class="row justify-content-center align-items-center d-flex">
        <div class="col-md-9">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1>Daftar Prakerin</h1>
                </div>
                <div class="card-body p-5">
                    @if(session('berhasil'))
                    <div class="alert-success alert text-center">
                        {{session('berhasil')}}
                    </div>
                    @endif
                 
                    <div class="table-responsive">
                    <table class="table-striped table-bordered table align-middle" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Id PKL</th>
                                <th class="text-center">Nama PKL</th>
                                <th class="text-center">Alamat PKL</th>
                                <th class="text-center">NIS</th>
                                <th class="text-center">Nama Siswa</th>
                                <th class="text-center">Kelas</th>
                                <th class="text-center">NIP</th>
                                <th class="text-center">Nama Guru</th>
                                <th class="text-center">Start</th>
                                <th class="text-center">End</th>
                                <th class="text-center">Tahun</th>
                              
                            </tr>
                        </thead>
                        <?php
                        $no =1;
                        ?>
                        <tbody>
                            @foreach($prakerin as $p)
                                <tr>
                                    <td class="text-center">{{$p->idprakerin}}</td>
                                    <td class="text-center">{{$p->idpkl}}</td>
                                    <td class="text-center">{{$p->nama_pkl}}</td>
                                    <td class="text-center">{{$p->alamat_pkl}} </td>
                                    <td class="text-center">{{$p->nisn}}</td>
                                    <td class="text-center">{{$p->nama_siswa}}</td>
                                    <td class="text-center">{{$p->kelas}}</td>
                                    <td class="text-center">{{$p->nip}}</td>
                                    <td class="text-center">{{$p->nama}}</td>
                                    <?php
                                    $date = Carbon::parse($p->start);
                                    $tanggal = $date->isoFormat('D MMMM YYYY');
                                    ?>
                                    <td class="text-center">{{$tanggal}}</td>
                                    <?php
                                    $end = Carbon::parse($p->end);
                                    $akhir = $end->isoFormat('D MMMM YYYY');
                                    ?>
                                    <td class="text-center">{{$akhir}}</td>
                                    <td class="text-center">{{$p->tahun}}</td>
                                  
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#table').DataTable({
            "order": [[ 0, "desc" ]] 
   

 
        });
      
    });
</script>
@endsection