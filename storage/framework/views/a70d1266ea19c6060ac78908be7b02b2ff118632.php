<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="google" content="notranslate">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
     <meta name="keywords" content="smk negeri 5 semarang, magang, pkl, prakerin">
      <meta name="description" content="smk negeri 5 semarang">
      <meta name="distribution" content="Global">
       <meta name="author" content="Farras Syuja">
	<meta name="rating" content="General">
    <link rel="canonical" href="https://magang.smkn5semarang.sch.id/login">
    <title><?php echo e($title); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('/fontawesome/css/all.min.css')); ?>">
    <meta name="category" content="Admission, Education">
    <script src="<?php echo e(asset('aset/jquery-3.7.1.min.js')); ?>"></script>
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "EducationalOrganization",
          "name": "SMK Negeri 5 Semarang",
          "url": "https://magang.smkn5semarang.sch.id/",
          "logo": "https://magang.smkn5semarang.sch.id/logo/logo.jpeg",
          "sameAs": [
            "https://www.instagram.com/_syuja._/?next=%2F&hl=id",
            "https://www.facebook.com/SMKNegeri5Semarang/",
            "https://www.instagram.com/sm3k_id/",
            "https://www.youtube.com/@smknegeri5semarang-official905",
            "https://x.com/smkn5semarang"
          ],
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "Jalan Dr. Cipto No. 121, Kec. Semarang Timur, Kota Semarang",
            "addressLocality": "Semarang",
            "addressRegion": "Jawa Tengah",
            "postalCode": "50124",
            "addressCountry": "ID"
          },
          "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "024-8416335",
            "contactType": "Layanan Pelanggan"
          }
        }
        </script>
        
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>


    <script src="<?php echo e(asset('aset/DataTables/dataTables.js')); ?>"></script>
    <script src="<?php echo e(asset('aset/DataTables/dataTables.bootstrap5.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('aset/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('aset/DataTables/DataTablesBootstrap.css')); ?>">
    <script src="<?php echo e(asset('aset/bootstrap.bundle.min.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('aset/select2/select2.css')); ?>">
    <script src="<?php echo e(asset('aset/select2/select2.min.js')); ?>"></script>
    <link rel="shortcut icon" href="<?php echo e(asset('logo/logo.jpeg')); ?>" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

  <script src="https://cdn.jsdelivr.net/npm/animejs@3.2.1/lib/anime.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="<?php echo e(asset('aset/css/custom-bootstrap.css')); ?>">



</head>

<style>
    .custom-offcanvas-width {
  max-width: 230px;
}

