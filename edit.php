<?php


session_start();

if (!isset($_SESSION["login"])) {
    header("Location:login.php");
    exit;
}

require 'functions.php';

//ambil data dari tombol edit yang dikrimkan melalui method get url
$nim = $_GET['nim'];

//query data mahasiswa berdasarkan nim
//query adalah sebuah function yang ada di dalam php
//mysqli_query() digunakan untuk mengeksekusi query yang ada di dalam database
//mysqli_fetch_assoc() digunakan untuk mengambil data dari database


//kita ambil function query() yang ada di dalam file functions.php
$mhs = query("SELECT * FROM mahasiswa WHERE nim=$nim")[0];

if (isset($_POST["submit"])) {
    if (edit($_POST) > 0) {
        echo "<script>alert('Data berhasil diubah')
        document.location.href='index.php'
        </script>";
    } else {
        echo "<script>alert('Data Gagal diubah')
        documen.location.href='index.php'
        </script>";
    }
}





?>




<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Edit</title>
</head>
<style>
    .border {
        box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
    }
</style>

<body>

    <div class="container my-4">
        <h1 class="text-center">Edit Data Mahasiswa</h1>
    </div>

    <div class="container border  " style="width:450px;">
        <form class="py-5 px-4" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="gambarLama" value="<?php echo $mhs["gambar"]; ?>">
            <div class="mb-3">
                <label for="nim" class="form-label">Nim</label>
                <input type="text" name="nim" class="form-control" id="nim" value="<?php echo $mhs["nim"]; ?>">
                <!-- pada halaman edit kita tambahkan value untuk automatis ada isi ketika di klik edit pada halaman index.php -->
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" value="<?php echo $mhs["nama"]; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="<?php echo $mhs["email"]; ?>">
            </div>
            <div class="mb-3">
                <label for="jurusan" class="form-label">Jurusan</label>
                <input type="text" name="jurusan" class="form-control" id="jurusan" value="<?php echo $mhs["jurusan"]; ?>">
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar</label> <br>
                <img class="mb-3" src="img/<?= $mhs["gambar"]; ?>" style="width:150px;"> <br>
                <input type="file" name="gambar" class="form-control" id="gambar">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>