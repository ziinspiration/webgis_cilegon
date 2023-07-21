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
                <a href="daftar-akun.php" class="card bg-light w-25 text-center text-decoration-none p-5">
                    <i class="bi bi-people"></i>
                    <p>Daftar akun</p>
                </a>

                <a href="tambah-admin.php" class="card bg-light w-25 text-center text-decoration-none p-5">
                    <i class="bi bi-person-add"></i>
                    <p>Tambah akun</p>
                </a>

                <a href="ubah-akun.php" class="card bg-light w-25 text-center text-decoration-none p-5">
                    <i class="bi bi-person-gear"></i>
                    <p>Update akun</p>
                </a>
            </div>
        </div>
    </div>
</div>
<?php include 'views/partials/script.php' ?>
<?php include 'views/partials/starter-foot.php' ?>