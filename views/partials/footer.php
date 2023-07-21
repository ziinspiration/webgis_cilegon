<footer class="footer bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <h5 class="orange">Tentang Kami</h5>
                <p>Deskripsi mengenai Kabupaten Kota Cilegon dan informasi lainnya.</p>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="orange">Link Penting</h5>
                <ul class="list-unstyled list-link d-flex">
                    <div class="list-left me-4">
                        <li><a href="index.php">Beranda</a></li>
                        <li><a href="wilayah.php">Wilayah</a></li>
                        <li><a href="skpd.php">Skpd</a></li>
                        <li><a href="datapokok.php">Data pokok</a></li>
                        <li><a href="mapTematik.php">Map tematik</a></li>
                    </div>
                    <div class="list-left">
                        <li><a href="mapSpasial.php">Map spasial</a></li>
                        <li><a href="kJalan.php">Kemantapan jalan</a></li>
                        <li><a href="rtrw.php">RT RW Kota Cilegon</a></li>
                        <li><a href="lakip.php">LAKIP Kota Cilegon</a></li>
                    </div>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="orange">Hubungi Kami</h5>
                <p><span>Alamat :</span> JL. Maulana Yusuf RT. 06 RW. 01, Kecamatan Citangkil, Kota
                    Cilegon, Provinsi Banten, 42441</p>
                <p><span>Email :</span> BAPPEDA@email.cilegon.go.id</p>
                <p><span>Telp :</span> (123) 456-7890</p>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="orange">Ikuti Kami</h5>
                <div class="social-icons">
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
</footer>