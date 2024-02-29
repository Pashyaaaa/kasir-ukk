<?php

include "../koneksi.php";

$pelanggan_id=$_POST['pelanggan_id'];
$nama_pelanggan=$_POST['nama_pelanggan'];
$nomor_telepon=$_POST['nomor_telepon'];
$alamat=$_POST['alamat'];
$tanggal_penjualan=$_POST['tanggal_penjualan'];

mysqli_query($conn, "INSERT INTO pelanggan VALUES('$pelanggan_id', '$nama_pelanggan', '$alamat', '$nomor_telepon')");
mysqli_query($conn, "INSERT INTO penjualan VALUES(NULL, '$tanggal_penjualan', 0, '$pelanggan_id')");

header("location:pembelian.php?pesan=simpan");

?>