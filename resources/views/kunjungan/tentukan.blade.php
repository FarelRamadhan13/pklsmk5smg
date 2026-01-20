@extends('layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1>Tentukan Data Kunjungan</h1>
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
                        
                        <div class="form-group mb-3 col-md-8">
                            <label for="awal">Dari Tanggal</label>
                            <input type="date" name="awal" id="awal" class="form-control @if($errors->has('awal')) is-invalid @endif" value="{{old('awal')}}">
                            @if($errors->has('awal'))
                            <div class="invalid-feedback">
                                {{$errors->first('awal')}}
                            </div>
                            @endif
                        </div>

                        <div class="form-group mb-3 col-md-8">
                            <label for="akhir">Sampai Tanggal</label>
                            <input type="date" name="akhir" id="akhir" class="form-control @if($errors->has('akhir')) is-invalid @endif"value="{{old('akhir')}}">
                            @if($errors->has('akhir'))
                            <div class="invalid-feedback">
                                {{$errors->first('akhir')}}
                            </div>
                            @endif
                        </div>
                      
                   
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Lihat PDF" class="btn btn-outline-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    

@endsection