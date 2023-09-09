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

.card i {
    font-size: 50px !important;
}

.card p {
    font-size: 18px !important;
}

.card {
    border-radius: 10px !important;
    transition: all 0.3s ease-in-out !important;
}

.card:hover {
    transform: scale(1.1);
    border: 2px solid orange;
    color: orange;
    opacity: 0.7;
}

@media screen and (max-width: 550px) {
    .content {
        flex-direction: column !important;
    }
}
</style>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="content d-flex justify-content-around mt-5">
                <div class="child-content">
                    <a href="tambah-baru-prasarana" class="card bg-light text-center text-decoration-none p-5">
                        <i class="bi bi-plus"></i>
                        <p>Tambah Data Baru</p>
                    </a>
                </div>
                <div class="child-content">
                    <a href="tambah-atribut-prasarana" class="card bg-light text-center text-decoration-none p-5">
                        <i class="bi bi-card-list"></i>
                        <p>Tambah Atribut Data</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'views/partials/script.php' ?>
<?php include 'views/partials/starter-foot.php' ?>