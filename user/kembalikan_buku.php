<?php
include("../koneksi.php");

$query = mysqli_query($koneksi, "SELECT * FROM buku");
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
                <form method="post">
                    <?php
                    $id = $_GET['id'];
                    if (isset($_POST['submit'])) {

                        $id_user = $_SESSION['user']['id_user'];
                        $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
                        $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
                        $status_peminjaman = $_POST['status_peminjaman'];
                        $query = mysqli_query($koneksi, "UPDATE peminjaman set  tanggal_peminjaman='$tanggal_peminjaman', tanggal_pengembalian='$tanggal_pengembalian', status_peminjaman='$status_peminjaman' WHERE id_peminjaman=$id");

                        if ($query) {
                            echo '<script>alert("Ubah Berhasil"); location.href="buku_pinjam.php";</script>';
                        } else {
                            echo '<script>alert("Ubah Gagal");</script>';
                        }
                    }
                    $query = mysqli_query($koneksi, "SELECT*FROM peminjaman where id_peminjaman=$id");
                    $data = mysqli_fetch_array($query);
                    ?>
                    <div class="row mb-3">
                        <!-- <div class="col-md-4 ms-4">Buku</div>
                <div class="col-md-7">
                    <select name="id_buku" class="form-control">
                        <?php
                        $buk = mysqli_query($koneksi, "SELECT*FROM buku");
                        while ($buku = mysqli_fetch_array($buk)) {
                        ?>
                                <option <?php if ($buku['id_buku'] == $data['id_buku']) echo 'selected'; ?> value="<?php echo $buku['id_buku']; ?>"><?php echo $buku['judul']; ?></option>
                                <?php
                            }
                                ?>
                    </select>
                </div> -->
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 ms-4">Tanggal Peminjaman</div>
                        <div class="col-md-7">
                            <!-- Mengubah ukuran kolom menjadi 6 -->
                            <input type="date" class="form-control" value="<?php echo $data['tanggal_peminjaman']; ?>" name="tanggal_peminjaman" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 ms-4">Tanggal Pengembalian</div>
                        <div class="col-md-7"> <!-- Mengubah ukuran kolom menjadi 6 -->
                            <input type="date" class="form-control" value="<?php echo $data['tanggal_pengembalian']; ?>" max="<?php echo date('Y-m-d', strtotime('+18 days')); ?>" name="tanggal_pengembalian">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 ms-4">Status Peminjaman</div>
                        <div class="col-md-7">
                            <select name="status_peminjaman" class="form-control">
                                <option value="dipinjam" <?php if ($data['status_peminjaman'] == 'dipinjam') echo 'selected'; ?>>Di Pinjam </option>
                                <option value="dikembalikan" <?php if ($data['status_peminjaman'] == 'dikembalikan') echo 'selected'; ?>> Kembalikan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-8 mb-3" style="margin-left: 35.5%;">
                            <button type="submit" class="btn btn-primary" name="submit" value="submit">Simpan</button>
                            <!-- <button type="submit" class="btn btn-secondary">Reset</button> -->
                            <a href="buku_pinjam.php" class="btn btn-danger">Kembali</a>
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