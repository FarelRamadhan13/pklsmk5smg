@extends('layout.app')
@section('content')
@php
use Carbon\Carbon;
@endphp
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@lottiefiles/lottie-player@1.6.3/dist/lottie-player.min.js"></script>
@if(session('login'))
<style>
   #welcome-screen {
        z-index: 9999;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: white;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #welcome-message {
        z-index: 9999;
        position: relative;
    }

    #main-content {
        opacity: 0;
        transform: scale(0.95);
        filter: blur(5px);
    }
</style>
<div id="welcome-screen" class="d-flex justify-content-center align-items-center position-fixed start-0 w-100 h-100 bg-white">
    <div class="text-center">
        <img id="profile-picture" 
             src="{{asset('storage/foto_profile_siswa/' . auth()->guard('siswa')->user()->foto_siswa)}}" 
             alt="Foto Profil" 
             class="rounded-circle mb-3 d-none" 
             style="width: 150px; height: 150px; object-fit: cover; opacity: 0;">

        <p id="welcome-message" class="fw-bold text-muted fs-4 mb-0">
          <span id="welcome" class=""></span> <span id="user-name" class="text-primary d-none"></span>
        </p>
    </div>
</div>
@endif
  

<div class="container @if(session('login')) d-none @endif" id="main-content">
    <div class="justify-content-center d-flex">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center py-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="mb-0">Profile</h1>
                    </div>
                </div>
                <div class="card-body p-5">
                    @if(session('berhasil'))
                    <script>
                        var pesan = "{{ session('berhasil') }}";
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'success',
                                title: pesan,
                                showConfirmButton: false,
                                timer: 3000 
                            });
                        });
                    </script>
                    @endif

                 

                    @if(session('gagal'))
                    
                    <script>
                        var pesan = "{{ session('gagal') }}";
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: pesan
                        });
                    </script>
                    @endif
                    <style>
                        .shiny-image {
                            position: relative;
                            display: inline-block;
                            overflow: hidden;
                        }
                
                        .shiny-image img {
                            width: 10rem;
                            height: 10rem;
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
    width: 2.5rem;
    height: 2.5rem;
    bottom: -8vh;
    top: 6vh;
    left: -2vh;
    background-color: rgb(255, 255, 255, 0.9);
border-radius: 50%; 
}
a.text-bawah {
            position: relative;
            text-decoration: none;
        }
        
        a.text-bawah::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            display: block;
            margin-top: 5px;
            left: 0;
            background: #0033ff;
            transition: width 0.3s ease, left 0.3s ease;
        }

        a.text-bawah:hover::after {
            width: 100%;
            left: 0;
        }
        .table-row {
            opacity: 0;
            transform: translateY(20px);
        }
                    </style>


                    <div class="container" >
                        <div class="mx-auto d-flex justify-content-center align-items-center position-relative">
                            <div class="shiny-image">
                                <a href="{{ asset('storage/foto_profile_siswa/' . auth()->guard('siswa')->user()->foto_siswa) }}" data-fancybox="gallery" data-caption="Foto Profil {{auth()->guard('siswa')->user()->nama_siswa}} @if(auth()->guard('siswa')->user()->foto_siswa == 'default.png') (kosong) @endif">
                                    <img src="{{ asset('storage/foto_profile_siswa/' . auth()->guard('siswa')->user()->foto_siswa) }}" style="width: 15.5vh; height: 15.5vh;" alt="Foto Profil {{auth()->guard('siswa')->user()->nama_siswa}}" class="rounded-circle" id="profileImage">
                                </a>
                            </div>
                            <a href="/Siswa/gantiFoto" class="text-decoration-none position-relative text-light" id="editLink">
                                <span class="position-absolute translate-middle shadow" id="editIcon">
                                    <i class="fas fa-pencil-alt text-secondary"></i>
                                </span>
                            </a>
                        </div>
                        <div class="d-flex justify-content-center align-items-center mt-3">
                            <a href="/Siswa/gantiPassword" class="text-decoration-none text-bawah"><i class="fas fa-key"></i> Ubah Password</a>
                        </div>
                        <style>
                            .depan {
                             position: relative;
                             font-size: 17px;
                             text-decoration: none;
                             padding: 0.5em 1.5em;
                             display: flex;
                             flex-direction: column;
                             justify-content: center; /* Center content on the Y-axis */
                             align-items: flex-start; /* Align text to the left */
                             border-radius: 1em;
                             transition: all .2s;
                             border: none;
                             font-family: inherit;
                             font-weight: 500;
                             color: black;
                             background-color: rgb(225, 225, 225);
                             min-height: 150px; /* Set a minimum height to ensure equal height */
                            }
                            
                            .depan:hover {
                             transform: translateY(-3px);
                             box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
                            }
                            
                            .depan:active {
                             transform: translateY(-1px);
                             box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
                            }
                            
                            .depan::after {
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
                            
                            .depan::after {
                             background-color: #fff;
                            }
                            
                            .depan:hover::after {
                             transform: scaleX(1.4) scaleY(1.6);
                             opacity: 0;
                            }
                            
                            .depan .title {
                             font-size: 24px; /* Larger font for "Absen" */
                             font-weight: bold;
                            }
                            
                            .depan .status {
                             font-size: 12px; /* Smaller font for status text */
                             color: grey;
                             margin: 2px 0; /* Reduce margin to bring the paragraphs closer */
                            }
                            </style>
                        @if($jurnal != null)
                        
                        
                       
                            <div class="mt-4 row justify-content-center align-items-center">
                                <div class="col-md-6 mt-4">
                                    <a href="/Siswa/JurnalPKL/Absen/{{$jurnal->id}}" class="depan text-start">
                                        <span class="title"><i class="fa-solid fa-door-open"></i> Absen</span>
                                        @if($cek_sakit == 0)
                                        <p class="status text-decoration-none">Absen Datang hari ini: @if($cek_hadir < 1) - @else @if($cek_absen != null) {{ $cek_absen->waktu_datang }} @else - @endif @endif</p>
                                        <p class="status text-decoration-none">Absen Pulang hari ini: @if($absen == null && $cek_hadir == 1) @if($cek_absen != null) {{ $cek_absen->waktu_pulang }} @else - @endif @else - @endif</p>
                                        @else
                                        <p class="status text-decoration-none">Absen: Izin</p>
                                        @endif
                                    </a>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <a href="/Siswa/JurnalPKL/harian/{{$jurnal->id}}" class="depan text-start">
                                        <span class="title"><i class="fa-solid fa-briefcase"></i> Kegiatan harian</span>
                                       
                                    </a>
                                </div>
                            </div>
                          
                            
                            
                        @else
                        @if($cek_prakerin >= 1)
                        <div class="mt-4 row justify-content-center align-items-center">
                            <div class="col-md-6 mt-4">
                                <a href="/Siswa/JurnalPKL" class="depan text-start">
                                    <span class="title"><i class="fas fa-address-book"></i> Dapatkan Jurnal</span>
                                    <p class="status text-decoration-none">Kamu sudah terdaftar di data prakerin</p>   
                                </a>
                            </div>
                        </div>
                        @endif
                        @endif
                        
                        <table class="table mt-5">
                            <tbody>
                                <tr class="table-row">
                                    <th scope="row">NIS</th>
                                    <td>:</td>
                                    <td>{{auth()->guard('siswa')->user()->nisn}}</td>
                                </tr>
                                <tr class="table-row">
                                    <th scope="row">Nama</th>
                                    <td>:</td>
                                    <td>{{auth()->guard('siswa')->user()->nama_siswa}}</td>
                                </tr>
                                <tr class="table-row">
                                    <th scope="row">Alamat</th>
                                    <td>:</td>
                                    <td>{{auth()->guard('siswa')->user()->alamat}}</td>
                                </tr>
                                <tr class="table-row">
                                    <th scope="row">Nomor telephone</th>
                                    <td>:</td>
                                    <td>{{auth()->guard('siswa')->user()->telp}}</td>
                                </tr>
                                <tr class="table-row">
                                    <th scope="row">Kelas</th>
                                    <td>:</td>
                                    <td>{{auth()->guard('siswa')->user()->kelas}}</td>
                                </tr>
                                <tr class="table-row">
                                    <th scope="row">Tahun</th>
                                    <td>:</td>
                                    <td>{{auth()->guard('siswa')->user()->tahun}}</td>
                                </tr>
                                <tr class="table-row">
                                    <th scope="row">Jurusan</th>
                                    <td>:</td>
                                    <td>{{$jurusan->nama_jurusan}}</td>
                                </tr>
                                <tr class="table-row">
                                    <th scope="row">Golongan darah</th>
                                    <td>:</td>
                                    <td>{{auth()->guard('siswa')->user()->golongan_darah ?? '-'}}</td>
                                </tr>
                                <tr class="table-row">
                                    <th scope="row">Nama Orang tua / wali</th>
                                    <td>:</td>
                                    <td>{{auth()->guard('siswa')->user()->nama_orang_tua_wali ?? '-'}}</td>
                                </tr>
                                <tr class="table-row">
                                    <th scope="row">Tempat, tanggal lahir</th>
                                    <td>:</td>
                                    <td>{{auth()->guard('siswa')->user()->tempat_tanggal_lahir ?? '-'}}</td>
                                </tr>
                                <tr class="table-row">
                                    <th scope="row">Catatan kesehatan</th>
                                    <td>:</td>
                                    <td>{{auth()->guard('siswa')->user()->catatan_kesehatan ?? '-'}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
<style>
 .edit-button {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background-color: rgb(20, 20, 20);
  border: none;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.164);
  cursor: pointer;
  transition-duration: 0.3s;
  overflow: hidden;
  position: relative;
  text-decoration: none !important;
}

.edit-svgIcon {
  width: 17px;
  transition-duration: 0.3s;
}

.edit-svgIcon path {
  fill: white;
}

.edit-button:hover {
  width: 120px;
  border-radius: 50px;
  transition-duration: 0.3s;
  background-color: rgb(149, 149, 149);
  align-items: center;
}

.edit-button:hover .edit-svgIcon {
  width: 20px;
  transition-duration: 0.3s;
  transform: translateY(60%);
  -webkit-transform: rotate(360deg);
  -moz-transform: rotate(360deg);
  -o-transform: rotate(360deg);
  -ms-transform: rotate(360deg);
  transform: rotate(360deg);
}

.edit-button::before {
  display: none;
  content: "Ubah";
  color: white;
  transition-duration: 0.3s;
  font-size: 2px;
}

.edit-button:hover::before {
  display: block;
  padding-right: 10px;
  font-size: 13px;
  opacity: 1;
  transform: translateY(0px);
  transition-duration: 0.3s;
}

</style>
  
                    <div class="d-flex justify-content-end">
                        <a class="edit-button mt-3" href="/Siswa/ubah">
                            <svg class="edit-svgIcon" viewBox="0 0 512 512">
                                              <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path>
                                            </svg>
                                        </a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('login'))
