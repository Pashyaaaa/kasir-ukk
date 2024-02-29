<?php

include "header.php";
include "navbar.php";
include "../koneksi.php";

?>

<div class="card mt-2">
    <div class="card-body">
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambah-data">
            Tambah Data
        </button>
    </div>
    <div class="card-body">
        <?php if(isset($_GET['pesan'])): ?>
            <?php if($_GET['pesan'] == 'simpan'): ?>
                <div class="alert alert-success" role="alert">
                    Data Berhasil Di Simpan
                </div>
            <?php endif; ?>
            <?php if($_GET['pesan'] == 'update'): ?>
                <div class="alert alert-success" role="alert">
                    Data Berhasil Di Update
                </div>
            <?php endif; ?>
            <?php if($_GET['pesan'] == 'hapus'): ?>
                <div class="alert alert-success" role="alert">
                    Data Berhasil Di Hapus
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <table class="table">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama Produk</td>
                    <td>Harga</td>
                    <td>Stok</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $no=1;
                $data=mysqli_query($conn, "SELECT * FROM produk");
                while($d = mysqli_fetch_assoc($data)) : ?>
                <?php $hargaFixed = explode('.', $d['harga'])?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $d['nama_produk'] ?></td>
                        <td>Rp.<?= $hargaFixed[0] ?></td>
                        <td><?= $d['stok'] ?></td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data<?= $d['produk_id']; ?>">
                                Edit
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data<?= $d['produk_id']; ?>">
                                Hapus
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Edit Data -->
                    <div class="modal fade" id="edit-data<?= $d['produk_id'] ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="ModalLabel">Edit Data</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="proses_update_barang.php" method="POST">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nama_produk">Nama Produk</label>
                                            <input type="hidden" name="produk_id" id="produk_id" value="<?= $d['produk_id'] ?>">
                                            <input type="text" class="form-control" name="nama_produk" id="nama_produk" value="<?= $d['nama_produk'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="harga">Harga</label>
                                            <input type="number" class="form-control" name="harga" id="harga" value="<?= $d['harga'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="stok">Stok</label>
                                            <input type="number" class="form-control" name="stok" id="stok" value="<?= $d['stok'] ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Modal Hapus Data -->
                    <div class="modal fade" id="hapus-data<?= $d['produk_id'] ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="ModalLabel">Hapus Data</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="proses_hapus_barang.php" method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" name="produk_id" id="produk_id" value="<?= $d['produk_id'] ?>">
                                        Apakah Anda yakin akan menghapus Data <b><?= $d['nama_produk'] ?></b>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="tambah-data" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalLabel">Tambah Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="proses_simpan_barang.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_produk">Nama Produk</label>
                            <input type="text" class="form-control" name="nama_produk" id="nama_produk">
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga Produk</label>
                            <input type="number" class="form-control" name="harga" id="harga">
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok Produk</label>
                            <input type="number" class="form-control" name="stok" id="stok">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
include "footer.php";

?>