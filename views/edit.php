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
        <?php foreach ($getAdmin as $a) : ?>
        if (checkbox.id === "<?= $a['checkbox_id']; ?>") {
            if (this.checked) {
                checkboxGroup.forEach(function(otherCheckbox) {
                    <?php foreach ($getAdmin as $other) : ?>
                    if (otherCheckbox !== checkbox && otherCheckbox.id ===
                        "<?= $other['checkbox_id']; ?>") {
                        otherCheckbox.checked = false;
                        removeGeoJsonLayer(otherCheckbox);
                    }
                    <?php endforeach; ?>
                });

                var url = "assets/geojson/administrasi/<?= $a['file_json']; ?>";
                addGeoJsonLayer(url, checkbox);
            } else {
                removeGeoJsonLayer(checkbox);
            }
        }
        <?php endforeach; ?>

        // Checkbox selain keempat checkbox tersebut
        if (!(
                <?php foreach ($getAdmin as $a) : ?> checkbox.id === "<?= $a['checkbox_id']; ?>"
                <?php if (end($getAdmin) !== $a) echo "||"; ?> <?php endforeach; ?>
            )) {
            if (this.checked) {
                var url;

                <?php foreach ($JSONprasarana as $jj) : ?>
                if (checkbox.id === "<?= $jj['checkbox_id']; ?>") {
                    url = "assets/geojson/prasarana/<?= $jj['file_json']; ?>";
                    addGeoJsonLayer(url, checkbox);
                }
                <?php endforeach; ?>

                <?php foreach ($JSONprasaranaAirbersih as $jj) : ?>
                if (checkbox.id === "<?= $jj['checkbox_id']; ?>") {
                    url = "assets/geojson/prasarana/<?= $jj['file_json']; ?>";
                    addGeoJsonLayer(url, checkbox);
                }
                <?php endforeach; ?>
                <?php foreach ($JSONprasaranaPersampahan as $jj) : ?>
                if (checkbox.id === "<?= $jj['checkbox_id']; ?>") {
                    url = "assets/geojson/prasarana/<?= $jj['file_json']; ?>";
                    addGeoJsonLayer(url, checkbox);
                }
                <?php endforeach; ?>

                <?php foreach ($JSONkantor as $jk) : ?>
                else if (checkbox.id === "<?= $jk['checkbox_id']; ?>") {
                    url = "assets/geojson/sarana/<?= $jk['file_json']; ?>";
                    addGeoJsonLayer(url, checkbox);
                }
                <?php endforeach; ?>

                <?php foreach ($JSONpendidikan as $pendidikan) : ?>
                else if (checkbox.id === "<?= $pendidikan['checkbox_id']; ?>") {
                    url = "assets/geojson/sarana/<?= $pendidikan['file_json']; ?>";
                    addGeoJsonLayer(url, checkbox);
                }
                <?php endforeach; ?>
                <?php foreach ($ZONASIpendidikan as $pendidikan) : ?>
                else if (checkbox.id === "<?= $pendidikan['checkbox_id']; ?>") {
                    url = "assets/geojson/sarana/<?= $pendidikan['file_json']; ?>";
                    addGeoJsonLayer(url, checkbox);
                }
                <?php endforeach; ?>

                <?php foreach ($JSONkesehatan as $kesehatan) : ?>
                else if (checkbox.id === "<?= $kesehatan['checkbox_id']; ?>") {
                    url = "assets/geojson/sarana/<?= $kesehatan['file_json']; ?>";
                    addGeoJsonLayer(url, checkbox);
                }
                <?php endforeach; ?>
                <?php foreach ($ZONASIkesehatan as $kesehatan) : ?>
                else if (checkbox.id === "<?= $kesehatan['checkbox_id']; ?>") {
                    url = "assets/geojson/sarana/<?= $kesehatan['file_json']; ?>";
                    addGeoJsonLayer(url, checkbox);
                }
                <?php endforeach; ?>

                <?php foreach ($JSONpariwisata as $pariwisata) : ?>
                else if (checkbox.id === "<?= $pariwisata['checkbox_id']; ?>") {
                    url = "assets/geojson/sarana/<?= $pariwisata['file_json']; ?>";
                    addGeoJsonLayer(url, checkbox);
                }
                <?php endforeach; ?>

                <?php foreach ($JSONperibadatan as $peribadatan) : ?>
                else if (checkbox.id === "<?= $peribadatan['checkbox_id']; ?>") {
                    url = "assets/geojson/sarana/<?= $peribadatan['file_json']; ?>";
                    addGeoJsonLayer(url, checkbox);
                }
                <?php endforeach; ?>

                <?php foreach ($JSONtransportasi as $transportasi) : ?>
                else if (checkbox.id === "<?= $transportasi['checkbox_id']; ?>") {
                    url = "assets/geojson/sarana/<?= $transportasi['file_json']; ?>";
                    addGeoJsonLayer(url, checkbox);
                }
                <?php endforeach; ?>

                <?php foreach ($JSONfasilitasolahraga as $fasilitasolahraga) : ?>
                else if (checkbox.id === "<?= $fasilitasolahraga['checkbox_id']; ?>") {
                    url = "assets/geojson/sarana/<?= $fasilitasolahraga['file_json']; ?>";
                    addGeoJsonLayer(url, checkbox);
                }
                <?php endforeach; ?>

                <?php foreach ($JSONperdagangan as $perdagangan) : ?>
                else if (checkbox.id === "<?= $perdagangan['checkbox_id']; ?>") {
                    url = "assets/geojson/sarana/<?= $perdagangan['file_json']; ?>";
                    addGeoJsonLayer(url, checkbox);
                }
                <?php endforeach; ?>

                <?php foreach ($JSONpemakaman as $pemakaman) : ?>
                else if (checkbox.id === "<?= $pemakaman['checkbox_id']; ?>") {
                    url = "assets/geojson/sarana/<?= $pemakaman['file_json']; ?>";
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
                        fillOpacity: 0.7,
                        opacity: 0.5,
                        color: color,
                        weight: 1.5,
                        dashArray: darray,
                        dashOffset: doffset,
                    };
                },
                pointToLayer: function(feature, latlng) {
                    var customIcon = null;
                    // Cek jenis checkbox untuk menentukan ikon kustom yang akan digunakan

                    // Prasarana
                    <?php foreach ($JSONprasarana as $jk) : ?>
                    if (checkbox.id === "<?= $jk['checkbox_id']; ?>") {
                        customIcon = createCustomIcon<?= $jk['icon_id']; ?>();
                    }
                    <?php endforeach; ?>
                    <?php foreach ($JSONprasaranaAirbersih as $jk) : ?>
                    if (checkbox.id === "<?= $jk['checkbox_id']; ?>") {
                        customIcon = createCustomIcon<?= $jk['icon_id']; ?>();
                    }
                    <?php endforeach; ?>
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
                        customIcon = createCustomIcon<?= $pendidikan['icon_id']; ?>();
                    }
                    <?php endforeach; ?>
                    // Kesehatan
                    <?php foreach ($JSONkesehatan as $kesehatan) : ?>
                    if (checkbox.id === "<?= $kesehatan['checkbox_id']; ?>") {
                        customIcon = createCustomIcon<?= $kesehatan['icon_id']; ?>();
                    }
                    <?php endforeach; ?>
                    // pariwisata
                    <?php foreach ($JSONpariwisata as $pariwisata) : ?>
                    if (checkbox.id === "<?= $pariwisata['checkbox_id']; ?>") {
                        customIcon = createCustomIcon<?= $pariwisata['icon_id']; ?>();
                    }
                    <?php endforeach; ?>
                    // peribadatan
                    <?php foreach ($JSONperibadatan as $peribadatan) : ?>
                    if (checkbox.id === "<?= $peribadatan['checkbox_id']; ?>") {
                        customIcon = createCustomIcon<?= $peribadatan['icon_id']; ?>();
                    }
                    <?php endforeach; ?>
                    // transportasi
                    <?php foreach ($JSONtransportasi as $transportasi) : ?>
                    if (checkbox.id === "<?= $transportasi['checkbox_id']; ?>") {
                        customIcon = createCustomIcon<?= $transportasi['icon_id']; ?>();
                    }
                    <?php endforeach; ?>
                    // fasilitasolahraga
                    <?php foreach ($JSONfasilitasolahraga as $fasilitasolahraga) : ?>
                    if (checkbox.id === "<?= $fasilitasolahraga['checkbox_id']; ?>") {
                        customIcon = createCustomIcon<?= $fasilitasolahraga['icon_id']; ?>();
                    }
                    <?php endforeach; ?>
                    // perdagangan
                    <?php foreach ($JSONperdagangan as $perdagangan) : ?>
                    if (checkbox.id === "<?= $perdagangan['checkbox_id']; ?>") {
                        customIcon = createCustomIcon<?= $perdagangan['icon_id']; ?>();
                    }
                    <?php endforeach; ?>
                    // pemakaman
                    <?php foreach ($JSONpemakaman as $pemakaman) : ?>
                    if (checkbox.id === "<?= $pemakaman['checkbox_id']; ?>") {
                        customIcon = createCustomIcon<?= $pemakaman['icon_id']; ?>();
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
        click: function(e) {
            showPopup(feature, layer);
        },
        mouseover: highlightFeature,
        mouseout: resetHighlight,
    });

    var content = 'Kec. ' + layer.feature.properties.KABUPATEN.toString();
    layer.bindTooltip(content, {
        direction: 'center',
        permanent: true,
        className: 'styleLabelkabupaten'
    });
}

