@extends('layout.app')
@section('content')
@php 
use Carbon\Carbon;
@endphp
<div class="container">
    <div class="row justify-content-center align-items-center d-flex">
        <div class="col-md-9">
            <div class="card mt-5">
                <div class="card-header text-center py-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="mb-0">Daftar Surat tugas</h1>
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
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                        {{session('error')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                     @if(auth()->check() && auth()->user()->hak_akses == '0' || auth()->guard('pendamping')->check())
                    <div class="d-flex justify-content-end ">
                   <a href="/Pendamping/Pengajuan/tambah" class="btn btn-primary">Tambah</a>
                    </div>
                    @endif
                    <div class="mb-5 row justify-content-center">
                        <div class="col-md-4 mt-3">
                            <select id="columnSelect" class="form-select mr-2"></select>
                        </div>
                        <div class="col-md-6 d-flex mt-2">
                            <style>
                                .ui-input-container {
  position: relative;
  width: 300px;
}

.ui-input {
  width: 100%;
  padding: 10px 10px 10px 40px;
  font-size: 1em;
  border: none;
  border-bottom: 2px solid #ccc;
  outline: none;
  background-color: transparent;
  transition: border-color 0.3s;
}

.ui-input:focus {
  border-color: #949494;
}

.ui-input-underline {
  position: absolute;
  bottom: 0;
  left: 0;
  height: 2px;
  width: 100%;
  background-color: #999999;
  transform: scaleX(0);
  transition: transform 0.3s;
}

.ui-input:focus + .ui-input-underline {
  transform: scaleX(1);
}

.ui-input-highlight {
  position: absolute;
  bottom: 0;
  left: 0;
  height: 100%;
  width: 0;
  background-color: rgba(171, 167, 255, 0.1);
  transition: width 0.3s;
}

.ui-input:focus ~ .ui-input-highlight {
  width: 100%;
}

.ui-input-icon {
  position: absolute;
  left: 10px;
  top: 50%;
  transform: translateY(-50%);
  color: #999;
  transition: color 0.3s;
}

.ui-input:focus ~ .ui-input-icon {
  color: #999999;
}

.ui-input-icon svg {
  width: 20px;
  height: 20px;
}

                            </style>
                            <div class="ui-input-container">
                                <input
                                  required=""
                                  placeholder="Type something..."
                                  class="ui-input"
                                  type="text"
                                  id="columnSearch"
                                />
                                <div class="ui-input-underline"></div>
                                <div class="ui-input-highlight"></div>
                                <div class="ui-input-icon">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path
                                      stroke-linejoin="round"
                                      stroke-linecap="round"
                                      stroke-width="2"
                                      stroke="currentColor"
                                      d="M21 21L16.65 16.65M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z"
                                    ></path>
                                  </svg>
                                </div>
                              </div>
                              </div>
                    </div>
                    <div class="table-responsive">
                    <table class="table-striped table table-bordered align-middle" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">Nomor</th>
                                <th class="text-center">NIP</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Industri / PKL</th>
                                <th class="text-center">Tahun</th>
                                @if(auth()->check() && !auth()->user()->hak_akses == '0' || !auth()->guard('pendamping')->check())
                                <th class="text-center">File</th>
                                @endif
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <?php
                        $no =1;
                        ?>
                        <tbody>
                            @foreach($surat as $u)
                                <tr>
                                    <td class="text-center">{{$u->id}}</td>
                                    <td class="text-center">{{$u->nip}}</td>
                                    <td class="text-center">{{$u->nama}}</td>
                                    <?php
                                    $date = Carbon::parse($u->tanggal);
                                    $tanggal = $date->isoFormat('dddd, D MMMM Y');
                                    ?>
                                    <td class="text-center">{{$tanggal}}</td>
                                    <td class="text-center">{{$u->nama_pkl}}</td>
                                    <td class="text-center">{{$u->tahun}}</td>
                                    @if(auth()->check() && !auth()->user()->hak_akses == '0' || !auth()->guard('pendamping')->check())
                                    <td class="text-center"><a href="/Pendamping/Pengajuan/file/{{$u->id}}" target="_BLANK">Lihat FIle</a></td>
                                    @endif
                                    <td class="text-center">  <form id="delete-form-{{ $u->id }}" action="{{ route('tugas.destroy', $u->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" id="delete-btn-{{ $u->id }}" style="display: none;">Hapus</button>
</form>

<a href="#" class="btn btn-danger delete-user" data-id="{{ $u->id }}" username="{{ $u->nama }}">
    Hapus
</a>  <a href="/Pendamping/Pengajuan/ubah/{{$u->id}}" class="btn btn-warning">Ubah</a> </td>
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
    var table = $('#table').DataTable({
        "order": [[ 0, "desc" ]],
        scrollCollapse: true,
        scrollY: '70vh',
        initComplete: function () {
            var columns = this.api().columns().header().toArray();
            var select = $('#columnSelect');
            var excludedColumns = ['Action', 'File']; 
           
            for (var i = 0; i < columns.length; i++) {
                var columnName = $(columns[i]).text();
                if (!excludedColumns.includes(columnName)) {
                    select.append('<option value="' + i + '">' + columnName + '</option>');
                }
            }
        }
    });

    $('#dt-search-0').hide();
    $('label[for="dt-search-0"]').hide();

    $('#columnSearch').on('keyup change', function() {
        var colIndex = $('#columnSelect').val();
        var searchTerm = this.value;
        

        if ($('#columnSelect option:selected').text() === 'Tanggal' && searchTerm) {
            var options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
            var formattedDate = new Date(searchTerm).toLocaleDateString('id-ID', options);
            table.column(colIndex).search(formattedDate).draw();
            $('#clearSearch').show();
        } else {
            table.column(colIndex).search(searchTerm).draw();
            $('#clearSearch').hide();
        }
    });

    $('#clearSearch').on('click', function() {
            $('#columnSearch').val('');
            table.column(3).search('').draw();
            $(this).hide(); 
        });

    $('#columnSelect').on('change', function() {
        var selectedText = $(this).find('option:selected').text();
        $('#columnSearch').val('');
        $('#clearSearch').hide();
        
        if (selectedText === 'Tanggal') {
            $('#columnSearch').attr('type', 'date');
        } else {
            $('#columnSearch').attr('type', 'text');
        }

        $('#columnSearch').attr('placeholder', 'Cari berdasarkan ' + selectedText.toLowerCase());

        if (selectedText === 'Action' || selectedText === 'Absensi') {
            $('#columnSearch').prop('disabled', true).hide();
            table.search('').draw(); 
        } else {
            $('#columnSearch').prop('disabled', false).show();
        }

        table.search('').columns().search('').draw(); 
    }).trigger('change');
});
</script>
<script>
    document.querySelectorAll('.delete-user').forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault(); 

            var userId = this.getAttribute('data-id');
            var username = this.getAttribute('username');
          

            Swal.fire({
                icon: 'warning',
                title: 'Konfirmasi Hapus',
                text: 'Yakin akan dihapus surat tugas guru pendamping dengan Nama guru pendamping '+ username  +'?',
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