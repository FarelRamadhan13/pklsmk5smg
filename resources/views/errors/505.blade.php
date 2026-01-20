<?php $title = 'Error 505'; ?>
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
            display: block;
            max-width: 100%;
            height: auto;
          
         
        }
    </style>
    <div class="animation-container mt-5">

        <img src="https://media.tenor.com/ys2Y4eGuCP8AAAAi/genshin-impact-emote.gif" alt="505 Error">
        <div class="text-center">
            <h1>Halaman ini Error! tolong <a href="#" id="copyLink">Salin ini</a> dan segera hubungi admin!</h1>
        </div>
        
    </div>
<script>
    
    function copyToClipboard(text) {
        const tempInput = document.createElement('input');
        tempInput.style.position = 'absolute';
        tempInput.style.left = '-9999px';
        tempInput.value = text;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
       Swal.fire({
            text: 'Berhasil disalin, tolong kirim "' + text + '" yang sudah kamu salin ke admin beserta dengan screenshotnya!',
            imageUrl: "{{ asset('storage/default/ok.png') }}", // Ganti dengan URL gambar yang sesuai
            imageWidth: 300,
            imageHeight: 300,
            confirmButtonText: 'Oke'
        });
    }

   
    document.getElementById('copyLink').addEventListener('click', function(event) {
        event.preventDefault();
        const currentUrl = window.location.href;
        copyToClipboard(currentUrl);
    });
</script>

   @endsection