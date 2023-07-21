<?php
require '../functions/functions.php';
$keyword = $_GET['keyword'];
$query = "SELECT * FROM tematik WHERE nama_tematik LIKE '%$keyword%' OR file_json LIKE '%$keyword%'";
$getdata = query($query);
?>

<?php if ($getdata) : ?>
<div class="table-responsive">
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
                <td><?= $a['nama_tematik']; ?></td>
                <td><?= $a['file_json']; ?></td>
                <td class="text-center"><a href="detail-tematik.php?id=<?= $a["id"] ?>"><i
                            class="bi bi-eye-fill"></i></a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php else :  ?>
<div class="row">
    <div class="col-md-6 m-auto mt-5 text-center">
        <div class="alert alert-danger p-3" role="alert">
            Data not found!
        </div>
    </div>
</div>
<?php endif; ?>