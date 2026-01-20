
<?php $__env->startSection('content'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
<?php
use Carbon\Carbon;
?>
<style>
  
    @media (max-width: 767.98px) {
        #table {
            font-size: 12px;
        }
        #table th, #table td {
            padding: 0.5rem;
        }
    }
</style>
<div class="container">
    <div class="row justify-content-center align-items-center d-flex">
        <div class="col-md-9">
            <div class="card mt-5">
                <div class="card-header text-center py-3">
                    <h1 id="atas">Prakerin <?php echo e(auth()->guard('siswa')->user()->nama_siswa); ?></h1>
                </div>
                <?php if(auth()->guard('siswa')->check()): ?>
                <script>
                    function toTitleCase(str) {
          return str.toLowerCase().replace(/\b(\w)/g, function(match) {
              return match.toUpperCase();
          });
      }
                       
                        var studentNameElement = document.getElementById('atas');
                
  
                        var originalText = studentNameElement.innerHTML.replace('Prakerin ', '');
                        var titleCasedText = toTitleCase(originalText);
                
                       
                        studentNameElement.innerHTML = 'Prakerin ' + titleCasedText;
                    </script>
                <?php endif; ?>
                <div class="card-body p-5">
                    <?php if(session('berhasil')): ?>
                    <div class="alert-success alert text-center">
                        <?php echo e(session('berhasil')); ?>

                    </div>
                    <?php endif; ?>
                 
                    <div class="table-responsive">
                        <table class="table-striped table-bordered table align-middle" id="table">
                            <thead>
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th class="text-center">Id PKL</th>
                                    <th class="text-center">Nama PKL</th>
                                    <th class="text-center">Alamat PKL</th>
                                    <th class="text-center">NIS</th>
                                    <th class="text-center">Nama Siswa</th>
                                    <th class="text-center">Kelas</th>
                                    <th class="text-center">NIP</th>
                                    <th class="text-center">Nama Guru</th>
                                    <th class="text-center">Start</th>
                                    <th class="text-center">End</th>
                                    <th class="text-center">Tahun</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $prakerin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-center"><?php echo e($p->idprakerin); ?></td>
                                        <td class="text-center"><?php echo e($p->idpkl); ?></td>
                                        <td class="text-center"><?php echo e($p->nama_pkl); ?></td>
                                        <td class="text-center"><?php echo e($p->alamat_pkl); ?></td>
                                        <td class="text-center"><?php echo e($p->nisn); ?></td>
                                        <td class="text-center"><?php echo e($p->nama_siswa); ?></td>
                                        <td class="text-center"><?php echo e($p->kelas); ?></td>
                                        <td class="text-center"><?php echo e($p->nip); ?></td>
                                        <td class="text-center"><?php echo e($p->nama); ?></td>
                                        <?php
                                        $date = Carbon::parse($p->start);
                                        $tanggal = $date->isoFormat('D MMMM YYYY');
                                        ?>
                                        <td class="text-center"><?php echo e($tanggal); ?></td>
                                        <?php
                                        $end = Carbon::parse($p->end);
                                        $akhir = $end->isoFormat('D MMMM YYYY');
                                        ?>
                                        <td class="text-center"><?php echo e($akhir); ?></td>
                                        <td class="text-center"><?php echo e($p->tahun); ?></td>
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
    $(document).ready(function(){
        $('#table').DataTable({
            responsive: true,
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            columnDefs: [
                { responsivePriority: 1, targets: 0 }, // Id
                { responsivePriority: 2, targets: 1 }, // Id PKL
                { responsivePriority: 3, targets: 2 }, // Nama PKL
                { responsivePriority: 4, targets: 3 }, // Alamat PKL
                { responsivePriority: 5, targets: 4 }, // NIS
                { responsivePriority: 6, targets: 5 }, // Nama Siswa
                { responsivePriority: 7, targets: 6 }, // Kelas
                { responsivePriority: 8, targets: 7 }, // NIP
                { responsivePriority: 9, targets: 8 }, // Nama Guru
                { responsivePriority: 10, targets: 9 }, // Start
                { responsivePriority: 11, targets: 10 }, // End
                { responsivePriority: 12, targets: 11 } // Tahun
            ]
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\siswa\prakerin.blade.php ENDPATH**/ ?>