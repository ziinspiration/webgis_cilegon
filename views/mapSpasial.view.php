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
            <ul class="list-unstyled">
                <h5 class="mb-3">Wilayah Administrasi</h3>
                    <li class="ms-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="provinsiCheckbox">
                            <label class="form-check-label" for="provinsiCheckbox">Provinsi</label>
                        </div>
                    </li>
                    <li class="ms-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="kewilayahanCheckbox">
                            <label class="form-check-label" for="kewilayahanCheckbox">Kabupaten</label>
                        </div>
                    </li>
                    <li class="ms-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="kecamatanCheckbox">
                            <label class="form-check-label" for="kecamatanCheckbox">Kecamatan</label>
                        </div>
                    </li>
                    <li class="ms-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="kelurahanCheckbox">
                            <label class="form-check-label" for="kelurahanCheckbox">Kelurahan</label>
                        </div>
                    </li>
            </ul>
            <ul class="list-unstyled">
                <h5 class="mb-3">Prasarana</h3>
                    <li class="ms-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="jaringanJalanCheckbox">
                            <label class="form-check-label" for="jaringanJalanCheckbox">
                                Jalan
                            </label>
                        </div>
                    </li>
            </ul>
            <!-- Sarana -->
            <ul class="list-unstyled">
                <h5 class="mb-3">Sarana</h3>
                    <!-- Perkantoran -->
                    <p class="head-sarana mb-2 mt-3 ms-2">Perkantoran</p>
                    <li class="ms-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="kantorwalikotaCheckbox">
                            <label class="form-check-label" for="kantorwalikotaCheckbox">
                                Kantor Walikota
                            </label>
                        </div>
                    </li>
                    <li class="ms-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="pemdaCheckbox">
                            <label class="form-check-label" for="pemdaCheckbox">
                                Kantor Pemerintah
                            </label>
                        </div>
                    </li>
                    <li class="ms-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="kantorkelurahanCheckbox">
                            <label class="form-check-label" for="kantorkelurahanCheckbox">
                                Kantor Kelurahan
                            </label>
                        </div>
                    </li>
                    <li class="ms-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="kantorswastaCheckbox">
                            <label class="form-check-label" for="kantorswastaCheckbox">
                                Kantor Swasta
                            </label>
                        </div>
                    </li>
                    <!-- Pendidikan -->
                    <p class="head-sarana mb-2 mt-3 ms-2">Pendidikan</p>
                    <li class="ms-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="tkCheckbox">
                            <label class="form-check-label" for="tkCheckbox">
                                Taman kanak kanak
                            </label>
                        </div>
                    </li>
                    <li class="ms-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="sdCheckbox">
                            <label class="form-check-label" for="sdCheckbox">
                                Sekolah dasar
                            </label>
                        </div>
                    </li>
                    <li class="ms-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="smpCheckbox">
                            <label class="form-check-label" for="smpCheckbox">
                                Sekolah menengah pertama
                            </label>
                        </div>
                    </li>
                    <li class="ms-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="smaCheckbox">
                            <label class="form-check-label" for="smaCheckbox">
                                Sekolah menengah atas
                            </label>
                        </div>
                    </li>
                    <li class="ms-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="univCheckbox">
                            <label class="form-check-label" for="univCheckbox">
                                Universitas
                            </label>
                        </div>
                    </li>
                    <li class="ms-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="pesantrenCheckbox">
                            <label class="form-check-label" for="pesantrenCheckbox">
                                Pondok pesantren
                            </label>
                        </div>
                    </li>
                    <!-- Kesehatan -->
                    <p class="head-sarana mb-2 mt-3 ms-2">Kesehatan</p>
                    <li class="ms-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="rumahsakitCheckbox">
                            <label class="form-check-label" for="rumahsakitCheckbox">
                                Rumah sakit
                            </label>
                        </div>
                    </li>
                    <li class="ms-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="puskesCheckbox">
                            <label class="form-check-label" for="puskesCheckbox">
                                Puskesmas
                            </label>
                        </div>
                    </li>
                    <li class="ms-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="klinikCheckbox">
                            <label class="form-check-label" for="klinikCheckbox">
                                Klinik
                            </label>
                        </div>
                    </li>
                    <!-- Pariwisata & Hiburan -->
                    <p class="head-sarana mb-2 mt-3 ms-2">Pariwisata & Hiburan</p>
                    <li class="ms-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="hotelCheckbox">
                            <label class="form-check-label" for="hotelCheckbox">
                                Hotel & Penginapan
                            </label>
                        </div>
                    </li>
                    <li class="ms-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="restoranCheckbox">
                            <label class="form-check-label" for="restoranCheckbox">
                                Restoran
                            </label>
                        </div>
                    </li>
                    <!-- Peribadatan -->
                    <p class="head-sarana mb-2 mt-3 ms-2">Peribadatan</p>
                    <li class="ms-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="masjidCheckbox">
                            <label class="form-check-label" for="masjidCheckbox">
                                Masjid
                            </label>
                        </div>
                    </li>
                    <!-- Transportasi -->
                    <p class="head-sarana mb-2 mt-3 ms-2">Transportasi</p>
                    <li class="ms-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="stasiunCheckbox">
                            <label class="form-check-label" for="stasiunCheckbox">
                                Stasiun
                            </label>
                        </div>
                    </li>
                    <li class="ms-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="spbuCheckbox">
                            <label class="form-check-label" for="spbuCheckbox">
                                SPBU
                            </label>
                        </div>
                    </li>
                    <!-- Fasilitas umum -->
                    <p class="head-sarana mb-2 mt-3 ms-2">Fasilitas umum</p>
                    <li class="ms-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="olahragaCheckbox">
                            <label class="form-check-label" for="olahragaCheckbox">
                                Fasilitas olahraga
                            </label>
                        </div>
                    </li>
            </ul>
        </div>
    </div>
</div>


<?php include 'partials/starter-foot.php' ?>