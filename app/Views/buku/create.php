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
                html += `<div style="cursor:pointer;padding:5px;border:1px solid #ccc"
                         onclick="pilih('${inputId}','${listId}','${item}')">
                         ${item}
                         </div>`;
            });
            document.getElementById(listId).innerHTML = html;
        });
    });
}

function pilih(inputId, listId, value) {
    document.getElementById(inputId).value = value;
    document.getElementById(listId).innerHTML = "";
}

// aktifkan autocomplete
autocomplete("kategori", "list_kategori", "<?= base_url('buku/getKategori') ?>");
autocomplete("penulis", "list_penulis", "<?= base_url('buku/getPenulis') ?>");
autocomplete("penerbit", "list_penerbit", "<?= base_url('buku/getPenerbit') ?>");
</script>
<h3>Tambah Buku</h3>

<form method="post" action="<?= base_url('buku/store') ?>" enctype="multipart/form-data">

    Judul:<br>
    <input type="text" name="judul"><br><br>

    ISBN:<br>
    <input type="text" name="isbn"><br><br>
Kategori:<br>
<input type="text" id="kategori" name="nama_kategori" autocomplete="off">
<div id="list_kategori"></div><br>

    Penulis:<br>
<input type="text" id="penulis" name="nama_penulis" autocomplete="off">
<div id="list_penulis"></div><br>

   Penerbit:<br>
<input type="text" id="penerbit" name="nama_penerbit" autocomplete="off">
<div id="list_penerbit"></div><br>


    Rak:<br>
<input type="text" id="rak" name="nama_rak" autocomplete="off">
<div id="list_rak"></div><br>

    Tahun Terbit:<br>
    <input type="number" name="tahun_terbit"><br><br>

    Jumlah:<br>
    <input type="number" name="jumlah"><br><br>

    Tersedia:<br>
    <input type="number" name="tersedia"><br><br>

    Deskripsi:<br>
    <textarea name="deskripsi"></textarea><br><br>

    Cover / file :<br>
    <input type="file" name="cover"><br><br>

    <button type="submit">Simpan</button>
    <a href="<?= base_url('buku') ?>">Kembali</a>

</form>
<?= $this->endSection() ?>