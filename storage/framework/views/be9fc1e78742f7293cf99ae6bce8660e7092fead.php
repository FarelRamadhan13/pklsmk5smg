
<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1>Tambah Guru pendamping</h1>
                </div>
                <div class="card-body p-5">
                    <?php if(session('gagal')): ?>
                    <div class="alert-danger alert text-center">
                        <?php echo e(session('gagal')); ?>

                    </div>
                    <?php endif; ?>
                    <div class="my-4">
                        <a href="/Admin/guru_pendamping" class="btn-danger btn">Kembali</a>

                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                       
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control <?php if($errors->has('nip')): ?> is-invalid <?php endif; ?>" name="nip" id="nip" placeholder="" value="<?php echo e(old('nip')); ?>">
                            <label for="nip">NIP</label>
                            <?php if($errors->has('nip')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('nip')); ?>

                            </div>
                            <?php endif; ?>
                        </div>
                     
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control <?php if($errors->has('nama')): ?> is-invalid <?php endif; ?>" name="nama" id="nama" placeholder="" value="<?php echo e(old('nama')); ?>">
                            <label for="nama">Nama</label>
                            <?php if($errors->has('nama')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('nama')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-floating mb-3">
                        <textarea class="form-control <?php if($errors->has('alamat')): ?> is-invalid <?php endif; ?>" name="alamat" id="alamat" placeholder=""><?php echo e(old('alamat')); ?></textarea>

                            <label for="alamat">Alamat</label>
                            <?php if($errors->has('alamat')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('alamat')); ?>

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

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control <?php if($errors->has('telp')): ?> is-invalid <?php endif; ?>" name="telp" id="telp" placeholder="" value="<?php echo e(old('telp')); ?>">
                            <label for="telp">Telephone</label>
                            <?php if($errors->has('telp')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('telp')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                       

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control <?php if($errors->has('tahun')): ?> is-invalid <?php endif; ?>" name="tahun" id="tahun" placeholder="" value="<?php echo e(date('Y')); ?>" readonly>
                            <label for="tahun">tahun</label>
                            <?php if($errors->has('tahun')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('tahun')); ?>

                            </div>
                            <?php endif; ?>
                        </div>
                     

                        <div class="form-group mb-3 col-md-5">
                            <label for="jurusan">Jurusan</label>
                            <select name="jurusan" id="jurusan" class="form-select   <?php if($errors->has('jurusan')): ?> is-invalid <?php endif; ?>">
                                <option value="" disabled hidden selected>-- pilih Jurusan --</option>
                                <?php $__currentLoopData = $jurusan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($j->id_jurusan); ?>" <?php if(old('jurusan') == $j->id_jurusan){ echo 'selected'; } ?>><?php echo e($j->nama_jurusan); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('jurusan')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('jurusan')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group mb-3 col-md-5">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-select   <?php if($errors->has('status')): ?> is-invalid <?php endif; ?>">
                                <option value="" disabled hidden selected>-- pilih status --</option>
                                <option value="0" <?php if(old('status') == '0'){ echo 'selected'; } ?>>Aktif</option>
                                <option value="1" <?php if(old('status') == '1'){ echo 'selected'; } ?>>Non Aktif</option>
                               
                            </select>
                            <?php if($errors->has('status')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('status')); ?>

                            </div>
                            <?php endif; ?>
                        </div>


                        <div class="form-floating mb-3">
                            <input type="text" class="form-control <?php if($errors->has('pangkat')): ?> is-invalid <?php endif; ?>" name="pangkat" id="pangkat" placeholder="" value="<?php echo e(old('pangkat')); ?>">
                            <label for="pangkat">Pangkat</label>
                            <?php if($errors->has('pangkat')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('pangkat')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control <?php if($errors->has('jabatan')): ?> is-invalid <?php endif; ?>" name="jabatan" id="jabatan" placeholder="" value="<?php echo e(old('jabatan')); ?>">
                            <label for="jabatan">Jabatan</label>
                            <?php if($errors->has('jabatan')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('jabatan')); ?>

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
  
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\guru_pendamping\tambah.blade.php ENDPATH**/ ?>