<?php

include "../koneksi.php";

$pelanggan_id=$_POST['pelanggan_id'];
$nama_pelanggan=$_POST['nama_pelanggan'];
$nomor_telepon=$_POST['nomor_telepon'];
$alamat=$_POST['alamat'];

mysqli_query($conn, "UPDATE pelanggan SET nama_pelanggan='$nama_pelanggan', nomor_telepon='$nomor_telepon', alamat='$alamat' WHERE pelanggan_id='$pelanggan_id'");

header("location:pembelian.php?pesan=update");

?>