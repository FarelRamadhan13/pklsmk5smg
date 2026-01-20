@extends('layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1>Tambah Data Kunjungan</h1>
                </div>
                <div class="card-body p-5">
                    @if(session('gagal'))
                    <div class="alert-danger alert text-center">
                        {{session('gagal')}}
                    </div>
                    @endif
                    <div class="my-4">
                        <a href="/Admin/Kunjungan" class="btn-danger btn">Kembali</a>

                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                    

                        <div class="form-group col-md-6 mb-3">
                            <label for="idprakerin">Id Prakerin</label>
                            <select name="idprakerin" id="idprakerin" class="form-select @if($errors->has('idprakerin')) is-invalid @endif">
                                <option value="" disabled selected hidden>Pilih Id Prakerin</option>
                                @foreach($prakerin as $p)
                                    <option value="{{$p->idprakerin}}" <?php if(old('idprakerin') == $p->idprakerin){ echo 'selected'; } ?>>{{$p->idprakerin}}</option>    
                                @endforeach
                            </select>
                            @if($errors->has('idprakerin'))
                            <div class="invalid-feedback">
                                {{$errors->first('idprakerin')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-floating mb-3 col-md-7">
                            <input type="text" class="form-control @if($errors->has('id_pkl')) is-invalid @endif" name="id_pkl" id="id_pkl" placeholder="" value="{{old('id_pkl')}}" readonly>
                            <label for="id_pkl">Id PKL</label>
                            @if($errors->has('id_pkl')) 
                            <div class="invalid-feedback">
                                {{$errors->first('id_pkl')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-floating mb-3 col-md-7">
                            <input type="text" class="form-control @if($errors->has('nama_pkl')) is-invalid @endif" name="nama_pkl" id="nama_pkl" placeholder="" value="{{old('nama_pkl')}}" readonly>
                            <label for="nama_pkl">Nama PKL</label>
                            @if($errors->has('nama_pkl')) 
                            <div class="invalid-feedback">
                                {{$errors->first('nama_pkl')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-floating mb-3 col-md-7">
                            <input type="text" class="form-control @if($errors->has('alamat_pkl')) is-invalid @endif" style="height: 100px;" name="alamat_pkl" id="alamat_pkl" placeholder="" value="{{old('alamat_pkl')}}" readonly>
                            <label for="alamat_pkl">Alamat PKL</label>
                            @if($errors->has('alamat_pkl')) 
                            <div class="invalid-feedback">
                                {{$errors->first('alamat_pkl')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-floating mb-3 col-md-7">
                            <input type="text" class="form-control @if($errors->has('nisn')) is-invalid @endif" name="nisn" id="nisn" placeholder="" value="{{old('nisn')}}" readonly>
                            <label for="nisn">NIS</label>
                            @if($errors->has('nisn')) 
                            <div class="invalid-feedback">
                                {{$errors->first('nisn')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-floating mb-3 col-md-7">
                            <input type="text" class="form-control @if($errors->has('nama')) is-invalid @endif" name="nama" id="nama" placeholder="" value="{{old('nama')}}" readonly>
                            <label for="nama">Nama Siswa</label>
                            @if($errors->has('nama')) 
                            <div class="invalid-feedback">
                                {{$errors->first('nama')}}
                            </div>
                            @endif
                        </div>
                   
                        <div class="form-floating mb-3 col-md-7">
                            <input type="text" class="form-control @if($errors->has('kelas')) is-invalid @endif" name="kelas" id="kelas" placeholder="" value="{{old('kelas')}}" readonly>
                            <label for="kelas">Kelas</label>
                            @if($errors->has('kelas')) 
                            <div class="invalid-feedback">
                                {{$errors->first('kelas')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-floating mb-3 col-md-7">
                            <input type="text" class="form-control @if($errors->has('nip')) is-invalid @endif" name="nip" id="nip" placeholder="" value="{{old('nip')}}" readonly>
                            <label for="nip">NIP</label>
                            @if($errors->has('nip')) 
                            <div class="invalid-feedback">
                                {{$errors->first('nip')}}
                            </div>
                            @endif
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Tambah" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
       $('#idprakerin').change(function(){
        var id_prakerin = $(this).val();
        if(id_prakerin){
            $.ajax({
                url: '/Admin/Kunjungan/Tambah/GetPrakerin/' + id_prakerin,
                type: 'GET',
                dataType: 'json',
                success: function (respon){
                    $('#id_pkl').val(respon.prakerinn.idpkl);
                    $('#nama_pkl').val(respon.prakerinn.nama_pkl);
                    $('#alamat_pkl').val(respon.prakerinn.alamat_pkl);
                    $('#nisn').val(respon.prakerinn.nisn);
                    $('#nama').val(respon.prakerinn.nama_siswa);
                    $('#kelas').val(respon.prakerinn.kelas);
                    $('#nip').val(respon.prakerinn.nip);
                },
                error: function(){
                    console.log(error);
                }
            });
        }else{
            $('#id_pkl').val('');
        }
       });
       $('#idprakerin').select2();
    })
</script>

@endsection