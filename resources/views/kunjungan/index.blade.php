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
                    <h1>Daftar Kunjungan</h1>
                </div>
                <div class="card-body p-5">
                @if(session('berhasil'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: '{{ session('berhasil') }}',
                showConfirmButton: false,
                timer: 3000 
            });
        });
    </script>
@endif
                    @if(auth()->user())
                    <div class="d-flex justify-content-end my-3">
                    <a href="@if(auth()->user()) /Admin/Kunjungan/pdf @else /kepsek/Kunjungan/pdf @endif" target="_BLANK" class="btn btn-outline-secondary me-3">PDF</a> @if(!auth()->user()->hak_akses == '1')<a href="/Admin/Kunjungan/Tambah" class="btn btn-primary">Tambah</a> @endif
                    </div>
                    @endif
                    <div class="table-responsive">
                    <table class="table-striped table-bordered table align-middle" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">Id Kunjungan</th>
                                <th class="text-center">Id Prakerin</th>
                                <th class="text-center">Id PKL</th>
                                <th class="text-center">Nama PKL</th>
                                <th class="text-center">Alamat PKL</th>
                                <th class="text-center">NIP</th>
                                <th class="text-center">Nama Guru</th>
                                <th class="text-center">Tanggal upload data</th>
                                <th class="text-center">File</th>
                                @if(auth()->check()) @if(auth()->user()->hak_akses != '2')<th class="text-center">Action</th> @endif @else<th class="text-center">Action</th>  @endif
                            </tr>
                        </thead>
                        <?php
                        $no =1;
                        ?>
                        <tbody>
                            @foreach($kunjungan as $u)
                                <tr>
                                    <td class="text-center">{{$u->idkunjungan}}</td>
                                    <td class="text-center">{{$u->idprakerin}}</td>
                                    <td class="text-center">{{$u->idpkl}}</td>
                                    <td class="text-center">{{$u->nama_pkl}}</td>
                                    <td class="text-center">{{$u->alamat_pkl}}</td>
                                    <td class="text-center">{{$u->nip}}</td>
                                    <td class="text-center">{{$u->nama}}</td>
                                    <?php 
                                    $date = Carbon::parse($u->tanggal);
                                    $tanggal = $date->isoFormat('D MMMM YYYY');
                                    ?>
                                    <td class="text-center">{{$tanggal}}</td>
                                    <td class="text-center">@if($u->upload_data != null) @if(auth()->user()) <a href="@if(auth()->user()) /Admin/Kunjungan/file/{{$u->upload_data}} @else /kepsek/Kunjungan/file/{{$u->upload_data}} @endif" target="_BLANK">Lihat file</a>   @else <a href="/Pendamping/Kunjungan/file/{{$u->upload_data}}" target="_BLANK">Lihat file</a> @endif @endif</td>
                                    @if(auth()->check())
                                    @if(auth()->user()->hak_akses != '2')
                                    <td class="text-center">
    <form id="delete-form-{{ $u->idkunjungan }}" action="{{ route('kunjungan.destroy', $u->idkunjungan) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" id="delete-btn-{{ $u->idkunjungan }}" style="display: none;">Hapus</button>
    </form>

    <a href="#" class="btn btn-danger delete-user" data-id="{{ $u->idkunjungan }}" data-username="{{ $u->nama }}">Hapus</a> 
        <a href="/Admin/Kunjungan/edit/{{$u->idkunjungan}}" class="btn btn-warning">Ubah</a>
    @endif
@else
    @if(auth()->guard('pendamping')->check())
        <td>
            <a href="/Pendamping/Kunjungan/edit/{{$u->idkunjungan}}" class="btn btn-warning">Ubah</a>
        </td>
    @endif
@endif

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
<script>
    document.querySelectorAll('.delete-user').forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault(); 

            var userId = this.getAttribute('data-id');
            var username = this.getAttribute('data-username');

            Swal.fire({
                icon: 'warning',
                title: 'Konfirmasi Hapus',
                text: 'Yakin akan dihapus Data kunjungan dengan Nama Pendamping ' + username + '?',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + userId).submit();
                }
            });
        });
    });
</script>
@endsection