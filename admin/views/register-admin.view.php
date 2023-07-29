<?php include 'views/partials/starter-head.php' ?>
<style>
@media screen and (max-width: 900px) {
    .content {
        flex-direction: column !important;
    }

    .child-content {
        margin: 20px !important;
    }
}
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div>
                <?php include 'partials/sidebar.php' ?>
            </div>
        </div>
        <div class="col-md-9">
            <div class="content d-flex justify-content-around mt-5">
                <div class="child-content">
                    <a href="daftar-akun" class="card bg-light text-center text-decoration-none p-5">
                        <i class="bi bi-people"></i>
                        <p>Daftar akun</p>
                    </a>
                </div>
                <div class="child-content">
                    <a href="tambah-admin" class="card bg-light text-center text-decoration-none p-5">
                        <i class="bi bi-person-add"></i>
                        <p>Tambah akun</p>
                    </a>
                </div>
                <!-- <div class="child-content">
                        <a href="ubah-akun.php" class="card bg-light text-center text-decoration-none p-5">
                            <i class="bi bi-person-gear"></i>
                            <p>Update akun</p>
                        </a>
                    </div> -->
            </div>
        </div>
    </div>
</div>
<?php include 'views/partials/script.php' ?>
<?php include 'views/partials/starter-foot.php' ?>