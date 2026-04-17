<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h3>Edit Peminjaman</h3>

<form action="<?= base_url('peminjaman/update/'.$peminjaman['id_peminjaman']) ?>" method="post">

<!-- BUKU -->
Buku:<br>
<select name="id_buku">
    <?php foreach($buku as $b): ?>
        <option value="<?= $b['id_buku'] ?>"
            <?= $peminjaman['id_buku'] == $b['id_buku'] ? 'selected' : '' ?>>
            <?= $b['judul'] ?>
        </option>
    <?php endforeach; ?>
</select><br><br>

<!-- ANGGOTA -->
Anggota:<br>
<select name="id_anggota">
    <?php foreach($anggota as $a): ?>
        <option value="<?= $a['id_anggota'] ?>"
            <?= $peminjaman['id_anggota'] == $a['id_anggota'] ? 'selected' : '' ?>>
            <?= $a['nis'] ?>
        </option>
    <?php endforeach; ?>
</select><br><br>

<!-- PETUGAS -->
Petugas:<br>
<select name="id_petugas">
    <?php foreach($petugas as $p): ?>
        <option value="<?= $p['id_petugas'] ?>"
            <?= $peminjaman['id_petugas'] == $p['id_petugas'] ? 'selected' : '' ?>>
            <?= $p['jabatan'] ?>
        </option>
    <?php endforeach; ?>
</select><br><br>

<!-- TANGGAL -->
Tanggal Pinjam:<br>
<input type="date" name="tanggal_pinjam" value="<?= $peminjaman['tanggal_pinjam'] ?>"><br><br>

Tanggal Kembali:<br>
<input type="date" name="tanggal_kembali" value="<?= $peminjaman['tanggal_kembali'] ?>"><br><br>

<!-- STATUS -->
Status:<br>
<select name="status">
    <option value="dipinjam" <?= $peminjaman['status'] == 'dipinjam' ? 'selected' : '' ?>>Dipinjam</option>
    <option value="kembali" <?= $peminjaman['status'] == 'kembali' ? 'selected' : '' ?>>Kembali</option>
</select><br><br>

<button type="submit">Update</button>
<a href="<?= base_url('peminjaman') ?>">Kembali</a>

</form>
<?= $this->endSection() ?>