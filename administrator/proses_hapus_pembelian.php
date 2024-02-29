<?php

include "../koneksi.php";

$pelanggan_id=$_POST['pelanggan_id'];

mysqli_query($conn, "DELETE FROM pelanggan WHERE pelanggan_id='$pelanggan_id'");
mysqli_query($conn, "DELETE FROM penjualan WHERE pelanggan_id='$pelanggan_id'");

header("location:pembelian.php?pesan=hapus");

?>