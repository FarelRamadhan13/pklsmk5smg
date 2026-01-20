
<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center align-items-center d-flex mt-5">
        <div class="col-md-7">
            <div class="card mt-5">
                <div class="card-header text-center py-4">
                    <h1>Ubah Nama instruktur</h1>
                </div>
                <div class="card-body p-5">
                    <?php if(session('gagal')): ?>
                    <div class="alert-danger alert text-center">
                        <?php echo e(session('gagal')); ?>

                    </div>
                    <?php endif; ?>
                    <div class="my-4">
                        <style>
                            .button {
                             display: flex;
                             height: 3em;
                             width: 100px;
                             align-items: center;
                             justify-content: center;
                             background-color: #eeeeee4b;
                             border-radius: 3px;
                             letter-spacing: 1px;
                             transition: all 0.2s linear;
                             cursor: pointer;
                             border: none;
                             background: #fff;
                             color: black
                            }
                            
                            .button > svg {
                             margin-right: 5px;
                             margin-left: 5px;
                             font-size: 20px;
                             transition: all 0.4s ease-in;
                            }
                            
                            .button:hover > svg {
                             font-size: 1.2em;
                             transform: translateX(-5px);
                            }
                            
                            .button:hover {
                             box-shadow: 9px 9px 33px #d1d1d1, -9px -9px 33px #ffffff;
                             transform: translateY(-2px);
                            }
                            
                            </style>
                            
                              <a class="button text-decoration-none mb-5" href="/Siswa/JurnalPKL">
                                                        <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024"><path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path></svg>
                                                        <span>Kembali</span>
                                                    </a>

                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
               

                        <div class="form-floating mb-3 col-md-10">
                            <input type="text" class="form-control <?php if($errors->has('nama_instruktur')): ?> is-invalid <?php endif; ?>" name="nama_instruktur" id="nama_instruktur" placeholder="" required value="<?php if(old('nama_instruktur')){ echo old('nama_instruktur'); }else{ echo $surat->nama_instruktur; } ?>">
                            <label for="nama_instruktur">Nama Instruktur</label>
                            <?php if($errors->has('nama_instruktur')): ?> 
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('nama_instruktur')); ?>

                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="d-flex justify-content-end mt-5">
                            <button type="submit" class="btn btn-warning"><i class="fas fa-user-edit"></i> Instruktur</button>
                           
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
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\SiswaLogin\editInstruktur.blade.php ENDPATH**/ ?>