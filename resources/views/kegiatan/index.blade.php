@extends('layout.app')
@section('content')
@php
use Carbon\Carbon;
@endphp

<style>
 .fixed-bottom-right {
        position: fixed;
        bottom: 6vh;
        right: 2vh;
        z-index: 1000;
        width: 8vh;
        height: 8vh;
        font-size: 4vh;
        background-color: rgb(223, 223, 223);
        padding: 1.5vh;
        border-radius: 50%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        animation: bounce 2s infinite;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .fixed-bottom-right:hover {
        background-color: rgb(255, 228, 228);
        animation: none;
    }

    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-1vh);
        }
    }

    .fixed-bottom-right i {
        transition: transform 0.3s ease-in-out;
    }

    .fixed-bottom-right:hover i {
        transform: scale(1.3);
    }

    .fixed-bottom-right.clicked i {
        animation: moveUp 0.5s forwards;
    }

    @keyframes moveUp {
        to {
            transform: translateY(-50px);
        }
    }

    .download-btn {
  border: 2px solid #0d6efd;
  background-color: white;
  position: fixed;
        bottom: 6vh;
        left: 2vh;
        z-index: 1000;
        width: 10vh;
        height: 10vh;
        font-size: 4vh;
        background-color: rgb(223, 223, 223);
        padding: 1.5vh;
        border-radius: 50%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        animation: bounce 2s infinite;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
}
.download-btn svg {
  width: 25px;
  height: 25px;
  transition: all 0.3s ease;
}
.download-btn:hover svg {
  fill: white;
}
.download-btn:hover {
  background-color: #0d6efd;
}
</style>
@if(session('gagal'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session('gagal') }}'
    });
</script>
@endif
{{-- <a href="/Siswa/JurnalPKL/harian/pdf/{{$id}}" class="btn rounded-circle fixed-bottom-right">
    <i class="fas fa-file-pdf text-danger"></i></a> --}}

    <a class="download-btn fixed-bottom-right" href="/Siswa/JurnalPKL/harian/pdf/{{$id}}" id="animatedBtn">
        <svg
          id="download"
          viewBox="0 0 24 24"
          data-name="Layer 1"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M14.29,17.29,13,18.59V13a1,1,0,0,0-2,0v5.59l-1.29-1.3a1,1,0,0,0-1.42,1.42l3,3a1,1,0,0,0,.33.21.94.94,0,0,0,.76,0,1,1,0,0,0,.33-.21l3-3a1,1,0,0,0-1.42-1.42ZM18.42,6.22A7,7,0,0,0,5.06,8.11,4,4,0,0,0,6,16a1,1,0,0,0,0-2,2,2,0,0,1,0-4A1,1,0,0,0,7,9a5,5,0,0,1,9.73-1.61,1,1,0,0,0,.78.67,3,3,0,0,1,.24,5.84,1,1,0,1,0,.5,1.94,5,5,0,0,0,.17-9.62Z"
          ></path>
        </svg>
      </a>
