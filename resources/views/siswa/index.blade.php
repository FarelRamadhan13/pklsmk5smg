@extends('layout.app')
@section('content')
<style>
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
    
    #editLink {
        transform: translate(50%, 50%);
        z-index: 1;
    }
    
    #editIcon {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 2.3rem;
        height: 2.3rem;
        bottom: -2vh;
        left: -2vh;
        background-color: rgb(255, 255, 255, 0.9);
        border-radius: 50%; 
    }
    
   
</style>
<div class="container">
    <div class="row justify-content-center align-items-center d-flex">
        <div class="col-md-9">
            <div class="card mt-5">
                <div class="card-header text-center py-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="mb-0">Daftar Siswa</h1>
                    </div>
                </div>
                <div class="card-body p-5">
                    @if(session('berhasil'))
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: '{{ session('berhasil') }}',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                            });
                        </script>
                    @endif
                    <style>
                        .print-btn {
  width: 100px;
 
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: white;
  border: 1px solid rgb(213, 213, 213);
  border-radius: 10px;
  gap: 10px;
  font-size: 16px;
  cursor: pointer;
  overflow: hidden;
  font-weight: 500;
  box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.065);
  transition: all 0.3s;
}
.printer-wrapper {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 20px;
  height: 100%;
}
.printer-container {
  height: 50%;
  width: 100%;
  display: flex;
  align-items: flex-end;
  justify-content: center;
}

.printer-container svg {
  width: 100%;
  height: auto;
  transform: translateY(4px);
}
.printer-page-wrapper {
  width: 100%;
  height: 50%;
  display: flex;
  align-items: flex-start;
  justify-content: center;
}
.printer-page {
  width: 70%;

  border: 1px solid black;
  background-color: white;
  transform: translateY(0px);
  transition: all 0.3s;
  transform-origin: top;
}
.print-btn:hover .printer-page {
  height: 16px;
  background-color: rgb(239, 239, 239);
}
.print-btn:hover {
  background-color: rgb(239, 239, 239);
}

                    </style>
                    <div class="d-flex justify-content-end">
                        <a class="print-btn me-2 text-decoration-none text-dark" href="/Admin/Siswa/pdf" target="_BLANK">
                            <span class="printer-wrapper">
                              <span class="printer-container">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 92 75">
                                  <path
                                    stroke-width="5"
                                    stroke="black"
                                    d="M12 37.5H80C85.2467 37.5 89.5 41.7533 89.5 47V69C89.5 70.933 87.933 72.5 86 72.5H6C4.067 72.5 2.5 70.933 2.5 69V47C2.5 41.7533 6.75329 37.5 12 37.5Z"
                                  ></path>
                                  <mask fill="white" id="path-2-inside-1_30_7">
                                    <path
                                      d="M12 12C12 5.37258 17.3726 0 24 0H57C70.2548 0 81 10.7452 81 24V29H12V12Z"
                                    ></path>
                                  </mask>
                                  <path
                                    mask="url(#path-2-inside-1_30_7)"
                                    fill="black"
                                    d="M7 12C7 2.61116 14.6112 -5 24 -5H57C73.0163 -5 86 7.98374 86 24H76C76 13.5066 67.4934 5 57 5H24C20.134 5 17 8.13401 17 12H7ZM81 29H12H81ZM7 29V12C7 2.61116 14.6112 -5 24 -5V5C20.134 5 17 8.13401 17 12V29H7ZM57 -5C73.0163 -5 86 7.98374 86 24V29H76V24C76 13.5066 67.4934 5 57 5V-5Z"
                                  ></path>
                                  <circle fill="black" r="3" cy="49" cx="78"></circle>
                                </svg>
                              </span>
                          
                              <span class="printer-page-wrapper">
                                <span class="printer-page"></span>
                              </span>
                            </span>
                            Cetak
                          </a>
                          
                       
                        <a href="/Admin/siswa/Tambah" class="btn btn-primary">Tambah</a>
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
                                    <th class="text-center">Foto</th>
                                    <th class="text-center">NIS</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Alamat</th>
                                    <th class="text-center">Telp</th>
                                    <th class="text-center">Kelas</th>
                                    <th class="text-center">Tahun</th>
                                    <th class="text-center">Jurusan</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($siswa as $u)
                                    <tr>
                                        <td class="text-center">
                                            @if($u->foto_siswa != 'default.png')
                                                <div class="shiny-image">
                                                    <a href="{{ asset('storage/foto_profile_siswa/' . $u->foto_siswa) }}" data-fancybox="gallery" data-caption="Foto Profil {{$u->nama_siswa}}">
                                                        <img loading="lazy" src="{{ asset('storage/foto_profile_siswa/' . $u->foto_siswa) }}" style="width: 11.5vh; height: 11.5vh;" alt="Foto Profil {{$u->nama_siswa}}" class="rounded-circle" id="profileImage">
                                                    </a>
                                                </div>
                                                <a href="#" class="text-decoration-none position-relative text-light delete-foto" data-id="{{ $u->nisn }}" data-username="{{ $u->nama_siswa }}" data-foto="{{ asset('storage/foto_profile_siswa/' . $u->foto_siswa) }}" id="editLink">
                                                    <span class="position-absolute translate-middle shadow" id="editIcon">
                                                        <i class="fas fa-trash-alt text-secondary"></i>
                                                    </span>
                                                </a>
                                            @else
                                                <img loading="lazy" src="{{ asset('storage/foto_profile_siswa/' . $u->foto_siswa) }}" alt="" class="rounded-circle" style="width: 10vh; height: 10vh;" srcset="">
                                            @endif
                                        </td>
                                        <td class="text-center">{{$u->nisn}}</td>
                                        <td class="text-center">{{$u->nama_siswa}}</td>
                                        <td class="text-center"><textarea style="width: 220px;" rows="5" class="form-control" readonly>{{$u->alamat}}</textarea></td>
                                        <td class="text-center">{{$u->telp}}</td>
                                        <td class="text-center">{{$u->kelas}}</td>
                                        <td class="text-center">{{$u->tahun}}</td>
                                        <td class="text-center">{{$u->nama_jurusan}}</td>
                                        <td class="text-center">
                                            <form id="delete-form-{{ $u->nisn }}" action="{{ route('siswa.destroy', $u->nisn) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" id="delete-btn-{{ $u->nisn }}" style="display: none;">Hapus</button>
                                            </form>
                                            <a href="#" class="btn btn-danger delete-user" data-id="{{ $u->nisn }}" data-username="{{ $u->nama_siswa }}">Hapus</a>
                                            <a href="/Admin/siswa/edit/{{$u->nisn}}" class="btn btn-warning">Ubah</a>
                                        </td>
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
<style>
    /* Custom image styling */
