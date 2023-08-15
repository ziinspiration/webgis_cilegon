<?php
require '../functions/functions.php';
$keyword = $_GET['keyword'];
$query = "SELECT * FROM admin WHERE (nama_pegawai LIKE '%$keyword%' OR nik LIKE '%$keyword%') AND id <> 1";
$getdata = query($query);
?>

<?php if ($getdata) : ?>
    <div class="table-responsive">
        <table class="table table-striped m-auto mt-1">
            <thead>
                <tr class="fofa">
                    <th scope="col">No</th>
                    <th scope="col">Nama pegawai</th>
                    <th scope="col">NIP</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($getdata as $i => $a) : ?>
                    <tr>
                        <th class="text-center" scope="row"><?= $i + 1; ?></th>
                        <td><?= $a['nama_pegawai']; ?></td>
                        <td><?= $a['nik']; ?></td>
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