<?php

include "../koneksi.php";

$stok = $_POST['stok'];
$produk_id = $_POST['produk_id'];
$jumlah_produk = $_POST['jumlah_produk'];
$harga = $_POST['harga'];
$detail_id = $_POST['detail_id'];
$pelanggan_id = $_POST['pelanggan_id'];
$sub_total = $jumlah_produk * $harga;
$stok_total = $stok - $jumlah_produk;

mysqli_query($conn, "UPDATE detail_penjualan set sub_total='$sub_total', jumlah_produk='$jumlah_produk' WHERE detail_id='$detail_id'");
mysqli_query($conn, "UPDATE produk SET stok='$stok_total' WHERE produk_id = '$produk_id'");

header("location:detail_pembelian.php?pelanggan_id=$pelanggan_id");

?>