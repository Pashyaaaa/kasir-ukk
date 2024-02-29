<?php

include "header.php";
include "navbar.php";
include "../koneksi.php";

?>

<div class="card mt-2">
    <div class="card-body">
        <?php
        $pelanggan_id=$_GET['pelanggan_id'];
        $no=1;
        $data=mysqli_query($conn, "SELECT*FROM pelanggan INNER JOIN penjualan ON pelanggan.pelanggan_id=penjualan.pelanggan_id");
        while($d =mysqli_fetch_assoc($data)): ?>
            <?php if($d['pelanggan_id'] == $pelanggan_id) : ?>
                <table>
                    <tr>
                        <td>Pelanggan ID</td>
                        <td>: <?= $d['pelanggan_id'] ?></td>
                    </tr>
                    <tr>
                        <td>Nama Pelanggan</td>
                        <td>: <?= $d['nama_pelanggan'] ?></td>
                    </tr>
                    <tr>
                        <td>Nomor Telepon</td>
                        <td>: <?= $d['nomor_telepon'] ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: <?= $d['alamat'] ?></td>
                    </tr>
                    <tr>
                        <td>Total Pembelian</td>
                        <td>: Rp,<?= $d['total_harga'] ?></td>
                    </tr>
                </table>

                <form action="tambah_detail_penjualan.php" method="POST">
                    <input type="hidden" name="penjualan_id" value="<?= $d['penjualan_id'] ?>">
                    <input type="hidden" name="pelanggan_id" value="<?= $d['pelanggan_id'] ?>">
                    <button type="submit" class="btn btn-primary btn-sm mt-2">
                        Tambah Barang
                    </button>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Jumlah Beli</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nos=1;
                        $detail_penjualan=mysqli_query($conn, "SELECT * FROM detail_penjualan");
                        while($d_detail_penjualan = mysqli_fetch_assoc($detail_penjualan)):?>
                            <?php if($d_detail_penjualan['penjualan_id'] == $d['penjualan_id']): ?>
                                <tr>
                                    <td><?= $nos++ ?></td>
                                    <td>
                                        <form action="simpan_barang_beli.php" method="POST">
                                            <div class="form-group">
                                                <input type="hidden" name="pelanggan_id" value="<?= $d['pelanggan_id'] ?>">
                                                <input type="hidden" name="detail_id" value="<?= $d_detail_penjualan['detail_id'] ?>">
                                                <select name="produk_id" class="form-control" onchange="this.form.submit()">
                                                    <option>--- Pilih Produk ---</option>
                                                    <?php
                                                    $no=1;
                                                    $produk = mysqli_query($conn, "SELECT*FROM produk");
                                                    while($d_produk = mysqli_fetch_assoc($produk)):?>
                                                        <option value="<?= $d_produk['produk_id'] ?>" <?php if($d_produk['produk_id'] == $d_detail_penjualan['produk_id']) {echo "selected";} ?>><?= $d_produk['nama_produk'] ?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="hitung_subtotal.php" method="POST">
                                            <?php
                                            $produk = mysqli_query($conn, "SELECT * FROM produk");
                                            while($d_produk = mysqli_fetch_assoc($produk)):?>
                                                <?php if($d_produk['produk_id'] == $d_detail_penjualan['produk_id']) : ?>
                                                    <input type="hidden" name="harga" value="<?= $d_produk['harga']; ?>">
                                                    <input type="hidden" name="produk_id" value="<?= $d_produk['produk_id']; ?>">
                                                    <input type="hidden" name="stok" value="<?= $d_produk['stok']; ?>">
                                                <?php endif; ?>
                                            <?php endwhile; ?>
                                            <div class="form-group">
                                                <input type="number" name="jumlah_produk" value="<?= $d_detail_penjualan['jumlah_produk'] ?>" class="form-control">
                                            </div>
                                    </td>
                                    <td><?= $d_detail_penjualan['sub_total'] ?></td>
                                    <td>
                                        <input type="hidden" name="detail_id" value="<?= $d_detail_penjualan['detail_id'] ?>">
                                        <input type="hidden" name="pelanggan_id" value="<?= $d['pelanggan_id'] ?>">
                                        <button type="submit" class='btn btn-warning btn-sm'>Proses</button>
                                    </form>
                                    <form action="hapus_detail_pembelian.php" method="POST">
                                        <input type="hidden" name="pelanggan_id" value="<?= $d['pelanggan_id'] ?>">
                                        <input type="hidden" name="detail_id" value="<?= $d_detail_penjualan['detail_id'] ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <form action="simpan_total_harga.php" method="POST">
                    <?php
                        $detail_penjualan = mysqli_query($conn, "SELECT SUM(sub_total) AS total_harga FROM detail_penjualan WHERE penjualan_id='$d[penjualan_id]'");
                        $row = mysqli_fetch_assoc($detail_penjualan);
                        $sum = $row['total_harga'];
                    ?>
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="text" name="total_harga" value="<?= $sum; ?>">
                                <input type="hidden" name="pelanggan_id" value="<?= $d['pelanggan_id'] ?>">
                                <input type="hidden" name="penjualan_id" value="<?= $d['penjualan_id'] ?>">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-info btn-sm form-control">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            <?php endif; ?>
        <?php endwhile; ?>
    </div>
</div>
