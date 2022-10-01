<?php


session_start();

if (!isset($_SESSION["login"])) {
    header("Location:login.php");
    exit;
}


require 'functions.php';

if (isset($_POST["signup"])) {
    if (register($_POST) > 0) {
        echo "<script>
                alert('User Baru Berhasil ditambahkan');
            </script>";
    } else {
        echo mysqli_error($conn);
    }
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
    <link rel="stylesheet" href="style/style.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Registrasi</title>
</head>

<body>
    <div class="container-fluid position-relative">
        <div class="container ">
            <div class="row ">
                <div class="col-lg-6 ">
                    <h5 class="text-white text-center judul mt-5 me-4">Data Mahasiswa <br> Teknik Informatika</h5>
                    <img src="img/regis.png" alt="" class="">
                </div>
                <div class="col-lg-6 side-right">
                    <h4 class="mt-5 mx-5">Sign up</h4>
                    <button class=" margin-left btn btn-outline-dark mt-4 " type="submit"> <img src="img/img-google.png" alt="" class="me-2"> Sign up with Google </button>
                    <button class="btn btn-outline-dark mt-4 ms-2 " type="submit"> <img src="img/img-fb.png" alt="" class="me-2"> Sign up with Facebook </button>

                    <p>-OR-</p>

                    <form action="" method="post">
                        <div class="mb-3">
                            <input type="text" class="mt-5 margin-left form-control border-0 border-bottom" placeholder="User Name" name="username" style="width: 450px;">
                        </div>
                        <div class="mb-3">
                            <input type="password" class=" mt-5 margin-left form-control border-0 border-bottom" placeholder="Password" name="password" style="width: 450px;">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="mt-5 margin-left form-control border-0 border-bottom" placeholder="Confirm Password" name="password2" style="width: 450px;">
                        </div>
                        <button type="submit" name="signup" class="btn btn-warna margin-left mt-5" style="width:450px;">Sign Up</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>