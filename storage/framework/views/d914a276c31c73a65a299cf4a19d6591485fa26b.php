
<?php $__env->startSection('content'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@lottiefiles/lottie-player@1.6.3/dist/lottie-player.min.js"></script>
<?php if(session('login')): ?>
<style>
   #welcome-screen {
        z-index: 9999;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }

   
    #welcome-message {
        z-index: 9999;
        position: relative;
    }

</style>
<div id="welcome-screen" class="d-flex justify-content-center align-items-center position-fixed start-0 w-100 h-100 bg-white">
<div class="text-center">

<img id="profile-picture" 
     src="<?php echo e(asset('storage/foto_profile_guruPendamping/' . auth()->guard('pendamping')->user()->foto_pendamping)); ?>" 
     alt="Foto Profil" 
     class="rounded-circle mb-3 d-none" 
     style="width: 150px; height: 150px; object-fit: cover; opacity: 0;">


<p id="welcome-message" class="fw-bold text-muted fs-4 mb-0">
  <span id="welcome" class=""></span> <span id="user-name" class="text-primary d-none"></span>
</p>
</div>
</div>
<?php endif; ?>
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
    bottom: -8vh;
    left: -2vh;
    background-color: rgb(255, 255, 255, 0.9);
border-radius: 50%; 
}

a.text-decoration-none {
            position: relative;
            text-decoration: none;
        }
        
        a.text-decoration-none::after {
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

        a.text-decoration-none:hover::after {
            width: 100%;
            left: 0;
        }
</style>
<div class="container <?php if(session('login')): ?> d-none <?php endif; ?>" id="main-content">
    <div class="justify-content-center d-flex">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center my-3">
                    <h1>Data Anda</h1>
                </div>
                <div class="card-body p-5">
                    <?php if(session('berhasil')): ?>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: '<?php echo e(session('berhasil')); ?>',
                        });
                    </script>
                    <?php endif; ?>

                    

                    <div class="container">
                        

                        <div class="mx-auto d-flex justify-content-center align-items-center position-relative">
                            <div class="shiny-image">
                                <a href="<?php echo e(asset('storage/foto_profile_guruPendamping/' . auth()->guard('pendamping')->user()->foto_pendamping)); ?>" data-fancybox="gallery" data-caption="Foto Profil <?php echo e(auth()->guard('pendamping')->user()->nama); ?> <?php if(auth()->guard('pendamping')->user()->foto_pendamping == 'default.png'): ?> (kosong) <?php endif; ?>">
                                    <img src="<?php echo e(asset('storage/foto_profile_guruPendamping/' . auth()->guard('pendamping')->user()->foto_pendamping)); ?>" style="width: 11.5vh; height: 11.5vh;" alt="Foto Profil <?php echo e(auth()->guard('pendamping')->user()->nama); ?>" class="rounded-circle" id="profileImage">
                                </a>
                            </div>
                            <a href="/Pendamping/gantiFoto" class="text-decoration-none position-relative text-light" id="editLink">
                                <span class="position-absolute translate-middle shadow" id="editIcon" style="">
                                    <i class="fas fa-pencil-alt text-secondary"></i>
                                </span>
                            </a>
                        </div>
                        <div class="d-flex justify-content-center align-items-center mt-3">
                            <a href="/Pendamping/gantiPassword" class="text-decoration-none"><i class="fas fa-key"></i> Ubah Password</a> 
                        </div>
                        <table class="table mt-5">
                            <tr>
                                <th scopr="row">NIP </th>
                                <td> : <?php echo e(auth()->guard('pendamping')->user()->nip); ?></td>
                            </tr>
                            <tr>
                                <th>Nama </th>
                                <td> : <?php echo e(auth()->guard('pendamping')->user()->nama); ?></td>
                            </tr>
                            <tr>
                                <th>Alamat </th>
                                <td> : <?php echo e(auth()->guard('pendamping')->user()->alamat); ?></td>
                            </tr>
                            <tr>
                                <th>Nomor telephone </th>
                                <td> : <?php echo e(auth()->guard('pendamping')->user()->telp); ?></td>
                            </tr>

                            <tr>
                                <th>Tahun </th>
                                <td> : <?php echo e(auth()->guard('pendamping')->user()->tahun); ?></td>
                            </tr>
                            <tr>
                                <th>Jurusan </th>
                                <td> : <?php echo e($jurusan->nama_jurusan); ?></td>
                            </tr>
                            <tr>
                                <th>Status </th>
                                <td> : <?php if(auth()->guard('pendamping')->user()->status === '0'): ?> Aktif <?php else: ?> Non Aktif <?php endif; ?></td>
                            </tr>
                            <tr>
                                <th>Jurusan </th>
                                <td> : <?php echo e($jurusan->nama_jurusan); ?></td>
                            </tr>
                            <tr>
                                <th>Jabatan </th>
                                <td> : <?php echo e(auth()->guard('pendamping')->user()->jabatan); ?></td>
                            </tr>
                            <tr>
                                <th>Pangkat </th>
                                <td> : <?php echo e(auth()->guard('pendamping')->user()->pangkat); ?></td>
                            </tr>
                        </table>
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
                          <a class="edit-button mt-3" href="/Pendamping/ubah">
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
</div>
<?php if(session('login')): ?>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const fullName = "<?php echo e(auth()->guard('pendamping')->user()->nama); ?>";
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
        "Selamat datang kembali, ",
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
            duration: 1000,
            easing: "easeInOutQuad",
            complete: () => {
                welcomeScreen.style.zIndex = "0"; 
                welcomeScreen.style.pointerEvents = "none"; 
                welcomeScreen.style.display = "none"; 
                mainContent.classList.remove("d-none");

                anime({
                    targets: mainContent,
                    opacity: [0, 1],
                    duration: 1000,
                    easing: "easeOutExpo",
                });
            },
        });
    }, 6000); 
});
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\guru_pendampingLogin\index.blade.php ENDPATH**/ ?>