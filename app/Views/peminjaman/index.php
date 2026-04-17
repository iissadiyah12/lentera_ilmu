<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Data Peminjaman</h3>

<a href="<?= base_url('peminjaman/create') ?>">+ Tambah</a>

<table border="1">
<tr>
    <th>No</th>
    <th>Buku</th>
    <th>Anggota</th>
    <th>Petugas</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php $no=1; foreach($peminjaman as $p): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $p['judul'] ?></td>
    <td><?= $p['nis'] ?></td>
    <td><?= $p['jabatan'] ?></td>
    <td><?= $p['status'] ?></td>
    <td>
        <a href="<?= base_url('peminjaman/detail/'.$p['id_peminjaman']) ?>">Detail</a>
        <a href="<?= base_url('peminjaman/edit/'.$p['id_peminjaman']) ?>">Edit</a> |
        <a href="<?= base_url('peminjaman/delete/'.$p['id_peminjaman']) ?>" onclick="return confirm('Hapus data?')">Hapus</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
<?= $this->endSection() ?>