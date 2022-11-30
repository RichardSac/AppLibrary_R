<?php
if (empty($_SESSION['username'])) {
    echo"<script>alert('Maaf, Untuk Akses Halaman Ini, anda harus login terlebih dahulu');
    document.location='index.php'</script>";
}
?>