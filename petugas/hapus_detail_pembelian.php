<?php

include "../koneksi.php";

$detail_id=$_POST['detail_id'];
$pelanggan_id=$_POST['pelanggan_id'];

mysqli_query($conn, "DELETE FROM detail_penjualan WHERE detail_id='$detail_id'");

header("location:detail_pembelian.php?pelanggan_id=$pelanggan_id");

?>