<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Data Siswa</title>
    <script src="{{asset('aset/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('aset/DataTables/dataTables.js')}}"></script>
    <script src="{{asset('aset/DataTables/dataTables.bootstrap5.js')}}"></script>
    <link rel="stylesheet" href="{{asset('aset/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('aset/DataTables/DataTablesBootstrap.css')}}">
    <script src="{{asset('aset/bootstrap.bundle.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('aset/select2/select2.css')}}">
    <script src="{{asset('aset/select2/select2.min.js')}}"></script>
    <link rel="shortcut icon" href="{{asset('default/AdminLTELogo.png')}}" type="image/x-icon">
</head>
<body>

   <div class="text-center mt-5">

       <h1>Daftar Siswa</h1>
   </div>
           
             
                 
                   
                   
                    <table class="table-striped table table-bordered align-middle" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">NIS</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Password</th>
                                <th class="text-center">Telp</th>
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
                                    <td class="text-center">{{$u->alamat}}</td>
                                    <td class="text-center">***</td>
                                    <td class="text-center">{{$u->telp}}</td>
                                    <td class="text-center">{{$u->kelas}}</td>
                                    <td class="text-center">{{$u->tahun}}</td>
                                    <td class="text-center">{{$u->nama_jurusan}}</td>
                                 
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                  
   

<!-- Script untuk mencetak halaman -->
<script type="text/javascript">
    window.print();
</script>

</body>
</html>