<script>
document.addEventListener("DOMContentLoaded", () => {
    const fullName = "{{ auth()->guard('siswa')->user()->nama_siswa }}";
    const sixChars = fullName.slice(0, 6).toLowerCase();
    const formattedName = sixChars.charAt(0).toUpperCase() + sixChars.slice(1) + (fullName.length > 6 ? "..." : "");

    const welcomeMessage = document.getElementById("welcome-message");
    const userName = document.getElementById("user-name");
    const welcomeScreen = document.getElementById("welcome-screen");
    const mainContent = document.getElementById("main-content");
    const profilePicture = document.getElementById("profile-picture");
    const welcome = document.getElementById("welcome");

    const welcomeMessages = [
       "Selamat datang, ",
        "Hai ",
        "Halo ",
        "Salam, ",
        "Selamat datang kembali, ",
        "Tetap semangat, ",
        "Semangat selalu, ",
        "Jangan lupa tersenyum, ",
        "Senang bertemu lagi, "
    ];

    const randomWelcomeMessage = welcomeMessages[Math.floor(Math.random() * welcomeMessages.length)];

    userName.textContent = formattedName;   
    welcome.textContent = randomWelcomeMessage;

    welcomeMessage.style.opacity = 0;

    anime({
        targets: profilePicture,
        opacity: [0, 1],
        translateY: [-50, 0],
        duration: 2000,
        easing: "easeOutExpo",
        begin: () => {
            profilePicture.classList.remove("d-none");
        },
        complete: () => {
            anime({
                targets: welcomeMessage,
                opacity: [0, 1],
                translateX: [-100, 0], 
                duration: 2000,
                easing: "easeOutExpo",
                complete: () => {
                    userName.classList.remove("d-none");
                    anime({
                        targets: userName,
                        opacity: [0, 1],
                        translateX: [100, 0],
                        duration: 2000,
                        easing: "easeOutExpo",
                    });
                },
            });
        },
    });

    setTimeout(() => {
    anime({
        targets: welcomeScreen,
        opacity: [1, 0],
        scale: [1, 1.2],
        duration: 1000,
        easing: "easeInOutQuad",
        complete: () => {
         
            welcomeScreen.style.pointerEvents = "none"; 
            welcomeScreen.style.display = "none"; 

           
            mainContent.classList.remove("d-none");

          
            anime({
                targets: mainContent,
                opacity: [0, 1],
                scale: [0.95, 1],
                filter: ['blur(5px)', 'blur(0)'],
                duration: 1500,
                easing: "easeOutExpo",
            });
            },
        });
    }, 6000);
});
</script>
@endif

