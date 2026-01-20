<?php $__env->startSection('content'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/clmtrackr@latest/build/clmtrackr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/clmtrackr@latest/models/model_pca_20_svm.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/clmtrackr@1.1.2/build/clmtrackr.min.js"></script>
<script src="https://code.iconify.design/2/iconify.min.js"></script>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/tracking/build/tracking-min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/tracking/build/data/face-min.js"></script>
 <style>

        .img-preview {
            display: none;
            width: 320px;
            height: 320px;
            border-radius: 5px;
        }


.button-loc {
  align-items: center;
  appearance: none;
  background-color: #fcfcfd;
  border-radius: 4px;
  border-width: 0;
  box-shadow:
    rgba(45, 35, 66, 0.2) 0 2px 4px,
    rgba(45, 35, 66, 0.15) 0 7px 13px -3px,
    #d6d6e7 0 -3px 0 inset;
  box-sizing: border-box;
  color: #36395a;
  cursor: pointer;
  display: inline-flex;
  height: 48px;
  justify-content: center;
  line-height: 1;
  list-style: none;
  overflow: hidden;
  padding-left: 16px;
  padding-right: 16px;
  position: relative;
  text-align: left;
  text-decoration: none;
  transition:
    box-shadow 0.15s,
    transform 0.15s;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  white-space: nowrap;
  will-change: box-shadow, transform;
  font-size: 18px;
}

.button-loc:focus {
  box-shadow:
    #d6d6e7 0 0 0 1.5px inset,
    rgba(45, 35, 66, 0.4) 0 2px 4px,
    rgba(45, 35, 66, 0.3) 0 7px 13px -3px,
    #d6d6e7 0 -3px 0 inset;
}

.button-loc:hover {
  box-shadow:
    rgba(45, 35, 66, 0.3) 0 4px 8px,
    rgba(45, 35, 66, 0.2) 0 7px 13px -3px,
    #d6d6e7 0 -3px 0 inset;
  transform: translateY(-2px);
}

.button-loc:active {
  box-shadow: #d6d6e7 0 3px 7px inset;
  transform: translateY(2px);
}

    </style>

    <?php if(in_array(auth()->guard('siswa')->user()->kelas, ['XI', 'XII'])): ?>
    <script>
        function kelasTidakSesuai(){
            Swal.fire({
                title: 'Kelas Tidak Sesuai!',
                text: "Halo <?php echo e(ucwords(strtolower(auth()->guard('siswa')->user()->nama_siswa))); ?>, data kelas kamu tidak sesuai. Silahkan ubah kelas kamu di edit profile terlebih dahulu sebelum melanjutkan!",
                icon: 'warning',
                confirmButtonText: 'Edit profile',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showCancelButton: false,
                preConfirm: () => {
                    window.location.href = '/Siswa/ubah';
                    return false;
                }
            });
        }


        kelasTidakSesuai();
    </script>
<?php endif; ?>


<div class="container" onload="getLocation();">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center py-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="mb-0">Absen datang


</h1> </br>

                    </div>
                    <h6 id="waktu">Menampilkan Waktu</h6>
                </div>
                <div class="card-body p-5">
                    <?php if(session('gagal')): ?>
                    <div class="alert-danger alert text-center">
                        <?php echo e(session('gagal')); ?>

                    </div>
                    <?php endif; ?>
                    <div class="my-2 mb-3">
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

                          <a class="button text-decoration-none mb-5" href="/Siswa/JurnalPKL/Absen/<?php echo e($id); ?>">
                                                    <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024"><path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path></svg>
                                                    <span>Kembali</span>
                                                </a>

                    </div>
                    <form action="" method="post" enctype="multipart/form-data" id="attendanceForm">
                        <?php echo csrf_field(); ?>
                        <div class=" mb-5 d-flex justify-content-center">
                            <style>
                                .radio-input {
  display: flex;
  flex-direction: row;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  font-size: 16px;
  font-weight: 600;
  color: white;
}

.radio-input input[type="radio"] {
  display: none;
}

.radio-input label {
  display: flex;
  align-items: center;
  padding: 10px;
  border: 1px solid #ccc;
  background-color: #737373;
  border-radius: 5px;
  margin-right: 12px;
  cursor: pointer;
  position: relative;
  transition: all 0.3s ease-in-out;
}

.radio-input label:before {
  content: "";
  display: block;
  position: absolute;
  top: 50%;
  left: 0;
  transform: translate(-50%, -50%);
  width: 10px;
  height: 10px;
  border-radius: 50%;
  background-color: #fff;
  border: 2px solid #ccc;
  transition: all 0.3s ease-in-out;
}

.radio-input input[type="radio"]:checked + label:before {
  background-color: green;
  top: 0;
}

.radio-input input[type="radio"]:checked + label {
  background-color: royalblue;
  color: #fff;
  border-color: rgb(129, 235, 129);
  animation: radio-translate 0.5s ease-in-out;
}

@keyframes radio-translate {
  0% {
    transform: translateX(0);
  }

  50% {
    transform: translateY(-10px);
  }

  100% {
    transform: translateX(0);
  }
}

                            </style>

                            <div class="col-auto text-center mt-4">

                                <p class="text-dark me-3">Kehadiran</p>
                                <div class="radio-input  <?php if($errors->has('izin')): ?> is-invalid <?php endif; ?>">
                                    <input value="0" name="izin" id="hadir" type="radio" <?php if(old('izin') == '0'): ?> checked <?php endif; ?>>
                                    <label for="hadir" onclick="toggleElements('hadir')">Hadir</label>
                                    <input value="1" name="izin" id="absen" type="radio" <?php if(old('izin') == '1'): ?> checked <?php endif; ?>>
                                    <label for="absen" onclick="toggleElements('absen')">Izin</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3" id="fotoContainer" style="display: none;">
                            <div class="row">
                                <div class="col-md-3">
                                  <a href="<?php echo e(asset('storage/absen/selfie.gif')); ?>" data-fancybox="gallery" class="img-preview-link">
                                    <img src="<?php echo e(asset('storage/absen/selfie.gif')); ?>" style="width: 100px; height:100px;" class="img-preview <?php if($errors->has('foto')): ?> is-invalid <?php endif; ?>" alt="">
                                </a>
                                </div>
                                <div class="col-md-7">

                                    <label for="" id="fotoLabel">Inputkan Foto kamu saat di Industri</label>
                                    <input type="file" name="izin" id="izin" style="display: none;" class=" form-control <?php if($errors->has('izin')): ?> is-invalid <?php endif; ?>" onchange="previewImg()" accept="image/*">

                                     <button type="button" id="fotoButton" class=" btn btn-primary <?php if($errors->has('capturedImage')): ?> is-invalid <?php endif; ?>" onclick="captureImage()" style="display: none;"><i class="fa-solid fa-camera"></i> Ambil Foto</button>
                                      <?php if($errors->has('capturedImage')): ?>
                                      <div class="invalid-feedback">
                                          <?php echo e($errors->first('capturedImage')); ?>

                                      </div>
                                      <?php endif; ?>
                                       <?php if($errors->has('izin')): ?>
                                    <div class="invalid-feedback">
                                        <?php echo e($errors->first('izin')); ?>

                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>



                        <input type="hidden" id="latitude" name="latitude">
                        <input type="hidden" id="longitude" name="longitude">
                          <input type="hidden" name="capturedImage" id="capturedImage">
                        <div class="d-flex justify-content-end">

                            <style>
    .Btn {
  --primary-color: #645bff;
  --secondary-color: #fff;
  --hover-color: #111;
  --arrow-width: 10px;
  --arrow-stroke: 2px;

  box-sizing: border-box;
  border: 0;
  border-radius: 20px;
  color: var(--secondary-color);
  padding: 0.7em 1.8em;
  background: var(--primary-color);
  display: none;
  transition: 0.2s background;
  align-items: center;
  gap: 0.6em;
  font-weight: bold;
}

.Btn .arrow-wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
}

