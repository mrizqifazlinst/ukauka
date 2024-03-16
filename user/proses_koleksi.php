<?php
require_once("../koneksi.php");
if ($_SESSION['user']['level'] !== 'peminjam') {
    header("Location:../404.php");
}
if (isset($_GET['id'])) {
    $id_buku = $_GET['id'];
    $id_user = $_SESSION['user']['id_user'];

    // Lakukan pengecekan apakah buku sudah ada di koleksi pengguna
    $check_query = mysqli_query($koneksi, "SELECT * FROM koleksi WHERE id_buku = $id_buku AND id_user = $id_user");

    if (mysqli_num_rows($check_query) > 0) {
        // Jika buku sudah ada dalam koleksi pengguna, tampilkan pesan error
        echo '<script>location.href="buku_detail.php?id=' . $id_buku . '";</script>';
    } else {
        // Jika buku belum ada dalam koleksi pengguna, tambahkan buku ke koleksi
        $insert_query = mysqli_query($koneksi, "INSERT INTO koleksi (id_buku, id_user) VALUES ($id_buku, $id_user)");

        if ($insert_query) {
            echo '<script>location.href="koleksi.php";</script>';
        } else {
            // Jika gagal, beri pesan error
            echo "Gagal menambahkan buku ke koleksi Anda.";
        }
    }
} else {
    // Jika id buku tidak tersedia, beri pesan error
    echo "ID buku tidak valid.";
}
