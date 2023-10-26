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
            <div id="legend" class="leaflet-control"></div>
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
            <!-- Rencana -->

            <!-- Administrasi -->
            <h6 class="mb-2 mt-4">Administrasi</h6>
            <ul class="list-unstyled">
                <p class="ms-3">Batas administrasi</p>
                <?php if (!empty($getadmin)) : ?>
                    <?php foreach ($getadmin as $a) : ?>
                        <li class="ms-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="<?= $a['checkbox_id']; ?>">
                                <label class="form-check-label" for="<?= $a['checkbox_id']; ?>">
                                    <?= $a['nama_rencana'] = ucwords($a['nama_rencana']); ?>
                                </label>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <li class="ms-3">
                        <div class="alert alert-secondary " role="alert">
                            Maaf saat ini data tidak tersedia
                        </div>
                    </li>
                <?php endif; ?>
            </ul>

            <!-- Pola ruang -->
            <h6 class="mb-2">Rencana pola ruang</h6>
            <ul class="list-unstyled">
                <p class="ms-3">Pola ruang</p>
                <?php if (!empty($getrencanaG)) : ?>
                    <?php foreach ($getrencanaG as $a) : ?>
                        <li class="ms-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="<?= $a['checkbox_id']; ?>">
                                <label class="form-check-label" for="<?= $a['checkbox_id']; ?>">
                                    <?= $a['nama_rencana'] = ucwords($a['nama_rencana']); ?>
                                </label>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <li class="ms-3">
                        <div class="alert alert-secondary " role="alert">
                            Maaf saat ini data tidak tersedia
                        </div>
                    </li>
                <?php endif; ?>
            </ul>

            <h6 class="mb-2">Rencana struktur ruang</h6>
            <!-- Sistem perkotaan -->
            <ul class="list-unstyled">
                <p class="ms-3">Sistem perkotaan</p>
                <?php if (!empty($getrencanaF)) : ?>
                    <?php foreach ($getrencanaF as $a) : ?>
                        <li class="ms-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="<?= $a['checkbox_id']; ?>">
                                <label class="form-check-label" for="<?= $a['checkbox_id']; ?>">
                                    <?= $a['nama_rencana'] = ucwords($a['nama_rencana']); ?>
                                </label>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <li class="ms-3">
                        <div class="alert alert-secondary " role="alert">
                            Maaf saat ini data tidak tersedia
                        </div>
                    </li>
                <?php endif; ?>
            </ul>

            <!-- Infrastruktur ruang -->
            <ul class="list-unstyled">
                <p class="ms-3">Infrastruktur ruang</p>
                <?php if (!empty($getrencanaA)) : ?>
                    <?php foreach ($getrencanaA as $a) : ?>
                        <li class="ms-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="<?= $a['checkbox_id']; ?>">
                                <label class="form-check-label" for="<?= $a['checkbox_id']; ?>">
                                    <?= $a['nama_rencana'] = ucwords($a['nama_rencana']); ?>
                                </label>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <li class="ms-3">
                        <div class="alert alert-secondary " role="alert">
                            Maaf saat ini data tidak tersedia
                        </div>
                    </li>
                <?php endif; ?>
            </ul>

            <!-- Rencana sistem jaringan energi -->
            <ul class="list-unstyled">
                <p class="ms-3">Rencana sistem jaringan energi</p>
                <?php if (!empty($getrencanaB)) : ?>
                    <?php foreach ($getrencanaB as $a) : ?>
                        <li class="ms-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="<?= $a['checkbox_id']; ?>">
                                <label class="form-check-label" for="<?= $a['checkbox_id']; ?>">
                                    <?= $a['nama_rencana'] = ucwords($a['nama_rencana']); ?>
                                </label>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <li class="ms-3">
                        <div class="alert alert-secondary " role="alert">
                            Maaf saat ini data tidak tersedia
                        </div>
                    </li>
                <?php endif; ?>
            </ul>

            <!-- Rencana sistem jaringan SDA -->
            <ul class="list-unstyled">
                <p class="ms-3">Rencana sistem jaringan SDA</p>
                <?php if (!empty($getrencanaC)) : ?>
                    <?php foreach ($getrencanaC as $a) : ?>
                        <li class="ms-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="<?= $a['checkbox_id']; ?>">
                                <label class="form-check-label" for="<?= $a['checkbox_id']; ?>">
                                    <?= $a['nama_rencana'] = ucwords($a['nama_rencana']); ?>
                                </label>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <li class="ms-3">
                        <div class="alert alert-secondary " role="alert">
                            Maaf saat ini data tidak tersedia
                        </div>
                    </li>
                <?php endif; ?>
            </ul>

            <!-- Rencana sistem jaringan telekomunikasi -->
            <ul class="list-unstyled">
                <p class="ms-3">Rencana sistem jaringan telekomunikasi</p>
                <?php if (!empty($getrencanaD)) : ?>
                    <?php foreach ($getrencanaD as $a) : ?>
                        <li class="ms-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="<?= $a['checkbox_id']; ?>">
                                <label class="form-check-label" for="<?= $a['checkbox_id']; ?>">
                                    <?= $a['nama_rencana'] = ucwords($a['nama_rencana']); ?>
                                </label>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <li class="ms-3">
                        <div class="alert alert-secondary " role="alert">
                            Maaf saat ini data tidak tersedia
                        </div>
                    </li>
                <?php endif; ?>
            </ul>

            <!-- Rencana sistem jaringan transportasi -->
            <ul class="list-unstyled">
                <p class="ms-3">Rencana sistem jaringan transportasi</p>
                <?php if (!empty($getrencanaE)) : ?>
                    <?php foreach ($getrencanaE as $a) : ?>
                        <li class="ms-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="<?= $a['checkbox_id']; ?>">
                                <label class="form-check-label" for="<?= $a['checkbox_id']; ?>">
                                    <?= $a['nama_rencana'] = ucwords($a['nama_rencana']); ?>
                                </label>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <li class="ms-3">
                        <div class="alert alert-secondary " role="alert">
                            Maaf saat ini data tidak tersedia
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>

