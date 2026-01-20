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

        <img src="https://media.tenor.com/GRLNDWbb2FoAAAAi/eula-genshin-impact.gif" alt="505 Error">
        <div class="text-center">
            <h1>Halaman Error! segera hubungi admin!</h1>
        </div>
        
    </div>

   @endsection