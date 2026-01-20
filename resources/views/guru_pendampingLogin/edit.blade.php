@extends('layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                 <div class="card-header text-center py-3">
                    <h1>Edit Data Guru</h1>
                </div>
                <div class="card-body p-5">
                    @if(session('gagal'))
                    <div class="alert-danger alert text-center">
                        {{session('gagal')}}
                    </div>
                    @endif
                    <div class="my-4">
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

.Btn {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: flex-start;
  width: 100px;
  height: 40px;
  border: none;
  padding: 0px 20px;
  background-color: black;
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
                        <a class="button text-decoration-none" href="/Pendamping">
                            <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024"><path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path></svg>
                            <span>Kembali</span>
                        </a>

                    </div>
                    <form action="" method="post" enctype="multipart/form-data" id="Form">
                        @csrf
                       
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @if($errors->has('nip')) is-invalid @endif" name="nip" id="nip" placeholder="" value="{{$guruPendamping->nip}}" readonly>
                            <label for="nip">NIP</label>
                            @if($errors->has('nip')) 
                            <div class="invalid-feedback">
                                {{$errors->first('nip')}}
                            </div>
                            @endif
                        </div>
                     
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @if($errors->has('nama')) is-invalid @endif" name="nama" id="nama" placeholder="" value="{{$guruPendamping->nama}}">
                            <label for="nama">Nama</label>
                            @if($errors->has('nama')) 
                            <div class="invalid-feedback">
                                {{$errors->first('nama')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-floating mb-3">
                        <textarea class="form-control @if($errors->has('alamat')) is-invalid @endif" name="alamat" id="alamat" placeholder="">{{ $guruPendamping->alamat }}</textarea>

                            <label for="alamat">Alamat</label>
                            @if($errors->has('alamat')) 
                            <div class="invalid-feedback">
                                {{$errors->first('alamat')}}
                            </div>
                            @endif
                        </div>

                       

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @if($errors->has('telp')) is-invalid @endif" name="telp" id="telp" placeholder="" value="{{$guruPendamping->telp}}">
                            <label for="telp">Telephone</label>
                            @if($errors->has('telp')) 
                            <div class="invalid-feedback">
                                {{$errors->first('telp')}}
                            </div>
                            @endif
                        </div>

                       

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @if($errors->has('tahun')) is-invalid @endif" name="tahun" id="tahun" placeholder="" value="{{date('Y')}}" readonly>
                            <label for="tahun">tahun</label>
                            @if($errors->has('tahun')) 
                            <div class="invalid-feedback">
                                {{$errors->first('tahun')}}
                            </div>
                            @endif
                        </div>
                     

                        <div class="form-group mb-3 col-md-5">
                            <label for="jurusan">Jurusan</label>
                            <select name="jurusan" id="jurusan" class="form-select   @if($errors->has('jurusan')) is-invalid @endif">
                                <option value="" disabled hidden selected>-- pilih Jurusan --</option>
                                @foreach($jurusan as $j)
                                <option value="{{$j->id_jurusan}}" <?php if(old('jurusan')){ if(old('jurusan') == $j->id_jurusan){ echo 'selected'; }}else{ if($guruPendamping->id_jurusan == $j->id_jurusan){ echo 'selected'; } } ?>>{{$j->nama_jurusan}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('jurusan')) 
                            <div class="invalid-feedback">
                                {{$errors->first('jurusan')}}
                            </div>
                            @endif
                        </div>


                        
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @if($errors->has('pangkat')) is-invalid @endif" name="pangkat" id="pangkat" placeholder="" value="<?php if(old('pangkat')){echo old('pangkat'); }else{ echo $guruPendamping->pangkat; } ?>">
                            <label for="pangkat">Pangkat</label>
                            @if($errors->has('pangkat')) 
                            <div class="invalid-feedback">
                                {{$errors->first('pangkat')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @if($errors->has('jabatan')) is-invalid @endif" name="jabatan" id="jabatan" placeholder="" value="<?php if(old('jabatan')){echo old('jabatan'); }else{ echo $guruPendamping->jabatan; } ?>">
                            <label for="jabatan">Jabatan</label>
                            @if($errors->has('jabatan')) 
                            <div class="invalid-feedback">
                                {{$errors->first('jabatan')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-group mb-3 col-md-5">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-select   @if($errors->has('status')) is-invalid @endif">
                                <option value="" disabled hidden selected>-- pilih status --</option>
                                <option value="0" <?php if(old('status')){ if(old('status') == '0'){ echo 'selected'; }}else{ if($guruPendamping->status == '0'){ echo 'selected'; } } ?>>Aktif</option>
                                <option value="1" <?php if(old('status')){ if(old('status') == '1'){ echo 'selected'; }}else{ if($guruPendamping->status == '1'){ echo 'selected'; } } ?>>Non Aktif</option>
                               
                            </select>
                            @if($errors->has('status')) 
                            <div class="invalid-feedback">
                                {{$errors->first('status')}}
                            </div>
                            @endif
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
<script>
    $(document).ready(function(){

       
    })
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