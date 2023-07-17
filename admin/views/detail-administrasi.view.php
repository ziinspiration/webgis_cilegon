<?php include 'views/partials/starter-head.php' ?>
<h2 class="text-center mt-4 mb-3">Detail data <?= $getdata['nama_adm']; ?></h2>
<div class="container-fluid p-3">
    <div class="row">
        <div class="col-lg-6 col-md-12 mb-4 ">
            <div id="map" class="rounded-2 m-auto"></div>
        </div>
        <div class="col-lg-6 col-md-12 mt-4 ">
            <div class="informasi m-auto">
                <h3 class="text-center">Informasi data</h3>
                <div class="data mt-4">
                    <table class="table table-striped">
                        <tbody>
                            <tr class="kolom">
                                <th>Nama data :</th>
                                <td><?= $getdata['nama_adm']; ?></td>
                            </tr>
                            <tr class="kolom">
                                <th>File data :</th>
                                <td><?= $getdata['file_json']; ?></td>
                            </tr>
                            <tr class="kolom">
                                <th>Checkbox id :</th>
                                <td><?= $getdata['checkbox_id']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'views/partials/script.php' ?>
<script>
var map = L.map('map').setView([-5.992735076420852, 106.02561279458], 11);

L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
    maxZoom: 20,
    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
    attribution: '&copy; Google Maps'
}).addTo(map);

// ACEH
$.getJSON("../assets/geojson/administrasi/<?= $getdata['file_json']; ?>", function(data) {
    getLayer = L.geoJson(data, {
        style: function(feature) {
            var color = feature.properties.color;
            return {
                fillColor: color,
                fillOpacity: 0.5,
                color: color,
                weight: 1.5,
            };
        }
    }).addTo(map);
});
</script>
<?php include 'views/partials/starter-foot.php' ?>