.card{box-shadow:rgba(0,0,0,.2) 0pt .1875in .520833333in -7.5pt;}input[type="password"]::-webkit-contacts-auto-fill-button{display:none !important;}input[type="password"]::-webkit-contacts-auto-fill-button{visibility:hidden !important;}input[type="password"]::-webkit-contacts-auto-fill-button{pointer-events:none !important;}html{scroll-behavior:smooth;}input[type="password"]::-webkit-contacts-auto-fill-button{position:absolute !important;}html{font-family:"Segoe UI",Tahoma,Geneva,Verdana,sans-serif;}input[type="password"]::-webkit-contacts-auto-fill-button{right:0 !important;}input[type="password"]::-webkit-credentials-auto-fill-button{display:none !important;}input[type="password"]::-webkit-credentials-auto-fill-button{visibility:hidden !important;}input[type="password"]::-webkit-credentials-auto-fill-button{pointer-events:none !important;}input[type="password"]::-webkit-credentials-auto-fill-button{position:absolute !important;}input[type="password"]::-webkit-credentials-auto-fill-button{right:0 !important;}input[type="password"]:-moz-password-eye{display:none;}input[type="password"]::-ms-reveal{display:none;}::selection{color:#2c2c2c;}::selection{background-color:#d9d9d9;}.card{transform:translateY(0);}body{background:linear-gradient(135deg,rgba(211,211,211,.8),rgba(224,224,224,.9),rgba(243,243,243,1));}.card{transition:box-shadow .3s ease;}
  
</style>

<body class="min-vh-100 d-flex flex-column">

    <?php if(auth()->guard('web')->check()): ?>
    <?php if(auth()->user()->hak_akses == '0'): ?>

    <nav class="navbar bg-body-tertiary fixed-top">
        <div class="container">
            <a href="/Admin" class="navbar-brand">
                <img src="<?php echo e(asset('storage/fotoProfileAdmin/' . auth()->user()->foto)); ?>" style="width: 20px; height: 20px;" class='rounded-circle' alt="" srcset="">
                <span id="nama_atas" username="<?php echo e(auth()->user()->username); ?>" name="<?php echo e(auth()->user()->name); ?>"></span>

            </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-end custom-offcanvas-width" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title d-flex align-items-center" id="offcanvasNavbarLabel">
                    <img src="<?php echo e(asset('storage/fotoProfileAdmin/' . auth()->user()->foto)); ?>" style="width: 30px; height: 30px;" class='rounded-circle mb-1 me-2' alt="" srcset="">
                    <span class="text-truncate" style="max-width: 150px;"><?php echo e(auth()->user()->name); ?></span>
                </h5>     
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column">
              <ul class="navbar-nav justify-content-end flex-grow-1">
                <li class="nav-item">
                    <a href="/Admin/Users" class="nav-link <?php if($title == 'Daftar Users'): ?> active <?php endif; ?>">
                        <i class="fas fa-user"></i> Admin
                    </a>
                </li>


                <li class="nav-item">
                    <a href="/pkl" class="nav-link  <?php if($title == 'Daftar PKL'): ?> active <?php endif; ?>">
                        <i class="fas fa-briefcase"></i> Industri
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/Admin/jurusan" class="nav-link <?php if($title == 'Daftar jurusan'): ?> active <?php endif; ?>">
                        <i class="fas fa-graduation-cap"></i> Jurusan
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/Admin/guru_pendamping" class="nav-link <?php if($title == 'Daftar Guru pendamping'): ?> active <?php endif; ?>">
                        <i class="fas fa-chalkboard-teacher"></i> Guru Pendamping
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/Admin/Siswa" class="nav-link <?php if($title == 'Daftar Siswa'): ?> active <?php endif; ?>">
                        <i class="fas fa-user-graduate"></i> Siswa
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Admin/Prakerin" class="nav-link <?php if($title == 'Daftar Prakerin'): ?> active <?php endif; ?>">
                        <i class="fas fa-list-alt"></i> Daftar Prakerin
                    </a>
                </li>
               
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php if($title === 'Pengajuan Siswa' || $title === 'Surat Izin Siswa' || $title === 'Surat Penarikan Siswa' || $title == 'Daftar Surat tugas guru pendamping'): ?> active <?php endif; ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-file-alt"></i> Dokumen
                    </a>

                    <ul class="dropdown-menu">
                        <li class="dropdown-header"><i class="fas fa-user"></i> Siswa</li>
                        <li><a class="dropdown-item <?php if($title == 'Pengajuan Siswa'): ?> active <?php endif; ?>" href="/Siswa/Pengajuan"><i class="fas fa-file-signature"></i> Surat Pengajuan &</br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pengantar</a></li>
                        <li><a class="dropdown-item <?php if($title == 'Surat Izin Siswa'): ?> active <?php endif; ?>" href="/Siswa/suratIzin "><i class="fas fa-file-signature"></i> Surat Izin</a></li>
                        <li><a class="dropdown-item <?php if($title == 'Surat Penarikan Siswa'): ?> active <?php endif; ?>" href="/Siswa/suratPenarikan"><i class="fas fa-file-signature"></i> Surat Penarikan</a></li>
                        <li><a class="dropdown-item <?php if($title == 'Jurnal PKL'): ?> active <?php endif; ?>" href="/Siswa/JurnalPKL"><i class="fas fa-address-book"></i> Jurnal PKL</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-header"><i class="fas fa-chalkboard-teacher"></i> Guru Pendamping</li>
                        <li><a class="dropdown-item <?php if($title == 'Daftar Surat tugas guru pendamping'): ?> active <?php endif; ?>" href="/Pendamping/Pengajuan"><i class="fas fa-file-signature"></i> Surat Tugas</a></li>
                        

                        

                    </ul>
                </li>
                <li class="nav-item mt-auto">
                    <a href="#" class="nav-link" onclick="logout()">
                        <i class="fas fa-sign-out-alt"></i> logout
                    </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>

    
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script>
        var nama_atas = document.getElementById('nama_atas');
        var username = 'Sebagai Admin';
        var name = nama_atas.getAttribute('name');
        document.addEventListener('DOMContentLoaded', function() {
        var options = {
        strings: [username, name],
        typeSpeed: 50,
        backSpeed: 25,
        startDelay: 500,  
        backDelay: 3500,
        showCursor: false,
        loop: true
};

var typed = new Typed('#nama_atas', options);
});
    </script>
    <?php elseif(auth()->user()->hak_akses == '2'): ?>

    <nav class="navbar bg-body-tertiary fixed-top">
        <div class="container">
            <a href="/Admin" class="navbar-brand">
                <img src="<?php echo e(asset('storage/fotoProfileAdmin/' . auth()->user()->foto)); ?>" style="width: 20px; height: 20px;" class='rounded-circle' alt="" srcset="">
                <span id="nama_atas" username="<?php echo e(auth()->user()->username); ?>" name="<?php echo e(auth()->user()->name); ?>"></span>

            </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-end custom-offcanvas-width" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title d-flex align-items-center" id="offcanvasNavbarLabel">
                    <img src="<?php echo e(asset('storage/fotoProfileAdmin/' . auth()->user()->foto)); ?>" style="width: 30px; height: 30px;" class='rounded-circle mb-1 me-2' alt="" srcset="">
                    <span class="text-truncate" style="max-width: 150px;"><?php echo e(auth()->user()->name); ?></span>
                </h5>                
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column">
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                    <a href="/prakerin" class="nav-link <?php if($title == 'Guru Prakerin'): ?> active <?php endif; ?>">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/prakerin/gantiPassword" class="nav-link <?php if($title == 'Ganti Data'): ?> active <?php endif; ?>">
                        <i class="fas fa-lock"></i> Ganti Data
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/pkl" class="nav-link  <?php if($title == 'Daftar PKL'): ?> active <?php endif; ?>">
                        <i class="fas fa-briefcase"></i> Industri
                    </a>
                </li>
               
                <li class="nav-item">
                    <a href="/Admin/Prakerin" class="nav-link <?php if($title == 'Daftar Prakerin'): ?> active <?php endif; ?>">
                        <i class="fas fa-list-alt"></i> Prakerin
                    </a>
                </li>
              

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php if($title === 'Pengajuan Siswa' || $title === 'Surat Izin Siswa' || $title === 'Surat Penarikan Siswa' || $title == 'Daftar Surat tugas guru pendamping'): ?> active <?php endif; ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-file-alt"></i> Dokumen
                    </a>

                    <ul class="dropdown-menu">
                        <li class="dropdown-header"><i class="fas fa-user"></i> Siswa</li>
                        <li><a class="dropdown-item <?php if($title == 'Pengajuan Siswa'): ?> active <?php endif; ?>" href="/Siswa/Pengajuan"><i class="fas fa-file-signature"></i> Surat Pengajuan &</br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pengantar</a></li>
                        <li><a class="dropdown-item <?php if($title == 'Surat Izin Siswa'): ?> active <?php endif; ?>" href="/Siswa/suratIzin "><i class="fas fa-file-signature"></i> Surat Izin</a></li>
                        <li><a class="dropdown-item <?php if($title == 'Surat Penarikan Siswa'): ?> active <?php endif; ?>" href="/Siswa/suratPenarikan"><i class="fas fa-file-signature"></i> Surat Penarikan</a></li>
                        <li><a class="dropdown-item <?php if($title == 'Jurnal PKL'): ?> active <?php endif; ?>" href="/Siswa/JurnalPKL"><i class="fas fa-address-book"></i> Jurnal PKL</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-header"><i class="fas fa-chalkboard-teacher"></i> Guru Pendamping</li>
                        <li><a class="dropdown-item <?php if($title == 'Daftar Surat tugas guru pendamping'): ?> active <?php endif; ?>" href="/Pendamping/Pengajuan"><i class="fas fa-file-signature"></i> Surat Tugas</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        

                    </ul>
                </li>
                <li class="nav-item mt-auto">
                    <a href="#" class="nav-link" onclick="logout()">
                        <i class="fas fa-sign-out-alt"></i> logout
                    </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>

    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script>
        var nama_atas = document.getElementById('nama_atas');
        var username = "Sebagai K3";
        var name = nama_atas.getAttribute('name');
        document.addEventListener('DOMContentLoaded', function() {
        var options = {
        strings: [username, name],
        typeSpeed: 50,
        backSpeed: 25,
        startDelay: 500,  
        backDelay: 3500,
        showCursor: false,
        loop: true
};

var typed = new Typed('#nama_atas', options);
});
    </script>

    <?php elseif(auth()->user()->hak_akses == '1'): ?>

    <nav class="navbar bg-body-tertiary fixed-top">
        <div class="container">
            <a href="/Admin" class="navbar-brand">
                <img src="<?php echo e(asset('storage/fotoProfileAdmin/' . auth()->user()->foto)); ?>" style="width: 20px; height: 20px;" class='rounded-circle' alt="" srcset="">
                <span id="nama_atas" username="<?php echo e(auth()->user()->username); ?>" name="<?php echo e(auth()->user()->name); ?>"></span>
            </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-end custom-offcanvas-width" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title d-flex align-items-center" id="offcanvasNavbarLabel">
                    <img src="<?php echo e(asset('storage/fotoProfileAdmin/' . auth()->user()->foto)); ?>" style="width: 30px; height: 30px;" class='rounded-circle mb-1 me-2' alt="" srcset="">
                    <span class="text-truncate" style="max-width: 150px;"><?php echo e(auth()->user()->name); ?></span>
                </h5>                
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column">
              <ul class="navbar-nav justify-content-end flex-grow-1">
                <li class="nav-item">
                    <a href="/kepsek/gantiPassword" class="nav-link <?php if($title == 'Ganti Data'): ?> active <?php endif; ?>">
                        <i class="fas fa-lock"></i> Ganti Data
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kepsek/Prakerin" class="nav-link <?php if($title == 'Daftar Prakerin'): ?> active <?php endif; ?>">
                        <i class="fas fa-list-alt"></i> Daftar Prakerin
                    </a>
                </li>

                <li class="nav-item mt-auto">
                    <a href="#" class="nav-link" onclick="logout()">
                        <i class="fas fa-sign-out-alt"></i> logout
                    </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>


    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script>
        var nama_atas = document.getElementById('nama_atas');
        var username = "NIP." + nama_atas.getAttribute('username');
        var name = nama_atas.getAttribute('name');
        document.addEventListener('DOMContentLoaded', function() {
        var options = {
        strings: [username, name],
        typeSpeed: 50,
        backSpeed: 25,
        startDelay: 500,
        backDelay: 3500,
        showCursor: false,
        loop: true
};

var typed = new Typed('#nama_atas', options);
});
    </script>
    <?php endif; ?>
    <?php elseif(auth()->guard('siswa')->check()): ?>
    <?php
   
   $cekPrakerin = \App\Models\tb_prakerin::join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
   ->select('tb_prakerin.*', 'tb_pkl.nama_pkl','tb_pkl.alamat_pkl', 'siswa.nama_siswa','siswa.kelas','tbl_gurupendamping.nama')->where('tb_prakerin.nisn','=',auth()->guard('siswa')->user()->nisn)->count();
   if($cekPrakerin != 0){
    $prakerin = \App\Models\tb_prakerin::join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
                ->select('tb_prakerin.*', 'tb_pkl.nama_pkl','tb_pkl.alamat_pkl', 'siswa.nama_siswa','siswa.kelas','tbl_gurupendamping.nama')->where('tb_prakerin.nisn','=',auth()->guard('siswa')->user()->nisn)->latest()->first();

    $cekJurnal = \App\Models\jurnalPKL::where('prakerin','=',$prakerin->idprakerin)->count();
   }else{
    $prakerin = null;
    $cekJurnal = 0;
   }

    if($cekJurnal > 0){
    $jurnal = \App\Models\jurnalPKL::join('tb_prakerin', 'jurnalpkl.prakerin','=','tb_prakerin.idprakerin')->join('tb_pkl','tb_prakerin.idpkl','=','tb_pkl.idpkl')->join('siswa','tb_prakerin.nisn','=','siswa.nisn')->join('tbl_gurupendamping','tb_prakerin.nip','=','tbl_gurupendamping.nip')
    ->select('jurnalpkl.*')->where('tb_prakerin.nisn','=',auth()->guard('siswa')->user()->nisn)->latest('jurnalpkl.tanggal')->first();
    }else{
        $jurnal = null;
    }
    ?>
    <nav class="navbar bg-body-tertiary fixed-top">
        <div class="container">
            <a href="/Siswa" class="navbar-brand">
                <img src="<?php echo e(asset('storage/foto_profile_siswa/' . auth()->guard('siswa')->user()->foto_siswa)); ?>" style="width: 20px; height: 20px;" class='rounded-circle mb-1' alt="" srcset="">
                <span id="nama_atas" nisn="<?php echo e(auth()->guard('siswa')->user()->nisn); ?>" nama="<?php echo e(auth()->guard('siswa')->user()->nama_siswa); ?>"></span>
            </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-end custom-offcanvas-width" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title d-flex align-items-center" id="offcanvasNavbarLabel">
                    <img src="<?php echo e(asset('storage/foto_profile_siswa/' . auth()->guard('siswa')->user()->foto_siswa)); ?>" style="width: 50px; height: 50px;" class='rounded-circle mb-1 me-2' alt="" srcset="">
                    <span class="text-truncate" style="max-width: 120px;"><?php echo e(ucwords(strtolower(auth()->guard('siswa')->user()->nama_siswa))); ?></span>
                </h5>                              
             
            </div>
            <div class="offcanvas-body d-flex flex-column">
                <ul class="navbar-nav flex-grow-1">
                  <li class="nav-item">
                    <a href="/Siswa" class="nav-link <?php if($title == 'Siswa'): ?> active <?php endif; ?>">
                      <i class="fas fa-user"></i> Profile
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/Siswa/Prakerin" class="nav-link <?php if($title == 'Prakerin'): ?> active <?php endif; ?>">
                      <i class="fas fa-list-alt"></i> Prakerin
                    </a>
                  </li>
                
                   <li class="nav-item">
                    <a href="/Siswa/JurnalPKL" class="nav-link <?php if($title == 'Jurnal PKL'): ?> active <?php endif; ?>">
                      <i class="fas fa-address-book"></i> Jurnal PKL
                    </a>
                  </li>

                  <?php if($cekJurnal != 0): ?>
                  <li class="nav-item">
                    <a href="/Siswa/JurnalPKL/Absen/<?php echo e($jurnal->id); ?>" class="nav-link <?php if($title == 'Daftar hadir'): ?> active <?php endif; ?>">
                        <i class="fas fa-user-check"></i> Absen
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Siswa/JurnalPKL/harian/<?php echo e($jurnal->id); ?>" class="nav-link <?php if($title == 'Daftar Kegiatan harian'): ?> active <?php endif; ?>">
                        <i class="fas fa-clipboard-list"></i> Kegiatan harian
                    </a>
                </li>
                
                  <?php endif; ?>
              
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php if($title === 'Pengajuan Siswa' || $title === 'Surat Izin Siswa' || $title === 'Surat Penarikan Siswa' || $title == 'Daftar Surat tugas guru pendamping'): ?> active <?php endif; ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-file-alt"></i> Dokumen
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item <?php if($title == 'Pengajuan Siswa'): ?> active <?php endif; ?>" href="/Siswa/Pengajuan"><i class="fas fa-file-signature"></i> Surat Pengajuan &<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pengantar</a></li>
                      <li><a class="dropdown-item <?php if($title == 'Surat Izin Siswa'): ?> active <?php endif; ?>" href="/Siswa/suratIzin "><i class="fas fa-file-signature"></i> Surat Izin</a></li>
                      <li><a class="dropdown-item <?php if($title == 'Surat Penarikan Siswa'): ?> active <?php endif; ?>" href="/Siswa/suratPenarikan"><i class="fas fa-file-signature"></i> Surat Penarikan</a></li>
                      
                    </ul>
                  </li>
               
              
                 
                  <li class="nav-item mt-auto">
                    <a href="#" class="nav-link" onclick="logout()">
                      <i class="fas fa-sign-out-alt"></i> logout
                    </a>
                  </li>
                </ul>
              </div>
          </div>
        </div>
      </nav>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script>
function toTitleCase(_0x593cb6){return _0x593cb6['toLowerCase']()['replace'](/\b(\w)/g,function(_0x4908c3){return _0x4908c3['toUpperCase']();});}var nama_atas=document['getElementById']('nama_atas'),nisn='NIS.'+nama_atas['getAttribute']('nisn'),nama=toTitleCase(nama_atas['getAttribute']('nama'));document['addEventListener']('DOMContentLoaded',function(){var _0x47869a={'strings':[nama,nisn],'typeSpeed':0x32,'backSpeed':0x19,'startDelay':0x1f4,'backDelay':0xdac,'showCursor':![],'loop':!![]},_0x2e82b1=new Typed('#nama_atas',_0x47869a);});
    </script>


    <?php elseif(auth()->guard('pendamping')->check()): ?>
    <nav class="navbar bg-body-tertiary fixed-top">
        <div class="container">
            <a href="/Pendamping" class="navbar-brand">
                <img src="<?php echo e(asset('storage/foto_profile_guruPendamping/' . auth()->guard('pendamping')->user()->foto_pendamping)); ?>" style="width: 20px; height: 20px;" class='rounded-circle' alt="" srcset="">
                <span id="nama_atas" nip="<?php echo e(auth()->guard('pendamping')->user()->nip); ?>" nama="<?php echo e(auth()->guard('pendamping')->user()->nama); ?>"></span>
            </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-end custom-offcanvas-width" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title d-flex align-items-center" id="offcanvasNavbarLabel">
                    <img src="<?php echo e(asset('storage/foto_profile_guruPendamping/' . auth()->guard('pendamping')->user()->foto_pendamping)); ?>" style="width: 30px; height: 30px;" class='rounded-circle mb-1 me-2' alt="" srcset="">
                    <span class="text-truncate" style="max-width: 150px;"><?php echo e(auth()->guard('pendamping')->user()->nama); ?></span>
                </h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column">
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                    <a href="/Pendamping" class="nav-link <?php if($title == 'Guru Pendamping'): ?> active <?php endif; ?>">
                        <i class="fas fa-user"></i> Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Pendamping/Prakerin" class="nav-link <?php if($title == 'Daftar Prakerin'): ?> active <?php endif; ?>">
                        <i class="fas fa-list-alt"></i> Daftar Prakerin
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Siswa/JurnalPKL" class="nav-link <?php if($title == 'Jurnal PKL'): ?> active <?php endif; ?>">
                      <i class="fas fa-address-book"></i> Jurnal PKL
                    </a>
                </li>
               

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php if($title === 'Pengajuan Siswa' || $title === 'Surat Izin Siswa' || $title === 'Surat Penarikan Siswa' || $title == 'Daftar Surat tugas guru pendamping'): ?> active <?php endif; ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-file-alt"></i> Dokumen
                    </a>

                    <ul class="dropdown-menu">
                        <li class="dropdown-header"><i class="fas fa-user"></i> Siswa</li>
                        <li><a class="dropdown-item <?php if($title == 'Pengajuan Siswa'): ?> active <?php endif; ?>" href="/Siswa/Pengajuan"><i class="fas fa-file-signature"></i> Surat Pengajuan &</br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pengantar</a></li>
                        <li><a class="dropdown-item <?php if($title == 'Surat Izin Siswa'): ?> active <?php endif; ?>" href="/Siswa/suratIzin "><i class="fas fa-file-signature"></i> Surat Izin</a></li>
                        <li><a class="dropdown-item <?php if($title == 'Surat Penarikan Siswa'): ?> active <?php endif; ?>" href="/Siswa/suratPenarikan"><i class="fas fa-file-signature"></i> Surat Penarikan</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-header"><i class="fas fa-chalkboard-teacher"></i> Guru Pendamping</li>
                        <li><a class="dropdown-item <?php if($title == 'Daftar Surat tugas guru pendamping'): ?> active <?php endif; ?>" href="/Pendamping/Pengajuan"><i class="fas fa-file-signature"></i> Surat Tugas</a></li>
                    </ul>
                </li>
                <li class="nav-item mt-auto">
                    <a href="#" class="nav-link" onclick="logout()">
                        <i class="fas fa-sign-out-alt"></i> logout
                    </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script>
        var nama_atas = document.getElementById('nama_atas');
        var nip = "NIP." + nama_atas.getAttribute('nip');
        var nama = nama_atas.getAttribute('nama');
        document.addEventListener('DOMContentLoaded', function() {
        var options = {
        strings: [nama, nip],
        typeSpeed: 50,
        backSpeed: 25,
        startDelay: 500,
        backDelay: 3500,
        showCursor: false,
        loop: true
};

var typed = new Typed('#nama_atas', options);
});
    </script>
    <?php else: ?>

    <nav class="navbar bg-body-tertiary fixed-top">
        <div class="container">
            <a href="/" class="navbar-brand">
                <span id="judul_atas"></span>
            </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-end custom-offcanvas-width" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasNavbarLabel">PKL</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                    <a href="/login" class="nav-link active ">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script>
      var judul_atas=document['getElementById']('judul_atas');document['addEventListener']('DOMContentLoaded',function(){var _0xc12fe2={'strings':['SMK\x20Negeri\x205\x20Semarang','BERJAYA...','Berkarakter','Elegan','Religius','Jujur','Adaptif','Yakin','Amanah','SMK\x20Bisa!'],'typeSpeed':0x32,'backSpeed':0x19,'startDelay':0x1f4,'loop':!![]},_0x328015=new Typed('#judul_atas',_0xc12fe2);});
    </script>
    <?php endif; ?>
    <br><br>
      <style>
        .container-dev {
  font-size: 15px;
  color: #333;
  position: relative;
  cursor: pointer;
  display: inline-block;
}

.hover-me-dev {
  position: relative;
  z-index: 1;
  text-decoration: underline;
  text-underline-offset: 4px;
  text-decoration-color: #333;
}

.tooltip-dev {
  width: 100%;
  height: 10px;
  background: #ffffff;
  padding: 0.25em;
  text-align: center;
  position: absolute;
  top: 40px;
  left: 0;
  opacity: 0;
  visibility: hidden;
  transform-origin: center top;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.05);
  transition: opacity 0.3s ease-in-out;
}

