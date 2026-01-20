@extends('layout.app')
@section('content')
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
    }

   
    #welcome-message {
        z-index: 9999;
        position: relative;
    }

</style>
<div id="welcome-screen" class="d-flex justify-content-center align-items-center position-fixed start-0 w-100 h-100 bg-white">
<div class="text-center">

<img id="profile-picture" 
     src="{{asset('storage/fotoProfileAdmin/' . auth()->user()->foto)}}" 
     alt="Foto Profil" 
     class="rounded-circle mb-3 d-none" 
     style="width: 150px; height: 150px; object-fit: cover; opacity: 0;">


<p id="welcome-message" class="fw-bold text-muted fs-4 mb-0">
  <span id="welcome" class=""></span> <span id="user-name" class="text-primary d-none"></span>
</p>
</div>
</div>
@endif
<style>
    .card:hover{
        box-shadow: 6px 6px 12px 0px rgba(0, 0, 0, 0.3);
        transform: translateY(-10px);
        transition: 1s;
    }
</style>
<div class="container mt-5 @if(session('login')) d-none @endif" id="main-content">

@if(session('berhasil'))
    <script>
        // Panggil SweetAlert saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session("berhasil") }}',
                showConfirmButton: false,
                timer: 3000 // Durasi SweetAlert ditampilkan dalam milidetik (ms)
            });
        });
    </script>
@endif
<div class="mx-auto d-flex justify-content-center align-items-center position-relative">
        <a href="/kepsek/gantiFoto" class="text-decoration-none position-relative text-light" id="editLink">
            <img src="{{asset('storage/fotoProfileAdmin/' . auth()->user()->foto)}}" style="width: 12vh; height:12vh;" alt="" class="rounded-circle" id="profileImage">
            <span class="position-absolute top-50 start-50 translate-middle" id="editIcon" style="">
                <i class="fas fa-pencil-alt"></i>
            </span>
        </a>
    </div>
    <div class="text-center">

        <h3>{{auth()->user()->name}}</h3>
    </div>
    <div class="row justify-content-center align-items-center d-flex mt-5">
    <div class="col-md-4 mt-4">
        <a href="/kepsek/gantiPassword" class="text-decoration-none">
            <div class="card">
                <div class="card-header text-center">
                    <h1>Ganti Data</h1>
                </div>
                <div class="card-body p-4 text-center">
                    <p>Ganti Data anda jika diperlukan</p>
                </div>
            </div>
</a>
        </div>
       

        <div class="col-md-4 mt-4">
        <a href="/kepsek/Prakerin" class="text-decoration-none">
            <div class="card">
                <div class="card-header text-center">
                    <h1>Prakerin</h1>
                </div>
                <div class="card-body p-4 text-center">
                    <p>Terdapat {{$prakerin}} Data Prakerin</p>
                </div>
            </div>
        </a>
        </div> 

      
    </div>

    
</div>
@if(session('login'))
<script>
document.addEventListener("DOMContentLoaded", () => {
    const fullName = "Kepala sekolah";
    // const sixChars = fullName.slice(0, 6).toLowerCase();
    // const formattedName = sixChars.charAt(0).toUpperCase() + sixChars.slice(1) + (fullName.length > 6 ? "..." : "");

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

    userName.textContent = fullName;   
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
@endif
@endsection