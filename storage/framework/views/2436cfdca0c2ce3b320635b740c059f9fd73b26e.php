
<?php $__env->startSection('content'); ?>
<style>
    img{
        box-shadow: 3px 3px 6px 0px rgba(0, 0, 0, 0.3);
    }
</style>
<br><br><br>
<div class="container">
    <div class="text-center">
        <h1>Foto foto kegiatan:</h1>
    </div>
    <div class="row justify-content-center align-items-center mt-5">
        <?php $__currentLoopData = $foto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-3 mx-3">
                <img src="<?php echo e(asset('galeri/' . $f->foto)); ?>" style="width: 300px; height:300px;" class="mt-4" alt="" srcset="">
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\foto.blade.php ENDPATH**/ ?>