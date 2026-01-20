
<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1>Tambah PKL / Industri</h1>
                </div>
                <div class="card-body p-5">
                    <?php if(session('gagal')): ?>
                    <div class="alert-danger alert text-center">
                        <?php echo e(session('gagal')); ?>

                    </div>
                    <?php endif; ?>
                    <div class="my-4">
                        <a href="/pkl" class="btn-danger btn">Kembali</a>

                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control <?php if($errors->has('nama')): ?> is-invalid <?php endif; ?>" name="nama" id="nama" placeholder="" value="<?php echo e(old('nama')); ?>">
                            <label for="nama">Nama PKL</label>
                            <?php if($errors->has('nama')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('nama')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control <?php if($errors->has('alamat')): ?> is-invalid <?php endif; ?>" name="alamat" id="alamat" placeholder="" value="<?php echo e(old('alamat')); ?>">
                            <label for="alamat">Alamat PKL</label>
                            <?php if($errors->has('alamat')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('alamat')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" class="form-control <?php if($errors->has('quota')): ?> is-invalid <?php endif; ?>" name="quota" id="quota" placeholder="" value="<?php echo e(old('quota')); ?>">
                            <label for="quota">quota PKL</label>
                            <?php if($errors->has('quota')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('quota')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" class="form-control <?php if($errors->has('tahun')): ?> is-invalid <?php endif; ?>" name="tahun" id="tahun" placeholder="" value="<?php echo e(date('Y')); ?>" readonly>
                            <label for="tahun">tahun PKL</label>
                            <?php if($errors->has('tahun')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('tahun')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control <?php if($errors->has('telp')): ?> is-invalid <?php endif; ?>" name="telp" id="telp" placeholder="" value="<?php echo e(old('telp')); ?>">
                            <label for="telp">Nomor Telphone PKL</label>
                            <?php if($errors->has('telp')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('telp')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control <?php if($errors->has('nama_pimpinan')): ?> is-invalid <?php endif; ?>" name="nama_pimpinan" id="nama_pimpinan" placeholder="" value="<?php echo e(old('nama_pimpinan')); ?>">
                            <label for="nama_pimpinan">Nama Pimpinan PKL</label>
                            <?php if($errors->has('nama_pimpinan')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('nama_pimpinan')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control <?php if($errors->has('bidang_usaha')): ?> is-invalid <?php endif; ?>" name="bidang_usaha" id="bidang_usaha" placeholder="" value="<?php echo e(old('bidang_usaha')); ?>">
                            <label for="bidang_usaha">Bidang Usaha PKL</label>
                            <?php if($errors->has('bidang_usaha')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('bidang_usaha')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group mb-3 col-md-5">
                            <select name="status" id="status" class="form-select <?php if($errors->has('status')): ?> is-invalid <?php endif; ?>">
                                <option value="" disabled hidden selected>-- pilih status --</option>
                                <option value="0" <?php if(old('status') == '0'){ echo 'selected'; } ?>>non Valid</option>
                                <option value="1" <?php if(old('status') == '1'){ echo 'selected'; } ?>>Valid</option>
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
    })
</script>
<script>
    function previewImg(){
        var input = document.getElementById('foto');
        var preview = document.querySelector('.img-preview');
        var file = input.files[0];
        var reader = new FileReader();

        reader.onloadend = function(){
            preview.src = reader.result;
        }

        if(file){
        reader.readAsDataURL(file);
        }
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\pkl\tambah.blade.php ENDPATH**/ ?>