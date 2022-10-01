<?php

session_start();


if (isset($_SESSION["login"])) {
    header("Location:index.php");
    exit;
}

require 'functions.php';

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username ='$username'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            //membuat session
            $_SESSION["login"] = true;

            //cek apakah checkbox ditekan atau tidak
            if (isset($_POST["cookie"])) {

                //jika ditekan maka buat cookie
                setcookie("login", "true", time() + 60);
            }

            header("Location:index.php");
            exit;
        }
    }

    $error = true;
}


?>




<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- style -->
    <link rel="stylesheet" href="style/login.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Login</title>
</head>

<body>



    <div class="container-fluid position-relative">
        <div class="container ">
            <div class="row ">
                <div class="col-lg-6 ">
                    <h5 class="text-white text-center judul mt-5 me-4">Data Mahasiswa <br> Teknik Informatika</h5>
                </div>
                <div class="col-lg-6 side-right">
                    <h4 class="text-center">Login</h4>
                    <?php if (isset($error)) : ?>
                        <div class="alert alert-danger margin-left text-center" role="alert" style="width:450px">
                            Username atau password salah
                        </div>
                    <?php endif; ?>
                    <form action="" method="post">
                        <div class="mb-3">
                            <input type="text" class="mt-5 margin-left form-control border-0 border-bottom" placeholder="User Name" name="username" style="width: 450px;">
                        </div>
                        <div class="mb-3">
                            <input type="password" class=" mt-5 margin-left form-control border-0 border-bottom" placeholder="Password" name="password" style="width: 450px;">
                        </div>
                        <div class="mb-3 form-check margin-left" style="font-family:poppins;">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" name="cookie" for="exampleCheck1">Remember Me</label>
                        </div>
                        <button type="submit" name="login" class="btn btn-warna margin-left mt-5" style="width:450px;">Login</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>