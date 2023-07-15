var map = L.map("map").setView([-5.992735076420852, 106.02561279458], 12);

var googleLayer = L.tileLayer(
    "https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}", {
        maxZoom: 20,
        subdomains: ["mt0", "mt1", "mt2", "mt3"],
        attribution: "© Google Maps",
    }
).addTo(map);

var currentLayers = []; // Menyimpan semua layer yang sedang ditampilkan
var markerClusterLayer; // Variabel global untuk cluster layer

const checkboxGroup = document.querySelectorAll(".form-check-input");

checkboxGroup.forEach(function(checkbox) {
    checkbox.addEventListener("change", function() {
        if (
            checkbox.id === "provinsiCheckbox" ||
            checkbox.id === "kewilayahanCheckbox" ||
            checkbox.id === "kecamatanCheckbox" ||
            checkbox.id === "kelurahanCheckbox"
        ) {
            if (this.checked) {
                checkboxGroup.forEach(function(otherCheckbox) {
                    if (
                        otherCheckbox !== checkbox &&
                        (otherCheckbox.id === "provinsiCheckbox" ||
                            otherCheckbox.id === "kewilayahanCheckbox" ||
                            otherCheckbox.id === "kecamatanCheckbox" ||
                            otherCheckbox.id === "kelurahanCheckbox")
                    ) {
                        otherCheckbox.checked = false;
                        removeGeoJsonLayer(otherCheckbox);
                    }
                });

                var url;

                if (checkbox.id === "provinsiCheckbox") {
                    url = "assets/geojson/ADMINISTRASI_PROVINSI.geojson";
                } else if (checkbox.id === "kewilayahanCheckbox") {
                    url = "assets/geojson/ADMINISTRASI_KOTACILEGON.geojson";
                } else if (checkbox.id === "kecamatanCheckbox") {
                    url = "assets/geojson/ADMINISTRASI_KABUPATENKOTA.geojson";
                } else if (checkbox.id === "kelurahanCheckbox") {
                    url = "assets/geojson/ADMINISTRASI_KELURAHAN.geojson";
                }

                addGeoJsonLayer(url, checkbox);
            } else {
                removeGeoJsonLayer(checkbox);
            }
        } else {
            if (this.checked) {
                var url;

                // Ambil URL GeoJSON berdasarkan ID checkbox

                // Jalan
                <?php foreach ($JSONjalan as $jj) : ?>
                    if (checkbox.id === "<?= $jj['checkbox_id']; ?>") {
                        url = "assets/geojson/sarana/<?= $jj['file_json']; ?>";
                    }
                <?php endforeach; ?>

                // Perkantoran
                <?php foreach ($JSONkantor as $jk) : ?>
                    else if (checkbox.id === "<?= $jk['checkbox_id']; ?>") {
                        url = "assets/geojson/sarana/<?= $jk['file_json']; ?>";
                    }
                <?php endforeach; ?>

                // Pendidikan
                <?php foreach ($JSONpendidikan as $pendidikan) : ?>
                    else if (checkbox.id === "<?= $pendidikan['checkbox_id']; ?>") {
                        url = "assets/geojson/sarana/<?= $pendidikan['file_json']; ?>";
                    }
                <?php endforeach; ?>

                // Kesehatan
                <?php foreach ($JSONkesehatan as $kesehatan) : ?>
                    else if (checkbox.id === "<?= $kesehatan['checkbox_id']; ?>") {
                        url = "assets/geojson/sarana/<?= $kesehatan['file_json']; ?>";
                    }
                <?php endforeach; ?>

                // Pariwisata 
                <?php foreach ($JSONpariwisata as $pariwisata) : ?>
                    else if (checkbox.id === "<?= $pariwisata['checkbox_id']; ?>") {
                        url = "assets/geojson/sarana/<?= $pariwisata['file_json']; ?>";
                    }
                <?php endforeach; ?>

                // Peribadatan
                <?php foreach ($JSONperibadatan as $peribadatan) : ?>
                    else if (checkbox.id === "<?= $peribadatan['checkbox_id']; ?>") {
                        url = "assets/geojson/sarana/<?= $peribadatan['file_json']; ?>";
                    }
                <?php endforeach; ?>

                // Transportasi
                <?php foreach ($JSONtransportasi as $transportasi) : ?>
                    else if (checkbox.id === "<?= $transportasi['checkbox_id']; ?>") {
                        url = "assets/geojson/sarana/<?= $transportasi['file_json']; ?>";
                    }
                <?php endforeach; ?>

                // Fasilitas umum
                <?php foreach ($JSONfasilitasumum as $fasilitasumum) : ?>
                    else if (checkbox.id === "<?= $fasilitasumum['checkbox_id']; ?>") {
                        url = "assets/geojson/sarana/<?= $fasilitasumum['file_json']; ?>";
                    }
                <?php endforeach; ?>

                addGeoJsonLayer(url, checkbox);
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

                    // Kantor
                    <?php foreach ($JSONkantor as $jk) : ?>
                        if (checkbox.id === "<?= $jk['checkbox_id']; ?>") {
                            customIcon = createCustomIcon<?= $jk['icon_id']; ?>();
                        }
                    <?php endforeach; ?>
                    // Pendidikan
                    <?php foreach ($JSONpendidikan as $pendidikan) : ?>
                        if (checkbox.id === "<?= $pendidikan['checkbox_id']; ?>") {
                            customIcon = createCustomIcon<?= $pendidikan['icon_id']; ?>();
                        }
                    <?php endforeach; ?>
                    // Kesehatan
                    <?php foreach ($JSONkesehatan as $kesehatan) : ?>
                        if (checkbox.id === "<?= $kesehatan['checkbox_id']; ?>") {
                            customIcon = createCustomIcon<?= $kesehatan['icon_id']; ?>();
                        }
                    <?php endforeach; ?>
                    // Pariwisata
                    <?php foreach ($JSONpariwisata as $pariwisata) : ?>
                        if (checkbox.id === "<?= $pariwisata['checkbox_id']; ?>") {
                            customIcon = createCustomIcon<?= $pariwisata['icon_id']; ?>();
                        }
                    <?php endforeach; ?>
                    // Peribadatan
                    <?php foreach ($JSONperibadatan as $peribadatan) : ?>
                        if (checkbox.id === "<?= $peribadatan['checkbox_id']; ?>") {
                            customIcon = createCustomIcon<?= $peribadatan['icon_id']; ?>();
                        }
                    <?php endforeach; ?>
                    // Transportasi
                    <?php foreach ($JSONtransportasi as $transportasi) : ?>
                        if (checkbox.id === "<?= $transportasi['checkbox_id']; ?>") {
                            customIcon = createCustomIcon<?= $transportasi['icon_id']; ?>();
                        }
                    <?php endforeach; ?>
                    // Fasilitas Umum
                    <?php foreach ($JSONfasilitasumum as $fasilitasumum) : ?>
                        if (checkbox.id === "<?= $fasilitasumum['checkbox_id']; ?>") {
                            customIcon = createCustomIcon<?= $fasilitasumum['icon_id']; ?>();
                        }
                    <?php endforeach; ?>

                    if (customIcon) {
                        return L.marker(latlng, { icon: customIcon });
                    } else {
                        return L.marker(latlng);
                    }
                },
                onEachFeature: onEachFeature,
            });

            currentLayers.push({
                checkbox: checkbox,
                layer: layer
            });

            // Tampilkan layer hanya jika checkbox terpilih
            if (checkbox.checked) {
                // Tambahkan cluster layer jika jenis GeoJSON adalah marker
                if (data.features[0].geometry.type === "Point") {
                    addMarkerClusterLayer(layer);
                } else {
                    layer.addTo(map);
                }
            }
        })
        .catch(error => {
            console.log('Error:', error);
        });
}

