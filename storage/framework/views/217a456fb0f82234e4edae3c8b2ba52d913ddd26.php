
<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1>Pengajuan Surat tugas</h1>
                </div>
                <div class="card-body p-5">
                    <?php if(session('gagal')): ?>
                    <div class="alert-danger alert text-center">
                        <?php echo e(session('gagal')); ?>

                    </div>
                    <?php endif; ?>
                    <div class="my-4">
                        <a href="/Pendamping/Pengajuan" class="btn-danger btn">Kembali</a>

                    </div>
                    <form action="" method="post" enctype="multipart/form-data" id="Form">
                        <?php echo csrf_field(); ?>
                       
                      <?php if(auth()->guard('pendamping')->check()): ?>
                      <input type="hidden" name="nip" value="<?php echo e(auth()->guard('pendamping')->user()->nip); ?>">
                      <?php else: ?>
                      <div class="form-group col-md-6 mb-3">
                            <label for="nip">Pilih Guru Pendamping</label>
                            <select name="nip" id="id_nip" class="form-select <?php if($errors->has('nip')): ?> is-invalid <?php endif; ?>">
                                <option value="" disabled selected hidden>Pilih Guru Pendamping</option>
                                <?php $__currentLoopData = $pendamping; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($p->nip); ?>" <?php if(old('nip') == $p->nip){ echo 'selected'; } ?>><?php echo e($p->nama); ?></option>    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('nip')): ?>
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('nip')); ?>

                            </div>
                            <?php endif; ?>
                        </div>
                      <?php endif; ?>

                        <div class="form-group mb-3 col-md-5">
                            <label for="tujuan">Tujuan</label>
                            <select name="tujuan" id="tujuan" class="form-select   <?php if($errors->has('tujuan')): ?> is-invalid <?php endif; ?>">
                                <option value="" disabled hidden selected>-- Pilih Tujuan --</option>
                                
                                <option value="Penyerahan" <?php if(old('tujuan') == "Penyerahan"){ echo 'selected'; } ?>>Penyerahan</option>
                                <option value="Monitoring" <?php if(old('tujuan') == "Monitoring"){ echo 'selected'; } ?>>Monitoring</option>
                                <option value="Penarikan" <?php if(old('tujuan') == "Penarikan"){ echo 'selected'; } ?>>Penarikan</option>
                               
                            </select>
                            <?php if($errors->has('tujuan')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('tujuan')); ?>

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

                        <div class="form-group mb-3">
    <label for="tanggal">Pada Tanggal</label>
    <input type="date" class="form-control <?php if($errors->has('tanggal')): ?> is-invalid <?php endif; ?>" name="tanggal" id="tanggal" placeholder="" value="<?php echo e(old('tanggal', now()->toDateString())); ?>">
    <?php if($errors->has('tanggal')): ?> 
    <div class="invalid-feedback">
        <?php echo e($errors->first('tanggal')); ?>

    </div>
    <?php endif; ?>
</div>

                        <div class="form-floating mb-3">
                            <input type="number" class="form-control <?php if($errors->has('lama')): ?> is-invalid <?php endif; ?>" name="lama" id="lama" placeholder="" value="<?php echo e(old('lama')); ?>">
                            <label for="lama">Lamanya perjalanan dinas (hari)</label>
                            <?php if($errors->has('lama')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('lama')); ?>

                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group mb-3">
                            <label for="tanggalberangkat">Tanggal berangkat</label>
                            <input type="date" class="form-control <?php if($errors->has('tanggalberangkat')): ?> is-invalid <?php endif; ?>" name="tanggalberangkat" id="tanggalberangkat" placeholder="" value="<?php echo e(old('tanggalberangkat')); ?>" >
                            <?php if($errors->has('tanggalberangkat')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('tanggalberangkat')); ?>

                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group mb-3">
                            <label for="tanggalharuskembali">Tanggal Harus Kembali</label>
                            <input type="date" class="form-control <?php if($errors->has('tanggalharuskembali')): ?> is-invalid <?php endif; ?>" name="tanggalharuskembali" id="tanggalharuskembali" placeholder="" value="<?php echo e(old('tanggalharuskembali')); ?>" >
                            <?php if($errors->has('tanggalharuskembali')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('tanggalharuskembali')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                      
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

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control <?php if($errors->has('kendaraan')): ?> is-invalid <?php endif; ?>" name="kendaraan" id="kendaraan" placeholder="" value="<?php echo e(old('kendaraan')); ?>">
                            <label for="kendaraan">Kendaraan</label>
                            <?php if($errors->has('kendaraan')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('kendaraan')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group mb-3 col-md-5">
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
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control <?php if($errors->has('keterangan')): ?> is-invalid <?php endif; ?>" name="keterangan" id="keterangan" placeholder="" value="<?php echo e(old('keterangan')); ?>">
                            <label for="keterangan">Keterangan lain (opsional)</label>
                            <?php if($errors->has('keterangan')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('keterangan')); ?>

                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Dapatkan surat" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('Form').addEventListener('submit', function(event) {
        event.preventDefault(); 
    
        Swal.fire({
        title: 'Sedang proses, mohon tunggu sebentar...',
        imageUrl: '<?php echo e(asset("storage/pengajuan/tulis.gif")); ?>',
        imageWidth: 200,
        imageHeight: 200,
        timerProgressBar: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false
    
    
    });
    
    event.target.submit();
    });
    </script>
<script>
    $(document).ready(function(){
        $('#id_pkl').select2();
        $('#id_nip').select2();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\guru_pendampingLogin\tugas.blade.php ENDPATH**/ ?>