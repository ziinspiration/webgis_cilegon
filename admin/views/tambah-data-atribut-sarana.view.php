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
    $data3 = isset($_POST['data3']) ? htmlspecialchars($_POST['data3'], ENT_QUOTES, 'UTF-8') : '';
    $data4 = isset($_POST['data4']) ? htmlspecialchars($_POST['data4'], ENT_QUOTES, 'UTF-8') : '';
    $data1 = isset($_POST['data1']) ? htmlspecialchars($_POST['data1'], ENT_QUOTES, 'UTF-8') : '';
    $data2 = isset($_POST['data2']) ? htmlspecialchars($_POST['data2'], ENT_QUOTES, 'UTF-8') : '';
    $data5 = isset($_POST['data5']) ? htmlspecialchars($_POST['data5'], ENT_QUOTES, 'UTF-8') : '';
    $data6 = isset($_POST['data6']) ? htmlspecialchars($_POST['data6'], ENT_QUOTES, 'UTF-8') : '';
    $data_pokok_id = isset($_POST['data_pokok_id']) ? htmlspecialchars($_POST['data_pokok_id'], ENT_QUOTES, 'UTF-8') : '';

    // Prepare statement
    $query = "INSERT INTO atribut_sarana (data_pokok_id, data3, data4, data1, data2, data5, data6) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'issssss', $data_pokok_id, $data3, $data4, $data1, $data2, $data5, $data6);

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
            <table class="table table-striped table-hover mb-5 table-responsive">
                <thead>
                    <tr>
                        <th scope="col">data1</th>
                        <th scope="col">data2</th>
                        <th scope="col">data3</th>
                        <?php if (!empty($getdata[0]['data4'])) : ?>
                            <th scope="col">data4</th>
                        <?php endif; ?>
                        <th scope="col">data5</th>
                        <th scope="col">data6</th>
                    </tr>
                </thead>
                <tbody id="table-data">
                    <?php foreach ($getdata as $a) : ?>
                        <tr>
                            <td><?= $a['data1']; ?></td>
                            <td><?= $a['data2']; ?></td>
                            <td><?= $a['data3']; ?></td>
                            <?php if (!empty($a['data4'])) : ?>
                                <td><?= $a['data4']; ?></td>
                            <?php endif; ?>
                            <td><?= $a['data5']; ?></td>
                            <td><?= $a['data6']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>


        <div class="formulir-tambah mb-4">
            <h1 class="mt-5 mb-5 text-center text-dark">Tambah data atribut sarana</h1>
            <form class="card w-75 p-4 bg-body-secondary m-auto" action="" method="post">
                <div class="mb-3">
                    <label for="data1" class="form-label">data1</label>
                    <input type="text" class="form-control p-2" name="data1">
                </div>
                <div class="mb-3">
                    <label for="data2" class="form-label">data2</label>
                    <input type="text" class="form-control p-2" name="data2">
                </div>
                <div class="mb-3">
                    <label for="data3" class="form-label">data3</label>
                    <input type="text" class="form-control p-2" name="data3">
                </div>
                <div class="mb-3">
                    <label for="data4" class="form-label">data4</label>
                    <input type="text" class="form-control p-2" name="data4">
                </div>
                <div class="mb-3">
                    <label for="data5" class="form-label">data5</label>
                    <input type="text" class="form-control p-2" name="data5">
                </div>
                <div class="mb-3">
                    <label for="data6" class="form-label">data6</label>
                    <input type="text" class="form-control p-2" name="data6">
                </div>
                <input type="hidden" name="data_pokok_id" value="<?= $id_data; ?>">
                <button type="submit" name="send" class="btn btn-primary w-25 py-2">Kirim</button>
            </form>
        </div>
    </div>
</div>

<?php include 'views/partials/script.php'; ?>
<?php include 'views/partials/starter-foot.php'; ?>