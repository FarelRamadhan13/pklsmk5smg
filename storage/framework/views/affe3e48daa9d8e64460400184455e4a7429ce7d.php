
<?php $__env->startSection('content'); ?>
<br><br>
<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center">
            <h1>Contact Us</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h2>Nama Sekolah:</h2>
                    <p>SMK Negeri 3 Kendal</p>
                </div>
                <div class="col-md-6">
                    <h2>Alamat Sekolah:</h2>
                    <p>Jl. Limbangan No.Km. 1, Rejosari, Salamsari, Kec. Boja, Kabupaten Kendal, Jawa Tengah 51381</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h2>No telephone:</h2>
                    <p>(0294) 572623</p>
                </div>
            </div>
        </div>
    </div>
    <button onclick="showContactForm()" class="btn btn-primary">Contact Us</button>
</div>

<!-- Include SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Function to show SweetAlert with contact form
    function showContactForm() {
    Swal.fire({
        title: 'Contact Us',
        html: '<form id="contactForm"><div class="mb-3"><label for="name" class="form-label">Your Name:</label><input type="text" class="form-control" id="name" required></div></div><div class="mb-3"><label for="whatsapp" class="form-label">Your WhatsApp Number:</label><input type="text" class="form-control" id="whatsapp" required></div><div class="mb-3"><label for="message" class="form-label">Message:</label><textarea class="form-control" id="message" rows="5" required></textarea></div></form>',
        showCancelButton: true,
        confirmButtonText: 'Kirim',
        cancelButtonText: 'Batal',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            const name = document.getElementById('name').value;
            const whatsapp = document.getElementById('whatsapp').value;
            const message = document.getElementById('message').value;

          
            if (!name || !whatsapp || !message) {
                Swal.showValidationMessage('Tolong Isi semua terlebih dahulu');
            } else if (!isValidPhoneNumber(whatsapp)) {
                Swal.showValidationMessage('Tolong inputkan nomor Wa yang valid (e.g., 081234567890)');
            } else {
            
                return { name: name, whatsapp: whatsapp, message: message };
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const whatsappNumber = '+6281226372450'; 
            const messagee = 'Halo nama saya ' + result.value.name + ', saya memiliki pesan, ' + result.value.message;
            window.open('https://wa.me/' + whatsappNumber + '?text=' + encodeURIComponent(messagee), '_blank');
        }
    });
}

function isValidPhoneNumber(number) {
    const phoneRegex = /^08[0-9]{9,}$/; 
    return phoneRegex.test(number);
}

</script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\smk\pklsmk5smg\resources\views\contac.blade.php ENDPATH**/ ?>