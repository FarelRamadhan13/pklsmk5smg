@extends('layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center d-flex">
        <div class="col-md-9">
            <div class="card mt-5">
                <div class="card-header text-center py-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="mb-0">Daftar jurusan</h1>
                    </div>
                </div>
                <div class="card-body p-5">
                @if(session('berhasil'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('berhasil') }}',
            showConfirmButton: false,
            timer: 3000 
        });
    </script>
@endif
                    <div class="d-flex justify-content-end my-3">
                        <a href="/Admin/Jurusan/Tambah" class="btn btn-primary">Tambah</a>
                    </div>
                    <div class="table-responsive">
                    <table class="table-striped table align-middle" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Nama Jurusan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <?php
                        $no =1;
                        ?>
                        <tbody>
                            @foreach($jurusan as $u)
                                <tr>
                                    <td class="text-center">{{$u->id_jurusan}}</td>
                                    <td class="text-center">{{$u->nama_jurusan}}</td>
                                 
                                   <td class="text-center"> <form id="delete-form-{{ $u->id_jurusan }}" action="{{ route('jurusan.destroy', $u->id_jurusan) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" id="delete-btn-{{ $u->id_jurusan }}" style="display: none;">Hapus</button>
</form>

<a href="#" class="btn btn-danger delete-user" data-id="{{ $u->id_jurusan }}" data-nama="{{ $u->nama_jurusan }}">
    Hapus
</a>  <a href="/Admin/jurusan/edit/{{$u->id_jurusan}}" class="btn btn-warning">Ubah</a> </td>
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
            
        });
    });
</script>
<script>
    document.querySelectorAll('.delete-user').forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault(); 

            var userId = this.getAttribute('data-id');
            var nama = this.getAttribute('data-nama');

            Swal.fire({
                icon: 'warning',
                title: 'Konfirmasi Hapus',
                text: 'Yakin akan dihapus jurusan dengan nama ' + nama + '?',
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