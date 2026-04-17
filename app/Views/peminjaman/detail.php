<h3>Detail Peminjaman</h3>

<p>
Anggota: <?= $peminjaman['nis'] ?><br>
Petugas: <?= $peminjaman['jabatan'] ?><br>
Tanggal Pinjam: <?= $peminjaman['tanggal_pinjam'] ?><br>
Tanggal Kembali: <?= $peminjaman['tanggal_kembali'] ?><br>
Status: <?= $peminjaman['status'] ?><br>
</p>

<hr>

<h4>Daftar Buku</h4>

<table border="1" cellpadding="10">
<tr>
    <th>No</th>
    <th>Cover</th>
    <th>Judul Buku</th>
    <th>Jumlah</th>
</tr>

<?php $no=1; foreach($detail as $d): ?>
<tr>
    <td><?= $no++ ?></td>
    <td>
        <?php if($d['cover']): ?>
            <img src="<?= base_url('uploads/buku/'.$d['cover']) ?>" width="80">
        <?php endif; ?>
    </td>
    <td><?= $d['judul'] ?></td>
    <td><?= $d['jumlah'] ?></td>
</tr>
<?php endforeach; ?>

</table>

<br>
<a href="<?= base_url('peminjaman') ?>">Kembali</a>