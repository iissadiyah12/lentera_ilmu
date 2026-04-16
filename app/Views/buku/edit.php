<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Edit Buku</h3>

<form action="<?= base_url('buku/update/'.$buku['id_buku']) ?>" method="post">

Judul:<br>
<input type="text" name="judul" value="<?= $buku['judul'] ?>"><br><br>

Jumlah:<br>
<input type="number" name="jumlah" value="<?= $buku['jumlah'] ?>"><br><br>

Tersedia:<br>
<input type="number" name="tersedia" value="<?= $buku['tersedia'] ?>"><br><br>

<button type="submit">Update</button>
<a href="<?= base_url('buku') ?>">Kembali</a>

</form>
<?= $this->endSection() ?>