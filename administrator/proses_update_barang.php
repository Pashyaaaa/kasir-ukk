<?php

include "../koneksi.php";

$produk_id = $_POST['produk_id'];
$nama_produk = $_POST['nama_produk'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];

mysqli_query($conn, "UPDATE produk SET nama_produk='$nama_produk', harga='$harga', stok='$stok' WHERE produk_id='$produk_id' ");

header("location:data_barang.php?pesan=update");
?>