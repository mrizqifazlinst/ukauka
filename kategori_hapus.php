<?php
$id = $_GET['id'];
mysqli_query($koneksi, "SET FOREIGN_KEY_CHECKS=0");
$query = mysqli_query($koneksi, "DELETE FROM kategori WHERE id_kategori=$id");
mysqli_query($koneksi, "SET FOREIGN_KEY_CHECKS=1");
?>
<script>
    alert('Hapus Kategori Berhasil')
    location.href ="index.php?page=kategori";
</script>