
<?php $__env->startSection('content'); ?>
<?php
use Carbon\Carbon;
?>

<div class="container">
    <div class="row justify-content-center align-items-center d-flex">
        <div class="col-md-9">
            <div class="card mt-5">
                <div class="card-header text-center py-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="mb-0">Status Prakerin</h1>
                    </div>
                </div>
                <div class="card-body p-5">
                    <?php if(session('berhasil')): ?>
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                Swal.fire({
                                    icon: 'success',
                                    text: '<?php echo e(session('berhasil')); ?>',
                                    showConfirmButton: false,
                                    timer: 3000 
                                });
                            });
                        </script>
                    <?php endif; ?>
                    
                    <div class="mt-0">
                        <style>
                            .kembali {
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
                            
                            .kembali > svg {
                             margin-right: 5px;
                             margin-left: 5px;
                             font-size: 20px;
                             transition: all 0.4s ease-in;
                            }
                            
                            .kembali:hover > svg {
                             font-size: 1.2em;
                             transform: translateX(-5px);
                            }
                            
                            .kembali:hover {
                             box-shadow: 9px 9px 33px #d1d1d1, -9px -9px 33px #ffffff;
                             transform: translateY(-2px);
                            }
                            
                            </style>
                            
                              <a class="kembali text-decoration-none" href="/Siswa/JurnalPKL">
                                                        <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024"><path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path></svg>
                                                        <span>Kembali</span>
                                                    </a>
                                                </div>

                    <div class="mb-3 row justify-content-center">
                        <div class="col-md-4 mt-3">
<select name="kelas" id="kelas" class="form-select">
    <option value="" disabled selected hidden>Pilih Kelas</option>
    <?php $__currentLoopData = $jurusan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php for($i = 1; $i <= 3; $i++): ?>
            <option value="X <?php echo e($k->nama_jurusan); ?> <?php echo e($i); ?>">X <?php echo e($k->nama_jurusan); ?> <?php echo e($i); ?></option>
        <?php endfor; ?>
        <?php for($i = 1; $i <= 3; $i++): ?>
            <option value="XI <?php echo e($k->nama_jurusan); ?> <?php echo e($i); ?>">XI <?php echo e($k->nama_jurusan); ?> <?php echo e($i); ?></option>
        <?php endfor; ?>
        <?php for($i = 1; $i <= 3; $i++): ?>
            <option value="XII <?php echo e($k->nama_jurusan); ?> <?php echo e($i); ?>">XII <?php echo e($k->nama_jurusan); ?> <?php echo e($i); ?></option>
        <?php endfor; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>


                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table-striped table table-bordered align-middle" id="table">
                            <thead>
                                <tr>
                                    <th class="text-center">Kelas</th>
                                    <th class="text-center">Belum Mulai</th>
                                    <th class="text-center">Berlangsung</th>
                                    <th class="text-center">Selesai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-center"><?php echo e($d['kelas']); ?></td>
                                        <td class="text-center"><?php if($d['jumlahBelumMulai'] != '0'): ?> <?php echo e($d['jumlahBelumMulai']); ?> Siswa <?php else: ?> Tidak ada <?php endif; ?></td>
                                        <td class="text-center"><?php if($d['jumlahBerlangsung'] != '0'): ?> <?php echo e($d['jumlahBerlangsung']); ?> Siswa <?php else: ?> Tidak ada <?php endif; ?></td>
                                        <td class="text-center"><?php if($d['jumlahSelesai'] != '0'): ?> <?php echo e($d['jumlahSelesai']); ?> Siswa <?php else: ?> Tidak ada <?php endif; ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
   $(document).ready(function() {

    // Initialize Select2 with multiple selection enabled
    $('#kelas').select2({
        placeholder: 'Pilih Kelas',
        allowClear: true,
        multiple: true // Enable multiple selections
    });

    // Initialize DataTable
    var table = $('#table').DataTable({
        "order": [[0, "desc"]],
        "deferRender": true,
        scrollCollapse: true,
        scrollY: '70vh',
        "paging": true,
        "pageLength": 10,
        "lengthMenu": [10, 25, 50, 75, 100],
    });

    $('#dt-search-0').hide();
    $('label[for="dt-search-0"]').hide();

    // Filter table based on selected classes
    $('#kelas').on('change', function() {
        var selectedClasses = $(this).val(); // Get all selected classes as an array
        $.fn.dataTable.ext.search.pop(); // Clear previous filters

        if (selectedClasses && selectedClasses.length > 0) {
            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                return selectedClasses.includes(data[0]); // Check if the row's class is in the selected classes
            });
        }
        table.draw();
    });
});


</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\tb_prakerin\status.blade.php ENDPATH**/ ?>