<?php
include("../koneksi.php");
if ($_SESSION['user']['level'] !== 'peminjam') {
    header("Location:../index.php");
}

?>
<!DOCTYPE html>
<html lang="">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Perpustakaan Digital</title>

    <link rel="icon" type="image/png" href="assets/img/logo2.png" sizes="64x64">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/user.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg py-3 fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
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

    <div class="hero-title me-4">
        <h1 class="font">Perpustakaan Digital Anda</h1>
        <h6 class="font2">Jelajahi jurnal akademis, artikel, & buku dengan mudah di platform tunggal.</p>
    </div>
    
    <section id="hero">
        <div class="container text-center text-white">
        </div>
    </section>

    <!-- <section id="program" style="margin-top: -30px">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="bg-white rounded-3 p-0,5 shadow card align-items-center d-flex">
                    <h2 style="font-size: 36px;">
                        <?php
                        echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kategori"));
                        ?>
                    </h2>
                    <div>
                        <h4>Kategori</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="bg-white rounded-3 p-0,5 shadow card align-items-center d-flex">
                <h2 style="font-size: 36px;">
                        <?php
                        echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM buku"));
                        ?>
                    </h2>
                    <div>
                        <h4>Buku</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="bg-white rounded-3 p-0,5 shadow card align-items-center d-flex">
                <h2 style="font-size: 36px;">
                        <?php
                        echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM ulasan"));
                        ?>
                    </h2>
                    <div>
                        <h4>Ulasan</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="bg-white rounded-3 p-0,5 shadow card align-items-center d-flex">
                <h2 style="font-size: 36px;">
                        <?php
                        echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kategori"));
                        ?>
                    </h2>
                    <div>
                        <h4>Kategori</h4>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section> -->

    <section id="Buku" class="mt-4">
        <div class="container py-5">

            <div class="header-buku text-center">
                <h2 class="fw-bold">Buku-Buku Terbaru </h2>
            </div>

            <div class="row py-5">
                <div class="col-lg-4">
                    <div class="card border-0">
                        <img src="../assets/img/gambar.jpg" class="img-fluid mb-3" alt="">
                        <div class="konten-buku">
                            <p class="mb-3 text-secondary">24/01/2024</p>
                            <h4 class="fw-bold mb-3">Buku Terbaru Bulanan</h4>
                            <p class="text-secondary">bukuterbaru</p>
                            <a href="buku_user.php" class="text-decoration-none text-danger">selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-0">
                        <img src="../assets/img/gambar.jpg" class="img-fluid mb-3" alt="">
                        <div class="konten-buku">
                            <p class="mb-3 text-secondary">24/01/2024</p>
                            <h4 class="fw-bold mb-3">Buku Terbaru Bulanan</h4>
                            <p class="text-secondary">bukuterbaru</p>
                            <a href="buku_user.php" class="text-decoration-none text-danger">selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-0">
                        <img src="../assets/img/gambar.jpg" class="img-fluid mb-3" alt="">
                        <div class="konten-buku">
                            <p class="mb-3 text-secondary">24/01/2024</p>
                            <h4 class="fw-bold mb-3">Buku Terbaru Bulanan</h4>
                            <p class="text-secondary">bukuterbaru</p>
                            <a href="buku_user.php" class="text-decoration-none text-danger">selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-buku text-center">
                <a href="buku_user.php" class="btn btn-outline-danger">Buku Lainnya</a>
            </div>
        </div>
    </section>

    <section id="footer" class="bg-white">
        <div class="container py-4">
            <footer>
                <div class="row">
                    <div class="col-12 col-md-3 mb-3">
                        <h5 class="fw-bold mb-3">Navigasi</h5>
                        <div class="d-flex">
                            <ul class="nav flex-colum me-5">
                                <li class="nav-item mb-2"><a href="buku_user.php" class="nav-link p-0 text-muted">Buku Terbaru</a>
                                </li>
                                <li class="nav-item mb-2"><a href="buku_user.php" class="nav-link p-0 text-muted">Buku Terpopuler</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <h5 class="font-inter fw-bold mb-3">Follow Kami</h5>
                        <div class="d-flex mb-3">
                            <a href="" target="_blank" class="text-decoration-none text-dark">
                                <img src="../assets/logo/tiktok.png" height="30" width="30" class="me-4" alt="">
                            </a>
                            <a href="" target="_blank" class="text-decoration-none text-dark">
                                <img src="../assets/logo/ig.png" height="30" width="30" class="me-4" alt="">
                            </a>
                            <a href="" target="_blank" class="text-decoration-none text-dark">
                                <img src="../assets/logo/fb.png" height="30" width="30" class="me-4" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <h5 class="font-inter fw-bold mb-3">Kontak</h5>
                        <ul class="nav fllex-colum">
                            <li class="nav-item mb-2"><a href="" class="nav-link p-0 text-muted">info@perpus.sch.id</a></li>
                            <li class="nav-item mb-2"><a href="" class="nav-link p-0 text-muted">0831-6203-7362</a></li>
                        </ul>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <h5 class="font-inter fw-bold mb-3">Alamat</h5>
                        <p>Jl. Berlubang, No 111, Medan, Sumatera Utara.</p>
                    </div>
                </div>
            </footer>
        </div>
    </section>

    <section class="bg-light border-top">
        <div class="container py-4">
            <div class="d-flex justify-content-between">
                <div>
                    Perpustakaan Digital
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

    <script>
        const navbar = document.querySelector(".fixed-top");
        window.onscroll = () => {
            if (window.scrollY > 100) {
                navbar.classList.add("scroll-nav-active");
            } else {
                navbar.classList.remove("scroll-nav-active");
            }
        };
    </script>
</body>

</html>