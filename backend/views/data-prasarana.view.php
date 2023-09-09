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
                    <a href="daftar-data-prasarana" class="card bg-light text-center text-decoration-none p-5">
                        <i class="bi bi-card-list"></i>
                        <p>Daftar data</p>
                    </a>
                </div>
                <div class="child-content">
                    <a href="tambah-data-prasarana" class="card bg-light text-center text-decoration-none p-5">
                        <i class="bi bi-folder-plus"></i>
                        <p>Tambah data</p>
                    </a>
                </div>
                <div class="child-content">
                    <a href="ubah-data-prasarana" class="card bg-light text-center text-decoration-none p-5">
                        <i class="bi bi-gear"></i>
                        <p>Update data</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'views/partials/script.php' ?>
<?php include 'views/partials/starter-foot.php' ?>