@extends('layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1>Tambah PKL</h1>
                </div>
                <div class="card-body p-5">
                    @if(session('gagal'))
                    <div class="alert-danger alert text-center">
                        {{session('gagal')}}
                    </div>
                    @endif
                    <div class="my-4">
                        <a href="/Admin/PKL" class="btn-danger btn">Kembali</a>

                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @if($errors->has('nama')) is-invalid @endif" name="nama" id="nama" placeholder="" value="{{old('nama')}}">
                            <label for="nama">Nama Jurusan</label>
                            @if($errors->has('nama')) 
                            <div class="invalid-feedback">
                                {{$errors->first('nama')}}
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
        $('#lihatPassword').click(function(){
            if($('#password').attr('type') == 'password'){
                $('#password').attr('type', 'text');
                $('#lihatPasswordIcon').text("👁️‍🗨️")
            }else{
                $('#password').attr('type','password');
                $('#lihatPasswordIcon').text("👁️")
            }
        });

        $('#lihatPasswordAseli').click(function(){
            if($('#passwordAseli').attr('type') == 'password'){
                $('#passwordAseli').attr('type', 'text');
                $('#lihatPasswordIconAseli').text("👁️‍🗨️")
            }else{
                $('#passwordAseli').attr('type','password');
                $('#lihatPasswordIconAseli').text("👁️")
            }
        })
    })
</script>
<script>
    function previewImg(){
        var input = document.getElementById('foto');
        var preview = document.querySelector('.img-preview');
        var file = input.files[0];
        var reader = new FileReader();

        reader.onloadend = function(){
            preview.src = reader.result;
        }

        if(file){
        reader.readAsDataURL(file);
        }
    }
</script>
@endsection