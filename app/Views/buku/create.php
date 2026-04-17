<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
$validation = $validation ?? \Config\Services::validation();
?>


<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-header">
                    <h4>Tambah Buku</h4>
                </div>

                <div class="card-body"><script>
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

                    <!-- VALIDATION -->
                    <?php if ($validation->getErrors()): ?>
                        <div class="alert alert-danger">
                            <?= $validation->listErrors() ?>
                        </div>
                    <?php endif; ?>

                    <!-- FORM -->
                    <form action="<?= base_url('buku/store') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <!-- ISBN -->
                        <div class="mb-3">
                            <label>ISBN</label>
                            <input type="text" class="form-control" name="isbn" value="<?= old('isbn') ?>">
                        </div>

                        <!-- JUDUL -->
                        <div class="mb-3">
                            <label>Judul Buku *</label>
                            <input type="text"
                                class="form-control <?= $validation->hasError('judul') ? 'is-invalid' : '' ?>"
                                name="judul"
                                value="<?= old('judul') ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('judul') ?>
                            </div>
                        </div>

                        <!-- RELASI (SUDAH DIPERBAIKI) -->
                        <div class="row">
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
                        </div>

                        <!-- DATA BUKU -->
                        <div class="row mt-3">
                           <div class="col-md-4">
                            <label>Tahun Terbit</label>
                            <select name="tahun_terbit" class="form-control">
                                <option value="">-- Pilih Tahun --</option>
                                <?php for ($i = 2001; $i <= 2026; $i++): ?>
                                    <option value="<?= $i ?>" <?= old('tahun_terbit') == $i ? 'selected' : '' ?>>
                                        <?= $i ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                            <div class="col-md-4">
                                <label>Jumlah</label>
                                <input type="number" class="form-control" name="jumlah" value="<?= old('jumlah') ?>">
                            </div>
                            <div class="col-md-4">
                                <label>Tersedia</label>
                                <input type="number" class="form-control" name="tersedia" value="<?= old('tersedia') ?>">
                            </div>
                        </div>

                        <!-- DESKRIPSI -->
                        <div class="mt-3">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="deskripsi"><?= old('deskripsi') ?></textarea>
                        </div>

                        <!-- COVER -->
                        <div class="mt-3">
                            <label>Cover</label>
                            <input type="file" name="cover" class="form-control" accept="image/*">
                        </div>

                        <!-- BUTTON -->
                        <div class="mt-4 text-end">
                            <button class="btn btn-primary">Simpan</button>
                            <a href="<?= base_url('buku') ?>" class="btn btn-secondary">Kembali</a>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>