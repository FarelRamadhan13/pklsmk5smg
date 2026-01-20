@extends('layout.app')
@section('content')
<style>
    .print-btn {
  width: 100px;
  height: 45px;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: white;
  border: 1px solid rgb(213, 213, 213);
  border-radius: 10px;
  gap: 10px;
  font-size: 16px;
  cursor: pointer;
  overflow: hidden;
  font-weight: 500;
  box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.065);
  transition: all 0.3s;
}
.printer-wrapper {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 20px;
  height: 100%;
}
.printer-container {
  height: 50%;
  width: 100%;
  display: flex;
  align-items: flex-end;
  justify-content: center;
}

.printer-container svg {
  width: 100%;
  height: auto;
  transform: translateY(4px);
}
.printer-page-wrapper {
  width: 100%;
  height: 50%;
  display: flex;
  align-items: flex-start;
  justify-content: center;
}
.printer-page {
  width: 70%;
  height: 10px;
  border: 1px solid black;
  background-color: white;
  transform: translateY(0px);
  transition: all 0.3s;
  transform-origin: top;
}
.print-btn:hover .printer-page {
  height: 16px;
  background-color: rgb(239, 239, 239);
}
.print-btn:hover {
  background-color: rgb(239, 239, 239);
}

</style>
<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center my-3">
                    <h1>Tentukan Data Prakerin</h1>
                </div>
                <div class="card-body p-5">
                    @if(session('error'))
                    <div class="alert-danger alert text-center">
                        {{session('error')}}
                    </div>
                    @endif

                    
                    <div class="my-4">
                        <a href="" onclick="window.close()" class="btn-danger btn">Kembali</a>

                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <!--<div class="form-group col-md-6 mb-3">-->
                        <!--    <label for="tentukan">Tentukan</label>-->
                        <!--    <select name="tentukan" id="tentukan" class="form-select @if($errors->has('tentukan')) is-invalid @endif">-->
                        <!--        <option value="" disabled selected hidden>Start / End</option>-->
                        <!--       <option value="start" <?php if(old('tentukan') == 'start'){ echo 'selected'; } ?>>Start</option>-->
                        <!--       <option value="end" <?php if(old('tentukan') == 'end'){ echo 'selected'; } ?>>End</option>-->
                        <!--    </select>-->
                        <!--    @if($errors->has('tentukan'))-->
                        <!--    <div class="invalid-feedback">-->
                        <!--        {{$errors->first('tentukan')}}-->
                        <!--    </div>-->
                        <!--    @endif-->
                        <!--</div>-->
                        <!--<div class="form-group mb-3 col-md-8">-->
                        <!--    <label for="awal">Dari Tanggal</label>-->
                        <!--    <input type="date" name="awal" id="awal" class="form-control @if($errors->has('awal')) is-invalid @endif" value="{{old('awal')}}">-->
                        <!--    @if($errors->has('awal'))-->
                        <!--    <div class="invalid-feedback">-->
                        <!--        {{$errors->first('awal')}}-->
                        <!--    </div>-->
                        <!--    @endif-->
                        <!--</div>-->

                        <!--<div class="form-group mb-3 col-md-8">-->
                        <!--    <label for="akhir">Sampai Tanggal</label>-->
                        <!--    <input type="date" name="akhir" id="akhir" class="form-control @if($errors->has('akhir')) is-invalid @endif"value="{{old('akhir')}}">-->
                        <!--    @if($errors->has('akhir'))-->
                        <!--    <div class="invalid-feedback">-->
                        <!--        {{$errors->first('akhir')}}-->
                        <!--    </div>-->
                        <!--    @endif-->
                        <!--</div>-->
                        
                         <div class="form-group mb-3 col-md-5">
                            <label for="kelas">Tentukan</label>
                            <select name="tentukan" id="kelas" class="form-select @error('kelas') is-invalid @enderror">
                                <option value="">Semua Kelas</option>
                                @foreach($jurusan as $k)
                                   
                                    @for ($i = 1; $i <= 3; $i++)
                                        @php
                                            $value = "XI " . $k->nama_jurusan . " " . $i;
                                        @endphp
                                        <option value="{{ $value }}" @selected(trim(old('kelas')) == trim($value))>{{ $value }}</option>
                                    @endfor
                                    @for ($i = 1; $i <= 3; $i++)
                                        @php
                                            $value = "XII " . $k->nama_jurusan . " " . $i;
                                        @endphp
                                        <option value="{{ $value }}" @selected(trim(old('kelas')) == trim($value))>{{ $value }}</option>
                                    @endfor
                                @endforeach
                            </select>
                            @error('kelas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                      
                   
                       <div class="d-flex justify-content-end">
                            <button class="print-btn text-decoration-none" type="submit">
                                <span class="printer-wrapper">
                                  <span class="printer-container">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 92 75">
                                      <path
                                        stroke-width="5"
                                        stroke="black"
                                        d="M12 37.5H80C85.2467 37.5 89.5 41.7533 89.5 47V69C89.5 70.933 87.933 72.5 86 72.5H6C4.067 72.5 2.5 70.933 2.5 69V47C2.5 41.7533 6.75329 37.5 12 37.5Z"
                                      ></path>
                                      <mask fill="white" id="path-2-inside-1_30_7">
                                        <path
                                          d="M12 12C12 5.37258 17.3726 0 24 0H57C70.2548 0 81 10.7452 81 24V29H12V12Z"
                                        ></path>
                                      </mask>
                                      <path
                                        mask="url(#path-2-inside-1_30_7)"
                                        fill="black"
                                        d="M7 12C7 2.61116 14.6112 -5 24 -5H57C73.0163 -5 86 7.98374 86 24H76C76 13.5066 67.4934 5 57 5H24C20.134 5 17 8.13401 17 12H7ZM81 29H12H81ZM7 29V12C7 2.61116 14.6112 -5 24 -5V5C20.134 5 17 8.13401 17 12V29H7ZM57 -5C73.0163 -5 86 7.98374 86 24V29H76V24C76 13.5066 67.4934 5 57 5V-5Z"
                                      ></path>
                                      <circle fill="black" r="3" cy="49" cx="78"></circle>
                                    </svg>
                                  </span>
                              
                                  <span class="printer-page-wrapper">
                                    <span class="printer-page"></span>
                                  </span>
                                </span>
                                Cetak
                              </button>
                              
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
      $('#kelas').select2();
</script>
    

@endsection