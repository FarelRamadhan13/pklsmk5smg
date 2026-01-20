
<?php $__env->startSection('content'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

<script src="https://unpkg.com/intro.js/minified/intro.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/intro.js/minified/introjs.min.css">
<style>
    .btn-circle {
    width: 40px;
    height: 40px;
    padding: 6px 0;
    border-radius: 50%;
    text-align: center;
    font-size: 20px;
    line-height: 1.42857;
}

</style>
<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-3">
        <div class="col-md-5">
            <div class="card mt-5" id="FLogin">
                <div class="card-header text-center py-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="mb-0">Login</h1>
                        <button type="button" id="caraLogin" class="btn btn-light btn-circle ml-3">
                            <i class="fa-solid fa-question text-muted"></i>
                        </button>
                    </div>
                </div>
                
                <div class="card-body p-5">
                <?php if(session('gagal')): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '<?php echo e(session('gagal')); ?>',
            confirmButtonText: 'Baik'
        });
    </script>
<?php endif; ?>
<?php if(session('cooldown')): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let cooldownTime = <?php echo e(session('cooldown_time')); ?>;
        let timerInterval;

        Swal.fire({
            timerProgressBar: true,
            title: 'Tunggu sebentar',
            html: 'Terlalu banyak percobaan login. Silakan coba lagi setelah <b>' + cooldownTime + '</b> detik.',
            imageUrl: 'https://media.tenor.com/pW4zXviv42IAAAAi/eula-genshin-impact.gif',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            timer: cooldownTime * 1000,
            
            didOpen: () => {
                Swal.showLoading();
                const b = Swal.getHtmlContainer().querySelector('b');
                timerInterval = setInterval(() => {
                    cooldownTime--;
                    b.textContent = cooldownTime;
                    if (cooldownTime <= 0) {
                        clearInterval(timerInterval);
                    }
                }, 1000);
            },
            willClose: () => {
                clearInterval(timerInterval);
            }
        }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {
                location.reload();
            }
        });
    });
</script>
<?php endif; ?>


<?php if(session('logout')): ?>
<script>
        function successfullogout() {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Logout',
                confirmButtonText: 'Baik'
            });
        }
        
        successfullogout();
    </script>
<?php endif; ?>
<?php if(session('berhasil')): ?>
<script>
        function successfullogout() {
            Swal.fire({
                icon: 'success',
                title: '<?php echo e(session("berhasil")); ?>',
            });
        }
        
        successfullogout();
    </script>
<?php endif; ?>
<?php if(session('messi-siuu')): ?>
<script>
    Swal.fire({
    title: "Messi!!!!",
    text: "Messi Siuu!!!",
    imageUrl: "https://media1.tenor.com/m/ITM55BYIE2UAAAAd/messi-siuuu.gif",
    imageWidth: 300,
    imageHeight: 400,
    imageAlt: "Messi",
    confirmButtonText: "Siuu!!"
});
</script>
<?php endif; ?>
                    <form method="post" id="loginForm">
                        <?php echo csrf_field(); ?>
                        <div class="form-floating mb-3" id="nisn">
                            <input type="text" class="form-control <?php if($errors->has('username')): ?> is-invalid <?php endif; ?>" name="username" id="username" placeholder="NIS/NIP">
                            <label for="username">NIS/NIP</label>
                           
                            <div class="invalid-feedback">
                               NIS/NIP harus diisi
                            </div>
                          
                        </div>
                        <div class="form-floating mb-3 position-relative" id="pass">
                            <input type="password" class="form-control <?php if($errors->has('password')): ?> is-invalid <?php endif; ?>" name="password" id="password" placeholder="Password">
                            <label for="password">Password</label>
                           
                            <div class="invalid-feedback">
                                Password harus diisi
                            </div>
                          
                            <button type="button" class="btn-white btn position-absolute top-0 end-0 <?php if($errors->has('password')): ?> me-4 <?php else: ?> me-2 <?php endif; ?>" style="margin-top: 10px" id="lihatPassword">
                                <span id="lihatPasswordIcon" class="fas fa-eye"></span>
                            </button>
                        </div>

                      

                        <style>
                            .uv-checkbox-wrapper {
  display: inline-block;
}

