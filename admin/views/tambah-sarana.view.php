<?php include 'views/partials/starter-head.php'; ?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6">
            <form class="" action="" method="post" enctype="multipart/form-data">
                <!-- Nama -->
                <div class="mb-3">
                    <label for="nama_sarana" class="form-label orange ps-1 pe-1">Nama data</label>
                    <input type="text" name="nama_sarana" class="form-control" id="nama_sarana" placeholder="Masukkan nama data" />
                </div>
                <!-- File GeoJSON -->
                <div class=" mb-3">
                    <label for="file_json" class="form-label orange ps-1 pe-1">File GeoJSON</label>
                    <input type="file" class="form-control" id="file_json" name="file_json" accept=".geojson" />
                </div>
                <!-- Kategori -->
                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="form-select form-control">
                        <option selected disabled>Pilih jenis kategori</option>
                        <?php foreach ($getkategori as $a) : ?>
                            <option value="<?= $a['id_kategori']; ?>"><?= $a['nama_kategori']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- ICON -->
                <div class=" mb-3">
                    <label for="icon" class="form-label orange ps-1 pe-1">File Icon</label>
                    <input type="file" class="form-control" id="icon" name="icon" accept=".jpg, .jpeg, .png" />
                </div>
                <!-- icon id -->
                <div class=" mb-3">
                    <label for="icon_id" class="form-label orange ps-1 pe-1">Icon ID</label>
                    <input type="text" name="icon_id" class="form-control" id="icon_id" placeholder="*Wajib di isi untuk pembuatan icon" />
                </div>
                <!-- Checkbox id -->
                <div class=" mb-3">
                    <label for="checkbox_id" class="form-label orange ps-1 pe-1">Checkbox ID</label>
                    <input type="text" name="checkbox_id" class="form-control" id="checkbox_id" placeholder="*Wajib di isi untuk pembuatan checkbox" />
                </div>
                <button type="submit" name="send" class="btn btn-primary m-auto w-50 p-2">
                    Kirim
                </button>
            </form>
        </div>
    </div>
</div>
<?php include 'views/partials/script.php'; ?>
<?php include 'views/partials/starter-foot.php'; ?>