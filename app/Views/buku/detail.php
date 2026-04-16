<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Detail Buku</h2>

<img src="/uploads/buku/<?= $buku['cover'] ?>" width="120"><br><br>

<b>ID Buku:</b> <?= $buku['id_buku'] ?><br>
<b>ISBN:</b> <?= $buku['isbn'] ?><br>
<b>Judul:</b> <?= $buku['judul'] ?><br>
<b>Tahun:</b> <?= $buku['tahun_terbit'] ?><br>

<b>Jumlah:</b> <?= $buku['jumlah'] ?><br>
<b>Tersedia:</b> <?= $buku['tersedia'] ?><br>

<b>Deskripsi:</b><br>
<?= $buku['deskripsi'] ?><br><br>

<h3>Kategori</h3>
Nama: <?= $buku['nama_kategori'] ?><br>

<h3>Penulis</h3>
Nama: <?= $buku['nama_penulis'] ?><br>
Alamat: <?= $buku['alamat_penulis'] ?><br>
HP: <?= $buku['hp_penulis'] ?><br>

<h3>Penerbit</h3>
Nama: <?= $buku['nama_penerbit'] ?><br>
Alamat: <?= $buku['alamat_penerbit'] ?><br>
HP: <?= $buku['hp_penerbit'] ?><br>

<br>
<a href="<?= base_url('buku/edit/'.$buku['id_buku']) ?>">Edit</a>
<a href="<?= base_url('buku') ?>">Kembali</a>

<?= $this->endSection() ?>