.swal2-custom-image {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border: 2px solid #ddd;
    padding: 5px;
}

/* Rounded circle for the image */
.rounded-circle {
    border-radius: 50%;
}

/* Additional styling for the confirmation dialog */
.swal2-container {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.swal2-title {
    font-size: 24px;
    margin-bottom: 10px;
}

.swal2-content {
    font-size: 16px;
    margin-bottom: 20px;
}

.swal2-confirm {
    background-color: #d9534f;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
}

.swal2-cancel {
    background-color: #5bc0de;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    margin-right: 10px;
}

</style>
<script>
    $(document).ready(function() {
        var table = $('#table').DataTable({
           "order": [[ 2, "asc" ]],
            "deferRender": true,
    scrollCollapse: true,
    scrollY: '70vh',
    "paging": true, 
    "pageLength": 10,
    "lengthMenu": [ 10, 25, 50, 75, 100 ], 
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
                    title: 'Konfirmasi Hapus!',
                    text: 'Yakin akan dihapus Siswa dengan Nama ' + username + '?',
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

        document.querySelectorAll('.delete-foto').forEach(item => {
            item.addEventListener('click', function(event) {
                event.preventDefault();
                var userId = this.getAttribute('data-id');
                var username = this.getAttribute('data-username');
                var foto = this.getAttribute('data-foto');
                Swal.fire({
                    html: `
                        <div>
                            <img src="${foto}" alt="Custom image" class="swal2-custom-image rounded-circle">
                        </div>
                        <br/>
                        <div>
                            <h2>Konfirmasi Hapus!</h2>
                            <p>Yakin akan dihapus Foto Profile Siswa dengan Nama ${username}?</p>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '/Siswa/foto/hapus/' + userId;
                        form.style.display = 'none';
                        var csrfInput = document.createElement('input');
                        csrfInput.type = 'hidden';
                        csrfInput.name = '_token';
                        csrfInput.value = '{{ csrf_token() }}';
                        form.appendChild(csrfInput);
                        var methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        methodInput.value = 'DELETE';
                        form.appendChild(methodInput);
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });
</script>
@endsection
