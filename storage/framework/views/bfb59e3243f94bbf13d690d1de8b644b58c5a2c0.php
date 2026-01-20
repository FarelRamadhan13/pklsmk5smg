
<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1>Ubah foto</h1>
                </div>
                <div class="card-body p-5">
                    <?php if(session('gagal')): ?>
                    <div class="alert-danger alert text-center">
                        <?php echo e(session('gagal')); ?>

                    </div>
                    <?php endif; ?>
                    <div class="my-4 mb-5">
                        <a href="<?php if(auth()->user()->hak_akses == '0'): ?> /Admin <?php elseif(auth()->user()->hak_akses == '2'): ?> /prakerin <?php else: ?> /kepsek <?php endif; ?>" class="btn-danger btn">Kembali</a>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="col-md-4 mb-3">
                            <input type="hidden" value="<?php echo e(now()); ?>" name="tanggal">
                            <input type="hidden" id="waktu" name="waktu" class="form-control <?php if($errors->has('waktu')): ?> is-invalid <?php endif; ?>" value="<?php echo e(now()->format('H:i:s')); ?>" readonly>
                            <?php if($errors->has('waktu')): ?>
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('waktu')); ?>

                            </div>
                            <?php endif; ?>
                        </div>


                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="<?php echo e(asset('storage/fotoProfileAdmin/' . auth()->user()->foto)); ?>" style="width: 70px; height:70px;" class="img-preview rounded-circle <?php if($errors->has('foto')): ?> is-invalid <?php endif; ?>" alt="">
                                </div>
                                <div class="col-md-7">
                                    <label for="foto">Ubah Foto Anda</label>
                                    <input type="file" name="foto" id="foto" class="form-control <?php if($errors->has('foto')): ?> is-invalid <?php endif; ?>" onchange="previewImg()" accept="image/*">



                                    <?php if($errors->has('foto')): ?>
                                    <div class="invalid-feedback">
                                        <?php echo e($errors->first('foto')); ?>

                                    </div>
                                    <?php endif; ?>
                                </div>
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
</div>

<script>
    $(document).ready(function() {

    });
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
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\prakerin\ubahFoto.blade.php ENDPATH**/ ?>