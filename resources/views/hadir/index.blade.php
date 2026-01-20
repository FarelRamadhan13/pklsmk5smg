@extends('layout.app')
@section('content')
<!-- Shepherd.js CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/shepherd.js@9.1.1/dist/css/shepherd.css">

<!-- Shepherd.js JS -->
<script src="https://cdn.jsdelivr.net/npm/shepherd.js@9.1.1/dist/js/shepherd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@php
use Carbon\Carbon;
@endphp
<script>
//         document.addEventListener("visibilitychange", function() {
//             if (!document.hidden) {
//                 location.reload();
//             }
//         });
   </script>
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

    .fixed-bottom-right svg {
        transition: transform 0.3s ease-in-out;
    }

    .fixed-bottom-right:hover svg {
        transform: scale(1.3);
    }

    .fixed-bottom-right.clicked svg {
        animation: moveUp 0.5s forwards;
    }

    @keyframes moveUp {
        to {
            transform: translateY(-50px);
        }
    }

    .swal2-confirm.absen-sekarang-button {
            background-color: #4CAF50;
            color: white;
        }

.download-btn {
  border: 2px solid #a5c9ff;
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
  background-color: #a5c9ff;
}

</style>

<body>
    @if(session('gagal'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('gagal') }}'
        });
    </script>
@endif
<div class="container">
{{-- <a href="/Siswa/JurnalPKL/Absen/pdf/{{$id}}" target="_BLANK" class="btn rounded-circle fixed-bottom-right" id="animatedBtn">
    <i class="fas fa-file-pdf text-danger"></i>
</a> --}}

<a class="download-btn fixed-bottom-right" href="/Siswa/JurnalPKL/Absen/pdf/{{$id}}" id="animatedBtn">
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




    <div class="row justify-content-center align-items-center d-flex">
        <div class="col-md-9">
            <div class="card mt-5">
                <div class="card-header text-center py-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="mb-0" id="student-name">Daftar Hadir {{$jurnal->nama_siswa}}</h1>
                        <script>
                      function toTitleCase(str) {
            return str.toLowerCase().replace(/\b(\w)/g, function(match) {
                return match.toUpperCase();
            });
        }

                          var studentNameElement = document.getElementById('student-name');


                          var originalText = studentNameElement.innerHTML.replace('Daftar Hadir ', '');
                          var titleCasedText = toTitleCase(originalText);


                          studentNameElement.innerHTML = 'Daftar Hadir ' + titleCasedText;
                      </script>
                    </div>
                </div>
                <div class="card-body p-5">
                    @if(session('berhasil'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'success',
                                text: "{{ session('berhasil') }}",
                                showConfirmButton: false,
                                timer: 7000
                            });

                        });
                    </script>
                    @endif
                    @if($cek_absen->start > $cek_hari)
                    <script>

                        Swal.fire({
                        icon: "error",
                        title: "Belum memulai PKL",
                        confirmButtonText: 'Baik',
});
                    </script>

                    @endif

                    <div class="mt-0">
                        <style>
                            .button {
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

                            .button > svg {
                             margin-right: 5px;
                             margin-left: 5px;
                             font-size: 20px;
                             transition: all 0.4s ease-in;
                            }

                            .button:hover > svg {
                             font-size: 1.2em;
                             transform: translateX(-5px);
                            }

                            .button:hover {
                             box-shadow: 9px 9px 33px #d1d1d1, -9px -9px 33px #ffffff;
                             transform: translateY(-2px);
                            }

                            </style>

                              <a class="button text-decoration-none mb-5" href="/Siswa/JurnalPKL">
                                                        <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024"><path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path></svg>
                                                        <span>Kembali</span>
                                                    </a>

                    </div>
                    <div class="d-flex justify-content-end my-3">

                        <div class="col-auto ms-3" id="absen_cek">
                            @if(auth()->guard('siswa')->check())
                            @if($cek_absen->start > $cek_hari)
                            <script>

                                Swal.fire({
                                icon: "error",
                                title: "Kamu belum mulai PKL",
                                confirmButtonText: 'Baik',
});
                            </script>
                             <p>Belum mulai PKL</p>
                            @elseif($cek_absen->end < $cek_hari)
                            <script>

                                Swal.fire({
                                icon: "success",
                                title: "Waktu PKL kamu sudah selesai",
                                confirmButtonText: 'Baik',
});
                            </script>
                            <p>Sudah selesai PKL</p>
                            @else
                           @if(auth()->guard('siswa')->check())
                            @if($cek == 0)
                            @if($cek_hadir == 0)
                            <!-- <style>
                               .Btn {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  width: 45px;
  height: 45px;
  border: none;
  border-radius: 50%;
  cursor: pointer;
  position: relative;
  overflow: hidden;
  transition-duration: .3s;
  box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.199);
  background-color: #3085d6;
}

/* plus sign */
.sign {
  width: 100%;
  transition-duration: .3s;
  display: flex;
  align-items: center;
  justify-content: center;
}

