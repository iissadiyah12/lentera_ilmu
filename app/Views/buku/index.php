<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Data Buku</h2>

<a href="<?= base_url('buku/create') ?>">Tambah Buku</a>

<form method="get" action="<?= base_url('buku') ?>">
    <input type="text" name="keyword" placeholder="Cari buku..." value="<?= $_GET['keyword'] ?? '' ?>">
    <button type="submit">Cari</button>
     <a href="<?= base_url('buku') ?>">Reset</a>
</form><br>

<table border="1">
<tr>
    <th>No</th>
    <th>Judul</th>
    <th>Jumlah</th>
    <th>Tersedia</th>
    <th>Cover</th>
    <th>Aksi</th>
</tr>

<?php $no = 1; ?>
<?php foreach($buku as $b): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $b['judul'] ?></td>
    <td><?= $b['jumlah'] ?></td>
    <td><?= $b['tersedia'] ?></td>
    <td>
        <?php if(!empty($b['cover'])): ?>
            <img src="<?= base_url('uploads/buku/'.$b['cover']) ?>" width="100">
        <?php else: ?>
            Tidak ada gambar
        <?php endif; ?>
    </td>
    <td>
        <a href="<?= base_url('buku/detail/'.$b['id_buku']) ?>">Detail</a> |
        <a href="<?= base_url('buku/edit/'.$b['id_buku']) ?>">Edit</a> |
        <a href="<?= base_url('buku/delete/'.$b['id_buku']) ?>" onclick="return confirm('Hapus data?')">Hapus</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<?= $this->endSection() ?>