<?php include 'partials/script-map.php' ?>
<script src="assets/leaflet-search/dist/leaflet-search.src.js"></script>
<!-- Scrip map -->
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
                var rencanaData = [
                    <?php foreach ($getadmin as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    <?php foreach ($getrencanaA as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    <?php foreach ($getrencanaB as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    <?php foreach ($getrencanaC as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    <?php foreach ($getrencanaD as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    <?php foreach ($getrencanaE as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    <?php foreach ($getrencanaF as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                    <?php foreach ($getrencanaG as $r) : ?> {
                            id: "<?= $r['checkbox_id']; ?>",
                            fileJson: "<?= $r['file_json']; ?>"
                        },
                    <?php endforeach; ?>
                ];

                for (var i = 0; i < rencanaData.length; i++) {
                    if (checkboxId === rencanaData[i].id) {
                        url = "assets/geojson/rencana/" + rencanaData[i].fileJson;
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

                        // Rencana
                        <?php foreach ($getrencanaA as $r) : ?>
                            if (checkbox.id === "<?= $r['checkbox_id']; ?>") {
                                customIcon = createCustomIcon<?= $r['icon_id']; ?>();
                            }
                        <?php endforeach; ?>
                        <?php foreach ($getrencanaB as $r) : ?>
                            if (checkbox.id === "<?= $r['checkbox_id']; ?>") {
                                customIcon = createCustomIcon<?= $r['icon_id']; ?>();
                            }
                        <?php endforeach; ?>
                        <?php foreach ($getrencanaC as $r) : ?>
                            if (checkbox.id === "<?= $r['checkbox_id']; ?>") {
                                customIcon = createCustomIcon<?= $r['icon_id']; ?>();
                            }
                        <?php endforeach; ?>
                        <?php foreach ($getrencanaD as $r) : ?>
                            if (checkbox.id === "<?= $r['checkbox_id']; ?>") {
                                customIcon = createCustomIcon<?= $r['icon_id']; ?>();
                            }
                        <?php endforeach; ?>
                        <?php foreach ($getrencanaE as $r) : ?>
                            if (checkbox.id === "<?= $r['checkbox_id']; ?>") {
                                customIcon = createCustomIcon<?= $r['icon_id']; ?>();
                            }
                        <?php endforeach; ?>
                        <?php foreach ($getrencanaF as $r) : ?>
                            if (checkbox.id === "<?= $r['checkbox_id']; ?>") {
                                customIcon = createCustomIcon<?= $r['icon_id']; ?>();
                            }
                        <?php endforeach; ?>
                        <?php foreach ($getrencanaG as $r) : ?>
                            if (checkbox.id === "<?= $r['checkbox_id']; ?>") {
                                customIcon = createCustomIcon<?= $r['icon_id']; ?>();
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
            <?php foreach ($getrencanaicon as $a) : ?> '<div class="legend-items" onclick="tampilkanPopupIcon(\'assets/icon/rencana/<?= $a['icon']; ?>\')"><span class="legend-icon"><img src="assets/icon/rencana/<?= $a['icon']; ?>" id="icon-<?= $a['checkbox_id']; ?>" class="icon-in-legend" alt=""></span><p class="text-in-legend" id="legend-text-<?= $a['checkbox_id']; ?>"><?= $a['nama_rencana']; ?></p></div>' +
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
        var popupContent = "<h3>Informasi Wilayah</h3> <hr>";
        if (feature.properties) {
            if (feature.properties.NAMA) {
                popupContent +=
                    "<p><b>Nama :</b> " + feature.properties.NAMA + "</p>";
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
            if (feature.properties.PROVINSI) {
                popupContent += "<p><b>Provinsi :</b> " + feature.properties.PROVINSI + "</p>";
            }
            if (feature.properties.KABUPATEN) {
                popupContent += "<p><b>Kabupaten :</b> " + feature.properties.KABUPATEN + "</p>";
            }
            if (feature.properties.KECAMATAN) {
                popupContent += "<p><b>Kecamatan :</b> " + feature.properties.KECAMATAN + "</p>";
            }
            if (feature.properties.KELURAHAN) {
                popupContent += "<p><b>Kelurahan :</b> " + feature.properties.KELURAHAN + "</p>";
            }
            if (feature.properties.FUNGSI) {
                popupContent += "<p><b>Fungsi :</b> " + feature.properties.FUNGSI + "</p>";
            }
            if (feature.properties.KODE_UNSUR) {
                popupContent +=
                    "<p><b>Kode unsur :</b> " + feature.properties.KODE_UNSUR + "</p>";
            }
            if (feature.properties.KETERANGAN) {
                popupContent +=
                    "<p><b>Keterangan :</b> " + feature.properties.KETERANGAN + "</p>";
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
            if (feature.properties.JENIS) {
                popupContent += "<p><b>Jenis :</b> " + feature.properties.JENIS + "</p>";
            }
            if (feature.properties.KETINGGIAN) {
                popupContent +=
                    "<p><b>Ketinggian :</b> " + feature.properties.KETINGGIAN + "</p>";
            }
            if (feature.properties.SUMBER) {
                popupContent += "<p><b>Sumber :</b> " + feature.properties.SUMBER + "</p>";
            }
            if (feature.properties.LUAS) {
                popupContent += "<p><b>Luas :</b> " + feature.properties.LUAS + "</p>";
            }
            if (feature.properties.X) {
                popupContent += "<p><b>X :</b> " + feature.properties.X + "</p>";
            }
            if (feature.properties.Y) {
                popupContent += "<p><b>Y :</b> " + feature.properties.Y + "</p>";
            }

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
    // Rencana A icon
    <?php foreach ($getrencanaA as $r) : ?>

        function createCustomIcon<?= $r['icon_id']; ?>() {
            var customIcon = L.icon({
                iconUrl: "assets/icon/rencana/<?= $r['icon']; ?>",
                iconSize: [20, 20],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32],
            });

            return customIcon;
        }
    <?php endforeach; ?>

    // Rencana A icon
    <?php foreach ($getrencanaB as $r) : ?>

        function createCustomIcon<?= $r['icon_id']; ?>() {
            var customIcon = L.icon({
                iconUrl: "assets/icon/rencana/<?= $r['icon']; ?>",
                iconSize: [20, 20],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32],
            });

            return customIcon;
        }
    <?php endforeach; ?>

    // Rencana C icon
    <?php foreach ($getrencanaC as $r) : ?>

        function createCustomIcon<?= $r['icon_id']; ?>() {
            var customIcon = L.icon({
                iconUrl: "assets/icon/rencana/<?= $r['icon']; ?>",
                iconSize: [20, 20],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32],
            });

            return customIcon;
        }
    <?php endforeach; ?>

    // Rencana D icon
    <?php foreach ($getrencanaD as $r) : ?>

        function createCustomIcon<?= $r['icon_id']; ?>() {
            var customIcon = L.icon({
                iconUrl: "assets/icon/rencana/<?= $r['icon']; ?>",
                iconSize: [20, 20],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32],
            });

            return customIcon;
        }
    <?php endforeach; ?>

    // Rencana E icon
    <?php foreach ($getrencanaE as $r) : ?>

        function createCustomIcon<?= $r['icon_id']; ?>() {
            var customIcon = L.icon({
                iconUrl: "assets/icon/rencana/<?= $r['icon']; ?>",
                iconSize: [20, 20],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32],
            });

            return customIcon;
        }
    <?php endforeach; ?>

    // Rencana F icon
    <?php foreach ($getrencanaF as $r) : ?>

        function createCustomIcon<?= $r['icon_id']; ?>() {
            var customIcon = L.icon({
                iconUrl: "assets/icon/rencana/<?= $r['icon']; ?>",
                iconSize: [20, 20],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32],
            });

            return customIcon;
        }
    <?php endforeach; ?>

    // Rencana G icon
    <?php foreach ($getrencanaG as $r) : ?>

        function createCustomIcon<?= $r['icon_id']; ?>() {
            var customIcon = L.icon({
                iconUrl: "assets/icon/rencana/<?= $r['icon']; ?>",
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