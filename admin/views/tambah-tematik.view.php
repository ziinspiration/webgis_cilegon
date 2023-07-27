<?php include 'views/partials/starter-head.php'; ?>
<style>
    * {
        font-family: montserrat;
    }

    body {
        background-image: url(../assets/index/footer2.jpg);
    }

    .orange {
        color: orange !important;
    }

    .bg-orange {
        background-color: orange;
    }

    form {
        border: 2px solid orange !important;
    }

    @media screen and (max-width:550px) {
        .formulir {
            flex-direction: column;
        }

        .left,
        .right {
            width: 100% !important;
            margin: 0 !important;
        }

        .note {
            font-size: 11px !important;
            margin-top: 5px !important;
        }
    }

    @media screen and (max-width:990px) {
        .note {
            font-size: 11px !important;
            margin-top: 5px !important;
        }
    }

    .row {
        margin-top: 100px !important;
    }
</style>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="w-75 align-content-center">
            <form class="px-5 py-4 bg-dark rounded-4" action="" method="post" enctype="multipart/form-data">
                <h2 class="text-center text-light mb-5 mt-2">Input data tematik</h2>
                <div class="formulir d-flex justify-content-between">
                    <div class="left w-50 me-3">
                        <!-- Nama -->
                        <div class="mb-3 kolom">
                            <label for="nama_tematik" class="form-label orange ps-1 pe-1">Nama data</label>
                            <input type="text" name="nama_tematik" class="form-control p-2" id="nama_tematik" placeholder="Masukkan nama data" required />
                        </div>
                        <!-- File -->
                        <div class="mb-3 kolom">
                            <label for="file_json" class="form-label orange ps-1 pe-1">File GeoJSON</label>
                            <input type="file" class="form-control p-2" id="file_json" name="file_json" accept=".geojson" required />
                        </div>
                    </div>
                    <div class="right w-50 ms-3 ">
                        <!-- Checkbox id -->
                        <div class="mb-3 kolom">
                            <label for="checkbox_id" class="form-label orange ps-1 pe-1">Checkbox</label>
                            <input type="text" name="checkbox_id" class="form-control p-2" id="checkbox_id" placeholder="*Wajib di isi untuk pembuatan checkbox" required />
                            <p class="text-danger note"><small>Contoh : JaringanJalanCheckbox</small></p>
                        </div>
                        <!-- id_jenis_file -->
                        <div class="mb-3 kolom">
                            <label for="kategori" class="form-label orange ps-1 pe-1">Kategori</label>
                            <select name="kategori" id="kategori" class="form-select form-control p-2" required>
                                <option selected disabled>Pilih kategori</option>
                                <?php foreach ($getKategori as $a) : ?>
                                    <option value="<?= $a['id_kategori']; ?>"><?= $a['nama_kategori']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Jenis file -->
                        <div class="mb-3 kolom">
                            <label for="id_jenis_file" class="form-label orange ps-1 pe-1">Jenis file</label>
                            <select name="id_jenis_file" id="id_jenis_file" class="form-select form-control p-2" required>
                                <option selected disabled>Pilih jenis file</option>
                                <?php foreach ($getJenisFile as $a) : ?>
                                    <option value="<?= $a['jenis_file_id']; ?>"><?= $a['nama_jenis']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="btn-kirim d-flex justify-content-end">
                    <button type="submit" name="send" class="btn btn-primary w-25 p-2 mt-4"><i class="fa-solid fa-paper-plane"></i> Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include 'views/partials/script.php'; ?>
<?php include 'views/partials/starter-foot.php'; ?>