<div class="container">
    <div class="row justify-content-center align-items-center d-flex">
        <div class="col-md-9">
            <div class="card mt-5">
               <div class="card-header text-center py-4">
                    <div class="d-flex justify-content-center align-items-center">
                         <h1 class="mb-0" id="student-name">Daftar Kegiatan harian {{ $jurnal->nama_siswa }}</h1>
                        <script>
                            function toTitleCase(str) {
                  return str.toLowerCase().replace(/\b(\w)/g, function(match) {
                      return match.toUpperCase();
                  });
              }
                               
                                var studentNameElement = document.getElementById('student-name');
                        
          
                                var originalText = studentNameElement.innerHTML.replace('Daftar Kegiatan harian ', '');
                                var titleCasedText = toTitleCase(originalText);
                        
                               
                                studentNameElement.innerHTML = 'Daftar Kegiatan harian ' + titleCasedText;
                            </script>
                    </div>
                </div>
                <div class="card-body p-5">
                    @if(session('berhasil'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'success',
                                text: '{{ session('berhasil') }}',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        });
                    </script>
                    @endif

                    <div class="mt-0">
                        <style>
                            .kembali {
                             display: flex;
                             height: 3em;
                             width: 100px;
                             align-items: center;
                             justify-content: center;
                             background-color: #eeeeee4b;
                             border-radius: 3px;
                             letter-spacing: 1px;
                             transition: all 0.2s linear;
                             cursor: pointer;
                             border: none;
                             background: #fff;
                             color: black
                            }
                            
                            .kembali > svg {
                             margin-right: 5px;
                             margin-left: 5px;
                             font-size: 20px;
                             transition: all 0.4s ease-in;
                            }
                            
                            .kembali:hover > svg {
                             font-size: 1.2em;
                             transform: translateX(-5px);
                            }
                            
                            .kembali:hover {
                             box-shadow: 9px 9px 33px #d1d1d1, -9px -9px 33px #ffffff;
                             transform: translateY(-2px);
                            }
                            
                            </style>
                            
                              <a class="kembali text-decoration-none" href="/Siswa/JurnalPKL">
                                                        <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024"><path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path></svg>
                                                        <span>Kembali</span>
                                                    </a>
                                                </div>
                    <div class="d-flex justify-content-end my-3">
                        
                       <div class="col-auto">
                            @if($cek_kegiatan->start > $hari_ini)
                            <p>Belum memulai prakerin</p>
                            @elseif($cek_kegiatan->end < $hari_ini)
                            <p>Prakerin sudah selesai</p>
                            @else
                            <style>
                     .button {
  --main-focus: #2d8cf0;
  --font-color: #323232;
  --bg-color-sub: #dedede;
  --bg-color: #eee;
  --main-color: #323232;
  position: relative;
  width: 150px;
  height: 40px;
  cursor: pointer;
  display: flex;
  align-items: center;
  border: 2px solid var(--main-color);
  box-shadow: 4px 4px var(--main-color);
  background-color: var(--bg-color);
  border-radius: 10px;
  overflow: hidden;
}

.button, .button__icon, .button__text {
  transition: all 0.3s;
}

.button .button__text {
  transform: translateX(22px);
  color: var(--font-color);
  font-weight: 600;
}

.button .button__icon {
  position: absolute;
  transform: translateX(109px);
  height: 100%;
  width: 39px;
  background-color: var(--bg-color-sub);
  display: flex;
  align-items: center;
  justify-content: center;
}

.button .svg {
  width: 20px;
  fill: var(--main-color);
  color: black;
}

.button:hover {
  background: var(--bg-color);
}

.button:hover .button__text {
  color: transparent;
}

.button:hover .button__icon {
  width: 148px;
  transform: translateX(0);
}

.button:active {
  transform: translate(3px, 3px);
  box-shadow: 0px 0px var(--main-color);
}
 a.text-bawah {
            position: relative;
            text-decoration: none;
        }
        
        a.text-bawah::after {
            content: '';
            position: absolute;
            width: 0;
            height: 1px;
            display: block;
            margin-top: 2px;
            left: 0;
            background: #0033ff;
            transition: width 0.3s ease, left 0.3s ease;
        }

        a.text-bawah:hover::after {
            width: 100%;
            left: 0;
        }
                            </style>
@if($cek_hadir > 0 && $cek_sakit == 0)
<a class="button text-decoration-none" type="button" href="/Siswa/JurnalPKL/harian/tambah/{{$id}}" >
    <span class="button__text">Tambah</span>
    <span class="button__icon"><svg class="svg" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><line x1="12" x2="12" y1="5" y2="19"></line><line x1="5" x2="19" y1="12" y2="12"></line></svg></span>
