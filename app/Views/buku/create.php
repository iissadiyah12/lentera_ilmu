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

                        <!-- RELASI (SUDAH DIPERBAIKI) -->
                        <div class="row">
                            <!-- KATEGORI -->
                            <div class="col-md-4">
                             <label>Kategori</label>
                                <select name="id_kategori" class="form-control">
                                <option value="">-- Pilih --</option>
                                    <?php foreach ($kategori as $k): ?>
                                <option value="<?= $k['id_kategori'] ?>" <?= old('id_kategori') == $k['id_kategori'] ? 'selected' : '' ?>>
                                     <?= $k['nama_kategori'] ?>
                                </option>
                    <?php endforeach; ?>
                             </select>
                       </div>

                            <!-- PENULIS -->
                            <div class="col-md-4">
                                <label>Penulis</label>
                                <select name="id_penulis" class="form-control">
                                    <option value="">-- Pilih Penulis --</option>
                                    <?php foreach($penulis as $p): ?>
                                        <option value="<?= $p['id_penulis'] ?>"
                                            <?= old('id_penulis') == $p['id_penulis'] ? 'selected' : '' ?>>
                                            <?= $p['nama_penulis'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- PENERBIT -->
                            <div class="col-md-4">
                                <label>Penerbit</label>
                                <select name="id_penerbit" class="form-control">
                                    <option value="">-- Pilih Penerbit --</option>
                                    <?php foreach($penerbit as $pb): ?>
                                        <option value="<?= $pb['id_penerbit'] ?>"
                                            <?= old('id_penerbit') == $pb['id_penerbit'] ? 'selected' : '' ?>>
                                            <?= $pb['nama_penerbit'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- DATA BUKU -->
                        <div class="row mt-3">
                           <div class="col-md-4">
                            <label>Tahun Terbit</label>
                            <select name="tahun_terbit" class="form-control">
                                <option value="">-- Pilih Tahun --</option>
                                <?php for ($i = 2001; $i <= 2026; $i++): ?>
                                    <option value="<?= $i ?>" <?= old('tahun_terbit') == $i ? 'selected' : '' ?>>
                                        <?= $i ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
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