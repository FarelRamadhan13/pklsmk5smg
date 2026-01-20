
<?php $__env->startSection('content'); ?>
<?php
use Carbon\Carbon;
?>

<style>
   a.text-bawah {
            position: relative;
            text-decoration: none;
        }
        
        a.text-bawah::after {
            content: '';
            position: absolute;
            width: 0;
            height: 1px;
            display: block;
            margin-top: 2px;
            left: 0;
            background: #0033ff;
            transition: width 0.3s ease, left 0.3s ease;
        }

        a.text-bawah:hover::after {
            width: 100%;
            left: 0;
        }
</style>
<div class="container">
    <div class="row justify-content-center align-items-center d-flex">
        <div class="col-md-9">
            <div class="card mt-5">
                <div class="card-header text-center py-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="mb-0" id="atas"><?php if(auth()->guard('siswa')->check()): ?> Jurnal <?php echo e(auth()->guard('siswa')->user()->nama_siswa); ?> <?php else: ?> Daftar Jurnal Siswa <?php endif; ?></h1>
                    </div>
                </div>
                <?php if(auth()->guard('siswa')->check()): ?>
                <script>
                    function toTitleCase(str) {
          return str.toLowerCase().replace(/\b(\w)/g, function(match) {
              return match.toUpperCase();
          });
      }
                       
                        var studentNameElement = document.getElementById('atas');
                
  
                        var originalText = studentNameElement.innerHTML.replace('Jurnal ', '');
                        var titleCasedText = toTitleCase(originalText);
                
                       
                        studentNameElement.innerHTML = 'Jurnal ' + titleCasedText;
                    </script>
                <?php endif; ?>
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

                   
                     <?php if(auth()->check()): ?>
                     <?php if(auth()->user()->hak_akses == '0' || auth()->user()->hak_akses == '2'): ?>
                    <div class="d-flex justify-content-end">
                        <a href="/Siswa/JurnalPKL/status" class="btn btn-info me-3">Status</a>
                        <?php if(auth()->check() && auth()->user()->hak_akses == '0'): ?>
                        <a href="/Admin/JurnalPKL/Tambah" class="btn btn-primary">Tambah</a>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
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
.box {
  width: 140px;
  height: auto;
  float: left;
  transition: .5s linear;
  position: relative;
  display: block;
  overflow: hidden;
  padding: 15px;
  text-align: center;
  margin: 0 5px;
  background: transparent;
 
  
}

.box:before {
  position: absolute;
  content: '';
  left: 0;
  bottom: 0;
  height: 4px;
  width: 100%;
  border-bottom: 4px solid transparent;
  border-left: 4px solid transparent;
  box-sizing: border-box;
  transform: translateX(100%);
}

.box:after {
  position: absolute;
  content: '';
  top: 0;
  left: 0;
  width: 100%;
  height: 4px;
  border-top: 4px solid transparent;
  border-right: 4px solid transparent;
  box-sizing: border-box;
  transform: translateX(-100%);
}

.box:hover {
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
}

.box:hover:before {
  border-color: #0d6efd;
  height: 100%;
  transform: translateX(0);
  transition: .3s transform linear, .3s height linear .3s;
}

.box:hover:after {
  border-color: #0d6efd;
  height: 100%;
  transform: translateX(0);
  transition: .3s transform linear, .3s height linear .5s;
}

