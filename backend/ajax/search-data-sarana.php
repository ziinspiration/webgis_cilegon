<?php
require '../functions/functions.php';
$keyword = $_GET['keyword'];
$id = $_GET['id']; // Add this line to fetch the 'id' parameter
$query = "SELECT * FROM atribut_sarana 
JOIN data_sarana ON atribut_sarana.data_pokok_id = data_sarana.id 
WHERE atribut_sarana.data_pokok_id = $id AND 
      (
      nama LIKE '%$keyword%' OR 
      keterangan LIKE '%$keyword%' OR 
      jenis LIKE '%$keyword%' OR
      x LIKE '%$keyword%' OR
      y LIKE '%$keyword%'
      )";

$getdata = query($query);
?>

<?php if ($getdata) : ?>
    <table class="table table-striped m-auto mt-1">
        <thead>
            <tr class="fofa">
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Jenis</th>
                <th scope="col">X</th>
                <th scope="col">Y</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($getdata as $i => $a) : ?>
                <tr>
                    <td><?= $i + 1; ?></td>
                    <td><?= $a['nama']; ?></td>
                    <td><?= $a['keterangan']; ?></td>
                    <td><?= $a['jenis']; ?></td>
                    <td><?= $a['x']; ?></td>
                    <td><?= $a['y']; ?></td>
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