<?php

include "header.php";
include "navbar.php";
include "../koneksi.php";
var_dump($_SESSION);


?>

<div class="card mt-2">
    
    <h5 class="m-3 text-white text-center"><span class="text-dark">H</span><span class="bg-dark rounded">ello Admin</span></h5>
    <div class="card-body">
        <div class="row gap-3 gap-sm-0">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        Data Barang
                        <?php
                            $data_produk = mysqli_query($conn, "SELECT * FROM produk");
                            $jumlah_produk = mysqli_num_rows($data_produk);
                        ?>
                        <h3><?= $jumlah_produk ?></h3>
                        <a href="data_barang.php" class="btn btn-outline-primary btn-sm">Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        Data Pembelian
                        <?php
                            $data_pembelian = mysqli_query($conn, "SELECT * FROM penjualan");
                            $jumlah_pembelian = mysqli_num_rows($data_pembelian);
                        ?>
                        <h3><?= $jumlah_pembelian ?></h3>
                        <a href="pembelian.php" class="btn btn-outline-primary btn-sm">Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        Data Pengguna
                        <?php
                            $data_pengguna = mysqli_query($conn, "SELECT * FROM petugas");
                            $jumlah_pengguna = mysqli_num_rows($data_pengguna);
                        ?>
                        <h3><?= $jumlah_pengguna ?></h3>
                        <a href="data_pengguna.php" class="btn btn-outline-primary btn-sm">Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mt-2">
    <div class="card-body">
        <p>Selamat datang dihalaman Administrator, silahkan anda bisa mengakses beberapa fitur</p>
    </div>
</div>
<?php

include "footer.php";

?>