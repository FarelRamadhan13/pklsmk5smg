<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1>Tambah Data Siswa</h1>
                </div>
                <div class="card-body p-5">
                    <?php if(session('gagal')): ?>
                    <div class="alert-danger alert text-center">
                        <?php echo e(session('gagal')); ?>

                    </div>
                    <?php endif; ?>
                    <div class="my-4">
                        <a href="/Admin/Siswa" class="btn-danger btn">Kembali</a>

                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                       
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control <?php if($errors->has('nisn')): ?> is-invalid <?php endif; ?>" name="nisn" id="nisn" placeholder="" value="<?php echo e(old('nisn')); ?>">
                            <label for="nisn">NIS</label>
                            <?php if($errors->has('nisn')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('nisn')); ?>

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
                        <textarea class="form-control <?php if($errors->has('alamat')): ?> is-invalid <?php endif; ?>" name="alamat" id="alamat" placeholder="" style="height: 100px;"><?php echo e(old('alamat')); ?></textarea>
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

                        <div class="form-group mb-3 col-md-5">
                            <label for="kelas">Kelas</label>
                            <select name="kelas" id="kelas" class="form-select <?php if($errors->has('kelas')): ?> is-invalid <?php endif; ?>">
                                <option value="" disabled selected hidden>Pilih Kelas</option>
                                <option value="X PPLG 1" <?php if(old('kelas') == 'X PPLG 1'){ echo 'selected'; } ?>>X PPLG 1</option>
                                <option value="X PPLG 2" <?php if(old('kelas') == 'X PPLG 2'){ echo 'selected'; } ?>>X PPLG 2</option>
                                <option value="X PPLG 3" <?php if(old('kelas') == 'X PPLG 3'){ echo 'selected'; } ?>>X PPLG 3</option>
                                <option value="X TJKT 1" <?php if(old('kelas') == 'X TJKT 1'){ echo 'selected'; } ?>>X TJKT 1</option>
                                <option value="X TJKT 2" <?php if(old('kelas') == 'X TJKT 2'){ echo 'selected'; } ?>>X TJKT 2</option>
                                <option value="X TJKT 3" <?php if(old('kelas') == 'X TJKT 3'){ echo 'selected'; } ?>>X TJKT 3</option>
                                <option value="X TO 1" <?php if(old('kelas') == 'X TO 1'){ echo 'selected'; } ?>>X TO 1</option>
                                <option value="X TO 2" <?php if(old('kelas') == 'X TO 2'){ echo 'selected'; } ?>>X TO 2</option>
                                <option value="X TO 3" <?php if(old('kelas') == 'X TO 3'){ echo 'selected'; } ?>>X TO 3</option>
                                <option value="X TKI 1" <?php if(old('kelas') == 'X TKI 1'){ echo 'selected'; } ?>>X TKI 1</option>
                                <option value="X TKI 2" <?php if(old('kelas') == 'X TKI 2'){ echo 'selected'; } ?>>X TKI 2</option>
                                <option value="X TKI 3" <?php if(old('kelas') == 'X TKI 3'){ echo 'selected'; } ?>>X TKI 3</option>
                                <option value="X TE 1" <?php if(old('kelas') == 'X TE 1'){ echo 'selected'; } ?>>X TE 1</option>
                                <option value="X TE 2" <?php if(old('kelas') == 'X TE 2'){ echo 'selected'; } ?>>X TE 2</option>
                                <option value="X TE 3" <?php if(old('kelas') == 'X TE 3'){ echo 'selected'; } ?>>X TE 3</option>

                                <option value="XI PPLG 1" <?php if(old('kelas') == 'XI PPLG 1'){ echo 'selected'; } ?>>XI PPLG 1</option>
                                <option value="XI PPLG 2" <?php if(old('kelas') == 'XI PPLG 2'){ echo 'selected'; } ?>>XI PPLG 2</option>
                                <option value="XI PPLG 3" <?php if(old('kelas') == 'XI PPLG 3'){ echo 'selected'; } ?>>XI PPLG 3</option>
                                <option value="XI TJKT 1" <?php if(old('kelas') == 'XI TJKT 1'){ echo 'selected'; } ?>>XI TJKT 1</option>
                                <option value="XI TJKT 2" <?php if(old('kelas') == 'XI TJKT 2'){ echo 'selected'; } ?>>XI TJKT 2</option>
                                <option value="XI TJKT 3" <?php if(old('kelas') == 'XI TJKT 3'){ echo 'selected'; } ?>>XI TJKT 3</option>
                                <option value="XI TO 1" <?php if(old('kelas') == 'XI TO 1'){ echo 'selected'; } ?>>XI TO 1</option>
                                <option value="XI TO 2" <?php if(old('kelas') == 'XI TO 2'){ echo 'selected'; } ?>>XI TO 2</option>
                                <option value="XI TO 3" <?php if(old('kelas') == 'XI TO 3'){ echo 'selected'; } ?>>XI TO 3</option>
                                <option value="XI TKI 1" <?php if(old('kelas') == 'XI TKI 1'){ echo 'selected'; } ?>>XI TKI 1</option>
                                <option value="XI TKI 2" <?php if(old('kelas') == 'XI TKI 2'){ echo 'selected'; } ?>>XI TKI 2</option>
                                <option value="XI TKI 3" <?php if(old('kelas') == 'XI TKI 3'){ echo 'selected'; } ?>>XI TKI 3</option>
                                <option value="XI TE 1" <?php if(old('kelas') == 'XI TE 1'){ echo 'selected'; } ?>>XI TE 1</option>
                                <option value="XI TE 2" <?php if(old('kelas') == 'XI TE 2'){ echo 'selected'; } ?>>XI TE 2</option>
                                <option value="XI TE 3" <?php if(old('kelas') == 'XI TE 3'){ echo 'selected'; } ?>>XI TE 3</option>
                                <option value="XI PG 1" <?php if(old('kelas') == 'XI PG 1'){ echo 'selected'; } ?>>XI PG 1</option>
                                <option value="XI PG 2" <?php if(old('kelas') == 'XI PG 2'){ echo 'selected'; } ?>>XI PG 2</option>
                                <option value="XI PG 3" <?php if(old('kelas') == 'XI PG 3'){ echo 'selected'; } ?>>XI PG 3</option>
                                <option value="XI RPL 1" <?php if(old('kelas') == 'XI RPL 1'){ echo 'selected'; } ?>>XI RPL 1</option>
                                <option value="XI RPL 2" <?php if(old('kelas') == 'XI RPL 2'){ echo 'selected'; } ?>>XI RPL 2</option>
                                <option value="XI RPL 3" <?php if(old('kelas') == 'XI RPL 3'){ echo 'selected'; } ?>>XI RPL 3</option>

                                <option value="XII PPLG 1" <?php if(old('kelas') == 'XII PPLG 1'){ echo 'selected'; } ?>>XII PPLG 1</option>
                                <option value="XII PPLG 2" <?php if(old('kelas') == 'XII PPLG 2'){ echo 'selected'; } ?>>XII PPLG 2</option>
                                <option value="XII PPLG 3" <?php if(old('kelas') == 'XII PPLG 3'){ echo 'selected'; } ?>>XII PPLG 3</option>
                                <option value="XII TJKT 1" <?php if(old('kelas') == 'XII TJKT 1'){ echo 'selected'; } ?>>XII TJKT 1</option>
                                <option value="XII TJKT 2" <?php if(old('kelas') == 'XII TJKT 2'){ echo 'selected'; } ?>>XII TJKT 2</option>
                                <option value="XII TJKT 3" <?php if(old('kelas') == 'XII TJKT 3'){ echo 'selected'; } ?>>XII TJKT 3</option>
                                <option value="XII TO 1" <?php if(old('kelas') == 'XII TO 1'){ echo 'selected'; } ?>>XII TO 1</option>
                                <option value="XII TO 2" <?php if(old('kelas') == 'XII TO 2'){ echo 'selected'; } ?>>XII TO 2</option>
                                <option value="XII TO 3" <?php if(old('kelas') == 'XII TO 3'){ echo 'selected'; } ?>>XII TO 3</option>
                                <option value="XII TKI 1" <?php if(old('kelas') == 'XII TKI 1'){ echo 'selected'; } ?>>XII TKI 1</option>
                                <option value="XII TKI 2" <?php if(old('kelas') == 'XII TKI 2'){ echo 'selected'; } ?>>XII TKI 2</option>
                                <option value="XII TKI 3" <?php if(old('kelas') == 'XII TKI 3'){ echo 'selected'; } ?>>XII TKI 3</option>
                                <option value="XII TE 1" <?php if(old('kelas') == 'XII TE 1'){ echo 'selected'; } ?>>XII TE 1</option>
                                <option value="XII TE 2" <?php if(old('kelas') == 'XII TE 2'){ echo 'selected'; } ?>>XII TE 2</option>
                                <option value="XII TE 3" <?php if(old('kelas') == 'XII TE 3'){ echo 'selected'; } ?>>XII TE 3</option>
                                <option value="XII PG 1" <?php if(old('kelas') == 'XII PG 1'){ echo 'selected'; } ?>>XII PG 1</option>
                                <option value="XII PG 2" <?php if(old('kelas') == 'XII PG 2'){ echo 'selected'; } ?>>XII PG 2</option>
                                <option value="XII PG 3" <?php if(old('kelas') == 'XII PG 3'){ echo 'selected'; } ?>>XII PG 3</option>
                                <option value="XII RPL 1" <?php if(old('kelas') == 'XII RPL 1'){ echo 'selected'; } ?>>XII RPL 1</option>
                                <option value="XII RPL 2" <?php if(old('kelas') == 'XII RPL 2'){ echo 'selected'; } ?>>XII RPL 2</option>
                                <option value="XII RPL 3" <?php if(old('kelas') == 'XII RPL 3'){ echo 'selected'; } ?>>XII RPL 3</option>
                                

                                
                            </select>
                            <?php if($errors->has('kelas')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('kelas')); ?>

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

                        <hr class="mb-0">
                        <p style="font-size: 2vh; color: grey;" class="mt-0">Opsional</p>
                        <div class="mb-3 col-md-6">
                    <label for="golongan_darah" class="form-label">Golongan Darah</label>
                <select class="form-select <?php if($errors->has('golongan_darah')): ?> is-invalid <?php endif; ?>" id="golongan_darah" name="golongan_darah">
            <option value="">Pilih Golongan Darah</option>
            <option value="A" <?php if(old('golongan_darah') == 'A'){ echo 'selected'; } ?>>A</option>
            <option value="B" <?php if(old('golongan_darah') == 'B'){ echo 'selected'; } ?>>B</option>
            <option value="AB" <?php if(old('golongan_darah') == 'AB'){ echo 'selected'; } ?>>AB</option>
            <option value="O" <?php if(old('golongan_darah') == 'O'){ echo 'selected'; } ?>>O</option>
        </select>
        <?php if($errors->has('golongan_darah')): ?> 
        <div class="invalid-feedback">
            <?php echo e($errors->first('golongan_darah')); ?>

        </div>
        <?php endif; ?>
    </div>


    <div class="form-floating mb-3 col-md-8">
                            <input type="text" class="form-control <?php if($errors->has('nama_ortu')): ?> is-invalid <?php endif; ?>" name="nama_ortu" id="nama_ortu" placeholder="" value="<?php echo e(old('nama_ortu')); ?>" >
                            <label for="nama_ortu">Nama Orang Tua</label>
                            <?php if($errors->has('nama_ortu')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('nama_ortu')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control <?php if($errors->has('tampat_tanggal_lahir')): ?> is-invalid <?php endif; ?>" name="tampat_tanggal_lahir" id="tampat_tanggal_lahir" placeholder="" value="<?php echo e(old('tampat_tanggal_lahir')); ?>" >
                            <label for="tampat_tanggal_lahir">Tempat, tanggal lahir</label>
                            <?php if($errors->has('tampat_tanggal_lahir')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('tampat_tanggal_lahir')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control <?php if($errors->has('catatan_kesehatan')): ?> is-invalid <?php endif; ?>" name="catatan_kesehatan" id="catatan_kesehatan" placeholder="" value="<?php echo e(old('catatan_kesehatan')); ?>" >
                            <label for="catatan_kesehatan">Catatan Kesehatan</label>
                            <?php if($errors->has('catatan_kesehatan')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('catatan_kesehatan')); ?>

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
        });
        $('#jurusan').select2();
        $('#kelas').select2();
    })
</script>
<script>
  
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\siswa\tambah.blade.php ENDPATH**/ ?>