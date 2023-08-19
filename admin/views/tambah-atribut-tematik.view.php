<?php include 'views/partials/starter-head.php'; ?>
<?php include 'views/partials/alert-tambah-data.php'; ?>
<style>
    .table-res {
        overflow-y: auto !important;
    }

    @media screen and (max-width:990px) {
        .search-class {
            width: 65% !important;
        }
    }

    * {
        font-family: Montserrat;
    }

    th {
        padding: 10px !important;
    }

    td {
        padding: 10px !important;
    }
</style>
<div class="container-fluids">
    <h1 class="mt-5 mb-2 text-center text-dark">Daftar data pokok tematik</h1>
    <div class="row justify-content-center">
        <!-- Center-align the row -->
        <div class="col">
            <!-- Search -->
            <!-- <div class="input-group search-class mb-5 mt-5 w-25">
                <input type="search" id="search" class="form-control input-search" placeholder="Cari disini"
                    aria-label="Cari disini" aria-describedby="button-addon2">
                <button class="btn btn-search btn-outline-secondary" type="button" id="cari"><i
                        class="bi bi-search"></i></button>
            </div> -->
            <!-- Table -->
            <div class="table-res d-flex w-75 m-auto mt-5">
                <table class="table table-striped table-hover mb-5 table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Data</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="table-data">
                        <?php foreach ($getdata as $a) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $a['nama_data']; ?></td>
                                <td><a href="tambah-data-atribut-tematik?id=<?= $a["id"] ?>"><i class="fa-solid fa-plus"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include 'views/partials/script.php'; ?>
<?php include 'views/partials/starter-foot.php'; ?>