.boxx {
  color: #0033ff;
  text-decoration: none;
  cursor: pointer;
  outline: none;
  border: none;
  background: transparent;
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
                                <?php if(!auth()->guard('siswa')->check()): ?>
                                <th class="text-center">No</th>
                                <?php endif; ?>
                               
                                <th class="text-center">Absensi</th>
                               
                               
                                <th class="text-center">Kegiatan harian</th>
            
                                <th class="text-center">File</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Kelas</th>
                                <th class="text-center">Nama Siswa</th>
                                <th class="text-center">NIS Siswa</th>
                                <th class="text-center">Nama Industri</th>
                                <th class="text-center">Nama Instruktur</th>
                                <th class="text-center">Nama Guru pendamping</th>
                                <th class="text-center">Dibuat pada</th>
                                <th class="text-center">Tahun</th>
                                <?php if(auth()->guard('siswa')->check()): ?>
                                <th class="text-center">Action</th>
                                <?php endif; ?>
                               
                                <?php if(auth()->check() && auth()->user()->hak_akses == '0'): ?>
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
                                      <?php if(!auth()->guard('siswa')->check()): ?>
                                    <td class="text-center"><?php echo e($u->id); ?></td>
                                    <?php endif; ?>
                                   
                                    <td class="text-center"><a href="/Siswa/JurnalPKL/Absen/<?php echo e($u->id); ?>" class="box boxx"><i class="fas fa-user-check"></i></a></td>
                            
                                
                                    <td class="text-center"><a href="/Siswa/JurnalPKL/harian/<?php echo e($u->id); ?>" class="text-center box boxx"><i class="fas fa-calendar-alt"></i></a></td>
                               
                                <td class="text-center"><a href="/Siswa/JurnalPKL/lihat/<?php echo e($u->id); ?>" target="_BLANK" class="text-decoration-none"><i class="fa-solid fa-download"></i></a></td>
                                <td class="text-center"><?php if($u->start > $cek_hari): ?> <div class="alert alert-danger">Belum mulai</div>  <?php elseif($u->end < $cek_hari): ?> <div class="alert alert-light">Selesai</div> <?php else: ?> <div class="alert alert-primary">Berlangsung</div> <?php endif; ?></td>
                                    <td class="text-center"><?php echo e($u->kelas); ?></td>
                                    <td class="text-center"><?php echo e($u->nama_siswa); ?></td>
                                    <td class="text-center"><?php echo e($u->nisn); ?></td>
                                    <td class="text-center"><?php echo e($u->nama_pkl); ?></td>
                                    <td class="text-center"><?php echo e($u->nama_instruktur); ?></td>
                                    <td class="text-center"><?php echo e($u->nama); ?></td>
                                    <?php
                                    $date = Carbon::parse($u->tanggal);
                                    $tanggal = $date->isoFormat('dddd, D MMMM');
                                    ?>
                                    <td class="text-center"><?php echo e($tanggal); ?></td>
                                    <td class="text-center"><?php echo e($u->tahun); ?></td>
                                    <?php if(auth()->guard('siswa')->check()): ?>
                                    <td class="text-center">
                                        <a href="/Siswa/JurnalPKL/ubahInstruktur/<?php echo e($u->id); ?>" class="btn btn-warning">
                                            <i class="fas fa-user-edit"></i> Instruktur
                                        </a>
                                    </td>
                                    
                                <?php endif; ?>
                                    
                                    <?php if(auth()->check() && auth()->user()->hak_akses == '0'): ?>
                                    <td class="text-center"> <form id="delete-form-<?php echo e($u->id); ?>" action="<?php echo e(route('jurnal.destroy', $u->id)); ?>" method="POST" style="display: none;">
    <?php echo csrf_field(); ?>
    <?php echo method_field('DELETE'); ?>
    <button type="submit" class="btn btn-danger" id="delete-btn-<?php echo e($u->id); ?>" style="display: none;">Hapus</button>
</form>

<a href="#" class="btn btn-danger delete-user" data-id="<?php echo e($u->id); ?>" username="<?php echo e($u->nama_siswa); ?>">
    Hapus
</a>  <a href="/Admin/JurnalPKL/ubah/<?php echo e($u->id); ?>" class="btn btn-warning">Ubah</a> </td>
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
    var table = $('#table').DataTable({
        "order": [[ 0, "desc" ]],
        scrollCollapse: true,
        scrollY: '70vh',
         "deferRender": true,
         "pageLength": 10,
    "lengthMenu": [ 10, 25, 50, 75, 100 ], 
        initComplete: function () {
            var columns = this.api().columns().header().toArray();
            var select = $('#columnSelect');
            var excludedColumns = ['Action', 'File', 'Absensi', 'Kegiatan harian']; 
           
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
            table.column(11).search('').draw();
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

        if (selectedText === 'Action' || selectedText === 'Absensi') {
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
            var username = this.getAttribute('username');
          

            Swal.fire({
                icon: 'warning',
                title: 'Konfirmasi Hapus',
                text: 'Yakin akan dihapus Jurnal PKL dengan Nama Siswa '+ username  +'?',
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
<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\jurnalPKL\index.blade.php ENDPATH**/ ?>