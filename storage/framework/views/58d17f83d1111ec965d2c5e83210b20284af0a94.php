
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
                        <h1 class="mb-0">Daftar Surat pengajuan & pengantar</h1>
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
                    <?php if(session('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                        <?php echo e(session('error')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif; ?>
                    <?php if(auth()->check() &&  (auth()->user()->hak_akses == '0') || auth()->guard('siswa')->check()): ?>
                    <div class="d-flex justify-content-end">
                        <style>
                            .button {
          position: relative;
          width: 150px;
          height: 40px;
          cursor: pointer;
          display: flex;
          align-items: center;
          border-radius: 10px;
          border: 1px solid #34974d;
          background-color: #3aa856;
        }
        
        .button, .button__icon, .button__text {
          transition: all 0.3s;
          border-radius: 10px;
        }
        
        .button .button__text {
          transform: translateX(30px);
          color: #fff;
          font-weight: 600;
          border-radius: 10px;
        }
        
        .button .button__icon {
          position: absolute;
          transform: translateX(109px);
          height: 100%;
          width: 39px;
          background-color: #34974d;
          display: flex;
          align-items: center;
          border-radius: 10px;
          justify-content: center;
        }
        
        .button .svg {
          width: 30px;
          border-radius: 10px;
          stroke: #fff;
        }
        
        .button:hover {
          background: #34974d;
          border-radius: 10px;
        }
        
        .button:hover .button__text {
          color: transparent;
          border-radius: 10px;
        }
        
        .button:hover .button__icon {
          width: 148px;
          transform: translateX(0);
          border-radius: 10px;
        }
        
        .button:active .button__icon {
          background-color: #2e8644;
          border-radius: 10px;
        }
        
        .button:active {
          border: 1px solid #2e8644;
          border-radius: 10px;
        }
                           </style>
        <a type="button" href="/Siswa/Pengajuan/tambah" class="button text-decoration-none">
            <span class="button__text">Tambah</span>
            <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" stroke="currentColor" height="24" fill="none" class="svg"><line y2="19" y1="5" x2="12" x1="12"></line><line y2="12" y1="12" x2="19" x1="5"></line></svg></span>
        </a>
                    </div>
                    <?php endif; ?>
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
                               </div>
                    <div class="table-responsive">
                    <table class="table-striped table table-bordered align-middle" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">Nomor</th>
                                <th class="text-center">Hari / Tanggal</th>
                                <th class="text-center">Tahun Pelajaran</th>
                                <th class="text-center">Industri /PKL</th>
                                <th class="text-center">File Pengajuan</th>
                                <th class="text-center">Surat Pengantar</th>
                                <?php if(auth()->check() && (auth()->user()->hak_akses == '0')): ?>
                                <th class="text-center">Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <?php
                        $no =1;
                        ?>
                        <tbody>
                            <?php $__currentLoopData = $surat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($u->id); ?></td>
                                    <?php
                                    $date = Carbon::parse($u->tanggal);
                                    $tanggal = $date->isoFormat('dddd, D MMMM');
                                    ?>
                                    <td class="text-center"><?php echo e($tanggal); ?></td>
                                    <td class="text-center"><?php echo e($u->tahun_pelajaran); ?></td>
                                    <td class="text-center"><?php echo e($u->nama_pkl); ?></td>
                                    <td class="text-center"><a href="/Siswa/Pengajuan/file/<?php echo e($u->id); ?>" target="_BLANK">Lihat FIle</a></td>
                                    <td>
                                         <?php if(auth()->check() && auth()->user()->hak_akses == '2'): ?>
        <?php if($u->suratPengantar == '0'): ?>
        Belum ada Surat Pengantar
        <?php else: ?>
        <a href="/Siswa/Pengantar/<?php echo e($u->id); ?>" target="_BLANK">Lihat file</a>
        <?php endif; ?>
    <?php elseif(auth()->check() && (auth()->user()->hak_akses == '0')): ?>
    
        <?php if($u->suratPengantar == '0'): ?>
            Belum ada Surat Pengantar, <a href="/Siswa/Admin/Pengantar/<?php echo e($u->id); ?>" onclick="return confirm('Tambahkan surat pengantar?')">Tambah?</a>
        <?php else: ?>
            <a href="/Siswa/Pengantar/<?php echo e($u->id); ?>" target="_BLANK">Lihat file</a>
        <?php endif; ?>
        <?php elseif(auth()->guard('pendamping')->check()): ?>
        <?php if($u->suratPengantar == '0'): ?>
        Belum ada Surat Pengantar
        <?php else: ?>
        <a href="/Siswa/Pengantar/<?php echo e($u->id); ?>" target="_BLANK">Lihat file</a>
        <?php endif; ?>
        
    <?php else: ?>
        <?php if($u->suratPengantar == '0'): ?>
            Belum ada Surat Pengantar
        <?php else: ?>
        <?php if(!session('berhasil')): ?>
        <script>
            var namaSiswa = '<?php echo e(auth()->guard("siswa")->user()->nama_siswa); ?>';
            var id = '<?php echo e($u->id); ?>';
            Swal.fire({
                icon: 'success',
                title: 'Selamat ' + namaSiswa + '!',
                text: 'kamu berhasil keterima di tempat magang!',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#5bc0de',
                confirmButtonText: 'Lihat Surat Pengantar',
                cancelButtonText: 'Tidak, terima kasih',
               
            }).then((result) => {
                if (result.isConfirmed) {
                  
                    window.location.href = '/Siswa/Pengantar/' + id;
                } else {
                  
                }
            });
        </script>
        <?php endif; ?>
        
        
            <a href="/Siswa/Pengantar/<?php echo e($u->id); ?>" target="_BLANK">Lihat file</a>
        <?php endif; ?>
    <?php endif; ?>
</td><?php if(auth()->check() && (auth()->user()->hak_akses == '0')): ?>

                                    <td class="text-center"> <form id="delete-form-<?php echo e($u->id); ?>" action="<?php echo e(route('pengajuan.destroy', $u->id)); ?>" method="POST" style="display: none;">
    <?php echo csrf_field(); ?>
    <?php echo method_field('DELETE'); ?>
    <button type="submit" class="btn btn-danger" id="delete-btn-<?php echo e($u->id); ?>" style="display: none;">Hapus</button>
</form>

<a href="#" class="btn btn-danger delete-user" data-id="<?php echo e($u->id); ?>">
    Hapus
</a> 
                                   <a href="/Siswa/Pengajuan/ubah/<?php echo e($u->id); ?>" class="btn-warning btn">Ubah</a> </td> <?php endif; ?>
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
        "order": [[ 0, "desc" ]],
        scrollCollapse: true,
        scrollY: '70vh',
        initComplete: function () {
            var columns = this.api().columns().header().toArray();
            var select = $('#columnSelect');
            var excludedColumns = ['Action', 'File Pengajuan']; 
           
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

    $('#columnSearch').on('keyup change', function() {
        var colIndex = $('#columnSelect').val();
        var searchTerm = this.value;
        

        if ($('#columnSelect option:selected').text() === 'Hari / Tanggal' && searchTerm) {
            var options = { weekday: 'long', day: 'numeric', month: 'long' };
            var formattedDate = new Date(searchTerm).toLocaleDateString('id-ID', options);
            table.column(colIndex).search(formattedDate).draw();
            $('#clearSearch').show();
        } else {
            table.column(colIndex).search(searchTerm).draw();
            $('#clearSearch').hide();
        }
    });

    $('#clearSearch').on('click', function() {
            $('#columnSearch').val('');
            table.column(1).search('').draw();
            $(this).hide(); 
        });

    $('#columnSelect').on('change', function() {
        var selectedText = $(this).find('option:selected').text();
        $('#columnSearch').val('');
        $('#clearSearch').hide();
        
        if (selectedText === 'Hari / Tanggal') {
            $('#columnSearch').attr('type', 'date');
        } else {
            $('#columnSearch').attr('type', 'text');
        }

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
<script>
    document.querySelectorAll('.delete-user').forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault(); 

            var userId = this.getAttribute('data-id');
          

            Swal.fire({
                icon: 'warning',
                title: 'Konfirmasi Hapus',
                text: 'Yakin akan dihapus surat permohonan dengan Id '+ userId  +'?',
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

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\SiswaLogin\surat.blade.php ENDPATH**/ ?>