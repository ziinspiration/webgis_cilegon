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
    $nama = isset($_POST['nama']) ? htmlspecialchars($_POST['nama'], ENT_QUOTES, 'UTF-8') : '';
    $keterangan = isset($_POST['keterangan']) ? htmlspecialchars($_POST['keterangan'], ENT_QUOTES, 'UTF-8') : '';
    $x = isset($_POST['x']) ? htmlspecialchars($_POST['x'], ENT_QUOTES, 'UTF-8') : '';
    $y = isset($_POST['y']) ? htmlspecialchars($_POST['y'], ENT_QUOTES, 'UTF-8') : '';
    $jenis = isset($_POST['jenis']) ? htmlspecialchars($_POST['jenis'], ENT_QUOTES, 'UTF-8') : '';
    $data_pokok_id = isset($_POST['data_pokok_id']) ? htmlspecialchars($_POST['data_pokok_id'], ENT_QUOTES, 'UTF-8') : '';

    // Prepare statement
    $query = "INSERT INTO atribut_sarana (data_pokok_id, nama, keterangan, x, y, jenis) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'isssss', $data_pokok_id, $nama, $keterangan, $x, $y, $jenis);

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
                window.location.href = 'tambah-data-atribut-sarana?id=' + id_data_js;
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
    <h1 class="mt-5 mb-2 text-center text-dark">Daftar data atribut sarana</h1>
    <div class="row justify-content-center">
        <div class="table-res d-flex w-75 m-auto mt-5">
            <?php $i = 1; ?>
            <table class="table table-striped table-hover mb-5 table-responsive">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">X</th>
                        <th scope="col">Y</th>
                    </tr>
                </thead>
                <tbody id="table-data">
                    <?php foreach ($getdata as $a) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $a['nama']; ?></td>
                        <td><?= $a['keterangan']; ?></td>
                        <td><?= $a['jenis']; ?></td>
                        <td><?= $a['x']; ?></td>
                        <td><?= $a['y']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>


        <div class="formulir-tambah mb-4">
            <h1 class="mt-5 mb-5 text-center text-dark">Tambah data atribut sarana</h1>
            <form class="card w-75 p-4 bg-body-secondary m-auto" action="" method="post">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control p-2" name="nama">
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" class="form-control p-2" name="keterangan">
                </div>
                <div class="mb-3">
                    <label for="jenis" class="form-label">Jenis</label>
                    <input type="text" class="form-control p-2" name="jenis">
                </div>
                <div class="mb-3">
                    <label for="x" class="form-label">X</label>
                    <input type="text" class="form-control p-2" name="x">
                </div>
                <div class="mb-3">
                    <label for="y" class="form-label">Y</label>
                    <input type="text" class="form-control p-2" name="y">
                </div>
                <input type="hidden" name="data_pokok_id" value="<?= $id_data; ?>">
                <button type="submit" name="send" class="btn btn-primary w-25 py-2">Kirim</button>
            </form>
        </div>
    </div>
</div>

<?php include 'views/partials/script.php'; ?>
<?php include 'views/partials/starter-foot.php'; ?>