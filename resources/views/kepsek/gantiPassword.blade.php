@extends('layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center d-flex">
        <div class="col-md-5">
        <div class="card mt-5">
            <div class="card-header text-center">
                <h1>Ganti Password</h1>
            </div>
            <div class="card-body p-5">
                @if(session('gagal'))
                <div class="alert alert-danger text-center">
                    {{session('gagal')}}
                </div>
                @endif
                <form action="" method="post">
                    @csrf
                    <div class="form-floating mb-3"  id="f-pass">
                            <input type="password" class="form-control @if($errors->has('password')) is-invalid @endif @if(session('pass')) is-invalid @endif" name="password" id="password" placeholder="" value="{{old('password')}}">
                            <label for="password">Password Lama</label>
                            @if($errors->has('password')) 
                            <div class="invalid-feedback">
                                {{$errors->first('password')}}
                            </div>
                            @endif
                            @if(session('pass')) 
                            <div class="invalid-feedback">
                                {{session('pass')}}

                            </div>
                            @endif
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn-white btn" id="lihatPassword">
                                    <span id="lihatPasswordIcon">👁️</span>
                                </button>
                            </div>
                        </div>

                        <div class="form-floating mb-3" id="f-passBaru">
                            <input type="password" class="form-control @if($errors->has('passwordAseli')) is-invalid @endif  " name="passwordAseli" id="passwordAseli" placeholder="" value="{{old('passwordAseli')}}">
                            <label for="passwordAseli">Password Baru</label>
                            @if($errors->has('passwordAseli')) 
                            <div class="invalid-feedback">
                                {{$errors->first('passwordAseli')}}
                            </div>
                            @endif
                            
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn-white btn" id="lihatPasswordAseli">
                                    <span id="lihatPasswordIconAseli">👁️</span>
                                </button>
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
    });
</script>
@endsection