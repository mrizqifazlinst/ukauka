<?php
include("../koneksi.php");
if ($_SESSION['user']['level'] !== 'peminjam') {
    header("Location:../404.php");
}
$query = mysqli_query($koneksi, "SELECT * FROM buku");



$id = $_GET['id'];

// Periksa apakah id_user ada di session
if(isset($_SESSION['user']['id_user'])) {
    $id_user = $_SESSION['user']['id_user'];

    if (isset($_POST['submit'])) {
        // Periksa apakah user sudah meminjam buku ini sebelumnya
        $cek = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE id_buku='$id' AND id_user='$id_user'");
        $jumlah = mysqli_num_rows($cek);

        if ($jumlah > 1) {
            echo '<script>alert("gagal, buku telah dipinjam sebelumnya");</script>';
        } else {
            $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
            $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
            $status_peminjaman = $_POST['status_peminjaman'];

            // Masukkan data peminjaman ke database
            $query = mysqli_query($koneksi, "INSERT INTO peminjaman(id_buku, id_user, tanggal_peminjaman, tanggal_pengembalian, status_peminjaman) VALUES ('$id', '$id_user', '$tanggal_peminjaman', '$tanggal_pengembalian', '$status_peminjaman')");

            if ($query) {
                echo '<script>alert("Peminjaman Berhasil"); location.href="buku_pinjam.php";</script>';
            } else {
                echo '<script>alert("Peminjaman Gagal");</script>';
            }
        }
    }
} else {
    echo "Session user tidak ditemukan.";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>BookVerse</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>

    <h1 class="mt-4">Peminjaman Buku</h1>
    <a href="../css/styles.css"></a>
    <div class="card">
        <br>
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="?id=<?php echo $id ?>">

                    <div class="row mb-3">
                        <div class="col-md-4 ms-4">Buku</div>
                        <div class="col-md-7">
                            <?php
                            $buk = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku=$id");
                            $buku = mysqli_fetch_array($buk);
                            ?>
                            <input class="form-control" type="text" value="<?php echo $buku['judul']; ?>" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 ms-4">Tanggal Peminjaman</div>
                        <div class="col-md-7"> <!-- Mengubah ukuran kolom menjadi 6 -->
                            <input type="date" class="form-control" name="tanggal_peminjaman" min="<?php echo date('Y-m-d', strtotime('0 days')); ?>" max="<?php echo date('Y-m-d', strtotime('+7 days')); ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 ms-4">Tanggal Pengembalian MAX (7Hari)</div>
                        <div class="col-md-7"> <!-- Mengubah ukuran kolom menjadi 6 -->
                            <input type="date" class="form-control" name="tanggal_pengembalian" min="<?php echo date('Y-m-d', strtotime('0 days')); ?>" max="<?php echo date('Y-m-d', strtotime('+7 days')); ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 ms-4">Status Peminjaman</div>
                        <div class="col-md-7">
                            <select name="status_peminjaman" class="form-control">
                                <option value="dipinjam">Di Pinjam</option>
                                <!-- <option value="dikembalikan">Di Kembalikan</option> -->
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-8 mb-3" style="margin-left: 35.5%;">
                            <button type="submit" class="btn btn-primary" name="submit" value="submit">Pinjam</button>
                            <button type="submit" class="btn btn-secondary">Reset</button>
                            <a href='buku_detail.php?id=<?php echo $buku['id_buku']; ?>' class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>