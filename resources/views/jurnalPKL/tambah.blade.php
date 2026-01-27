@extends('layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center d-flex">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center py-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="mb-0">Tambah Jurnal</h1>
                    </div>
                </div>
                <div class="card-body p-5">
                    @if(session('gagal'))
                    <div class="alert-danger alert text-center">
                        {{session('gagal')}}
                    </div>
                    @endif
                    @if(auth()->check())
                    <div class="my-4">
                        <a href="/Siswa/JurnalPKL" class="btn-danger btn">Kembali</a>
                    </div>
                    @endif
                    <form action="" method="post" enctype="multipart/form-data" id="Form">
                        @csrf
                        @if(auth()->check())
                        <div class="form-group col-md-10 mb-3">
                            <label for="prakerin">Pilih Prakerin</label>
                            <select name="prakerin" id="prakerin" class="form-select @if($errors->has('prakerin')) is-invalid @endif">
                                <option value="" disabled selected hidden>Pilih Prakerin</option>
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
                            <input type="text" class="form-control @if($errors->has('nama_instruktur')) is-invalid @endif" name="nama_instruktur" id="nama_instruktur" placeholder="" value="{{old('nama_instruktur')}}">
                            <label for="nama_instruktur">Nama Instruktur (Pimpinan)</label>
                            @if($errors->has('nama_instruktur')) 
                            <div class="invalid-feedback">
                                {{$errors->first('nama_instruktur')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-group mb-3 col-md-6">
                            <label for="tahunPelajaran">Tahun Pelajaran</label>
                         <select class="form-select @if($errors->has('tahunPelajaran')) is-invalid @endif" name="tahunPelajaran" id="tahunPelajaran" value="{{old('tahunPelajaran')}}">
                            <option value="" selected disabled hidden>Pilih Tahun Pelajaran</option>
                            </select>
                            @if($errors->has('tahunPelajaran')) 
                            <div class="invalid-feedback">
                                {{$errors->first('tahunPelajaran')}}
                            </div>
                            @endif
                                        </div>


                        <div class="form-floating mb-3 col-md-6" >
                            <input type="number" class="form-control @if($errors->has('tahun')) is-invalid @endif" name="tahun" id="tahun" placeholder="" value="{{date('Y')}}" readonly>
                            <label for="tahun">Tahun</label>
                            @if($errors->has('tahun')) 
                            <div class="invalid-feedback">
                                {{$errors->first('tahun')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-group mb-3 col-md-6">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control @if($errors->has('tanggal')) is-invalid @endif" value="<?php if(old('tanggal')){ echo old('tanggal'); }else{ echo date('Y-m-d'); } ?>" readonly>
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
                                <option value="{{$k->id}}" <?php if(old('kepalasekolah') == $k->id){ echo 'selected'; } ?>>{{$k->name}}</option>
                               @endforeach
                            </select>
                            @if($errors->has('kepalasekolah')) 
                            <div class="invalid-feedback">
                                {{$errors->first('kepalasekolah')}}
                            </div>
                            @endif
                        </div>
                        <div class="d-flex justify-content-end">
                            <style>
                             .cssbuttons-io-button {
  background: #919191;
  color: white;
  font-family: inherit;
  padding: 0.35em;
  padding-left: 1.2em;
  font-size: 17px;
  font-weight: 500;
  border-radius: 0.9em;
  border: none;
  letter-spacing: 0.05em;
  display: flex;
  align-items: center;
  box-shadow: inset 0 0 1.6em -0.6em #919191;
  overflow: hidden;
  position: relative;
  height: 2.8em;
  padding-right: 3.3em;
  cursor: pointer;
}

.cssbuttons-io-button .icon {
  background: white;
  margin-left: 1em;
  position: absolute;
  display: flex;
  align-items: center;
  justify-content: center;
  height: 2.2em;
  width: 2.2em;
  border-radius: 0.7em;
  box-shadow: 0.1em 0.1em 0.6em 0.2em #919191;
  right: 0.3em;
  transition: all 0.3s;
}

.cssbuttons-io-button:hover .icon {
  width: calc(100% - 0.6em);
}

.cssbuttons-io-button .icon svg {
  width: 1.1em;
  transition: transform 0.3s;
  color: #919191;
}

.cssbuttons-io-button:hover .icon svg {
  transform: translateX(0.1em);
}

.cssbuttons-io-button:active .icon {
  transform: scale(0.95);
}

                            </style>
                         <button type="submit" class="cssbuttons-io-button mt-5">
  Dapatkan jurnal
  <div class="icon">
    <svg
      height="24"
      width="24"
      viewBox="0 0 24 24"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path d="M0 0h24v24H0z" fill="none"></path>
      <path
        d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
        fill="currentColor"
      ></path>
    </svg>
  </div>
</button>

                            
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
        }
        });
        var currentYear = new Date().getFullYear();
        for (var i = 0; i < 3; i++) {
        var startYear = currentYear + i - 1;
        var endYear = startYear + 1;
        var optionText = startYear + '/' + endYear;
        $('#tahunPelajaran').append('<option value="' + optionText + '">' + optionText + '</option>');
    }
    });
</script>
<script>
   document.getElementById('Form').addEventListener('submit', function(e) {
  

  Swal.fire({
     
      title: 'Sedang Memproses',
      allowOutsideClick: false,
      showConfirmButton: false,
      willOpen: () => {
          Swal.showLoading();
      }
  });
  });
</script>
@endsection