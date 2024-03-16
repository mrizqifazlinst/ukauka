<?php
include "koneksi.php";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $data = mysqli_query($koneksi, "SELECT*FROM user where username='$username' and password='$password'");
    $cek = mysqli_num_rows($data);
    $akun = mysqli_fetch_array($data);

    if ($cek < 1) {
        echo "<script>alert('No user'); location.href = 'login.php'</script>";
    }

    if ($akun['level'] === 'admin') {
        $_SESSION['user'] = $akun;
        echo '<script>location.href="index.php";</script>';
    }
    if ($akun['level'] === 'petugas') {
        $_SESSION['user'] = $akun;
        echo '<script>location.href="index.php";</script>';
    }

    $_SESSION['user'] = $akun;
    echo '<script>location.href="user/user.php";</script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" type="image/png" href="assets/img/lope-removebg-preview.png" sizes="64x64">
    <title>Login</title>
    <link href="css/login.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<nav class="navbar navbar-dark bg-danger fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="../index.php">Perpustakaan</a>
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
                <div class="card-header fw-bold">Login</div>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Username</label>
                            <input type="text" class="form-control" id="email" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input class="form-control" id="inputPassword" name="password" type="password" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" name="login" value="login">Login</button>
                        </div>
                    </form>
                    <p class="mt-2 mb-0">Don’t have an account yet? <a href="register.php" class="textprimary">Click here!</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>