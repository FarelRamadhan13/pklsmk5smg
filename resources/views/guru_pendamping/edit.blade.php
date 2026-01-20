@extends('layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1>Tambah Guru Pendamping</h1>
                </div>
                <div class="card-body p-5">
                    @if(session('gagal'))
                    <div class="alert-danger alert text-center">
                        {{session('gagal')}}
                    </div>
                    @endif
                    <div class="my-4">
                        <a href="/Admin/guru_pendamping" class="btn-danger btn">Kembali</a>

                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
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

                        <div class="form-group mb-3 col-md-5">
                            <label for="ubahPass">Ubah Password</label>
                            <select name="ubahPass" id="ubahPass" class="form-select">
                                <option value="0" <?php if(old('ubahPass') == '0'){ echo 'selected'; } ?>>Tidak</option>
                                <option value="1" <?php if(old('ubahPass') == '1'){ echo 'selected'; } ?>>Iya</option>
                            </select>
                        </div>
                        <div class="form-floating mb-3" id="f-pass">
                            <input type="password" class="form-control @if($errors->has('password')) is-invalid @endif @if(session('pass')) is-invalid @endif" name="password" id="password" placeholder="" value="{{old('password')}}">
                            <label for="password">Password Baru</label>
                            @if($errors->has('password')) 
                            <div class="invalid-feedback">
                                {{$errors->first('password')}}
                            </div>
                            @endif
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn-white btn position-absolute top-0 end-0 mt-2 me-2" id="lihatPassword">
                                    <span id="lihatPasswordIcon">👁️</span>
                                </button>
                            </div>
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
                            <input type="submit" value="Ubah" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){

        $('#f-pass').hide();
            $('#f-passBaru').hide();

            if($('#ubahPass').val() == '0'){
            $('#f-pass').hide();
            $('#f-passBaru').hide();
            }else if($('#ubahPass').val() == '1'){
            $('#f-pass').show();
            $('#f-passBaru').show();
                }
        $('#ubahPass').change(function(){
            if($('#ubahPass').val() == '0'){
            $('#f-pass').hide();
            $('#f-passBaru').hide();
            }else if($('#ubahPass').val() == '1'){
                $('#f-pass').show();
            $('#f-passBaru').show();
            }
        });

        $('#lihatPassword').click(function(){
            if($('#password').attr('type') == 'password'){
                $('#password').attr('type', 'text');
                $('#lihatPasswordIcon').text("👁️‍🗨️")
            }else{
                $('#password').attr('type','password');
                $('#lihatPasswordIcon').text("👁️")
            }
        });

        $('#lihatPasswordAseli').click(function(){
            if($('#passwordAseli').attr('type') == 'password'){
                $('#passwordAseli').attr('type', 'text');
                $('#lihatPasswordIconAseli').text("👁️‍🗨️")
            }else{
                $('#passwordAseli').attr('type','password');
                $('#lihatPasswordIconAseli').text("👁️")
            }
        })
    })
</script>
<script>
  
</script>
@endsection