@extends('layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center d-flex">
        <div class="col-md-9">
            <div class="card mt-5">
                <div class="card-header text-center py-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="mb-0">Daftar Guru pendamping</h1>
                    </div>
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

                    <div class="d-flex justify-content-end">
                        <a href="/Admin/guru_pendamping/Tambah" class="btn btn-primary">Tambah</a>
                    </div>
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
 .shiny-image {
        position: relative;
        display: inline-block;
        overflow: hidden;
    }
    
    .shiny-image img {
        width: 11.5vh;
        height: 11.5vh;
        border-radius: 50%;
    }
    
    .shiny-image::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.8), transparent);
        transform: rotate(45deg);
        animation: shine 3.5s infinite;
    }
    
    @keyframes shine {
        0% {
            top: -100%;
            left: -100%;
        }
        100% {
            top: 100%;
            left: 100%;
        }
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
                    <table class="table-striped table align-middle table-bordered" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">Foto</th>
                                <th class="text-center">NIP</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Telp</th>
                              
                                <th class="text-center">Tahun</th>
                                <th class="text-center">Jurusan</th>
                                <th class="text-center">Jabatan</th>
                                <th class="text-center">Pangkat</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <?php
                        $no =1;
                        ?>
                        <tbody>
                            @foreach($guruPendamping as $u)
                                <tr>
                                    <td class="text-center">
                                            @if($u->foto_pendamping != 'default.png')
                                                <div class="shiny-image">
                                                    <a href="{{ asset('storage/foto_profile_guruPendamping/' . $u->foto_pendamping) }}" data-fancybox="gallery" data-caption="Foto Profil {{$u->nama}}">
                                                        <img loading="lazy" src="{{ asset('storage/foto_profile_guruPendamping/' . $u->foto_pendamping) }}" style="width: 11.5vh; height: 11.5vh;" alt="Foto Profil {{$u->nama}}" class="rounded-circle" id="profileImage">
                                                    </a>
                                                </div>
                                                
                                            @else
                                                <img loading="lazy" src="{{ asset('storage/foto_profile_guruPendamping/' . $u->foto_pendamping) }}" alt="" class="rounded-circle" style="width: 10vh; height: 10vh;" srcset="">
                                            @endif
                                        </td>
                                    <td class="text-center">{{$u->nip}}</td>
                                    <td class="text-center">{{$u->nama}}</td>
                                    <td class="text-center"><textarea class="form-control" id=""  style="height:150px; width: 250px;" readonly>{{$u->alamat}}</textarea></td>
                                    <td class="text-center">{{$u->telp}}</td>
                                
                                    <td class="text-center">{{$u->tahun}}</td>
                                    <td class="text-center">{{$u->nama_jurusan}}</td>
                                    <td class="text-center">{{$u->jabatan}}</td>
                                    <td class="text-center">{{$u->pangkat}}</td>
                                    <td class="text-center">@if($u->status == '0') Aktif @else Non Aktif @endif</td>
                                    <td class="text-center"> <form id="delete-form-{{ $u->nip }}" action="{{ route('guru_pendamping.destroy', $u->nip) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" id="delete-btn-{{ $u->nip }}" style="display: none;">Hapus</button>
</form>

<a href="#" class="btn btn-danger delete-user" data-id="{{ $u->nip }}" data-username="{{ $u->nama }}">
    Hapus
</a>  <a href="/Admin/guru_pendamping/edit/{{$u->nip}}" class="btn btn-warning">Ubah</a> </td>
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
            "order": [[ 1, "asc" ]],
            scrollCollapse: true,
            scrollY: '70vh',
            initComplete: function () {
                var columns = this.api().columns().header().toArray();
                var select = $('#columnSelect');
                var excludedColumns = ['Action', 'Foto']; 
               
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

      

        $('#columnSearch').on('keyup', function() {
            var colIndex = $('#columnSelect').val();
            var searchTerm = this.value;
            if (searchTerm) {
                table.column(colIndex).search(searchTerm).draw();
            } else {
                table.column(colIndex).search('').draw(); 
            }
        });

       $('#columnSelect').on('change', function() {
        var selectedText = $(this).find('option:selected').text();
        $('#columnSearch').val('');
        $('#columnSearch').attr('placeholder', 'Cari berdasarkan ' + selectedText.toLowerCase());

        if (selectedText === 'Action' || selectedText === 'Foto') {
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
            var username = this.getAttribute('data-username');

            Swal.fire({
                icon: 'warning',
                title: 'Konfirmasi Hapus',
                text: 'Yakin akan dihapus Guru pendamping dengan Nama ' + username + '?',
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