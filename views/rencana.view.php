<?php include 'partials/starter-head.php' ?>

<style>
.leaflet-popup-content-wrapper hr {
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
    font-weight: 500;
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

.legend {
    background-color: #343a40 !important;
    padding: 10px !important;
    color: orange;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.4);
    overflow-y: scroll !important;
    width: 150px !important;
    height: 150px !important;
    font-family: poppins !important;
}

@media screen and (max-width: 550px) {
    .legend {
        width: 125px !important;
        height: 125px !important;
    }
}

.legend-items {
    display: flex !important;
}

.legend h5 {
    margin-top: 0;
    font-size: 16px;
    color: gainsboro !important;
    border-bottom: 1px solid grey;
    padding-bottom: 5px !important;
}

.legend p {
    font-size: 10px;
    margin-top: 2px !important;
}

.legend-icon img {
    width: 13px !important;
    height: 13px !important;
    margin-right: 4px !important;
}

.alert-secondary {
    text-align: center !important;
}
</style>

<div class="map-container">
    <div class="map-overlay">
        <p class="text-secondary mb-2 mb-1 bg-primary-subtle shadow rounded-1 px-2">
            <span id="signal-icon"></span>
            <span id="signal-text"></span>
            <span id="online-status"></span>
        </p>
        <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar"
            style="border: none; background: none;">
            <i class="bi bi-list"></i>
        </button>
        <div id="legend" class="leaflet-control"></div>
    </div>
    <div id="map"></div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
    <div style="background: url(assets/index/batik2remake.jpg);" class="back p-2">
        <a class="back-arrow ms-1 text-decoration-none" href="index"><i
                class="bi bi-arrow-left me-1"><span>Beranda</span></i></a>
    </div>
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarLabel">Layer Service</h5>
        <button type="button" class="btn-c btn-close-canvas" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="bi bi-x-circle shake"></i></button>
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
                        <label class="form-check-label"
                            for="<?= $a['checkbox_id']; ?>"><?= $a['nama_rencana']; ?></label>
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
                        <label class="form-check-label"
                            for="<?= $a['checkbox_id']; ?>"><?= $a['nama_rencana']; ?></label>
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
                        <label class="form-check-label"
                            for="<?= $a['checkbox_id']; ?>"><?= $a['nama_rencana']; ?></label>
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
                        <label class="form-check-label"
                            for="<?= $a['checkbox_id']; ?>"><?= $a['nama_rencana']; ?></label>
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
                        <label class="form-check-label"
                            for="<?= $a['checkbox_id']; ?>"><?= $a['nama_rencana']; ?></label>
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
                        <label class="form-check-label"
                            for="<?= $a['checkbox_id']; ?>"><?= $a['nama_rencana']; ?></label>
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
                        <label class="form-check-label"
                            for="<?= $a['checkbox_id']; ?>"><?= $a['nama_rencana']; ?></label>
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
                        <label class="form-check-label"
                            for="<?= $a['checkbox_id']; ?>"><?= $a['nama_rencana']; ?></label>
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

<!-- Scrip map -->
<script>
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

var currentLayers = []; // Menyimpan semua layer yang sedang ditampilkan

const checkboxGroup = document.querySelectorAll(".form-check-input");
checkboxGroup.forEach(function(checkbox) {
    checkbox.addEventListener("change", function() {
        if (this.checked) {
            var url;
            var checkboxId = this.id;
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
        } else {
            removeGeoJsonLayer(checkbox);
        }
    });
});

// SETTING UNTUK LAYER
function addGeoJsonLayer(url, checkbox) {
    fetch(url)
        .then(response => response.json())
        .then(data => {

            var layer = L.geoJson(data, {
                style: function(feature) {
                    var color = feature.properties.color;
                    var darray = feature.properties.dasharray;
                    var doffset = feature.properties.dashoffset;

                    return {
                        fillColor: color,
                        fillOpacity: 0.7,
                        opacity: 0.7,
                        color: color,
                        weight: 1.5,
                        dashArray: darray,
                        dashOffset: doffset,
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
                onEachFeature: onEachFeature,
            });

            currentLayers.push({
                checkbox: checkbox,
                layer: layer
            });

            if (checkbox.checked) {
                layer.addTo(map);
            }
        })
        .catch(error => {
            console.log('Error:', error);
        });
}

function removeGeoJsonLayer(checkbox) {
    var indexToRemove = currentLayers.findIndex(function(layerObj) {
        return layerObj.checkbox === checkbox;
    });

    if (indexToRemove !== -1) {
        var layerObj = currentLayers.splice(indexToRemove, 1)[0];
        map.removeLayer(layerObj.layer);
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

// FUNGSI MENAMBAHKAN LEGENDA PADA MAP
var legend = L.control({
    position: 'bottomright'
});

legend.onAdd = function(map) {
    var div = L.DomUtil.create('div', 'legend');
    div.innerHTML = '<h5 class="mb-3">Legenda</h5>' +

        <?php foreach ($getlegenda as $a) : ?> '<div class="legend-items"><span class="legend-icon"><img src="assets/icon/rencana/<?= $a['icon']; ?>"></span><p><?= $a['nama_rencana']; ?></p></div>' +
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
        color: "grey",
        dashArray: "",
        fillOpacity: 0.3,
    });

    if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
        layer.bringToFront();
    }
}

function resetHighlight(e) {
    var layer = e.target;
    layer.setStyle({
        weight: 2.5,
        color: layer.feature.properties.color,
        fillOpacity: 0.5,
        dashArray: layer.feature.properties.dasharray,
        dashOffset: layer.feature.properties.dashoffset,
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

// Menggunakan pop-up informasi pada setiap layer
function onEachFeature(feature, layer) {
    layer.on({
        click: function(e) {
            showPopup(feature, layer);
        }
    });
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