.uv-checkbox {
  display: none;
}

.uv-checkbox-label {
  display: flex;
  align-items: center;
  cursor: pointer;
}

.uv-checkbox-icon {
  position: relative;
  width: 2em;
  height: 2em;
  border: 2px solid #ccc;
  border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
  transition: border-color 0.3s ease, border-radius 0.3s ease;
}

.uv-checkmark {
  position: absolute;
  top: 0.1em;
  left: 0.1em;
  width: 1.6em;
  height: 1.6em;
  fill: none;
  stroke: #fff;
  stroke-width: 2;
  stroke-linecap: round;
  stroke-linejoin: round;
  stroke-dasharray: 24;
  stroke-dashoffset: 24;
  transition: stroke-dashoffset 0.5s cubic-bezier(0.45, 0.05, 0.55, 0.95);
}

.uv-checkbox-text {
  margin-left: 0.5em;
  transition: color 0.3s ease;
}

.uv-checkbox:checked + .uv-checkbox-label .uv-checkbox-icon {
  border-color: #0d6efd;
  border-radius: 70% 30% 30% 70% / 70% 70% 30% 30%;
  background-color: #0d6efd;
}

.uv-checkbox:checked + .uv-checkbox-label .uv-checkmark {
  stroke-dashoffset: 0;
}

.uv-checkbox:checked + .uv-checkbox-label .uv-checkbox-text {
  color: #0d6efd;
}

                        </style>
                        <div class="uv-checkbox-wrapper" id="ingat">
                            <input type="checkbox" id="uv-checkbox" class="uv-checkbox" name="remember" />
                            <label for="uv-checkbox" class="uv-checkbox-label">
                              <div class="uv-checkbox-icon">
                                <svg viewBox="0 0 24 24" class="uv-checkmark" id="remember">
                                  <path d="M4.1,12.7 9,17.6 20.3,6.3" fill="none"></path>
                                </svg>
                              </div>
                              <span class="uv-checkbox-text">Ingatkan saya</span>
                            </label>
                          </div>
                          

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" id="loginButton"><i class="fa-solid fa-right-to-bracket"></i> </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media (max-width: 768px) {
    .custom-introjs-tooltip {
        max-width: 90% !important; 
        left: 5% !important; 
        right: 5% !important; 
        top: 0% !important; 
    }
}
</style>
<script>
    document.getElementById('username').addEventListener('input', function(){
        var username = document.getElementById('username');
        if(username.value.trim() === ''){
            username.classList.add('is-invalid');
        }else{
            username.classList.remove('is-invalid');
        }
    });

    document.getElementById('password').addEventListener('input', function(){
        var password = document.getElementById('password');
        var lihatPassword = document.getElementById('lihatPassword');
        if(password.value.trim() === ''){
            password.classList.add('is-invalid');
            lihatPassword.classList.remove('me-2');
            lihatPassword.classList.add('me-4');
        }else{
            password.classList.remove('is-invalid');
            lihatPassword.classList.remove('me-4');
            lihatPassword.classList.add('me-2');
        }
    })
