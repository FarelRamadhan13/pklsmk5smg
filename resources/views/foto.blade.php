@extends('layout.app')
@section('content')
<style>
    img{
        box-shadow: 3px 3px 6px 0px rgba(0, 0, 0, 0.3);
    }
</style>
<br><br><br>
<div class="container">
    <div class="text-center">
        <h1>Foto foto kegiatan:</h1>
    </div>
    <div class="row justify-content-center align-items-center mt-5">
        @foreach($foto as $f)
            <div class="col-md-3 mx-3">
                <img src="{{asset('galeri/' . $f->foto)}}" style="width: 300px; height:300px;" class="mt-4" alt="" srcset="">
            </div>
        @endforeach
    </div>
</div>

@endsection