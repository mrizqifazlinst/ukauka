<!-- <h1 class="mt-4">Buku</h1>
<div class="card">
<br>
<div class="row">
    <div class="col-md-12">
        <form method="post">
        <?php
                if(isset($_POST['submit'])) {
                    $id_kategori = $_POST['id_kategori'];
                    $judul = $_POST['judul'];
                    $penulis = $_POST['penulis'];
                    $penerbit = $_POST['penerbit'];
                    $tahun_terbit = $_POST['tahun_terbit'];
                    $deskripsi = $_POST['deskripsi'];
                    $query = mysqli_query($koneksi, "INSERT INTO buku(id_kategori,judul,penulis,penerbit,tahun_terbit,deskripsi) values ('$id_kategori','$judul','$penulis','$penerbit','$tahun_terbit','$deskripsi')");

                    if($query){
                        echo '<script>alert("Tambah Kategori Berhasil");</script>';
                    }else{
                        echo '<script>alert("Tambah Kategori Gagal");</script>';
                    }
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
                <div class="col-md-4 ms-4"> judul</div>
                <div class="col-md-7"><input type="text" class="form-control" autocomplete="off" name="kategori"></div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-8 mb-3" style="margin-left: 35.5%;">
                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Simpan</button>
                    <button type="submit" class="btn btn-secondary">Reset</button>
                    <a href="?page=kategori" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
</div> -->