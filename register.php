<?php
include "koneksi.php";
?>
<?php
if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $username = $_POST['username'];
    $level = $_POST['level'];
    $password = md5($_POST['password']);

    $insert = mysqli_query($koneksi, "INSERT INTO user(nama,email,alamat,username,password,level) VALUES('$nama','$email','$alamat','$username','$password','$level')");

    if ($insert) {
        echo '<script>alert("Register Berhasil"); location.href="login.php"</script>';
    } else {
        echo '<script>alert("Register Gagal")</script>';
    }
}
?>
<!Doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/img/lope-removebg-preview.png" sizes="64x64">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrit y="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="/style.css" rel="stylesheet">
    <title>Register Page</title>
</head>
<body>
    <nav class="navbar navbar-dark bg-danger fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">Perpustakaan</a>
            <div class="d-flex justify-content-end">
                <button class="btn btn-dark me-2" type="button">
                    <a class="text-light" style="text-decoration: none" href="index.php">HOME</a>
                </button>
            </div>
        </div>
    </nav>
    <div class="bg bg-light text-dark">
        <div class="container min-vh-100 d-flex align-items-center justify-content-center">
            <div class="card text-white bg-dark ma-5 shadow" style="min-width:25rem;">
                <div class="card-header fw-bold mt-5">Register</div>
                <div class="card-body">
                <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Nama lengkap</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NO. Telepon</label>
                            <input type="text" class="form-control" name="no_telepon" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" rows="5" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="username" class="form-control" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input class="form-control" id="inputPassword" name="password" type="password" required>
                        </div>
                        <div class="form-group" style="display: none;">
                                    <label class="small mb-1"></label>
                                    <select name="level" class="form-select py-1">
                                        <option value="peminjam">peminjam</option>
                                    </select>
                                </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" name="register" value="register">Register</button>
                        </div>
                    </form>
                    <p class="mt-2 mb-0">Do have an account? <a href="login.php" class="textprimary">Click here!</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></>
</body>

</html>