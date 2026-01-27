@extends('layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1>Edit Pengajuan Siswa</h1>
                </div>
                <div class="card-body p-5">
                   

                    
                     @if(session('error'))
                     <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                     {{session('error')}}
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
                     @endif
                    <div class="my-4">
                        <a href="/Siswa/Pengajuan" class="btn btn-danger">Kembali</a>
                    </div>

                    <form action="" method="post">
                        @csrf
                   
                        <div class="form-group col-md-6 mb-3">
                            <label for="pkl">Pilih PKL / Industri</label>
                            <select name="pkl" id="pkl" class="form-select @if($errors->has('pkl')) is-invalid @endif">
                                <option value="" selected disabled hidden>Pilih pkl</option>
                                @foreach($pkl as $j)
                                <option value="{{ $j->idpkl }}" <?php if(old('pkl')){ if(old('pkl') == $j->idpkl){ echo 'selected'; }}else{ if($surat->industri == $j->idpkl){ echo 'selected'; } } ?>>{{ $j->nama_pkl }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('pkl')) 
                            <div class="invalid-feedback">
                                {{$errors->first('pkl')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-group col-md-6 mb-3" id="jumlahh">
                            <label for="jumlah">Jumlah Siswa</label>
                            <select name="jumlah" id="jumlah" class="form-select @if($errors->has('jumlah')) is-invalid @endif">
                            </select>
                            @if($errors->has('jumlah')) 
                            <div class="invalid-feedback">
                                {{$errors->first('jumlah')}}
                            </div>
                            @endif
                        </div>

                     

                        @if(auth()->guard('siswa')->check())
                        <div class="form-group col-md-6 mb-3" id="form-siswa1">
                            <label for="siswa1">NIS Siswa pertama (Anda sendiri)</label>
                            <input type="text" name="siswa1" id="siswa" class="form-control @if($errors->has('siswa1')) is-invalid @endif" readonly value="{{auth()->guard('siswa')->user()->nisn}}">
                            @if($errors->has('siswa1')) 
                            <div class="invalid-feedback">
                                {{$errors->first('siswa1')}}
                            </div>
                            @endif
                        </div>
                        @else
                        <div class="form-group col-md-6 mb-3" id="form-siswa1">
                            <label for="siswa1">Nama Siswa pertama</label>
                            <select name="siswa1" id="siswa1" class="form-select @if($errors->has('siswa1')) is-invalid @endif">
                               @foreach($siswa as $s)
                                <option value="{{$s->nisn}}" <?php if(old('siswa1')){ if(old('siswa1') == $s->nisn){ echo 'selected'; }}elseif(isset($surat->siswa1)){ if($surat->siswa1 == $s->nisn){ echo 'selected'; } } ?>>{{$s->nama_siswa}} || NIS {{$s->nisn}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('siswa1')) 
                            <div class="invalid-feedback">
                                {{$errors->first('siswa1')}}
                            </div>
                            @endif
                            <br><br>
                        </div>
                        @endif

                        <div class="form-group col-md-6 mb-3" id="form-siswa2">
                            <label for="siswa2">Nama Siswa kedua</label>
                            <select name="siswa2" id="siswa2" class="form-select @if($errors->has('siswa2')) is-invalid @endif">
                               @foreach($siswa as $s)
                                <option value="{{$s->nisn}}" <?php if(old('siswa2')){ if(old('siswa2') == $s->nisn){ echo 'selected'; }}elseif(isset($surat->siswa2)){ if($surat->siswa2 == $s->nisn){ echo 'selected'; } } ?>>{{$s->nama_siswa}} || NIS {{$s->nisn}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('siswa2')) 
                            <div class="invalid-feedback">
                                {{$errors->first('siswa2')}}
                            </div>
                            @endif
                            <br><br>
                        </div>

                        <div class="form-group col-md-6 mb-3" id="form-siswa3">
                            <label for="siswa3">Nama Siswa ketiga</label>
                            <select name="siswa3" id="siswa3" class="form-select @if($errors->has('siswa3')) is-invalid @endif">
                               @foreach($siswa as $s)
                                <option value="{{$s->nisn}}" <?php if(old('siswa3')){ if(old('siswa3') == $s->nisn){ echo 'selected'; }}elseif(isset($surat->siswa3)){ if($surat->siswa3 == $s->nisn){ echo 'selected'; } } ?>>{{$s->nama_siswa}} || NIS {{$s->nisn}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('siswa3')) 
                            <div class="invalid-feedback">
                                {{$errors->first('siswa3')}}
                            </div>
                            @endif
                            <br><br>
                        </div>

                        <div class="form-group col-md-6 mb-3" id="form-siswa4">
                            <label for="siswa4">Nama Siswa keempat</label>
                            <select name="siswa4" id="siswa4" class="form-select @if($errors->has('siswa4')) is-invalid @endif">
                               @foreach($siswa as $s)
                                <option value="{{$s->nisn}}" <?php if(old('siswa4')){ if(old('siswa4') == $s->nisn){ echo 'selected'; }}elseif(isset($surat->siswa4)){ if($surat->siswa4 == $s->nisn){ echo 'selected'; } } ?>>{{$s->nama_siswa}} || NIS {{$s->nisn}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('siswa4')) 
                            <div class="invalid-feedback">
                                {{$errors->first('siswa4')}}
                            </div>
                            @endif
                            <br><br>
                        </div>

                        <div class="form-group mb-3 col-md-6">
                            <label for="tahunPelajaran">Tahun Pelajaran</label>
                         <select class="form-select @if($errors->has('tahunPelajaran')) is-invalid @endif" name="tahunPelajaran" id="tahunPelajaran" value="{{old('tahunPelajaran')}}">
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

                                        <div class="form-group mb-3 col-md-6">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control @if($errors->has('tanggal')) is-invalid @endif" value="<?php if(old('tanggal')){ echo old('tanggal'); }else{ echo $surat->tanggal; } ?>">
                            @if($errors->has('tanggal')) 
                            <div class="invalid-feedback">
                                {{$errors->first('tanggal')}}
                            </div>
                            @endif
                                        </div>

                                        <div class="form-group mb-3 col-md-6">
                            <label for="mulai">Mulai Tanggal</label>
                            <input type="date" name="mulai" id="mulai" class="form-control @if($errors->has('mulai')) is-invalid @endif" value="<?php if(old('mulai')){ echo old('mulai'); }else{ echo $surat->tanggal_mulai; } ?>">
                            @if($errors->has('mulai')) 
                            <div class="invalid-feedback">
                                {{$errors->first('mulai')}}
                            </div>
                            @endif
                                        </div>

                                        <div class="form-group mb-3 col-md-6">
                            <label for="akhir">Sampai Tanggal</label>
                            <input type="date" name="akhir" id="akhir" class="form-control @if($errors->has('akhir')) is-invalid @endif" value="<?php if(old('akhir')){ echo old('akhir'); }else{ echo $surat->tanggal_selesai; } ?>">
                            @if($errors->has('akhir')) 
                            <div class="invalid-feedback">
                                {{$errors->first('akhir')}}
                            </div>
                            @endif
                                        </div>

                                        <div class="form-floating mb-3 col-md-6">
                            <input type="number" class="form-control @if($errors->has('lama')) is-invalid @endif" name="lama" id="lama" placeholder="" value="<?php if(old('lama')){ echo old('lama'); }else{ echo $surat->waktu_bulan; } ?>" readonly>
                            <label for="lama">Lamanya melaksanakan PKL (dalam bulan)</label>
                            @if($errors->has('lama')) 
                            <div class="invalid-feedback">
                                {{$errors->first('lama')}}
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

                        <div class="form-floating mb-5 col-md-6">
                            <input type="number" class="form-control @if($errors->has('tahun')) is-invalid @endif" name="tahun" id="tahun" placeholder="" value="<?php if(old('tahun')){ echo old('tahun'); }else{ echo $surat->tahun; } ?>">
                            <label for="tahun">Tahun</label>
                            @if($errors->has('tahun')) 
                            <div class="invalid-feedback">
                                {{$errors->first('tahun')}}
                            </div>
                            @endif
                        </div>
                        
                        <div class="form-group mt-3">
                            <h4>Surat Pengantar</h4>
                            <div class="form-check">
                                <input type="radio" name="pengantar" id="belum_pengantar" class="form-check-input" value="0" <?php if($surat->suratPengantar == '0'){ echo 'checked'; } ?>>
                            <label for="pengantar" class="form-check-label">Belum</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="pengantar" id="sudah_pengantar" class="form-check-input" value="1" <?php if($surat->suratPengantar == '1'){ echo 'checked'; } ?>>
                            <label for="pengantar" class="form-check-label">Sudah</label>
                        </div>
                        <div class="form-group col-md-5" id="tgl_pengantar">
                        <label for="tanggal_pengantar">Tanggal Surat Pengantar</label>
                        <input type="date" name="tanggal_pengantar" class="form-control" id="tanggal_pengantar" value="<?php if(old('tanggal_pengantar')){echo old('tanggal_pengantar'); }elseif(isset($surat->tanggal_pengantar)){ echo $surat->tanggal_pengantar; }else{ echo date('Y-m-d'); } ?>">
                        </div>
                    </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Ubah PDF" class="btn btn-outline-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  $(document).ready(function(){
    $('#pkl').select2();
    $('#jumlahh').hide();

    $('#siswa1').select2();
    $('#siswa2').select2();
    $('#siswa3').select2();
    $('#siswa4').select2();
    $('#form-siswa1').hide();
    $('#form-siswa2').hide();
    $('#form-siswa3').hide();
    $('#form-siswa4').hide();
    $('#tgl_pengantar').hide();

    if($('input[name="pengantar"][value="1"]').is(':checked')){
        $('#tgl_pengantar').show();
    }
  $('input[name="pengantar"][value="0"]').change(function(){
    if($(this).is(':checked')){
        $('#tgl_pengantar').hide();
    }
  });

  $('input[name="pengantar"][value="1"]').change(function(){
    if($(this).is(':checked')){
        $('#tgl_pengantar').show();
    }
  });
    
    var id_pkl = $('#pkl').val();
        if(id_pkl){
            $.ajax({
                url: '/get-quota/' + id_pkl, 
                type: 'GET',
                dataType: 'json',
                success: function (response){
                    $('#jumlah').empty(); 
                    var maxOptions = Math.min(response.quota, 4); 
                    for (var i = 1; i <= maxOptions; i++) {
                        var selected = '';
                        if ('{{ old("jumlah") }}' == i) {
                            selected = 'selected';
                        }else{
                            if('{{$surat->jumlah_siswa}}' == i){
                                selected = 'selected';
                            }
                        }
                        $('#jumlah').append('<option value="' + i + '" ' + selected + '>' + i + ' Siswa</option>');
                    
                    }
                    $('#jumlahh').show();
                    $('#jumlah').change(function(){
                        if($(this).val() == '1'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').hide();
                            $('#form-siswa3').hide();
                            $('#form-siswa4').hide();
                        }
                        else if($(this).val() == '2'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').show();
                            $('#form-siswa3').hide();
                            $('#form-siswa4').hide();
                        }
                        else if($(this).val() == '3'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').show();
                            $('#form-siswa3').show();
                            $('#form-siswa4').hide();
                        }
                        else if($(this).val() == '4'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').show();
                            $('#form-siswa3').show();
                            $('#form-siswa4').show();
                        }
                    });
                    if($('#jumlah').val() == '1'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').hide();
                            $('#form-siswa3').hide();
                            $('#form-siswa4').hide();
                        }
                        else if($('#jumlah').val() == '2'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').show();
                            $('#form-siswa3').hide();
                            $('#form-siswa4').hide();
                        }
                        else if($('#jumlah').val() == '3'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').show();
                            $('#form-siswa3').show();
                            $('#form-siswa4').hide();
                        }
                        else if($('#jumlah').val() == '4'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').show();
                            $('#form-siswa3').show();
                            $('#form-siswa4').show();
                        }
                },
                error: function(error){
                    console.log(error);
                }
            });
        } else {
            $('#jumlahh').hide();
        }
    $('#pkl').change(function(){
        var id_pkl = $(this).val();
        if(id_pkl){
            $.ajax({
                url: '/get-quota/' + id_pkl, 
                type: 'GET',
                dataType: 'json',
                success: function (response){
                    $('#jumlah').empty(); 
                    var maxOptions = Math.min(response.quota, 4); 
                    for (var i = 1; i <= maxOptions; i++) {
                        $('#jumlah').append('<option value="' + i + '">' + i + ' Siswa</option>');
                    }
                    $('#jumlahh').show();
                    $('#jumlah').change(function(){
                        if($(this).val() == '1'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').hide();
                            $('#form-siswa3').hide();
                            $('#form-siswa4').hide();
                        }
                        else if($(this).val() == '2'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').show();
                            $('#form-siswa3').hide();
                            $('#form-siswa4').hide();
                        }
                        else if($(this).val() == '3'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').show();
                            $('#form-siswa3').show();
                            $('#form-siswa4').hide();
                        }
                        else if($(this).val() == '4'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').show();
                            $('#form-siswa3').show();
                            $('#form-siswa4').show();
                        }
                    });
                    if($('#jumlah').val() == '1'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').hide();
                            $('#form-siswa3').hide();
                            $('#form-siswa4').hide();
                        }
                        else if($('#jumlah').val() == '2'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').show();
                            $('#form-siswa3').hide();
                            $('#form-siswa4').hide();
                        }
                        else if($('#jumlah').val() == '3'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').show();
                            $('#form-siswa3').show();
                            $('#form-siswa4').hide();
                        }
                        else if($('#jumlah').val() == '4'){
                            $('#form-siswa1').show();
                            $('#form-siswa2').show();
                            $('#form-siswa3').show();
                            $('#form-siswa4').show();
                        }
                },
                error: function(error){
                    console.log(error);
                }
            });
        } else {
            $('#jumlahh').hide();
        }
    });
    var currentYear = new Date().getFullYear();

   
    for (var i = 0; i < 3; i++) {
    var startYear = currentYear + i - 1;
    var endYear = startYear + 1;
    var optionText = startYear + '/' + endYear;
   
    if (!$('#tahunPelajaran option[value="' + optionText + '"]').length) {
        $('#tahunPelajaran').append('<option value="' + optionText + '">' + optionText + '</option>');
    }
}

    var mulai = new Date($('#mulai').val());
        var akhir = new Date($('#akhir').val());

        if (mulai && akhir) {
            // Hitung selisih dalam bulan
            var differenceInMonths = (akhir.getFullYear() - mulai.getFullYear()) * 12 + (akhir.getMonth() - mulai.getMonth());

            // Set nilai lama dengan tambahan kata 'bulan'
            $('#lama').val(differenceInMonths);
        }
    $('#mulai, #akhir').change(function() {
        var mulai = new Date($('#mulai').val());
        var akhir = new Date($('#akhir').val());

        if (mulai && akhir) {
            // Hitung selisih dalam bulan
            var differenceInMonths = (akhir.getFullYear() - mulai.getFullYear()) * 12 + (akhir.getMonth() - mulai.getMonth());

            // Set nilai lama dengan tambahan kata 'bulan'
            $('#lama').val(differenceInMonths);
        }
    });
});

</script>
@endsection
