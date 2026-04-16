<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
$validation = $validation ?? \Config\Services::validation();
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-header">
                    <h4>Tambah Buku</h4>
                </div>

                <div class="card-body">

                    <!-- VALIDATION -->
                    <?php if ($validation->getErrors()): ?>
                        <div class="alert alert-danger">
                            <?= $validation->listErrors() ?>
                        </div>
                    <?php endif; ?>

                    <!-- FORM -->
                    <form action="<?= base_url('buku/store') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <!-- ISBN -->
                        <div class="mb-3">
                            <label>ISBN</label>
                            <input type="text" class="form-control" name="isbn" value="<?= old('isbn') ?>">
                        </div>

                        <!-- JUDUL -->
                        <div class="mb-3">
                            <label>Judul Buku *</label>
                            <input type="text"
                                class="form-control <?= $validation->hasError('judul') ? 'is-invalid' : '' ?>"
                                name="judul"
                                value="<?= old('judul') ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('judul') ?>
                            </div>
                        </div>

                        <!-- RELASI -->
                        <div class="row">
                            <div class="col-md-4">
                                <label>ID Kategori</label>
                                <input type="number" class="form-control" name="id_kategori" value="<?= old('id_kategori') ?>">
                            </div>
                            <div class="col-md-4">
                                <label>ID Penulis</label>
                                <input type="number" class="form-control" name="id_penulis" value="<?= old('id_penulis') ?>">
                            </div>
                            <div class="col-md-4">
                                <label>ID Penerbit</label>
                                <input type="number" class="form-control" name="id_penerbit" value="<?= old('id_penerbit') ?>">
                            </div>
                        </div>

                        <!-- DATA BUKU -->
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label>Tahun Terbit</label>
                                <input type="number" name="tahun_terbit" min="1900" max="2099" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label>Jumlah</label>
                                <input type="number" class="form-control" name="jumlah" value="<?= old('jumlah') ?>">
                            </div>
                            <div class="col-md-4">
                                <label>Tersedia</label>
                                <input type="number" class="form-control" name="tersedia" value="<?= old('tersedia') ?>">
                            </div>
                        </div>

                        <!-- DESKRIPSI -->
                        <div class="mt-3">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="deskripsi"><?= old('deskripsi') ?></textarea>
                        </div>

                        <!-- COVER -->
                        <div class="mt-3">
                            <label>Cover</label>
                            <input type="file" name="cover" class="form-control" accept="image/*">
                        </div>

                        <!-- BUTTON -->
                        <div class="mt-4 text-end">
                            <button class="btn btn-primary">Simpan</button>
                            <a href="<?= base_url('buku') ?>" class="btn btn-secondary">Kembali</a>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>