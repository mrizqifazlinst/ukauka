<?php
include("../koneksi.php")
?>
<?php
$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM peminjaman WHERE id_peminjaman=$id");
?>
<script>
    alert('Hapus Buku Berhasil')
    location.href ="buku_pinjam.php";
</script>