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
</style>

<?php
if (isset($_POST['send'])) {
    $keterangan = isset($_POST['keterangan']) ? htmlspecialchars($_POST['keterangan'], ENT_QUOTES, 'UTF-8') : '';
    $fungsi = isset($_POST['fungsi']) ? htmlspecialchars($_POST['fungsi'], ENT_QUOTES, 'UTF-8') : '';
    $kecamatan = isset($_POST['kecamatan']) ? htmlspecialchars($_POST['kecamatan'], ENT_QUOTES, 'UTF-8') : '';
    $kelurahan = isset($_POST['kelurahan']) ? htmlspecialchars($_POST['kelurahan'], ENT_QUOTES, 'UTF-8') : '';
    $sumber = isset($_POST['sumber']) ? htmlspecialchars($_POST['sumber'], ENT_QUOTES, 'UTF-8') : '';
    $luas = isset($_POST['luas']) ? htmlspecialchars($_POST['luas'], ENT_QUOTES, 'UTF-8') : '';
    $data_pokok_id = isset($_POST['data_pokok_id']) ? htmlspecialchars($_POST['data_pokok_id'], ENT_QUOTES, 'UTF-8') : '';

    // Prepare statement
    $query = "INSERT INTO atribut_tematik (data_pokok_id, keterangan, fungsi, kecamatan, kelurahan, sumber, luas) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'issssss', $data_pokok_id, $keterangan, $fungsi, $kecamatan, $kelurahan, $sumber, $luas);

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
                window.location.href = 'tambah-data-atribut-tematik?id=' + id_data_js;
            }
        });
        </script>";
        exit;
    } else {
        $errors[] = "Terjadi kesalahan saat menambahkan data: " . mysqli_error($conn);
    }
}
?>

<div class="container-fluid">
    <h1 class="mt-5 mb-2 text-center text-dark">Daftar data atribut tematik</h1>
    <div class="row justify-content-center">
        <div class="table-res d-flex w-75 m-auto mt-5">
            <table class="table table-striped table-hover mb-5 table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Kecamatan</th>
                        <th scope="col">Kelurahan</th>
                        <th scope="col">Keterangan</th>
                        <?php if (!empty($getdata[0]['fungsi'])) : ?>
                            <th scope="col">Fungsi</th>
                        <?php endif; ?>
                        <th scope="col">Sumber</th>
                        <th scope="col">Luas</th>
                    </tr>
                </thead>
                <tbody id="table-data">
                    <?php foreach ($getdata as $a) : ?>
                        <tr>
                            <td><?= $a['kecamatan']; ?></td>
                            <td><?= $a['kelurahan']; ?></td>
                            <td><?= $a['keterangan']; ?></td>
                            <?php if (!empty($a['fungsi'])) : ?>
                                <td><?= $a['fungsi']; ?></td>
                            <?php endif; ?>
                            <td><?= $a['sumber']; ?></td>
                            <td><?= $a['luas']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>


        <div class="formulir-tambah mb-4">
            <h1 class="mt-5 mb-5 text-center text-dark">Tambah data atribut tematik</h1>
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
                    <label for="fungsi" class="form-label">Fungsi</label>
                    <input type="text" class="form-control p-2" name="fungsi">
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