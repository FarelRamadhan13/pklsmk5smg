@extends('layout.app')
@section('content')
<style>
  .card {
    display: flex;
    flex-direction: column;
}

.card-body {
    flex-grow: 1;
}

.table-responsive {
    overflow-y: auto;
}

    .carousel-item img {
    height: 100%; /* Set tinggi menjadi 100% */
    width: 100%; /* Set lebar menjadi 100% */
    object-fit: contain; /* Mengatur agar gambar tidak terpotong, tetapi tetap menjaga proporsi */
}



</style>

@if($carousel->action == '1')
@if($fotoPertama != null && $foto != null)
<div class="carousel slide" data-bs-ride="carousel" id="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{asset('galeri/' . $fotoPertama->foto)}}" alt="" class="d-block w-100">
        </div>
        @foreach($foto as $f)
        <div class="carousel-item">
            <img src="{{asset('galeri/' . $f->foto)}}" alt="" class="d-block w-100">
        </div>
        @endforeach
    </div>
    <button type="button" class="carousel-control-prev" data-bs-target="#carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button type="button" class="carousel-control-next" data-bs-target="#carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<hr>
@endif
@endif
<div class="container mt-5">
@if(session('logout'))
<script>
        function successfullogout() {
           

            Swal.fire({
                icon: 'success',
                title: 'Berhasil Logout',
               
            });
        }

        
        successfullogout();
    </script>
@endif
<div class="text-center mb-5">
    <a onclick="aboutPKL()" style="cursor: pointer; font-size: 3vh;" href="#">PKL?</a><br>
    <a onclick="keuntungan()" style="cursor: pointer; font-size: 3vh;" href="#">Keuntungan PKL?</a><br>
    <a onclick="harus()" style="cursor: pointer; font-size: 3vh;" href="#">Mengapa harus PKL?</a>
</div>
<br><br>
<!-- <div class="row">
    <div class="col-md-6">
        <div class="card" data-aos="fade-right" data-aos-duration="1000">
        <div class="card-header text-center">
            <h1>Siswa yang terdaftar</h1>
        </div>
        <div class="card-body p-5">
        <div class="table-responsive">
                    <table class="table-striped table table-bordered align-middle" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">NIS</th>
                                <th class="text-center">Nama</th>
                               
                                <th class="text-center">Kelas</th>
                                <th class="text-center">Tahun</th>
                                <th class="text-center">Jurusan</th>
                              
                            </tr>
                        </thead>
                        <?php
                        $no =1;
                        ?>
                        <tbody>
                            @foreach($siswa as $u)
                                <tr>
                                    <td class="text-center">{{$u->nisn}}</td>
                                    <td class="text-center">{{$u->nama_siswa}}</td>
                                   
                                    <td class="text-center">{{$u->kelas}}</td>
                                    <td class="text-center">{{$u->tahun}}</td>
                                    <td class="text-center">{{$u->nama_jurusan}}</td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    <p>Belum terdaftar nama kamu? coba <a onclick="showContactForm()" href="#">Hubungi kami</a></p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
      
        <div class="mt-5" style="font-size: 3vh;" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="500">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur architecto reprehenderit nulla eligendi inventore dolor pariatur dolorem, temporibus vel voluptates quam facilis recusandae beatae consequuntur cum animi hic quisquam perspiciatis nam provident fugiat. Sequi maiores repellat ducimus blanditiis necessitatibus repudiandae laudantium illum, unde consequatur, culpa esse nostrum consectetur cum vitae ullam officia fugiat aliquid eum atque mollitia voluptatum, minima minus. Id repellendus est voluptate commodi? Expedita, possimus. Numquam, quod. Voluptatum harum sit aut soluta! Voluptate cupiditate at qui deleniti ex natus modi quod quidem illo fuga ipsam iure quos sapiente culpa, ratione deserunt cumque consequuntur totam nostrum odio ab eius eum. Nobis beatae ducimus quae! Eligendi maxime delectus excepturi obcaecati necessitatibus quia officiis repudiandae hic quas, asperiores mollitia saepe, a odit facere incidunt cum suscipit, consequatur numquam est nesciunt architecto animi laborum!.</p>

        </div>

    </div>
              
