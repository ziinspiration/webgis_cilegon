<?php
require '../functions/functions.php';
$keyword = $_GET['keyword'];
$query = "SELECT * FROM wilayah WHERE id_desa LIKE '%$keyword%' OR kecamatan LIKE '%$keyword%' OR ibukota LIKE '%$keyword%'";
$getdata = query($query);
?>

<?php if ($getdata) : ?>
    <table class="table table-striped m-auto mt-1">
        <thead>
            <tr class="fofa">
                <th scope="col">ID Desa</th>
                <th scope="col">Kecamatan</th>
                <th scope="col">Ibukota Kecamatan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($getdata as $i => $a) : ?>
                <tr>
                    <th class="text-center" scope="row"><?= $a['id_desa']; ?></th>
                    <td><?= $a['kecamatan']; ?></td>
                    <td><?= $a['ibukota']; ?></td>
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