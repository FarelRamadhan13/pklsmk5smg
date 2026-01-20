@extends('layout.app')
@section('content')

<style>
  

.Btn {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: flex-start;
  width: 100px;
  height: 40px;
  border: none;
  padding: 0px 20px;
  background-color: rgb(72, 72, 72);
  color: white;
  font-weight: 700;
  cursor: pointer;
  border-radius: 10px;
  box-shadow: 5px 5px 0px black;
  transition-duration: 0.3s;
}

.svg {
  width: 13px;
  position: absolute;
  right: 0;
  margin-right: 20px;
  fill: white;
  transition-duration: 0.3s;
}

.Btn:hover {
  color: transparent;
}

.Btn:hover svg {
  right: 43%;
  margin: 0;
  padding: 0;
  border: none;
  transition-duration: 0.3s;
}

.Btn:active {
  transform: translate(3px, 3px);
  transition-duration: 0.3s;
  box-shadow: 2px 2px 0px white;
}
</style>
<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center py-3">
                    <h1>Ubah foto</h1>
                </div>
                <div class="card-body p-5">
                    @if(session('gagal'))
                    <div class="alert-danger alert text-center">
                        {{session('gagal')}}
                    </div>
                    @endif
                    <div class="my-4 mb-5">
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
                        </style>
                        
                          <a class="button text-decoration-none" href="/Siswa">
                                                    <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024"><path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path></svg>
                                                    <span>Kembali</span>
                                                </a>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data" id="Form">
                        @csrf
                         <div class="d-flex justify-content-center align-items-center mb-3">
                             <div class="shiny-image">
                              <a href="{{ asset('storage/foto_profile_siswa/' . auth()->guard('siswa')->user()->foto_siswa) }}" class="fancybox" data-fancybox="gallery" data-caption="Foto Profile yang bagus">
                              <img src="{{asset('storage/foto_profile_siswa/' . auth()->guard('siswa')->user()->foto_siswa)}}" style="width: 190px; height:190px;" class="img-preview rounded-circle @if($errors->has('foto')) is-invalid @endif" alt="">
                              </a>
                              </div>
                        </div>
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
                            <div class="row">
                                <div class="col-md-2">
                                  
                                </div>
                                <div class="col-md-7">
                                    <label for="foto">Ubah Foto anda</label>
                                    <input type="file" name="foto" id="foto" class="form-control @if($errors->has('foto')) is-invalid @endif" onchange="previewImg()" accept="image/*">



                                    @if($errors->has('foto'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('foto')}}
                                    </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="Btn" type="submit">
                                Ubah
                                <svg viewBox="0 0 512 512" class="svg">
                                  <path
                                    d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"
                                  ></path>
                                </svg>
                              </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    $(document).ready(function() {

    });
</script>
<script>
    function previewImg() {
        var input = document.getElementById('foto');
        var preview = document.querySelector('.img-preview');
        var file = input.files[0];
        var reader = new FileReader();
        var fancyBox = document.querySelector('.fancybox');

        reader.onloadend = function() {
            preview.src = reader.result;
            fancyBox.href = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
<script>
     document.getElementById('Form').addEventListener('submit', function(e) {
  

  Swal.fire({
     
      title: 'Sedang Memproses',
      allowOutsideClick: false,
      showConfirmButton: false,
      willOpen: () => {
          Swal.showLoading();
      }
  });
  });
</script>

@endsection