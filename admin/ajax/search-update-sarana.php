<?php
require '../functions/functions.php';
$keyword = $_GET['keyword'];
$query = "SELECT s.*, kd.nama_kategori 
          FROM sarana s 
          JOIN kategori_data kd ON s.kategori_id = kd.id_kategori
          WHERE s.nama_sarana LIKE '%$keyword%' 
             OR kd.nama_kategori LIKE '%$keyword%' 
             OR s.file_json LIKE '%$keyword%'
             OR s.jenis_data LIKE '%$keyword%'";
$getdata = query($query);
?>

<?php if ($getdata) : ?>
    <div id="search-container" class="table-responsive">
        <table class="table table-striped m-auto mt-1">
            <thead>
                <tr class="fofa">
                    <th scope="col">No</th>
                    <th scope="col">Nama data</th>
                    <th scope="col">File geojson</th>
                    <th class="text-center" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($getdata as $i => $a) : ?>
                    <tr>
                        <th class="text-center" scope="row"><?= $i + 1; ?></th>
                        <td><?= $a['nama_sarana']; ?></td>
                        <td><?= $a['file_json']; ?></td>
                        <td class="text-center"><a href="form-update-sarana?id=<?= $a["id"] ?>"><span class="badge bdg-a text-bg-warning p-2"><i class="fa-regular fa-pen-to-square"></i>
                                    Ubah</span></a> <span class="fw-bold spase">|</span> <a href="functions/delete-sarana.php?id=<?= $a["id"] ?>"><span class="badge text-bg-danger p-2"><i class="fa-solid fa-trash"></i> Hapus</span></a>
                        </td>
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