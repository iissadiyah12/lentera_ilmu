<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h3>Tambah Peminjaman</h3>

<?php if(session()->getFlashdata('error')): ?>
    <p><?= session()->getFlashdata('error') ?></p>
<?php endif; ?>

<form method="post" action="<?= base_url('peminjaman/store') ?>">

Buku:<br>
<select name="id_buku">
    <?php foreach($buku as $b): ?>
        <option value="<?= $b['id_buku'] ?>">
            <?= $b['judul'] ?> (stok: <?= $b['tersedia'] ?>)
        </option>
    <?php endforeach; ?>
</select><br><br>

Anggota:<br>
<select name="id_anggota">
    <option value="">-- Pilih Anggota --</option>
    <?php foreach($anggota as $a): ?>
        <option value="<?= $a['id_anggota'] ?>">
            <?= $a['nis'] ?> - <?= $a['alamat'] ?>
        </option>
    <?php endforeach; ?>
</select><br><br>

Petugas:<br>
<select name="id_petugas">
    <option value="">-- Pilih Petugas --</option>
    <?php foreach($petugas as $p): ?>
        <option value="<?= $p['id_petugas'] ?>">
            <?= $p['jabatan'] ?>
        </option>
    <?php endforeach; ?>
</select><br><br>

Tanggal Pinjam:<br>
<input type="date" name="tanggal_pinjam"><br><br>

Tanggal Kembali:<br>
<input type="date" name="tanggal_kembali"><br><br>

<button type="submit">Simpan</button>

</form>
<?= $this->endSection() ?>