.Btn .arrow {
  margin-top: 1px;
  width: var(--arrow-width);
  /* background: var(--primary-color); */
  height: var(--arrow-stroke);
  position: relative;
  transition: 0.2s;
}

.Btn .arrow::before {
  content: "";
  box-sizing: border-box;
  position: absolute;
  border: solid var(--secondary-color);
  border-width: 0 var(--arrow-stroke) var(--arrow-stroke) 0;
  display: inline-block;
  top: -3px;
  right: 3px;
  transition: 0.2s;
  padding: 3px;
  transform: rotate(-45deg);
}

.Btn:hover {
  background-color: var(--hover-color);
}

.Btn:hover .arrow {
  background: var(--secondary-color);
}

.Btn:hover .arrow:before {
  right: 0;
}
   #webcam-container {
    position: relative;
    width: 320px;
    height: 320px;
    margin: 0 auto;
}

#webcam video,
#webcam canvas {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

#webcam-container {
    display: flex;
    justify-content: center;
    align-items: center;
}

#webcam video {
    border-radius: 10px;
}

#webcam canvas {
    pointer-events: none;
}


                             </style>

                             <p id="pesan" class="mt-5"></p>
                             <button type="submit" class="Btn mt-5" id="submitButton">

                              <div class="arrow-wrapper">
                                  <div class="arrow"></div>

                              </div>
                          </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>