.tooltip-dev::before {
  content: "";
  position: absolute;
  bottom: -8px;
  left: 80%;
  transform: translateX(-50%);
  border-width: 8px 7px 0;
  border-style: solid;
  border-color: #ffffff transparent transparent transparent;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.05);
}

.tooltip-dev p {
  margin: 0;
  color: #333;
  font-weight: 600;
}

.container-dev:hover .tooltip-dev {
  top: -10px;
  opacity: 1;
  visibility: visible;
  animation: goPopup 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55) forwards;
}

.container-dev:hover .tooltip-dev p {
  animation: bounce 2s ease-in-out infinite;
}

@keyframes goPopup {
  0% {
    transform: translateY(0) scaleY(0);
    opacity: 0;
  }
  50% {
    transform: translateY(-50%) scaleY(1.2);
    opacity: 1;
  }
  100% {
    transform: translateY(-100%) scaleY(1);
    border-radius: 8px;
    opacity: 1;
    height: 50px;
  }
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
    transform: translateY(-3px);
  }
  60% {
    transform: translateY(-2px);
  }
}

.container-school {
  font-size: 15px;
  color: #333;
  position: relative;
  cursor: pointer;
  display: inline-block;
}

.hover-me-school {
  position: relative;
  z-index: 1;
  text-decoration: underline;
  text-underline-offset: 4px;
  text-decoration-color: #333;
}

