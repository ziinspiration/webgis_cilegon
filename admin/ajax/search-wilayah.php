<?php
require '../functions/functions.php';
$keyword = $_GET['keyword'];
$query = "SELECT * FROM wilayah WHERE kode_wilayah LIKE '%$keyword%' OR kecamatan LIKE '%$keyword%' OR daftar_kelurahan LIKE '%$keyword%' OR jumlah_kelurahan LIKE '%$keyword%'";
$getdata = query($query);
?>

<?php if ($getdata) : ?>
    <table class="table table-striped m-auto mt-1">
        <thead>
            <tr class="fofa">
                <th scope="col">Kode wilayah</th>
                <th scope="col">Kecamatan</th>
                <th scope="col">Jumlah kelurahan</th>
                <th scope="col">Daftar kelurahan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($getdata as $i => $a) : ?>
                <tr>
                    <th class="text-center" scope="row"><?= $a['kode_wilayah']; ?></th>
                    <td><?= $a['kecamatan']; ?></td>
                    <td><?= $a['jumlah_kelurahan']; ?></td>
                    <td><?= $a['daftar_kelurahan']; ?></td>
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