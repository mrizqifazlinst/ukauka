<h1 class="mt-4">Buku</h1>
<div class="card">
<br>
<div class="row">
    <div class="col-md-12">
        <form method="post" enctype="multipart/form-data">
            <?php
                // Pastikan form telah disubmit
                if(isset($_POST['submit'])) {
                    // Ambil data dari formulir
                    $id_kategori = $_POST['id_kategori'];
                    $judul = $_POST['judul'];
                    $gambar = $_FILES['gambar']['name'];
                    $penulis = $_POST['penulis'];
                    $penerbit = $_POST['penerbit'];
                    $tahun_terbit = $_POST['tahun_terbit']; 
                    $deskripsi = $_POST['deskripsi']; 
                
                    // File Upload Handling
                    if($gambar !== "") {
                        // Tentukan ekstensi yang diperbolehkan
                        $ekstensi_diperbolehkan = array('png','jpg','jpeg');
                        // Ambil ekstensi file yang diunggah
                        $x = explode('.', $gambar);
                        $ekstensi = strtolower(end($x));
                        // Tentukan lokasi sementara file yang diunggah
                        $file_tmp = $_FILES['gambar']['tmp_name'];
                        // Generate nama unik untuk gambar baru
                        $angka_acak = rand(1, 999);
                        $nama_gambar_baru = $angka_acak.'-'.$gambar;
                
                        // Periksa apakah ekstensi file diizinkan
                        if(in_array($ekstensi, $ekstensi_diperbolehkan)) {
                            // Pindahkan file ke lokasi tujuan
                            if(move_uploaded_file($file_tmp, 'assets/img/'.$nama_gambar_baru)) {
                                // Persiapkan query untuk memasukkan data buku ke dalam database
                                $query = mysqli_prepare($koneksi, "INSERT INTO buku(id_kategori, judul, penulis, penerbit, tahun_terbit, deskripsi, gambar) VALUES (?, ?, ?, ?, ?, ?, ?)");
                                // Bind parameter ke statement SQL
                                mysqli_stmt_bind_param($query, 'sssssss', $id_kategori, $judul, $penulis, $penerbit, $tahun_terbit, $deskripsi, $nama_gambar_baru);

                                // Eksekusi statement SQL
                                if(mysqli_stmt_execute($query)) {
                                    echo '<script>alert("Tambah Buku Berhasil"); location.href="?page=buku";</script>';
                                } else {
                                    echo '<script>alert("Tambah Buku Gagal");</script>';
                                }
                                // Tutup statement
                                mysqli_stmt_close($query);
                            } else {
                                echo '<script>alert("Gagal memindahkan file");</script>';
                            }
                        } else {
                            echo '<script>alert("Ekstensi gambar hanya bisa jpg dan png!");</script>';
                        }
                    } else {
                        echo '<script>alert("Silahkan upload gambar dulu"); location.href="?page=buku_tambah";</script>';
                    }
                
                    // Tutup koneksi database
                    mysqli_close($koneksi);
                }
            ?>
            <div class="row mb-3">
                <div class="col-md-4 ms-4">Kategori</div>
                <div class="col-md-7">
                    <select name="id_kategori" class="form-control">
                        <?php
                            $kat = mysqli_query($koneksi, "SELECT*FROM kategori");
                            while($kategori = mysqli_fetch_array($kat)){
                                ?>
                                <option value="<?php echo $kategori['id_kategori'];?>"><?php echo $kategori['kategori'];?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 ms-4">Judul</div>
                <div class="col-md-7"><input type="text" class="form-control" autocomplete="off" name="judul"></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 ms-4">Gambar</div>
                <div class="col-md-7"><input type="file" class="form-control" name="gambar" ></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 ms-4">Penulis</div>
                <div class="col-md-7"><input type="text" class="form-control" autocomplete="off" name="penulis"></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 ms-4">Penerbit</div>
                <div class="col-md-7"><input type="text" class="form-control" autocomplete="off" name="penerbit"></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 ms-4">Tahun Terbit</div>
                <div class="col-md-7"><input type="text" class="form-control" autocomplete="off" name="tahun_terbit"></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 ms-4">Deskripsi</div>
                <div class="col-md-6">
                    <textarea name="deskripsi" id=""  rows="4" class="form-control"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-8 mb-3" style="margin-left: 35.5%;">
                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Simpan</button>
                    <button type="submit" class="btn btn-secondary">Reset</button>
                    <a href="?page=buku" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
</div>