.sign svg {
  width: 17px;
}

.sign svg path {
  fill: white;
}
/* text */
.text {
  position: absolute;
  right: 0%;
  width: 0%;
  opacity: 0;
  color: white;
  font-size: 1.2em;
  font-weight: 600;
  transition-duration: .3s;
}
/* hover effect on button width */
.Btn:hover {
  width: 190px;
  border-radius: 40px;
  transition-duration: .3s;
}

.Btn:hover .sign {
  width: 30%;
  transition-duration: .3s;
  padding-left: 10px;
}
/* hover effect button's text */
.Btn:hover .text {
  opacity: 1;
  width: 70%;
  transition-duration: .3s;
  padding-right: 10px;
}
/* button click effect*/
.Btn:active {
  transform: translate(2px ,2px);
}
                            </style> -->
                            <!-- <a class="Btn" href="/Siswa/JurnalPKL/Absensi/{{$id}}">

                                <div class="sign"><svg viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path></svg></div>

                                <div class="text">Absen Datang</div>
                              </a> -->

                              <style>

.Btn {
 position: relative;
 font-size: 17px;

 text-decoration: none;
 padding: 1em 2.5em;
 display: inline-block;
 border-radius: 6em;
 transition: all .2s;
 border: none;
 font-family: inherit;
 font-weight: 500;
 color: black;
 background-color: #a5c9ff;
}

.Btn:hover {
 transform: translateY(-3px);
 box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.Btn:active {
 transform: translateY(-1px);
 box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
}

.Btn::after {
 content: "";
 display: inline-block;
 height: 100%;
 width: 100%;
 border-radius: 100px;
 position: absolute;
 top: 0;
 left: 0;
 z-index: -1;
 transition: all .4s;
}

.Btn::after {
 background-color: #a5c9ff;
}

.Btn:hover::after {
 transform: scaleX(1.4) scaleY(1.6);
 opacity: 0;
}
                              </style>
                    <a href="/Siswa/JurnalPKL/Absensi/{{$id}}" id="datang" class="Btn"><i class="fa-solid fa-door-open"></i> Absen datang
                    </a>




                            @else
                            @if($cek_sakit >= 1)
                            <p>Sudah izin ✔</p>
                            @else
                            <div class="p-0 my-4">
                                <a>Sudah absen hari ini ✔</a></br>
                           <a>Absen datang pada pukul: {{ $sudah_absen->waktu_datang }}</a></br>
                           <a>Absen pulang pada pukul: {{ $sudah_absen->waktu_pulang }}</a></br>
                            </div>

                           @endif
                            @endif
                            @elseif($absen != null)
                            <!-- <style>
                                .Btn {
   display: flex;
   align-items: center;
   justify-content: flex-start;
   width: 45px;
   height: 45px;
   border: none;
   border-radius: 50%;
   cursor: pointer;
   position: relative;
   overflow: hidden;
   transition-duration: .3s;
   box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.199);
   background-color: #198754;
 }

 /* plus sign */
 .sign {
   width: 100%;
   transition-duration: .3s;
   display: flex;
   align-items: center;
   justify-content: center;
 }

 .sign svg {
   width: 17px;
 }

 .sign svg path {
   fill: white;
 }
 /* text */
 .text {
   position: absolute;
   right: 0%;
   width: 0%;
   opacity: 0;
   color: white;
   font-size: 1.2em;
   font-weight: 600;
   transition-duration: .3s;
 }
 /* hover effect on button width */
 .Btn:hover {
   width: 190px;
   border-radius: 40px;
   transition-duration: .3s;
 }

 .Btn:hover .sign {
   width: 30%;
   transition-duration: .3s;
   padding-left: 10px;
 }
 /* hover effect button's text */
 .Btn:hover .text {
   opacity: 1;
   width: 70%;
   transition-duration: .3s;
   padding-right: 10px;
 }
 /* button click effect*/
 .Btn:active {
   transform: translate(2px ,2px);
 }
                             </style> -->
                             <!-- <a class="Btn" href="/Siswa/JurnalPKL/Absensi/{{ $jurnal->id }}/pulang/{{ $absen->id_hadir }}">

                                 <div class="sign"><svg viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path></svg></div>

                                 <div class="text">Absen Pulang</div>
                               </a> -->
                               <style>

                                .Btn {
                                 position: relative;
                                 font-size: 17px;

                                 text-decoration: none;
                                 padding: 1em 2.5em;
                                 display: inline-block;
                                 border-radius: 6em;
                                 transition: all .2s;
                                 border: none;
                                 font-family: inherit;
                                 font-weight: 500;
                                 color: black;
                                 background-color: #a5c9ff;
                                }

                                .Btn:hover {
                                 transform: translateY(-3px);
                                 box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
                                }

                                .Btn:active {
                                 transform: translateY(-1px);
                                 box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
                                }

                                .Btn::after {
                                 content: "";
                                 display: inline-block;
                                 height: 100%;
                                 width: 100%;
                                 border-radius: 100px;
                                 position: absolute;
                                 top: 0;
                                 left: 0;
                                 z-index: -1;
                                 transition: all .4s;
                                }

                                .Btn::after {
                                 background-color: #a5c9ff;
                                }

                                .Btn:hover::after {
                                 transform: scaleX(1.4) scaleY(1.6);
                                 opacity: 0;
                                }
                                                              </style>
                             <a class="Btn" id="pulang" href="/Siswa/JurnalPKL/Absensi/{{ $jurnal->id }}/pulang/{{ $absen->id_hadir }}"><i class="fa-solid fa-door-closed"></i> Absen pulang
                               </a>



                            @endif
                            @endif
                            @endif
                            @endif

                        </div>

                    </div>
                    <style>
                      .loading svg polyline {
fill: none;
stroke-width: 3;
stroke-linecap: round;
stroke-linejoin: round;
}

