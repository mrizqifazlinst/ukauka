<h1 class="mt-4">Buku</h1>
<div class="card">
    <br>
    <div class="row">
        <div class="col-md-12">
            <form method="post" enctype="multipart/form-data">
                <?php
                $id = $_GET['id'];

                // Mendapatkan data buku sebelum menampilkan formulir
                $query = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku=$id");
                $data = mysqli_fetch_array($query);

                // Pastikan form telah disubmit
                if (isset($_POST['submit'])) {
                    // Ambil data dari formulir
                    $id_kategori = $_POST['id_kategori'];
                    $judul = $_POST['judul'];
                    $penulis = $_POST['penulis'];
                    $penerbit = $_POST['penerbit'];
                    $tahun_terbit = $_POST['tahun_terbit'];
                    $deskripsi = $_POST['deskripsi'];

                    // Periksa apakah gambar diunggah
                    if ($_FILES['gambar']['name'] !== "") {
                        $gambar = $_FILES['gambar']['name'];
                        $ekstensi_diperbolehkan = array('png', 'jpg');
                        $x = explode('.', $gambar);
                        $ekstensi = strtolower(end($x));
                        $file_tmp = $_FILES['gambar']['tmp_name'];
                        $angka_acak = rand(1, 999);
                        $nama_gambar_baru = $angka_acak . '-' . $gambar;

                        if (in_array($ekstensi, $ekstensi_diperbolehkan)) {
                            if (move_uploaded_file($file_tmp, 'assets/img/' . $nama_gambar_baru)) {
                                // Gunakan prepared statement untuk update data buku
                                $query = mysqli_prepare($koneksi, "UPDATE buku SET id_kategori=?, judul=?, gambar=?, penulis=?, penerbit=?, tahun_terbit=?, deskripsi=? WHERE id_buku=?");
                                mysqli_stmt_bind_param($query, 'issssssi', $id_kategori, $judul, $nama_gambar_baru, $penulis, $penerbit, $tahun_terbit, $deskripsi, $id);

                                if (mysqli_stmt_execute($query)) {
                                    echo '<script>alert("Ubah Buku Berhasil"); location.href="?page=buku";</script>';
                                } else {
                                    echo '<script>alert("Ubah Buku Gagal");</script>';
                                }

                                mysqli_stmt_close($query);
                            } else {
                                echo '<script>alert("Gagal memindahkan file");</script>';
                            }
                        } else {
                            echo '<script>alert("Ekstensi gambar hanya bisa jpg dan png!");</script>';
                        }
                    } else {
                        // Jika gambar tidak diunggah, gunakan query tanpa mengubah gambar
                        $query = mysqli_prepare($koneksi, "UPDATE buku SET id_kategori=?, judul=?, penulis=?, penerbit=?, tahun_terbit=?, deskripsi=? WHERE id_buku=?");
                        mysqli_stmt_bind_param($query, 'isssssi', $id_kategori, $judul, $penulis, $penerbit, $tahun_terbit, $deskripsi, $id);

                        if (mysqli_stmt_execute($query)) {
                            echo '<script>alert("Ubah Buku Berhasil"); location.href="?page=buku";</script>';
                        } else {
                            echo '<script>alert("Ubah Buku Gagal");</script>';
                        }

                        mysqli_stmt_close($query);
                    }

                    // Tutup koneksi database setelah selesai menggunakan
                    mysqli_close($koneksi);
                }
                ?>

                <div class="row mb-3">
                    <div class="col-md-4 ms-4">Kategori</div>
                    <div class="col-md-7">
                        <select name="id_kategori" class="form-control">
                            <?php
                            $kat = mysqli_query($koneksi, "SELECT * FROM kategori");
                            while ($kategori = mysqli_fetch_array($kat)) {
                            ?>
                                <option <?php if ($kategori['id_kategori'] == $data['id_kategori']) echo 'selected'; ?> value="<?php echo $kategori['id_kategori']; ?>"><?php echo $kategori['kategori']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 ms-4">Judul</div>
                    <div class="col-md-7"><input type="text" value="<?php echo $data['judul']; ?>" class="form-control" autocomplete="off" name="judul"></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 ms-4">Gambar</div>
                    <div class="col-md-7"><input type="file" class="form-control" name="gambar"></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 ms-4">Penulis</div>
                    <div class="col-md-7"><input type="text" value="<?php echo $data['penulis']; ?>" class="form-control" autocomplete="off" name="penulis"></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 ms-4">Penerbit</div>
                    <div class="col-md-7"><input type="text" value="<?php echo $data['penerbit']; ?>" class="form-control" autocomplete="off" name="penerbit"></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 ms-4">Tahun Terbit</div>
                    <div class="col-md-7"><input type="text" value="<?php echo $data['tahun_terbit']; ?>" class="form-control" autocomplete="off" name="tahun_terbit"></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 ms-4">Deskripsi</div>
                    <div class="col-md-6">
                        <textarea name="deskripsi" rows="4" class="form-control"><?php echo $data['deskripsi']; ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-8 mb-3" style="margin-left: 35.5%;">
                        <button type="submit" class="btn btn-primary" name="submit" value="submit">Simpan</button>
                        <input type="reset" class="btn btn-secondary" value="Reset">
                        <a href="?page=buku" class="btn btn-danger">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>