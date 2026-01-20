@extends('layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1>Ubah Surat tugas</h1>
                </div>
                <div class="card-body p-5">
                    @if(session('gagal'))
                    <div class="alert-danger alert text-center">
                        {{session('gagal')}}
                    </div>
                    @endif
                    <div class="my-4">
                        <a href="/Pendamping/Pengajuan" class="btn-danger btn">Kembali</a>

                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                       
                      @if(auth()->guard('pendamping')->check())
                      <input type="hidden" name="nip" value="{{auth()->guard('pendamping')->user()->nip}}">
                      @else
                      <div class="form-group col-md-6 mb-3">
                            <label for="nip">Pilih Guru Pendamping</label>
                            <select name="nip" id="id_nip" class="form-select @if($errors->has('nip')) is-invalid @endif">
                                <option value="" disabled selected hidden>Pilih Guru Pendamping</option>
                                @foreach($pendamping as $p)
                                    <option value="{{$p->nip}}" <?php if(old('nip')){ if(old('nip') == $p->nip){ echo 'selected'; }}else{ if($surat->nip == $p->nip){ echo 'selected'; }} ?>>{{$p->nama}}</option>    
                                @endforeach
                            </select>
                            @if($errors->has('nip'))
                            <div class="invalid-feedback">
                                {{$errors->first('nip')}}
                            </div>
                            @endif
                        </div>
                      @endif

                        <div class="form-group mb-3 col-md-5">
                            <label for="tujuan">Tujuan</label>
                            <select name="tujuan" id="tujuan" class="form-select   @if($errors->has('tujuan')) is-invalid @endif">
                                <option value="" disabled hidden selected>-- Pilih Tujuan --</option>
                                
                                <option value="Penyerahan" <?php if(old('tujuan')){ if(old('tujuan') == "Penyerahan"){ echo 'selected'; }}else{ if($surat->tujuan === "Penyerahan"){ echo 'selected'; } } ?>>Penyerahan</option>
                                <option value="Monitoring" <?php if(old('tujuan')){ if(old('tujuan') == "Monitoring"){ echo 'selected'; }}else{ if($surat->tujuan === "Monitoring"){ echo 'selected'; } } ?>>Monitoring</option>
                                <option value="Penarikan" <?php if(old('tujuan')){ if(old('tujuan') == "Penarikan"){ echo 'selected'; }}else{ if($surat->tujuan === "Penarikan"){ echo 'selected'; } } ?>>Penarikan</option>
                               
                            </select>
                            @if($errors->has('tujuan')) 
                            <div class="invalid-feedback">
                                {{$errors->first('tujuan')}}
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

                        <div class="form-group mb-3">
                            <label for="tanggal">Pada Tanggal</label>
                            <input type="date" class="form-control @if($errors->has('tanggal')) is-invalid @endif" name="tanggal" id="tanggal" placeholder="" value="<?php if(old('tanggal')){ echo old('tanggal'); }else{ echo $surat->tanggal; } ?>" >
                            @if($errors->has('tanggal')) 
                            <div class="invalid-feedback">
                                {{$errors->first('tanggal')}}
                            </div>
                            @endif
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control @if($errors->has('lama')) is-invalid @endif" name="lama" id="lama" placeholder="" value="<?php if(old('lama')){ echo old('lama'); }else{ echo $surat->lama; } ?>">
                            <label for="lama">Lamanya perjalanan dinas (hari)</label>
                            @if($errors->has('lama')) 
                            <div class="invalid-feedback">
                                {{$errors->first('lama')}}
                            </div>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="tanggalberangkat">Tanggal berangkat</label>
                            <input type="date" class="form-control @if($errors->has('tanggalberangkat')) is-invalid @endif" name="tanggalberangkat" id="tanggalberangkat" placeholder="" value="<?php if(old('tanggalberangkat')){ echo old('tanggalberangkat'); }else{ echo $surat->tanggal_berangkat; } ?>" >
                            @if($errors->has('tanggalberangkat')) 
                            <div class="invalid-feedback">
                                {{$errors->first('tanggalberangkat')}}
                            </div>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="tanggalharuskembali">Tanggal Harus Kembali</label>
                            <input type="date" class="form-control @if($errors->has('tanggalharuskembali')) is-invalid @endif" name="tanggalharuskembali" id="tanggalharuskembali" placeholder="" value="<?php if(old('tanggalharuskembali')){ echo old('tanggalharuskembali'); }else{ echo $surat->tanggal_harus_kembali; } ?>" >
                            @if($errors->has('tanggalharuskembali')) 
                            <div class="invalid-feedback">
                                {{$errors->first('tanggalharuskembali')}}
                            </div>
                            @endif
                        </div>

                      
                        <div class="form-group col-md-6 mb-3">
                            <label for="pkl">Pilih PKL / Industri</label>
                            <select name="pkl" id="id_pkl" class="form-select @if($errors->has('pkl')) is-invalid @endif">
                                <option value="" disabled selected hidden>Pilih PKL / Industri</option>
                                @foreach($pkl as $p)
                                    <option value="{{$p->idpkl}}" <?php if(old('pkl')){ if(old('pkl') == $p->idpkl){ echo 'selected'; }}else{ if($surat->industri === $p->idpkl){ echo 'selected'; }} ?>>{{$p->nama_pkl}}</option>    
                                @endforeach
                            </select>
                            @if($errors->has('pkl'))
                            <div class="invalid-feedback">
                                {{$errors->first('pkl')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @if($errors->has('kendaraan')) is-invalid @endif" name="kendaraan" id="kendaraan" placeholder="" value="<?php if(old('kendaraan')){ echo old('kendaraan'); }else{ echo $surat->kendaraan; } ?>">
                            <label for="kendaraan">Kendaraan</label>
                            @if($errors->has('kendaraan')) 
                            <div class="invalid-feedback">
                                {{$errors->first('kendaraan')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-group mb-3 col-md-5">
                            <label for="kepalasekolah">Pilih Kepala Sekolah</label>
                            <select name="kepalasekolah" id="kepalasekolah" class="form-select   @if($errors->has('kepalasekolah')) is-invalid @endif">
                                <option value="" disabled hidden selected>-- Pilih kepala Sekolah --</option>
                                @foreach($kSekolah as $k)
                                <option value="{{$k->id}}" <?php if(old('kepalasekolah')){ if(old('kepalasekolah') == $k->id){ echo 'selected'; }}else{ if($surat->kepala_sekolah === $k->id){ echo 'selected'; }} ?>>{{$k->name}}</option>
                               @endforeach
                            </select>
                            @if($errors->has('kepalasekolah')) 
                            <div class="invalid-feedback">
                                {{$errors->first('kepalasekolah')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @if($errors->has('keterangan')) is-invalid @endif" name="keterangan" id="keterangan" placeholder="" value="<?php if(old('keterangan')){ echo old('keterangan'); }else{ echo $surat->keterangan; } ?>">
                            <label for="keterangan">Keterangan lain (opsional)</label>
                            @if($errors->has('keterangan')) 
                            <div class="invalid-feedback">
                                {{$errors->first('keterangan')}}
                            </div>
                            @endif
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Ubah PDF" class="btn btn-primary">
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
        $('#id_nip').select2();
    });
</script>
@endsection