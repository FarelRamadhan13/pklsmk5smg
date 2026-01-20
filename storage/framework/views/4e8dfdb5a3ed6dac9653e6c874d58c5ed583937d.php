<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File</title>
</head>
<body>

<script>
    // Fungsi untuk mengunduh file dengan nama yang sesuai
    function downloadFile(url, fileName) {
        var link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', fileName);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>

<?php if(pathinfo($file, PATHINFO_EXTENSION) === 'pdf'): ?>
    <script>
        downloadFile("<?php echo e(asset('fileKunjungan/' . $file)); ?>", "FileKunjungan(<?php echo e($kunjungan->nama_pkl); ?>).pdf");
    </script>
<?php endif; ?>

<?php if(pathinfo($file, PATHINFO_EXTENSION) === 'docx'): ?>
    <script>

        downloadFile("<?php echo e(asset('fileKunjungan/' . $file)); ?>", "FileKunjungan(<?php echo e($kunjungan->nama_pkl); ?>).docx");
    </script>
<?php endif; ?>
<script>
    window.close();
</script>

</body>
</html><?php /**PATH D:\smk\pklsmk5smg\resources\views\kunjungan\file.blade.php ENDPATH**/ ?>