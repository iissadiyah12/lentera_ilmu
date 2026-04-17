<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<script>
function autocomplete(inputId, listId, url) {
    document.getElementById(inputId).addEventListener("keyup", function() {
        let keyword = this.value;

        fetch(url + "?keyword=" + keyword)
        .then(res => res.json())
        .then(data => {
            let html = "";
            data.forEach(item => {
                html += `<div onclick="pilih('${inputId}','${listId}','${item}')">${item}</div>`;
            });
            document.getElementById(listId).innerHTML = html;
        });
    });
}

function pilih(inputId, listId, value) {
    document.getElementById(inputId).value = value;
    document.getElementById(listId).innerHTML = "";
}

// aktifkan
autocomplete("kategori", "list_kategori", "<?= base_url('buku/getKategori') ?>");
autocomplete("penulis", "list_penulis", "<?= base_url('buku/getPenulis') ?>");
autocomplete("penerbit", "list_penerbit", "<?= base_url('buku/getPenerbit') ?>");
autocomplete("rak", "list_rak", "<?= base_url('buku/getRak') ?>");
</script>

<h3>Edit Buku</h3>

<form action="<?= base_url('buku/update/'.$buku['id_buku']) ?>" method="post" enctype="multipart/form-data">

ISBN:<br>
<input type="text" name="isbn" value="<?= $buku['isbn'] ?>"><br><br>

Judul:<br>
<input type="text" name="judul" value="<?= $buku['judul'] ?>"><br><br>
Kategori:
<input type="text" id="kategori" name="nama_kategori" autocomplete="off">
<div id="list_kategori"></div>

Penulis:
<input type="text" id="penulis" name="nama_penulis" autocomplete="off">
<div id="list_penulis"></div>

Penerbit:
<input type="text" id="penerbit" name="nama_penerbit" autocomplete="off">
<div id="list_penerbit"></div>

Rak:
<input type="text" id="rak" name="nama_rak" autocomplete="off">
<div id="list_rak"></div>

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