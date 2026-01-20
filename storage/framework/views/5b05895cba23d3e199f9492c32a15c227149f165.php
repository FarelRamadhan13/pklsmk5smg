<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Data Siswa</title>
    <script src="<?php echo e(asset('aset/jquery-3.7.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('aset/DataTables/dataTables.js')); ?>"></script>
    <script src="<?php echo e(asset('aset/DataTables/dataTables.bootstrap5.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('aset/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('aset/DataTables/DataTablesBootstrap.css')); ?>">
    <script src="<?php echo e(asset('aset/bootstrap.bundle.min.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('aset/select2/select2.css')); ?>">
    <script src="<?php echo e(asset('aset/select2/select2.min.js')); ?>"></script>
    <link rel="shortcut icon" href="<?php echo e(asset('default/AdminLTELogo.png')); ?>" type="image/x-icon">
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
                            <?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($u->nisn); ?></td>
                                    <td class="text-center"><?php echo e($u->nama_siswa); ?></td>
                                    <td class="text-center"><?php echo e($u->alamat); ?></td>
                                    <td class="text-center">***</td>
                                    <td class="text-center"><?php echo e($u->telp); ?></td>
                                    <td class="text-center"><?php echo e($u->kelas); ?></td>
                                    <td class="text-center"><?php echo e($u->tahun); ?></td>
                                    <td class="text-center"><?php echo e($u->nama_jurusan); ?></td>
                                 
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                  
   

<!-- Script untuk mencetak halaman -->
<script type="text/javascript">
    window.print();
</script>

</body>
</html>
<?php /**PATH D:\smk\pklsmk5smg\resources\views\siswa\print.blade.php ENDPATH**/ ?>