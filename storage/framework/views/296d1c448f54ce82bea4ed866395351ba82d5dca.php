
<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center align-items-center d-flex">
        <div class="col-md-5">
        <div class="card mt-5">
            <div class="card-header text-center">
                <h1>Ganti Password</h1>
            </div>
            <div class="card-body p-5">
                <?php if(session('gagal')): ?>
                <div class="alert alert-danger text-center">
                    <?php echo e(session('gagal')); ?>

                </div>
                <?php endif; ?>
                <form action="" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="form-floating mb-3"  id="f-pass">
                            <input type="password" class="form-control <?php if($errors->has('password')): ?> is-invalid <?php endif; ?> <?php if(session('pass')): ?> is-invalid <?php endif; ?>" name="password" id="password" placeholder="" value="<?php echo e(old('password')); ?>">
                            <label for="password">Password Lama</label>
                            <?php if($errors->has('password')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('password')); ?>

                            </div>
                            <?php endif; ?>
                            <?php if(session('pass')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e(session('pass')); ?>


                            </div>
                            <?php endif; ?>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn-white btn" id="lihatPassword">
                                    <span id="lihatPasswordIcon">👁️</span>
                                </button>
                            </div>
                        </div>

                        <div class="form-floating mb-3" id="f-passBaru">
                            <input type="password" class="form-control <?php if($errors->has('passwordAseli')): ?> is-invalid <?php endif; ?>  " name="passwordAseli" id="passwordAseli" placeholder="" value="<?php echo e(old('passwordAseli')); ?>">
                            <label for="passwordAseli">Password Baru</label>
                            <?php if($errors->has('passwordAseli')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('passwordAseli')); ?>

                            </div>
                            <?php endif; ?>
                            
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn-white btn" id="lihatPasswordAseli">
                                    <span id="lihatPasswordIconAseli">👁️</span>
                                </button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Ubah" class="btn btn-primary">
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function(){

        $('#lihatPassword').click(function(){
            if($('#password').attr('type') == 'password'){
                $('#password').attr('type', 'text');
                $('#lihatPasswordIcon').text("👁️‍🗨️")
            }else{
                $('#password').attr('type','password');
                $('#lihatPasswordIcon').text("👁️")
            }
        });

        $('#lihatPasswordAseli').click(function(){
            if($('#passwordAseli').attr('type') == 'password'){
                $('#passwordAseli').attr('type', 'text');
                $('#lihatPasswordIconAseli').text("👁️‍🗨️")
            }else{
                $('#passwordAseli').attr('type','password');
                $('#lihatPasswordIconAseli').text("👁️")
            }
        })
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\kepsek\gantiPassword.blade.php ENDPATH**/ ?>