</script>
<script>
 document.getElementById('loginForm').addEventListener('submit', function (event) {
    event.preventDefault();

    const username = document.getElementById('username');
    const password = document.getElementById('password');
    const lihatPassword = document.getElementById('lihatPassword');
    const loginButton = document.getElementById('loginButton');
    const usernameContainer = document.getElementById('nisn'); 
    const passwordContainer = document.getElementById('pass'); 
    let isValid = true;

    
    function shakeElement(element) {
        anime({
            targets: element,
            translateX: [-10, 10, -10, 10, -5, 5, 0],
            duration: 500, 
            easing: 'easeInOutSine'
        });
    }

    // Validasi username
    if (username.value.trim() === '') {
        username.classList.add('is-invalid');
        shakeElement(usernameContainer);
        isValid = false;
    } else {
        username.classList.remove('is-invalid');
    }

    // Validasi password
    if (password.value.trim() === '') {
        password.classList.add('is-invalid');
        lihatPassword.classList.remove('me-2');
        lihatPassword.classList.add('me-4');
        shakeElement(passwordContainer); 
        isValid = false;
    } else {
        password.classList.remove('is-invalid');
    }

   
    if (isValid) {
      
        loginButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>'; 
        loginButton.disabled = true;

   
        anime({
            targets: loginButton,
            scale: [1, 1.1],
            duration: 500,
            easing: 'easeInOutQuad',
            direction: 'alternate',
            loop: 2,
            complete: function () {
              
                event.target.submit();
            }
        });
    }
});
</script>
<script>
    $(document).ready(function(){
        $('#lihatPassword').click(function(){
            if($('#password').attr('type') == 'password'){
                $('#password').attr('type', 'text');
                $('#lihatPasswordIcon').removeClass('fa-eye').addClass('fa-eye-slash')
            }else{
                $('#password').attr('type','password');
                $('#lihatPasswordIcon').removeClass('fa-eye-slash').addClass('fa-eye')
            }
        });

        $('#caraLogin').click(function(){
    var username = '#nisn';  
    var pass = '#pass';
    var remember = '#remember';
    var ingatPasti = '#ingat';
    var login = '#loginButton';
    var lihatPassword = '#lihatPassword';

    var intro = introJs().setOptions({
        steps: [
            {
                intro: 'Berikut adalah Panduan bagaimana cara login di web PKL SMK Negeri 5 Semarang',
                title: '?'
            },
            {
                element: username,
                intro: "Untuk siswa isikan NIS, untuk guru isikan NIP",
                title: "NIS/NIP"
            },
            {
                element: pass,
                intro: "isikan password, password awal sepertinya tidak aman, maka sebaiknya ganti password saat sudah berhasil login dan selalu ingat password kamu. Namun seandainya lupa password, hubungi admin untuk bantuan lebih lanjut. Walaupun begitu, jangan pernah melupakan password secara sengaja, tulis password di kertas atau buku harian!",
                title: 'Password'
            },
            {
                element: lihatPassword,
                intro: "Berfungsi untuk memperlihatkan atau menyembunyikan password saat sedang diisikan",
                title: 'Mata pada password',
                position: 'bottom'
            },
            {
                element: ingatPasti,
                intro: "Memungkinkan untuk menyimpan data Login di browser selama 6 bulan ketika dicentang, jadi tidak perlu login ulang setiap saat",
                title: 'Ingatkan saya'
            },
            {
                element: remember,
                intro: "Klik ini untuk centang",
                title: 'Ingatkan saya'
            },
            {
                element: login,
                intro: "Ketika semua sudah diisi dan yakin sesuai dengan data (NIS/NIP dan Password), klik tombol Login, ketika data yang diisikan sudah benar, maka akan diarahkan ke halaman yang berbeda dan akan ada pemberitahuan bahwa berhasil login, namun ketika salah, akan ada pemberitahuan bahwa data yang diisikan salah",
                title: 'Tombol Login',
                tooltipClass: 'custom-introjs-tooltip',
                position: 'up'
            },
            {
                intro: 'Mohon kerja samanya, Laksanakan kegiatan PKL dengan penuh tanggung jawab dan semangat! 😊',
                title: '?',
                position: 'left',
                 
            }
        ],
        doneLabel: 'Paham',
        nextLabel: '>',
        prevLabel: '<',
        scrollToElement: true,  
        scrollPadding: 100,    
     
      
    });

    intro.start();
});

$('#pilihLogin').click(function(){
    var LoginForm = '#FLogin';  
    var caraLogin = '#caraLogin';

    var intro = introJs().setOptions({
        steps: [
            {
                element: LoginForm,
                intro: "Ini adalah Form Login",
                title: "Form Login"
            },
            {
                element: caraLogin,
                intro: "klik '?' untuk instruksi lebih lanjut",
                title: '?'
            }
        ],
        doneLabel: 'Paham',
        nextLabel: '>',
        prevLabel: '<',
        scrollToElement: true,  
        scrollPadding: 100,    
     
      
    });

    intro.start();
});

function isSweetAlertActive() {
    return $('.swal2-container').length > 0;
}

localStorage.removeItem("visited");

if(!localStorage.getItem("kunjungi") && !isSweetAlertActive()){
    var username = '#nisn';  
    var pass = '#pass';
    var remember = '#remember';
    var ingatPasti = '#ingat';
    var login = '#loginButton';
    var lihatPassword = '#lihatPassword';

    var intro = introJs().setOptions({
        steps: [
            {
                intro: 'Berikut adalah Panduan bagaimana cara login di web PKL SMK Negeri 5 Semarang',
                title: '?'
            },
            {
                element: username,
                intro: "Ketika kamu adalah seorang siswa maka inputkan NIS, namun ketika kamu adalah seorang guru maka inputkan NIP",
                title: "NIS/NIP"
            },
            {
                element: pass,
                intro: "Inputkan password kamu, password awal kamu sepertinya tidak aman, maka sebaiknya ganti password saat kamu sudah berhasil login dan selalu ingat password kamu. Namun seandainya kamu lupa password, kamu bisa menghubungi admin untuk bantuan lebih lanjut. Walaupun begitu, jangan pernah melupakan password kamu secara sengaja, tulis password kamu di kertas atau buku harian kamu!",
                title: 'Password'
            },
            {
                element: lihatPassword,
                intro: "Berfungsi untuk memperlihatkan atau menyembunyikan password saat sedang kamu inputkan, jadi saat kamu menginputkan passwordnya, klik untuk melihat password yang sedang kamu isi dan klik lagi untuk menyembunyikannya",
                title: 'Mata pada password',
                position: 'bottom'
            },
            {
                element: ingatPasti,
                intro: "Memungkinkan untuk menyimpan data Login di browser selama 6 bulan ketika dicentang, jadi tidak perlu login ulang setiap saat",
                title: 'Ingatkan saya'
            },
            {
                element: remember,
                intro: "Klik ini untuk centang",
                title: 'Ingatkan saya'
            },
            {
                element: login,
                intro: "Ketika semua sudah diisi dan yakin sesuai dengan data kamu (NIS/NIP dan Password), klik tombol Login, ketika data yang kamu inputkan sudah benar, maka kamu akan diarahkan ke halaman yang berbeda dan akan ada pemberitahuan bahwa kamu berhasil login, namun ketika salah, akan ada pemberitahuan bahwa data yang kamu inputkan salah",
                title: 'Tombol Login',
                tooltipClass: 'custom-introjs-tooltip',
                position: 'up'
            },
            {
                intro: 'Mohon kerja samanya, Laksanakan kegiatan PKL dengan penuh tanggung jawab dan semangat! 😊',
                title: '?',
                position: 'left',
                 
            }
        ],
        doneLabel: 'Paham',
        nextLabel: '>',
        prevLabel: '<',
        scrollToElement: true,  
        scrollPadding: 100,    
     
      
    });

    intro.start();
    localStorage.setItem("kunjungi", "true");
    
}
    });
</script>

<script>
   

    function IngatkanSaya(){
        swal.fire({
            title: 'Ingatkan Saya',
            html: `
            <div style="text-align: left; margin-bottom: 20px;">
                <p>Memungkinkan untuk menyimpan data Login di browser selama 6 bulan, jadi tidak perlu login ulang setiap saat</p>       
            </div>
        `,
        icon: 'info',
        confirmButtonText: 'Mengerti',
        confirmButtonColor: '#007bff',
        })
    }
</script>
<script>
    function startShaking() {
        anime({
            targets: "#caraLogin",
            translateY: [
                { value: -3, duration: 100 },
                { value: 3, duration: 100 },
                { value: -3, duration: 100 },
                { value: 3, duration: 100 },
                { value: 0, duration: 100 }
            ],
            easing: "easeInOutQuad",
        });
    }
    
   
    setInterval(startShaking, 2000);
    </script>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\login.blade.php ENDPATH**/ ?>