.loading svg polyline#back {
fill: none;
}

.loading svg polyline#front {
fill: none;
stroke: #7a7a7a;
stroke-dasharray: 48, 144;
stroke-dashoffset: 192;
animation: dash_682 1.4s linear infinite;
}

@keyframes dash_682 {
72.5% {
  opacity: 0;
}

to {
  stroke-dashoffset: 0;
}
}

.radio-input input {
  display: none;
}

.radio-input {
  --container_width: 250px;
  position: relative;
  display: flex;
  align-items: center;
  border-radius: 10px;
  background-color: #fff;
  color: #000000;
  width: var(--container_width);
  overflow: hidden;
  border: 1px solid rgba(53, 52, 52, 0.226);
}

.radio-input label {
  width: 100%;
  padding: 10px;
  cursor: pointer;
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1;
  font-weight: 600;
  letter-spacing: -1px;
  font-size: 14px;
}

.selection {
  display: none;
  position: absolute;
  height: 100%;
  width: calc(var(--container_width) / 2);
  z-index: 0;
  left: 0;
  top: 0;
  transition: 0.15s ease;
}

.radio-input label:has(input:checked) {
  color: #fff;
}

.radio-input label:has(input:checked) ~ .selection {
  background-color: rgb(11 117 223);
  display: inline-block;
}

.radio-input label:nth-child(1):has(input:checked) ~ .selection {
  transform: translateX(calc(var(--container_width) * 0 / 2));
}

.radio-input label:nth-child(2):has(input:checked) ~ .selection {
  transform: translateX(calc(var(--container_width) * 1 / 2));
}

                  </style>

              @if(auth()->guard('siswa')->check())
                  @if($cek_kegiatan < 1 && $cek_hadir_hari == 1)
                            {{-- <script>
                                function toTitleCase(str){
                            return str.toLowerCase().replace(/\b(\w)/g, function(match){
                            return match.toUpperCase();
                            });
                            }
                              function absensi(){
                                  var id = "{{ $jurnal->id }}";
                                  var userName = "{{ Auth::guard('siswa')->user()->nama_siswa }}";
                                  var name = toTitleCase(userName);
                                  Swal.fire({
                            title: 'Pengingat',
                            text: 'Halo ' + name + ', sekedar mengingatkan, kamu belum mengisi kegiatan harian kamu untuk hari ini!',
                            icon: 'info',
                            showCancelButton: true,
                            confirmButtonText: 'Isi Sekarang',
                            cancelButtonText: 'Isi Nanti',
                            customClass: {
                            confirmButton: 'isi-sekarang-button',
                            }
                            }).then((result) => {
                            if (result.isConfirmed) {
                            window.location.href = '/Siswa/JurnalPKL/harian/tambah/' + id ;
                            } else {

                            Swal.fire({
                            title: 'Isi kegiatan harian nanti',
                            text: 'Ingat untuk selalu mengisi kegiatan harian selama PKL berlangsung!',
                            icon: 'info',
                            confirmButtonText: 'Baik'
                            });
                            }
                            });
                              }

                              absensi();
                            </script>
                            --}}
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
                           </style>
                          <div class="pengingat mt-4">
                            <a class="pengingat1" href="/Siswa/JurnalPKL/harian/tambah/{{ $jurnal->id }}">
                             <p>Kegiatan harian</p>
                             <p class="small">Kamu belum menambahkan kegiatan harian untuk hari ini, klik ini untuk tambah sekarang</p>
                             <div class="go-corner" href="/Siswa/JurnalPKL/harian/tambah/{{ $jurnal->id }}">
                               <div class="go-arrow">
                                 →
                               </div>
                             </div>
                           </a>
                         </div>

                             @endif
                             @endif

                             <style>
  #chartAbsen {
    max-width: 250px;
    max-height: 250px;

  }
