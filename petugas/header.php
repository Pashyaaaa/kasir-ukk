<?php

session_start();

if($_SESSION['level'] != '2'){
    header("location:../index.php?pesan=gagal");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Petugas</title>
    <link rel="stylesheet" href="../assets/bootstrap-5.3.2/dist/css/bootstrap.css">
</head>
<style>
    .btn-biru-tua {
        color: white;
        background-color: blue;
    }
    
    .btn-biru-tua:hover {
        color: blue;
        border-color: blue;
        background-color: white;
    }
    
    .btn-biru-tua:active {
        color: blue;
        background-color: white;
        border-color: blue;
    }

    /* .mainContent {
        animation: name duration timing-function delay iteration-count direction fill-mode;
    } */
</style>
<body>
    <div class="container">
        <div class="content">