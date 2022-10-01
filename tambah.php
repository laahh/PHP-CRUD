<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location:login.php");
    exit;
}

require 'functions.php';

$conn = mysqli_connect("localhost", "root", "", "phpdasar");

//untuk mengecek apakah tombol submit sudah ditekan atau belum
// if (isset($_POST["submit"])) {
//     //ambil data dari tiap elemen dalam form
//     $nim = $_POST["nim"]; //variabel nim di isi dengan nim yang diambil dari name="nim" di form
//     $nama = $_POST["nama"]; //variabel nama di isi dengan nama yang diambil diambil dari name="nama" di form
//     $jurusan = $_POST["jurusan"]; //variabel jurusan diambil dari name="jurusan" di form
//     $email = $_POST["email"]; //variabel email diambil dari name="email" di form
//     $gambar = $_POST["gambar"]; //variabel gambar diambil dari name="gambar" di form

//     //query insert data
//     $query = "INSERT INTO mahasiswa VALUES ('','$nim','$nama','$jurusan','$email','$gambar')";
//     mysqli_query($conn, $query);
// }

//

//values di isi dengan variabel atas yaitu $nim $nama dst,karena variabel tersebut sudah di isi dengan $_POST["nama"] dst yang diambil dari form


//unutk mengecek apakah data berhasil ditambahkan atau tidak
// if (mysqli_affected_rows($conn) > 0) { hasil dari pengecekan menggunakan mysqli_affected_rows jika salah maka -1 dan jika benar maka 1,maka dari itu untuk mengecek apakah benar makan $conn apakah lebih besar dari 0 jika ture maka berhasil 
//     echo "data berhasil ditambahkan";
// } else {
//     mysqli_error($conn);
// }

//kita pindahkan pengecekan diatas ke function.php agar lebih rapih/modular
//kita buat function tambah di function.php





//diatas adala fungsi untuk menambahkan data,tetapi biar lebih simpel kita pindahkan ke function.php
//biar lebih mudah kita pisahkan untuk fungsi tambah di bagian function.php
//di tambah.php ini hanya untuk menambahkan data lewat form yang dikirim ke post dan di tangkap oleh data di function.php


if (isset($_POST["submit"])) {
    //cek apakah data berhasil ditambahkan atau tidak
    if (tambah($_POST) > 0) {
        echo "<script>alert('Data berhasil dimasukan')
        document.location.href='index.php'
        </script>";
    } else {
        echo "<script>alert('Data Gagal dimasukan')
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

    <title>Tambah Data</title>
</head>
<style>
    .border {
        box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
    }
</style>

<body>

    <div class="container my-4">
        <h1 class="text-center">Tambah Data Mahasiswa</h1>
    </div>

    <div class="container border  " style="width:450px;">
        <form class="py-5 px-4 " action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nim" class="form-label">Nim</label>
                <input type="text" name="nim" class="form-control" id="nim" aria-describedby="emailHelp">

            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email">
            </div>
            <div class="mb-3">
                <label for="jurusan" class="form-label">Jurusan</label>
                <input type="text" name="jurusan" class="form-control" id="jurusan">
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar</label>
                <input type="file" name="gambar" class="form-control" id="gambar">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" name="submit" class="btn btn-primary my-4">Tambah</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>