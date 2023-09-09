<?php
include 'views/partials/starter-head.php';
?>
<div class="container-fluid">
    <h1 class="mt-5 mb-2 text-center text-dark">Update data atribut rencana</h1>
    <div class="row w-75 m-auto">
        <div id="search-container" class="table-responsive mt-3">
            <table class="table table-striped m-auto mt-5">
                <thead>
                    <tr class="fofa">
                        <th scope="col">No</th>
                        <th scope="col">Nama Data</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($getdata as $a) : ?>
                        <tr>
                            <th class="=" scope="row"><?= $i++; ?></th>
                            <td>
                                <?= $a['nama_data']; ?>
                            </td>
                            <td>
                                <a class="text-warning me-2" href="ubah-atribut-rencana?id=<?= $a['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
<?php include 'views/partials/script.php' ?>
<script>
</script>

<?php include 'views/partials/starter-foot.php' ?>