</a>
@elseif($cek_sakit > 0)
<a>Izin</a>
@else
@if(auth()->guard('siswa')->check())
<style>
                          
    .pengingat p {
      font-size: 17px;
      font-weight: 400;
      line-height: 20px;
      color: #666;
    }
    
    .pengingat p.small {
      font-size: 14px;
    }
    
    .go-corner {
      display: flex;
      align-items: center;
      justify-content: center;
      position: absolute;
      width: 32px;
      height: 32px;
      overflow: hidden;
      top: 0;
      right: 0;
      background-color: #868686;
      border-radius: 0 4px 0 32px;
    }
    
    .go-arrow {
      margin-top: -4px;
      margin-right: -4px;
      color: white;
      font-family: courier, sans;
    }
    
    .pengingat1 {
      display: block;
      position: relative;
      max-width: 262px;
      background-color: rgb(243, 243, 243);
      border-radius: 4px;
      padding: 32px 24px;
      margin: 12px;
      text-decoration: none;
      z-index: 0;
      overflow: hidden;
    }
    
    .pengingat1:before {
      content: "";
      position: absolute;
      z-index: -1;
      top: -16px;
      right: -16px;
      background: #868686;
      height: 32px;
      width: 32px;
      border-radius: 32px;
      transform: scale(1);
      transform-origin: 50% 50%;
      transition: transform 0.25s ease-out;
    }
    
    .pengingat1:hover:before {
      transform: scale(21);
    }
    
    .pengingat1:hover p {
      transition: all 0.3s ease-out;
      color: rgba(255, 255, 255, 0.8);
    }
    
    .pengingat1:hover h3 {
      transition: all 0.3s ease-out;
      color: #fff;
    }
    
    .pengingat2 {
      display: block;
      top: 0px;
      position: relative;
      max-width: 262px;
      background-color: #f2f8f9;
      border-radius: 4px;
      padding: 32px 24px;
      margin: 12px;
      text-decoration: none;
      z-index: 0;
      overflow: hidden;
      border: 1px solid #f2f8f9;
    }
    
    .pengingat2:hover {
      transition: all 0.2s ease-out;
      box-shadow: 0px 4px 8px rgba(38, 38, 38, 0.2);
      top: -4px;
      border: 1px solid #ccc;
      background-color: white;
    }
    
    .pengingat2:before {
      content: "";
      position: absolute;
      z-index: -1;
      top: -16px;
      right: -16px;
      background: #00838d;
      height: 32px;
      width: 32px;
      border-radius: 32px;
      transform: scale(2);
      transform-origin: 50% 50%;
      transition: transform 0.15s ease-out;
    }
    
    .pengingat2:hover:before {
      transform: scale(2.15);
    }
    
    .pengingat3 {
      display: block;
      top: 0px;
      position: relative;
      max-width: 262px;
      background-color: #f2f8f9;
      border-radius: 4px;
      padding: 32px 24px;
      margin: 12px;
      text-decoration: none;
      overflow: hidden;
      border: 1px solid #f2f8f9;
    }
    
    .pengingat3 .go-corner {
      opacity: 0.7;
    }
    
    .pengingat3:hover {
      border: 1px solid #00838d;
      box-shadow: 0px 0px 999px 999px rgba(255, 255, 255, 0.5);
      z-index: 500;
    }
    
    .pengingat3:hover p {
      color: #00838d;
    }
    
    .pengingat3:hover .go-corner {
      transition: opactiy 0.3s linear;
      opacity: 1;
    }
    
    .pengingat4 {
      display: block;
      top: 0px;
      position: relative;
      max-width: 262px;
      background-color: #fff;
      border-radius: 4px;
      padding: 32px 24px;
      margin: 12px;
      text-decoration: none;
      overflow: hidden;
      border: 1px solid #ccc;
    }
    
    .pengingat4 .go-corner {
      background-color: #00838d;
      height: 100%;
      width: 16px;
      padding-right: 9px;
      border-radius: 0;
      transform: skew(6deg);
      margin-right: -36px;
      align-items: start;
      background-image: linear-gradient(-45deg, #8f479a 1%, #dc2a74 100%);
    }
    
    .pengingat4 .go-arrow {
      transform: skew(-6deg);
      margin-left: -2px;
      margin-top: 9px;
      opacity: 0;
    }
    
    .pengingat4:hover {
      border: 1px solid #cd3d73;
    }
    
    .pengingat4 h3 {
      margin-top: 8px;
    }
    
    .pengingat4:hover .go-corner {
      margin-right: -12px;
    }
    
    .pengingat4:hover .go-arrow {
      opacity: 1;
    }
    @media (max-width: 768px) {
    .table td {
        max-width: 200px;
        word-break: break-word;
        white-space: normal;
    }
}

                               </style>
                              <div class="pengingat mt-4">
                                <a class="pengingat1" href="/Siswa/JurnalPKL/Absensi/{{ $jurnal->id }}">
                                 <p>Absen hadir</p>
                                 <p class="small">Sebelum menambah kegiatan harian kamu harus absen hadir terlebih dahulu, klik ini untuk absen hadir sekarang</p>
                                 <div class="go-corner" href="/Siswa/JurnalPKL/Absensi/{{ $jurnal->id }}">
                                   <div class="go-arrow">
                                     →
                                   </div>
                                 </div>
                               </a>
                             </div>
                              
@else
<a>Belum Absen</a>
@endif
@endif
            
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row p-3">
                <div class="col-md-6">
                     <label for="columnSearch" ><i class="fa-solid fa-magnifying-glass"></i> Cari berdasarkan tanggal:</label>
                    <input type="date" id="columnSearch" class="form-control" placeholder="Cari berdasarkan tanggal">
                </div>
                <div class="col-md-6" style="margin-top: 22.5px;">
                    <button id="clearSearch" class="btn btn-secondary" style="display: none;"><i class="fa-solid fa-circle-stop"></i></button>
                </div>
            </div>
            

                    <div class="table-responsive">
                       
                        <table class="table-striped table table-bordered align-middle text-center" id="table">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Foto</th>
                                    <th class="text-center">Hari / Tanggal</th>
                                    <th class="text-center">Uraian kegiatan</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                          
                            <tbody>
                                @foreach($surat as $u)
                                <tr>
                                    <td class="text-center">{{$jumlah_kegiatan--}}</td>
                                   <?php
$date = Carbon::parse($u->tanggal);
$tanggal = $date->isoFormat('dddd, D MMMM');
$hari = $date->isoFormat('dddd');
$hanya_tanggal = $date->isoFormat('D MMMM');
$daysDiff = $date->diffInDays(Carbon::now());

$label = '';
if ($daysDiff == 0) {
    $label = '(Hari ini)';
} elseif ($daysDiff == 1) {
    $label = '(Kemarin)';
} elseif ($daysDiff <= 6) {
    $label = '(' . $daysDiff . ' hari yang lalu)';
} elseif ($daysDiff == 7) {
    $label = '(Seminggu yang lalu)';
}
?>
<td class="text-center">
       <?php if ($u->foto == null) { ?>
                                            -
                                        <?php } else { ?>
                                            <a href="{{ asset('storage/foto_kegiatan/' . $u->foto) }}" class="fancybox" data-fancybox="gallery" data-caption="Pada hari {{ $hari }} tanggal {{ $hanya_tanggal }}, {{$u->uraian}}">
                                                <img loading="lazy" src="{{ asset('storage/foto_kegiatan/' . $u->foto) }}" style="height: 150px; width: 150px; image-rendering: pixelated;" alt="" title="lihat foto">
                                            </a>
                                        <?php } ?>
   </td>

                                    <td class="text-center"> {{ $tanggal }} </br> {{ $label }}</td>

                                  <td class="text-center">
    @if(strlen($u->uraian) > 20)
        {{ substr($u->uraian, 0, 20) }}... <a href="{{ asset('storage/foto_kegiatan/' . $u->foto) }}" class="fancybox" data-fancybox="gallery" data-caption="Pada hari {{ $hari }} tanggal {{ $hanya_tanggal }}, {{$u->uraian}}">Lihat Selengkapnya</a>
    @else
        {{ $u->uraian }}
    @endif
</td>



                                    <td class="text-center p-2">
                                        @if(auth()->check() && auth()->user()->hak_akses == '0')
                                        <form id="delete-form-{{$id}}-{{ $u->id_kegiatan }}" action="{{ route('harian.destroy', ['id' => $id, 'id_kegiatan' => $u->id_kegiatan]) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" id="delete-btn-{{ $id }}-{{ $u->id_kegiatan }}" style="display: none;"><i class="fa-solid fa-trash"></i> </button>
                                        </form>

                                        <a href="#" class="btn btn-danger delete-user" data-id="{{ $id }}" kegiatan-id="{{ $u->id_kegiatan }}">
                                            <i class="fa-solid fa-trash"></i> 
                                        </a>
                                        <a href="/Siswa/JurnalPKL/harian/{{$id}}/ubah/{{$u->id_kegiatan}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                        @else
                                        @if($u->tanggal == $hari_ini)
                                        <form id="delete-form-{{$id}}-{{ $u->id_kegiatan }}" action="{{ route('harian.destroy', ['id' => $id, 'id_kegiatan' => $u->id_kegiatan]) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" id="delete-btn-{{ $id }}-{{ $u->id_kegiatan }}" style="display: none;"><i class="fa-solid fa-trash"></i> </button>
                                        </form>

                                        <a href="#" class="btn btn-danger delete-user" data-id="{{ $id }}" kegiatan-id="{{ $u->id_kegiatan }}">
                                            <i class="fa-solid fa-trash"></i> 
                                        </a>
                                        <a href="/Siswa/JurnalPKL/harian/{{$id}}/ubah/{{$u->id_kegiatan}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                        @else
                                        ✔
                                        @endif
                                        @endif
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
<script>
$(document).ready(function() {
    var table = $('#table').DataTable({
        "order": [],
        scrollCollapse: true,
        scrollY: '70vh',
        "paging": true, 
        "pageLength": 10, 
        "lengthMenu": [ 10, 25, 50, 75, 100 ], 
        "deferRender": true,
        "processing": true
    });

 $('#columnSearch').on('change', function() {
    var searchTerm = this.value;
    console.log('Search term:', searchTerm); 
    
    var formattedDate = new Date(searchTerm).toLocaleDateString('id-ID', { day: 'numeric', month: 'long' });
    console.log('Formatted date:', formattedDate); 
    
    table.column(2).search(formattedDate, true, false).draw();
     $('#clearSearch').show();
});

    $('#clearSearch').on('click', function() {
        $('#columnSearch').val('');
        table.column(2).search('').draw();
        $(this).hide(); 
    });

    $('#dt-search-0').hide();
    $('label[for="dt-search-0"]').hide();
    
    $('#columnSearch').attr('type', 'date').attr('placeholder', 'Cari berdasarkan tanggal');

 
    $(".fancybox").fancybox();

   
    let observer = new IntersectionObserver(function(entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
              
                $(entry.target).fancybox();
                observer.unobserve(entry.target); 
            }
        });
    });

   
    $('.fancybox').each(function() {
        observer.observe(this);
    });
});
</script>
<script>
    document.querySelectorAll('.delete-user').forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault();

            var userId = this.getAttribute('data-id');
            var kegiatanid = this.getAttribute('kegiatan-id');


            Swal.fire({
                icon: 'warning',
                title: 'Konfirmasi Hapus',
                text: 'Yakin akan dihapus kegiatan hariannya? kamu tidak akan bisa memulihkannya',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + userId + '-' + kegiatanid).submit();
                }
            });
        });
    });
</script>
@endsection