.mirror input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

.mirror {
  position: relative;
  cursor: pointer;
  font-size: 17px;
  width: 2em;
  height: 2em;
  user-select: none;
  border: 5px solid #9b9b9b;
  display: block;
}

.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

.checkmark:after {
  content: '';
  position: absolute;
  top: 25%;
  left: 25%;
  background-color: #9b9b9b;
  width: 50%;
  height: 50%;
  transform: scale(0);
  transition: .1s ease;
}

.mirror input:checked ~ .checkmark:after {
  transform: scale(1);
}

#start-scan-button {
  display: inline-flex;
  align-items: center;
  gap: 8px;
}


.mdi--face-recognition {
  display: inline-block;
  width: 1.2em;
  height: 1.2em;
  --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%23000' d='M9 11.75A1.25 1.25 0 0 0 7.75 13A1.25 1.25 0 0 0 9 14.25A1.25 1.25 0 0 0 10.25 13A1.25 1.25 0 0 0 9 11.75m6 0A1.25 1.25 0 0 0 13.75 13A1.25 1.25 0 0 0 15 14.25A1.25 1.25 0 0 0 16.25 13A1.25 1.25 0 0 0 15 11.75M12 2A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2m0 18a8 8 0 0 1-8-8a4 4 0 0 1 0-.86a10.05 10.05 0 0 0 5.26-5.37A9.99 9.99 0 0 0 17.42 10c.76 0 1.51-.09 2.25-.26c1.25 4.26-1.17 8.69-5.41 9.93c-.76.22-1.5.33-2.26.33M0 2a2 2 0 0 1 2-2h4v2H2v4H0zm24 20a2 2 0 0 1-2 2h-4v-2h4v-4h2zM2 24a2 2 0 0 1-2-2v-4h2v4h4v2zM22 0a2 2 0 0 1 2 2v4h-2V2h-4V0z'/%3E%3C/svg%3E");
  background-color: currentColor;
  -webkit-mask-image: var(--svg);
  mask-image: var(--svg);
  -webkit-mask-repeat: no-repeat;
  mask-repeat: no-repeat;
  -webkit-mask-size: 100% 100%;
  mask-size: 100% 100%;
}

</style>
<script src="<?php echo e(asset('aset/js/script3.js')); ?>"></script>



<script src="<?php echo e(asset('aset/js/GetTheLocation.js')); ?>"></script>

  <script>
    function updateTime() {
        const waktu = document.getElementById('waktu');
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const currentTime = `${hours}:${minutes}:${seconds}`;

        waktu.innerHTML = `${currentTime}`;
    }


    setInterval(updateTime, 1000);
</script>

  <script>
  document.addEventListener('contextmenu', function(event) {
    event.preventDefault();
  });


  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\hadir\tambah.blade.php ENDPATH**/ ?>