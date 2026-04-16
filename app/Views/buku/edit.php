<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Edit Buku</h3>

<form action="<?= base_url('buku/update/'.$buku['id_buku']) ?>" method="post" enctype="multipart/form-data">

ISBN:<br>
<input type="text" name="isbn" value="<?= $buku['isbn'] ?>"><br><br>

Judul:<br>
<input type="text" name="judul" value="<?= $buku['judul'] ?>"><br><br>

Kategori:<br>
<select name="id_kategori">
    <option value="">-- Pilih Kategori --</option>
    <?php foreach($kategori as $k): ?>
        <option value="<?= $k['id_kategori'] ?>" <?= $buku['id_kategori'] == $k['id_kategori'] ? 'selected' : '' ?>>
            <?= $k['nama_kategori'] ?>
        </option>
    <?php endforeach; ?>
</select><br><br>

Penulis:<br>
<select name="id_penulis">
    <option value="">-- Pilih Penulis --</option>
    <?php foreach($penulis as $p): ?>
        <option value="<?= $p['id_penulis'] ?>" <?= $buku['id_penulis'] == $p['id_penulis'] ? 'selected' : '' ?>>
            <?= $p['nama_penulis'] ?>
        </option>
    <?php endforeach; ?>
</select><br><br>

Penerbit:<br>
<select name="id_penerbit">
    <option value="">-- Pilih Penerbit --</option>
    <?php foreach($penerbit as $pb): ?>
        <option value="<?= $pb['id_penerbit'] ?>" <?= $buku['id_penerbit'] == $pb['id_penerbit'] ? 'selected' : '' ?>>
            <?= $pb['nama_penerbit'] ?>
        </option>
    <?php endforeach; ?>
</select><br><br>

Tahun Terbit:<br>
<select name="tahun_terbit">
    <option value="">-- Pilih Tahun --</option>
    <?php for($i=2001; $i<=2026; $i++): ?>
        <option value="<?= $i ?>" <?= $buku['tahun_terbit'] == $i ? 'selected' : '' ?>>
            <?= $i ?>
        </option>
    <?php endfor; ?>
</select><br><br>

Jumlah:<br>
<input type="number" name="jumlah" value="<?= $buku['jumlah'] ?>"><br><br>

Tersedia:<br>
<input type="number" name="tersedia" value="<?= $buku['tersedia'] ?>"><br><br>

Deskripsi:<br>
<textarea name="deskripsi"><?= $buku['deskripsi'] ?></textarea><br><br>

Cover:<br>
<?php if(!empty($buku['cover'])): ?>
    <img src="<?= base_url('uploads/buku/'.$buku['cover']) ?>" width="100"><br>
<?php endif; ?>
<input type="file" name="cover"><br><br>

<button type="submit">Update</button>
<a href="<?= base_url('buku') ?>">Kembali</a>

</form>

<?= $this->endSection() ?>