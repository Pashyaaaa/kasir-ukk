<?php

include "../koneksi.php";

$petugas_id=$_POST['petugas_id'];

mysqli_query($conn, "DELETE FROM petugas WHERE petugas_id='$petugas_id'");

header("location:data_pengguna.php?pesan=hapus");

?>