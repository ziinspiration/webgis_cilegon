<?php
require '../functions/functions.php';
$keyword = $_GET['keyword'];
$id = $_GET['id']; // Add this line to fetch the 'id' parameter
$query = "SELECT * FROM atribut_administrasi 
JOIN data_administrasi ON atribut_administrasi.data_pokok_id = data_administrasi.id 
WHERE atribut_administrasi.data_pokok_id = $id AND 
      (provinsi LIKE '%$keyword%' OR kabupaten LIKE '%$keyword%' OR 
      kecamatan LIKE '%$keyword%' OR kelurahan LIKE '%$keyword%' OR 
      sumber LIKE '%$keyword%')";

$getdata = query($query);
?>

<?php if ($getdata) : ?>
    <table class="table table-striped m-auto mt-1">
        <thead>
            <tr class="fofa">
                <th scope="col">Provinsi</th>
                <th scope="col">Kabupaten</th>
                <th scope="col">Kecamatan</th>
                <th scope="col">Kelurahan</th>
                <th scope="col">Sumber</th>
                <th scope="col">Luas</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($getdata as $a) : ?>
                <tr>
                    <td><?= $a['provinsi']; ?></td>
                    <td><?= $a['kabupaten']; ?></td>
                    <td><?= $a['kecamatan']; ?></td>
                    <td><?= $a['kelurahan']; ?></td>
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