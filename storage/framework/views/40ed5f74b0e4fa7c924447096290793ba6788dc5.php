
<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center align-items-center d-flex">
        <div class="col-md-9">
            <div class="card mt-5">
                <div class="card-header text-center py-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="mb-0">Daftar jurusan</h1>
                    </div>
                </div>
                <div class="card-body p-5">
                <?php if(session('berhasil')): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '<?php echo e(session('berhasil')); ?>',
            showConfirmButton: false,
            timer: 3000 
        });
    </script>
<?php endif; ?>
                    <div class="d-flex justify-content-end my-3">
                        <a href="/Admin/Jurusan/Tambah" class="btn btn-primary">Tambah</a>
                    </div>
                    <div class="table-responsive">
                    <table class="table-striped table align-middle" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Nama Jurusan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <?php
                        $no =1;
                        ?>
                        <tbody>
                            <?php $__currentLoopData = $jurusan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($u->id_jurusan); ?></td>
                                    <td class="text-center"><?php echo e($u->nama_jurusan); ?></td>
                                 
                                   <td class="text-center"> <form id="delete-form-<?php echo e($u->id_jurusan); ?>" action="<?php echo e(route('jurusan.destroy', $u->id_jurusan)); ?>" method="POST" style="display: none;">
    <?php echo csrf_field(); ?>
    <?php echo method_field('DELETE'); ?>
    <button type="submit" class="btn btn-danger" id="delete-btn-<?php echo e($u->id_jurusan); ?>" style="display: none;">Hapus</button>
</form>

<a href="#" class="btn btn-danger delete-user" data-id="<?php echo e($u->id_jurusan); ?>" data-nama="<?php echo e($u->nama_jurusan); ?>">
    Hapus
</a>  <a href="/Admin/jurusan/edit/<?php echo e($u->id_jurusan); ?>" class="btn btn-warning">Ubah</a> </td>
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
            
        });
    });
</script>
<script>
    document.querySelectorAll('.delete-user').forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault(); 

            var userId = this.getAttribute('data-id');
            var nama = this.getAttribute('data-nama');

            Swal.fire({
                icon: 'warning',
                title: 'Konfirmasi Hapus',
                text: 'Yakin akan dihapus jurusan dengan nama ' + nama + '?',
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
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\jurusan\index.blade.php ENDPATH**/ ?>