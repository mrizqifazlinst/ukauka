<h1 class="mt-4 ms-3">Data Peminjaman</h1>
<br>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Gambar</th>
                <th>Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Status Peminjaman</th>
                <th>Aksi</th>

            </tr>
            <?php
            // require("koneksi.php");
            $i = 1;
            $query = mysqli_query($koneksi, "SELECT*FROM peminjaman LEFT JOIN user on user.id_user = peminjaman.id_user LEFT JOIN buku on buku.id_buku = peminjaman.id_buku");
            while ($data = mysqli_fetch_array($query)) {
            ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <td><img style="width: 100px;" src="assets/img/<?php echo $data['gambar']; ?>"></td>
                    <td><?php echo $data['judul']; ?></td>
                    <td><?php echo $data['tanggal_peminjaman']; ?></td>
                    <td><?php echo $data['tanggal_pengembalian']; ?></td>
                    <td><?php echo $data['status_peminjaman']; ?></td>
                    <td>
                        <a href="user/peminjaman_ubah.php?id=<?php echo $data['id_peminjaman']; ?>" class="btn btn-info mb-1">Ubah</a>

                        <a onclick="return confirm('Apakah Anda ingin menghapus Buku ini?');" href="user/peminjaman_hapus.php?id=<?php echo $data['id_peminjaman']; ?>" class="btn btn-info text-white" style="background-color: red; border-color:red;">Hapus</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>