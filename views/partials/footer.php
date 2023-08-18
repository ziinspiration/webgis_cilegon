<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<style>
    #map {
        height: 200px !important;
        border: 2px solid orange !important;
        border-radius: 10px !important;
    }
</style>
<footer class="footer bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <h5 class="orange">Tentang Kami</h5>
                <p>Website Geospasial BAPPEDA Kota Cilegon adalah platform online yang menyajikan informasi peta dan
                    data geografis wilayah Kota Cilegon. Dengan peta interaktif dan data terstruktur, website ini
                    membantu masyarakat dan pihak terkait dalam perencanaan, pengambilan keputusan, dan pemantauan
                    pembangunan di kota tersebut.</p>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="orange">Hubungi Kami</h5>
                <?php foreach ($getalamat as $alamat) : ?>
                    <p><span>Alamat :</span>
                        <?= $alamat['informasi']; ?>
                    </p>
                <?php endforeach; ?>
                <?php foreach ($getemail as $email) : ?>
                    <p><span>Email :</span>
                        <?= $email['informasi']; ?>
                    </p>
                <?php endforeach; ?>
                <?php foreach ($gettelp as $telp) : ?>
                    <p><span>Telp :</span>
                        <?= $telp['informasi']; ?>
                    </p>
                <?php endforeach; ?>
            </div>
            <div class="col-lg-6 col-md-6">
                <h5 class="orange">Lokasi Kami</h5>
                <div id="map"></div>
            </div>
            <div class="col-lg-6 col-md-6 mt-4">
                <h5 class="orange">Ikuti Kami</h5>
                <div class="social-icons ">
                    <?php foreach ($getfacebook as $facebook) : ?>
                        <a href="<?= $facebook['informasi']; ?>" class="facebook" target="_blank">
                            <i class="fab fa-facebook"></i>
                        </a>
                    <?php endforeach; ?>
                    <?php foreach ($gettwitter as $twitter) : ?>
                        <a href="<?= $twitter['informasi']; ?>" class="twitter" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                    <?php endforeach; ?>
                    <?php foreach ($getinstagram as $instagram) : ?>
                        <a href="<?= $instagram['informasi']; ?>" class="instagram" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                    <?php endforeach; ?>
                    <?php foreach ($getyoutube as $youtube) : ?>
                        <a href="<?= $youtube['informasi']; ?>" class="youtube" target="_blank">
                            <i class="fab fa-youtube"></i>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="version d-flex justify-content-end">
        <p class="text-light mt-3 me-5"><span class="bold">Version</span> 1.0</p>
    </div>
</footer>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([-6.013203875167288, 106.04259269650859], 13);

    L.tileLayer('https://{s}.googleapis.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 19,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        attribution: '&copy; Google'
    }).addTo(map);

    var customIcon = L.icon({
        iconUrl: 'assets/index/icon.png',
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -32]
    });

    var marker = L.marker([-6.013203875167288, 106.04259269650859], {
        icon: customIcon
    }).addTo(map);
</script>