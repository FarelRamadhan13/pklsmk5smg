
<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1>Ubah Data Kunjungan</h1>
                </div>
                <div class="card-body p-5">
                    <?php if(session('gagal')): ?>
                    <div class="alert-danger alert text-center">
                        <?php echo e(session('gagal')); ?>

                    </div>
                    <?php endif; ?>
                    <?php if(auth()->user()): ?>
                    <div class="my-4">
                        <a href="/Admin/Kunjungan" class="btn-danger btn">Kembali</a>

                    </div>
                    <?php else: ?>
                    <div class="my-4">
                        <a href="/Pendamping/Kunjungan" class="btn-danger btn">Kembali</a>
                    </div>
                    <?php endif; ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-group col-md-6 mb-3">
                            <label for="idprakerin">Id Prakerin</label>
                            <select name="idprakerin" id="idprakerin" class="form-select <?php if($errors->has('idprakerin')): ?> is-invalid <?php endif; ?>" <?php if(auth()->guard('pendamping')->check()){ echo 'disabled'; } ?>>
                                <option value="" disabled selected hidden>Pilih Id Prakerin</option>
                                <?php $__currentLoopData = $prakerin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($p->idprakerin); ?>" <?php if(old('idprakerin')){ if(old('idprakerin') == $p->idprakerin){ echo 'selected'; }}
                                    else{ if($kunjungan->idprakerin == $p->idprakerin)
                                    { echo 'selected'; } } ?>><?php echo e($p->idprakerin); ?></option>    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('idprakerin')): ?>
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('idprakerin')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <?php if(auth()->guard('pendamping')->check()): ?> <input type="hidden" name="idprakerin" value="<?php echo e($kunjungan->idprakerin); ?>"> <?php endif; ?>
                        <div class="form-floating mb-3 col-md-7">
                            <input type="text" class="form-control <?php if($errors->has('id_pkl')): ?> is-invalid <?php endif; ?>" name="id_pkl" id="id_pkl" placeholder="" value="<?php echo e(old('id_pkl')); ?>" readonly>
                            <label for="id_pkl">Id PKL</label>
                            <?php if($errors->has('id_pkl')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('id_pkl')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-floating mb-3 col-md-7">
                            <input type="text" class="form-control <?php if($errors->has('nama_pkl')): ?> is-invalid <?php endif; ?>" name="nama_pkl" id="nama_pkl" placeholder="" value="<?php echo e(old('nama_pkl')); ?>" readonly>
                            <label for="nama_pkl">Nama PKL</label>
                            <?php if($errors->has('nama_pkl')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('nama_pkl')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-floating mb-3 col-md-7">
                            <input type="text" class="form-control <?php if($errors->has('alamat_pkl')): ?> is-invalid <?php endif; ?>" style="height: 100px;" name="alamat_pkl" id="alamat_pkl" placeholder="" value="<?php echo e(old('alamat_pkl')); ?>" readonly>
                            <label for="alamat_pkl">Alamat PKL</label>
                            <?php if($errors->has('alamat_pkl')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('alamat_pkl')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-floating mb-3 col-md-7">
                            <input type="text" class="form-control <?php if($errors->has('nisn')): ?> is-invalid <?php endif; ?>" name="nisn" id="nisn" placeholder="" value="<?php echo e(old('nisn')); ?>" readonly>
                            <label for="nisn">NIS</label>
                            <?php if($errors->has('nisn')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('nisn')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-floating mb-3 col-md-7">
                            <input type="text" class="form-control <?php if($errors->has('nama')): ?> is-invalid <?php endif; ?>" name="nama" id="nama" placeholder="" value="<?php echo e(old('nama')); ?>" readonly>
                            <label for="nama">Nama Siswa</label>
                            <?php if($errors->has('nama')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('nama')); ?>

                            </div>
                            <?php endif; ?>
                        </div>
                   
                        <div class="form-floating mb-3 col-md-7">
                            <input type="text" class="form-control <?php if($errors->has('kelas')): ?> is-invalid <?php endif; ?>" name="kelas" id="kelas" placeholder="" value="<?php echo e(old('kelas')); ?>" readonly>
                            <label for="kelas">Kelas</label>
                            <?php if($errors->has('kelas')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('kelas')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-floating mb-3 col-md-7">
                            <input type="text" class="form-control <?php if($errors->has('nip')): ?> is-invalid <?php endif; ?>" name="nip" id="nip" placeholder="" value="<?php echo e(old('nip')); ?>" readonly>
                            <label for="nip">NIP</label>
                            <?php if($errors->has('nip')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('nip')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group mb-3 col-md-8">
                            <label for="file">Upload Data</label>
                            <input type="file" name="file" id="file" class="form-control <?php if($errors->has('file')): ?> is-invalid <?php endif; ?>">
                            <?php if($errors->has('file')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('file')); ?>

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
<?php if(auth()->user()): ?>
<script>
    $(document).ready(function(){
        var id_prakerin = $('#idprakerin').val();
        if(id_prakerin){
            $.ajax({
                url: '/Admin/Kunjungan/Tambah/GetPrakerin/' + id_prakerin,
                type: 'GET',
                dataType: 'json',
                success: function (respon){
                    $('#id_pkl').val(respon.prakerinn.idpkl);
                    $('#nama_pkl').val(respon.prakerinn.nama_pkl);
                    $('#alamat_pkl').val(respon.prakerinn.alamat_pkl);
                    $('#nisn').val(respon.prakerinn.nisn);
                    $('#nama').val(respon.prakerinn.nama_siswa);
                    $('#kelas').val(respon.prakerinn.kelas);
                    $('#nip').val(respon.prakerinn.nip);
                },
                error: function(){
                    console.log(error);
                }
            });
        }else{
            $('#id_pkl').val('');
        }
       $('#idprakerin').change(function(){
        var id_prakerin = $(this).val();
        if(id_prakerin){
            $.ajax({
                url: '/Admin/Kunjungan/Tambah/GetPrakerin/' + id_prakerin,
                type: 'GET',
                dataType: 'json',
                success: function (respon){
                    $('#id_pkl').val(respon.prakerinn.idpkl);
                    $('#nama_pkl').val(respon.prakerinn.nama_pkl);
                    $('#alamat_pkl').val(respon.prakerinn.alamat_pkl);
                    $('#nisn').val(respon.prakerinn.nisn);
                    $('#nama').val(respon.prakerinn.nama_siswa);
                    $('#kelas').val(respon.prakerinn.kelas);
                    $('#nip').val(respon.prakerinn.nip);
                },
                error: function(){
                    console.log(error);
                }
            });
        }else{
            $('#id_pkl').val('');
        }
       });
    })
</script>
<?php else: ?>
<script>
    $(document).ready(function(){
        var id_prakerin = $('#idprakerin').val();
        if(id_prakerin){
            $.ajax({
                url: '/Pendamping/Kunjungan/Tambah/GetPrakerin/' + id_prakerin,
                type: 'GET',
                dataType: 'json',
                success: function (respon){
                    $('#id_pkl').val(respon.prakerinn.idpkl);
                    $('#nama_pkl').val(respon.prakerinn.nama_pkl);
                    $('#alamat_pkl').val(respon.prakerinn.alamat_pkl);
                    $('#nisn').val(respon.prakerinn.nisn);
                    $('#nama').val(respon.prakerinn.nama_siswa);
                    $('#kelas').val(respon.prakerinn.kelas);
                    $('#nip').val(respon.prakerinn.nip);
                },
                error: function(){
                    console.log(error);
                }
            });
        }else{
            $('#id_pkl').val('');
        }
       $('#idprakerin').change(function(){
        var id_prakerin = $(this).val();
        if(id_prakerin){
            $.ajax({
                url: '/Pendamping/Kunjungan/Tambah/GetPrakerin/' + id_prakerin,
                type: 'GET',
                dataType: 'json',
                success: function (respon){
                    $('#id_pkl').val(respon.prakerinn.idpkl);
                    $('#nama_pkl').val(respon.prakerinn.nama_pkl);
                    $('#alamat_pkl').val(respon.prakerinn.alamat_pkl);
                    $('#nisn').val(respon.prakerinn.nisn);
                    $('#nama').val(respon.prakerinn.nama_siswa);
                    $('#kelas').val(respon.prakerinn.kelas);
                    $('#nip').val(respon.prakerinn.nip);
                },
                error: function(){
                    console.log(error);
                }
            });
        }else{
            $('#id_pkl').val('');
        }
       });
    })
</script>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\kunjungan\ubah.blade.php ENDPATH**/ ?>