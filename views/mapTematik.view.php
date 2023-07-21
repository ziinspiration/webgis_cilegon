<?php include 'partials/starter-head.php' ?>

<div class="map-container">
    <div class="map-overlay">
        <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar"
            style="border: none; background: none;">
            <i class="bi bi-list"></i>
        </button>
    </div>
    <div id="map"></div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
    <div style="background: url(assets/index/batik2remake.jpg);" class="back p-2">
        <a class="back-arrow ms-1 text-decoration-none" href="index.php"><i
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
            <!-- Tematik -->
            <ul class="list-unstyled">
                <h5 class="mb-3">Tematik</h3>
                    <?php foreach ($getTematik as $a) : ?>
                    <li class="ms-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="<?= $a['checkbox_id']; ?>">
                            <label class="form-check-label"
                                for="<?= $a['checkbox_id']; ?>"><?= $a['nama_tematik']; ?></label>
                        </div>
                    </li>
                    <?php endforeach; ?>
            </ul>
            <!-- Rencana -->
            <ul class="list-unstyled">
                <h5 class="mb-3">Rencana</h3>
                    <?php foreach ($getRencana as $j) : ?>
                    <li class="ms-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="<?= $j['checkbox_id']; ?>">
                            <label class="form-check-label"
                                for="<?= $j['checkbox_id']; ?>"><?= $j['nama_rencana']; ?></label>
                        </div>
                    </li>
                    <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<?php include 'partials/script.php' ?>

<script>
var map = L.map("map").setView([-5.992735076420852, 106.02561279458], 12);

var googleLayer = L.tileLayer(
    "https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}", {
        maxZoom: 20,
        subdomains: ["mt0", "mt1", "mt2", "mt3"],
        attribution: "© Google Maps",
    }
).addTo(map);


var currentLayers = []; // Menyimpan semua layer yang sedang ditampilkan


const checkboxGroup = document.querySelectorAll(".form-check-input");

checkboxGroup.forEach(function(checkbox) {
    checkbox.addEventListener("change", function() {
        <?php foreach ($getTematik as $a) : ?>
        if (checkbox.id === "<?= $a['checkbox_id']; ?>") {
            if (this.checked) {
                checkboxGroup.forEach(function(otherCheckbox) {
                    <?php foreach ($getTematik as $other) : ?>
                    if (otherCheckbox !== checkbox && otherCheckbox.id ===
                        "<?= $other['checkbox_id']; ?>") {
                        otherCheckbox.checked = false;
                        removeGeoJsonLayer(otherCheckbox);
                    }
                    <?php endforeach; ?>
                });

                var url = "assets/geojson/tematik/<?= $a['file_json']; ?>";
                addGeoJsonLayer(url, checkbox);
            } else {
                removeGeoJsonLayer(checkbox);
            }
        }
        <?php endforeach; ?>

        // Checkbox selain keempat checkbox tersebut
        if (!(
                <?php foreach ($getTematik as $a) : ?> checkbox.id === "<?= $a['checkbox_id']; ?>"
                <?php if (end($getTematik) !== $a) echo "||"; ?> <?php endforeach; ?>
            )) {
            if (this.checked) {
                var url;

                <?php foreach ($getRencana as $r) : ?>
                if (checkbox.id === "<?= $r['checkbox_id']; ?>") {
                    url = "assets/geojson/rencana/<?= $r['file_json']; ?>";
                    addGeoJsonLayer(url, checkbox);
                }
                <?php endforeach; ?>

            } else {
                removeGeoJsonLayer(checkbox);
            }
        }
    });
});


// LAYER SETTING
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
                        fillOpacity: 0.5,
                        color: color,
                        weight: 2.5,
                        dashArray: darray,
                        dashOffset: doffset,
                    };
                },
                pointToLayer: function(feature, latlng) {
                    var customIcon = null;
                    // Cek jenis checkbox untuk menentukan ikon kustom yang akan digunakan

                    // Rencana
                    <?php foreach ($getRencana as $r) : ?>
                    if (checkbox.id === "<?= $r['checkbox_id']; ?>") {
                        customIcon = createCustomIcon<?= $r['icon_id']; ?>();
                    }
                    <?php endforeach; ?>


                    // Buat marker dengan ikon kustom
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

            // Tampilkan layer hanya jika checkbox terpilih
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
        },
    });
}

var info = L.control();

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
    var popupContent = "<h3>Informasi Wilayah</h3>";
    if (feature.properties) {
        if (feature.properties.KABUPATEN) {
            popupContent += "<p>Kabupaten : " + feature.properties.KABUPATEN + "</p>";
        }
        if (feature.properties.KECAMATAN) {
            popupContent += "<p>Kecamatan : " + feature.properties.KECAMATAN + "</p>";
        }
        if (feature.properties.KELURAHAN) {
            popupContent += "<p>Kelurahan : " + feature.properties.KELURAHAN + "</p>";
        }
        if (feature.properties.JENIS) {
            popupContent += "<p>Jenis Jalan : " + feature.properties.JENIS + "</p>";
        }
        if (feature.properties.FUNGSI) {
            popupContent += "<p>Fungsi Jalan : " + feature.properties.FUNGSI + "</p>";
        }
        if (feature.properties.SUMBER) {
            popupContent += "<p>Sumber : " + feature.properties.SUMBER + "</p>";
        }
        if (feature.properties.LUAS) {
            popupContent += "<p>Luas : " + feature.properties.LUAS + "</p>";
        }
        if (feature.properties.KODE_UNSUR) {
            popupContent +=
                "<p>Kode unsur : " + feature.properties.KODE_UNSUR + "</p>";
        }
        if (feature.properties.TOPONIM) {
            popupContent +=
                "<p>Toponim : " + feature.properties.TOPONIM + "</p>";
        }

        // Set konten pop-up pada layer
        layer.bindPopup(popupContent);
    } else {
        popupContent += "Informasi tidak tersedia";
        layer.bindPopup(popupContent);
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

// Rencana icon
<?php foreach ($getRencana as $r) : ?>

function createCustomIcon<?= $r['icon_id']; ?>() {
    var customIcon = L.icon({
        iconUrl: "assets/icon/<?= $r['icon']; ?>",
        iconSize: [20, 20],
        iconAnchor: [16, 32],
        popupAnchor: [0, -32],
    });

    return customIcon;
}
<?php endforeach; ?>


// CHANGE BASE MAPS
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
</script>

<?php include 'partials/starter-foot.php' ?>