@extends('layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center py-3">
                    <h1>Pengajuan Siswa</h1>
                </div>
                <div class="card-body p-5">
                   

                    
                     @if(session('error'))
                     <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                     {{session('error')}}
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
                     @endif
                     
                    <div class="my-4">
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
                            
                              <a class="button text-decoration-none" href="/Siswa/Pengajuan">
                                                        <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024"><path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path></svg>
                                                        <span>Kembali</span>
                                                    </a>
                    </div>

                    <form action="" method="post" id="Form">
                        @csrf
                   
                        <div class="form-group col-md-6 mb-3">
                            <label for="pkl">Pilih PKL / Industri</label>
                            <select name="pkl" id="pkl" class="form-select @if($errors->has('pkl')) is-invalid @endif">
                                <option value="" selected disabled hidden>Pilih pkl</option>
                                @foreach($pkl as $j)
                                <option value="{{ $j->idpkl }}" <?php if(old('pkl') == $j->idpkl){ echo 'selected'; } ?>>{{ $j->nama_pkl }} || Bidang Usaha: {{$j->bidang_usaha}} || quota: {{$j->quota_pkl}} Siswa</option>
                                @endforeach
                            </select>
                            @if($errors->has('pkl')) 
                            <div class="invalid-feedback">
                                {{$errors->first('pkl')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-group col-md-6 mb-3" id="jumlahh">
                            <label for="jumlah">Jumlah Siswa</label>
                            <select name="jumlah" id="jumlah" class="form-select @if($errors->has('jumlah')) is-invalid @endif">
                               
                                
                            </select>
                            @if($errors->has('jumlah')) 
                            <div class="invalid-feedback">
                                {{$errors->first('jumlah')}}
                            </div>
                            @endif
                        </div>

                     

                        @if(auth()->guard('siswa')->check())
                        <div class="form-group col-md-6 mb-3" id="form-siswa1">
                            <label for="siswa1">NIS Siswa pertama (Anda sendiri)</label>
                            <input type="text" name="siswa1" id="siswa" class="form-control @if($errors->has('siswa1')) is-invalid @endif" readonly value="{{auth()->guard('siswa')->user()->nisn}}">
                            @if($errors->has('siswa1')) 
                            <div class="invalid-feedback">
                                {{$errors->first('siswa1')}}
                            </div>
                            @endif
                        </div>
                        @else
                        <div class="form-group  mb-3" id="form-siswa1">
                            <label for="siswa1">Nama Siswa pertama</label>
                            <select name="siswa1" id="siswa1" class="form-select @if($errors->has('siswa1')) is-invalid @endif">
                               @foreach($siswa as $s)
                                <option value="{{$s->nisn}}" <?php if(old('siswa1') == $s->nisn){ echo 'selected'; } ?>>Nama: {{$s->nama_siswa}} || NIS {{$s->nisn}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('siswa1')) 
                            <div class="invalid-feedback">
                                {{$errors->first('siswa1')}}
                            </div>
                            @endif
                            <br><br>
                        </div>
                        @endif

                        <div class="form-group mb-3" id="form-siswa2">
                            <label for="siswa2">Nama Siswa kedua</label>
                            <select name="siswa2" id="siswa2" class="form-select @if($errors->has('siswa2')) is-invalid @endif">
                               @foreach($siswa as $s)
                                <option value="{{$s->nisn}}" <?php if(old('siswa2') == $s->nisn){ echo 'selected'; } ?>>Nama: {{$s->nama_siswa}} || NIS {{$s->nisn}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('siswa2')) 
                            <div class="invalid-feedback">
                                {{$errors->first('siswa2')}}
                            </div>
                            @endif
                            <br><br>
                        </div>

                        <div class="form-group mb-3" id="form-siswa3">
                            <label for="siswa3">Nama Siswa ketiga</label>
                            <select name="siswa3" id="siswa3" class="form-select @if($errors->has('siswa3')) is-invalid @endif">
                               @foreach($siswa as $s)
                                <option value="{{$s->nisn}}" <?php if(old('siswa3') == $s->nisn){ echo 'selected'; } ?>>Nama: {{$s->nama_siswa}} || NIS {{$s->nisn}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('siswa3')) 
                            <div class="invalid-feedback">
                                {{$errors->first('siswa3')}}
                            </div>
                            @endif
                            <br><br>
                        </div>

                        <div class="form-group mb-3" id="form-siswa4">
                            <label for="siswa4">Nama Siswa keempat</label>
                            <select name="siswa4" id="siswa4" class="form-select @if($errors->has('siswa4')) is-invalid @endif">
                               @foreach($siswa as $s)
                                <option value="{{$s->nisn}}" <?php if(old('siswa4') == $s->nisn){ echo 'selected'; } ?>>Nama: {{$s->nama_siswa}} || NIS {{$s->nisn}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('siswa4')) 
                            <div class="invalid-feedback">
                                {{$errors->first('siswa4')}}
                            </div>
                            @endif
                            <br><br>
                        </div>

                        <div class="form-group mb-3 col-md-6">
                            <label for="tahunPelajaran">Tahun Pelajaran</label>
                         <select class="form-select @if($errors->has('tahunPelajaran')) is-invalid @endif" name="tahunPelajaran" id="tahunPelajaran" value="{{old('tahunPelajaran')}}">
                            <option value="" selected disabled hidden>Pilih Tahun Pelajaran</option>
                            </select>
                            @if($errors->has('tahunPelajaran')) 
                            <div class="invalid-feedback">
                                {{$errors->first('tahunPelajaran')}}
                            </div>
                            @endif
                                        </div>

                                        <div class="form-group mb-3 col-md-6">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control @if($errors->has('tanggal')) is-invalid @endif" value="<?php if(old('tanggal')){ echo old('tanggal'); }else{ echo date('Y-m-d'); } ?>" readonly>
                            @if($errors->has('tanggal')) 
                            <div class="invalid-feedback">
                                {{$errors->first('tanggal')}}
                            </div>
                            @endif
                                        </div>

                                        <div class="form-group mb-3 col-md-6">
                            <label for="mulai">Mulai Tanggal</label>
                            <input type="date" name="mulai" id="mulai" class="form-control @if($errors->has('mulai')) is-invalid @endif" value="{{old('mulai')}}">
                            @if($errors->has('mulai')) 
                            <div class="invalid-feedback">
                                {{$errors->first('mulai')}}
                            </div>
                            @endif
                                        </div>

                                        <div class="form-group mb-3 col-md-6">
                            <label for="akhir">Sampai Tanggal</label>
                            <input type="date" name="akhir" id="akhir" class="form-control @if($errors->has('akhir')) is-invalid @endif" value="{{old('akhir')}}">
                            @if($errors->has('akhir')) 
                            <div class="invalid-feedback">
                                {{$errors->first('akhir')}}
                            </div>
                            @endif
                                        </div>

                                        <div class="form-floating mb-3 col-md-8">
                            <input type="number" class="form-control @if($errors->has('lama')) is-invalid @endif" name="lama" id="lama" placeholder="" value="{{old('lama')}}" readonly>
                            <label for="lama">Lamanya melaksanakan PKL (dalam bulan)</label>
                            @if($errors->has('lama')) 
                            <div class="invalid-feedback">
                                {{$errors->first('lama')}}
                            </div>
                            @endif
                        </div>



                                        <div class="form-group mb-3 col-md-5">
                            <label for="kepalasekolah">Pilih Kepala Sekolah</label>
                            <select name="kepalasekolah" id="kepalasekolah" class="form-select   @if($errors->has('kepalasekolah')) is-invalid @endif">
                                <option value="" disabled hidden selected>-- Pilih kepala Sekolah --</option>
                                @foreach($kSekolah as $k)
                                <option value="{{$k->id}}" <?php if(old('kepalasekolah') == $k->id){ echo 'selected'; } ?>>{{$k->name}}</option>
                               @endforeach
                            </select>
                            @if($errors->has('kepalasekolah')) 
                            <div class="invalid-feedback">
                                {{$errors->first('kepalasekolah')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-floating mb-3 col-md-6">
                            <input type="number" class="form-control @if($errors->has('tahun')) is-invalid @endif" name="tahun" id="tahun" placeholder="" value="{{date('Y')}}" readonly>
                            <label for="tahun">Tahun</label>
                            @if($errors->has('tahun')) 
                            <div class="invalid-feedback">
                                {{$errors->first('tahun')}}
                            </div>
                            @endif
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <style>
                                .continue-application {
  --color: #fff;
  --background: #404660;
  --background-hover: #3A4059;
  --background-left: #2B3044;
  --folder: #F3E9CB;
  --folder-inner: #BEB393;
  --paper: #FFFFFF;
  --paper-lines: #BBC1E1;
  --paper-behind: #E1E6F9;
  --pencil-cap: #fff;
  --pencil-top: #275EFE;
  --pencil-middle: #fff;
  --pencil-bottom: #5C86FF;
  --shadow: rgba(13, 15, 25, .2);
  border: none;
  outline: none;
  cursor: pointer;
  position: relative;
  border-radius: 5px;
  font-size: 14px;
  font-weight: 500;
  line-height: 19px;
  -webkit-appearance: none;
  -webkit-tap-highlight-color: transparent;
  padding: 17px 29px 17px 69px;
  transition: background 0.3s;
  color: var(--color);
  background: var(--bg, var(--background));
}

.continue-application > div {
  top: 0;
  left: 0;
  bottom: 0;
  width: 53px;
  position: absolute;
  overflow: hidden;
  border-radius: 5px 0 0 5px;
  background: var(--background-left);
}

.continue-application > div .folder {
  width: 23px;
  height: 27px;
  position: absolute;
  left: 15px;
  top: 13px;
}

.continue-application > div .folder .top {
  left: 0;
  top: 0;
  z-index: 2;
  position: absolute;
  transform: translateX(var(--fx, 0));
  transition: transform 0.4s ease var(--fd, 0.3s);
}

.continue-application > div .folder .top svg {
  width: 24px;
  height: 27px;
  display: block;
  fill: var(--folder);
  transform-origin: 0 50%;
  transition: transform 0.3s ease var(--fds, 0.45s);
  transform: perspective(120px) rotateY(var(--fr, 0deg));
}

.continue-application > div .folder:before, .continue-application > div .folder:after,
.continue-application > div .folder .paper {
  content: "";
  position: absolute;
  left: var(--l, 0);
  top: var(--t, 0);
  width: var(--w, 100%);
  height: var(--h, 100%);
  border-radius: 1px;
  background: var(--b, var(--folder-inner));
}

.continue-application > div .folder:before {
  box-shadow: 0 1.5px 3px var(--shadow), 0 2.5px 5px var(--shadow), 0 3.5px 7px var(--shadow);
  transform: translateX(var(--fx, 0));
  transition: transform 0.4s ease var(--fd, 0.3s);
}

.continue-application > div .folder:after,
.continue-application > div .folder .paper {
  --l: 1px;
  --t: 1px;
  --w: 21px;
  --h: 25px;
  --b: var(--paper-behind);
}

.continue-application > div .folder:after {
  transform: translate(var(--pbx, 0), var(--pby, 0));
  transition: transform 0.4s ease var(--pbd, 0s);
}

.continue-application > div .folder .paper {
  z-index: 1;
  --b: var(--paper);
}

.continue-application > div .folder .paper:before, .continue-application > div .folder .paper:after {
  content: "";
  width: var(--wp, 14px);
  height: 2px;
  border-radius: 1px;
  transform: scaleY(0.5);
  left: 3px;
  top: var(--tp, 3px);
  position: absolute;
  background: var(--paper-lines);
  box-shadow: 0 12px 0 0 var(--paper-lines), 0 24px 0 0 var(--paper-lines);
}

.continue-application > div .folder .paper:after {
  --tp: 6px;
  --wp: 10px;
}

.continue-application > div .pencil {
  height: 2px;
  width: 3px;
  border-radius: 1px 1px 0 0;
  top: 8px;
  left: 105%;
  position: absolute;
  z-index: 3;
  transform-origin: 50% 19px;
  background: var(--pencil-cap);
  transform: translateX(var(--pex, 0)) rotate(35deg);
  transition: transform 0.4s ease var(--pbd, 0s);
}

.continue-application > div .pencil:before, .continue-application > div .pencil:after {
  content: "";
  position: absolute;
  display: block;
  background: var(--b, linear-gradient(var(--pencil-top) 55%, var(--pencil-middle) 55.1%, var(--pencil-middle) 60%, var(--pencil-bottom) 60.1%));
  width: var(--w, 5px);
  height: var(--h, 20px);
  border-radius: var(--br, 2px 2px 0 0);
  top: var(--t, 2px);
  left: var(--l, -1px);
}

.continue-application > div .pencil:before {
  -webkit-clip-path: polygon(0 5%, 5px 5%, 5px 17px, 50% 20px, 0 17px);
  clip-path: polygon(0 5%, 5px 5%, 5px 17px, 50% 20px, 0 17px);
}

.continue-application > div .pencil:after {
  --b: none;
  --w: 3px;
  --h: 6px;
  --br: 0 2px 1px 0;
  --t: 3px;
  --l: 3px;
  border-top: 1px solid var(--pencil-top);
  border-right: 1px solid var(--pencil-top);
}

.continue-application:before, .continue-application:after {
  content: "";
  position: absolute;
  width: 10px;
  height: 2px;
  border-radius: 1px;
  background: var(--color);
  transform-origin: 9px 1px;
  transform: translateX(var(--cx, 0)) scale(0.5) rotate(var(--r, -45deg));
  top: 26px;
  right: 16px;
  transition: transform 0.3s;
}

.continue-application:after {
  --r: 45deg;
}

.continue-application:hover {
  --cx: 2px;
  --bg: var(--background-hover);
  --fx: -40px;
  --fr: -60deg;
  --fd: .15s;
  --fds: 0s;
  --pbx: 3px;
  --pby: -3px;
  --pbd: .15s;
  --pex: -24px;
}

                            </style>
                            <button type="submit" class="continue-application mt-5">
                                <div>
                                    <div class="pencil"></div>
                                    <div class="folder">
                                        <div class="top">
                                            <svg viewBox="0 0 24 27">
                                                <path d="M1,0 L23,0 C23.5522847,-1.01453063e-16 24,0.44771525 24,1 L24,8.17157288 C24,8.70200585 23.7892863,9.21071368 23.4142136,9.58578644 L20.5857864,12.4142136 C20.2107137,12.7892863 20,13.2979941 20,13.8284271 L20,26 C20,26.5522847 19.5522847,27 19,27 L1,27 C0.44771525,27 6.76353751e-17,26.5522847 0,26 L0,1 C-6.76353751e-17,0.44771525 0.44771525,1.01453063e-16 1,0 Z"></path>
                                            </svg>
                                        </div>
                                        <div class="paper"></div>
                                    </div>
                                </div>
                                Dapatkan surat
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
    event.preventDefault(); 

    Swal.fire({
    title: 'Sedang proses, mohon tunggu sebentar...',
    imageUrl: '{{ asset("storage/pengajuan/tulis.gif") }}',
    imageWidth: 200,
    imageHeight: 200,
    timerProgressBar: true,
    allowOutsideClick: false,
    allowEscapeKey: false,
    showConfirmButton: false


});

event.target.submit();
});
</script>
<script>
  $(document).ready(function(){
    $('#pkl').select2();
    $('#jumlahh').hide();

    $('#siswa1').select2();
    $('#siswa2').select2();
    $('#siswa3').select2();
    $('#siswa4').select2();
    $('#form-siswa1').hide();
    $('#form-siswa2').hide();
    $('#form-siswa3').hide();
    $('#form-siswa4').hide();
    
    var id_pkl = $('#pkl').val();
        if(id_pkl){
            $.ajax({
                url: '/get-quota/' + id_pkl, 
                type: 'GET',
                dataType: 'json',
                success: function (response){
                    $('#jumlah').empty(); 
                    var maxOptions = Math.min(response.quota, 4); 
                    for (var i = 1; i <= maxOptions; i++) {
                        var selected = '';
                        if ('{{ old("jumlah") }}' == i) {
                            selected = 'selected';
                        }
                        $('#jumlah').append('<option value="' + i + '" ' + selected + '>' + i + ' Siswa</option>');
                    
                    }
                    $('#jumlahh').show();
                    $('#jumlah').change(function(){
                        if($(this).val() == '1'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').hide();
                            $('#form-siswa3').hide();
                            $('#form-siswa4').hide();
                        }
                        else if($(this).val() == '2'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').show();
                            $('#form-siswa3').hide();
                            $('#form-siswa4').hide();
                        }
                        else if($(this).val() == '3'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').show();
                            $('#form-siswa3').show();
                            $('#form-siswa4').hide();
                        }
                        else if($(this).val() == '4'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').show();
                            $('#form-siswa3').show();
                            $('#form-siswa4').show();
                        }
                    });
                    if($('#jumlah').val() == '1'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').hide();
                            $('#form-siswa3').hide();
                            $('#form-siswa4').hide();
                        }
                        else if($('#jumlah').val() == '2'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').show();
                            $('#form-siswa3').hide();
                            $('#form-siswa4').hide();
                        }
                        else if($('#jumlah').val() == '3'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').show();
                            $('#form-siswa3').show();
                            $('#form-siswa4').hide();
                        }
                        else if($('#jumlah').val() == '4'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').show();
                            $('#form-siswa3').show();
                            $('#form-siswa4').show();
                        }
                },
                error: function(error){
                    console.log(error);
                }
            });
        } else {
            $('#jumlahh').hide();
        }
    $('#pkl').change(function(){
        var id_pkl = $(this).val();
        if(id_pkl){
            $.ajax({
                url: '/get-quota/' + id_pkl, 
                type: 'GET',
                dataType: 'json',
                success: function (response){
                    $('#jumlah').empty(); 
                    var maxOptions = Math.min(response.quota, 4); 
                    for (var i = 1; i <= maxOptions; i++) {
                        $('#jumlah').append('<option value="' + i + '">' + i + ' Siswa</option>');
                    }
                    $('#jumlahh').show();
                    $('#jumlah').change(function(){
                        if($(this).val() == '1'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').hide();
                            $('#form-siswa3').hide();
                            $('#form-siswa4').hide();
                        }
                        else if($(this).val() == '2'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').show();
                            $('#form-siswa3').hide();
                            $('#form-siswa4').hide();
                        }
                        else if($(this).val() == '3'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').show();
                            $('#form-siswa3').show();
                            $('#form-siswa4').hide();
                        }
                        else if($(this).val() == '4'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').show();
                            $('#form-siswa3').show();
                            $('#form-siswa4').show();
                        }
                    });
                    if($('#jumlah').val() == '1'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').hide();
                            $('#form-siswa3').hide();
                            $('#form-siswa4').hide();
                        }
                        else if($('#jumlah').val() == '2'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').show();
                            $('#form-siswa3').hide();
                            $('#form-siswa4').hide();
                        }
                        else if($('#jumlah').val() == '3'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').show();
                            $('#form-siswa3').show();
                            $('#form-siswa4').hide();
                        }
                        else if($('#jumlah').val() == '4'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').show();
                            $('#form-siswa3').show();
                            $('#form-siswa4').show();
                        }
                },
                error: function(error){
                    console.log(error);
                }
            });
        } else {
            $('#jumlahh').hide();
        }
    });
    var currentYear = new Date().getFullYear();

   
    for (var i = 0; i < 3; i++) {
    var startYear = currentYear + i - 1;
    var endYear = startYear + 1;
    var optionText = startYear + '/' + endYear;
        $('#tahunPelajaran').append('<option value="' + optionText + '">' + optionText + '</option>');
    }
    var mulai = new Date($('#mulai').val());
        var akhir = new Date($('#akhir').val());

        if (mulai && akhir) {
            // Hitung selisih dalam bulan
            var differenceInMonths = (akhir.getFullYear() - mulai.getFullYear()) * 12 + (akhir.getMonth() - mulai.getMonth());

            // Set nilai lama dengan tambahan kata 'bulan'
            $('#lama').val(differenceInMonths);
        }
    $('#mulai, #akhir').change(function() {
        var mulai = new Date($('#mulai').val());
        var akhir = new Date($('#akhir').val());

        if (mulai && akhir) {
            // Hitung selisih dalam bulan
            var differenceInMonths = (akhir.getFullYear() - mulai.getFullYear()) * 12 + (akhir.getMonth() - mulai.getMonth());

            // Set nilai lama dengan tambahan kata 'bulan'
            $('#lama').val(differenceInMonths);
        }
    });
});

</script>
@endsection
