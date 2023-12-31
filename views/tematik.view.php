<?php include 'partials/starter-head.php' ?>
<link rel="stylesheet" href="assets/leaflet-search/dist/leaflet-search.src.css">
<style>
    /* Popup informasi */
    .custom-popup hr {
        opacity: 1;
    }

    .leaflet-popup-content-wrapper {
        border: 2px solid orange;
    }

    .leaflet-popup-content-wrapper h3 {
        color: orange;
        margin-top: 40px !important;
        text-align: center !important;
    }

    .leaflet-popup-content-wrapper p b {
        color: orange !important;
    }

    .leaflet-popup-content-wrapper p {
        color: grey !important;
    }

    .leaflet-popup-content-wrapper {
        background-color: #222 !important;
        color: #fff;
    }

    .leaflet-popup-tip {
        background-color: orange;
    }

    a.leaflet-popup-close-button {
        color: white !important;
        font-size: 25px !important;
        padding: 5px !important;
        margin-right: 10px !important;
        margin-bottom: 10px !important;
        transition: all .3s;
    }

    a.leaflet-popup-close-button :hover {
        color: red !important;
    }

    /* Tooltip */
    .leaflet-tooltip {
        background: rgba(255, 255, 255, 0);
        border: 0;
        border-radius: 0px;
        box-shadow: 0 0px 0px;
        font-size: 0.8em;
        color: black;
        text-shadow: 2px 2px 5px orange;
        font-weight: bold;
        text-align: center !important;
    }

    /* Legenda */
    .legend {
        background-color: #343a40 !important;
        padding: 10px !important;
        color: orange;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.4);
        overflow-y: scroll !important;
        width: 200px !important;
        height: 200px !important;
        font-family: poppins !important;
        z-index: 9999;
    }

    @media screen and (max-width: 550px) {
        .legend {
            width: 150px !important;
            height: 150px !important;
        }
    }

    .legend-items {
        display: flex !important;
        cursor: pointer;
    }

    .legend h5 {
        margin-top: 0;
        font-size: 16px;
        color: gainsboro !important;
        border-bottom: 1px solid grey;
        padding-bottom: 5px !important;
    }

    .legend p {
        font-size: 13px;
    }

    .legend-icon img {
        width: 22px !important;
        height: 22px !important;
        margin-right: 7px !important;
    }

    .perhatian {
        font-size: 13px;
    }

    .icon-in-legend {
        display: none;
    }

    .text-in-legend {
        display: none;
    }

    /* Popup Legenda */

    #legenda-popup {
        background-color: rgba(0, 0, 0, 0.8);
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 60%;
        height: 60%;
        display: none;
        padding: 20px;
        z-index: 9999;
        text-align: center;
        border-radius: 15px;
        border: 2px solid orange;
    }

    #legenda-popup img {
        max-width: 100%;
        max-height: 100%;
        display: block;
        margin: 0 auto;
        margin-top: auto;
        margin-bottom: 30px;
    }

    @media screen and (max-width:600px) {
        #legenda-popup {
            width: 85%;
            height: 70%;
        }
    }

    .closePreviewLegenda {
        font-family: Montserrat;
        font-size: 20px !important;
        color: white !important;
        cursor: pointer;
        margin-bottom: 30px !important;
    }

    .closePreviewLegenda:hover {
        color: red !important;
    }
</style>

