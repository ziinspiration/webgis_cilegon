<?php
require '../functions/functions.php';
$keyword = $_GET['keyword'];
$query = "SELECT * FROM prasarana JOIN jenis_file ON prasarana.id_jenis = jenis_file.jenis_file_id WHERE nama_prasarana LIKE '%$keyword%' OR file_json LIKE '%$keyword%' OR nama_jenis LIKE '%$keyword%' ORDER BY nama_prasarana ASC";
$getdata = query($query);
?>

<?php if ($getdata) : ?>
    <table class="table table-striped m-auto mt-1">
        <thead>
            <tr class="fofa">
                <th scope="col">No</th>
                <th scope="col">Nama data</th>
                <th scope="col">File geojson</th>
                <th class="text-center" scope="col">Detail</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($getdata as $i => $a) : ?>
                <tr>
                    <th class="text-center" scope="row"><?= $i + 1; ?></th>
                    <td><?= $a['nama_prasarana']; ?></td>
                    <td><?= $a['file_json']; ?></td>
                    <td class="text-center"><a href="detail-prasarana?id=<?= $a["id"] ?>"><i class="bi bi-eye-fill"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else :  ?>
    <div class="row">
        <div class="col-md-6 m-auto mt-5 text-center">
            <div class="alert alert-danger p-3" role="alert">
                Data not found!
            </div>
        </div>
    </div>
<?php endif; ?>