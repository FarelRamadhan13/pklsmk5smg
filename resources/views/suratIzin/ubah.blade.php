@extends('layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1>Ubah Surat Izin PKL</h1>
                </div>
                <div class="card-body p-5">
                    @if(session('gagal'))
                    <div class="alert-danger alert text-center">
                        {{session('gagal')}}
                    </div>
                    @endif
                    <div class="my-4">
                        <a href="/Siswa/suratIzin" class="btn-danger btn">Kembali</a>

                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-6 mb-3">
                            <label for="pkl">Pilih PKL / Industri</label>
                            <select name="pkl" id="id_pkl" class="form-select @if($errors->has('pkl')) is-invalid @endif">
                                <option value="" disabled selected hidden>Pilih PKL / Industri</option>
                                @foreach($pkl as $p)
                                    <option value="{{$p->idpkl}}" <?php if(old('pkl')){ if(old('pkl') == $p->idpkl){ echo 'selected'; }}else{ if($surat->industri == $p->idpkl){ echo 'selected'; } } ?>>{{$p->nama_pkl}}</option>    
                                @endforeach
                            </select>
                            @if($errors->has('pkl'))
                            <div class="invalid-feedback">
                                {{$errors->first('pkl')}}
                            </div>
                            @endif
                        </div>

                     

                        <div class="form-floating mb-3 col-md-6" >
                            <input type="number" class="form-control @if($errors->has('tahun')) is-invalid @endif" name="tahun" id="tahun" placeholder="" value="{{date('Y')}}">
                            <label for="tahun">tahun PKL</label>
                            @if($errors->has('tahun')) 
                            <div class="invalid-feedback">
                                {{$errors->first('tahun')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-group mb-3 col-md-6">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control @if($errors->has('tanggal')) is-invalid @endif" value="<?php if(old('tanggal')){ echo old('tanggal'); }elseif(isset($surat->tanggal)){ echo $surat->tanggal; }else{ echo date('Y-m-d'); } ?>">
                            @if($errors->has('tanggal')) 
                            <div class="invalid-feedback">
                                {{$errors->first('tanggal')}}
                            </div>
                            @endif
                                        </div>

                                        <div class="form-group mb-3 col-md-6">
                            <label for="pada_tanggal">Pada Tanggal</label>
                            <input type="date" class="form-control @if($errors->has('pada_tanggal')) is-invalid @endif" name="pada_tanggal" id="pada_tanggal" placeholder="" value="<?php if(old('padat_tanggal')){ echo old('pada_tanggal'); }else{ echo $surat->pada_tanggal; } ?>" >
                            @if($errors->has('pada_tanggal')) 
                            <div class="invalid-feedback">
                                {{$errors->first('pada_tanggal')}}
                            </div>
                            @endif
                        </div>

                        <div class="col-md-4 mb-3">
                        <label for="waktu" class="form-label">Waktu</label>
                        <input type="time" id="waktu" name="waktu" class="form-control @if($errors->has('waktu')) is-invalid @endif" value="<?php if(old('waktu')){ echo old('waktu'); }else{ echo $surat->waktu; } ?>">
                        @if($errors->has('waktu')) 
                        <div class="invalid-feedback">
                            {{$errors->first('waktu')}}
                        </div>
                        @endif
                        </div>

                        <div class="form-group mb-3">
                            <label for="siswa">Pilih Siswa</label>
                            <select name="siswa" id="id_siswa" class="form-select @if($errors->has('siswa')) is-invalid @endif">
                            <option value="" disabled selected hidden>Pilih Siswa</option>
                                @foreach($siswa as $p)
                                    <option value="{{$p->nisn}}" <?php if(old('siswa')){ if(old('siswa') == $p->nisn){ echo 'selected'; }}else{ if($surat->siswa == $p->nisn){ echo 'selected'; }} ?>>{{$p->nama_siswa}} || NIS: {{$p->nisn}}</option>    
                                @endforeach
                            </select>
                            @if($errors->has('siswa'))
                            <div class="invalid-feedback">
                                {{$errors->first('siswa')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-floating mb-3" >
                            <input type="text" class="form-control @if($errors->has('berdasarkan')) is-invalid @endif" name="berdasarkan" id="berdasarkan" placeholder="" value="<?php if(old('berdasarkan')){ echo old('berdasarkan'); }else{ echo $surat->berdasarkan; } ?>">
                            <label for="berdasarkan">berdasarkan</label>
                            @if($errors->has('berdasarkan')) 
                            <div class="invalid-feedback">
                                {{$errors->first('berdasarkan')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-floating mb-3" >
                            <input type="text" class="form-control @if($errors->has('keperluan')) is-invalid @endif" name="keperluan" id="keperluan" placeholder="" value="<?php if(old('keperluan')){ echo old('keperluan'); }else{ echo $surat->keperluan; } ?>">
                            <label for="keperluan">Keperluan</label>
                            @if($errors->has('keperluan')) 
                            <div class="invalid-feedback">
                                {{$errors->first('keperluan')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-floating mb-3 col-md-6" >
                            <input type="text" class="form-control @if($errors->has('tempat')) is-invalid @endif" name="tempat" id="tempat" placeholder="" value="<?php if(old('tempat')){ echo old('tempat'); }else{ echo $surat->tempat; } ?>">
                            <label for="tempat">Tempat</label>
                            @if($errors->has('tempat')) 
                            <div class="invalid-feedback">
                                {{$errors->first('tempat')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-group mb-3 col-md-5">
                            <label for="kepalasekolah">Pilih Kepala Sekolah</label>
                            <select name="kepalasekolah" id="kepalasekolah" class="form-select   @if($errors->has('kepalasekolah')) is-invalid @endif">
                                <option value="" disabled hidden selected>-- Pilih kepala Sekolah --</option>
                                @foreach($kSekolah as $k)
                                <option value="{{$k->id}}" <?php if(old('kepalasekolah')){ if(old('kepalasekolah') == $k->id){ echo 'selected'; }}else{ if($surat->kepsek == $k->id){ echo 'selected'; }} ?>>{{$k->name}}</option>
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
        $('#id_pkl').select2();
        $('#id_siswa').select2();
        
    });
</script>

@endsection