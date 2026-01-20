
<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1>Tentukan Data Kunjungan</h1>
                </div>
                <div class="card-body p-5">
                    <?php if(session('error')): ?>
                    <div class="alert-danger alert text-center">
                        <?php echo e(session('error')); ?>

                    </div>
                    <?php endif; ?>

                    
                    <div class="my-4">
                        <a href="" onclick="window.close()" class="btn-danger btn">Kembali</a>

                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        
                        <div class="form-group mb-3 col-md-8">
                            <label for="awal">Dari Tanggal</label>
                            <input type="date" name="awal" id="awal" class="form-control <?php if($errors->has('awal')): ?> is-invalid <?php endif; ?>" value="<?php echo e(old('awal')); ?>">
                            <?php if($errors->has('awal')): ?>
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('awal')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group mb-3 col-md-8">
                            <label for="akhir">Sampai Tanggal</label>
                            <input type="date" name="akhir" id="akhir" class="form-control <?php if($errors->has('akhir')): ?> is-invalid <?php endif; ?>"value="<?php echo e(old('akhir')); ?>">
                            <?php if($errors->has('akhir')): ?>
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('akhir')); ?>

                            </div>
                            <?php endif; ?>
                        </div>
                      
                   
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Lihat PDF" class="btn btn-outline-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\kunjungan\tentukan.blade.php ENDPATH**/ ?>