</div>
<br>
<hr>
<br><br><br><br>
<div class="row mt-5">
<div class="col-md-6">
        <div class="text-center">
            <h1></h1>
        </div>
       
        <div class="mt-5" style="font-size: 3vh;" data-aos="fade-left" data-aos-duration="1000" >
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis cum rerum, totam vero deserunt adipisci. Dolorem, impedit ad nisi officiis dolorum tenetur architecto, aliquid nihil doloremque voluptatibus placeat quasi, rerum at voluptas earum. Modi obcaecati quasi quod nesciunt nisi dignissimos sunt alias soluta culpa iste maiores quibusdam animi eveniet mollitia beatae, at porro odio accusantium ut error illo unde libero maxime? Cumque aliquam, obcaecati dicta debitis magnam fuga explicabo quis recusandae quae quod corporis. Quos temporibus aliquid pariatur debitis officiis quod voluptate perspiciatis odit unde esse corrupti, exercitationem ab non porro earum vel voluptas asperiores, possimus velit. Quia, beatae provident.</p>
         
        </div>

    </div>
    <div class="col-md-6">
                        <div class="card" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="500">
                            <div class="card-header text-center">
                                <h1>Jurusan yang tersedia</h1>
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                        <table class="table-striped table align-middle table-bordered" id="tableJ">
                            <thead>
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th class="text-center">Nama Jurusan</th>
                                    <th class="text-center">Jumlah Siswa</th>
                                </tr>
                            </thead>
                            <?php
                            $no =1;
                            ?>
                            <tbody>
                                @foreach($jurusan as $u)
                                    <tr>
                                        <td class="text-center">{{$u->id_jurusan}}</td>
                                        <td class="text-center">{{$u->nama_jurusan}}</td>
                                     
                                        <td class="text-center"> {{$u->siswa_count}} Siswa</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                            </div>
                        </div>
                        </div>      -->
                        <div class="col-md-6">
                            <h3>Siswa yang sudah terdaftar</h3>
                        <div class="table-responsive">
                    <table class="table-striped table table-bordered align-middle" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">NIS</th>
                                <th class="text-center">Nama</th>
                               
                                <th class="text-center">Kelas</th>
                                <th class="text-center">Tahun</th>
                                <th class="text-center">Jurusan</th>
                              
                            </tr>
                        </thead>
                        <?php
                        $no =1;
                        ?>
                        <tbody>
                            @foreach($siswa as $u)
                                <tr>
                                    <td class="text-center">{{$u->nisn}}</td>
                                    <td class="text-center">{{$u->nama_siswa}}</td>
                                   
                                    <td class="text-center">{{$u->kelas}}</td>
                                    <td class="text-center">{{$u->tahun}}</td>
                                    <td class="text-center">{{$u->nama_jurusan}}</td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    <p>Belum terdaftar nama kamu? coba <a onclick="showContactForm()" href="#">Hubungi kami</a></p>
    </div>

</div>
</div>
</div>
<script>
    $(document).ready(function(){
        $('#table').DataTable({
            "pageLength": 4,
            "lengthChange": false
        });

        $('#tableJ').DataTable({
            "lengthChange": false
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    if (!localStorage.getItem("visited")) {
        Swal.fire({
            title: 'Selamat Datang!',
            text: 'Terima kasih telah mengunjungi dan mempercayai situs web PKL SMK Negeri 5 Semarang. Jika Anda memiliki saran, silakan hubungi kami.',
            icon: 'info',
            confirmButtonText: 'OK'
        });

        localStorage.setItem("visited", "true");
    }
});

</script>





@endsection