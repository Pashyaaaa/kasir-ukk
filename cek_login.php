<?php

session_start();

include "koneksi.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

$login = mysqli_query($conn, "SELECT * FROM petugas WHERE username='$username' AND password='$password'");
$cek = mysqli_num_rows($login);

if(!empty($cek)){
    $data = mysqli_fetch_assoc($login);
    if($data['level'] == '1'){
        $_SESSION['username'] = $username;
        $_SESSION['level'] = '1';
        header("location:administrator/index.php");
    } else if($data['level'] == '2'){
        $_SESSION['username'] = $username;
        $_SESSION['level'] = '2';
        header("location:petugas/index.php");
    } else {
        header("location:index.php?pesan=gagal");
    }
} else{
    header("location:index.php?pesan=gagal");
}

?>