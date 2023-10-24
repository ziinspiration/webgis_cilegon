<?php include 'partials/starter-head.php' ?>
<style>
    .container {
        padding: 60px 40px !important;
    }

    @media screen and (max-width:550px) {
        .container {
            padding: 60px 0 !important;
        }
    }

    .btn-detail {
        transition: 0.7s !important;
    }

    .btn-detail:hover {
        color: orange !important;
        transition: 0.7s !important;
        transform: scale(1.1);
    }
</style>
<?php include 'partials/nav.php' ?>
<?php include 'partials/breadcrumb.php' ?>
<div class="container overflow-hidden">
    <div class="row justify-content-md-center">
        <!-- Content -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div data-aos="fade-right" data-aos-duration="1200" class="card">
                <div class="card-head d-flex">
                    <div class="icon-card text-center rounded-circle">
                        <i class="fa-solid fa-house"></i>
                    </div>
                    <div class="header">
                        <h3 class="text-center orange">Administrasi</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseOne">
                                    Selengkapnya..
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <ul class="parent-list">
                                        <?php foreach ($getadministrasi as $a) : ?>
                                            <li class="list-card">
                                                <form action="functions/tabular-administrasi.php" method="post">
                                                    <input type="hidden" name="id" value="<?= $a['id']; ?>">
                                                    <input type="hidden" name="nama_data" value="<?= $a['nama_data']; ?>">
                                                    <button class="btn btn-detail" type="submit"><?= $a['nama_data']; ?></button>
                                                </form>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div data-aos="zoom-in" data-aos-duration="1200" class="card">
                <div class="card-head d-flex">
                    <div class="icon-card text-center rounded-circle">
                        <i class="fa-sharp fa-solid fa-road"></i>
                    </div>
                    <div class="header">
                        <h3 class="text-center orange">Prasarana</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Selengkapnya..
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <ul class="parent-list">
                                        <?php foreach ($getprasarana as $a) : ?>
                                            <li class="list-card">
                                                <form action="functions/tabular-prasarana.php" method="post">
                                                    <input type="hidden" name="id" value="<?= $a['id']; ?>">
                                                    <input type="hidden" name="nama_data" value="<?= $a['nama_data']; ?>">
                                                    <button class="btn btn-detail" type="submit"><?= $a['nama_data']; ?></button>
                                                </form>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div data-aos="fade-left" data-aos-duration="1200" class="card">
                <div class="card-head d-flex">
                    <div class="icon-card text-center rounded-circle">
                        <i class="fa-solid fa-building"></i>
                    </div>
                    <div class="header">
                        <h3 class="text-center orange">Sarana</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseOne">
                                    Selengkapnya..
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <ul class="parent-list">
                                        <?php foreach ($getsarana as $a) : ?>
                                            <li class="list-card">
                                                <form action="functions/tabular-sarana.php" method="post">
                                                    <input type="hidden" name="id" value="<?= $a['id']; ?>">
                                                    <input type="hidden" name="nama_data" value="<?= $a['nama_data']; ?>">
                                                    <button class="btn btn-detail" type="submit"><?= $a['nama_data']; ?></button>
                                                </form>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div data-aos="fade-right" data-aos-duration="1200" class="card">
                <div class="card-head d-flex">
                    <div class="icon-card text-center rounded-circle">
                        <i class="fa-solid fa-earth-asia"></i>
                    </div>
                    <div class="header">
                        <h3 class="text-center orange">Tematik</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseOne">
                                    Selengkapnya..
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <ul class="parent-list">
                                        <?php foreach ($gettematik as $a) : ?>
                                            <li class="list-card">
                                                <form action="functions/tabular-tematik.php" method="post">
                                                    <input type="hidden" name="id" value="<?= $a['id']; ?>">
                                                    <input type="hidden" name="nama_data" value="<?= $a['nama_data']; ?>">
                                                    <button class="btn btn-detail" type="submit"><?= $a['nama_data']; ?></button>
                                                </form>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div data-aos="fade-left" data-aos-duration="1200" class="card">
                <div class="card-head d-flex">
                    <div class="icon-card text-center rounded-circle">
                        <i class="fa-solid fa-map"></i>
                    </div>
                    <div class="header">
                        <h3 class="text-center orange">Rencana</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseOne">
                                    Selengkapnya..
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <ul class="parent-list">
                                        <?php foreach ($getrencana as $a) : ?>
                                            <li class="list-card">
                                                <form action="functions/tabular-rencana.php" method="post">
                                                    <input type="hidden" name="id" value="<?= $a['id']; ?>">
                                                    <input type="hidden" name="nama_data" value="<?= $a['nama_data']; ?>">
                                                    <button class="btn btn-detail" type="submit"><?= $a['nama_data']; ?></button>
                                                </form>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'partials/footer.php' ?>
<?php include 'partials/script.php' ?>
<script type="text/javascript" src="assets/script/tilt.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<?php include 'partials/starter-foot.php' ?>