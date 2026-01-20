@extends('layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1>Tambah Jurnal PKL</h1>
                </div>
                <div class="card-body p-5">
                    @if(session('gagal'))
                    <div class="alert-danger alert text-center">
                        {{session('gagal')}}
                    </div>
                    @endif
                    <div class="my-4">
                        <a href="/Siswa/JurnalPKL" class="btn-danger btn">Kembali</a>

                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        @if(auth()->check())
                        <div class="form-group col-md-10 mb-3">
                            <label for="prakerin">Pilih Prakerin</label>
                            <select name="prakerin" id="prakerin" class="form-select @if($errors->has('prakerin')) is-invalid @endif">
                                <option value="" disabled selected hidden>Pilih Prakerin</option>
                                <option value="{{$awal->idprakerin}}" <?php if($surat->prakerin == $awal->idprakerin){ echo 'selected'; } ?>>Id Prakerin: {{$awal->idprakerin}} || NIS: {{$awal->nisn}}</option>
                                @foreach($prakerin as $p)
                                    <option value="{{$p->idprakerin}}" <?php if(old('prakerin') == $p->idprakerin){ echo 'selected'; } ?>>Id Prakerin: {{$p->idprakerin}} || NIS: {{$p->nisn}}</option>    
                                @endforeach
                            </select>
                            @if($errors->has('prakerin'))
                            <div class="invalid-feedback">
                                {{$errors->first('prakerin')}}
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
                            <input type="text" class="form-control @if($errors->has('namapkl')) is-invalid @endif" name="namapkl" id="namapkl" placeholder="" value="{{old('namapkl')}}" readonly>
                            <label for="namapkl">Nama PKL/Industri</label>
                            @if($errors->has('namapkl')) 
                            <div class="invalid-feedback">
                                {{$errors->first('namapkl')}}
                            </div>
                            @endif
                        </div>
                        
                        <div class="form-floating mb-3 col-md-8">
                        <textarea class="form-control @if($errors->has('alamatpkl')) is-invalid @endif" style="height: 100px;" name="alamatpkl" id="alamatpkl" placeholder="" readonly>{{ old('alamatpkl') }}</textarea>

                            <label for="alamatpkl">Alamat PKL/Industri</label>
                            @if($errors->has('alamatpkl')) 
                            <div class="invalid-feedback">
                                {{$errors->first('alamatpkl')}}
                            </div>
                            @endif
                        </div>
                        
                        @else
                        <div class="form-floating mb-3 col-md-10">
                            <input type="text" class="form-control @if($errors->has('prakerin')) is-invalid @endif" name="prakerin" id="prakerinSiswa" placeholder="" value="{{$prakerin->idprakerin}}" readonly>
                            <label for="prakerinSiswa">prakerin</label>
                            @if($errors->has('prakerin')) 
                            <div class="invalid-feedback">
                                {{$errors->first('prakerin')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-floating mb-3 col-md-8">
                                                    <input type="text" class="form-control @if($errors->has('nisn')) is-invalid @endif" name="nisn" id="nisn" placeholder="" value="{{$prakerin->nisn}}" readonly>
                                                    <label for="nisn">NIS Siswa</label>
                                                    @if($errors->has('nisn')) 
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('nisn')}}
                                                    </div>
                                                    @endif
                                                </div>

                        <div class="form-floating mb-3 col-md-8">
                                                    <input type="text" class="form-control @if($errors->has('namasiswa')) is-invalid @endif" name="namasiswa" id="namasiswa" placeholder="" value="{{$prakerin->nama_siswa}}" readonly>
                                                    <label for="namasiswa">Nama Siswa</label>
                                                    @if($errors->has('namasiswa')) 
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('namasiswa')}}
                                                    </div>
                                                    @endif
                                                </div>

                        <div class="form-floating mb-3 col-md-8">
                            <input type="text" class="form-control @if($errors->has('namapkl')) is-invalid @endif" name="namapkl" id="namapkl" placeholder="" value="{{$prakerin->nama_pkl}}" readonly>
                            <label for="namapkl">Nama PKL/Industri</label>
                            @if($errors->has('namapkl')) 
                            <div class="invalid-feedback">
                                {{$errors->first('namapkl')}}
                            </div>
                            @endif
                        </div>
                        
                        <div class="form-floating mb-3 col-md-8">
                        <textarea name="alamatpkl" id="alamatpkl" class="form-control @if($errors->has('alamatpkl')) is-invalid @endif" cols="50" style="height: 100px;" placeholder="" rows="10" readonly>{{$prakerin->alamat_pkl}}</textarea>
                            <label for="alamatpkl">Alamat PKL/Industri</label>
                            @if($errors->has('alamatpkl')) 
                            <div class="invalid-feedback">
                                {{$errors->first('alamatpkl')}}
                            </div>
                            @endif
                        </div>
                        
                        @endif


                        <div class="form-floating mb-3 col-md-10">
                            <input type="text" class="form-control @if($errors->has('nama_instruktur')) is-invalid @endif" name="nama_instruktur" id="nama_instruktur" placeholder="" value="<?php if(old('nama_instruktur')){ echo old('nama_instruktur'); }else{ echo $surat->nama_instruktur; } ?>">
                            <label for="nama_instruktur">Nama Instruktur</label>
                            @if($errors->has('nama_instruktur')) 
                            <div class="invalid-feedback">
                                {{$errors->first('nama_instruktur')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-group mb-3 col-md-6">
                            <label for="tahunPelajaran">Tahun Pelajaran</label>
                         <select class="form-select @if($errors->has('tahunPelajaran')) is-invalid @endif" name="tahunPelajaran" id="tahunPelajaran" >
                            <option value="" selected disabled hidden>Pilih Tahun Pelajaran</option>
                            @if($surat->tahun_pelajaran)
                                <option value="{{$surat->tahun_pelajaran}}" selected>{{$surat->tahun_pelajaran}}</option>
                            @endif
                            </select>
                            @if($errors->has('tahunPelajaran')) 
                            <div class="invalid-feedback">
                                {{$errors->first('tahunPelajaran')}}
                            </div>
                            @endif
                                        </div>


                        <div class="form-floating mb-3 col-md-6" >
                            <input type="number" class="form-control @if($errors->has('tahun')) is-invalid @endif" name="tahun" id="tahun" placeholder="" value="<?php if(old('tahun')){ echo old('tahun'); }else{ echo $surat->tahun; } ?>">
                            <label for="tahun">Tahun</label>
                            @if($errors->has('tahun')) 
                            <div class="invalid-feedback">
                                {{$errors->first('tahun')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-group mb-3 col-md-6">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control @if($errors->has('tanggal')) is-invalid @endif" value="<?php if(old('tanggal')){ echo old('tanggal'); }else{ echo date('Y-m-d'); } ?>">
                            @if($errors->has('tanggal')) 
                            <div class="invalid-feedback">
                                {{$errors->first('tanggal')}}
                            </div>
                            @endif
                                        </div>

                         
                       

                       

                        <div class="form-group mb-3 col-md-7">
                            <label for="kepalasekolah">Pilih Kepala Sekolah</label>
                            <select name="kepalasekolah" id="kepalasekolah" class="form-select   @if($errors->has('kepalasekolah')) is-invalid @endif">
                                <option value="" disabled hidden selected>-- Pilih kepala Sekolah --</option>
                                @foreach($kSekolah as $k)
                                <option value="{{$k->id}}" <?php if(old('kepalasekolah')){ if(old('kepalasekolah') == $k->id){ echo 'selected'; }}else{ if($surat->kepsek == $k->id){ echo 'selected'; } } ?>>{{$k->name}}</option>
                               @endforeach
                            </select>
                            @if($errors->has('kepalasekolah')) 
                            <div class="invalid-feedback">
                                {{$errors->first('kepalasekolah')}}
                            </div>
                            @endif
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="ubah Jurnal PKL" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#prakerin').select2();
        

        
        var prakerin = $('#prakerin').val();
            if(prakerin){
            $.ajax({
                url: '/Admin/JurnalPKL/prakerin/' + prakerin,
                type: 'GET',
                dataType: 'json',
                success: function (response){
                    $('#namapkl').val(response.pkl.nama_pkl);
                    $('#alamatpkl').val(response.pkl.alamat_pkl);
                    $('#namasiswa').val(response.pkl.nama_siswa);
                    console.log(prakerin);
                    
                },
                error: function (error){
                    console.log(error);
                }
            });
        }else{
            $('#namapkl').val('');
            $('#alamatpkl').val('');
            $('#namasiswa').val('');
        }


        $('#prakerin').change(function(){
            var prakerin = $(this).val();
            if(prakerin){
            $.ajax({
                url: '/Admin/JurnalPKL/prakerin/' + prakerin,
                type: 'GET',
                dataType: 'json',
                success: function (response){
                    $('#namapkl').val(response.pkl.nama_pkl);
                    $('#alamatpkl').val(response.pkl.alamat_pkl);
                    $('#namasiswa').val(response.pkl.nama_siswa);
                    console.log(prakerin);
                    
                },
                error: function (error){
                    console.log(error);
                }
            });
        }else{
            $('#namapkl').val('');
            $('#alamatpkl').val('');
            $('#namasiswa').val('');
        }
        });
        var currentYear = new Date().getFullYear();
        for (var i = 0; i < 2; i++) {
    var startYear = currentYear + i;
    var endYear = startYear + 1;
    var optionText = startYear + '/' + endYear;
   
    if (!$('#tahunPelajaran option[value="' + optionText + '"]').length) {
        $('#tahunPelajaran').append('<option value="' + optionText + '">' + optionText + '</option>');
    }
}
    });
</script>

@endsection