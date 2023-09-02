<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<style>
footer {
    font-family: Montserrat !important;
    padding: 40px !important;
    padding-bottom: 10px !important;
    background: url(assets/index/footer2.jpg);
}

footer h4 {
    color: orange !important;
    margin-bottom: 15px !important;
}

footer p {
    font-size: 14px !important;
}

footer h4 .first {
    border-bottom: 2px solid orange;
}

@media screen and (max-width: 768px) {
    footer {
        flex-direction: column;
        text-align: center;
    }

    footer-section {
        margin-bottom: 20px;
    }
}

footer .social-icons a {
    display: inline-block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    border-radius: 50%;
    background-color: #fff;
    color: #333;
    text-align: center;
    margin-right: 10px;
}


.instagram,
.twitter,
.facebook,
.youtube {
    background-color: transparent !important;
    color: white !important;
    outline: 2px solid white;
}

.instagram:hover,
.twitter:hover,
.facebook:hover,
.youtube:hover {
    outline: 2px solid orange;

}

.instagram:hover {
    background: linear-gradient(to right, #833AB4, #E1306C);
    animation: shake 0.5s infinite;
}

.youtube:hover {
    /* background: linear-gradient(to right, #FF0000); */
    background-color: #FF0000 !important;
    animation: shake 0.5s infinite;
}

.twitter:hover {
    background: linear-gradient(to right, #1DA1F2, #1DA1F2);
    animation: shake 0.5s infinite;
}

.facebook:hover {
    background: linear-gradient(to right, #4267B2, #1DA1F2);
    animation: shake 0.5s infinite;
}

#map {
    height: 170px;
    width: 100%;
    border: 2px solid orange;
    border-radius: 10px;
}

@media screen and (max-width: 550px) {
    #map {
        height: 200px;
    }

    .col-lg-4 {
        margin-bottom: 25px !important;
    }

    footer p {
        font-size: 11px !important;
    }

    .cprg {
        font-size: 8px !important;
    }
}
</style>
<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="about">
                    <h4><span class="first">TENTANG</span> <span class="second">KAMI</span></h4>
                    <p class="text-light">Website Geospasial BAPPELITBANG Kota Cilegon adalah platform online yang
                        menyajikan
                        informasi peta dan
                        data geografis wilayah Kota Cilegon. Dengan peta interaktif dan data terstruktur, website ini
                        membantu masyarakat dan pihak terkait dalam perencanaan, pengambilan keputusan, dan pemantauan
                        pembangunan di kota tersebut.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="kontak">
                    <h4><span class="first">HUBUNGI</span> <span class="second">KAMI</span></h4>
                    <div class="contact text-light">
                        <?php foreach ($getalamat as $alamat) : ?>
                        <p><i class="fas fa-map-marker-alt orange me-1"></i> Alamat : <?= $alamat['informasi']; ?></p>
                        <?php endforeach; ?>
                        <?php foreach ($getemail as $email) : ?>
                        <p><i class="far fa-envelope orange me-1"></i> Email : <?= $email['informasi']; ?></p>
                        <?php endforeach; ?>
                        <?php foreach ($gettelp as $telp) : ?>
                        <p><i class="fas fa-phone orange me-1"></i> Telp : <?= $telp['informasi']; ?></p>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <h4><span class="first">LOKASI</span> <span class="second">KAMI</span></h4>
                <div id="map"></div>
            </div>
            <div class="col-lg-4">
                <h4><span class="first">IKUTI</span> <span class="second">KAMI</span></h4>
                <div class="social-icons text-light">
                    <?php foreach ($getfacebook as $facebook) : ?>
                    <a href="<?= $facebook['informasi']; ?>" class="facebook mb-3" target="_blank">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <?php endforeach; ?>
                    <?php foreach ($gettwitter as $twitter) : ?>
                    <a href="<?= $twitter['informasi']; ?>" class="twitter mb-3" target="_blank">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <?php endforeach; ?>
                    <?php foreach ($getinstagram as $instagram) : ?>
                    <a href="<?= $instagram['informasi']; ?>" class="instagram mb-3" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <?php endforeach; ?>
                    <?php foreach ($getyoutube as $youtube) : ?>
                    <a href="<?= $youtube['informasi']; ?>" class="youtube mb-3" target="_blank">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>
    <div class="footer-copyright mt-5">
        <div class="container">
            <div class="row">
                <p class="text-end text-white-50"><small><b>VERSION 1.0</b></small></p>
                <p class="text-center cprg text-white-50">© 2023 Website Geospasial BAPPELITBANG Kota Cilegon. All
                    rights
                    reserved.
                </p>
            </div>
        </div>
    </div>
</footer>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
var map = L.map('map').setView([-6.013203875167288, 106.04259269650859], 15);

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