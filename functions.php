<?php

use LDAP\Result;

$conn = mysqli_connect("localhost", "root", "", "phpdasar");


function query($query) //=>$mahasiswa = query("SELECT * FROM mahasiswa");
{
    global $conn;
    $result = mysqli_query($conn, $query); //
    $rows = []; //membuat array untuk menampung data dari database
    while ($row = mysqli_fetch_assoc($result)) { //looping untuk mengambil data dari database
        $rows[] = $row; //menambahkan data dari database ke dalam array
    }
    return $rows;
}




//penjelasan

// $result = mysqli_query($conn, $query); digunakan untuk mengeksekusi query yang ada di dalam variabel $query
//dengan menggunakan mysqli_query() kita bisa mengambil data dari database phpdasar
// $rows = []; digunakan untuk menampung data yang diambil dari database
// while ($row = mysqli_fetch_assoc($result)) { digunakan untuk mengambil data dari database
// $rows[] = $row; digunakan untuk memasukan data yang diambil dari database ke dalam variabel $rows
// return $rows; digunakan untuk mengembalikan nilai dari variabel $rows


//mysqli_query() digunakan untuk mengeksekusi query yang ada di dalam database
//msqli_fetch_assoc() digunakan untuk mengambil data dari database


//alur kerja
//1. kita membuat function query() yang berisi parameter $query
//2. kita membuat variabel $conn yang berisi koneksi ke database
//3. kita membuat variabel $result yang berisi mysqli_query() yang berisi parameter $conn dan $query
//4. kita membuat variabel $rows yang berisi array kosong
//5. kita membuat perulangan while yang berisi variabel $row yang berisi mysqli_fetch_assoc() yang berisi parameter $result
//6. kita membuat variabel $rows yang berisi variabel $row
//7. kita membuat return $rows
//8. kita membuat variabel $mahasiswa yang berisi function query() yang berisi parameter "SELECT * FROM mahasiswa" ini di index.php


//if(tambah)

function tambah($data)
{
    global $conn;
    $nim = htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $email = htmlspecialchars($data["email"]);
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO mahasiswa VALUES ('','$nim','$nama','$jurusan','$email','$gambar')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//htmlspecialchars() digunakan untuk mengamankan data yang diinputkan oleh user



function upload()
{
    $namaFile = $_FILES['gambar']['name']; //mengambil nama file yang diupload
    $ukuranFile = $_FILES['gambar']['size']; //mengambil ukuran file yang diupload
    $error = $_FILES['gambar']['error']; //mengambil error yang terjadi saat mengupload file
    $tmpName = $_FILES['gambar']['tmp_name']; //mengambil nama file sementara yang diupload

    //untuk mengecek apakah tidak ada gambar yang diupload
    if ($error === 4) { //4 adalah kode error yang terjadi jika tidak ada gambar yang diupload
        echo "<script>
        alert('pilih gambar terlebih dahulu');
        </script>";
        return false; //return false digunakan untuk menghentikan function upload()
    }

    //untuk mengecek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png']; //membuat array untuk menampung ekstensi gambar yang valid
    $ekstensiGambar = explode('.', $namaFile);   //explode digunakan untuk memecah string menjadi array dan memecah string berdasarkan tanda titik (.)
    $ekstensiGambar = strtolower(end($ekstensiGambar)); //strtolower digunakan untuk mengubah string menjadi huruf kecil dan end digunakan untuk mengambil data paling akhir dari array
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) { //in_array digunakan untuk mengecek apakah data yang ada di dalam array $ekstensiGambarValid ada di dalam array $ekstensiGambar
        echo
        "<script>
        alert('yang anda upload bukan gambar');
        </script>";
        return false;
    }


    //in_array adalah sebuah fungsi yang digunakan untuk pengecekan nilai yang ada dalam sebuah array, fungsi in_array mempunyai dua argumen yaitu FALSE dan TRUE, TRUE jika kondisi terpenuhi atau ada dan FALSE jika kondisi tidak terpenuhi atau nilai tidak ada dalam array.

    //untuk mengecek jika ukuran gambar terlalu besar
    if ($ukuranFile > 1000000) {
        echo "<script>
        alert('ukuran gambar terlalu besar');
        </script>";
        return false;
    }

    //lolos pengecekan, gambar siap diupload
    //generate nama gambar baru
    $namaFileBaru = uniqid(); //uniqid digunakan untuk membuat string random
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru); //move_uploaded_file digunakan untuk memindahkan file yang diupload ke folder yang dituju

    return $namaFileBaru;
}











function hapus($nim)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE nim = $nim");
    return mysqli_affected_rows($conn);
}

//mysqli_affected_rows() digunakan untuk mengecek apakah data berhasil dihapus atau tidak
//fungsi mysqli_affected_rows() akan mengembalikan nilai 1 jika data berhasil dihapus dan -1 jika data gagal dihapus


//parameter data menangkap data yang dikirimkan dari form tambah.php lewat method post
function edit($data)
{

    global $conn;
    $nim = htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $email = htmlspecialchars($data["email"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE mahasiswa SET
                nim = '$nim',
                nama = '$nama',
                jurusan = '$jurusan',
                email = '$email',
                gambar = '$gambar'
                WHERE nim = $nim
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//nim = $nim digunakan untuk mengambil data nim yang ada di dalam database
//set nim = '$nim' digunakan untuk mengubah data nim yang ada di dalam database
//mysqli_query() digunakan untuk mengeksekusi query yang ada di dalam database
//mysqli_affected_rows() digunakan untuk mengecek apakah data berhasil diubah atau tidak



//function cari
function cari($keyword)
{
    $query = "SELECT * FROM mahasiswa WHERE
            id LIKE '%$keyword%' OR
            nim LIKE '%$keyword%' OR
            nama LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%' OR
            email LIKE '%$keyword%' OR
            gambar LIKE '%$keyword%'
            ";

    return query($query);
}




function register($data)
{
    global $conn;
    $username = $data["username"];
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek username sudah ada atau belum
    $cekUsers = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

    //mysqli_fetch_row adalah sebuah fungsi yang digunakan untuk mengambil data dari database, fungsi mysqli_fetch_row akan mengembalikan nilai FALSE jika data tidak ada dan akan mengembalikan nilai TRUE jika data ada.
    //nah jika di cek menggunakan fungsi mysqli_fetch_row dan ada username yang di tampung di variabel $cekUsers maka akan mengembalikan nilai TRUE dan jika tidak ada maka akan mengembalikan nilai FALSE
    if (mysqli_fetch_row($cekUsers)) { //jika $cek user ada di dalam database maka akan menampilkan username sudah terdaftar
        echo "<script>
        alert('username sudah terdaftar');
        </script>";
        return false;
    }


    //cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
        alert('konfirmasi password tidak sesuai');
        </script>";
        return false;
    }


    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);


    mysqli_query($conn, "INSERT INTO users VALUES('','$username','$password')");
    return mysqli_affected_rows($conn);
}
