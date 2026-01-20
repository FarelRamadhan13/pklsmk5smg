
<?php $__env->startSection('content'); ?>
<?php
use Carbon\Carbon;
?>
<div class="container">
    <div class="row justify-content-center align-items-center d-flex">
        <div class="col-md-9">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1>Daftar Kunjungan</h1>
                </div>
                <div class="card-body p-5">
                <?php if(session('berhasil')): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: '<?php echo e(session('berhasil')); ?>',
                showConfirmButton: false,
                timer: 3000 
            });
        });
    </script>
<?php endif; ?>
                    <?php if(auth()->user()): ?>
                    <div class="d-flex justify-content-end my-3">
                    <a href="<?php if(auth()->user()): ?> /Admin/Kunjungan/pdf <?php else: ?> /kepsek/Kunjungan/pdf <?php endif; ?>" target="_BLANK" class="btn btn-outline-secondary me-3">PDF</a> <?php if(!auth()->user()->hak_akses == '1'): ?><a href="/Admin/Kunjungan/Tambah" class="btn btn-primary">Tambah</a> <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <div class="table-responsive">
                    <table class="table-striped table-bordered table align-middle" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">Id Kunjungan</th>
                                <th class="text-center">Id Prakerin</th>
                                <th class="text-center">Id PKL</th>
                                <th class="text-center">Nama PKL</th>
                                <th class="text-center">Alamat PKL</th>
                                <th class="text-center">NIP</th>
                                <th class="text-center">Nama Guru</th>
                                <th class="text-center">Tanggal upload data</th>
                                <th class="text-center">File</th>
                                <?php if(auth()->check()): ?> <?php if(auth()->user()->hak_akses != '2'): ?><th class="text-center">Action</th> <?php endif; ?> <?php else: ?><th class="text-center">Action</th>  <?php endif; ?>
                            </tr>
                        </thead>
                        <?php
                        $no =1;
                        ?>
                        <tbody>
                            <?php $__currentLoopData = $kunjungan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($u->idkunjungan); ?></td>
                                    <td class="text-center"><?php echo e($u->idprakerin); ?></td>
                                    <td class="text-center"><?php echo e($u->idpkl); ?></td>
                                    <td class="text-center"><?php echo e($u->nama_pkl); ?></td>
                                    <td class="text-center"><?php echo e($u->alamat_pkl); ?></td>
                                    <td class="text-center"><?php echo e($u->nip); ?></td>
                                    <td class="text-center"><?php echo e($u->nama); ?></td>
                                    <?php 
                                    $date = Carbon::parse($u->tanggal);
                                    $tanggal = $date->isoFormat('D MMMM YYYY');
                                    ?>
                                    <td class="text-center"><?php echo e($tanggal); ?></td>
                                    <td class="text-center"><?php if($u->upload_data != null): ?> <?php if(auth()->user()): ?> <a href="<?php if(auth()->user()): ?> /Admin/Kunjungan/file/<?php echo e($u->upload_data); ?> <?php else: ?> /kepsek/Kunjungan/file/<?php echo e($u->upload_data); ?> <?php endif; ?>" target="_BLANK">Lihat file</a>   <?php else: ?> <a href="/Pendamping/Kunjungan/file/<?php echo e($u->upload_data); ?>" target="_BLANK">Lihat file</a> <?php endif; ?> <?php endif; ?></td>
                                    <?php if(auth()->check()): ?>
                                    <?php if(auth()->user()->hak_akses != '2'): ?>
                                    <td class="text-center">
    <form id="delete-form-<?php echo e($u->idkunjungan); ?>" action="<?php echo e(route('kunjungan.destroy', $u->idkunjungan)); ?>" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
        <button type="submit" class="btn btn-danger" id="delete-btn-<?php echo e($u->idkunjungan); ?>" style="display: none;">Hapus</button>
    </form>

    <a href="#" class="btn btn-danger delete-user" data-id="<?php echo e($u->idkunjungan); ?>" data-username="<?php echo e($u->nama); ?>">Hapus</a> 
        <a href="/Admin/Kunjungan/edit/<?php echo e($u->idkunjungan); ?>" class="btn btn-warning">Ubah</a>
    <?php endif; ?>
<?php else: ?>
    <?php if(auth()->guard('pendamping')->check()): ?>
        <td>
            <a href="/Pendamping/Kunjungan/edit/<?php echo e($u->idkunjungan); ?>" class="btn btn-warning">Ubah</a>
        </td>
    <?php endif; ?>
<?php endif; ?>

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
            "order": [[ 0, "desc" ]] 
        });
    });
</script>
<script>
    document.querySelectorAll('.delete-user').forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault(); 

            var userId = this.getAttribute('data-id');
            var username = this.getAttribute('data-username');

            Swal.fire({
                icon: 'warning',
                title: 'Konfirmasi Hapus',
                text: 'Yakin akan dihapus Data kunjungan dengan Nama Pendamping ' + username + '?',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + userId).submit();
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\kunjungan\index.blade.php ENDPATH**/ ?>