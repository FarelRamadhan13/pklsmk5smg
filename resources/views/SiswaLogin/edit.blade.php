@extends('layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center py-3">
                    <h1>Edit Profile</h1>
                </div>
                <div class="card-body p-5">
                    @if(session('gagal'))
                    <div class="alert-danger alert text-center">
                        {{session('gagal')}}
                    </div>
                    @endif
                    <div class="my-3">
                        <style>
                            .btn {
  cursor: pointer;
  transition: transform 200ms ease-in-out;
}

.btn:hover {
  transform: scale(1.25);
}

.btn:active {
  transform: scale(1);
}

.svg-icon {
  stroke: #7d7d7d; 
}



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

.simpan {
  font-family: inherit;
  font-size: 15px;
  background: #212121;
  color: white;
  fill: rgb(155, 153, 153);
  padding: 0.7em 1em;
  padding-left: 0.9em;
  display: flex;
  align-items: center;
  cursor: pointer;
  border: none;
  border-radius: 15px;
  font-weight: 700;
}

.simpan span {
  display: block;
  margin-left: 0.3em;
  transition: all 0.3s ease-in-out;
}

.simpan svg {
  display: block;
  transform-origin: center center;
  transition: transform 0.3s ease-in-out;
}

.simpan:hover {
  background: #000;
}

.simpan:hover .svg-wrapper {
  transform: scale(1.25);
  transition: 0.5s linear;
}

.simpan:hover svg {
  transform: translateX(1.5em) scale(1.1);
  fill: #fff;
}

.simpan:hover span {
  opacity: 0;
  transition: 0.5s linear;
}

.simpan:active {
  transform: scale(0.95);
}


                        </style>
                        <a class="button text-decoration-none mb-5" href="/Siswa">
                            <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024"><path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path></svg>
                            <span>Kembali</span>
                        </a>
                          
                    </div>
                    <form action="" method="post" enctype="multipart/form-data" id="Form">
                        @csrf
                       
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @if($errors->has('nisn')) is-invalid @endif" name="nisn" id="nisn" placeholder="" value="{{$siswa->nisn}}" readonly>
                            <label for="nisn">NIS</label>
                            @if($errors->has('nisn')) 
                            <div class="invalid-feedback">
                                {{$errors->first('nisn')}}
                            </div>
                            @endif
                        </div>
                     
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @if($errors->has('nama')) is-invalid @endif" name="nama" id="nama" placeholder="" value="{{$siswa->nama_siswa}}">
                            <label for="nama">Nama</label>
                            @if($errors->has('nama')) 
                            <div class="invalid-feedback">
                                {{$errors->first('nama')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @if($errors->has('alamat')) is-invalid @endif" name="alamat" id="alamat" placeholder="" value="{{$siswa->alamat}}">
                            <label for="alamat">Alamat</label>
                            @if($errors->has('alamat')) 
                            <div class="invalid-feedback">
                                {{$errors->first('alamat')}}
                            </div>
                            @endif
                        </div>
                       

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @if($errors->has('telp')) is-invalid @endif" name="telp" id="telp" placeholder="" value="{{$siswa->telp}}">
                            <label for="telp">Telephone</label>
                            @if($errors->has('telp')) 
                            <div class="invalid-feedback">
                                {{$errors->first('telp')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-group mb-3 col-md-5">
                            <label for="kelas">Kelas</label>
                            <select name="kelas" id="kelas" class="form-select @error('kelas') is-invalid @enderror">
                                <option value="" disabled selected hidden>Pilih Kelas</option>
                                @foreach($jurusan as $k)
                                    @for ($i = 1; $i <= 3; $i++)
                                        @php
                                            $value = "X " . $k->nama_jurusan . " " . $i;
                                        @endphp
                                        <option value="{{ $value }}" @selected(trim(old('kelas', $siswa->kelas)) == trim($value))>{{ $value }}</option>
                                    @endfor
                                    @for ($i = 1; $i <= 3; $i++)
                                        @php
                                            $value = "XI " . $k->nama_jurusan . " " . $i;
                                        @endphp
                                        <option value="{{ $value }}" @selected(trim(old('kelas', $siswa->kelas)) == trim($value))>{{ $value }}</option>
                                    @endfor
                                    @for ($i = 1; $i <= 3; $i++)
                                        @php
                                            $value = "XII " . $k->nama_jurusan . " " . $i;
                                        @endphp
                                        <option value="{{ $value }}" @selected(trim(old('kelas', $siswa->kelas)) == trim($value))>{{ $value }}</option>
                                    @endfor
                                @endforeach
                            </select>
                            @error('kelas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        

                        <div class="form-floating mb-3">
                            <input type="number" class="form-control @if($errors->has('tahun')) is-invalid @endif" name="tahun" id="tahun" placeholder="" value="{{$siswa->tahun}}">
                            <label for="tahun">tahun</label>
                            @if($errors->has('tahun')) 
                            <div class="invalid-feedback">
                                {{$errors->first('tahun')}}
                            </div>
                            @endif
                        </div>
                     

                        <div class="form-group mb-3 col-md-5">
                            <select name="jurusan" id="jurusan" class="form-select @if($errors->has('jurusan')) is-invalid @endif">
                                <option value="" disabled hidden selected>-- pilih Jurusan --</option>
                                @foreach($jurusan as $j)
                                <option value="{{$j->id_jurusan}}" <?php if($siswa->id_jurusan == $j->id_jurusan){ echo 'selected'; } ?>>{{$j->nama_jurusan}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('jurusan')) 
                            <div class="invalid-feedback">
                                {{$errors->first('jurusan')}}
                            </div>
                            @endif
                        </div>
<hr>
<div class="form-floating mb-3">
    <input type="text" class="form-control @if($errors->has('tampat_tanggal_lahir')) is-invalid @endif" name="tampat_tanggal_lahir" id="tampat_tanggal_lahir" placeholder="" value="<?php if(old('tempat_tanggal_lahir')){ echo old('tempat_tanggal_lahir'); }else{ echo $siswa->tempat_tanggal_lahir; } ?>" >
    <label for="tampat_tanggal_lahir">Tempat, tanggal lahir</label>
    @if($errors->has('tampat_tanggal_lahir')) 
    <div class="invalid-feedback">
        {{$errors->first('tampat_tanggal_lahir')}}
    </div>
    @endif
</div>
                        <div class="mb-3 col-md-6">
                    <label for="golongan_darah" class="form-label">Golongan Darah</label>
                <select class="form-select @if($errors->has('golongan_darah')) is-invalid @endif" id="golongan_darah" name="golongan_darah">
            <option value="">Pilih Golongan Darah</option>
            <option value="A" <?php if(old('golongan_darah')){ if(old('golongan_darah') == 'A'){ echo 'selected'; }}else{if($siswa->golongan_darah == 'A'){ echo 'selected'; }} ?>>A</option>
            <option value="B" <?php if(old('golongan_darah')){ if(old('golongan_darah') == 'B'){ echo 'selected'; }}else{if($siswa->golongan_darah == 'B'){ echo 'selected'; }} ?>>B</option>
            <option value="AB" <?php if(old('golongan_darah')){ if(old('golongan_darah') == 'AB'){ echo 'selected'; }}else{if($siswa->golongan_darah == 'AB'){ echo 'selected'; }} ?>>AB</option>
            <option value="O" <?php if(old('golongan_darah')){ if(old('golongan_darah') == 'O'){ echo 'selected'; }}else{if($siswa->golongan_darah == 'O'){ echo 'selected'; }} ?>>O</option>
        </select>
        @if($errors->has('golongan_darah')) 
        <div class="invalid-feedback">
            {{$errors->first('golongan_darah')}}
        </div>
        @endif
    </div>


    <div class="form-floating mb-3 col-md-8">
                            <input type="text" class="form-control @if($errors->has('nama_ortu')) is-invalid @endif" name="nama_ortu" id="nama_ortu" placeholder="" value="<?php if(old('nama_ortu')){ echo old('nama_ortu'); }else{ echo $siswa->nama_orang_tua_wali; } ?>" >
                            <label for="nama_ortu">Nama Orang Tua</label>
                            @if($errors->has('nama_ortu')) 
                            <div class="invalid-feedback">
                                {{$errors->first('nama_ortu')}}
                            </div>
                            @endif
                        </div>

                        

                       

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @if($errors->has('catatan_kesehatan')) is-invalid @endif" name="catatan_kesehatan" id="catatan_kesehatan" placeholder="" value="<?php if(old('catatan_kesehatan')){ echo old('catatan_kesehatan'); }else{ echo $siswa->catatan_kesehatan; } ?>" >
                            <label for="catatan_kesehatan">Catatan Kesehatan</label>
                            @if($errors->has('catatan_kesehatan')) 
                            <div class="invalid-feedback">
                                {{$errors->first('catatan_kesehatan')}}
                            </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-end mt-5">
                           
                            <button class="simpan">
                              <div class="svg-wrapper-1">
                                <div class="svg-wrapper">
                                  <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    width="30"
                                    height="30"
                                    class="icon"
                                  >
                                    <path
                                      d="M22,15.04C22,17.23 20.24,19 18.07,19H5.93C3.76,19 2,17.23 2,15.04C2,13.07 3.43,11.44 5.31,11.14C5.28,11 5.27,10.86 5.27,10.71C5.27,9.33 6.38,8.2 7.76,8.2C8.37,8.2 8.94,8.43 9.37,8.8C10.14,7.05 11.13,5.44 13.91,5.44C17.28,5.44 18.87,8.06 18.87,10.83C18.87,10.94 18.87,11.06 18.86,11.17C20.65,11.54 22,13.13 22,15.04Z"
                                    ></path>
                                  </svg>
                                </div>
                              </div>
                              <span>Simpan</span>
                            </button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
   $(document).ready(function(){
           
        $('#jurusan').select2();
        $('#kelas').select2();
    });
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