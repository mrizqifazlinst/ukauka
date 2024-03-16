buku pinjam ori
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

    <title>BookVerse</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/user.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg py-3 " style="background-color: #3C3633">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../assets/img/logo2.png" height="50" width="50" alt="">
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

    <h1 class="mt-4 ms-3">Pinjaman</h1>
    <br>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Buku</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status Peminjaman</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $i = 1;
                $query = mysqli_query($koneksi, "SELECT * FROM peminjaman LEFT JOIN user ON user.id_user = peminjaman.id_user LEFT JOIN buku ON buku.id_buku = peminjaman.id_buku WHERE peminjaman.id_user=" . $_SESSION['user']['id_user'] . " LIMIT $offset, $booksPerPage");
                while ($data = mysqli_fetch_array($query)) {
                ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><img style="width: 100px;" src="../assets/img/<?php echo $data['gambar']; ?>"></td>
                        <td><?php echo $data['judul']; ?></td>
                        <td><?php echo $data['tanggal_peminjaman']; ?></td>
                        <td><?php echo $data['tanggal_pengembalian']; ?></td>
                        <td><?php echo $data['status_peminjaman']; ?></td>
                        <td>
                            <?php
                            if ($data['status_peminjaman'] != 'dikembalikan') {
                            ?>
                                <a href="kembalikan_buku.php?id=<?php echo $data['id_peminjaman']; ?>" class="btn btn-info mb-1">Ubah</a>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>


buku user real
<?php
require_once("../koneksi.php");
if ($_SESSION['user']['level'] !== 'peminjam') {
    header("Location:../404.php");
}
$query = mysqli_query($koneksi, "SELECT * FROM buku");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>BookVerse</title>

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
    <nav class="navbar navbar-expand-lg py-3 " style="background-color: #3C3633">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../assets/img/logo2.png" height="50" width="50" alt="">
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

    <div style="margin-top: 50px; margin-left: 30%; display: flex">
        <div class="dropdown">
            <button class="btn btn-white dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Kategori</button>
            <ul class="dropdown-menu">
                <?php
                $query_kategori = mysqli_query($koneksi, "SELECT * FROM kategori");

                
                if ($query_kategori) {
                    while ($kategori = mysqli_fetch_assoc($query_kategori)) {
                ?>
                        <li><a class="dropdown-item" href="#"><?php echo $kategori['kategori']; ?></a></li>
                <?php
                    }
                } 
                ?>
            </ul>
        </div>

        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Cari disini" aria-label="Search" style="width:400px">
        </form>
    </div>


    <h3 class="d-flex ms-5 mt-5 fw-bold">Buku-Buku Terpopuler ></h3>

    <section id="Buku" class="d-flex justify-content-center mt-5 gap-5">
        <?php
        $counter = 0; // Inisialisasi counter untuk setiap tiga buku
        while ($buku = mysqli_fetch_assoc($query)) : ?>
            <div class="card" style="width: 14rem;">
                <img src='../assets/img/<?php echo $buku['gambar']; ?>' class='image-top' height="250" alt=''>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $buku['judul']; ?></h5>
                    <p class="card-text"><?php echo $buku['tahun_terbit']; ?></p>
                    <p class="card-text">Penerbit: <?php echo $buku['penerbit']; ?></p>
                    <a href='buku_detail.php?id=<?php echo $buku['id_buku']; ?>' class="btn btn-primary">Lihat</a>
                </div>
            </div>

            <?php
            $counter++;
            if ($counter % 4 == 0) {
                echo '</section><section id="Buku" class="d-flex justify-content-center mt-5 gap-5">';
            }
            ?>
        <?php endwhile ?>
    </section>

    <section class="bg-light border-top">
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

yg ubah
<?php
require_once("../koneksi.php");
if ($_SESSION['user']['level'] !== 'peminjam') {
    header("Location:../404.php");
}

$query = mysqli_query($koneksi, "SELECT * FROM buku");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>BookVerse</title>

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
    <nav class="navbar navbar-expand-lg py-3 " style="background-color: #3C3633">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../assets/img/logo2.png" height="50" width="50" alt="">
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

    <!-- <div style="margin-top: 50px; margin-left: 30%; display: flex">
        <div class="dropdown">
            <button class="btn btn-white dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Kategori</button>
            <ul class="dropdown-menu">
                <?php
                $query_kategori = mysqli_query($koneksi, "SELECT * FROM kategori");

                if ($query_kategori) {
                    while ($kategori = mysqli_fetch_assoc($query_kategori)) {
                ?>
                        <li><a class="dropdown-item" href="#"><?php echo $kategori['kategori']; ?></a></li>
                <?php
                    }
                }
                ?>
            </ul>
        </div>

        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Cari disini" aria-label="Search" style="width:400px">
        </form>
    </div> -->


    <h3 class="d-flex  mt-5 fw-bold" style="font-size: 25px; margin-left: 10cm; font-family: sans-serif;">Buku-Buku Terpopuler </h3>

    <section id="Buku" class="d-flex justify-content-center mt-3 gap-5">
        <?php
        $counter = 0; // Inisialisasi counter untuk setiap tiga buku
        while ($buku = mysqli_fetch_assoc($query)) : ?>
            <div class="card" style="width: 14rem;">
                <img src='../assets/img/<?php echo $buku['gambar']; ?>' class='image-top' height="250" alt=''>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $buku['judul']; ?></h5>
                    <p class="card-text"><?php echo $buku['tahun_terbit']; ?></p>
                    <p class="card-text">Penerbit: <?php echo $buku['penerbit']; ?></p>
                    <a href='buku_detail.php?id=<?php echo $buku['id_buku']; ?>' class="btn btn-primary">Lihat</a>
                </div>
            </div>

            <?php
            $counter++;
            if ($counter % 4 == 0) {
                echo '</section><section id="Buku" class="d-flex justify-content-center mt-5 gap-5">';
            }
            ?>
        <?php endwhile ?>
    </section>
    <br>
    <br>
    <br>
    <section class="bg-light border-top">
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