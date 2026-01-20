@extends('layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center py-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="mb-0">Tentukan data kegiatan harian</h1>
                    </div>
                </div>
                <div class="card-body p-5">
                    @if(session('error'))
                        <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}',
            confirmButtonText: 'Oke'
        });
    </script>
                    @endif

                    
                    <div class="my-4">
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
                            
                              <a class="kembali text-decoration-none" href="/Siswa/JurnalPKL/harian/{{$id}}" >
                                                        <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024"><path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path></svg>
                                                        <span>Kembali</span>
                                                    </a>

                    </div>
                    <form action="" method="post" enctype="multipart/form-data" id="Form">
                        @csrf

                        <div class="form-group mb-4 col-md-8">
                            <label for="tentukan">Tentukan absen berdasarkan</label>
                            <select name="tentukan" id="tentukan" class="form-select">
                                <option value="0" <?php if(old('tentukan') == '0'){ echo 'selected'; } ?>>Semua Kegiatan harian</option>
                                <option value="1" <?php if(old('tentukan') == '1'){ echo 'selected'; } ?>>Berdasarkan tanggal</option>
                            </select>
                        </div>
                        
                        <div class="form-group mb-3 col-md-8" id='1'>
                            <label for="awal"><i class="fa-solid fa-hourglass-start"></i> Antara Tanggal</label>
                            <input type="date" name="awal" id="awal" class="form-control @if($errors->has('awal')) is-invalid @endif" value="{{old('awal')}}">
                            @if($errors->has('awal'))
                            <div class="invalid-feedback">
                                {{$errors->first('awal')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-group mb-3 col-md-8" id='2'>
                            <label for="akhir"><i class="fa-solid fa-hourglass-end"></i> Sampai Tanggal</label>
                            <input type="date" name="akhir" id="akhir" class="form-control @if($errors->has('akhir')) is-invalid @endif"value="{{old('akhir')}}">
                            @if($errors->has('akhir'))
                            <div class="invalid-feedback">
                                {{$errors->first('akhir')}}
                            </div>
                            @endif
                        </div>
                        
                         
                      
                   
                        <div class="d-flex justify-content-end">
                            <style>
                                .Documents-btn {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  width: fit-content;
  height: 45px;
  border: none;
  padding: 0px 15px;
  border-radius: 5px;
  background-color: rgb(49, 49, 83);
  gap: 10px;
  cursor: pointer;
  transition: all 0.3s;
}
.folderContainer {
  width: 40px;
  height: fit-content;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-end;
  position: relative;
}
.fileBack {
  z-index: 1;
  width: 80%;
  height: auto;
}
.filePage {
  width: 50%;
  height: auto;
  position: absolute;
  z-index: 2;
  transition: all 0.3s ease-out;
}
.fileFront {
  width: 85%;
  height: auto;
  position: absolute;
  z-index: 3;
  opacity: 0.95;
  transform-origin: bottom;
  transition: all 0.3s ease-out;
}
.text {
  color: white;
  font-size: 14px;
  font-weight: 600;
  letter-spacing: 0.5px;
}
.Documents-btn:hover .filePage {
  transform: translateY(-5px);
}
.Documents-btn:hover {
  background-color: rgb(58, 58, 94);
}
.Documents-btn:active {
  transform: scale(0.95);
}
.Documents-btn:hover .fileFront {
  transform: rotateX(30deg);
}

                            </style>
                            <button class="Documents-btn mt-5" type="submit">
                                <span class="folderContainer">
                                  <svg
                                    class="fileBack"
                                    width="146"
                                    height="113"
                                    viewBox="0 0 146 113"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                  >
                                    <path
                                      d="M0 4C0 1.79086 1.79086 0 4 0H50.3802C51.8285 0 53.2056 0.627965 54.1553 1.72142L64.3303 13.4371C65.2799 14.5306 66.657 15.1585 68.1053 15.1585H141.509C143.718 15.1585 145.509 16.9494 145.509 19.1585V109C145.509 111.209 143.718 113 141.509 113H3.99999C1.79085 113 0 111.209 0 109V4Z"
                                      fill="url(#paint0_linear_117_4)"
                                    ></path>
                                    <defs>
                                      <linearGradient
                                        id="paint0_linear_117_4"
                                        x1="0"
                                        y1="0"
                                        x2="72.93"
                                        y2="95.4804"
                                        gradientUnits="userSpaceOnUse"
                                      >
                                        <stop stop-color="#8F88C2"></stop>
                                        <stop offset="1" stop-color="#5C52A2"></stop>
                                      </linearGradient>
                                    </defs>
                                  </svg>
                                  <svg
                                    class="filePage"
                                    width="88"
                                    height="99"
                                    viewBox="0 0 88 99"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                  >
                                    <rect width="88" height="99" fill="url(#paint0_linear_117_6)"></rect>
                                    <defs>
                                      <linearGradient
                                        id="paint0_linear_117_6"
                                        x1="0"
                                        y1="0"
                                        x2="81"
                                        y2="160.5"
                                        gradientUnits="userSpaceOnUse"
                                      >
                                        <stop stop-color="white"></stop>
                                        <stop offset="1" stop-color="#686868"></stop>
                                      </linearGradient>
                                    </defs>
                                  </svg>
                              
                                  <svg
                                    class="fileFront"
                                    width="160"
                                    height="79"
                                    viewBox="0 0 160 79"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                  >
                                    <path
                                      d="M0.29306 12.2478C0.133905 9.38186 2.41499 6.97059 5.28537 6.97059H30.419H58.1902C59.5751 6.97059 60.9288 6.55982 62.0802 5.79025L68.977 1.18034C70.1283 0.410771 71.482 0 72.8669 0H77H155.462C157.87 0 159.733 2.1129 159.43 4.50232L150.443 75.5023C150.19 77.5013 148.489 79 146.474 79H7.78403C5.66106 79 3.9079 77.3415 3.79019 75.2218L0.29306 12.2478Z"
                                      fill="url(#paint0_linear_117_5)"
                                    ></path>
                                    <defs>
                                      <linearGradient
                                        id="paint0_linear_117_5"
                                        x1="38.7619"
                                        y1="8.71323"
                                        x2="66.9106"
                                        y2="82.8317"
                                        gradientUnits="userSpaceOnUse"
                                      >
                                        <stop stop-color="#C3BBFF"></stop>
                                        <stop offset="1" stop-color="#51469A"></stop>
                                      </linearGradient>
                                    </defs>
                                  </svg>
                                </span>
                                <p class="text mt-3">Dapatkan file</p>
                              </button>
                              
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
   document.getElementById('Form').addEventListener('submit', function(event) {
    Swal.fire({
        icon: 'info',
        title: 'Perhatian!',
        text: 'Pastikan kamu memiliki koneksi internet yang stabil. Jika file yang diunduh mengalami error, coba gunakan Wi-Fi atau perbaiki koneksi internetmu agar lebih stabil dan coba "Dapatkan file" lagi.',
        confirmButtonText: 'Oke'
    });
    });
</script>
<script>

    $(document).ready(function(){
        $('#1').hide();
        $('#2').hide();
        if($('#tentukan').val() == '1'){
            $('#1').show();
            $('#2').show();
        }else{
            $('#1').hide();
            $('#2').hide();
        }
        $('#tentukan').change(function(){
        if($('#tentukan').val() == '1'){
            $('#1').show();
            $('#2').show();
        }else{
            $('#1').hide();
            $('#2').hide();
        }
        });

        
    });

</script>
    

@endsection