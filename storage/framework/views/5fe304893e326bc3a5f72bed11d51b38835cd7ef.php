
<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center align-items-center d-flex">
        <div class="col-md-5">
        <div class="card mt-5">
            <div class="card-header text-center">
                <h1>Ganti Data</h1>
            </div>
            <div class="card-body p-5">
                <?php if(session('gagal')): ?>
                <script>
            Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: '<?php echo e(session('gagal')); ?>',
                });
            </script>
                <?php endif; ?>
                <form action="" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="form-floating mb-3">
                            <input type="text" class="form-control <?php if($errors->has('name')): ?> is-invalid <?php endif; ?>" name="name" id="name" placeholder="" value="<?php if(old('name')){ echo old('name'); }else{ echo auth()->user()->name; }?>">
                            <label for="name">Nama</label>
                            <?php if($errors->has('name')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('name')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control <?php if($errors->has('username')): ?> is-invalid <?php endif; ?>" name="username" id="username" placeholder="" value="<?php if(old('username')){ echo old('username'); }else{ echo auth()->user()->username; }?>">
                            <?php if(auth()->user()->hak_akses == '2'): ?><label for="username">Username</label> <?php else: ?> <label for="username">NIP</label><?php endif; ?>
                            <?php if($errors->has('username')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('username')); ?>

                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group mb-3 col-md-5">
                            <label for="ubahPass">Ubah Password</label>
                            <select name="ubahPass" id="ubahPass" class="form-select">
                                <option value="0" <?php if(old('ubahPass') == '0'){ echo 'selected'; } ?>>Tidak</option>
                                <option value="1" <?php if(old('ubahPass') == '1'){ echo 'selected'; } ?>>Iya</option>
                            </select>
                        </div>
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
                                <button type="button" class="btn-white btn position-absolute top-0 end-0 mt-2 me-2" id="lihatPassword">
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
                                <button type="button" class="btn-white btn position-absolute top-0 end-0 mt-2 me-2" id="lihatPasswordAseli">
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

        $('#f-pass').hide();
        $('#f-passBaru').hide();

        if($('#ubahPass').val() == '0'){
            $('#f-pass').hide();
            $('#f-passBaru').hide();
            }else if($('#ubahPass').val() == '1'){
            $('#f-pass').show();
            $('#f-passBaru').show();
            }

            $('#ubahPass').change(function(){
                if($('#ubahPass').val() == '0'){
            $('#f-pass').hide();
            $('#f-passBaru').hide();
            }else if($('#ubahPass').val() == '1'){
            $('#f-pass').show();
            $('#f-passBaru').show();
            }
            })
            

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
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\prakerin\gantiPassword.blade.php ENDPATH**/ ?>