<?php include 'views/partials/starter-head.php'; ?>
<?php include 'views/partials/alert-tambah-data.php'; ?>
<style>
.table-res {
    overflow-y: auto !important;
}

@media screen and (max-width:990px) {
    .search-class {
        width: 65% !important;
    }
}

* {
    font-family: Montserrat;
}

th {
    padding: 10px !important;
}

td {
    padding: 10px !important;
}

.arrow-down {
    font-size: 40px !important;
    position: fixed !important;
    right: 0 !important;
    /* border: 2px solid orange !important;
    padding: 20px !important; */
    margin-right: 40px !important;
}

@media screen and (max-width: 550px) {
    .arrow-down {
        font-size: 35px !important;
        margin-right: 5px !important;
    }
}
</style>

<?php
if (isset($_POST['send'])) {
    $luas = isset($_POST['luas']) ? htmlspecialchars($_POST['luas'], ENT_QUOTES, 'UTF-8') : '';
    $kecamatan = isset($_POST['kecamatan']) ? htmlspecialchars($_POST['kecamatan'], ENT_QUOTES, 'UTF-8') : '';
    $kelurahan = isset($_POST['kelurahan']) ? htmlspecialchars($_POST['kelurahan'], ENT_QUOTES, 'UTF-8') : '';
    $keterangan = isset($_POST['keterangan']) ? htmlspecialchars($_POST['keterangan'], ENT_QUOTES, 'UTF-8') : '';
    $sumber = isset($_POST['sumber']) ? htmlspecialchars($_POST['sumber'], ENT_QUOTES, 'UTF-8') : '';
    $data_pokok_id = isset($_POST['data_pokok_id']) ? htmlspecialchars($_POST['data_pokok_id'], ENT_QUOTES, 'UTF-8') : '';

    // Prepare statement
    $query = "INSERT INTO atribut_rencana (data_pokok_id, luas, kecamatan, kelurahan, keterangan, sumber) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'isssss', $data_pokok_id, $luas, $kecamatan, $kelurahan, $keterangan, $sumber);

    // Execute query
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        $id_data_js = $id_data; // Ambil nilai $id_data dari PHP dan simpan dalam variabel JavaScript

        echo "
        <script>
        var id_data_js = $id_data_js; // Gunakan variabel JavaScript
        Swal.fire({
            icon: 'success',
            title: 'Data berhasil ditambahkan',
            text: 'Data berhasil ditambahkan ke dalam database.',
        }).then(function(result) {
            if (result.isConfirmed) {
                window.location.href = 'tambah-data-atribut-rencana?id=' + id_data_js;
            }
        });
        </script>";
        exit;
    } else {
        $errors[] = "Terjadi kesalahan saat menambahkan data: " . mysqli_error($conn);
    }
}

$i = 1;
?>

<div class="container-fluid">
    <h1 class="mt-5 mb-2 text-center text-dark">Daftar data atribut rencana</h1>
    <div class="arrow-down rounded-circle">
        <a class="orange" href="#form-tambah"><i class="bi bi-arrow-down-circle-fill"></i></a>
    </div>
    <div class="row justify-content-center">
        <div class="table-res d-flex w-75 m-auto mt-5">
            <table class="table table-striped table-hover mb-5 table-responsive">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kecamatan</th>
                        <th scope="col">Kelurahan</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Sumber</th>
                        <th scope="col">Luas</th>
                    </tr>
                </thead>
                <tbody id="table-data">
                    <?php foreach ($getdata as $a) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $a['kecamatan']; ?></td>
                        <td><?= $a['kelurahan']; ?></td>
                        <td><?= $a['keterangan']; ?></td>
                        <td><?= $a['sumber']; ?></td>
                        <td><?= $a['luas']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>


        <div id="form-tambah" class="formulir-tambah mb-4">
            <h1 class="mt-5 mb-5 text-center text-dark">Tambah data atribut rencana</h1>
            <form class="card w-75 p-4 bg-body-secondary m-auto" action="" method="post">
                <div class="mb-3">
                    <label for="kecamatan" class="form-label">Kecamatan</label>
                    <input type="text" class="form-control p-2" name="kecamatan">
                </div>
                <div class="mb-3">
                    <label for="kelurahan" class="form-label">Kelurahan</label>
                    <input type="text" class="form-control p-2" name="kelurahan">
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" class="form-control p-2" name="keterangan">
                </div>
                <div class="mb-3">
                    <label for="sumber" class="form-label">Sumber</label>
                    <input type="text" class="form-control p-2" name="sumber">
                </div>
                <div class="mb-3">
                    <label for="luas" class="form-label">Luas</label>
                    <input type="text" class="form-control p-2" name="luas">
                </div>
                <input type="hidden" name="data_pokok_id" value="<?= $id_data; ?>">
                <button type="submit" name="send" class="btn btn-primary w-25 py-2">Kirim</button>
            </form>
        </div>
    </div>
</div>

<?php include 'views/partials/script.php'; ?>
<?php include 'views/partials/starter-foot.php'; ?>