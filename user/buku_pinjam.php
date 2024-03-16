<?php
        require_once("../koneksi.php");
        if ($_SESSION['user']['level'] !== 'peminjam') {
            header("Location:../404.php");
        }

        // Jumlah buku per halaman
        $booksPerPage = 5;

        // Halaman saat ini
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

        // Hitung offset
        $offset = ($currentPage - 1) * $booksPerPage;

        // Query untuk mengambil jumlah total buku yang dipinjam oleh pengguna
        $queryCount = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM peminjaman WHERE id_user=" . $_SESSION['user']['id_user']);
        $rowCount = mysqli_fetch_assoc($queryCount);
        $totalBooks = $rowCount['total'];

        // Hitung total halaman
        $totalPages = ceil($totalBooks / $booksPerPage);

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

    <h1 class="mt-4 ms-5 fw-bold" style="font-size: 30px; font-family: sans-serif;">Pinjaman Anda</h1>
    <br>
    <section id="Pinjam" class="d-flex justify-content-center mt-5 gap-5">
        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM peminjaman LEFT JOIN user ON user.id_user = peminjaman.id_user LEFT JOIN buku ON buku.id_buku = peminjaman.id_buku WHERE peminjaman.id_user=" . $_SESSION['user']['id_user'] . " LIMIT $offset, $booksPerPage");

        if (!$query) {
            die('Query Error: ' . mysqli_error($koneksi));
        }

        while ($data = mysqli_fetch_array($query)) {
        ?>
            <div class="mx-2">
                <div class="card" style="width: 14rem;">
                    <img src="../assets/img/<?php echo $data['gambar']; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $data['judul']; ?></h5>
                        <p class="card-text">Tanggal Peminjaman: <?php echo $data['tanggal_peminjaman']; ?></p>
                        <p class="card-text">Tanggal Pengembalian: <?php echo $data['tanggal_pengembalian']; ?></p>
                        <p class="card-text">Status Peminjaman: <?php echo $data['status_peminjaman']; ?></p>
                        <?php if ($data['status_peminjaman'] != 'dikembalikan') : ?>
                            <!-- <a href="kembalikan_buku.php?id=<?php echo $data['id_peminjaman']; ?>" class="btn btn-info mb-1 text-white">Ubah</a> -->
                        <?php endif; ?>
                        <!-- <a onclick="return confirm('Apakah Anda ingin Hapus Buku Dari Peminjaman?');" href="pinjam_hapus.php?id=<?php echo $data['id_peminjaman']; ?>" class="btn btn-info text-white" style="background-color: red; border-color:red;">Hapus</a> -->
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </section>

    <!-- Pagination -->
    <div class="row">
        <div class="col-md-12">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item <?php if ($i == $currentPage) echo 'active'; ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>

    <section class="bg-light border-top">
        <div class="container py-5">
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
</body>

</html>