<div class="map-container">
    <div id="legenda-popup"></div>
    <div id="loading-spinner">
        <img class="load-animation" src="assets/index/loading-animation.gif" alt="">
        <h5 class="text-center text-loading">Sedang memuat...</h5>
    </div>
    <div class="map-overlay">
        <p class="text-secondary mb-2 mb-1 bg-primary-subtle shadow rounded-1 px-2">
            <span id="signal-icon"></span>
            <span id="signal-text"></span>
            <span id="online-status"></span>
        </p>
        <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar" style="border: none; background: none;">
            <i class="bi bi-list"></i>
        </button>
    </div>
    <div id="map"></div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
    <div style="background: url(assets/index/batik2remake.jpg);" class="back p-2">
        <a class="back-arrow ms-1 text-decoration-none" href="index"><i class="bi bi-arrow-left me-1"><span>Beranda</span></i></a>
    </div>
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarLabel">Layer Service</h5>
        <button type="button" class="btn-c btn-close-canvas" data-bs-dismiss="offcanvas" aria-label="Close"><i class="bi bi-x-circle shake"></i></button>
    </div>
    <div class="img-nav d-flex">
        <img src="assets/logo/cilegon.png" style="height: 50px; width:50px;" class="ms-3 me-2">
        <p>Pemerintah Kota Cilegon <br> Badan Perencanaan Pembangunan Daerah</p>
    </div>
    <div class="offcanvas-body">
        <div class="sidebar-content">
            <ul class="list-unstyled">
                <h5 class="mb-3">Pilih Jenis Maps</h3>
                    <li class="ms-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="satelliteCheckbox">
                            <label class="form-check-label" for="satelliteCheckbox">Satellite</label>
                        </div>
                    </li>
                    <li class="ms-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="terrainCheckbox">
                            <label class="form-check-label" for="terrainCheckbox">Terrain</label>
                        </div>
                    </li>
                    <li class="ms-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="roadCheckbox" checked>
                            <label class="form-check-label" for="roadCheckbox">Road</label>
                        </div>
                    </li>
            </ul>
            <hr>
            <ul class="list-unstyled mt-3">
                <h5 class="mb-3">Wilayah Administrasi</h3>
                    <?php foreach ($getAdmin as $a) : ?>
                        <li class="ms-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="<?= $a['checkbox_id']; ?>">
                                <label class="form-check-label" for="<?= $a['checkbox_id']; ?>">
                                    <?= $a['nama_adm'] = ucwords($a['nama_adm']); ?>
                                </label>
                            </div>
                        </li>
                    <?php endforeach; ?>
            </ul>
            <!-- Tematik -->
            <h5 class="mb-3">Tematik</h5>
            <ul class="list-unstyled">
                <p class="text-danger perhatian"><small>*Jika anda tidak ingin data saling menimpa, harap matikan salah
                        satu checkbox</small></p>
                <?php foreach ($getTematik as $a) : ?>
                    <li class="ms-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="<?= $a['checkbox_id']; ?>">
                            <label class="form-check-label" for="<?= $a['checkbox_id']; ?>">
                                <?= $a['nama_tematik'] = ucwords($a['nama_tematik']); ?>
                            </label>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

            <ul class="list-unstyled">
                <p class="ms-3">Kebencanaan</p>
                <?php foreach ($getBencana as $a) : ?>
                    <li class="ms-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="<?= $a['checkbox_id']; ?>">
                            <label class="form-check-label" for="<?= $a['checkbox_id']; ?>">
                                <?= $a['nama_tematik'] = ucwords($a['nama_tematik']); ?>
                            </label>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
            <!-- Prasarana -->
            <h5 class="mb-3">Prasarana</h3>
                <ul class="list-unstyled">
                    <?php foreach ($JSONprasarana as $a) : ?>

                        <li class="ms-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="<?= $a['checkbox_id']; ?>">
                                <label class="form-check-label" for="<?= $a['checkbox_id']; ?>">
                                    <?= $a['nama_prasarana'] = ucwords($a['nama_prasarana']); ?>
                                </label>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <ul class="list-unstyled">
                    <p class="ms-3">Sistem & Jaringan</p>

                    <Small>
                        <p class="text-dark-subtle ms-5 mt-3 mb-1">Status Jalan</p>
                    </Small>
                    <?php foreach ($JSONjalanstatus as $a) : ?>
                        <li class="ms-5">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="<?= $a['checkbox_id']; ?>">
                                <label class="form-check-label" for="<?= $a['checkbox_id']; ?>">
                                    <?= $a['nama_prasarana'] = ucwords($a['nama_prasarana']); ?>
                                </label>
                            </div>
                        </li>
                    <?php endforeach; ?>

                    <Small>
                        <p class="text-dark-subtle ms-5 mt-3 mb-1">Fungsi Jalan</p>
                    </Small>
                    <?php foreach ($JSONjalanfungsi as $a) : ?>
                        <li class="ms-5">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="<?= $a['checkbox_id']; ?>">
                                <label class="form-check-label" for="<?= $a['checkbox_id']; ?>">
                                    <?= $a['nama_prasarana'] = ucwords($a['nama_prasarana']); ?>
                                </label>
                            </div>
                        </li>
                    <?php endforeach; ?>

                    <Small>
                        <p class="text-dark-subtle ms-5 mt-3 mb-1">Kondisi Jaringan</p>
                    </Small>
                    <?php foreach ($JSONjalankondisi as $a) : ?>
                        <li class="ms-5">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="<?= $a['checkbox_id']; ?>">
                                <label class="form-check-label" for="<?= $a['checkbox_id']; ?>">
                                    <?= $a['nama_prasarana'] = ucwords($a['nama_prasarana']); ?>
                                </label>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <ul class="list-unstyled">
                    <p class="ms-3">Air bersih</p>
                    <?php foreach ($JSONprasaranaAirbersih as $a) : ?>
                        <li class="ms-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="<?= $a['checkbox_id']; ?>">
                                <label class="form-check-label" for="<?= $a['checkbox_id']; ?>">
                                    <?= $a['nama_prasarana'] = ucwords($a['nama_prasarana']); ?>
                                </label>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <ul class="list-unstyled">
                    <p class="ms-3">Persampahan</p>
                    <?php foreach ($JSONprasaranaPersampahan as $a) : ?>
                        <li class="ms-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="<?= $a['checkbox_id']; ?>">
                                <label class="form-check-label" for="<?= $a['checkbox_id']; ?>">
                                    <?= $a['nama_prasarana'] = ucwords($a['nama_prasarana']); ?>
                                </label>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <!-- Sarana -->
                <ul class="list-unstyled">
                    <h5 class="mb-3">Sarana</h3>
                        <!-- Perkantoran -->
                        <p class="head-sarana mb-2 mt-3 ms-2">Perkantoran</p>
                        <?php foreach ($JSONkantor as $jk) : ?>
                            <li class="ms-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="<?= $jk['checkbox_id']; ?>">
                                    <label class="form-check-label" for="<?= $jk['checkbox_id']; ?>">
                                        <?= $jk['nama_sarana'] = ucwords($jk['nama_sarana']); ?>
                                    </label>
                                </div>
                            </li>
                        <?php endforeach; ?>
                        <?php foreach ($ZONASIkantor as $jp) : ?>
                            <p class="text-secondary ms-4"><small>Zonasi perkantoran</small></p>
                            <li class="ms-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="<?= $jp['checkbox_id']; ?>">
                                    <label class="form-check-label" for="<?= $jp['checkbox_id']; ?>">
                                        <?= $jp['nama_sarana'] = ucwords($jp['nama_sarana']); ?>
                                    </label>
                                </div>
                            </li>
                        <?php endforeach; ?>

                        <!-- Pendidikan -->
                        <p class="head-sarana mb-2 mt-3 ms-2">Pendidikan</p>
                        <?php foreach ($JSONpendidikan as $jp) : ?>
                            <li class="ms-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="<?= $jp['checkbox_id']; ?>">
                                    <label class="form-check-label" for="<?= $jp['checkbox_id']; ?>">
                                        <?= $jp['nama_sarana'] = ucwords($jp['nama_sarana']); ?>
                                    </label>
                                </div>
                            </li>
                        <?php endforeach; ?>

                        <p class="text-secondary ms-4 mb-1 mt-3"><small>Zonasi pendidikan</small></p>
                        <?php foreach ($ZONASIpendidikan as $jp) : ?>
                            <li class="ms-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="<?= $jp['checkbox_id']; ?>">
                                    <label class="form-check-label" for="<?= $jp['checkbox_id']; ?>">
                                        <?= $jp['nama_sarana'] = ucwords($jp['nama_sarana']); ?>
                                    </label>
                                </div>
                            </li>
                        <?php endforeach; ?>

                        <!-- Kesehatan -->
                        <p class="head-sarana mb-2 mt-3 ms-2">Kesehatan</p>
                        <?php foreach ($JSONkesehatan as $js) : ?>
                            <li class="ms-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="<?= $js['checkbox_id']; ?>">
                                    <label class="form-check-label" for="<?= $js['checkbox_id']; ?>">
                                        <?= $js['nama_sarana'] = ucwords($js['nama_sarana']); ?>
                                    </label>
                                </div>
                            </li>
                        <?php endforeach; ?>
                        <p class="text-secondary ms-4 mb-1 mt-3"><small>Zonasi kesehatan</small></p>
                        <?php foreach ($ZONASIkesehatan as $jp) : ?>
                            <li class="ms-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="<?= $jp['checkbox_id']; ?>">
                                    <label class="form-check-label" for="<?= $jp['checkbox_id']; ?>">
                                        <?= $jp['nama_sarana'] = ucwords($jp['nama_sarana']); ?>
                                    </label>
                                </div>
                            </li>
                        <?php endforeach; ?>

                        <!-- Pariwisata & Hiburan -->
                        <p class="head-sarana mb-2 mt-3 ms-2">Pariwisata & Hiburan</p>
                        <?php foreach ($JSONpariwisata as $p) : ?>
                            <li class="ms-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="<?= $p['checkbox_id']; ?>">
                                    <label class="form-check-label" for="<?= $p['checkbox_id']; ?>">
                                        <?= $p['nama_sarana'] = ucwords($p['nama_sarana']); ?>
                                    </label>
                                </div>
                            </li>
                        <?php endforeach; ?>
                        <?php foreach ($ZONASIpariwisata as $jp) : ?>
                            <p class="text-secondary ms-4 mb-1 mt-3"><small>Zonasi pariwisata</small></p>
                            <li class="ms-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="<?= $jp['checkbox_id']; ?>">
                                    <label class="form-check-label" for="<?= $jp['checkbox_id']; ?>">
                                        <?= $jp['nama_sarana'] = ucwords($jp['nama_sarana']); ?>
                                    </label>
                                </div>
                            </li>
                        <?php endforeach; ?>

                        <!-- Peribadatan -->
                        <p class="head-sarana mb-2 mt-3 ms-2">Peribadatan</p>
                        <?php foreach ($JSONperibadatan as $p) : ?>
                            <li class="ms-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="<?= $p['checkbox_id']; ?>">
                                    <label class="form-check-label" for="<?= $p['checkbox_id']; ?>">
                                        <?= $p['nama_sarana'] = ucwords($p['nama_sarana']); ?>
                                    </label>
                                </div>
                            </li>
                        <?php endforeach; ?>
                        <?php foreach ($ZONASIperibadatan as $jp) : ?>
                            <p class="text-secondary ms-4 mb-1 mt-3"><small>Zonasi peribadatan</small></p>
                            <li class="ms-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="<?= $jp['checkbox_id']; ?>">
                                    <label class="form-check-label" for="<?= $jp['checkbox_id']; ?>">
                                        <?= $jp['nama_sarana'] = ucwords($jp['nama_sarana']); ?>
                                    </label>
                                </div>
                            </li>
                        <?php endforeach; ?>

                        <!-- Transportasi -->
                        <p class="head-sarana mb-2 mt-3 ms-2">Sistem transportasi</p>
                        <?php foreach ($JSONtransportasi as $jt) : ?>
                            <li class="ms-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="<?= $jt['checkbox_id']; ?>">
                                    <label class="form-check-label" for="<?= $jt['checkbox_id']; ?>">
                                        <?= $jt['nama_sarana'] = ucwords($jt['nama_sarana']); ?>
                                    </label>
                                </div>
                            </li>
                        <?php endforeach; ?>
                        <?php foreach ($ZONASItransportasi as $jp) : ?>
                            <p class="text-secondary ms-4 mb-1 mt-3"><small>Zonasi sistem transportasi</small></p>
                            <li class="ms-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="<?= $jp['checkbox_id']; ?>">
                                    <label class="form-check-label" for="<?= $jp['checkbox_id']; ?>">
                                        <?= $jp['nama_sarana'] = ucwords($jp['nama_sarana']); ?>
                                    </label>
                                </div>
                            </li>
                        <?php endforeach; ?>

                        <!-- Fasilitas umum -->
                        <p class="head-sarana mb-2 mt-3 ms-2">Fasilitas olahraga</p>
                        <?php foreach ($JSONfasilitasolahraga as $fu) : ?>
                            <li class="ms-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="<?= $fu['checkbox_id']; ?>">
                                    <label class="form-check-label" for="<?= $fu['checkbox_id']; ?>">
                                        <?= $fu['nama_sarana'] = ucwords($fu['nama_sarana']); ?>
                                    </label>
                                </div>
                            </li>
                        <?php endforeach; ?>
                        <?php foreach ($ZONASIfasilitasolahraga as $jp) : ?>
                            <p class="text-secondary ms-4 mb-1 mt-3"><small>Zonasi fasilitas olahraga</small></p>
                            <li class="ms-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="<?= $jp['checkbox_id']; ?>">
                                    <label class="form-check-label" for="<?= $jp['checkbox_id']; ?>">
                                        <?= $jp['nama_sarana'] = ucwords($jp['nama_sarana']); ?>
                                    </label>
                                </div>
                            </li>
                        <?php endforeach; ?>

                        <!-- Perdagangan -->
                        <p class="head-sarana mb-2 mt-3 ms-2">Perdagangan & perniagaan</p>
                        <?php foreach ($JSONperdagangan as $fu) : ?>
                            <li class="ms-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="<?= $fu['checkbox_id']; ?>">
                                    <label class="form-check-label" for="<?= $fu['checkbox_id']; ?>">
                                        <?= $fu['nama_sarana'] = ucwords($fu['nama_sarana']); ?>
                                    </label>
                                </div>
                            </li>
                        <?php endforeach; ?>
                        <?php foreach ($ZONASIperdagangan as $jp) : ?>
                            <p class="text-secondary ms-4 mb-1 mt-3"><small>Zonasi perdagangan & perniagaan</small></p>
                            <li class="ms-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="<?= $jp['checkbox_id']; ?>">
                                    <label class="form-check-label" for="<?= $jp['checkbox_id']; ?>">
                                        <?= $jp['nama_sarana'] = ucwords($jp['nama_sarana']); ?>
                                    </label>
                                </div>
                            </li>
                        <?php endforeach; ?>

                        <!-- Pemakaman -->
                        <p class="head-sarana mb-2 mt-3 ms-2">Tempat pemakaman umum</p>
                        <?php foreach ($JSONpemakaman as $fu) : ?>
                            <li class="ms-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="<?= $fu['checkbox_id']; ?>">
                                    <label class="form-check-label" for="<?= $fu['checkbox_id']; ?>">
                                        <?= $fu['nama_sarana'] = ucwords($fu['nama_sarana']); ?>
                                    </label>
                                </div>
                            </li>
                        <?php endforeach; ?>
                        <?php foreach ($ZONASIpemakaman as $jp) : ?>
                            <p class="text-secondary ms-4 mb-1 mt-3"><small>Zonasi tempat pemakaman umum</small></p>
                            <li class="ms-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="<?= $jp['checkbox_id']; ?>">
                                    <label class="form-check-label" for="<?= $jp['checkbox_id']; ?>">
                                        <?= $jp['nama_sarana'] = ucwords($jp['nama_sarana']); ?>
                                    </label>
                                </div>
                            </li>
                        <?php endforeach; ?>
                </ul>
        </div>
    </div>