.tooltip-school {
  width: 100%;
  height: 10px;
  background: #ffffff;
  padding: 0.25em;
  text-align: center;
  position: absolute;
  top: 40px;
  left: 0;
  opacity: 0;
  visibility: hidden;
  transform-origin: center top;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.05);
  transition: opacity 0.3s ease-in-out;
}

.tooltip-school::before {
  content: "";
  position: absolute;
  bottom: -8px;
  left: 80%;
  transform: translateX(-50%);
  border-width: 8px 7px 0;
  border-style: solid;
  border-color: #ffffff transparent transparent transparent;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.05);
}

.tooltip-school p {
  margin: 0;
  color: #333;
  font-weight: 600;
}

.container-school:hover .tooltip-school {
  top: -10px;
  opacity: 1;
  visibility: visible;
  animation: goPopup 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55) forwards;
}

.container-school:hover .tooltip-school p {
  animation: bounce 2s ease-in-out infinite;
}
.no-select {
            user-select: none; 
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }
        .swal2-confirm-custom {
        color: white !important;
        background-color: white;
    }

    </style>
    <?php if(auth()->check()): ?>

    <style>
         .fixed-bottom-left {
        position: fixed;
        bottom: 6vh;
        left: 3vh;
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

    .fixed-bottom-left:hover {
        background-color: rgb(79, 173, 255);
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

    .fixed-bottom-left i {
        transition: transform 0.3s ease-in-out;
    }

    .fixed-bottom-left:hover i {
        transform: scale(1.3);
    }

    .fixed-bottom-left.clicked i {
        animation: moveUp 0.5s forwards;
    }

    @keyframes moveUp {
        to {
            transform: translateY(-50px);
        }
    }

    </style>
    
    <?php endif; ?>
    <?php echo $__env->yieldContent('content'); ?>
    <br><br><br>
       <div class="mt-auto bg-body-tertiary">
        <div class="container p-4">
            <div class="row">
                <div class="col-md-6">
                    <h1 id="pkl-button" style="cursor: pointer;" onclick="aboutPKL()">PKL</h1>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <div class="container-dev">
                              
                                 <a class="text-decoration-none text-dark no-select" style="cursor: pointer" href="https://id.wikipedia.org/wiki/Pelatihan_kerja_lapangan" target="_BLANK">Tentang PKL</a>
                               
                              </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <div class="container-school">
                                <a class="hover-me-school text-decoration-none text-dark" href="https://smkn5smg.sch.id/" target="_BLANK">SMK Negeri 5 Semarang</a>
                                <div class="tooltip-school">
                                  <p>Web Sekolah</p>
                                </div>
                              </div>
                        </div>
                        <div class="col-md-4 mt-3">
                             <a class=" hover-me-dev text-decoration-none text-dark" href="https://www.instagram.com/_syuja._/?next=%2F&hl=id" target="_BLANK">Farras Syuja</a>
                                <div class="tooltip-dev">
                                  <p>Web Developer</p>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class=' text-center text-light' style="background-color: rgb(18, 38, 49);">
        <br>
        <p>&copy; 2024 - <?php echo e(date('Y')); ?> Syuja</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function logout() {
            Swal.fire({
                icon: 'question',
                title: 'Konfirmasi',
                text: 'Yakin ingin logout?',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/logout';
                }
            });

            return false;
        }
    </script>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
       
       console.log("Kamu seharusnya tidak melihat bagian ini.");
       
function aboutPKL() {
    Swal.fire({
        title: 'Apa itu PKL?',
        html: 'PKL (Praktek Kerja Lapangan) adalah kesempatan bagi siswa untuk mendapatkan pengalaman kerja di dunia nyata. Selama PKL, siswa dapat mengembangkan keterampilan mereka dan memperluas jaringan profesional mereka.',
        icon: 'info',
        confirmButtonText: 'Paham'
    });
}

  
    </script>
    <?php if(auth()->guard('siswa')->check()): ?>
    <script>
        //   function showContactFormSiswa() {
        //     Swal.fire({
        //         title: 'Beritahu kami tentang website PKL',
        //         html: `
        //         <form id="contactForm">
        //             <div class="form-floating mb-3">
        //                 <input type="text" class="form-control" name="nama" id="nama" placeholder="" value="<?php echo e(auth()->guard('siswa')->user()->nama_siswa); ?>" disabled>
        //                 <label for="nama">Nama</label>
        //             </div>
        //             <div class="form-floating mb-3">
        //                 <textarea class="form-control pesan" name="pesan" id="pesan" placeholder="" style="height:200px;"></textarea>
        //                 <label for="pesan">Pesan</label>
        //             </div>
        //         </form>`,
        //         showCancelButton: true,
        //         confirmButtonText: 'Kirim',
        //         cancelButtonText: 'Batal',
        //         allowOutsideClick: false,
        //         preConfirm: () => {
        //             const name = document.getElementById('nama').value;
        //             const message = document.getElementById('pesan').value;

        //             if (!name || !message) {
        //                 Swal.showValidationMessage('Tolong isi semua terlebih dahulu');
        //             } else {
        //                 Swal.fire({
        //                     title: 'Sedang Mengirim...',
        //                     allowOutsideClick: false,
        //                     didOpen: () => {
        //                         Swal.showLoading();
        //                     }
        //                 });


        //                 fetch('/kirimPesan', {
        //                         method: 'POST',
        //                         headers: {
        //                             'Content-Type': 'application/json',
        //                             'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
        //                         },
        //                         body: JSON.stringify({
        //                             nama: name,
        //                             pesan: message
        //                         })
        //                     })
        //                     .then(response => response.json())
        //                     .then(data => {
        //                         Swal.close();
        //                         Swal.fire({
        //                             icon: 'success',
        //                             title: 'Terima kasih!',
        //                             text: 'Pesan Anda telah berhasil terkirim.'
        //                         });
        //                     })
        //                     .catch(error => {
        //                         console.error('Error:', error);
        //                         Swal.fire({
        //                             icon: 'error',
        //                             title: 'Oops...',
        //                             text: 'Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.'
        //                         });
        //                     });
        //             }
        //         }
        //     });
        // }
    </script>
    <?php endif; ?>
           <script src="<?php echo e(asset('aset/js/scriptJava.js')); ?>"></script>
    <script>
      

       

       function caraLogin(){
    Swal.fire({
        title: 'Cara Login',
        html: `
            <div style="text-align: left; margin-bottom: 20px;">
                <h3><strong>Siswa</strong></h3>
                <ol>
                    <li>Login menggunakan NIS dan password.</li>
                    
                    <li>Untuk keamanan, ubah password setelah login, kemudian login kembali dengan NIS dan password baru.</li>
                </ol>
            </div>
            <hr>
            <div style="text-align: left; margin-top: 20px; margin-bottom: 20px;">
                <h3><strong>Guru</strong></h3>
                <ol>
                    <li>Login menggunakan NIP dan password.</li>
                    
                    <li>Untuk keamanan, ubah password setelah login, kemudian login kembali dengan NIP dan password baru.</li>
                </ol>
            </div>
            <p style="text-align: center; font-size: 16px; color: #007bff;">Jika terdapat kendala atau masalah, jangan ragu untuk hubungi kami.</p>
        `,
        icon: 'info',
        confirmButtonText: 'Mengerti',
        confirmButtonColor: '#007bff',
         backdrop: `rgba(128,128,128,0.4)`,
        footer: '<a href="https://wa.me/6281226372450?text=Permisi%20Syuja%20selaku%20pengembang%20website%20PKL%20SMK%20Negeri%203%20Kendal," target="_BLANK">Hubungi pengembang web</a>',
        customClass: {
            title: 'swal-title-custom',
            content: 'swal-content-custom'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Mohon Kerjasamanya',
                text: 'Laksanakan kegiatan PKL dengan penuh tanggung jawab dan semangat! ðŸ˜Š',
                icon: 'success',
                confirmButtonText: 'Baik',
                confirmButtonColor: '#007bff',
                 backdrop: `rgba(128,128,128,0.4)`
            });
        }
  
});
       }
</script>



    
       <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>-->
       
       
     
</body>

</html>
<?php /**PATH D:\smk\pklsmk5smg\resources\views\layout\app.blade.php ENDPATH**/ ?>