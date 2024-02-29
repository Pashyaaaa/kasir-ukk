<?php

include "../koneksi.php";

$pelanggan_id = $_POST['pelanggan_id'];
$penjualan_id = $_POST['penjualan_id'];

mysqli_query($conn, "INSERT INTO detail_penjualan VALUES (NULL, '$penjualan_id', NULL, 0, 0)");

header("location:detail_pembelian.php?pelanggan_id=$pelanggan_id");
?>