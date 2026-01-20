
<?php $__env->startSection('content'); ?>
<?php
use Carbon\Carbon;
?>

<div class="container">
    <div class="row justify-content-center align-items-center d-flex">
        <div class="col-md-9">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1>Daftar Pesan</h1>
                </div>
                <div class="card-body p-5">
                    <?php if(session('berhasil')): ?>
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        <?php echo e(session('berhasil')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif; ?>
                  
                    <div class="table-responsive">
                    <table class="table-striped table table-bordered align-middle" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">Nomor</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Pesan</th>
                                <th class="text-center">Pada</th>
                              
                            </tr>
                        </thead>
                        <?php
                        $no =1;
                        ?>
                        <tbody>
                            <?php $__currentLoopData = $pesan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <tr
    <?php if($u->created_at->isToday()): ?>
        style="background-color: #d4edda; color: #155724;" 
    <?php elseif($u->created_at->isCurrentWeek()): ?>
        style="background-color: #d1ecf1; color: #0c5460;" 
    <?php endif; ?>
>
    <td class="text-center"><?php echo e($no++); ?></td>
    <td class="text-center"><?php echo e($u->nama); ?></td>
    <td class="text-center"><?php echo e($u->pesan); ?></td>

    <?php
    $date = Carbon::parse($u->created_at);
    $tanggal = $date->isoFormat('dddd, D MMMM');
    ?>
    <td class="text-center"><?php echo e($tanggal); ?></td>
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
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\pesan\index.blade.php ENDPATH**/ ?>