<?php
require '../functions/functions.php';
$keyword = $_GET['keyword'];
$query = "SELECT * FROM skpd WHERE nama_dinas LIKE '%$keyword%' OR alamat LIKE '%$keyword%'";
$getdata = query($query);
?>

<?php if ($getdata) : ?>
<table class="table table-striped m-auto mt-1">
    <thead>
        <tr class="fofa">
            <th scope="col">No</th>
            <th scope="col">Nama Dinas</th>
            <th scope="col">Alamat Dinas</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($getdata as $i => $a) : ?>
        <tr>
            <th class="text-center" scope="row"><?= $i + 1; ?></th>
            <td><?= $a['nama_dinas']; ?></td>
            <td><?= $a['alamat']; ?></td>
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