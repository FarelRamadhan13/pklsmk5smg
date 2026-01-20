
<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row justify-content-center align-items-center d-flex">
        <div class="col-md-9">
            <div class="card mt-5">
                 <div class="card-header text-center py-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="mb-0">Daftar Users</h1>
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
                    <div class="d-flex justify-content-end">
                        <a href="/Admin/Users/Tambah" class="btn btn-primary">Tambah</a>
                    </div>
                    <div class="mb-5 row justify-content-center">
                        <div class="col-md-4 mt-3">
                            <select id="columnSelect" class="form-select mr-2"></select>
                        </div>
                        <div class="col-md-6 d-flex mt-2">
                            <style>
                                .ui-input-container {
  position: relative;
  width: 300px;
}

.ui-input {
  width: 100%;
  padding: 10px 10px 10px 40px;
  font-size: 1em;
  border: none;
  border-bottom: 2px solid #ccc;
  outline: none;
  background-color: transparent;
  transition: border-color 0.3s;
}

.ui-input:focus {
  border-color: #949494;
}

.ui-input-underline {
  position: absolute;
  bottom: 0;
  left: 0;
  height: 2px;
  width: 100%;
  background-color: #999999;
  transform: scaleX(0);
  transition: transform 0.3s;
}

.ui-input:focus + .ui-input-underline {
  transform: scaleX(1);
}

.ui-input-highlight {
  position: absolute;
  bottom: 0;
  left: 0;
  height: 100%;
  width: 0;
  background-color: rgba(171, 167, 255, 0.1);
  transition: width 0.3s;
}

.ui-input:focus ~ .ui-input-highlight {
  width: 100%;
}

.ui-input-icon {
  position: absolute;
  left: 10px;
  top: 50%;
  transform: translateY(-50%);
  color: #999;
  transition: color 0.3s;
}

.ui-input:focus ~ .ui-input-icon {
  color: #999999;
}

.ui-input-icon svg {
  width: 20px;
  height: 20px;
}

                            </style>
                            <div class="ui-input-container">
                                <input
                                  required=""
                                  placeholder="Type something..."
                                  class="ui-input"
                                  type="text"
                                  id="columnSearch"
                                />
                                <div class="ui-input-underline"></div>
                                <div class="ui-input-highlight"></div>
                                <div class="ui-input-icon">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path
                                      stroke-linejoin="round"
                                      stroke-linecap="round"
                                      stroke-width="2"
                                      stroke="currentColor"
                                      d="M21 21L16.65 16.65M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z"
                                    ></path>
                                  </svg>
                                </div>
                              </div>
                               </div>
                              
                            
                            <button id="clearSearch" class="btn btn-secondary" style="display: none;">Clear</button>
                        </div>
                    <div class="table-responsive">
                        <table class="table-striped table table-bordered align-middle" id="table">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Foto</th>
                                    <th class="text-center">Nama</th> 
                                    <th class="text-center">Username</th> 
                                    <th class="text-center">Hak Akses</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <?php
                            $no = 1;
                            ?>
                            <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-center"><?php echo e($no++); ?></td>
                                          <td class="text-center"><img src="<?php echo e(asset('storage/fotoProfileAdmin/' . $u->foto)); ?>" style="height: 70px; width: 70px;" class="rounded-circle" alt=""></td>
                                        <td class="text-center"><?php echo e($u->name); ?></td>
                                        <td class="text-center"><?php echo e($u->username); ?></td>
                                      
                                        <td class="text-center"><?php if($u->hak_akses == '1'): ?> Kepsek <?php elseif($u->hak_akses == '2'): ?> K3 <?php elseif($u->hak_akses == '0'): ?> Administrator <?php endif; ?></td>
                                        <td class="text-center"><?php if($u->status == 0): ?> Aktif <?php else: ?> Non Aktif <?php endif; ?></td>
                                        <td class="text-center">
                                            <?php if($u->id != auth()->user()->id): ?>
                                        <form id="delete-form-<?php echo e($u->id); ?>" action="<?php echo e(route('users.destroy', $u->id)); ?>" method="POST" style="display: none;">
    <?php echo csrf_field(); ?>
    <?php echo method_field('DELETE'); ?>
    <button type="submit" class="btn btn-danger" id="delete-btn-<?php echo e($u->id); ?>" style="display: none;">Hapus</button>
</form>


<a href="#" class="btn btn-danger delete-user" data-id="<?php echo e($u->id); ?>" data-username="<?php echo e($u->username); ?>">
    <i class="fas fa-trash"></i>
</a>
<?php endif; ?>

                                            <a href="/Admin/Users/edit/<?php echo e($u->id); ?>" class="btn btn-warning"><i class="fas fa-pencil"></i></a>
                                        </td>
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
       
        var table = $('#table').DataTable({
            "order": [[ 0, "asc" ]],
            scrollCollapse: true,
            scrollY: '70vh',
            initComplete: function () {
                var columns = this.api().columns().header().toArray();
                var select = $('#columnSelect');
                var excludedColumns = ['Action']; 
               
                for (var i = 0; i < columns.length; i++) {
                    var columnName = $(columns[i]).text();
                    if (!excludedColumns.includes(columnName)) {
                        select.append('<option value="' + i + '">' + columnName + '</option>');
                    }
                }
            }
        });

       
        $('#dt-search-0').hide();
        $('label[for="dt-search-0"]').hide();

      

        $('#columnSearch').on('keyup', function() {
            var colIndex = $('#columnSelect').val();
            var searchTerm = this.value;
            if (searchTerm) {
                table.column(colIndex).search(searchTerm).draw();
            } else {
                table.column(colIndex).search('').draw(); 
            }
        });

       $('#columnSelect').on('change', function() {
        var selectedText = $(this).find('option:selected').text();
        $('#columnSearch').val('');
        $('#columnSearch').attr('placeholder', 'Cari berdasarkan ' + selectedText.toLowerCase());

        if (selectedText === 'Action' || selectedText === 'Foto') {
            $('#columnSearch').prop('disabled', true).hide();
            table.search('').draw(); 
        } else {
            $('#columnSearch').prop('disabled', false).show();
        }

        table.search('').columns().search('').draw(); 
    }).trigger('change');
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.querySelectorAll('.delete-user').forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault(); 

            var userId = this.getAttribute('data-id');
            var username = this.getAttribute('data-username');

            Swal.fire({
                icon: 'warning',
                title: 'Konfirmasi Hapus',
                text: 'Yakin akan dihapus user dengan username ' + username + '?',
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

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\users\index.blade.php ENDPATH**/ ?>