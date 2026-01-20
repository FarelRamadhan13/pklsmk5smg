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
                        <a href="/Pendamping/Prakerin" class="btn-danger btn">Kembali</a>

                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-6 mb-3">
                            <label for="id_pkl">Id PKL</label>
                            <select name="id_pkl" id="id_pkl" class="form-select @if($errors->has('id_pkl')) is-invalid @endif" disabled>
                                <option value="" disabled selected hidden>Pilih Id PKL</option>
                                @foreach($pkl as $p)
                                    <option value="{{$p->idpkl}}" <?php if(old('id_pkl')){ if(old('id_pkl') == $p->idpkl){ echo 'selected'; }}else{ if($prakerin->idpkl == $p->idpkl){ echo 'selected'; } } ?>>{{$p->idpkl}}</option>    
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
                            <select name="nisn" id="nisn" class="form-select @if($errors->has('nisn')) is-invalid @endif" disabled>
                                <option value="" disabled selected hidden>Pilih NIS</option>
                                @foreach($siswa as $s)
                                    <option value="{{$s->nisn}}" <?php if(old('nisn')){ if(old('nisn') == $s->nisn){ echo 'selected'; }}else{ if($prakerin->nisn == $s->nisn){ echo 'selected'; } } ?>>{{$s->nisn}}</option>    
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
                            <select name="nip" id="nip" class="form-select @if($errors->has('nip')) is-invalid @endif" disabled>
                                <option value="" disabled selected hidden>Pilih NIP</option>
                                @foreach($guru as $g)
                                    <option value="{{$g->nip}}" <?php if(old('nip')){ if(old('nip') == $g->nip){ echo 'selected'; }}else{ if($prakerin->nip == $g->nip){ echo 'selected'; } } ?>>{{$g->nip}}</option>    
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
                            <input type="date" name="start" id="start" class="form-control @if($errors->has('start')) is-invalid @endif" value="<?php if(old('start')){ echo old('start'); }else{ echo $prakerin->start; } ?>" readonly>
                            @if($errors->has('start'))
                            <div class="invalid-feedback">
                                {{$errors->first('start')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-group mb-3 col-md-8">
                            <label for="end">End</label>
                            <input type="date" name="end" id="end" class="form-control @if($errors->has('end')) is-invalid @endif" value="<?php if(old('end')){ echo old('end'); }else{ echo $prakerin->end; } ?>" readonly>
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

                        <div class="form-floating mb-3 col-md-8">
                            <input type="number" class="form-control @if($errors->has('n1')) is-invalid @endif" name="n1" id="n1" placeholder="" value="<?php if(old('n1')){ echo old('n1'); }else{ echo $prakerin->n1; } ?>">
                            <label for="n1">Nilai 1 (nilai integritas)</label>
                            @if($errors->has('n1')) 
                            <div class="invalid-feedback">
                                {{$errors->first('n1')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-floating mb-3 col-md-8">
                            <input type="number" class="form-control @if($errors->has('n2')) is-invalid @endif" name="n2" id="n2" placeholder="" value="<?php if(old('n2')){ echo old('n2'); }else{ echo $prakerin->n2; } ?>">
                            <label for="n2">Nilai 2 (nilai kedisiplinan)</label>
                            @if($errors->has('n2')) 
                            <div class="invalid-feedback">
                                {{$errors->first('n2')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-floating mb-3 col-md-8">
                            <input type="number" class="form-control @if($errors->has('n3')) is-invalid @endif" name="n3" id="n3" placeholder="" value="<?php if(old('n3')){ echo old('n3'); }else{ echo $prakerin->n3; } ?>">
                            <label for="n3">Nilai 3 (nilai kehadiran)</label>
                            @if($errors->has('n3')) 
                            <div class="invalid-feedback">
                                {{$errors->first('n3')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-floating mb-3 col-md-8">
                            <input type="number" class="form-control @if($errors->has('n4')) is-invalid @endif" name="n4" id="n4" placeholder="" value="<?php if(old('n4')){ echo old('n4'); }else{ echo $prakerin->n4; } ?>">
                            <label for="n4">Nilai 4 (nilai inovasi)</label>
                            @if($errors->has('n4')) 
                            <div class="invalid-feedback">
                                {{$errors->first('n4')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-floating mb-3 col-md-8">
                            <input type="number" class="form-control @if($errors->has('n5')) is-invalid @endif" name="n5" id="n5" placeholder="" value="<?php if(old('n5')){ echo old('n5'); }else{ echo $prakerin->n5; } ?>">
                            <label for="n5">Nilai 5 (nilai inisiatif)</label>
                            @if($errors->has('n5')) 
                            <div class="invalid-feedback">
                                {{$errors->first('n5')}}
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
                url: '/Pendamping/Prakerin/Tambah/Getpkl/' + IdPKL,
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
                url: '/Pendamping/Prakerin/Tambah/Getpkl/' + IdPKL,
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
                url: '/Pendamping/Prakerin/Tambah/GetSiswa/' + nisn,
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
                url: '/Pendamping/Prakerin/Tambah/GetSiswa/' + nisn,
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
                url: '/Pendamping/Prakerin/Tambah/GetGuru/' + nip,
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
                url: '/Pendamping/Prakerin/Tambah/GetGuru/' + nip,
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

       
       $('form').submit(function(event){
    if ($('#n1').val() === '' || $('#n2').val() === '' || $('#n3').val() === '' || $('#n4').val() === '' || $('#n5').val() === '') {
        return confirm('Terdapat nilai yang belum diinputkan');
    }
    if($('#n1').val() > 100){
        alert('Nilai 1 / integritas tidak bisa lebih dari 100');
        event.preventDefault();
        $('#n1').focus();
    }

    if($('#n2').val() > 100){
        alert('Nilai 2 / kedisiplinan tidak bisa lebih dari 100');
        event.preventDefault();
        $('#n2').focus();
    }

    if($('#n3').val() > 100){
        alert('Nilai 3 / kehadiran tidak bisa lebih dari 100');
        event.preventDefault();
        $('#n3').focus();
    }

    if($('#n4').val() > 100){
        alert('Nilai 4 / inovasi tidak bisa lebih dari 100');
        event.preventDefault();
        $('#n4').focus();
    }

    if($('#n5').val() > 100){
        alert('Nilai 5 / inisiatif tidak bisa lebih dari 100');
        event.preventDefault();
        $('#n5').focus();
    }
    
    
   
});

$('#id_pkl').select2();
       $('#nisn').select2();
       $('#nip').select2();
    });
</script>

@endsection