</div>

<?php include 'partials/script-map.php' ?>
<script src="assets/leaflet-search/dist/leaflet-search.src.js"></script>
<script>
    // LOADING SET
    const loadingSpinner = document.getElementById("loading-spinner");

    function showLoadingSpinner() {
        loadingSpinner.style.display = "flex";
    }

    function hideLoadingSpinner() {
        loadingSpinner.style.display = "none";
    }

    var map = L.map("map").setView([-5.992735076420852, 106.02561279458], 12);

    var googleLayer = L.tileLayer(
        "https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}", {
            maxZoom: 20,
            subdomains: ["mt0", "mt1", "mt2", "mt3"],
            attribution: "© Google Maps",
        }
    ).addTo(map);

    // MENGGANTI JENIS MAPS
    const satelliteCheckbox = document.getElementById("satelliteCheckbox");
    const terrainCheckbox = document.getElementById("terrainCheckbox");
    const roadCheckbox = document.getElementById("roadCheckbox");

    satelliteCheckbox.addEventListener("change", function() {
        if (satelliteCheckbox.checked) {
            terrainCheckbox.checked = false;
            roadCheckbox.checked = false;
            map.removeLayer(googleLayer);
            googleLayer = L.tileLayer(
                "https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}", {
                    maxZoom: 20,
                    subdomains: ["mt0", "mt1", "mt2", "mt3"],
                    attribution: "© Google Maps",
                }
            ).addTo(map);
        } else {
            map.removeLayer(googleLayer);
            googleLayer = L.tileLayer(
                "https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}", {
                    maxZoom: 20,
                    subdomains: ["mt0", "mt1", "mt2", "mt3"],
                    attribution: "© Google Maps",
                }
            ).addTo(map);
        }
    });

    terrainCheckbox.addEventListener("change", function() {
        if (terrainCheckbox.checked) {
            satelliteCheckbox.checked = false;
            roadCheckbox.checked = false;
            map.removeLayer(googleLayer);
            googleLayer = L.tileLayer(
                "https://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}", {
                    maxZoom: 20,
                    subdomains: ["mt0", "mt1", "mt2", "mt3"],
                    attribution: "© Google Maps",
                }
            ).addTo(map);
        } else {
            map.removeLayer(googleLayer);
            googleLayer = L.tileLayer(
                "https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}", {
                    maxZoom: 20,
                    subdomains: ["mt0", "mt1", "mt2", "mt3"],
                    attribution: "© Google Maps",
                }
            ).addTo(map);
        }
    });

    roadCheckbox.addEventListener("change", function() {
        if (roadCheckbox.checked) {
            satelliteCheckbox.checked = false;
            terrainCheckbox.checked = false;
            map.removeLayer(googleLayer);
            googleLayer = L.tileLayer(
                "https://{s}.google.com/vt/lyrs=r&x={x}&y={y}&z={z}", {
                    maxZoom: 20,
                    subdomains: ["mt0", "mt1", "mt2", "mt3"],
                    attribution: "© Google Maps",
                }
            ).addTo(map);
        } else {
            map.removeLayer(googleLayer);
            googleLayer = L.tileLayer(
                "https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}", {
                    maxZoom: 20,
                    subdomains: ["mt0", "mt1", "mt2", "mt3"],
                    attribution: "© Google Maps",
                }
            ).addTo(map);
        }
    });

    var geoJsonLayer = null;
    var currentLayers = [];
    var activeLayers = {};
    var searchControl = null;
    var searchResultMarkers = [];

    const checkboxGroup = document.querySelectorAll(".form-check-input");
    checkboxGroup.forEach(function(checkbox) {
        checkbox.addEventListener("change", function() {
            const checkboxId = this.id;
            const iconElement = document.getElementById("icon-" + checkboxId);
            const TextElement = document.getElementById("legend-text-" + checkboxId);

            if (this.checked) {
                var url;
                var tematikData = [
                    // Administrasi
                    <?php foreach ($getAdmin as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            folder: "administrasi/",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    // Kebencanaan
                    <?php foreach ($getTematik as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            folder: "tematik/",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    <?php foreach ($getBencana as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            folder: "tematik/",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    // Prasarana
                    <?php foreach ($JSONjalanstatus as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            folder: "prasarana/",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    <?php foreach ($JSONjalankondisi as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            folder: "prasarana/",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    <?php foreach ($JSONjalanfungsi as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            folder: "prasarana/",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    <?php foreach ($JSONprasarana as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            folder: "prasarana/",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    <?php foreach ($JSONprasaranaPersampahan as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            folder: "prasarana/",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    <?php foreach ($JSONprasaranaAirbersih as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            folder: "prasarana/",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    // POINT SARANA
                    <?php foreach ($JSONkantor as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            folder: "sarana/",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    <?php foreach ($JSONpendidikan as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            folder: "sarana/",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    <?php foreach ($JSONkesehatan as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            folder: "sarana/",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    <?php foreach ($JSONpariwisata as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            folder: "sarana/",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    <?php foreach ($JSONperibadatan as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            folder: "sarana/",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    <?php foreach ($JSONtransportasi as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            folder: "sarana/",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    <?php foreach ($JSONfasilitasolahraga as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            folder: "sarana/",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    <?php foreach ($JSONperdagangan as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            folder: "sarana/",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    <?php foreach ($JSONpemakaman as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            folder: "sarana/",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    // ZONASI SARANA
                    <?php foreach ($ZONASIkantor as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            folder: "sarana/",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    <?php foreach ($ZONASIpendidikan as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            folder: "sarana/",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    <?php foreach ($ZONASIkesehatan as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            folder: "sarana/",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    <?php foreach ($ZONASIpariwisata as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            folder: "sarana/",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    <?php foreach ($ZONASIperibadatan as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            folder: "sarana/",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    <?php foreach ($ZONASItransportasi as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            folder: "sarana/",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    <?php foreach ($ZONASIfasilitasolahraga as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            folder: "sarana/",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    <?php foreach ($ZONASIperdagangan as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            folder: "sarana/",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    <?php foreach ($ZONASIpemakaman as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            folder: "sarana/",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                ];

                for (var i = 0; i < tematikData.length; i++) {
                    if (checkboxId === tematikData[i].id) {
                        url = "assets/geojson/" + tematikData[i].folder + tematikData[i].fileJson;
                        addGeoJsonLayer(url, checkbox);
                    }
                }
                if (iconElement) {
                    iconElement.style.display = "block";
                }
                if (TextElement) {
                    TextElement.style.display = "block";
                }
            } else {
                removeGeoJsonLayer(checkbox);

                if (iconElement) {
                    iconElement.style.display = "none";
                }
                if (TextElement) {
                    TextElement.style.display = "none";
                }
            }
        });
    });


    // SETTING UNTUK LAYER
    function addGeoJsonLayer(url, checkbox) {

        showLoadingSpinner();

        fetch(url, {
                cache: "no-store"
            })
            .then(response => response.json())
            .then(data => {
                var geoJsonLayer = L.geoJson(data, {
                    style: function(feature) {
                        var color = feature.properties.color;

                        return {
                            fillColor: color,
                            fillOpacity: 0.7,
                            opacity: 0.7,
                            color: color,
                            weight: 2,
                        };
                    },
                    pointToLayer: function(feature, latlng) {

                        var customIcon = null;

                        // Prasarana
                        <?php foreach ($JSONprasarana as $jk) : ?>
                            if (checkbox.id === "<?= $jk['checkbox_id']; ?>") {
                                customIcon = createCustomIcon<?= $jk['icon_id']; ?>();
                            }
                        <?php endforeach; ?>
                        // Air bersih
                        <?php foreach ($JSONprasaranaAirbersih as $jk) : ?>
                            if (checkbox.id === "<?= $jk['checkbox_id']; ?>") {
                                customIcon = createCustomIcon<?= $jk['icon_id']; ?>();
                            }
                        <?php endforeach; ?>
                        // Persampahan
                        <?php foreach ($JSONprasaranaPersampahan as $jk) : ?>
                            if (checkbox.id === "<?= $jk['checkbox_id']; ?>") {
                                customIcon = createCustomIcon<?= $jk['icon_id']; ?>();
                            }
                        <?php endforeach; ?>
                        // Kantor
                        <?php foreach ($JSONkantor as $jk) : ?>
                            if (checkbox.id === "<?= $jk['checkbox_id']; ?>") {
                                customIcon = createCustomIcon<?= $jk['icon_id']; ?>();
                            }
                        <?php endforeach; ?>
                        // Pendidikan
                        <?php foreach ($JSONpendidikan as $pendidikan) : ?>
                            if (checkbox.id === "<?= $pendidikan['checkbox_id']; ?>") {
                                customIcon =
                                    createCustomIcon<?= $pendidikan['icon_id']; ?>();
                            }
                        <?php endforeach; ?>
                        // Kesehatan
                        <?php foreach ($JSONkesehatan as $kesehatan) : ?>
                            if (checkbox.id === "<?= $kesehatan['checkbox_id']; ?>") {
                                customIcon =
                                    createCustomIcon<?= $kesehatan['icon_id']; ?>();
                            }
                        <?php endforeach; ?>
                        // pariwisata
                        <?php foreach ($JSONpariwisata as $pariwisata) : ?>
                            if (checkbox.id === "<?= $pariwisata['checkbox_id']; ?>") {
                                customIcon =
                                    createCustomIcon<?= $pariwisata['icon_id']; ?>();
                            }
                        <?php endforeach; ?>
                        // peribadatan
                        <?php foreach ($JSONperibadatan as $peribadatan) : ?>
                            if (checkbox.id === "<?= $peribadatan['checkbox_id']; ?>") {
                                customIcon =
                                    createCustomIcon<?= $peribadatan['icon_id']; ?>();
                            }
                        <?php endforeach; ?>
                        // transportasi
                        <?php foreach ($JSONtransportasi as $transportasi) : ?>
                            if (checkbox.id ===
                                "<?= $transportasi['checkbox_id']; ?>") {
                                customIcon =
                                    createCustomIcon<?= $transportasi['icon_id']; ?>();
                            }
                        <?php endforeach; ?>
                        // fasilitasolahraga
                        <?php foreach ($JSONfasilitasolahraga as $fasilitasolahraga) : ?>
                            if (checkbox.id ===
                                "<?= $fasilitasolahraga['checkbox_id']; ?>") {
                                customIcon =
                                    createCustomIcon<?= $fasilitasolahraga['icon_id']; ?>();
                            }
                        <?php endforeach; ?>
                        // perdagangan
                        <?php foreach ($JSONperdagangan as $perdagangan) : ?>
                            if (checkbox.id === "<?= $perdagangan['checkbox_id']; ?>") {
                                customIcon =
                                    createCustomIcon<?= $perdagangan['icon_id']; ?>();
                            }
                        <?php endforeach; ?>
                        // pemakaman
                        <?php foreach ($JSONpemakaman as $pemakaman) : ?>
                            if (checkbox.id === "<?= $pemakaman['checkbox_id']; ?>") {
                                customIcon =
                                    createCustomIcon<?= $pemakaman['icon_id']; ?>();
                            }
                        <?php endforeach; ?>

                        return L.marker(latlng, {
                            icon: customIcon
                        });
                    },
                    onEachFeature: function(feature, layer) {
                        addTooltip(feature, layer);
                        showPopup(feature, layer);
                    },
                });

                geoJsonLayer.addTo(map);
                activeLayers[checkbox.id] = geoJsonLayer;
                updateSearchControl();

                hideLoadingSpinner();
            })
            .catch(error => {
                console.log('Error:', error);
                hideLoadingSpinner();
            });
    }

    function updateSearchControl() {
        if (searchControl) {
            map.removeControl(searchControl);
            searchControl = null;
        }

        for (var i = 0; i < searchResultMarkers.length; i++) {
            map.removeLayer(searchResultMarkers[i]);
        }
        searchResultMarkers = [];

        var allLayers = Object.values(activeLayers);

        searchControl = new L.Control.Search({
            layer: L.featureGroup(allLayers),
            propertyName: 'cari',
            marker: false,
            moveToLocation: function(latlng, title, map) {
                map.setView(latlng, 15);
            },
            initial: false,
        });

        searchControl.on('search:locationfound', function(e) {
            var marker = L.marker(e.latlng).addTo(map);
            marker.bindPopup(e.text).openPopup();

            searchResultMarkers.push(marker);
        });

        map.addControl(searchControl);
    }

    function removeGeoJsonLayer(checkbox) {
        if (activeLayers.hasOwnProperty(checkbox.id)) {
            map.removeLayer(activeLayers[checkbox.id]);
            delete activeLayers[checkbox.id];

            updateSearchControl();
        }
    }

    function onEachFeature(feature, layer) {
        layer.on({
            mouseover: highlightFeature,
            mouseout: resetHighlight,
            click: function(e) {
                zoomToFeature(e);
                showPopup(feature, layer);
                addTooltip(feature, layer);
            },
        });
    }

    var info = L.control();

    function tampilkanPopupIcon(iconURL) {
        var kontenPopup =
            '<div class="closePreviewLegenda" onclick="sembunyikanPopup()"><i class="bi bi-x-circle close-icon"></i> Tutup</div>' +
            '<img src="' + iconURL + '" alt="Gambar Ikon" width="80%" height="80%">';
        var legendaPopup = document.getElementById("legenda-popup");
        legendaPopup.innerHTML = kontenPopup;
        legendaPopup.style.display = "block";
    }

    function sembunyikanPopup() {
        var legendaPopup = document.getElementById("legenda-popup");
        legendaPopup.style.display = "none";
    }


    var legend = L.control({
        position: 'bottomright'
    });

    legend.onAdd = function(map) {
        var div = L.DomUtil.create('div', 'legend overflow-auto');
        div.innerHTML = '<h5 class="mb-3">Legenda</h5>' +
            <?php foreach ($gettematikicon as $a) : ?> '<div class="legend-items" onclick="tampilkanPopupIcon(\'assets/icon/tematik/<?= $a['icon']; ?>\')"><span class="legend-icon"><img src="assets/icon/tematik/<?= $a['icon']; ?>" id="icon-<?= $a['checkbox_id']; ?>" class="icon-in-legend" alt=""></span><p class="text-in-legend" id="legend-text-<?= $a['checkbox_id']; ?>"><?= ucwords($a['nama_tematik']); ?></p></div>' +
            <?php endforeach; ?>
        <?php foreach ($getprasaranaicon as $a) : ?>
                '<div class="legend-items" onclick="tampilkanPopupIcon(\'assets/icon/prasarana/<?= $a['icon']; ?>\')"><span class="legend-icon"><img src="assets/icon/prasarana/<?= $a['icon']; ?>" id="icon-<?= $a['checkbox_id']; ?>" class="icon-in-legend" alt=""></span><p class="text-in-legend" id="legend-text-<?= $a['checkbox_id']; ?>" onclick="tampilkanPopupIcon(\'assets/icon/prasarana/<?= $a['icon']; ?>\')"><?= ucwords($a['nama_prasarana']); ?></p></div>' +
            <?php endforeach; ?>
            <?php foreach ($getsaranaicon as $a) : ?>
                    '<div class="legend-items" onclick="tampilkanPopupIcon(\'assets/icon/sarana/<?= $a['icon']; ?>\')"><span class="legend-icon"><img src="assets/icon/sarana/<?= $a['icon']; ?>" id="icon-<?= $a['checkbox_id']; ?>" class=" icon-in-legend" alt=""></span><p class="text-in-legend" id="legend-text-<?= $a['checkbox_id']; ?>" onclick="tampilkanPopupIcon(\'assets/icon/sarana/<?= $a['icon']; ?>\')"><?= ucwords($a['nama_sarana']); ?></p></div>' +
                <?php endforeach; ?> '<div><span class="marker-icon"></span></div>';
                return div;
    };


    legend.addTo(map);

    // FUNGSI LAINNYA
    info.onAdd = function(map) {
        this._div = L.DomUtil.create("div", "info");
        return this._div;
    };

    info.addTo(map);

    function highlightFeature(e) {
        var layer = e.target;

        layer.setStyle({
            weight: 3,
            color: "black",
            fillOpacity: 1,
        });

        if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
            layer.bringToFront();
        }
    }

    function resetHighlight(e) {
        var layer = e.target;
        layer.setStyle({
            fillColor: color,
            fillOpacity: 0.7,
            opacity: 0.7,
            color: color,
            weight: 2
        });
    }

    function zoomToFeature(e) {
        map.fitBounds(e.target.getBounds());
    }

    // POP UP INFORMASI
    function showPopup(feature, layer) {
        var popupContent = "<div class='custom-popup'><h3>Informasi Wilayah</h3> <hr>";
        if (feature.properties) {
            if (feature.properties.TOPONIMI) {
                popupContent +=
                    "<p><b>Toponim :</b> " + feature.properties.TOPONIMI + "</p>";
            }
            if (feature.properties.TOPONIM) {
                popupContent +=
                    "<p><b>Toponim :</b> " + feature.properties.TOPONIM + "</p>";
            }
            if (feature.properties.CURAH_HUJAN) {
                popupContent +=
                    "<p><b>Curah hujan :</b> " + feature.properties.CURAH_HUJAN + "</p>";
            }
            if (feature.properties.POLA_RUANG) {
                popupContent +=
                    "<p><b>Pola ruang :</b> " + feature.properties.POLA_RUANG + "</p>";
            }
            if (feature.properties.FORMASI) {
                popupContent +=
                    "<p><b>Formasi :</b> " + feature.properties.FORMASI + "</p>";
            }
            if (feature.properties.NAMA_RUAS) {
                popupContent +=
                    "<p><b>Nama ruas :</b> " + feature.properties.NAMA_RUAS + "</p>";
            }
            if (feature.properties.NAMA) {
                popupContent +=
                    "<p><b>Nama :</b> " + feature.properties.NAMA + "</p>";
            }
            if (feature.properties.NAMOBJ) {
                popupContent +=
                    "<p><b>Nama :</b> " + feature.properties.NAMOBJ + "</p>";
            }
            if (feature.properties.NO_RUAS) {
                popupContent +=
                    "<p><b>No ruas :</b> " + feature.properties.NO_RUAS + "</p>";
            }
            if (feature.properties.KABUPATEN) {
                popupContent += "<p><b>Kabupaten :</b> " + feature.properties.KABUPATEN + "</p>";
            }
            if (feature.properties.KECAMATAN) {
                popupContent += "<p><b>Kecamatan :</b> " + feature.properties.KECAMATAN + "</p>";
            }
            if (feature.properties.KECAMATAN_) {
                popupContent += "<p><b>Kecamatan :</b> " + feature.properties.KECAMATAN_ + "</p>";
            }
            if (feature.properties.KELURAHAN) {
                popupContent += "<p><b>Kelurahan :</b> " + feature.properties.KELURAHAN + "</p>";
            }
            if (feature.properties.KELURAHAN_) {
                popupContent += "<p><b>Kelurahan :</b> " + feature.properties.KELURAHAN_ + "</p>";
            }
            if (feature.properties.kabupaten) {
                popupContent += "<p><b>Kabupaten :</b> " + feature.properties.kabupaten + "</p>";
            }
            if (feature.properties.kecamatan) {
                popupContent += "<p><b>Kecamatan :</b> " + feature.properties.kecamatan + "</p>";
            }
            if (feature.properties.kelurahan) {
                popupContent += "<p><b>Kelurahan :</b> " + feature.properties.kelurahan + "</p>";
            }
            if (feature.properties.kelurahan_) {
                popupContent += "<p><b>Kelurahan :</b> " + feature.properties.kelurahan_ + "</p>";
            }
            if (feature.properties.NM_RS_EKS) {
                popupContent += "<p><b>Nama ruas eksisting :</b> " + feature.properties.NM_RS_EKS +
                    "</p>";
            }
            if (feature.properties.NM_LK_SK) {
                popupContent += "<p><b>Nama lingkungan eksisting :</b> " + feature.properties
                    .NM_LK_SK + "</p>";
            }
            if (feature.properties.ZONASI) {
                popupContent +=
                    "<p><b>Zonasi :</b> " + feature.properties.ZONASI + "</p>";
            }
            if (feature.properties.SYS_AQ) {
                popupContent +=
                    "<p><b>SYS AQ :</b> " + feature.properties.SYS_AQ + "</p>";
            }
            if (feature.properties.PROD) {
                popupContent +=
                    "<p><b>Produktivitas :</b> " + feature.properties.PROD + "</p>";
            }
            if (feature.properties.KETERUSAN) {
                popupContent +=
                    "<p><b>Keterusan :</b> " + feature.properties.KETERUSAN + "</p>";
            }
            if (feature.properties.DEBIT) {
                popupContent +=
                    "<p><b>Debit :</b> " + feature.properties.DEBIT + "</p>";
            }
            if (feature.properties.CH) {
                popupContent +=
                    "<p><b>CH :</b> " + feature.properties.CH + "</p>";
            }
            if (feature.properties.LERENG) {
                popupContent +=
                    "<p><b>Lereng :</b> " + feature.properties.LERENG + "</p>";
            }
            if (feature.properties.TEMA) {
                popupContent +=
                    "<p><b>Tema :</b> " + feature.properties.TEMA + "</p>";
            }
            if (feature.properties.KIB) {
                popupContent += "<p><b>KIB :</b> " + feature.properties.KIB + "</p>";
            }
            if (feature.properties.JENIS) {
                popupContent += "<p><b>Jenis :</b> " + feature.properties.JENIS + "</p>";
            }
            if (feature.properties.TIPE) {
                popupContent += "<p><b>Tipe :</b> " + feature.properties.TIPE + "</p>";
            }
            if (feature.properties.FUNGSI) {
                popupContent += "<p><b>Fungsi :</b> " + feature.properties.FUNGSI + "</p>";
            }
            if (feature.properties.STATUS) {
                popupContent += "<p><b>Status :</b> " + feature.properties.STATUS + "</p>";
            }
            if (feature.properties.PANJANG) {
                popupContent += "<p><b>Panjang :</b> " + feature.properties.PANJANG + "</p>";
            }
            if (feature.properties.LEBAR) {
                popupContent += "<p><b>Lebar :</b> " + feature.properties.LEBAR + "</p>";
            }
            if (feature.properties.KETERANGAN) {
                popupContent +=
                    "<p><b>Keterangan :</b> " + feature.properties.KETERANGAN + "</p>";
            }
            if (feature.properties.LAYER) {
                popupContent +=
                    "<p><b>Keterangan :</b> " + feature.properties.LAYER + "</p>";
            }
            if (feature.properties.KET) {
                popupContent +=
                    "<p><b>Keterangan :</b> " + feature.properties.KET + "</p>";
            }
            if (feature.properties.LINGKUNGAN) {
                popupContent +=
                    "<p><b>Lingkungan :</b> " + feature.properties.LINGKUNGAN + "</p>";
            }
            if (feature.properties.PERKERASAN) {
                popupContent +=
                    "<p><b>Perkerasan :</b> " + feature.properties.PERKERASAN + "</p>";
            }
            if (feature.properties.KETINGGIAN) {
                popupContent +=
                    "<p><b>Ketinggian :</b> " + feature.properties.KETINGGIAN + "</p>";
            }
            if (feature.properties.KONDISI) {
                popupContent += "<p><b>Kondisi :</b> " + feature.properties.KONDISI + "</p>";
            }
            if (feature.properties.BUFF_DIST) {
                popupContent +=
                    "<p><b>Radius pelayanan :</b> " + feature.properties.BUFF_DIST + "</p>";
            }
            if (feature.properties.JJ_AWAL) {
                popupContent +=
                    "<p><b>Jaringan jalan awal :</b> " + feature.properties.JJ_AWAL + "</p>";
            }
            if (feature.properties.JJ_AKHIR) {
                popupContent +=
                    "<p><b>Jaringan jalan akhir :</b> " + feature.properties.JJ_AKHIR + "</p>";
            }
            if (feature.properties.PANJANG_SK) {
                popupContent +=
                    "<p><b>Panjang jalan SK :</b> " + feature.properties.PANJANG_SK + "</p>";
            }
            if (feature.properties.PANJANG_EK) {
                popupContent +=
                    "<p><b>Panjang jalan eksisting :</b> " + feature.properties.PANJANG_EK + "</p>";
            }
            if (feature.properties.LUAS) {
                popupContent += "<p><b>Luas :</b> " + feature.properties.LUAS + "</p>";
            }
            if (feature.properties.KODE_UNSUR) {
                popupContent +=
                    "<p><b>Kode unsur :</b> " + feature.properties.KODE_UNSUR + "</p>";
            }
            if (feature.properties.X) {
                popupContent +=
                    "<p><b>X :</b> " + feature.properties.X + "</p>";
            }
            if (feature.properties.Y) {
                popupContent +=
                    "<p><b>Y :</b> " + feature.properties.Y + "</p>";
            }
            if (feature.properties.SUMBER) {
                popupContent += "<p><b>Sumber :</b> " + feature.properties.SUMBER + "</p>";
            }
            if (feature.properties.SBDATA) {
                popupContent += "<p><b>Sumber :</b> " + feature.properties.SBDATA + "</p>";
            }
            popupContent += "</div>";
            layer.bindPopup(popupContent);
        } else {
            popupContent += "Informasi tidak tersedia";
            layer.bindPopup(popupContent);
        }
    }

    // TOOLTIP
    function addTooltip(feature, layer) {
        if (feature.properties && feature.properties.KABUPATEN) {
            layer.bindTooltip(feature.properties.KABUPATEN, {
                permanent: true,
                direction: 'center',
                className: 'leaflet-tooltip',
            }).openTooltip();
        }

        if (feature.properties && feature.properties.KOTA) {
            layer.bindTooltip(feature.properties.KOTA, {
                permanent: true,
                direction: 'center',
                className: 'leaflet-tooltip',
            }).openTooltip();
        }

        if (feature.properties && feature.properties.KECAMATAN) {
            layer.bindTooltip(feature.properties.KECAMATAN, {
                permanent: true,
                direction: 'center',
                className: 'leaflet-tooltip',
            }).openTooltip();
        }
        if (feature.properties && feature.properties.KELURAHAN) {
            layer.bindTooltip(feature.properties.KELURAHAN, {
                permanent: true,
                direction: 'center',
                className: 'leaflet-tooltip',
            }).openTooltip();
        }
    }

    // CUSTOM ICON
    // Prasarana icon
    <?php foreach ($JSONprasarana as $jk) : ?>

        function createCustomIcon<?= $jk['icon_id']; ?>() {
            var customIcon = L.icon({
                iconUrl: "assets/icon/prasarana/<?= $jk['icon']; ?>",
                iconSize: [20, 20],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32],
            });

            return customIcon;
        }
    <?php endforeach; ?>

    // Persampahan icon
    <?php foreach ($JSONprasaranaPersampahan as $jk) : ?>

        function createCustomIcon<?= $jk['icon_id']; ?>() {
            var customIcon = L.icon({
                iconUrl: "assets/icon/prasarana/<?= $jk['icon']; ?>",
                iconSize: [20, 20],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32],
            });

            return customIcon;
        }
    <?php endforeach; ?>

    // Air bersih icon
    <?php foreach ($JSONprasaranaAirbersih as $jk) : ?>

        function createCustomIcon<?= $jk['icon_id']; ?>() {
            var customIcon = L.icon({
                iconUrl: "assets/icon/prasarana/<?= $jk['icon']; ?>",
                iconSize: [20, 20],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32],
            });

            return customIcon;
        }
    <?php endforeach; ?>

    // Perkantoran icon
    <?php foreach ($JSONkantor as $jk) : ?>

        function createCustomIcon<?= $jk['icon_id']; ?>() {
            var customIcon = L.icon({
                iconUrl: "assets/icon/sarana/<?= $jk['icon']; ?>",
                iconSize: [20, 20],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32],
            });

            return customIcon;
        }
    <?php endforeach; ?>

    // Pendidikan icon
    <?php foreach ($JSONpendidikan as $pendidikan) : ?>

        function createCustomIcon<?= $pendidikan['icon_id']; ?>() {
            var customIcon = L.icon({
                iconUrl: "assets/icon/sarana/<?= $pendidikan['icon']; ?>",
                iconSize: [20, 20],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32],
            });

            return customIcon;
        }
    <?php endforeach; ?>

    // Kesehatan icon
    <?php foreach ($JSONkesehatan as $kesehatan) : ?>

        function createCustomIcon<?= $kesehatan['icon_id']; ?>() {
            var customIcon = L.icon({
                iconUrl: "assets/icon/sarana/<?= $kesehatan['icon']; ?>",
                iconSize: [20, 20],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32],
            });

            return customIcon;
        }
    <?php endforeach; ?>

    // Peribadatan icon
    <?php foreach ($JSONperibadatan as $peribadatan) : ?>

        function createCustomIcon<?= $peribadatan['icon_id']; ?>() {
            var customIcon = L.icon({
                iconUrl: "assets/icon/sarana/<?= $peribadatan['icon']; ?>",
                iconSize: [20, 20],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32],
            });

            return customIcon;
        }
    <?php endforeach; ?>

    // Pariwisata icon
    <?php foreach ($JSONpariwisata as $pariwisata) : ?>

        function createCustomIcon<?= $pariwisata['icon_id']; ?>() {
            var customIcon = L.icon({
                iconUrl: "assets/icon/sarana/<?= $pariwisata['icon']; ?>",
                iconSize: [20, 20],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32],
            });

            return customIcon;
        }
    <?php endforeach; ?>

    // Transportasi icon
    <?php foreach ($JSONtransportasi as $transportasi) : ?>

        function createCustomIcon<?= $transportasi['icon_id']; ?>() {
            var customIcon = L.icon({
                iconUrl: "assets/icon/sarana/<?= $transportasi['icon']; ?>",
                iconSize: [20, 20],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32],
            });

            return customIcon;
        }
    <?php endforeach; ?>

    // Fasilitas olahraga icon
    <?php foreach ($JSONfasilitasolahraga as $fasilitasolahraga) : ?>

        function createCustomIcon<?= $fasilitasolahraga['icon_id']; ?>() {
            var customIcon = L.icon({
                iconUrl: "assets/icon/sarana/<?= $fasilitasolahraga['icon']; ?>",
                iconSize: [20, 20],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32],
            });

            return customIcon;
        }
    <?php endforeach; ?>

    // Perdagangan icon
    <?php foreach ($JSONperdagangan as $perdagangan) : ?>

        function createCustomIcon<?= $perdagangan['icon_id']; ?>() {
            var customIcon = L.icon({
                iconUrl: "assets/icon/sarana/<?= $perdagangan['icon']; ?>",
                iconSize: [20, 20],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32],
            });

            return customIcon;
        }
    <?php endforeach; ?>

    // Pemakaman icon
    <?php foreach ($JSONpemakaman as $pemakaman) : ?>

        function createCustomIcon<?= $pemakaman['icon_id']; ?>() {
            var customIcon = L.icon({
                iconUrl: "assets/icon/sarana/<?= $pemakaman['icon']; ?>",
                iconSize: [20, 20],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32],
            });

            return customIcon;
        }
    <?php endforeach; ?>
</script>
<!-- Script signal status -->
<script>
    var oldSignalStrength = -1;

    function checkOnlineStatus() {
        if (navigator.onLine) {
            updateSignalStatus(oldSignalStrength, true);
        } else {
            displayNoSignal();
        }
    }

    function updateSignalStatus(signalStrength, isConnected) {
        var signalIcon = document.getElementById("signal-icon");
        var signalText = document.getElementById("signal-text");
        var onlineStatus = document.getElementById("online-status");

        signalIcon.innerHTML = '';

        if (isConnected) {
            if (signalStrength <= 50) {
                signalIcon.innerHTML = '<i class="bi bi-reception-4" style="color: green;"></i>';
                signalText.textContent = "Kuat";
            } else if (signalStrength <= 100) {
                signalIcon.innerHTML = '<i class="bi bi-reception-2" style="color: yellow;"></i>';
                signalText.textContent = "Sedang";
            } else {
                signalIcon.innerHTML = '<i class="bi bi-reception-1" style="color: red;"></i>';
                signalText.textContent = "Lemah";
            }
            onlineStatus.innerHTML = '| <i class="fa-solid fa-circle" style="color: green;"></i> Online';
        } else {
            signalIcon.innerHTML = '<i class="bi bi-dash-circle" style="color: gray;"></i>';
            signalText.textContent = "No Signal";
            onlineStatus.innerHTML = '| <i class="fa-solid fa-circle" style="color: gray;"></i> Offline';
        }
        if (oldSignalStrength !== -1) {
            animateSignalChange(signalStrength);
        }
        oldSignalStrength = signalStrength;
    }

    function animateSignalChange(newSignalStrength) {
        var signalIcon = document.getElementById("signal-icon");
        var signalText = document.getElementById("signal-text");

        signalIcon.style.opacity = 0;
        signalText.style.opacity = 0;

        setTimeout(function() {
            signalIcon.style.opacity = 1;
            signalText.style.opacity = 1;
            updateSignalStatus(newSignalStrength, true);
        }, 300);
    }

    function displayNoSignal() {
        var signalIcon = document.getElementById("signal-icon");
        var signalText = document.getElementById("signal-text");
        var onlineStatus = document.getElementById("online-status");

        signalIcon.innerHTML = '<i class="bi bi-reception-0 icon-koneksi" style="color: gray;"></i>';
        signalText.textContent = "No signal";
        onlineStatus.innerHTML = '| <i class="fa-solid fa-circle" style="color: gray;"></i> Offline';
    }

    setInterval(checkOnlineStatus, 5000);
    checkOnlineStatus();
</script>
<?php include 'partials/starter-foot.php' ?>