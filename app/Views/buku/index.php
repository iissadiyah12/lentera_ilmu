<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Data Buku</h2>

<a href="<?= base_url('buku/create') ?>">Tambah Buku</a>

<form method="get">
    <input type="text" name="keyword" placeholder="Cari buku...">
    <button type="submit">Cari</button>
</form>

<table border="1">
<tr>
    <th>Judul</th>
    <th>Jumlah</th>
    <th>Tersedia</th>
    <th>Cover</th>
    <th>Aksi</th>
</tr>

<?php foreach($buku as $b): ?>
<tr>
    <td><?= $b['judul'] ?></td>
    <td><?= $b['jumlah'] ?></td>
    <td><?= $b['tersedia'] ?></td>
    <td>
        <?php if($b['cover']): ?>
            <img src="/uploads/buku/<?= $b['cover'] ?>" width="80">
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