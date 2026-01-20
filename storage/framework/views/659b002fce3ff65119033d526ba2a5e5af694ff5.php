
<?php $__env->startSection('content'); ?>

<?php
use Carbon\Carbon;
?>
<div class="container">
    <div class="row justify-content-center align-items-center d-flex">
        <div class="col-md-9">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1>Daftar Prakerin</h1>
                </div>
                <div class="card-body p-5">
                    <?php if(session('berhasil')): ?>
                    <div class="alert-success alert text-center">
                        <?php echo e(session('berhasil')); ?>

                    </div>
                    <?php endif; ?>
                 
                    <div class="table-responsive">
                    <table class="table-striped table-bordered table align-middle" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Id PKL</th>
                                <th class="text-center">Nama PKL</th>
                                <th class="text-center">Alamat PKL</th>
                                <th class="text-center">NIS</th>
                                <th class="text-center">Nama Siswa</th>
                                <th class="text-center">Kelas</th>
                                <th class="text-center">NIP</th>
                                <th class="text-center">Nama Guru</th>
                                <th class="text-center">Start</th>
                                <th class="text-center">End</th>
                                <th class="text-center">Tahun</th>
                              
                            </tr>
                        </thead>
                        <?php
                        $no =1;
                        ?>
                        <tbody>
                            <?php $__currentLoopData = $prakerin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($p->idprakerin); ?></td>
                                    <td class="text-center"><?php echo e($p->idpkl); ?></td>
                                    <td class="text-center"><?php echo e($p->nama_pkl); ?></td>
                                    <td class="text-center"><?php echo e($p->alamat_pkl); ?> </td>
                                    <td class="text-center"><?php echo e($p->nisn); ?></td>
                                    <td class="text-center"><?php echo e($p->nama_siswa); ?></td>
                                    <td class="text-center"><?php echo e($p->kelas); ?></td>
                                    <td class="text-center"><?php echo e($p->nip); ?></td>
                                    <td class="text-center"><?php echo e($p->nama); ?></td>
                                    <?php
                                    $date = Carbon::parse($p->start);
                                    $tanggal = $date->isoFormat('D MMMM YYYY');
                                    ?>
                                    <td class="text-center"><?php echo e($tanggal); ?></td>
                                    <?php
                                    $end = Carbon::parse($p->end);
                                    $akhir = $end->isoFormat('D MMMM YYYY');
                                    ?>
                                    <td class="text-center"><?php echo e($akhir); ?></td>
                                    <td class="text-center"><?php echo e($p->tahun); ?></td>
                                  
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#table').DataTable({
            "order": [[ 0, "desc" ]] 
   

 
        });
      
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\guru_pendampingLogin\prakerin.blade.php ENDPATH**/ ?>