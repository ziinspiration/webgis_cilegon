<?php
require '../functions/functions.php';
$keyword = $_GET['keyword'];
$id = $_GET['id']; // Add this line to fetch the 'id' parameter
$query = "SELECT * FROM atribut_tematik 
JOIN data_tematik ON atribut_tematik.data_pokok_id = data_tematik.id 
WHERE atribut_tematik.data_pokok_id = $id AND 
      (
      keterangan LIKE '%$keyword%' OR luas LIKE '%$keyword%' OR 
      kecamatan LIKE '%$keyword%' OR kelurahan LIKE '%$keyword%' OR 
      sumber LIKE '%$keyword%' OR
      fungsi LIKE '%$keyword%'
      )";

$getdata = query($query);
?>

<?php if ($getdata) : ?>
<table class="table table-striped m-auto mt-1">
    <thead>
        <tr class="fofa">
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
    <tbody>
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
<?php else :  ?>
<div class="row">
    <div class="col-md-6 m-auto mt-5 text-center">
        <div class="alert alert-danger p-3" role="alert">
            Data not found!
        </div>
    </div>
</div>
<?php endif; ?>