</style>
<div class="row justify-content-center mt-4">
  <div class="mt-4">
    <div class="text-center">
        <div class="d-flex justify-content-center align-items-center">
             <canvas id="chartAbsen"></canvas>
        </div>

      <p class="mt-3">
        Hadir: {{ $hadir > 0 ? $hadir . ' kali' : 'Tidak pernah' }} | Izin: {{ $izin > 0 ? $izin . ' kali' : 'Tidak pernah' }}. </br> Kurang Sesuai: {{ $kurang_sesuai > 0 ? $kurang_sesuai . ' kali' : 'Tidak pernah' }}.</br>
         Total: {{ $hadir + $izin }} kali. </br></br>

        Rata rata waktu datang {{ $averageTimeDatang }}. </br>
        Rata rata waktu pulang {{ $averageTimePulang }}. </br>
        <!--<i>"Kurang sesuai" adalah ketika waktu absen datang tidak sesuai dengan waktu absen pulang</i></br></br>-->


      </p>
      <script>

        const hadir = {{ $hadir ?? 0 }};
        const izin = {{ $izin ?? 0 }};
        const kurangSesuai = {{ $kurang_sesuai ?? 0 }};
        const total = hadir + izin + kurangSesuai;

        const data = {
          labels: ['Hadir', 'Izin', 'Kurang Sesuai'],
          datasets: [{
            data: [hadir, izin, kurangSesuai],
            backgroundColor: ['#4CAF50', '#FF9800', '#F44336'],
          }]
        };

        const options = {
          responsive: true,
          plugins: {
            legend: {
              position: 'top',
            },
            tooltip: {
              callbacks: {
                label: function(tooltipItem) {
                  let label = tooltipItem.label || '';
                  let value = tooltipItem.raw;
                  let percentage = total > 0 ? (value / total * 100).toFixed(2) : 0;


                  if (value === 0) {
                    label += ': Tidak pernah';
                  } else {
                    label += ': ' + value + ' kali (' + percentage + '%)';
                  }
                  return label;
                }
              }
            }
          }
        };


        const ctx = document.getElementById('chartAbsen').getContext('2d');
        new Chart(ctx, {
          type: 'doughnut',
          data: data,
          options: options
        });
      </script>
    </div>
  </div>
</div>



             <div class=" row p-2 mt-5">

                <div class="col-md-4">
                     <label for="columnSearch"><i class="fa-solid fa-magnifying-glass"></i> Cari berdasarkan tanggal:</label>
                    <input type="date" id="columnSearch" class="form-control" placeholder="Cari berdasarkan tanggal">
                </div>
                <div class="col-md-4"  style="margin-top: 22.5px;">
                    <button id="clearSearch" class="btn btn-secondary" style="display: none;"><i class="fa-solid fa-circle-stop"></i></button>
                </div>
            </div>
            <div class="text-center mt-4">
              <h6>Riwayat absen Di <i>'{{ $jurnal->nama_pkl }}'</i> berdasarkan</h6>

            </div>
            <div class="mb-2 text-center d-flex justify-content-center align-items-center">
<div class="radio-input">
  <label>
    <input name="toggle" id="datangRadio" checked type="radio" />
    <span><i class="fa-solid fa-door-open"></i> Datang</span>
  </label>
  <label>
<input name="toggle" id="pulangRadio" type="radio" @checked(session('pulang')) />

    <span><i class="fa-solid fa-door-closed"></i> Pulang</span>
  </label>
  <span class="selection"></span>
</div>


          </div>

                    <div class="table-responsive">
                        <?php
                        $no = 1;
                        ?>
                   <table class="table-striped table table-bordered align-middle text-center" id="table">
    <thead>
        <tr>

            <th rowspan="2" class="text-center">Tanggal</th>

            <th colspan="3" class="text-center datang">Datang</th>
            <th colspan="3" class="text-center pulang">Pulang</th>

            <th rowspan="2" class="text-center datang">Status datang</th>
            <th rowspan="2" class="text-center pulang">Status pulang</th>
            @if((auth()->check() && auth()->user()->hak_akses == '0') || auth()->guard('pendamping')->check())
    <th rowspan="2" class="text-center">Action</th>
@endif

        </tr>
        <tr>
            <th class="text-center datang">Foto</th>
            <th class="text-center datang">Waktu</th>
            <th class="text-center datang">Lokasi datang</th>
            <th class="text-center pulang">Foto</th>
            <th class="text-center pulang">Waktu</th>
            <th class="text-center pulang">Lokasi Pulang</th>
        </tr>
    </thead>
    <tbody>

        @foreach($surat as $u)
            <tr class="@if($u->waktu_pulang != null && $u->waktu_datang > $u->waktu_pulang) alert alert-danger @endif @if($u->validasi_datang == 3 || $u->validasi_datang == 5 || $u->validasi_pulang == 3 || $u->validasi_pulang == 5) alert alert danger @endif ">

              <?php
