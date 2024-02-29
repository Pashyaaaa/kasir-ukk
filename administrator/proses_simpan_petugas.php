<?php

include "../koneksi.php";

$nama_petugas=$_POST['nama_petugas'];
$username=$_POST['username'];
$password=md5($_POST['password']);
$level=$_POST['level'];

mysqli_query($conn, "INSERT INTO petugas VALUES(NULL, '$nama_petugas', '$username', '$password', '$level')");

header("location:data_pengguna.php?pesan=simpan")
?>