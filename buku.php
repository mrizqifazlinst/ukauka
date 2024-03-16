<h1 class="mt-4"> Buku</h1>
<br>
<div class="row">
    <div class="col-md-12">
        <a href="?page=buku_tambah" class="btn btn-primary mb-3">+ Tambah Buku</a>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Judul</th>
                <th>Gambar</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
            <?php
            $i = 1;
            $query = mysqli_query($koneksi, "SELECT buku.*, kategori.kategori FROM buku LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori");
            while ($data = mysqli_fetch_array($query)) {
            ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $data['kategori']; ?></td>
                    <td><?php echo $data['judul']; ?></td>
                    <td><img style="width: 120px;" src="assets/img/<?php echo $data['gambar']; ?>"></td>
                    <td><?php echo $data['penulis']; ?></td>
                    <td><?php echo $data['penerbit']; ?></td>
                    <td><?php echo $data['tahun_terbit']; ?></td>
                    <td><?php echo $data['deskripsi']; ?></td>


                    <td>
                        <a href="?page=buku_ubah&id=<?php echo $data['id_buku']; ?>" class="btn btn-info mb-1">Ubah</a>
                        <a onclick="return confirm('Apakah Anda ingin menghapus Buku ini?');" href="?page=buku_hapus&id=<?php echo $data['id_buku']; ?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>