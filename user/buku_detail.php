<?php
require_once("../koneksi.php");

if ($_SESSION['user']['level'] !== 'peminjam') {
    header("Location:../404.php");
}
$id = mysqli_real_escape_string($koneksi, $_GET['id']);
$query = mysqli_query($koneksi, "SELECT buku.*, kategori.kategori
FROM buku
INNER JOIN kategori ON buku.id_kategori = kategori.id_kategori WHERE buku.id_buku=$id;");
$buku = mysqli_fetch_assoc($query);

$check_query = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE id_buku = '$id' AND id_user = '{$_SESSION['user']['id_user']}'");
$is_borrowed = mysqli_num_rows($check_query) > 0;

$total_rating_query = mysqli_query($koneksi, "SELECT SUM(ulasan.rating) AS total_rating FROM ulasan WHERE id_buku ='$id' AND ulasan.rating IS NOT NULL");
$total_rating_row = mysqli_fetch_assoc($total_rating_query);
$total_rating = $total_rating_row['total_rating'];

$ulasan_query = mysqli_query($koneksi, "SELECT ulasan.rating FROM ulasan WHERE id_buku ='$id' AND ulasan.rating IS NOT NULL");
$jumlah_ulasan = mysqli_num_rows($ulasan_query);

while ($rating_row = mysqli_fetch_assoc($ulasan_query)) {
    $total_rating += $rating_row['rating'];
}

if ($jumlah_ulasan > 0) {
    $rata_rata_rating = $total_rating / $jumlah_ulasan;
    $rata_rata_rating = min($rata_rata_rating, 5);
} else {
    $rata_rata_rating = 0; // Jika tidak ada ulasan, rata-rata dianggap 0
}
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
        /* CSS untuk mengubah warna latar belakang tombol saat cursor hover */
        button:hover {
            background-color: yellow;
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

    <section id="" style="margin-top: 50px; margin-left:40px">
        <div class=" d-flex gap-5">
            <div class="card border-0">
                <img src="../assets/img/<?php echo $buku['gambar']; ?>" class="img-fluid" style="width: 3000px; height: auto%;" alt="">
                <br>
                <button onclick="window.location.href = 'peminjaman_tambah.php?id=<?php echo $buku['id_buku']; ?>';" style="border: 1px solid black; border-radius: 5px; padding: 5px 10px; color: black; margin-bottom: 10px; width:100px;">Pinjam</button>
                <button style="border: 1px solid black; border-radius: 5px; padding: 5px 10px; color: black;">
                    <a href="proses_koleksi.php?id=<?php echo $buku['id_buku']; ?>" style="text-decoration: none; color: inherit; width:10px;">+ Tambah Koleksi</a>
                </button>
            </div>

            <div class="ml-5" style="margin-left: 40px">
                <h2><?php echo $buku['judul']; ?></h2>
                <h6><?php echo $buku['penulis']; ?></h6>
                <br>
                <p>Rating :<?php echo number_format($rata_rata_rating, 1); ?></p>
                <p>Kategori: <?php echo $buku['kategori']; ?> </p>
                <p>Tahun terbit: <?php echo $buku['tahun_terbit']; ?> </p>
                <p>Penerbit: <?php echo $buku['penerbit']; ?></p>
                <h6>Tentang</h6>
                <p><?php echo $buku['deskripsi']; ?>
                </p>

                <!-- tambah ulasan -->
                <?php if ($is_borrowed) : ?>
                    <h5>Tambah Ulasan</h5>
                    <form id="formUlasan" action="tambah-ulasan.php?id=<?php echo $buku['id_buku']; ?>" method="post">
                        <div class="row mb-3">
                            <div class="col-md-4 ms-0">Rating :</div>
                            <div class="col-md-0">
                                <select name="rating" class="form-control">
                                    <option value="1">1 Bintang</option>
                                    <option value="2">2 Bintang</option>
                                    <option value="3">3 Bintang</option>
                                    <option value="4">4 Bintang</option>
                                    <option value="5">5 Bintang</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 ms-0"></div>
                            <div class="col-md-0">
                                <textarea name="deskripsi" rows="4" class="form-control"></textarea>
                            </div>
                        </div>
                        <button type="submit" style="border: 1px solid black; border-radius: 5px; padding: 5px 10px; color: black; margin-bottom: 10px;">Kirim Ulasan</button>
                    </form>
                <?php else : ?>
                    <p>Anda harus meminjam buku ini sebelum menambahkan ulasan.</p>
                <?php endif; ?>
            </div>
        </div>
        </div>
    </section>
    <br>

    <section class="isi-ulasan-container" id="ulasan">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h5>Ulasan</h5>
                    <div class="list-group">
                        <?php
                        $ulasan_query = mysqli_query($koneksi, "SELECT ulasan.ulasan, ulasan.rating, user.username FROM ulasan JOIN user ON ulasan.id_user = user.id_user WHERE id_buku ='$id' AND (ulasan.ulasan IS NOT NULL OR ulasan.rating IS NOT NULL)");
                        while ($ulasan = mysqli_fetch_assoc($ulasan_query)) {
                            echo '<div class="list-group-item mb-3 bg-light">';
                            echo '<h6 class="mb-1">' . $ulasan['username'] . '</h6>';

                            if (!empty($ulasan['ulasan'])) {
                                echo '<p class="mb-1">' . $ulasan['ulasan'] . '</p>';
                            }

                            if (!empty($ulasan['rating'])) {
                                echo '<p class="mb-1">Rating: ' . $ulasan['rating'] . '</p>';
                            }
                            echo '</div>'; // tutup list-group-item
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>