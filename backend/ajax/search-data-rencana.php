<?php
require '../functions/functions.php';
$keyword = $_GET['keyword'];
$id = $_GET['id']; // Add this line to fetch the 'id' parameter
$query = "SELECT * FROM atribut_rencana 
JOIN data_rencana ON atribut_rencana.data_pokok_id = data_rencana.id 
WHERE atribut_rencana.data_pokok_id = $id AND 
      (
      kecamatan LIKE '%$keyword%' OR 
      kelurahan LIKE '%$keyword%' OR 
      luas LIKE '%$keyword%' OR 
      keterangan LIKE '%$keyword%' OR
      sumber LIKE '%$keyword%'
      )";

$getdata = query($query);
?>

<?php if ($getdata) : ?>
<table class="table table-striped m-auto mt-1">
    <thead>
        <tr class="fofa">
            <th scope="col">No</th>
            <th scope="col">Kecamatan</th>
            <th scope="col">Kelurahan</th>
            <th scope="col">Sumber</th>
            <th scope="col">Luas</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($getdata as $i => $a) : ?>
        <tr>
            <td><?= $i + 1; ?></td>
            <td><?= $a['kecamatan']; ?></td>
            <td><?= $a['kelurahan']; ?></td>
            <td><?= $a['keterangan']; ?></td>
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