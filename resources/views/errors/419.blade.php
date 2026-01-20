<?php $title = 'Kadaluarsa'; ?>
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
    <div class="animation-container">

        <img src="{{ asset('404/kadaluarsa.png') }}" alt="419 Expired">
        <div class="text-center">
            <h1>Halaman telah kadaluarsa, <a href="/">Klik ini</a> dan coba lagi</h1>
        </div>
        
    </div>

   @endsection