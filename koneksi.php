<?php

$conn = mysqli_connect("localhost", "root", "", "ukk2024");

if(mysqli_connect_errno()){
    echo "Koneksi database gagal: " . mysqli_connect_error();
}
?>