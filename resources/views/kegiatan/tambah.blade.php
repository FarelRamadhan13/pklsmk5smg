@extends('layout.app')
@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center py-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="mb-0">Tambah kegiatan harian</h1>
                    </div>
                </div>
                <div class="card-body p-5">
                    @if(session('gagal'))
                    <div class="alert-danger alert text-center">
                        {{session('gagal')}}
                    </div>
                    @endif
                    <div class="mb-5">
                        <style>
                            .kembali {
                             display: flex;
                             height: 3em;
                             width: 100px;
                             align-items: center;
                             justify-content: center;
                             background-color: #eeeeee4b;
                             border-radius: 3px;
                             letter-spacing: 1px;
                             transition: all 0.2s linear;
                             cursor: pointer;
                             border: none;
                             background: #fff;
                             color: black
                            }
                            
                            .kembali > svg {
                             margin-right: 5px;
                             margin-left: 5px;
                             font-size: 20px;
                             transition: all 0.4s ease-in;
                            }
                            
                            .kembali:hover > svg {
                             font-size: 1.2em;
                             transform: translateX(-5px);
                            }
                            
                            .kembali:hover {
                             box-shadow: 9px 9px 33px #d1d1d1, -9px -9px 33px #ffffff;
                             transform: translateY(-2px);
                            }
                            
                            </style>
                            
                              <a class="kembali text-decoration-none" href="/Siswa/JurnalPKL/harian/{{$id}}">
                                                        <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024"><path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path></svg>
                                                        <span>Kembali</span>
                                                    </a>
                        
                    </div>
                    <form action="" method="post" enctype="multipart/form-data" id="Form">
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
                                <div class="col-md-4">
                                    <a href="{{asset('storage/kegiatan/camera.gif')}}" class="fancybox" data-fancybox="gallery" id="imageLink">
                                        <img src="{{asset('storage/kegiatan/camera.gif')}}" style="width: 150px; height:150px;" class="img-preview @if($errors->has('foto')) is-invalid @endif" alt="" id="imagePreview">
                                    </a>
                                    <script>
                                      function _0x5007(_0x3a78dc,_0x51c8f9){const _0x22189e=_0x2218();return _0x5007=function(_0x50072e,_0x12f094){_0x50072e=_0x50072e-0x1dc;let _0x43ce85=_0x22189e[_0x50072e];return _0x43ce85;},_0x5007(_0x3a78dc,_0x51c8f9);}const _0x41e83f=_0x5007;function _0x2218(){const _0x4c1bcd=['1612dXzVux','addEventListener','imagePreview','8NkJOBL','2079999kKbPnF','117532gkQSud','getElementById','5109811dsgruG','random','702gvobUD','src','112429vTVkpt','imageLink','845670UwIgde','40MxGlsj','10788830WHOGCu'];_0x2218=function(){return _0x4c1bcd;};return _0x2218();}(function(_0x4233cc,_0x36a55){const _0x4b58df=_0x5007,_0x40e027=_0x4233cc();while(!![]){try{const _0x3e91a4=parseInt(_0x4b58df(0x1df))/0x1+-parseInt(_0x4b58df(0x1e4))/0x2*(-parseInt(_0x4b58df(0x1dd))/0x3)+-parseInt(_0x4b58df(0x1e9))/0x4*(-parseInt(_0x4b58df(0x1e2))/0x5)+parseInt(_0x4b58df(0x1e1))/0x6+-parseInt(_0x4b58df(0x1eb))/0x7*(-parseInt(_0x4b58df(0x1e7))/0x8)+parseInt(_0x4b58df(0x1e8))/0x9+-parseInt(_0x4b58df(0x1e3))/0xa;if(_0x3e91a4===_0x36a55)break;else _0x40e027['push'](_0x40e027['shift']());}catch(_0x2e8efa){_0x40e027['push'](_0x40e027['shift']());}}}(_0x2218,0x8888b),document[_0x41e83f(0x1e5)]('DOMContentLoaded',function(){const _0x2cf50e=_0x41e83f,_0x42d2a0='https://magang.smkn3kendal.sch.id/storage/kegiatan/camera.gif',_0x530374='https://magang.smkn3kendal.sch.id/storage/kegiatan/Random.jpeg',_0x586006=Math[_0x2cf50e(0x1dc)](),_0x463f9a=_0x586006<=0.9?_0x42d2a0:_0x530374;document[_0x2cf50e(0x1ea)](_0x2cf50e(0x1e0))['href']=_0x463f9a,document['getElementById'](_0x2cf50e(0x1e6))[_0x2cf50e(0x1de)]=_0x463f9a;}));
                                    </script>
                                </div>
                                <div class="col-md-7 mt-4">
                                    <label for="foto">Inputkan Foto Kegiatan (klik foto untuk memperbesar foto)</label>
                                    <input type="file" name="foto" id="foto" class="form-control @if($errors->has('foto')) is-invalid @endif" onchange="previewImg()" accept="image/*">
                                    @if($errors->has('foto'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('foto')}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-floating my-3">
                            <input type="text" class="form-control @if($errors->has('uraian')) is-invalid @endif" name="uraian" id="uraian" placeholder="" value="{{old('uraian')}}">
                            <label for="uraian">Uraian Kegiatan</label>
                            @if($errors->has('uraian'))
                            <div class="invalid-feedback">
                                {{$errors->first('uraian')}}
                            </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-end">
                            <style>
                                .button {
             --main-focus: #2d8cf0;
             --font-color: #323232;
             --bg-color-sub: #dedede;
             --bg-color: #eee;
             --main-color: #323232;
             position: relative;
             width: 200px;
             height: 40px;
             cursor: pointer;
             display: flex;
             align-items: center;
             border: 2px solid var(--main-color);
             box-shadow: 4px 4px var(--main-color);
             background-color: var(--bg-color);
             border-radius: 10px;
             overflow: hidden;
           }
           
           .button, .button__icon, .button__text {
             transition: all 0.3s;
           }
           
           .button .button__text {
             transform: translateX(22px);
             color: var(--font-color);
             font-weight: 600;
           }
           
           .button .button__icon {
             position: absolute;
             transform: translateX(149px);
             height: 100%;
             width: 49px;
             background-color: var(--bg-color-sub);
             display: flex;
             align-items: center;
             justify-content: center;
           }
           
           .button .svg {
             width: 70px;
             fill: var(--main-color);
             color: black;
           }
           
           .button:hover {
             background: var(--bg-color);
           }
           
           .button:hover .button__text {
             color: transparent;
           }
           
           .button:hover .button__icon {
             width: 198px;
             transform: translateX(0);
           }
           
           .button:active {
             transform: translate(3px, 3px);
             box-shadow: 0px 0px var(--main-color);
           }
                                       </style>
           
           <button class="button text-decoration-none mt-5" type="submit">
               <span class="button__text">Tambah kegiatan</span>
               <span class="button__icon"><svg class="svg" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><line x1="12" x2="12" y1="5" y2="19"></line><line x1="5" x2="19" y1="12" y2="12"></line></svg></span>
           </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('aset/js/SubmitKegiatan.js') }}">
  
</script>

<script>
    function previewImg() {
        var input = document.getElementById('foto');
        var preview = document.querySelector('.img-preview');
        var fancyboxLink = document.querySelector('.fancybox');
        var file = input.files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
            fancyboxLink.href = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>

<script>
    document.addEventListener('contextmenu', function(event) {
        event.preventDefault();
    });

    document.addEventListener('keydown', function(event) {
        if (event.keyCode == 123 || 
            (event.ctrlKey && event.shiftKey && (event.keyCode == 73 || event.keyCode == 74)) ||
            (event.ctrlKey && event.keyCode == 85)) {
            event.preventDefault();
        }
    });
</script>

@endsection
