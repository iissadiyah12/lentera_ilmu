<h2>Data Buku</h2>

<a href="/buku/create">Tambah Buku</a>

<form method="get" action="/buku/filter">
    Kategori: <input type="text" name="kategori">
    Penulis: <input type="text" name="penulis">
    Penerbit: <input type="text" name="penerbit">
    <button type="submit">Filter</button>
</form>

<table border="1">
<tr>
    <th>Judul</th>
    <th>Kategori</th>
    <th>Penulis</th>
    <th>Penerbit</th>
    <th>Aksi</th>
</tr>

<?php foreach($buku as $b): ?>
<tr>
    <td><?= $b['judul'] ?></td>
    <td><?= $b['nama_kategori'] ?></td>
    <td><?= $b['nama_penulis'] ?></td>
    <td><?= $b['nama_penerbit'] ?></td>
    <td>
        <a href="/buku/edit/<?= $b['id_buku'] ?>">Edit</a>
        <a href="/buku/delete/<?= $b['id_buku'] ?>">Hapus</a>
    </td>
</tr>
<?php endforeach; ?>
</table>