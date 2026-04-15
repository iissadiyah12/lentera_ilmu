<h2>Edit Buku</h2>

<form method="post" action="/buku/update/<?= $buku['id_buku'] ?>">

Judul: <input type="text" name="judul" value="<?= $buku['judul'] ?>"><br>
Jumlah: <input type="text" name="jumlah" value="<?= $buku['jumlah'] ?>"><br>
Tersedia: <input type="text" name="tersedia" value="<?= $buku['tersedia'] ?>"><br>

<button type="submit">Update</button>

</form>