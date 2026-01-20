@extends('layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1>Ubah data Prakerin</h1>
                </div>
                <div class="card-body p-5">
                    @if(session('error'))
                    <div class="alert-danger alert text-center">
                        {{session('error')}}
                    </div>
                    @endif
                    <div class="my-4">
                        <a href="/Admin/Prakerin" class="btn-danger btn">Kembali</a>

                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-6 mb-3">
                            <label for="id_pkl">Id PKL</label>
                            <select name="id_pkl" id="id_pkl" class="form-select @if($errors->has('id_pkl')) is-invalid @endif">
                                <option value="" disabled selected hidden>Pilih Id PKL / Industri</option>
                                @foreach($pkl as $p)
                                    <option value="{{$p->idpkl}}" <?php if(old('id_pkl')){ if(old('id_pkl') == $p->idpkl){ echo 'selected'; }}else{ if($prakerin->idpkl == $p->idpkl){ echo 'selected'; } } ?>>{{$p->idpkl}} || {{$p->nama_pkl}}</option>    
                                @endforeach
                            </select>
                            @if($errors->has('id_pkl'))
                            <div class="invalid-feedback">
                                {{$errors->first('id_pkl')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-floating mb-3 col-md-8">
                            <input type="text" class="form-control @if($errors->has('namapkl')) is-invalid @endif" name="namapkl" id="namapkl" placeholder="" value="{{old('namapkl')}}" readonly>
                            <label for="namapkl">Nama PKL</label>
                            @if($errors->has('namapkl')) 
                            <div class="invalid-feedback">
                                {{$errors->first('namapkl')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-floating mb-3 col-md-8">
                            <input type="text" class="form-control @if($errors->has('alamatpkl')) is-invalid @endif" style="height: 100px;" name="alamatpkl" id="alamatpkl" placeholder="" value="{{old('alamatpkl')}}" readonly>
                            <label for="alamatpkl">Alamat PKL</label>
                            @if($errors->has('alamatpkl')) 
                            <div class="invalid-feedback">
                                {{$errors->first('alamatpkl')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="nisn">NIS</label>
                            <select name="nisn" id="nisn" class="form-select @if($errors->has('nisn')) is-invalid @endif">
                                <option value="" disabled selected hidden>Pilih NIS</option>
                                @foreach($siswa as $s)
                                    <option value="{{$s->nisn}}" <?php if(old('nisn')){ if(old('nisn') == $s->nisn){ echo 'selected'; }}else{ if($prakerin->nisn == $s->nisn){ echo 'selected'; } } ?>>{{$s->nisn}} || {{$s->nama_siswa}}</option>    
                                @endforeach
                            </select>
                            @if($errors->has('nisn'))
                            <div class="invalid-feedback">
                                {{$errors->first('nisn')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-floating mb-3 col-md-8">
                            <input type="text" class="form-control @if($errors->has('namasiswa')) is-invalid @endif" name="namasiswa" id="namasiswa" placeholder="" value="{{old('namasiswa')}}" readonly>
                            <label for="namasiswa">Nama Siswa</label>
                            @if($errors->has('namasiswa')) 
                            <div class="invalid-feedback">
                                {{$errors->first('namasiswa')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-floating mb-3 col-md-8">
                            <input type="text" class="form-control @if($errors->has('kelas')) is-invalid @endif" name="kelas" id="kelas" placeholder="" value="{{old('kelas')}}" readonly>
                            <label for="kelas">Kelas</label>
                            @if($errors->has('kelas')) 
                            <div class="invalid-feedback">
                                {{$errors->first('kelas')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="nip">NIP</label>
                            <select name="nip" id="nip" class="form-select @if($errors->has('nip')) is-invalid @endif">
                                <option value="" disabled selected hidden>Pilih NIP</option>
                                @foreach($guru as $g)
                                    <option value="{{$g->nip}}" <?php if(old('nip')){ if(old('nip') == $g->nip){ echo 'selected'; }}else{ if($prakerin->nip == $g->nip){ echo 'selected'; } } ?>>{{$g->nip}} || {{$g->nama}}</option>    
                                @endforeach
                            </select>
                            @if($errors->has('nip'))
                            <div class="invalid-feedback">
                                {{$errors->first('nip')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-floating mb-3 col-md-8">
                            <input type="text" class="form-control @if($errors->has('namaguru')) is-invalid @endif" name="namaguru" id="namaguru" placeholder="" value="{{old('namaguru')}}" readonly>
                            <label for="namaguru">Nama Guru</label>
                            @if($errors->has('namaguru')) 
                            <div class="invalid-feedback">
                                {{$errors->first('namaguru')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-group mb-3 col-md-8">
                            <label for="start">Start</label>
                            <input type="date" name="start" id="start" class="form-control @if($errors->has('start')) is-invalid @endif" value="<?php if(old('start')){ echo old('start'); }else{ echo $prakerin->start; } ?>">
                            @if($errors->has('start'))
                            <div class="invalid-feedback">
                                {{$errors->first('start')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-group mb-3 col-md-8">
                            <label for="end">End</label>
                            <input type="date" name="end" id="end" class="form-control @if($errors->has('end')) is-invalid @endif" value="<?php if(old('end')){ echo old('end'); }else{ echo $prakerin->end; } ?>">
                            @if($errors->has('end'))
                            <div class="invalid-feedback">
                                {{$errors->first('end')}}
                            </div>
                            @endif
                        </div>
                      
                        <div class="form-floating mb-3 col-md-8">
                            <input type="number" class="form-control @if($errors->has('tahun')) is-invalid @endif" name="tahun" id="tahun" placeholder="" value="{{Date('Y')}}" readonly>
                            <label for="tahun">tahun</label>
                            @if($errors->has('tahun')) 
                            <div class="invalid-feedback">
                                {{$errors->first('tahun')}}
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
        var IdPKL = $('#id_pkl').val();
        if(IdPKL){
            $.ajax({
                url: '/Admin/Prakerin/Tambah/Getpkl/' + IdPKL,
                type: 'GET',
                dataType: 'json',
                success: function (response){
                    $('#namapkl').val(response.pkll.nama_pkl);
                    $('#alamatpkl').val(response.pkll.alamat_pkl);
                },
                error: function (error){
                    console.log(error);
                }
            });
           
        }
        else{
                $('#namapkl').val('');
                $('#alamatpkl').val('');
            }

       $('#id_pkl').change(function(){
        var IdPKL = $(this).val();
        if(IdPKL){
            $.ajax({
                url: '/Admin/Prakerin/Tambah/Getpkl/' + IdPKL,
                type: 'GET',
                dataType: 'json',
                success: function (response){
                    $('#namapkl').val(response.pkll.nama_pkl);
                    $('#alamatpkl').val(response.pkll.alamat_pkl);
                },
                error: function (error){
                    console.log(error);
                }
            });
           
        }
        else{
                $('#namapkl').val('');
                $('#alamatpkl').val('');
            }
       });

       var nisn = $('#nisn').val();
        if(nisn){
            $.ajax({
                url: '/Admin/Prakerin/Tambah/GetSiswa/' + nisn,
                type: 'GET',
                dataType: 'json',
                success: function (respon){
                    $('#namasiswa').val(respon.siswaa.nama_siswa);
                    $('#kelas').val(respon.siswaa.kelas);
                },
                error: function (error){
                    console.log(error);
                }
            });
        }
        else{
            $('#namasiswa').val('');
            $('#kelas').val('');
        }
       $('#nisn').change(function(){
        var nisn = $(this).val();
        if(nisn){
            $.ajax({
                url: '/Admin/Prakerin/Tambah/GetSiswa/' + nisn,
                type: 'GET',
                dataType: 'json',
                success: function (respon){
                    $('#namasiswa').val(respon.siswaa.nama_siswa);
                    $('#kelas').val(respon.siswaa.kelas);
                },
                error: function (error){
                    console.log(error);
                }
            });
        }
        else{
            $('#namasiswa').val('');
            $('#kelas').val('');
        }
       });

       
       var nip = $('#nip').val();
        if(nip){
            $.ajax({
                url: '/Admin/Prakerin/Tambah/GetGuru/' + nip,
                type: 'GET',
                dataType: 'json',
                success: function (responn){
                    $('#namaguru').val(responn.guruu.nama);
                },
                error: function (error){
                    console.log(error);
                }
            });
        }else{
            $('#namaguru').val('');
        }

       $('#nip').change(function(){
        var nip = $(this).val();
        if(nip){
            $.ajax({
                url: '/Admin/Prakerin/Tambah/GetGuru/' + nip,
                type: 'GET',
                dataType: 'json',
                success: function (responn){
                    $('#namaguru').val(responn.guruu.nama);
                },
                error: function (error){
                    console.log(error);
                }
            });
        }else{
            $('#namaguru').val('');
        }
       });

       
      
$('#id_pkl').select2();
       $('#nisn').select2();
       $('#nip').select2();
    });
</script>

@endsection