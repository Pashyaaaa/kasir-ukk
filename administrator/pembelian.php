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
                    <td>ID Pelanggan</td>
                    <td>Nama Pelanggan</td>
                    <td>No. Telepon</td>
                    <td>Alamat</td>
                    <td>Total Pembayaran</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $no=1;
                $data=mysqli_query($conn, "SELECT * FROM pelanggan INNER JOIN penjualan ON pelanggan.pelanggan_id = penjualan.pelanggan_id");
                while($d = mysqli_fetch_assoc($data)) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $d['pelanggan_id'] ?></td>
                        <td><?= $d['nama_pelanggan'] ?></td>
                        <td><?= $d['nomor_telepon'] ?></td>
                        <td><?= $d['alamat'] ?></td>
                        <td>Rp,<?= $d['total_harga'] ?></td>
                        <td>
                            <a href="detail_pembelian.php?pelanggan_id=<?= $d['pelanggan_id'] ?>" class="btn btn-info btn-sm">Detail</a>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data<?= $d['pelanggan_id']; ?>">
                                Edit
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data<?= $d['pelanggan_id']; ?>">
                                Hapus
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Edit Data -->
                    <div class="modal fade" id="edit-data<?= $d['pelanggan_id'] ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="ModalLabel">Edit Data</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="proses_update_pembelian.php" method="POST">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nama_pelanggan">Nama Pelanggan</label>
                                            <input type="hidden" name="pelanggan_id" id="pelanggan_id" value="<?= $d['pelanggan_id'] ?>">
                                            <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan" value="<?= $d['nama_pelanggan'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="nomor_telepon">Nomor Telepon</label>
                                            <input type="number" class="form-control" name="nomor_telepon" id="nomor_telepon" value="<?= $d['nomor_telepon'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <input type="text" class="form-control" name="alamat" id="alamat" value="<?= $d['alamat'] ?>">
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
                    <div class="modal fade" id="hapus-data<?= $d['pelanggan_id'] ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="ModalLabel">Hapus Data</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="proses_hapus_pembelian.php" method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" name="pelanggan_id" id="pelanggan_id" value="<?= $d['pelanggan_id'] ?>">
                                        Apakah Anda yakin akan menghapus Data <b><?= $d['nama_pelanggan'] ?></b>
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
                <form action="proses_pembelian.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="pelanggan_id">ID Pelanggan</label>
                            <input type="text" class="form-control" name="pelanggan_id" value="<?= date("dmHis") ?>" id="pelanggan_id" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_pelanggan">Nama Pelanggan</label>
                            <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan">
                        </div>
                        <div class="form-group">
                            <label for="nomor_telepon">Nomor Telepon</label>
                            <input type="text" class="form-control" name="nomor_telepon" id="nomor_telepon">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="hidden" class="form-control" name="tanggal_penjualan" id="tanggal_penjualan" value="<?= date("Y-m-d") ?>">
                            <input type="text" class="form-control" name="alamat" id="alamat">
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