<h1 class="mt-4">Ulasan Buku</h1>
<br>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Buku</th>
                <th>Ulasan</th>
                <th>Rating</th>
                <!-- <th>Aksi</th> -->
            </tr>
            <?php
            $i = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM ulasan LEFT JOIN user on user.id_user = ulasan.id_user LEFT JOIN buku on buku.id_buku = ulasan.id_buku");
            while ($data = mysqli_fetch_array($query)) {
            ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <td><?php echo $data['judul']; ?></td>
                    <td><?php echo $data['ulasan']; ?></td>
                    <td><?php echo $data['rating']; ?></td>
                    <!-- <td>
                                <!-- <a href="?page=kategori_ubah&&id=<?php echo $data['id_ulasan']; ?>" class="btn btn-info">Ubah</a> -->
                    <!-- <a onclick="return confirm('Apakah Anda ingin menghapus Ulasan ini?');" href="?page=ulasan_hapus&&id=<?php echo $data['id_ulasan']; ?>" class="btn btn-danger">Hapus</a> -->
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>