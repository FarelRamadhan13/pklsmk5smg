
@extends('layout.app')
@section('content')
    <style>
        .animation-container {

            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .animation-container img {

            mix-blend-mode: multiply;
            max-width: 100%;
            height: 500px;
        }
    </style>
    <div class="animation-container mt-4">

        <img src="https://upload-os-bbs.hoyolab.com/upload/2021/11/25/102372466/1f59430d6832c8662bc8b79326a2ba44_7017784944865280416.gif" class="mt-auto">
        <div class="text-center">
            <h1><a href="/">Klik ini</a> Untuk menuju ke halaman utama</h1>
        </div>
        
    </div>

   @endsection