<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
<script>
  document['addEventListener']('DOMContentLoaded',function(){Fancybox['bind']('[data-fancybox]',{});}),document['addEventListener']('DOMContentLoaded',()=>{anime({'targets':'.table-row','opacity':[0x0,0x1],'translateY':[0x14,0x0],'easing':'easeOutExpo','duration':0x3e8,'delay':anime['stagger'](0x64)});}),document['addEventListener']('DOMContentLoaded',()=>{anime({'targets':'#profileImage,\x20#editIcon','opacity':[0x0,0x1],'easing':'easeInOutQuad','duration':0x3e8,'delay':anime['stagger'](0xc8)});const _0xa66ee8=document['getElementById']('profileImage');_0xa66ee8['addEventListener']('mouseenter',()=>{anime({'targets':_0xa66ee8,'scale':1.1,'duration':0xc8,'easing':'easeInOutQuad'});}),_0xa66ee8['addEventListener']('mouseleave',()=>{anime({'targets':_0xa66ee8,'scale':0x1,'duration':0xc8,'easing':'easeInOutQuad'});});const _0xbaad79=document['getElementById']('editIcon');_0xbaad79['addEventListener']('mouseenter',()=>{anime({'targets':_0xbaad79,'scale':1.2,'duration':0x1f4,'easing':'easeInOutQuad'});}),_0xbaad79['addEventListener']('mouseleave',()=>{anime({'targets':_0xbaad79,'scale':0x1,'duration':0x1f4,'easing':'easeInOutQuad'});});});
</script>

@endsection