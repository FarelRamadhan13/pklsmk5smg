
<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1>Tambah Jurnal PKL</h1>
                </div>
                <div class="card-body p-5">
                    <?php if(session('gagal')): ?>
                    <div class="alert-danger alert text-center">
                        <?php echo e(session('gagal')); ?>

                    </div>
                    <?php endif; ?>
                    <div class="my-4">
                        <a href="/Siswa/JurnalPKL" class="btn-danger btn">Kembali</a>

                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php if(auth()->check()): ?>
                        <div class="form-group col-md-10 mb-3">
                            <label for="prakerin">Pilih Prakerin</label>
                            <select name="prakerin" id="prakerin" class="form-select <?php if($errors->has('prakerin')): ?> is-invalid <?php endif; ?>">
                                <option value="" disabled selected hidden>Pilih Prakerin</option>
                                <option value="<?php echo e($awal->idprakerin); ?>" <?php if($surat->prakerin == $awal->idprakerin){ echo 'selected'; } ?>>Id Prakerin: <?php echo e($awal->idprakerin); ?> || NIS: <?php echo e($awal->nisn); ?></option>
                                <?php $__currentLoopData = $prakerin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($p->idprakerin); ?>" <?php if(old('prakerin') == $p->idprakerin){ echo 'selected'; } ?>>Id Prakerin: <?php echo e($p->idprakerin); ?> || NIS: <?php echo e($p->nisn); ?></option>    
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
                        <textarea class="form-control <?php if($errors->has('alamatpkl')): ?> is-invalid <?php endif; ?>" style="height: 100px;" name="alamatpkl" id="alamatpkl" placeholder="" readonly><?php echo e(old('alamatpkl')); ?></textarea>

                            <label for="alamatpkl">Alamat PKL/Industri</label>
                            <?php if($errors->has('alamatpkl')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('alamatpkl')); ?>

                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <?php else: ?>
                        <div class="form-floating mb-3 col-md-10">
                            <input type="text" class="form-control <?php if($errors->has('prakerin')): ?> is-invalid <?php endif; ?>" name="prakerin" id="prakerinSiswa" placeholder="" value="<?php echo e($prakerin->idprakerin); ?>" readonly>
                            <label for="prakerinSiswa">prakerin</label>
                            <?php if($errors->has('prakerin')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('prakerin')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-floating mb-3 col-md-8">
                                                    <input type="text" class="form-control <?php if($errors->has('nisn')): ?> is-invalid <?php endif; ?>" name="nisn" id="nisn" placeholder="" value="<?php echo e($prakerin->nisn); ?>" readonly>
                                                    <label for="nisn">NIS Siswa</label>
                                                    <?php if($errors->has('nisn')): ?> 
                                                    <div class="invalid-feedback">
                                                        <?php echo e($errors->first('nisn')); ?>

                                                    </div>
                                                    <?php endif; ?>
                                                </div>

                        <div class="form-floating mb-3 col-md-8">
                                                    <input type="text" class="form-control <?php if($errors->has('namasiswa')): ?> is-invalid <?php endif; ?>" name="namasiswa" id="namasiswa" placeholder="" value="<?php echo e($prakerin->nama_siswa); ?>" readonly>
                                                    <label for="namasiswa">Nama Siswa</label>
                                                    <?php if($errors->has('namasiswa')): ?> 
                                                    <div class="invalid-feedback">
                                                        <?php echo e($errors->first('namasiswa')); ?>

                                                    </div>
                                                    <?php endif; ?>
                                                </div>

                        <div class="form-floating mb-3 col-md-8">
                            <input type="text" class="form-control <?php if($errors->has('namapkl')): ?> is-invalid <?php endif; ?>" name="namapkl" id="namapkl" placeholder="" value="<?php echo e($prakerin->nama_pkl); ?>" readonly>
                            <label for="namapkl">Nama PKL/Industri</label>
                            <?php if($errors->has('namapkl')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('namapkl')); ?>

                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="form-floating mb-3 col-md-8">
                        <textarea name="alamatpkl" id="alamatpkl" class="form-control <?php if($errors->has('alamatpkl')): ?> is-invalid <?php endif; ?>" cols="50" style="height: 100px;" placeholder="" rows="10" readonly><?php echo e($prakerin->alamat_pkl); ?></textarea>
                            <label for="alamatpkl">Alamat PKL/Industri</label>
                            <?php if($errors->has('alamatpkl')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('alamatpkl')); ?>

                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <?php endif; ?>


                        <div class="form-floating mb-3 col-md-10">
                            <input type="text" class="form-control <?php if($errors->has('nama_instruktur')): ?> is-invalid <?php endif; ?>" name="nama_instruktur" id="nama_instruktur" placeholder="" value="<?php if(old('nama_instruktur')){ echo old('nama_instruktur'); }else{ echo $surat->nama_instruktur; } ?>">
                            <label for="nama_instruktur">Nama Instruktur</label>
                            <?php if($errors->has('nama_instruktur')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('nama_instruktur')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group mb-3 col-md-6">
                            <label for="tahunPelajaran">Tahun Pelajaran</label>
                         <select class="form-select <?php if($errors->has('tahunPelajaran')): ?> is-invalid <?php endif; ?>" name="tahunPelajaran" id="tahunPelajaran" >
                            <option value="" selected disabled hidden>Pilih Tahun Pelajaran</option>
                            <?php if($surat->tahun_pelajaran): ?>
                                <option value="<?php echo e($surat->tahun_pelajaran); ?>" selected><?php echo e($surat->tahun_pelajaran); ?></option>
                            <?php endif; ?>
                            </select>
                            <?php if($errors->has('tahunPelajaran')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('tahunPelajaran')); ?>

                            </div>
                            <?php endif; ?>
                                        </div>


                        <div class="form-floating mb-3 col-md-6" >
                            <input type="number" class="form-control <?php if($errors->has('tahun')): ?> is-invalid <?php endif; ?>" name="tahun" id="tahun" placeholder="" value="<?php if(old('tahun')){ echo old('tahun'); }else{ echo $surat->tahun; } ?>">
                            <label for="tahun">Tahun</label>
                            <?php if($errors->has('tahun')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('tahun')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group mb-3 col-md-6">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control <?php if($errors->has('tanggal')): ?> is-invalid <?php endif; ?>" value="<?php if(old('tanggal')){ echo old('tanggal'); }else{ echo date('Y-m-d'); } ?>">
                            <?php if($errors->has('tanggal')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('tanggal')); ?>

                            </div>
                            <?php endif; ?>
                                        </div>

                         
                       

                       

                        <div class="form-group mb-3 col-md-7">
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
                            <input type="submit" value="ubah Jurnal PKL" class="btn btn-primary">
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
                url: '/Admin/JurnalPKL/prakerin/' + prakerin,
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
            $('#namasiswa').val('');
        }


        $('#prakerin').change(function(){
            var prakerin = $(this).val();
            if(prakerin){
            $.ajax({
                url: '/Admin/JurnalPKL/prakerin/' + prakerin,
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
            $('#namasiswa').val('');
        }
        });
        var currentYear = new Date().getFullYear();
        for (var i = 0; i < 2; i++) {
    var startYear = currentYear + i;
    var endYear = startYear + 1;
    var optionText = startYear + '/' + endYear;
   
    if (!$('#tahunPelajaran option[value="' + optionText + '"]').length) {
        $('#tahunPelajaran').append('<option value="' + optionText + '">' + optionText + '</option>');
    }
}
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\jurnalPKL\edit.blade.php ENDPATH**/ ?>