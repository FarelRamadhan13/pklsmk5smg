@extends('layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1>Edit Data Siswa</h1>
                </div>
                <div class="card-body p-5">
                    @if(session('gagal'))
                    <div class="alert-danger alert text-center">
                        {{session('gagal')}}
                    </div>
                    @endif
                    <div class="my-4">
                        <a href="/Admin/Siswa" class="btn-danger btn">Kembali</a>

                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
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
                            <input type="text" class="form-control @if($errors->has('nama')) is-invalid @endif" name="nama" id="nama" placeholder="" value="<?php if(old('nama')){ echo old('nama'); }else{ echo $siswa->nama_siswa; } ?>">
                            <label for="nama">Nama</label>
                            @if($errors->has('nama')) 
                            <div class="invalid-feedback">
                                {{$errors->first('nama')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-floating mb-3">
                        <textarea class="form-control @if($errors->has('alamat')) is-invalid @endif" name="alamat" id="alamat" placeholder="" style="height: 100px;"><?php if(old('alamat')){ echo old('alamat'); }else{ echo $siswa->alamat; } ?></textarea>

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
                      

                        <div class="form-floating mb-3" id="f-passBaru">
                            <input type="password" class="form-control @if($errors->has('passwordAseli')) is-invalid @endif  " name="passwordAseli" id="passwordAseli" placeholder="" value="{{old('passwordAseli')}}">
                            <label for="passwordAseli">Password Baru</label>
                            @if($errors->has('passwordAseli')) 
                            <div class="invalid-feedback">
                                {{$errors->first('passwordAseli')}}
                            </div>
                            @endif
                            
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn-white btn position-absolute top-0 end-0 mt-2 me-2" id="lihatPasswordAseli">
                                    <span id="lihatPasswordIconAseli">👁️</span>
                                </button>
                            </div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @if($errors->has('telp')) is-invalid @endif" name="telp" id="telp" placeholder="" value="<?php if(old('telp')){ echo old('telp'); }else{ echo $siswa->telp; } ?>">
                            <label for="telp">Telephone</label>
                            @if($errors->has('telp')) 
                            <div class="invalid-feedback">
                                {{$errors->first('telp')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-group mb-3 col-md-5">
                            <label for="kelas">Kelas</label>
                            <select name="kelas" id="kelas" class="form-select @if($errors->has('kelas')) is-invalid @endif">
                                <option value="" disabled selected hidden>Pilih Kelas</option>
                                <option value="X PPLG 1" <?php if(old('kelas')){ if(old('kelas') == 'X PPLG 1'){ echo 'selected'; }}else{ if($siswa->kelas == 'X PPLG 1'){ echo 'selected'; } } ?>>X PPLG 1</option>
                                <option value="X PPLG 2" <?php if(old('kelas')){ if(old('kelas') == 'X PPLG 2'){ echo 'selected'; }}else{ if($siswa->kelas == 'X PPLG 2'){ echo 'selected'; } } ?>>X PPLG 2</option>
                                <option value="X PPLG 3" <?php if(old('kelas')){ if(old('kelas') == 'X PPLG 3'){ echo 'selected'; }}else{ if($siswa->kelas == 'X PPLG 3'){ echo 'selected'; } } ?>>X PPLG 3</option>
                                <option value="X TJKT 1" <?php if(old('kelas')){ if(old('kelas') == 'X TJKT 1'){ echo 'selected'; }}else{ if($siswa->kelas == 'X TJKT 1'){ echo 'selected'; } } ?>>X TJKT 1</option>
                                <option value="X TJKT 2" <?php if(old('kelas')){ if(old('kelas') == 'X TJKT 2'){ echo 'selected'; }}else{ if($siswa->kelas == 'X TJKT 2'){ echo 'selected'; } } ?>>X TJKT 2</option>
                                <option value="X TJKT 3" <?php if(old('kelas')){ if(old('kelas') == 'X TJKT 3'){ echo 'selected'; }}else{ if($siswa->kelas == 'X TJKT 3'){ echo 'selected'; } } ?>>X TJKT 3</option>
                                <option value="X TO 1" <?php if(old('kelas')){ if(old('kelas') == 'X TO 1'){ echo 'selected'; }}else{ if($siswa->kelas == 'X TO 1'){ echo 'selected'; } } ?>>X TO 1</option>
                                <option value="X TO 2" <?php if(old('kelas')){ if(old('kelas') == 'X TO 2'){ echo 'selected'; }}else{ if($siswa->kelas == 'X TO 2'){ echo 'selected'; } } ?>>X TO 2</option>
                                <option value="X TO 3" <?php if(old('kelas')){ if(old('kelas') == 'X TO 3'){ echo 'selected'; }}else{ if($siswa->kelas == 'X TO 3'){ echo 'selected'; } } ?>>X TO 3</option>
                                <option value="X TKI 1" <?php if(old('kelas')){ if(old('kelas') == 'X TKI 1'){ echo 'selected'; }}else{ if($siswa->kelas == 'X TKI 1'){ echo 'selected'; } } ?>>X TKI 1</option>
                                <option value="X TKI 2" <?php if(old('kelas')){ if(old('kelas') == 'X TKI 2'){ echo 'selected'; }}else{ if($siswa->kelas == 'X TKI 2'){ echo 'selected'; } } ?>>X TKI 2</option>
                                <option value="X TKI 3" <?php if(old('kelas')){ if(old('kelas') == 'X TKI 3'){ echo 'selected'; }}else{ if($siswa->kelas == 'X TKI 3'){ echo 'selected'; } } ?>>X TKI 3</option>
                                <option value="X TE 1" <?php if(old('kelas')){ if(old('kelas') == 'X TE 1'){ echo 'selected'; }}else{ if($siswa->kelas == 'X TE 1'){ echo 'selected'; } } ?>>X TE 1</option>
                                <option value="X TE 2" <?php if(old('kelas')){ if(old('kelas') == 'X TE 2'){ echo 'selected'; }}else{ if($siswa->kelas == 'X TE 2'){ echo 'selected'; } } ?>>X TE 2</option>
                                <option value="X TE 3" <?php if(old('kelas')){ if(old('kelas') == 'X TE 3'){ echo 'selected'; }}else{ if($siswa->kelas == 'X TE 3'){ echo 'selected'; } } ?>>X TE 3</option>

                                <option value="XI PPLG 1" <?php if(old('kelas')){ if(old('kelas') == 'XI PPLG 1'){ echo 'selected'; }}else{ if($siswa->kelas == 'XI PPLG 1'){ echo 'selected'; } } ?>>XI PPLG 1</option>
                                <option value="XI PPLG 2" <?php if(old('kelas')){ if(old('kelas') == 'XI PPLG 2'){ echo 'selected'; }}else{ if($siswa->kelas == 'XI PPLG 2'){ echo 'selected'; } } ?>>XI PPLG 2</option>
                                <option value="XI PPLG 3" <?php if(old('kelas')){ if(old('kelas') == 'XI PPLG 3'){ echo 'selected'; }}else{ if($siswa->kelas == 'XI PPLG 3'){ echo 'selected'; } } ?>>XI PPLG 3</option>
                                <option value="XI TJKT 1" <?php if(old('kelas')){ if(old('kelas') == 'XI TJKT 1'){ echo 'selected'; }}else{ if($siswa->kelas == 'XI TJKT 1'){ echo 'selected'; } } ?>>XI TJKT 1</option>
                                <option value="XI TJKT 2" <?php if(old('kelas')){ if(old('kelas') == 'XI TJKT 2'){ echo 'selected'; }}else{ if($siswa->kelas == 'XI TJKT 2'){ echo 'selected'; } } ?>>XI TJKT 2</option>
                                <option value="XI TJKT 3" <?php if(old('kelas')){ if(old('kelas') == 'XI TJKT 3'){ echo 'selected'; }}else{ if($siswa->kelas == 'XI TJKT 3'){ echo 'selected'; } } ?>>XI TJKT 3</option>
                                <option value="XI TO 1" <?php if(old('kelas')){ if(old('kelas') == 'XI TO 1'){ echo 'selected'; }}else{ if($siswa->kelas == 'XI TO 1'){ echo 'selected'; } } ?>>XI TO 1</option>
                                <option value="XI TO 2" <?php if(old('kelas')){ if(old('kelas') == 'XI TO 2'){ echo 'selected'; }}else{ if($siswa->kelas == 'XI TO 2'){ echo 'selected'; } } ?>>XI TO 2</option>
                                <option value="XI TO 3" <?php if(old('kelas')){ if(old('kelas') == 'XI TO 3'){ echo 'selected'; }}else{ if($siswa->kelas == 'XI TO 3'){ echo 'selected'; } } ?>>XI TO 3</option>
                                <option value="XI TKI 1" <?php if(old('kelas')){ if(old('kelas') == 'XI TKI 1'){ echo 'selected'; }}else{ if($siswa->kelas == 'XI TKI 1'){ echo 'selected'; } } ?>>XI TKI 1</option>
                                <option value="XI TKI 2" <?php if(old('kelas')){ if(old('kelas') == 'XI TKI 2'){ echo 'selected'; }}else{ if($siswa->kelas == 'XI TKI 2'){ echo 'selected'; } } ?>>XI TKI 2</option>
                                <option value="XI TKI 3" <?php if(old('kelas')){ if(old('kelas') == 'XI TKI 3'){ echo 'selected'; }}else{ if($siswa->kelas == 'XI TKI 3'){ echo 'selected'; } } ?>>XI TKI 3</option>
                                <option value="XI TE 1" <?php if(old('kelas')){ if(old('kelas') == 'XI TE 1'){ echo 'selected'; }}else{ if($siswa->kelas == 'XI TE 1'){ echo 'selected'; } } ?>>XI TE 1</option>
                                <option value="XI TE 2" <?php if(old('kelas')){ if(old('kelas') == 'XI TE 2'){ echo 'selected'; }}else{ if($siswa->kelas == 'XI TE 2'){ echo 'selected'; } } ?>>XI TE 2</option>
                                <option value="XI TE 3" <?php if(old('kelas')){ if(old('kelas') == 'XI TE 3'){ echo 'selected'; }}else{ if($siswa->kelas == 'XI TE 3'){ echo 'selected'; } } ?>>XI TE 3</option
                                <option value="XI PG 1" <?php if(old('kelas')){ if(old('kelas') == 'XI PG 1'){ echo 'selected'; }}else{ if($siswa->kelas == 'XI PG 1'){ echo 'selected'; } } ?>>XI PG 1</option>
                                <option value="XI PG 2" <?php if(old('kelas')){ if(old('kelas') == 'XI PG 2'){ echo 'selected'; }}else{ if($siswa->kelas == 'XI PG 2'){ echo 'selected'; } } ?>>XI PG 2</option>
                                <option value="XI PG 3" <?php if(old('kelas')){ if(old('kelas') == 'XI PG 3'){ echo 'selected'; }}else{ if($siswa->kelas == 'XI PG 3'){ echo 'selected'; } } ?>>XI PG 3</option>
                                <option value="XI RPL 1" <?php if(old('kelas')){ if(old('kelas') == 'XI RPL 1'){ echo 'selected'; }}else{ if($siswa->kelas == 'XI RPL 1'){ echo 'selected'; } } ?>>XI RPL 1</option>
                                <option value="XI RPL 2" <?php if(old('kelas')){ if(old('kelas') == 'XI RPL 2'){ echo 'selected'; }}else{ if($siswa->kelas == 'XI RPL 2'){ echo 'selected'; } } ?>>XI RPL 2</option>
                                <option value="XI RPL 3" <?php if(old('kelas')){ if(old('kelas') == 'XI RPL 3'){ echo 'selected'; }}else{ if($siswa->kelas == 'XI RPL 3'){ echo 'selected'; } } ?>>XI RPL 3</option>
                                

                                <option value="XII PPLG 1" <?php if(old('kelas')){ if(old('kelas') == 'XII PPLG 1'){ echo 'selected'; }}else{ if($siswa->kelas == 'XII PPLG 1'){ echo 'selected'; } } ?>>XII PPLG 1</option>
                                <option value="XII PPLG 2" <?php if(old('kelas')){ if(old('kelas') == 'XII PPLG 2'){ echo 'selected'; }}else{ if($siswa->kelas == 'XII PPLG 2'){ echo 'selected'; } } ?>>XII PPLG 2</option>
                                <option value="XII PPLG 3" <?php if(old('kelas')){ if(old('kelas') == 'XII PPLG 3'){ echo 'selected'; }}else{ if($siswa->kelas == 'XII PPLG 3'){ echo 'selected'; } } ?>>XII PPLG 3</option>
                                <option value="XII TJKT 1" <?php if(old('kelas')){ if(old('kelas') == 'XII TJKT 1'){ echo 'selected'; }}else{ if($siswa->kelas == 'XII TJKT 1'){ echo 'selected'; } } ?>>XII TJKT 1</option>
                                <option value="XII TJKT 2" <?php if(old('kelas')){ if(old('kelas') == 'XII TJKT 2'){ echo 'selected'; }}else{ if($siswa->kelas == 'XII TJKT 2'){ echo 'selected'; } } ?>>XII TJKT 2</option>
                                <option value="XII TJKT 3" <?php if(old('kelas')){ if(old('kelas') == 'XII TJKT 3'){ echo 'selected'; }}else{ if($siswa->kelas == 'XII TJKT 3'){ echo 'selected'; } } ?>>XII TJKT 3</option>
                                <option value="XII TO 1" <?php if(old('kelas')){ if(old('kelas') == 'XII TO 1'){ echo 'selected'; }}else{ if($siswa->kelas == 'XII TO 1'){ echo 'selected'; } } ?>>XII TO 1</option>
                                <option value="XII TO 2" <?php if(old('kelas')){ if(old('kelas') == 'XII TO 2'){ echo 'selected'; }}else{ if($siswa->kelas == 'XII TO 2'){ echo 'selected'; } } ?>>XII TO 2</option>
                                <option value="XII TO 3" <?php if(old('kelas')){ if(old('kelas') == 'XII TO 3'){ echo 'selected'; }}else{ if($siswa->kelas == 'XII TO 3'){ echo 'selected'; } } ?>>XII TO 3</option>
                                <option value="XII TKI 1" <?php if(old('kelas')){ if(old('kelas') == 'XII TKI 1'){ echo 'selected'; }}else{ if($siswa->kelas == 'XII TKI 1'){ echo 'selected'; } } ?>>XII TKI 1</option>
                                <option value="XII TKI 2" <?php if(old('kelas')){ if(old('kelas') == 'XII TKI 2'){ echo 'selected'; }}else{ if($siswa->kelas == 'XII TKI 2'){ echo 'selected'; } } ?>>XII TKI 2</option>
                                <option value="XII TKI 3" <?php if(old('kelas')){ if(old('kelas') == 'XII TKI 3'){ echo 'selected'; }}else{ if($siswa->kelas == 'XII TKI 3'){ echo 'selected'; } } ?>>XII TKI 3</option>
                                <option value="XII TE 1" <?php if(old('kelas')){ if(old('kelas') == 'XII TE 1'){ echo 'selected'; }}else{ if($siswa->kelas == 'XII TE 1'){ echo 'selected'; } } ?>>XII TE 1</option>
                                <option value="XII TE 2" <?php if(old('kelas')){ if(old('kelas') == 'XII TE 2'){ echo 'selected'; }}else{ if($siswa->kelas == 'XII TE 2'){ echo 'selected'; } } ?>>XII TE 2</option>
                                <option value="XII TE 3" <?php if(old('kelas')){ if(old('kelas') == 'XII TE 3'){ echo 'selected'; }}else{ if($siswa->kelas == 'XII TE 3'){ echo 'selected'; } } ?>>XII TE 3</option>
                                <option value="XII PG 1" <?php if(old('kelas')){ if(old('kelas') == 'XII PG 1'){ echo 'selected'; }}else{ if($siswa->kelas == 'XII PG 1'){ echo 'selected'; } } ?>>XII PG 1</option>
                                <option value="XII PG 2" <?php if(old('kelas')){ if(old('kelas') == 'XII PG 2'){ echo 'selected'; }}else{ if($siswa->kelas == 'XII PG 2'){ echo 'selected'; } } ?>>XII PG 2</option>
                                <option value="XII PG 3" <?php if(old('kelas')){ if(old('kelas') == 'XII PG 3'){ echo 'selected'; }}else{ if($siswa->kelas == 'XII PG 3'){ echo 'selected'; } } ?>>XII PG 3</option>
                                <option value="XII RPL 1" <?php if(old('kelas')){ if(old('kelas') == 'XII RPL 1'){ echo 'selected'; }}else{ if($siswa->kelas == 'XII RPL 1'){ echo 'selected'; } } ?>>XII RPL 1</option>
                                <option value="XII RPL 2" <?php if(old('kelas')){ if(old('kelas') == 'XII RPL 2'){ echo 'selected'; }}else{ if($siswa->kelas == 'XII RPL 2'){ echo 'selected'; } } ?>>XII RPL 2</option>
                                <option value="XII RPL 3" <?php if(old('kelas')){ if(old('kelas') == 'XII RPL 3'){ echo 'selected'; }}else{ if($siswa->kelas == 'XII RPL 3'){ echo 'selected'; } } ?>>XII RPL 3</option>
                                

                            </select>
                            @if($errors->has('kelas')) 
                            <div class="invalid-feedback">
                                {{$errors->first('kelas')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @if($errors->has('tahun')) is-invalid @endif" name="tahun" id="tahun" placeholder="" value="{{$siswa->tahun}}">
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

                        <hr class="mb-0">
                        <p style="font-size: 2vh; color: grey;" class="mt-0">Opsional</p>
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
                            <input type="text" class="form-control @if($errors->has('tampat_tanggal_lahir')) is-invalid @endif" name="tampat_tanggal_lahir" id="tampat_tanggal_lahir" placeholder="" value="<?php if(old('tempat_tanggal_lahir')){ echo old('tempat_tanggal_lahir'); }else{ echo $siswa->tempat_tanggal_lahir; } ?>" >
                            <label for="tampat_tanggal_lahir">Tempat, tanggal lahir</label>
                            @if($errors->has('tampat_tanggal_lahir')) 
                            <div class="invalid-feedback">
                                {{$errors->first('tampat_tanggal_lahir')}}
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
        });
        $('#jurusan').select2();
        $('#kelas').select2();
    })
</script>
<script>
  
</script>
@endsection