$date = Carbon::parse($u->tanggal);
$tanggal = $date->isoFormat('dddd, D MMMM');
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
<td class="text-center">{{ $tanggal }} </br> {{ $label }}</td>

                <td class="text-center datang">
                  <a href="{{ asset('storage/foto_siswa_datang/' . $u->foto_datang) }}" class="fancybox" data-fancybox="gallery" data-caption=" @if($u->izin != '1') Absen datang pada hari {{ $tanggal }} pukul {{$u->waktu_datang}} @else Izin pada hari {{ $tanggal }} pukul {{$u->waktu_datang}} @endif">
                    <img src="{{ asset('storage/foto_siswa_datang/' . $u->foto_datang) }}" style="height: 150px; width: 150px; image-rendering: pixelated;" alt="Foto Datang" title="Lihat Foto" loading="lazy" class="lazyload">
                </a>
                </td>
                <td class="text-center datang">{{ $u->waktu_datang }}</td>
                <td class="text-center datang">
                  @if($u->izin != '1')
                  <div style="position: relative; display: inline-block; width: 190px; height: 150px;">
                    <iframe allowfullscreen=""
                            src="https://www.google.com/maps?q={{ $u->latitude }},{{ $u->longitude }}&hl=es;z=14&output=embed"
                            frameborder="1" width="190" height="150" style="border:0;" loading="lazy"></iframe>

                    <div class="datangMap" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer;" tanggal="{{$tanggal}}" data-latitude="{{ $u->latitude }}" data-longitude="{{ $u->longitude }}"></div>
                </div>



                                  @else

                                 <div class="loading">
                <svg height="48px" width="64px">
                    <polyline id="back" points="0.157 23.954, 14 23.954, 21.843 48, 43 0, 50 24, 64 24"></polyline>
                  <polyline id="front" points="0.157 23.954, 14 23.954, 21.843 48, 43 0, 50 24, 64 24"></polyline>
                </svg>
              </div>
                                  @endif

                </td>
                <td class="text-center pulang">
                  @if($u->izin != '1')
                  @if ($u->foto_pulang)
                      <a href="{{ asset('storage/foto_siswa_pulang/' . $u->foto_pulang) }}" class="fancybox" data-fancybox="gallery" data-caption="Absen pulang pada hari {{ $tanggal }} pukul {{$u->waktu_pulang}}">
                          <img src="{{ asset('storage/foto_siswa_pulang/' . $u->foto_pulang) }}" style="height: 150px; width: 150px; image-rendering: pixelated;" alt="Foto Pulang" title="Lihat Foto" loading="lazy" class="lazyload">
                      </a>
                  @else

                                      <div class="m-3 d-flex justify-content-center align-items-center">
                  <div class="lines-loader m-3">
  <div class="line"></div>
  <div class="line"></div>
  <div class="line"></div>
  <div class="line"></div>
  <div class="line"></div>
</div>
</div>
                  @endif
                  @else
                  <a href="{{ asset('storage/foto_siswa_datang/' . $u->foto_datang) }}" class="fancybox" data-fancybox="gallery" data-caption=" @if($u->izin != '1') Absen datang pada hari {{ $tanggal }} pukul {{$u->waktu_datang}} @else Izin pada hari {{ $tanggal }} pukul {{$u->waktu_datang}} @endif">
                    <img src="{{ asset('storage/foto_siswa_datang/' . $u->foto_datang) }}" style="height: 150px; width: 150px; image-rendering: pixelated;" alt="Foto Datang" title="Lihat Foto" loading="lazy" class="lazyload">
                </a>
                  @endif

                </td>
                <td class="text-center pulang">@if($u->izin != '1')@if($u->waktu_pulang != null) {{$u->waktu_pulang}} @else

                                  <div class="m-3 d-flex justify-content-center align-items-center">
                  <div class="lines-loader m-3">
  <div class="line"></div>
  <div class="line"></div>
  <div class="line"></div>
  <div class="line"></div>
  <div class="line"></div>
</div>
</div>
                    @endif
                    @else
                    <div class="loading">
  <svg height="48px" width="64px">
      <polyline id="back" points="0.157 23.954, 14 23.954, 21.843 48, 43 0, 50 24, 64 24"></polyline>
    <polyline id="front" points="0.157 23.954, 14 23.954, 21.843 48, 43 0, 50 24, 64 24"></polyline>
  </svg>
</div> @endif</td>
                <td class="text-center pulang">

                  @if($u->izin == '1')
                  <div class="loading">
 <svg height="48px" width="64px">
     <polyline id="back" points="0.157 23.954, 14 23.954, 21.843 48, 43 0, 50 24, 64 24"></polyline>
   <polyline id="front" points="0.157 23.954, 14 23.954, 21.843 48, 43 0, 50 24, 64 24"></polyline>
 </svg>
