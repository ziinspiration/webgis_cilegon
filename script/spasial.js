var map = L.map("map").setView([-5.992735076420852, 106.02561279458], 12);

var googleLayer = L.tileLayer(
  "https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}",
  {
    maxZoom: 20,
    subdomains: ["mt0", "mt1", "mt2", "mt3"],
    attribution: "© Google Maps",
  }
).addTo(map);

var geojson;
var currentLayers = []; // Menyimpan semua layer yang sedang ditampilkan

const checkboxGroup = document.querySelectorAll(".form-check-input");

checkboxGroup.forEach(function (checkbox) {
  checkbox.addEventListener("change", function () {
    // Cek apakah checkbox yang terpilih adalah salah satu dari keempat checkbox yang tidak boleh dibuka bersamaan
    if (
      checkbox.id === "provinsiCheckbox" ||
      checkbox.id === "kewilayahanCheckbox" ||
      checkbox.id === "kecamatanCheckbox" ||
      checkbox.id === "kelurahanCheckbox"
    ) {
      // Untuk keempat checkbox tersebut, cek status terbaru
      if (this.checked) {
        // Checkbox terpilih, matikan checkbox lainnya
        checkboxGroup.forEach(function (otherCheckbox) {
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
        var customIcon;

        // Cek id checkbox yang terpilih
        if (checkbox.id === "provinsiCheckbox") {
          url = "assets/geojson/ADMINISTRASI_PROVINSI.geojson";
        } else if (checkbox.id === "kewilayahanCheckbox") {
          url = "assets/geojson/ADMINISTRASI_KOTACILEGON.geojson";
        } else if (checkbox.id === "kecamatanCheckbox") {
          url = "assets/geojson/ADMINISTRASI_KABUPATENKOTA.geojson";
        } else if (checkbox.id === "kelurahanCheckbox") {
          url = "assets/geojson/ADMINISTRASI_KELURAHAN.geojson";
        }

        addGeoJsonLayer(url, checkbox, customIcon);
      } else {
        removeGeoJsonLayer(checkbox);
      }
    } else {
      // Checkbox selain keempat checkbox tersebut
      if (this.checked) {
        var url;
        var customIcon;

        // AMBIL DATA BY GEOJSON FILE
        // Jalan
        if (checkbox.id === "jaringanJalanCheckbox") {
          url = "assets/geojson/JARINGAN_JALAN.geojson";
        }
        // Perkantoran
        else if (checkbox.id === "pemdaCheckbox") {
          url = "assets/geojson/sarana/KANTOR_PEMERINTAHAN.geojson";
          customIcon = createCustomIconPemerintahan();
        } else if (checkbox.id === "kantorswastaCheckbox") {
          url = "assets/geojson/sarana/KANTOR_SWASTA.geojson";
          customIcon = createCustomIconSwasta();
        } else if (checkbox.id === "kantorwalikotaCheckbox") {
          url = "assets/geojson/sarana/KANTOR_WALIKOTA.geojson";
          customIcon = createCustomIconSwasta();
        } else if (checkbox.id === "kantorkelurahanCheckbox") {
          url = "assets/geojson/sarana/KANTOR_KELURAHAN.geojson";
          customIcon = createCustomIconSwasta();
        }
        // Pendidikan
        else if (checkbox.id === "tkCheckbox") {
          url = "assets/geojson/sarana/TAMAN_KANAK_KANAK.geojson";
          customIcon = createCustomIconTk();
        } else if (checkbox.id === "sdCheckbox") {
          url = "assets/geojson/sarana/SEKOLAH_DASAR.geojson";
          customIcon = createCustomIconSd();
        } else if (checkbox.id === "smpCheckbox") {
          url = "assets/geojson/sarana/SEKOLAH_MENENGAH_PERTAMA.geojson";
          customIcon = createCustomIconSmp();
        } else if (checkbox.id === "smaCheckbox") {
          url = "assets/geojson/sarana/SEKOLAH_MENENGAH_ATAS.geojson";
          customIcon = createCustomIconSma();
        } else if (checkbox.id === "univCheckbox") {
          url = "assets/geojson/sarana/UNIVERSITAS.geojson";
          customIcon = createCustomIconUniv();
        } else if (checkbox.id === "pesantrenCheckbox") {
          url = "assets/geojson/sarana/PONDOK_PESANTREN.geojson";
          customIcon = createCustomIconPesantren();
        }
        // Kesehatan
        else if (checkbox.id === "rumahsakitCheckbox") {
          url = "assets/geojson/sarana/RUMAH_SAKIT.geojson";
          customIcon = createCustomIconRs();
        } else if (checkbox.id === "puskesCheckbox") {
          url = "assets/geojson/sarana/PUSKESMAS.geojson";
          customIcon = createCustomIconPuskes();
        } else if (checkbox.id === "klinikCheckbox") {
          url = "assets/geojson/sarana/KLINIK.geojson";
          customIcon = createCustomIconKlinik();
        }

        addGeoJsonLayer(url, checkbox, customIcon);
      } else {
        removeGeoJsonLayer(checkbox);
      }
    }
  });
});

// LAYER SETTING
function addGeoJsonLayer(url, checkbox, customIcon) {
  $.getJSON(url, function (data) {
    var layer = L.geoJson(data, {
      style: function (feature) {
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
      pointToLayer: function (feature, latlng) {
        // Buat marker dengan ikon kustom
        return L.marker(latlng, { icon: customIcon });
      },
      onEachFeature: onEachFeature,
    });

    currentLayers.push({ checkbox: checkbox, layer: layer });

    // Tampilkan layer hanya jika checkbox terpilih
    if (checkbox.checked) {
      layer.addTo(map);
    }
  });
}

function removeGeoJsonLayer(checkbox) {
  var indexToRemove = currentLayers.findIndex(function (layerObj) {
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
    click: function (e) {
      zoomToFeature(e);
      showPopup(feature, layer);
    },
  });
}

var info = L.control();

info.onAdd = function (map) {
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
  } else {
    popupContent += "Arahkan mouse ke wilayah";
  }

  layer.bindPopup(popupContent);
}

// CUSTOM ICON
// Perkantoran icon
function createCustomIconPemerintahan() {
  var customIcon = L.icon({
    iconUrl: "assets/icon/icon-kantor.png",
    iconSize: [20, 20],
    iconAnchor: [16, 32],
    popupAnchor: [0, -32],
  });

  return customIcon;
}

function createCustomIconSwasta() {
  var customIcon = L.icon({
    iconUrl: "assets/icon/icon-kantor.png",
    iconSize: [20, 20],
    iconAnchor: [16, 32],
    popupAnchor: [0, -32],
  });

  return customIcon;
}

// Pendidikan icon
function createCustomIconTk() {
  var customIcon = L.icon({
    iconUrl: "assets/icon/icon-tk.png",
    iconSize: [25, 35],
    iconAnchor: [16, 32],
    popupAnchor: [0, -32],
  });

  return customIcon;
}

function createCustomIconSd() {
  var customIcon = L.icon({
    iconUrl: "assets/icon/icon-sd.png",
    iconSize: [25, 35],
    iconAnchor: [16, 32],
    popupAnchor: [0, -32],
  });

  return customIcon;
}

function createCustomIconSmp() {
  var customIcon = L.icon({
    iconUrl: "assets/icon/icon-smp.png",
    iconSize: [25, 35],
    iconAnchor: [16, 32],
    popupAnchor: [0, -32],
  });

  return customIcon;
}

function createCustomIconSma() {
  var customIcon = L.icon({
    iconUrl: "assets/icon/icon-sma.png",
    iconSize: [25, 35],
    iconAnchor: [16, 32],
    popupAnchor: [0, -32],
  });

  return customIcon;
}

function createCustomIconUniv() {
  var customIcon = L.icon({
    iconUrl: "assets/icon/icon-univ.png",
    iconSize: [25, 35],
    iconAnchor: [16, 32],
    popupAnchor: [0, -32],
  });

  return customIcon;
}

function createCustomIconPesantren() {
  var customIcon = L.icon({
    iconUrl: "assets/icon/icon-pesantren.png",
    iconSize: [25, 35],
    iconAnchor: [16, 32],
    popupAnchor: [0, -32],
  });

  return customIcon;
}

// Kesehatan icon
function createCustomIconRs() {
  var customIcon = L.icon({
    iconUrl: "assets/icon/icon-rumahsakit.png",
    iconSize: [30, 35],
    iconAnchor: [16, 32],
    popupAnchor: [0, -32],
  });

  return customIcon;
}

function createCustomIconPuskes() {
  var customIcon = L.icon({
    iconUrl: "assets/icon/icon-puskesmas.png",
    iconSize: [45, 35],
    iconAnchor: [16, 32],
    popupAnchor: [0, -32],
  });

  return customIcon;
}

function createCustomIconKlinik() {
  var customIcon = L.icon({
    iconUrl: "assets/icon/icon-klinik.png",
    iconSize: [25, 35],
    iconAnchor: [16, 32],
    popupAnchor: [0, -32],
  });

  return customIcon;
}

// CHANGE BASE MAPS
const satelliteCheckbox = document.getElementById("satelliteCheckbox");
const terrainCheckbox = document.getElementById("terrainCheckbox");
const roadCheckbox = document.getElementById("roadCheckbox");

satelliteCheckbox.addEventListener("click", function () {
  if (satelliteCheckbox.checked) {
    terrainCheckbox.checked = false;
    roadCheckbox.checked = false;
    map.removeLayer(googleLayer);
    googleLayer = L.tileLayer(
      "https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}",
      {
        maxZoom: 20,
        subdomains: ["mt0", "mt1", "mt2", "mt3"],
        attribution: "© Google Maps",
      }
    ).addTo(map);
  } else {
    map.removeLayer(googleLayer);
    googleLayer = L.tileLayer(
      "https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}",
      {
        maxZoom: 20,
        subdomains: ["mt0", "mt1", "mt2", "mt3"],
        attribution: "© Google Maps",
      }
    ).addTo(map);
  }
});

terrainCheckbox.addEventListener("click", function () {
  if (terrainCheckbox.checked) {
    satelliteCheckbox.checked = false;
    roadCheckbox.checked = false;
    map.removeLayer(googleLayer);
    googleLayer = L.tileLayer(
      "https://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}",
      {
        maxZoom: 20,
        subdomains: ["mt0", "mt1", "mt2", "mt3"],
        attribution: "© Google Maps",
      }
    ).addTo(map);
  } else {
    map.removeLayer(googleLayer);
    googleLayer = L.tileLayer(
      "https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}",
      {
        maxZoom: 20,
        subdomains: ["mt0", "mt1", "mt2", "mt3"],
        attribution: "© Google Maps",
      }
    ).addTo(map);
  }
});

roadCheckbox.addEventListener("click", function () {
  if (roadCheckbox.checked) {
    satelliteCheckbox.checked = false;
    terrainCheckbox.checked = false;
    map.removeLayer(googleLayer);
    googleLayer = L.tileLayer(
      "https://{s}.google.com/vt/lyrs=r&x={x}&y={y}&z={z}",
      {
        maxZoom: 20,
        subdomains: ["mt0", "mt1", "mt2", "mt3"],
        attribution: "© Google Maps",
      }
    ).addTo(map);
  } else {
    map.removeLayer(googleLayer);
    googleLayer = L.tileLayer(
      "https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}",
      {
        maxZoom: 20,
        subdomains: ["mt0", "mt1", "mt2", "mt3"],
        attribution: "© Google Maps",
      }
    ).addTo(map);
  }
});
