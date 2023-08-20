<?php include 'partials/starter-head.php' ?>
<?php include 'partials/nav.php' ?>
<?php include 'partials/breadcrumb.php' ?>
<div class="container">
    <div class="row justify-content-md-center">
        <!-- Content 5 -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card">
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
                                        <?php foreach ($getadministrasi as $adm) : ?>
                                            <li class="list-card">
                                                <a href="detail-data-administrasi?id=<?= $adm['id']; ?>">
                                                    <?= $adm['nama_data']; ?>
                                                </a>
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
        <!-- Content 1 -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card">
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
                                                <a href="detail-data-prasarana?id=<?= $a['id']; ?>">
                                                    <?= $a['nama_data']; ?>
                                                </a>
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
        <!-- Content 2 -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card">
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
                                                <a href="detail-data-sarana?id=<?= $a['id']; ?>">
                                                    <?= $a['nama_data']; ?>
                                                </a>
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
        <!-- Content 3 -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card">
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
                                                <a href="detail-data-tematik?id=<?= $a['id']; ?>">
                                                    <?= $a['nama_data']; ?>
                                                </a>
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
        <!-- Content 4 -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card">
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
                                                <a href="detail-data-rencana?id=<?= $a['id']; ?>">
                                                    <?= $a['nama_data']; ?>
                                                </a>
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
<?php include 'partials/starter-foot.php' ?>