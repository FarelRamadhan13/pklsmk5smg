@extends('layout.app')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/tracking/build/tracking-min.js"></script>
 <!--<script src="https://cdn.jsdelivr.net/npm/clmtrackr@latest/build/clmtrackr.min.js"></script>-->
<!--<script src="https://cdn.jsdelivr.net/npm/clmtrackr@latest/models/model_pca_20_svm.js"></script>-->
 
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

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center py-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="mb-0">Absen pulang</h1>
                    </div>
                      <h6 id="waktu">Loading...</h6>
                </div>
                <div class="card-body p-5">
                    @if(session('gagal'))
                    <div class="alert-danger alert text-center">
                        {{session('gagal')}}
                    </div>
                    @endif
                    <div class="my-3 mb-5">
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
                            
                              <a class="button text-decoration-none mb-5" href="/Siswa/JurnalPKL/Absen/{{$id}}">
                                                        <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024"><path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path></svg>
                                                        <span>Kembali</span>
                                                    </a>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data" id="attendanceForm">
                        @csrf
                        <div class="col-md-4 mb-3">
                            <input type="hidden" value="{{now()}}" name="tanggal">
                            <input type="hidden" id="waktu" name="waktu" class="form-control @if($errors->has('waktu')) is-invalid @endif" value="{{now()->format('H:i:s')}}" readonly>
                            @if($errors->has('waktu'))
                            <div class="invalid-feedback">
                                {{$errors->first('waktu')}}
                            </div>
                            @endif
                        </div>

                       <div class="form-group mb-3">
    <div class="row align-items-center">
        <div class="col-md-3 text-center">
            <a href="#" class="fancybox img-preview-link" data-fancybox="gallery">
                <img id="fotoPreview" 
                     src="https://via.placeholder.com/100x100?text=Foto" 
                     style="width: 100px; height:100px; border-radius: 10px; object-fit: cover; border: 2px solid #ddd;" 
                     class="img-preview @if($errors->has('foto')) is-invalid @endif" 
                     alt="Foto Preview">
            </a>
        </div>
        <div class="col-md-7">
            <label for="" class="mt-2 d-block" id="fotoLabel">Silahkan ambil foto wajah kamu saat pulang industri</label>
            
            <button type="button" id="fotoButton" class="btn btn-primary shadow-sm" onclick="captureImage()">
                <i class="fa-solid fa-camera"></i> Ambil Foto
            </button>

            @if($errors->has('capturedImage'))
            <div class="invalid-feedback">
                {{$errors->first('capturedImage')}}
            </div>
            @endif
        </div>
    </div>
</div>

                        <input type="hidden" id="latitude" name="latitude_pulang">
                        <input type="hidden" id="longitude" name="longitude_pulang">
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
  background: var(--primary-color);
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
    margin: 0 auto; /* Memusatkan container */
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
                             <p class="mt-5" id="pesan"></p>
                              <!-- <button class="Btn mt-5" type="submit" id="submitButton">

                                <div class="sign"><svg viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path></svg></div>
                                
                                <div class="text">Absen Pulang</div>
                            </button> -->
                         
<button type="submit" class="Btn mt-5" id="submitButton">
    Absen Pulang
    <div class="arrow-wrapper">
        <div class="arrow"></div>

    </div>
</button>
                        </div>
                    </form>
                    {{-- <div id="locationAlert" class="alert alert-warning mt-3" style="display: none;">
                        Tolong izinkan akses lokasi anda melalui pengaturan browser. 
                        <br>
                        Instruksi:
                        <ul>
                            <li>Google Chrome: Klik ikon kunci di sebelah kiri alamat situs, pilih "Izin", dan izinkan akses lokasi.</li>
                            <li>Mozilla Firefox: Klik ikon kunci di sebelah kiri alamat situs, pilih "Izin" dan izinkan akses lokasi.</li>
                            <li>Microsoft Edge: Klik ikon kunci di sebelah kiri alamat situs, pilih "Izin" dan izinkan akses lokasi.</li>
                            <li>Safari: Buka "Preferensi Safari" > "Situs Web" > "Lokasi" dan izinkan akses lokasi untuk situs ini.</li>
                        </ul>
                    </div> --}}
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
  border: 5px solid #0d6efd;
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
  background-color: #0d6efd;
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
  gap: 8px; /* Jarak antara ikon dan teks */
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
<script src="{{ asset('aset/js/script3.js') }}">

</script>
<script src="{{ asset('aset/js/GetTheLocation.js') }}">

 </script>
 
 <script>
    function previewImg() {
        var input = document.getElementById('foto');
        var preview = document.querySelector('.img-preview');
        var fancyboxLink = document.querySelector('.fancybox');
        var file = input.files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
            fancyboxLink.href = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        }

        var submitButton = document.getElementById('submitButton');
        submitButton.style.display = 'flex';
    }
</script>
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
 
  document.addEventListener('keydown', function(event) {
     // Menonaktifkan F12, Ctrl+Shift+I, Ctrl+Shift+J, Ctrl+U
     if (event.keyCode == 123 || 
         (event.ctrlKey && event.shiftKey && (event.keyCode == 73 || event.keyCode == 74)) ||
         (event.ctrlKey && event.keyCode == 85)) {
      event.preventDefault();
     }
  });
 </script>
@endsection