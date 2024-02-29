<?php

include "../koneksi.php";

$produk_id=$_POST['produk_id'];

mysqli_query($conn, "DELETE FROM produk WHERE produk_id='$produk_id'");

header("location:data_barang.php?pesan=hapus");

?>