</div>
                   @else
                   @if ($u->latitude_pulang && $u->longitude_pulang)
                       {{-- <iframe src="https://www.google.com/maps?q={{ $u->latitude_pulang }},{{ $u->longitude_pulang }}&hl=es;z=14&output=embed" frameborder="0"></iframe> --}}
                       <div style="position: relative; display: inline-block; width: 190px; height: 150px;">
                         <iframe allowfullscreen=""
                                 src="https://www.google.com/maps?q={{ $u->latitude_pulang }},{{ $u->longitude_pulang }}&hl=es;z=14&output=embed"
                                 frameborder="1" width="190" height="150" style="border:0;" loading="lazy"></iframe>

                         <div class="pulangMap" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer;" tanggal="{{$tanggal}}" data-latitude="{{ $u->latitude_pulang }}" data-longitude="{{ $u->longitude_pulang }}"></div>
                     </div>



                   @else
                   <style>

.lines-loader {
  display: flex;
  align-items: center;
  gap: 5px;
}

.line {
  width: 10px;
  height: 40px;
  background-color: #868686;
  animation: bounce 1.5s infinite ease-in-out;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
}


.line:nth-child(2) {
  animation-delay: 0.3s;
}

.line:nth-child(3) {
  animation-delay: 0.6s;
}

.line:nth-child(5) {
  animation-delay: 1.2s;
}


@keyframes bounce {
  0%,
  20%,
  50%,
  80%,
  100% {
    transform: translateY(0);
  }
  40% {
    transform: translateY(-30px);
  }
  60% {
    transform: translateY(-15px);
  }
}


                   </style>
                  <div class="m-3 d-flex justify-content-center align-items-center">
                 <div class="lines-loader m-3">
  <div class="line"></div>
  <div class="line"></div>
  <div class="line"></div>
  <div class="line"></div>
  <div class="line"></div>
</div>
</div>
                   @endif
                   @endif





                  </td>
                  <td class="text-center datang">
                     @if($u->validasi_datang !== null)
                      @if($u->validasi_datang === 0)
                        <p class="text-success">Lokasi & waktu absen sesuai</p>
                      @elseif($u->validasi_datang == 1)
                        <p class="text-warning">Waktu absen tidak sesuai & lokasi absen sesuai</p>
                      @elseif($u->validasi_datang == 2)
                        <p class="text-warning"> Waktu absen sesuai & lokasi absen tidak sesuai</p>
                        @elseif($u->validasi_datang == 3)
                        <p class="text-danger">Waktu & lokasi absen tidak sesuai</p>
                        @elseif($u->validasi_datang == 4)
                        <p class="text-primary">Diizinkan</p>
                        @elseif($u->validasi_datang == 5)
                        <p class="text-danger">Tidak diizinkan</p>
                        @endif
                     @else
                      Belum di validasi oleh <a href="#" class="pendamping">guru pendamping</a>
                     @endif
                  </td>
                  <td class="text-center pulang">
                  @if($u->validasi_pulang !== null)
                  @if($u->validasi_pulang === 0)
                        <p class="text-success">Lokasi & waktu absen sesuai</p>
                      @elseif($u->validasi_pulang == 1)
                        <p class="text-warning">Waktu absen tidak sesuai & lokasi absen sesuai</p>
                      @elseif($u->validasi_pulang == 2)
                        <p class="text-warning"> Waktu absen sesuai & lokasi absen tidak sesuai</p>
                        @elseif($u->validasi_pulang == 3)
                        <p class="text-danger">Waktu & lokasi absen tidak sesuai</p>
                        @elseif($u->validasi_pulang == 4)
                        <p class="text-primary">Diizinkan</p>
                        @elseif($u->validasi_pulang == 5)
                        <p class="text-danger">Tidak diizinkan</p>
                        @endif
                     @else
                      Belum di validasi oleh <a href="#" class="pendamping" >guru pendamping</a>
                     @endif

                     <script>
                     document.querySelectorAll('.pendamping').forEach(element => {
    element.addEventListener('click', () => {
        Swal.fire({
            title: "{{ $jurnal->nama }}",
            confirmButtonText: 'Oke'
        });
    });
});

                     </script>
                  </td>
                @if(auth()->check() && auth()->user()->hak_akses == '0')
                <td class="text-center">

                        <form id="delete-form-{{ $u->id_hadir }}" action="{{ route('hadir.destroy', $u->id_hadir) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" id="delete-btn-{{ $u->id_hadir }}" style="display: none;">Hapus</button>
                        </form>
                        <a href="#" class="btn btn-danger delete-user" data-id="{{ $u->id_hadir }}">Hapus</a>
                    </td>
                    @endif

                    @if(auth()->guard('pendamping')->check())
                    <style>
                      /* From Uiverse.io by AmogusH32860 */
.custom-button {
  --button-radius: 0.3em;
  --button-color: #ffffff;
  --button-outline-color: #cccccc;
  --button-hover-color: #eeeeee;
  --button-text-color: #333333;

  font-size: 1em;
  font-weight: bold;
  border: none;
  cursor: pointer;
  border-radius: var(--button-radius);
  background: var(--button-outline-color);
  position: relative;
  padding: 0;
  outline: none;
  perspective: 1000px;
}

