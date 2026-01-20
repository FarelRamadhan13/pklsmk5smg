
<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1>Tambah Prakerin</h1>
                </div>
                <div class="card-body p-5">
                    <?php if(session('error')): ?>
                    <div class="alert-danger alert text-center">
                        <?php echo e(session('error')); ?>

                    </div>
                    <?php endif; ?>

                    
                    <div class="my-4">
                        <a href="/Admin/Prakerin" class="btn-danger btn">Kembali</a>

                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-group col-md-6 mb-3">
                            <label for="id_pkl">Id PKL</label>
                            <select name="id_pkl" id="id_pkl" class="form-select <?php if($errors->has('id_pkl')): ?> is-invalid <?php endif; ?>">
                                <option value="" disabled selected hidden>Pilih Id PKL / Industri</option>
                                <?php $__currentLoopData = $pkl; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($p->idpkl); ?>" <?php if(old('id_pkl') == $p->idpkl){ echo 'selected'; } ?>><?php echo e($p->idpkl); ?> || <?php echo e($p->nama_pkl); ?></option>    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('id_pkl')): ?>
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('id_pkl')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-floating mb-3 col-md-8">
                            <input type="text" class="form-control <?php if($errors->has('namapkl')): ?> is-invalid <?php endif; ?>" name="namapkl" id="namapkl" placeholder="" value="<?php echo e(old('namapkl')); ?>" readonly>
                            <label for="namapkl">Nama PKL</label>
                            <?php if($errors->has('namapkl')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('namapkl')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-floating mb-3 col-md-8">
                            <input type="text" class="form-control <?php if($errors->has('alamatpkl')): ?> is-invalid <?php endif; ?>" style="height: 100px;" name="alamatpkl" id="alamatpkl" placeholder="" value="<?php echo e(old('alamatpkl')); ?>" readonly>
                            <label for="alamatpkl">Alamat PKL</label>
                            <?php if($errors->has('alamatpkl')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('alamatpkl')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="nisn">NIS</label>
                            <select name="nisn" id="nisn" class="form-select <?php if($errors->has('nisn')): ?> is-invalid <?php endif; ?>">
                                <option value="" disabled selected hidden>Pilih NIS</option>
                                <?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($s->nisn); ?>" <?php if(old('nisn') == $s->nisn){ echo 'selected'; } ?>><?php echo e($s->nisn); ?> || <?php echo e($s->nama_siswa); ?></option>    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('nisn')): ?>
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('nisn')); ?>

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
                            <input type="text" class="form-control <?php if($errors->has('kelas')): ?> is-invalid <?php endif; ?>" name="kelas" id="kelas" placeholder="" value="<?php echo e(old('kelas')); ?>" readonly>
                            <label for="kelas">Kelas</label>
                            <?php if($errors->has('kelas')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('kelas')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="nip">NIP</label>
                            <select name="nip" id="nip" class="form-select <?php if($errors->has('nip')): ?> is-invalid <?php endif; ?>">
                                <option value="" disabled selected hidden>Pilih NIP</option>
                                <?php $__currentLoopData = $guru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($g->nip); ?>" <?php if(old('nip') == $g->nip){ echo 'selected'; } ?>><?php echo e($g->nip); ?> || <?php echo e($g->nama); ?></option>    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('nip')): ?>
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('nip')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-floating mb-3 col-md-8">
                            <input type="text" class="form-control <?php if($errors->has('namaguru')): ?> is-invalid <?php endif; ?>" name="namaguru" id="namaguru" placeholder="" value="<?php echo e(old('namaguru')); ?>" readonly>
                            <label for="namaguru">Nama Guru</label>
                            <?php if($errors->has('namaguru')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('namaguru')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group mb-3 col-md-8">
                            <label for="start">Start</label>
                            <input type="date" name="start" id="start" class="form-control <?php if($errors->has('start')): ?> is-invalid <?php endif; ?>" value="<?php echo e(old('start')); ?>">
                            <?php if($errors->has('start')): ?>
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('start')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group mb-3 col-md-8">
                            <label for="end">End</label>
                            <input type="date" name="end" id="end" class="form-control <?php if($errors->has('end')): ?> is-invalid <?php endif; ?>"value="<?php echo e(old('end')); ?>">
                            <?php if($errors->has('end')): ?>
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('end')); ?>

                            </div>
                            <?php endif; ?>
                        </div>
                      
                        <div class="form-floating mb-3 col-md-8">
                            <input type="number" class="form-control <?php if($errors->has('tahun')): ?> is-invalid <?php endif; ?>" name="tahun" id="tahun" placeholder="" value="<?php echo e(Date('Y')); ?>" readonly>
                            <label for="tahun">tahun</label>
                            <?php if($errors->has('tahun')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('tahun')); ?>

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
       $('#id_pkl').change(function(){
        var IdPKL = $(this).val();
        if(IdPKL){
            $.ajax({
                url: '/Admin/Prakerin/Tambah/Getpkl/' + IdPKL,
                type: 'GET',
                dataType: 'json',
                success: function (response){
                    $('#namapkl').val(response.pkll.nama_pkl);
                    $('#alamatpkl').val(response.pkll.alamat_pkl);
                },
                error: function (error){
                    console.log(error);
                }
            });
           
        }
        else{
                $('#namapkl').val('');
                $('#alamatpkl').val('');
            }
       });

       $('#nisn').change(function(){
        var nisn = $(this).val();
        if(nisn){
            $.ajax({
                url: '/Admin/Prakerin/Tambah/GetSiswa/' + nisn,
                type: 'GET',
                dataType: 'json',
                success: function (respon){
                    $('#namasiswa').val(respon.siswaa.nama_siswa);
                    $('#kelas').val(respon.siswaa.kelas);
                },
                error: function (error){
                    console.log(error);
                }
            });
        }
        else{
            $('#namasiswa').val('');
            $('#kelas').val('');
        }
       });

       $('#nip').change(function(){
        var nip = $(this).val();
        if(nip){
            $.ajax({
                url: '/Admin/Prakerin/Tambah/GetGuru/' + nip,
                type: 'GET',
                dataType: 'json',
                success: function (responn){
                    $('#namaguru').val(responn.guruu.nama);
                },
                error: function (error){
                    console.log(error);
                }
            });
        }else{
            $('#namaguru').val('');
        }
       });

       $('#id_pkl').select2();
       $('#nisn').select2();
       $('#nip').select2();
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\tb_prakerin\tambah.blade.php ENDPATH**/ ?>