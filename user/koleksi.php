<?php
require_once("../koneksi.php");
if ($_SESSION['user']['level'] !== 'peminjam') {
    header("Location:../404.php");
}
$id_user = $_SESSION['user']['id_user'];
$query = mysqli_query($koneksi, "SELECT buku.*,koleksi.id_koleksi, koleksi.id_buku, user.id_user FROM buku INNER JOIN koleksi ON koleksi.id_buku = buku.id_buku INNER JOIN user ON user.id_user = koleksi.id_user");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Perpustakaan Digital</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/user.css">
    <style>
        .card {
            width: 18rem;
            margin-bottom: 20px;
        }

        .card img {
            height: 300px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg py-3 bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="user.php">
                <img src="../assets/img/lope-removebg-preview.png" height="50" width="50" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="user.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="buku_user.php">Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="koleksi.php">Koleksi Pribadi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="buku_pinjam.php">Peminjaman</a>
                    </li>
                </ul>
                <div class="d-flex nav-link">
                    <a href="../user/logout_user.php" class="btn btn-danger">Log Out</a>
                </div>
            </div>
        </div>
    </nav>
    <br>
    <h3 class="ms-5 fw-bold" style="font-family: sans-serif;">Koleksi Anda</h3>
    <section id="Buku" class="d-flex mt-5 gap-5 ms-5">
        <?php while ($buku = mysqli_fetch_assoc($query)) : ?>
            <div class="card" style="width: 14rem;">
                <img src='../assets/img/<?php echo $buku['gambar']; ?>' class='image-top' height="260" alt=''>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $buku['judul']; ?></h5>
                    <p class="card-text"><?php echo $buku['tahun_terbit']; ?></p>
                    <p class="card-text">Penerbit: <?php echo $buku['penerbit']; ?></p>
                    <a href='buku_detail.php?id=<?php echo $buku['id_buku']; ?>' class="btn btn-primary">Lihat</a>
                    <a onclick="return confirm('Ingin Menghapus dari koleksi?');" href="koleksi_hapus.php?id=<?php echo $buku['id_koleksi']; ?>" class="btn btn-info text-white" style="background-color: red; border-color:red;">Hapus</a>
                </div>
            </div>
        <?php endwhile; ?>
    </section>
    <br>
    <br>
    <section class="bg-light border-top mt-5">
        <div class="container py-5">
            <div class="d-flex justify-content-between">
                <div>
                    BooksVerse
                </div>
                <div class="d-flex">
                    <p class="me-4">Syarat & Ketentuan</p>
                    <p>
                    <p class="text-decoration-none text-dark">Kebijakan Privacy</p>
                    </p>

                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>