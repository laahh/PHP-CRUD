<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location:login.php");
    exit;
}

require 'functions.php';



//ambil data dari tabel mahasiswa/query data mahasiswa
//kita ambil function query() yang ada di dalam file functions.php
//dengan parameter "SELECT * FROM mahasiswa"
$mahasiswa = query("SELECT * FROM mahasiswa");



if (isset($_POST["cari"])) {
    $mahasiswa = cari($_POST["keyword"]);
}


?>



<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="style/style.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Index</title>
</head>



<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="font-family:Poppins;">
        <div class="container">
            <a class="navbar-brand" href="#">Informatika CRUD</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                </ul>
                <a href="logout.php"> <i class='bx bx-log-out' style="font-size:30px ;"></i></a>

            </div>
        </div>
    </nav>
    <div class="container my-4">
        <h1 class="text-center">Data Mahasiswa</h1>
        <form action="" method="post" class="d-flex mt-5" style="width:400px ;">
            <input class="form-control me-2" name="keyword" type="search" placeholder="Search" aria-label="Search" autocomplete="off">
            <button class="btn btn-outline-success" name="cari" type="submit">Search</button>
            <button class="btn btn-info ms-2 " type="submit"> <a href="tambah.php" class="text-decoration-none text-white">tambah</a></button>
        </form>

    </div>

    <div class="container mt-5">


        <table class="table table-bordered table-hover text-center ">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Aksi</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Nim</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Jurusan</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($mahasiswa as $mhs) : ?>

                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td>
                            <!-- mengirimkan data ke edit dan hapus menggunakan method get atau melalui url -->
                            <a href="edit.php?nim=<?= $mhs["nim"]; ?>" class="badge bg-success text-decoration-none">Edit</a>
                            <a href="hapus.php?nim=<?= $mhs["nim"]; ?>" class="badge bg-danger text-decoration-none" onclick="return confirm('yakin?');">Hapus</a>
                        </td>
                        <td><img src="img/<?= $mhs["gambar"]; ?>" width="100px" alt=""></td>
                        <td> <?= $mhs["nim"]; ?> </td>
                        <td><?= $mhs["nama"]; ?></td>
                        <td><?= $mhs["email"]; ?></td>
                        <td><?= $mhs["jurusan"]; ?></td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>