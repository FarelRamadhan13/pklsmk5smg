@extends('layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1>Ubah foto</h1>
                </div>
                <div class="card-body p-5">
                    @if(session('gagal'))
                    <div class="alert-danger alert text-center">
                        {{session('gagal')}}
                    </div>
                    @endif
                    <div class="my-4 mb-5">
                        <a href="@if(auth()->user()->hak_akses == '0') /Admin @elseif(auth()->user()->hak_akses == '2') /prakerin @else /kepsek @endif" class="btn-danger btn">Kembali</a>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-4 mb-3">
                            <input type="hidden" value="{{now()}}" name="tanggal">
                            <input type="hidden" id="waktu" name="waktu" class="form-control @if($errors->has('waktu')) is-invalid @endif" value="{{now()->format('H:i:s')}}" readonly>
                            @if($errors->has('waktu'))
                            <div class="invalid-feedback">
                                {{$errors->first('waktu')}}
                            </div>
                            @endif
                        </div>


                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="{{asset('storage/fotoProfileAdmin/' . auth()->user()->foto)}}" style="width: 70px; height:70px;" class="img-preview rounded-circle @if($errors->has('foto')) is-invalid @endif" alt="">
                                </div>
                                <div class="col-md-7">
                                    <label for="foto">Ubah Foto Anda</label>
                                    <input type="file" name="foto" id="foto" class="form-control @if($errors->has('foto')) is-invalid @endif" onchange="previewImg()" accept="image/*">



                                    @if($errors->has('foto'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('foto')}}
                                    </div>
                                    @endif
                                </div>
                            </div>

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
</div>

<script>
    $(document).ready(function() {

    });
</script>
<script>
    function previewImg() {
        var input = document.getElementById('foto');
        var preview = document.querySelector('.img-preview');
        var file = input.files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>

@endsection