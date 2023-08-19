<?php include 'partials/starter-head.php' ?>
<style>
.table-res {
    overflow-y: auto !important;
}

@media screen and (max-width:990px) {
    .search-class {
        width: 65% !important;
    }
}
</style>
<?php include 'partials/nav.php' ?>
<?php include 'partials/breadcrumb.php' ?>
<div class="container">
    <div class="row">
        <div class="col">
            <!-- Search -->
            <div class="input-group search-class mb-5 mt-5 w-25">
                <input type="search" id="search" class="form-control input-search" placeholder="Cari disini"
                    aria-label="Cari disini" aria-describedby="button-addon2">
                <button class="btn btn-search btn-outline-secondary" type="button" id="cari"><i
                        class="bi bi-search"></i></button>
            </div>
            <!-- Table -->
            <div class="table-res">
                <table class="table table-striped table-hover mb-5 table-responsive">
                    <thead>
                        <tr>
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
                    <tbody id="table-data">
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
            </div>
        </div>
    </div>
</div>
<?php include 'partials/footer.php' ?>
<?php include 'partials/script.php' ?>
<?php include 'partials/starter-foot.php' ?>