.custom-button .button-top {
  display: block;
  box-sizing: border-box;
  border: 0.125em solid var(--button-outline-color);
  border-radius: var(--button-radius);
  padding: 0.75em 1.5em;
  background: var(--button-color);
  color: var(--button-text-color);
  box-shadow: 0 0.5em 0.75em rgba(0, 0, 0, 0.2);
  transform: translateY(-0.2em);
  transition:
    transform 0.2s ease,
    box-shadow 0.2s ease;
}

.custom-button:hover .button-top {
  transform: translateY(-0.5em) rotateX(20deg);
}

.custom-button:active .button-top {
  transform: translateY(-0.1em) rotateX(5deg);
  box-shadow: 0 0.25em 0.5em rgba(0, 0, 0, 0.15);
  transition:
    transform 0.1s ease,
    box-shadow 0.1s ease;
}

                    </style>
                    <td class="text-center">
                        @if($u->waktu_pulang == null)
                        <p>Menunggu absen pulang...</p>
                        @else
       @if($u->validasi_datang === null && $u->validasi_pulang === null)
    <button class="custom-button validate-button" id="validate-button" validasi-id="{{ $u->id_hadir }}" tanggal="{{ $tanggal }}" izin="{{$u->izin}}">
        <span class="button-top"><i class="fas fa-calendar-check"></i></span>
    </button>
    @else
        <i class="fas fa-check"></i>

@endif
@endif

                    </td>
                    <script>
document.querySelectorAll('.validate-button').forEach(button => {
    button.addEventListener('click', function () {
        const idHadir = this.getAttribute('validasi-id');
        const tanggal = this.getAttribute('tanggal');
        const izin = this.getAttribute('izin');

        let validasiHtml = `
            <div style="text-align: left;">
                <!-- Select untuk Absen Datang -->
                <label for="validasi_datang_${idHadir}" class="form-label">Validasi Absen Datang:</label>
                <select class="form-select mb-3" id="validasi_datang_${idHadir}">
                    <option value="0">Lokasi & waktu absen sesuai</option>
                    <option value="1">Waktu absen tidak sesuai & lokasi absen sesuai</option>
                    <option value="2">Waktu absen sesuai & lokasi absen tidak sesuai</option>
                    <option value="3">Waktu & lokasi absen tidak sesuai</option>
                </select>
                <!-- Select untuk Absen Pulang -->
                <label for="validasi_pulang_${idHadir}" class="form-label">Validasi Absen Pulang:</label>
                <select class="form-select" id="validasi_pulang_${idHadir}">
                    <option value="0">Lokasi & waktu absen sesuai</option>
                    <option value="1">Waktu absen tidak sesuai & lokasi absen sesuai</option>
                    <option value="2">Waktu absen sesuai & lokasi absen tidak sesuai</option>
                    <option value="3">Waktu & lokasi absen tidak sesuai</option>
                </select>
            </div>
        `;


        if (izin == 1) {
            validasiHtml = `
                <div style="text-align: left;">
                    <!-- Select untuk Absen Datang -->
                    <label for="validasi_datang_${idHadir}" class="form-label">Validasi Izin:</label>
                    <select class="form-select mb-3" id="validasi_datang_${idHadir}">
                        <option value="4">Diizinkan</option>
                        <option value="5">Tidak diizinkan</option>
                    </select>
                    <!-- Hanya validasi datang yang dipilih, pulang tidak perlu -->
                    <input type="hidden" id="validasi_pulang_${idHadir}" value="4"> <!-- Set nilai pulang otomatis sama dengan datang -->
                </div>
            `;
        }

        Swal.fire({
            title: izin == 1 ? 'Validasi Izin pada ' + tanggal : 'Validasi Absensi pada ' + tanggal,
            html: validasiHtml,
            showCancelButton: true,
            confirmButtonText: 'Validasikan',
            cancelButtonText: 'Batal',
            preConfirm: () => {
                const validasiDatang = document.getElementById(`validasi_datang_${idHadir}`).value;
                const validasiPulang = document.getElementById(`validasi_pulang_${idHadir}`).value;


                if (izin == 1) {
                    return { validasiDatang, validasiPulang: validasiDatang };
                }

                return { validasiDatang, validasiPulang };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('/validasi-absensi', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id_hadir: idHadir,
                        validasi_datang: result.value.validasiDatang,
                        validasi_pulang: result.value.validasiPulang
                    })
                }).then(response => response.json())
                  .then(data => {
                      if (data.success) {
                          Swal.fire('Berhasil!', 'Data absensi berhasil divalidasi.', 'success');
                          window.location.reload();
                      } else {
                          Swal.fire('Gagal!', 'Terjadi kesalahan saat memvalidasi data.', 'error');
                      }
                  });
            }
        });
    });
});

</script>



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
<script src="{{ asset('aset/js/AmbilLokasi.js') }}">


