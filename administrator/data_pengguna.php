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
                    <td>Nama Petugas</td>
                    <td>Username</td>
                    <td>Akses Petugas</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $no=1;
                $data=mysqli_query($conn, "SELECT * FROM petugas ORDER BY level");
                while($d = mysqli_fetch_assoc($data)) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $d['nama_petugas'] ?></td>
                        <td><?= $d['username'] ?></td>
                        <td>
                            <?php if($d['level'] == '1') : ?>
                                Administrator
                            <?php elseif($d['level'] == '2') : ?>
                                Petugas
                            <?php endif; ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data<?= $d['petugas_id']; ?>">
                                Edit
                            </button>
                            <?php if( $d['level'] == $_SESSION['level'] ) : ?>
                                <?php else: ?>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data<?= $d['petugas_id']; ?>">
                                        Hapus
                                    </button>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <!-- Modal Edit Data -->
                    <div class="modal fade" id="edit-data<?= $d['petugas_id'] ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="ModalLabel">Edit Data</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="proses_update_petugas.php" method="POST">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nama_petugas">Nama Petugas</label>
                                            <input type="hidden" name="petugas_id" id="petugas_id" value="<?= $d['petugas_id'] ?>">
                                            <input type="text" class="form-control" name="nama_petugas" id="nama_petugas" value="<?= $d['nama_petugas'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" name="username" id="username" value="<?= $d['username'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="text" class="form-control" name="password" id="password">
                                            <small class="text-danger text-sm">* Kosongkan Jika tidak ingin merubah password</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="akses_petugas">Akses Petugas</label>
                                            <select name="level" class="form-control">
                                                <option>---Pilih Akses---</option>
                                                <option value="1" <?php if($d['level'] == '1'){echo "selected";} ?>>Administrator</option>
                                                <option value="2" <?php if($d['level'] == '2'){echo "selected";} ?>>Petugas</option>
                                            </select>
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
                    <div class="modal fade" id="hapus-data<?= $d['petugas_id'] ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="ModalLabel">Hapus Data</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="proses_hapus_petugas.php" method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" name="petugas_id" id="petugas_id" value="<?= $d['petugas_id'] ?>">
                                        Apakah Anda yakin akan menghapus Data <b><?= $d['nama_petugas'] ?></b>
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
                <form action="proses_simpan_petugas.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_petugas">Nama Petugas</label>
                            <input type="text" class="form-control" name="nama_petugas" id="nama_petugas">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" name="password" id="password">
                        </div>
                        <div class="form-group">
                            <label for="">Akses Petugas</label>
                            <select name="level" class="form-control">
                                <option>--- Akses Petugas ---</option>
                                <option value="1">Administrator</option>
                                <option value="2">Petugas</option>
                            </select>
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