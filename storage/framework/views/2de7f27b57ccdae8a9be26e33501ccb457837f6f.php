
<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1>Tambah Users Admin</h1>
                </div>
                <div class="card-body p-5">
                    <?php if(session('gagal')): ?>
                    <div class="alert-danger alert text-center">
                        <?php echo e(session('gagal')); ?>

                    </div>
                    <?php endif; ?>
                    <div class="my-4">
                        <a href="/Admin/Users" class="btn-danger btn">Kembali</a>

                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control <?php if($errors->has('name')): ?> is-invalid <?php endif; ?>" name="name" id="name" placeholder="" value="<?php echo e(old('name')); ?>">
                            <label for="name">Nama</label>
                            <?php if($errors->has('name')): ?>
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('name')); ?>

                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control <?php if($errors->has('username')): ?> is-invalid <?php endif; ?>" name="username" id="username" placeholder="" value="<?php echo e(old('username')); ?>">
                            <label for="username">Username</label>
                            <?php if($errors->has('username')): ?>
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('username')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control <?php if($errors->has('password')): ?> is-invalid <?php endif; ?> <?php if(session('pass')): ?> is-invalid <?php endif; ?>" name="password" id="password" placeholder="" value="<?php echo e(old('password')); ?>">
                            <label for="password">Password</label>
                            <?php if($errors->has('password')): ?>
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('password')); ?>

                            </div>
                            <?php endif; ?>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn-white btn position-absolute top-0 end-0 mt-2 me-2" id="lihatPassword">
                                    <span id="lihatPasswordIcon">👁️</span>
                                </button>
                            </div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control <?php if($errors->has('passwordAseli')): ?> is-invalid <?php endif; ?>  <?php if(session('pass')): ?> is-invalid <?php endif; ?>" name="passwordAseli" id="passwordAseli" placeholder="" value="<?php echo e(old('passwordAseli')); ?>">
                            <label for="passwordAseli">verifikasi Password</label>
                            <?php if($errors->has('passwordAseli')): ?>
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('passwordAseli')); ?>

                            </div>
                            <?php endif; ?>
                            <?php if(session('pass')): ?>
                            <div class="invalid-feedback">
                                <?php echo e(session('pass')); ?>


                            </div>
                            <?php endif; ?>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn-white btn position-absolute top-0 end-0 mt-2 me-2" id="lihatPasswordAseli">
                                    <span id="lihatPasswordIconAseli">👁️</span>
                                </button>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="<?php echo e(asset('storage/fotoProfileAdmin/default.png')); ?>" style="width: 70px; height:70px;" class="rounded-circle img-preview  <?php if($errors->has('foto')): ?> is-invalid <?php endif; ?>" alt="">
                                </div>
                                <div class="col-md-7">
                                    <label for="foto">Foto</label>
                                    <input type="file" name="foto" id="foto" class="form-control <?php if($errors->has('foto')): ?> is-invalid <?php endif; ?>" onchange="previewImg()">
                                    <?php if($errors->has('foto')): ?>
                                    <div class="invalid-feedback">
                                        <?php echo e($errors->first('foto')); ?>

                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3 col-md-5">
                            <select name="hak_akses" id="hak_akses" class="form-select <?php if($errors->has('hak_akses')): ?> is-invalid <?php endif; ?>">
                                <option value="" disabled hidden selected>-- pilih hak akses --</option>
                                <option value="1" <?php if (old('hak_akses') == '1') {
                                                        echo 'selected';
                                                    } ?>>Kepala sekolah</option>
                                <option value="2" <?php if (old('hak_akses') == '2') {
                                                        echo 'selected';
                                                    } ?>>K3</option>
                                <option value="0" <?php if (old('hak_akses') == '0') {
                                                        echo 'selected';
                                                    } ?>>admin</option>
                            </select>
                            <?php if($errors->has('hak_akses')): ?>
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('hak_akses')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group mb-3 col-md-5">
                            <select name="status" id="status" class="form-select <?php if($errors->has('status')): ?> is-invalid <?php endif; ?>">
                                <option value="" disabled hidden selected>-- pilih status --</option>
                                <option value="0" <?php if (old('status') == '0') {
                                                        echo 'selected';
                                                    } ?>>Aktif</option>
                                <option value="1" <?php if (old('status') == '1') {
                                                        echo 'selected';
                                                    } ?>>Non Aktif</option>
                            </select>
                            <?php if($errors->has('status')): ?>
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('status')); ?>

                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Tambah" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#lihatPassword').click(function() {
            if ($('#password').attr('type') == 'password') {
                $('#password').attr('type', 'text');
                $('#lihatPasswordIcon').text("👁️‍🗨️")
            } else {
                $('#password').attr('type', 'password');
                $('#lihatPasswordIcon').text("👁️")
            }
        });

        $('#lihatPasswordAseli').click(function() {
            if ($('#passwordAseli').attr('type') == 'password') {
                $('#passwordAseli').attr('type', 'text');
                $('#lihatPasswordIconAseli').text("👁️‍🗨️")
            } else {
                $('#passwordAseli').attr('type', 'password');
                $('#lihatPasswordIconAseli').text("👁️")
            }
        })
    })
</script>
<script>
    function previewImg() {
        var input = document.getElementById('foto');
        var preview = document.querySelector('.img-preview');
        var file = input.files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\users\tambah.blade.php ENDPATH**/ ?>