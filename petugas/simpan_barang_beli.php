<?php

include "../koneksi.php";

$produk_id = $_POST['produk_id'];
$detail_id = $_POST['detail_id'];
$pelanggan_id = $_POST['pelanggan_id'];

mysqli_query($conn, "UPDATE detail_penjualan SET produk_id = '$produk_id' WHERE detail_id='$detail_id'");

header("location:detail_pembelian.php?pelanggan_id=$pelanggan_id");
?>