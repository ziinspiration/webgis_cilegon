<?php include 'views/partials/starter-head.php' ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div>
                <?php include 'partials/sidebar.php' ?>
            </div>
        </div>
        <div class="col-md-9">
            <div class="content d-flex justify-content-around">
                <a href="daftar-administrasi.php" class="card bg-light w-25 text-center text-decoration-none p-5">
                    <i class="bi bi-card-list"></i>
                    <p>Daftar data</p>
                </a>

                <a href="tambah-administrasi.php" class="card bg-light w-25 text-center text-decoration-none p-5">
                    <i class="bi bi-folder-plus"></i>
                    <p>Tambah data</p>
                </a>

                <a href="ubah-administrasi.php" class="card bg-light w-25 text-center text-decoration-none p-5">
                    <i class="bi bi-gear"></i>
                    <p>Update data</p>
                </a>
            </div>
        </div>
    </div>
</div>
<?php include 'views/partials/starter-foot.php' ?>