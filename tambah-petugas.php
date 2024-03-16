<?php
if ($_SESSION['user']['level'] != 'admin') {
    header("Location: 404.php");
    exit;
}
require_once('koneksi.php');
if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $username = $_POST['username'];
    $level = $_POST['level'];
    $password = md5($_POST['password']);

    $level = 'petugas';

    $insert = mysqli_query($koneksi, "INSERT INTO user(nama,email,alamat,username,password,level) VALUES('$nama','$email','$alamat','$username','$password','$level')");
    if ($insert) {
        echo '<script>alert("Register Berhasil"); location.href="login.php"</script>';
    } else {
        echo '<script>alert("Register Gagal")</script>';
    }
}
?>
<form method="post">
    <p class="text-center h1 fw-bold mb-4 mx-1 mx-md-3 mt-3">Tambah Petugas</p>

    <div class="form-outline mb-4">
        <label class="form-label"> <i class="bi bi-person-circle"></i>Nama Lengkap</label>
        <input type="text" class="form-control form-control-lg py-3" name="nama" autocomplete="off" placeholder="Masukkan Nama" style="border-radius:25px ;" />
    </div>

    <div class="form-outline mb-4">
        <label class="form-label"> <i class="bi bi-person-circle"></i>Email</label>
        <input type="text" class="form-control form-control-lg py-3" name="email" autocomplete="off" placeholder="Masukkan Email" style="border-radius:25px ;" />
    </div>

    <div class="form-outline mb-4">
        <label class="form-label"> <i class="bi bi-person-circle"></i> Alamat</label>
        <textarea name="alamat" class="form-control form-control-lg py-3" placeholder="Masukkan Alamat" style="border-radius: 25px;"></textarea>
    </div>

    <!-- Email input -->
    <div class="form-outline mb-4">
        <label class="form-label" for="inputEmailAddress"> <i class="bi bi-person-circle"></i> Username</label>
        <input type="username" id="inputEmailAddress" class="form-control form-control-lg py-3" name="username" autocomplete="off" placeholder="Masukkan Username" style="border-radius:25px ;" />
    </div>

    <!-- Password input -->
    <div class="form-outline mb-4">
        <label class="form-label" for="inputPassword"><i class="bi bi-chat-left-dots-fill"></i> Password</label>
        <input type="password" id="inputPassword" class="form-control form-control-lg py-3" name="password" autocomplete="off" placeholder="Masukkan Password" style="border-radius:25px ;" />
    </div>


    <!-- Submit button -->
    <!-- <button type="submit" class="btn btn-primary btn-lg">Login in</button> -->
    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-1">
        <input type="submit" value="Register" name="register" class="btn btn-primary btn-lg text-light my-2 py-3" style="width:100% ; border-radius: 30px; font-weight:600;" />
    </div>
</form>