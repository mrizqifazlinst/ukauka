<?php
require_once("../koneksi.php");

if (isset($_SESSION['user']) && $_SESSION['user']['level'] === 'peminjam') {
    $id_akun = $_SESSION['user']['id_user'];
    $id_buku = $_GET['id']; // Periksa apakah parameter 'id' telah diberikan dengan benar
    $ulasan = $_POST['deskripsi']; // Pastikan deskripsi telah diberikan melalui metode POST
    $rating = $_POST['rating']; // Pastikan rating telah diberikan melalui metode POST

    // Perbaiki query dengan menghilangkan tanda $ yang tidak perlu pada $id_buku
    $query = mysqli_query($koneksi, "INSERT INTO ulasan (id_user, id_buku, ulasan, rating) VALUES ('$id_akun', '$id_buku', '$ulasan', '$rating')");

    if ($query) {
        echo '<script>location.href="buku_detail.php?id=' . $id_buku . '";</script>'; // Perbaiki parameter pada location.href
    } else {
        echo "Gagal menambahkan ulasan: " . mysqli_error($koneksi);
    }
} else {
    header("Location:../404.php");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah melakukan redirect
}
