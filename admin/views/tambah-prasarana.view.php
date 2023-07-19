<?php include 'views/partials/starter-head.php'; ?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6">
            <form class="" action="" method="post" enctype="multipart/form-data">
                <!-- Nama -->
                <div class="mb-3">
                    <label for="nama_prasarana" class="form-label orange ps-1 pe-1">Nama data</label>
                    <input type="text" name="nama_prasarana" class="form-control" id="nama_prasarana" placeholder="Masukkan nama data" />
                </div>
                <!-- File -->
                <div class=" mb-3">
                    <label for="file_json" class="form-label orange ps-1 pe-1">File GeoJSON</label>
                    <input type="file" class="form-control" id="file_json" name="file_json" accept=".geojson" />
                </div>
                <!-- Checkbox id -->
                <div class=" mb-3">
                    <label for="checkbox_id" class="form-label orange ps-1 pe-1">Checkbox</label>
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