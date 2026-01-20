
<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1>Tambah Surat Izin PKL</h1>
                </div>
                <div class="card-body p-5">
                    <?php if(session('gagal')): ?>
                    <div class="alert-danger alert text-center">
                        <?php echo e(session('gagal')); ?>

                    </div>
                    <?php endif; ?>
                    <div class="my-4">
                        <a href="/Siswa/suratIzin" class="btn-danger btn">Kembali</a>

                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-group col-md-6 mb-3">
                            <label for="pkl">Pilih PKL / Industri</label>
                            <select name="pkl" id="id_pkl" class="form-select <?php if($errors->has('pkl')): ?> is-invalid <?php endif; ?>">
                                <option value="" disabled selected hidden>Pilih PKL / Industri</option>
                                <?php $__currentLoopData = $pkl; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($p->idpkl); ?>" <?php if(old('pkl') == $p->idpkl){ echo 'selected'; } ?>><?php echo e($p->nama_pkl); ?></option>    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('pkl')): ?>
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('pkl')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                     

                        <div class="form-floating mb-3 col-md-6" >
                            <input type="number" class="form-control <?php if($errors->has('tahun')): ?> is-invalid <?php endif; ?>" name="tahun" id="tahun" placeholder="" value="<?php echo e(date('Y')); ?>" readonly>
                            <label for="tahun">tahun PKL</label>
                            <?php if($errors->has('tahun')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('tahun')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group mb-3 col-md-6">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control <?php if($errors->has('tanggal')): ?> is-invalid <?php endif; ?>" value="<?php if(old('tanggal')){ echo old('tanggal'); }else{ echo date('Y-m-d'); } ?>" readonly>
                            <?php if($errors->has('tanggal')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('tanggal')); ?>

                            </div>
                            <?php endif; ?>
                                        </div>

                                        <div class="form-group mb-3 col-md-6">
                            <label for="pada_tanggal">Pada Tanggal</label>
                            <input type="date" class="form-control <?php if($errors->has('pada_tanggal')): ?> is-invalid <?php endif; ?>" name="pada_tanggal" id="pada_tanggal" placeholder="" value="<?php echo e(old('pada_tanggal')); ?>" >
                            <?php if($errors->has('pada_tanggal')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('pada_tanggal')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-4 mb-3">
                        <label for="waktu" class="form-label">Waktu</label>
                        <input type="time" id="waktu" name="waktu" class="form-control <?php if($errors->has('waktu')): ?> is-invalid <?php endif; ?>" value="<?php echo e(old('waktu')); ?>">
                        <?php if($errors->has('waktu')): ?> 
                        <div class="invalid-feedback">
                            <?php echo e($errors->first('waktu')); ?>

                        </div>
                        <?php endif; ?>
                        </div>

                        <div class="form-group mb-3">
                            <label for="siswa">Pilih Siswa</label>
                            <select name="siswa" id="id_siswa" class="form-select <?php if($errors->has('siswa')): ?> is-invalid <?php endif; ?>">
                            <option value="" disabled selected hidden>Pilih Siswa</option>
                                <?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($p->nisn); ?>" <?php if(old('siswa') == $p->nisn){ echo 'selected'; } ?>><?php echo e($p->nama_siswa); ?> || NIS: <?php echo e($p->nisn); ?></option>    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('siswa')): ?>
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('siswa')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                    

                        <div class="form-floating mb-3" >
                            <input type="text" class="form-control <?php if($errors->has('berdasarkan')): ?> is-invalid <?php endif; ?>" name="berdasarkan" id="berdasarkan" placeholder="" value="<?php echo e(old('berdasarkan')); ?>">
                            <label for="berdasarkan">berdasarkan</label>
                            <?php if($errors->has('berdasarkan')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('berdasarkan')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-floating mb-3" >
                            <input type="text" class="form-control <?php if($errors->has('keperluan')): ?> is-invalid <?php endif; ?>" name="keperluan" id="keperluan" placeholder="" value="<?php echo e(old('keperluan')); ?>">
                            <label for="keperluan">Keperluan</label>
                            <?php if($errors->has('keperluan')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('keperluan')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-floating mb-3 col-md-6" >
                            <input type="text" class="form-control <?php if($errors->has('tempat')): ?> is-invalid <?php endif; ?>" name="tempat" id="tempat" placeholder="" value="<?php echo e(old('tempat')); ?>">
                            <label for="tempat">Tempat</label>
                            <?php if($errors->has('tempat')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('tempat')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group mb-3 col-md-7">
                            <label for="kepalasekolah">Pilih Kepala Sekolah</label>
                            <select name="kepalasekolah" id="kepalasekolah" class="form-select   <?php if($errors->has('kepalasekolah')): ?> is-invalid <?php endif; ?>">
                                <option value="" disabled hidden selected>-- Pilih kepala Sekolah --</option>
                                <?php $__currentLoopData = $kSekolah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($k->id); ?>" <?php if(old('kepalasekolah') == $k->id){ echo 'selected'; } ?>><?php echo e($k->name); ?></option>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('kepalasekolah')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('kepalasekolah')); ?>

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
        $('#id_pkl').select2();
        $('#id_siswa').select2();
        
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\suratIzin\tambah.blade.php ENDPATH**/ ?>