function addMarkerClusterLayer(layer) {
    // Hapus cluster layer sebelumnya jika ada
    if (markerClusterLayer) {
        map.removeLayer(markerClusterLayer);
    }

    // Buat cluster layer baru
    markerClusterLayer = L.markerClusterGroup();

    // Tambahkan layer marker ke cluster layer
    markerClusterLayer.addLayer(layer);

    // Tambahkan cluster layer ke map
    map.addLayer(markerClusterLayer);
}

function removeGeoJsonLayer(checkbox) {
    // Cari layer yang sesuai dengan checkbox
    var layerToRemove = currentLayers.find(function(layerObj) {
        return layerObj.checkbox === checkbox;
    });

    if (layerToRemove) {
        // Hapus layer dari map
        map.removeLayer(layerToRemove.layer);

        // Hapus layer dari daftar currentLayers
        var layerIndex = currentLayers.indexOf(layerToRemove);
        currentLayers.splice(layerIndex, 1);
    }
}

function onEachFeature(feature, layer) {
    if (feature.properties && feature.properties.popupContent) {
        layer.bindPopup(feature.properties.popupContent);
    }
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

function highlightFeature(e) {
    var layer = e.target;

    layer.setStyle({
        weight: 5,
        color: "#666",
        dashArray: "",
        fillOpacity: 0.7,
    });

    if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
        layer.bringToFront();
    }

    info.update(layer.feature.properties);
}

function resetHighlight(e) {
    geojson.resetStyle(e.target);
    info.update();
}

function zoomToFeature(e) {
    map.fitBounds(e.target.getBounds());
}

// ...

function showPopup(feature, layer) {
    if (feature.properties && feature.properties.popupContent) {
        layer.bindPopup(feature.properties.popupContent);
    }
}

// CUSTOM ICON

// Perkantoran icon
<?php foreach ($JSONkantor as $jk) : ?>

function createCustomIcon<?= $jk['icon_id']; ?>() {
    var customIcon = L.icon({
        iconUrl: "assets/icon/<?= $jk['icon']; ?>",
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
        iconUrl: "assets/icon/<?= $pendidikan['icon']; ?>",
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
        iconUrl: "assets/icon/<?= $kesehatan['icon']; ?>",
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
        iconUrl: "assets/icon/<?= $peribadatan['icon']; ?>",
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
        iconUrl: "assets/icon/<?= $pariwisata['icon']; ?>",
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
        iconUrl: "assets/icon/<?= $transportasi['icon']; ?>",
        iconSize: [20, 20],
        iconAnchor: [16, 32],
        popupAnchor: [0, -32],
    });

    return customIcon;
}
<?php endforeach; ?>

// Fasilitas umum icon
<?php foreach ($JSONfasilitasumum as $fasilitasumum) : ?>

function createCustomIcon<?= $fasilitasumum['icon_id']; ?>() {
    var customIcon = L.icon({
        iconUrl: "assets/icon/<?= $fasilitasumum['icon']; ?>",
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