</script>
<script>
 document.addEventListener('DOMContentLoaded', function() {

    $.fn.dataTable.ext.type.order['date-pre'] = function (data) {

        return new Date(data).getTime();
    };

    var table = $('#table').DataTable({
        scrollCollapse: true,
        scrollY: '70vh',
        paging: true,
        pageLength: 10,
        lengthMenu: [10, 25, 50, 75, 100],
        deferRender: true,
         responsive: true,
        columnDefs: [
            {
                targets: 0,
                render: function(data, type, row) {

                    return data;
                },
                type: 'date'
            }
        ],
        order: []
    });

function toggleView() {
    const isDatangSelected = $('#datangRadio').prop('checked');
    var columnDatang = table.columns('.datang');
    var columnPulang = table.columns('.pulang');

    columnDatang.visible(isDatangSelected);
    columnPulang.visible(!isDatangSelected);


    table.columns(0).visible(true);


    table.columns.adjust().draw();
}


    $('#datangRadio, #pulangRadio').on('change', toggleView);
    toggleView();

$('#columnSearch').on('change', function() {
    var searchTerm = this.value;
    console.log('Search term:', searchTerm);

    var formattedDate = new Date(searchTerm).toLocaleDateString('id-ID', { day: 'numeric', month: 'long' });
    // console.log('Formatted date:', formattedDate);

    table.column(0).search(formattedDate, true, false).draw();
     $('#clearSearch').show();
});



    $('#clearSearch').on('click', function() {
        $('#columnSearch').val('');
        table.column(0).search('').draw();
        $(this).hide();
    });

    $('#dt-search-0').hide();
    $('label[for="dt-search-0"]').hide();
    $('#columnSearch').attr('type', 'date').attr('placeholder', 'Cari berdasarkan tanggal');

    $(".fancybox").fancybox();
});

  </script>




<script>
    document.querySelectorAll('.delete-user').forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault();

            var Id = this.getAttribute('data-id');
            Swal.fire({
                icon: 'warning',
                title: 'Konfirmasi Hapus',
                text: 'Yakin akan dihapus?',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + Id).submit();
                }
            });
        });
    });
</script>

@if(auth()->guard('siswa')->check())
@if($cek_absen->start <= $cek_hari && $cek_absen->end >= $cek_hari)
@if(!session('berhasil'))
@if($absen != null)
<?php
$jam_cek = '15:30';
$tanggal_absen = Carbon::parse($absen->tanggal);
$now = Carbon::now();
?>
@if($now->greaterThan($tanggal_absen->setTimeFromTimeString($jam_cek)) || !$now->isSameDay($tanggal_absen))
<script>
   function toTitleCase(str) {
    return str.toLowerCase().replace(/\b(\w)/g, function(match) {
        return match.toUpperCase();
    });
}

function absen() {
    var id = "{{ $jurnal->id }}";
    var userName = "{{ Auth::guard('siswa')->user()->nama_siswa }}";
    var name = toTitleCase(userName);

    var pulang = document.getElementById('pulang');


    const tour = new Shepherd.Tour({
        defaultStepOptions: {
            cancelIcon: {
                enabled: true
            },
            classes: 'custom-class-name',
            scrollTo: { behavior: 'smooth', block: 'center' }
        }
    });


    tour.addStep({
        title: "Absen Pulang",
        text: 'kamu belum absen pulang',
        attachTo: {
            element: pulang,
            on: 'bottom'
        },

    });


    tour.start();



}


absen();

</script>
         @endif
         @endif
@if($cek_hadir_hari < 1 && $absen == null)



<script>
function toTitleCase(str) {
    return str.toLowerCase().replace(/\b(\w)/g, function(match) {
        return match.toUpperCase();
    });
}

function absensi() {
    var id = "{{ $jurnal->id }}";
    var userName = "{{ Auth::guard('siswa')->user()->nama_siswa }}";
    var name = toTitleCase(userName);

    var datang = document.getElementById('datang');


    const tour = new Shepherd.Tour({
        defaultStepOptions: {
            cancelIcon: {
                enabled: true
            },
            classes: 'custom-class-name',
            scrollTo: { behavior: 'smooth', block: 'center' }
        }
    });

    // Define the steps
    tour.addStep({
        title: "Absen Datang",
        text: 'kamu belum absen datang',
        attachTo: {
            element: datang,
            on: 'bottom'
        },

    });


    tour.start();



}


absensi();

</script>
 @endif
 @endif


 @endif
 @endif

 @if(auth()->guard('siswa')->check())

 {{-- <script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script>
 Notifikasi tidak perlu jika di local
<script>
  window.OneSignalDeferred = window.OneSignalDeferred || [];
  OneSignalDeferred.push(async function(OneSignal) {
    await OneSignal.init({
      appId: "08c077e5-bbaa-43cd-9eb4-8fdf74e6cdab",
      safari_web_id: "web.onesignal.auto.18c6dc90-7633-4ce6-8875-ae2763214094",
      notifyButton: {
        enable: true,
      },
    });
  });
</script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>

 @endif
@endsection
