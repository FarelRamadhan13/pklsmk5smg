
<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center py-3">
                    <h1>Tambah Surat Penarikan PKL</h1>
                </div>
                <div class="card-body p-5">
                    <?php if(session('gagal')): ?>
                    <div class="alert-danger alert text-center">
                        <?php echo e(session('gagal')); ?>

                    </div>
                    <?php endif; ?>
                    <div class="my-4">
                        <a href="/Siswa/suratPenarikan" class="btn-danger btn">Kembali</a>

                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-group col-md-10 mb-3">
                            <label for="prakerin">Pilih Prakerin</label>
                            <select name="prakerin" id="prakerin" class="form-select <?php if($errors->has('prakerin')): ?> is-invalid <?php endif; ?>">
                                <option value="" disabled selected hidden>Pilih Prakerin</option>
                                <?php $__currentLoopData = $prakerin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($p->idprakerin); ?>" <?php if(old('prakerin')){ if(old('prakerin') == $p->idprakerin){ echo 'selected'; }}else{ if($surat->prakerin == $p->idprakerin){ echo 'selected'; } } ?>>Id Prakerin: <?php echo e($p->idprakerin); ?> || NIS: <?php echo e($p->nisn); ?> || Nama: <?php echo e($p->nama_siswa); ?></option>    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('prakerin')): ?>
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('prakerin')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        
                        <div class="form-floating mb-3 col-md-8">
                                                    <input type="text" class="form-control <?php if($errors->has('namasiswa')): ?> is-invalid <?php endif; ?>" name="namasiswa" id="namasiswa" placeholder="" value="<?php echo e(old('namasiswa')); ?>" readonly>
                                                    <label for="namasiswa">Nama Siswa</label>
                                                    <?php if($errors->has('namasiswa')): ?> 
                                                    <div class="invalid-feedback">
                                                        <?php echo e($errors->first('namasiswa')); ?>

                                                    </div>
                                                    <?php endif; ?>
                                                </div>

                        <div class="form-floating mb-3 col-md-8">
                            <input type="text" class="form-control <?php if($errors->has('namapkl')): ?> is-invalid <?php endif; ?>" name="namapkl" id="namapkl" placeholder="" value="<?php echo e(old('namapkl')); ?>" readonly>
                            <label for="namapkl">Nama PKL/Industri</label>
                            <?php if($errors->has('namapkl')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('namapkl')); ?>

                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="form-floating mb-3 col-md-8">
                            <input type="text" class="form-control <?php if($errors->has('alamatpkl')): ?> is-invalid <?php endif; ?>" style="height: 100px;" name="alamatpkl" id="alamatpkl" placeholder="" value="<?php echo e(old('alamatpkl')); ?>" readonly>
                            <label for="alamatpkl">Alamat PKL/Industri</label>
                            <?php if($errors->has('alamatpkl')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('alamatpkl')); ?>

                            </div>
                            <?php endif; ?>
                        </div>
                        
                        

                        <div class="form-floating mb-3 col-md-6" >
                            <input type="number" class="form-control <?php if($errors->has('tahun')): ?> is-invalid <?php endif; ?>" name="tahun" id="tahun" placeholder="" value="<?php echo e($surat->tahun); ?>">
                            <label for="tahun">Tahun</label>
                            <?php if($errors->has('tahun')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('tahun')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group mb-3 col-md-6">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control <?php if($errors->has('tanggal')): ?> is-invalid <?php endif; ?>" value="<?php if(old('tanggal')){ echo old('tanggal'); }else{ echo $surat->tanggal; } ?>">
                            <?php if($errors->has('tanggal')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('tanggal')); ?>

                            </div>
                            <?php endif; ?>
                                        </div>

                         
                        <div class="form-floating mb-3 col-md-10">
                            <input type="text" class="form-control <?php if($errors->has('alasan')): ?> is-invalid <?php endif; ?>" name="alasan" id="alasan" placeholder="" value="<?php if(old('alasan')){ echo old('alasan'); }else{ echo $surat->alasan; } ?>">
                            <label for="alasan">Alasan</label>
                            <?php if($errors->has('alasan')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('alasan')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                       

                        <div class="form-group mb-3 col-md-5">
                            <label for="kepalasekolah">Pilih Kepala Sekolah</label>
                            <select name="kepalasekolah" id="kepalasekolah" class="form-select   <?php if($errors->has('kepalasekolah')): ?> is-invalid <?php endif; ?>">
                                <option value="" disabled hidden selected>-- Pilih kepala Sekolah --</option>
                                <?php $__currentLoopData = $kSekolah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($k->id); ?>" <?php if(old('kepalasekolah')){ if(old('kepalasekolah') == $k->id){ echo 'selected'; }}else{ if($surat->kepsek == $k->id){ echo 'selected'; } } ?>><?php echo e($k->name); ?></option>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('kepalasekolah')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('kepalasekolah')); ?>

                            </div>
                            <?php endif; ?>
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
        $('#prakerin').select2();
        
        var prakerin = $('#prakerin').val();
            if(prakerin){
            $.ajax({
                url: '/Admin/suratPenarikan/dapatkanpkl/' + prakerin,
                type: 'GET',
                dataType: 'json',
                success: function (response){
                    $('#namapkl').val(response.pkl.nama_pkl);
                    $('#alamatpkl').val(response.pkl.alamat_pkl);
                    $('#namasiswa').val(response.pkl.nama_siswa);
                    console.log(prakerin);
                    
                },
                error: function (error){
                    console.log(error);
                }
            });
        }else{
            $('#namapkl').val('');
            $('#alamatpkl').val('');
        }


        $('#prakerin').change(function(){
            var prakerin = $(this).val();
            if(prakerin){
            $.ajax({
                url: '/Admin/suratPenarikan/dapatkanpkl/' + prakerin,
                type: 'GET',
                dataType: 'json',
                success: function (response){
                    $('#namapkl').val(response.pkl.nama_pkl);
                    $('#alamatpkl').val(response.pkl.alamat_pkl);
                    $('#namasiswa').val(response.pkl.nama_siswa);
                    console.log(prakerin);
                    
                },
                error: function (error){
                    console.log(error);
                }
            });
        }else{
            $('#namapkl').val('');
            $('#alamatpkl').val('');
        }
        });
        
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\suratPenarikan\ubah.blade.php ENDPATH**/ ?>