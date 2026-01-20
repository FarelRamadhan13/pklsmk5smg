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
                    <h1>Daftar Pesan</h1>
                </div>
                <div class="card-body p-5">
                    @if(session('berhasil'))
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        {{session('berhasil')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                  
                    <div class="table-responsive">
                    <table class="table-striped table table-bordered align-middle" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">Nomor</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Pesan</th>
                                <th class="text-center">Pada</th>
                              
                            </tr>
                        </thead>
                        <?php
                        $no =1;
                        ?>
                        <tbody>
                            @foreach($pesan as $u)
                               <tr
    @if($u->created_at->isToday())
        style="background-color: #d4edda; color: #155724;" 
    @elseif($u->created_at->isCurrentWeek())
        style="background-color: #d1ecf1; color: #0c5460;" 
    @endif
>
    <td class="text-center">{{$no++}}</td>
    <td class="text-center">{{$u->nama}}</td>
    <td class="text-center">{{$u->pesan}}</td>

    <?php
    $date = Carbon::parse($u->created_at);
    $tanggal = $date->isoFormat('dddd, D MMMM');
    ?>
    <td class="text-center">{{$tanggal}}</td>
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