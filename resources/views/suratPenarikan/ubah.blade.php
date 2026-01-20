@extends('layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center py-3">
                    <h1>Tambah Surat Penarikan PKL</h1>
                </div>
                <div class="card-body p-5">
                    @if(session('gagal'))
                    <div class="alert-danger alert text-center">
                        {{session('gagal')}}
                    </div>
                    @endif
                    <div class="my-4">
                        <a href="/Siswa/suratPenarikan" class="btn-danger btn">Kembali</a>

                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-10 mb-3">
                            <label for="prakerin">Pilih Prakerin</label>
                            <select name="prakerin" id="prakerin" class="form-select @if($errors->has('prakerin')) is-invalid @endif">
                                <option value="" disabled selected hidden>Pilih Prakerin</option>
                                @foreach($prakerin as $p)
                                    <option value="{{$p->idprakerin}}" <?php if(old('prakerin')){ if(old('prakerin') == $p->idprakerin){ echo 'selected'; }}else{ if($surat->prakerin == $p->idprakerin){ echo 'selected'; } } ?>>Id Prakerin: {{$p->idprakerin}} || NIS: {{$p->nisn}} || Nama: {{$p->nama_siswa}}</option>    
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
                            <input type="text" class="form-control @if($errors->has('alamatpkl')) is-invalid @endif" style="height: 100px;" name="alamatpkl" id="alamatpkl" placeholder="" value="{{old('alamatpkl')}}" readonly>
                            <label for="alamatpkl">Alamat PKL/Industri</label>
                            @if($errors->has('alamatpkl')) 
                            <div class="invalid-feedback">
                                {{$errors->first('alamatpkl')}}
                            </div>
                            @endif
                        </div>
                        
                        

                        <div class="form-floating mb-3 col-md-6" >
                            <input type="number" class="form-control @if($errors->has('tahun')) is-invalid @endif" name="tahun" id="tahun" placeholder="" value="{{$surat->tahun}}">
                            <label for="tahun">Tahun</label>
                            @if($errors->has('tahun')) 
                            <div class="invalid-feedback">
                                {{$errors->first('tahun')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-group mb-3 col-md-6">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control @if($errors->has('tanggal')) is-invalid @endif" value="<?php if(old('tanggal')){ echo old('tanggal'); }else{ echo $surat->tanggal; } ?>">
                            @if($errors->has('tanggal')) 
                            <div class="invalid-feedback">
                                {{$errors->first('tanggal')}}
                            </div>
                            @endif
                                        </div>

                         
                        <div class="form-floating mb-3 col-md-10">
                            <input type="text" class="form-control @if($errors->has('alasan')) is-invalid @endif" name="alasan" id="alasan" placeholder="" value="<?php if(old('alasan')){ echo old('alasan'); }else{ echo $surat->alasan; } ?>">
                            <label for="alasan">Alasan</label>
                            @if($errors->has('alasan')) 
                            <div class="invalid-feedback">
                                {{$errors->first('alasan')}}
                            </div>
                            @endif
                        </div>

                       

                        <div class="form-group mb-3 col-md-5">
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
        $('#prakerin').select2();
        
        var prakerin = $('#prakerin').val();
            if(prakerin){
            $.ajax({
                url: '/Admin/suratPenarikan/dapatkanpkl/' + prakerin,
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
        }


        $('#prakerin').change(function(){
            var prakerin = $(this).val();
            if(prakerin){
            $.ajax({
                url: '/Admin/suratPenarikan/dapatkanpkl/' + prakerin,
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
        }
        });
        
    });
</script>

@endsection