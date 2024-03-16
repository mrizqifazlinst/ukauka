<?php
$id = $_GET['id'];
mysqli_query($koneksi, "SET FOREIGN_KEY_CHECKS=0");
$query = mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku=$id");
mysqli_query($koneksi, "SET FOREIGN_KEY_CHECKS=1");
?>
<script>
    alert('Hapus Buku Berhasil')
    location.href ="index.php?page=buku";
</script>