function resetLabels(layers) {
    layers.forEach(layer => {
        if (layer.getLayers().length > 0) {
            layer.eachLayer(function(subLayer) {
                var content = 'Kec. ' + subLayer.feature.properties.KABUPATEN.toString();
                subLayer.setTooltipContent(content);
            });
        }
    });
}

resetLabels([kabupaten]);

map.on("zoomend", function() {
    if (map.getZoom() <= 12) {
        resetLabels([bataskecamatan]);
    } else if (map.getZoom() > 12) {
        resetLabels([kabupaten]);
    }
});

map.on("move", function() {
    resetLabels([kabupaten]);
});

map.on("layeradd", function() {
    resetLabels([kabupaten]);
});

map.on("layerremove", function() {
    resetLabels([kabupaten]);
});

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
        if (feature.properties.KABUPATEN) {
            popupContent += "<p><b>Kabupaten :</b> " + feature.properties.KABUPATEN + "</p>";
        }
        if (feature.properties.KECAMATAN) {
            popupContent += "<p><b>Kecamatan :</b> " + feature.properties.KECAMATAN + "</p>";
        }
        if (feature.properties.KELURAHAN) {
            popupContent += "<p><b>Kelurahan :</b> " + feature.properties.KELURAHAN + "</p>";
        }
        if (feature.properties.JENIS) {
            popupContent += "<p><b>Jenis :</b> " + feature.properties.JENIS + "</p>";
        }
        if (feature.properties.FUNGSI) {
            popupContent += "<p><b>Fungsi :</b> " + feature.properties.FUNGSI + "</p>";
        }
        if (feature.properties.SUMBER) {
            popupContent += "<p><b>Sumber :</b> " + feature.properties.SUMBER + "</p>";
        }
        if (feature.properties.KETERANGAN) {
            popupContent +=
                "<p><b>Keterangan :</b> " + feature.properties.KETERANGAN + "</p>";
        }
        if (feature.properties.BUFF_DIST) {
            popupContent +=
                "<p><b>Radius pelayanan :</b> " + feature.properties.BUFF_DIST + "</p>";
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

        popupContent += "</div>";
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