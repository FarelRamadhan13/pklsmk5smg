<?php $title = 'Kadaluarsa'; ?>

<?php $__env->startSection('content'); ?>
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

        <img src="<?php echo e(asset('404/kadaluarsa.png')); ?>" alt="419 Expired">
        <div class="text-center">
            <h1>Halaman telah kadaluarsa, <a href="/">Klik ini</a> dan coba lagi</h1>
        </div>
        
    </div>

   <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\errors\419.blade.php ENDPATH**/ ?>